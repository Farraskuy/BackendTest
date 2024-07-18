<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Peminjaman",
 *     type="object",
 *     title="Peminjaman",
 *     description="Model Peminjaman",
 *     required={"member_id","book_id","returned_at"},
 *     properties={
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="borrow id"
 *         ),
 *         @OA\Property(
 *             property="member id",
 *             type="string",
 *             description="member id"
 *         ),
 *         @OA\Property(
 *             property="book_id",
 *             type="integer",
 *             description="Book id"
 *         ),
 *         @OA\Property(
 *             property="returned_at",
 *             type="string",
 *             format="date-time",
 *             description="Tanggal dikembalikan"
 *         ),
 *         @OA\Property(
 *             property="created_at",
 *             type="string",
 *             format="date-time",
 *             description="Tanggal pertama kali dibuat"
 *         ),
 *         @OA\Property(
 *             property="updated_at",
 *             type="string",
 *             format="date-time",
 *             description="Tanggal terakhir ubah"
 *         ),
 *     }
 * )
 */

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        "member_id",
        "book_id",
        "returned_at",
    ];
}
