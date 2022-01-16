<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendInviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend_invites')->insert([
            [
              'user_id' => 2,
              'invitee_id' => 3,
              'message' => 'swx'
            ],
            [
                'user_id' => 3,
                'invitee_id' => 1,
                'message' => 'swxas'
            ],
            [
                'user_id' => 4,
                'invitee_id' => 1,
                'message' => 'swxas'
            ],
        ]);
    }
}
