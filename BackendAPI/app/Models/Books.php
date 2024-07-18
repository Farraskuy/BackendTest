<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Books",
 *     type="object",
 *     title="Books",
 *     description="Model Books",
 *     required={"name","title","author","stock"},
 *     properties={
 *         @OA\Property(
 *             property="id",
 *             type="integer",
 *             description="Book id"
 *         ),
 *         @OA\Property(
 *             property="code",
 *             type="string",
 *             description="Book code"
 *         ),
 *         @OA\Property(
 *             property="title",
 *             type="string",
 *             description="Book title"
 *         ),
 *         @OA\Property(
 *             property="author",
 *             type="string",
 *             description="Book author"
 *         ),
 *         @OA\Property(
 *             property="stock",
 *             type="integer",
 *             description="Book stock"
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

class Books extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'title',
        'author',
        'stock',
    ];
}
