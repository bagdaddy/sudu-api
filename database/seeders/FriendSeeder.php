<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friends')->insert([
            [
                'user_id' => 1,
                'friend_id' => 5,
            ],
            [
                'user_id' => 5,
                'friend_id' => 1,
            ],
        ]);
    }
}
