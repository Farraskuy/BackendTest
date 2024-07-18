<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Members;
use App\Http\Resources\MembersResource;
use App\Repositories\Interfaces\MembersInterface;

class MembersRepository implements MembersInterface
{

    public function getMembers()
    {
        $members = Members::withCount([
            'peminjaman' => function ($query) {
                $query->whereNull('returned_at');
            }
        ])->get();

        $hari_ini = Carbon::now('Asia/Jakarta');
        foreach ($members as $member) {
            $penalty_at = Carbon::parse($member->penalty_at, 'Asia/Jakarta')->addDays(3);

            if ($hari_ini->greaterThan($penalty_at)) {
                Members::find($member->id)->update([
                    'penalty_at' => null
                ]);
            }
        }

        return MembersResource::collection($members);
    }
}
