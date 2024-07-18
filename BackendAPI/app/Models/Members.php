<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Members",
 *     type="object",
 *     title="Members",
 *     description="Model Members",
 *     required={"code","name"},
 *     properties={
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Member id"
 *         ),
 *         @OA\Property(
 *             property="code",
 *             type="string",
 *             description="Member code"
 *         ),
 *         @OA\Property(
 *             property="name",
 *             type="string",
 *             description="Member Name"
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

class Members extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'penalty_at'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'member_id');
    }
}
