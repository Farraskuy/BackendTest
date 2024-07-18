<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Books;
use App\Models\Members;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\PeminjamanInterface;

class PeminjamanRepository implements PeminjamanInterface
{
    public function borrowBook($member_id, $book_id)
    {
        $check = DB::select("
            select 
                (select penalty_at from members where id = $member_id) as sedang_terpinalti,
                (select count(id) from peminjaman where member_id = $member_id and returned_at IS NULL) as buku_terpinjam,
                (select count(id) from peminjaman where book_id = $book_id and returned_at IS NULL) as buku_dipinjam
        ");

        $check = $check[0];

        $tanggal_pinjam = Carbon::parse($check->sedang_terpinalti, 'Asia/Jakarta')->addDays(3);
        $hari_ini = Carbon::now('Asia/Jakarta');

        if ($check->sedang_terpinalti && !$hari_ini->greaterThan($tanggal_pinjam)) {
            return [
                'status' => 422,
                'message' => 'Tidak dapat meminjam buku, karna member sedang terkena pinalti'
            ];
        }
        
        if ($check->sedang_terpinalti && $hari_ini->greaterThan($tanggal_pinjam)) {
            Members::find($member_id)->update([
                'penalty_at' => null
            ]);
        }

        if ($check->buku_terpinjam >= 2) {
            return [
                'status' => 422,
                'message' => 'Tidak dapat meminjam buku, karna member sudah meminjam 2 buku'
            ];
        }

        if ($check->buku_dipinjam >= 1) {
            return [
                'status' => 422,
                'message' => 'Tidak dapat meminjam buku, karna buku sudah terpinjam'
            ];
        }

        Peminjaman::create([
            "member_id" => $member_id,
            "book_id" => $book_id,
        ]);

        Books::find($book_id)->update([
            "stock" => 0
        ]);

        return [
            'status' => 201,
            'message' => 'Berhasil meminjam buku'
        ];
    }

    public function returnBook($borrow_id)
    {
        $pinjam = Peminjaman::find($borrow_id);

        $tanggal_pinjam = Carbon::parse($pinjam->created_at, 'Asia/Jakarta')->addDays(6);

        $hari_ini = Carbon::now('Asia/Jakarta');

        if ($hari_ini->greaterThan($tanggal_pinjam)) {
            Members::find($pinjam->member_id)->update([
                'penalty_at' => $hari_ini
            ]);
        }

        $pinjam->update([
            "returned_at" => $hari_ini
        ]);

        Books::find($pinjam->book_id)->update([
            "stock" => 1
        ]);
    }
}
