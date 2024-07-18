<?php

namespace Database\Seeders;

use App\Models\Members;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            [
                'code' => "M001",
                "name" => "Angga",
            ],
            [
                'code' => "M002",
                "name" => "Ferry",
            ],
            [
                'code' => "M003",
                "name" => "Putri",
            ],
        ];

        foreach ($members as $member) {
            Members::create([
                "code" => $member['code'],
                "name" => $member['name'],
            ]);
        }
    }
}
