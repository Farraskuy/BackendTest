<?php

namespace App\Repositories;

use App\Http\Resources\BooksResource;
use App\Models\Books;
use App\Repositories\Interfaces\BooksInterface;

class BooksRepository implements BooksInterface
{
    public function getBooks()
    {
        $books = Books::selectRaw('
            books.*,
            (books.stock - 
                (select count(peminjaman.id) from peminjaman where returned_at IS NULL and peminjaman.book_id = books.id)
            ) as available_stock
        ')
            ->get();
        return BooksResource::collection($books);
    }
}
