<?php

namespace App\Repositories\Interfaces;

use App\Models\Members;

interface PeminjamanInterface
{
    public function borrowBook(Members $member_id, $book_id);

    public function returnBook($borrow_id);
}
