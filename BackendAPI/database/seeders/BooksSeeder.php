<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                "code" => "JK-45",
                "title" => "Harry Potter",
                "author" => "J.K Rowling",
            ],
            [
                "code" => "SHR-1",
                "title" => "A Study in Scarlet",
                "author" => "Arthur Conan Doyle",
            ],
            [
                "code" => "TW-11",
                "title" => "Twilight",
                "author" => "Stephenie Meyer",
            ],
            [
                "code" => "HOB-83",
                "title" => "The Hobbit, or There and Back Again",
                "author" => "J.R.R. Tolkien",
            ],
            [
                "code" => "NRN-7",
                "title" => "The Lion, the Witch and the Wardrobe",
                "author" => "C.S. Lewis",
            ],
        ];
    
        foreach ($books as $book) {
            Books::create([
                "code" => $book['code'],
                "title" => $book['title'],
                "author" => $book['author'],
                'stock' => 1
            ]);
        }
    }
}
