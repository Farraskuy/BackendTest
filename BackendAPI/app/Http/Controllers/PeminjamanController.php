<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReturnRequest;
use App\Http\Requests\StoreBorrowRequest;
use App\Repositories\Interfaces\PeminjamanInterface;

class PeminjamanController extends Controller
{
    protected $peminjamanRepository;

    public function __construct(PeminjamanInterface $peminjamanRepository)
    {
        $this->peminjamanRepository = $peminjamanRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/peminjaman",
     *     operationId="borrowBooks",
     *     tags={"Peminjaman"},
     *     summary="Peminjaman Buku",
     *     description="Peminjaman Buku",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"member_id","book_id"},
     *             @OA\Property(property="member_id", type="integer", description="member id"),
     *             @OA\Property(property="borrow_id", type="integer", description="borrow id")
     *         )
     *     ),
     *     @OA\Response(
     *       response=201,
     *       description="Success borrowing book",
     *       @OA\JsonContent(
     *           @OA\Property(property="message", type="integer", description="borrow id")
     *       )
     *     ),
     *     @OA\Response(
     *       response=422,
     *       description="Invalid request",
     *       @OA\JsonContent(
     *           @OA\Property(
     *               property="error", 
     *               type="array", 
     *               description="error validation",
     *               @OA\Items(
     *                   type="string"
     *               )
     *           )
     *       )
     *     )
     * )
     */

    public function borrow(StoreBorrowRequest $request)
    {
        $result = $this->peminjamanRepository->borrowBook($request->member_id, $request->book_id);
        return response()->json(['message' => $result['message']], $result['status']);
    }

    /**
     * @OA\Patch(
     *     path="/api/peminjaman",
     *     operationId="returnBooks",
     *     tags={"Peminjaman"},
     *     summary="Return Book",
     *     description="Returning Book",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"borrow_id"},
     *             @OA\Property(property="borrow_id", type="integer", description="borrow id")
     *         )
     *     ),
     *     @OA\Response(
     *       response=200,
     *       description="Success returning book",
     *       @OA\JsonContent(
     *           @OA\Property(property="message", type="integer", description="borrow id")
     *       )
     *     ),
     *     @OA\Response(
     *       response=422,
     *       description="Invalid request",
     *       @OA\JsonContent(
     *           @OA\Property(
     *               property="error", 
     *               type="array", 
     *               description="error validation",
     *               @OA\Items(
     *                   type="string"
     *               )
     *           )
     *       )
     *     )
     * )
     */

    public function return(StoreReturnRequest $request)
    {
        $this->peminjamanRepository->returnBook($request->borrow_id);
        return response()->json([
            'message' => 'Berhasil mengembalikan buku'
        ]);
    }
}