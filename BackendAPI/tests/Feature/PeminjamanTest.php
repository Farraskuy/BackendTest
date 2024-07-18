<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Members;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeminjamanTest extends TestCase
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
    public function test_member_borrow_book()
    {
        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);

        $this->assertDatabaseHas('peminjaman', ['member_id' => 1, 'book_id' => 1, 'returned_at' => null]);
    }

    public function test_member_return_book()
    {
        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);
        $this->assertDatabaseHas('peminjaman', ['member_id' => 1, 'book_id' => 1, 'returned_at' => null]);

        $this->patchJson('/api/peminjaman', [
            'borrow_id' => 1,
        ])->assertStatus(200);
        $check = Peminjaman::whereNotNull('returned_at')->where('id', '=', 1)->first();
        $this->assertTrue(!!$check);
    }

    public function test_member_has_penalty_cannot_borrow_book()
    {
        $member = Members::where('id', '=', 1)->first();
        $member->update([
           'penalty_at' => Carbon::now() 
        ]);

        $member = Members::where('id', '=', 1)->first();
        $this->assertNotNull($member->penalty_at);

        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(422);
        $this->assertDatabaseCount('peminjaman', 0);
    }

    public function test_member_has_penalty_after_3_days_can_borrow_book()
    {
        $member = Members::where('id', '=', 1)->first();
        $member->update([
           'penalty_at' => Carbon::now() 
        ]);

        $member = Members::where('id', '=', 1)->first();
        $this->assertNotNull($member->penalty_at);

        $member->update([
           'penalty_at' => Carbon::now()->subDays(4)
        ]);

        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);
        $this->assertDatabaseCount('peminjaman', 1);
    }

    public function test_member_cannot_borrow_more_than_2_books()
    {
        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);
        $this->assertDatabaseHas('peminjaman', ['member_id' => 1, 'book_id' => 1, 'returned_at' => null]);

        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 2,
        ])->assertStatus(201);
        $this->assertDatabaseHas('peminjaman', ['member_id' => 1, 'book_id' => 2, 'returned_at' => null]);

        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 3,
        ])->assertStatus(422);

        $this->assertDatabaseCount('peminjaman', 2);
    }

    public function test_member_return_book_more_than_7_days_will_get_penalty()
    {
        $this->postJson('/api/peminjaman', [
            'member_id' => 1,
            'book_id' => 1,
        ])->assertStatus(201);

        Peminjaman::where('id', '=', 1)->update([
            'created_at' => Carbon::now()->subDays(8)->toDateTimeString()
        ]);

        $this->patchJson('/api/peminjaman', [
            'borrow_id' => 1,
        ])->assertStatus(200);

        $member = Members::where('id', '=', 1)->first();
        $this->assertNotNull($member->penalty_at);
    }
}
