<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\BooksInterface;

class BooksController extends Controller
{
    protected $booksRepository;

    public function __construct(BooksInterface $booksRepository)
    {
        $this->booksRepository = $booksRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/books",
     *     operationId="getBooks",
     *     tags={"Books"},
     *     summary="Show Books",
     *     description="Showing books list",
     *     @OA\Response(
     *       response=200,
     *       description="Success show books list",
     *       @OA\JsonContent(
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Books")
     *       )
     *     )
     * )
     */

    public function index()
    {
        $books = $this->booksRepository->getBooks();
        return response()->json($books);
    }
}