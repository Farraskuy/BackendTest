<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_books_list()
    {
        $this->getJson('/api/members')
            ->assertJsonStructure([
                '*' => [
                    'code',
                    'name',
                ],
            ])
            ->assertStatus(200);
    }
}
