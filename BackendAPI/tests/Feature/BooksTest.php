<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BooksTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed BooksSeeder');
        Artisan::call('db:seed MembersSeeder');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_books_list()
    {
        $this->getJson('/api/books')
            ->assertJsonStructure([
                '*' => [
                    'code',
                    'title',
                    'author',
                    'stock',
                ],
            ])
            ->assertStatus(200);
    }

    public function test_stock_book_is_borrowed_not_counted()
    {
        $this->assertDatabaseHas('books', ['id' => 1, 'stock' => 1]);

        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);

        $this->assertDatabaseHas('books', ['id' => 1, 'stock' => 0]);
    }
}
