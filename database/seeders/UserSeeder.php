<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            "name" => "Phạm Quang Linh",
            "password" => Hash::make("Linhz123@"),
            "email" => "Phamquanglinhdev@gmail.com",
        ];
        User::create($people);
        $people = [
            "name" => "Lan Trần .",
            "password" => Hash::make("laniuling"),
            "email" => "cobebao@gmail.com",
        ];
        User::create($people);
    }
}
