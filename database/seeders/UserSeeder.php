<?php

namespace Database\Seeders;

use App\Enums\CountryEnum;
use App\Models\Comment;
use App\Models\Like;
use App\Models\PooPin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $data = [
            [
                'username' => 'xXxShItDeMoNxXx',
                'email' => 'sududemonas@gmail.com',
                'password' => Hash::make('sududemonas'),
                'description' => 'Megstu sikti viesose vietose',
                'image' => null,
                'country' => CountryEnum::LITHUANIA,
            ],
            [
                'username' => 'sexiuZz',
                'email' => 'sududemonas69@gmail.com',
                'password' => Hash::make('sikuvienas'),
                'description' => 'Esu drovus sikejas',
                'image' => null,
                'country' => CountryEnum::LITHUANIA,
            ],
            [
                'username' => 'jonas_bruzga',
                'email' => 'itaka@gmail.com',
                'password' => Hash::make('sududemonas'),
                'description' => 'Megstu daryti itaka zmonems',
                'image' => null,
                'country' => CountryEnum::LITHUANIA,
            ],
            [
                'username' => 'simas_stanaitis',
                'email' => 'edgy_incel_humour@comedy.org',
                'password' => Hash::make('sududemonas'),
                'description' => 'Megstu daryti itaka zmonems',
                'image' => null,
                'country' => CountryEnum::LITHUANIA,
            ],
            [
                'username' => 'epic_shit_lord',
                'email' => 'lordaz@gmail.com',
                'password' => Hash::make('sududemonas'),
                'description' => 'Megstu daryti itaka zmonems',
                'image' => null,
                'country' => CountryEnum::LITHUANIA,
            ],
        ];
        for ($i = 0; $i < count($data); $i++) {
            $user = new User($data[$i]);
            $user->save();
            $posts = Post::factory()->count(2)->for($user)->create();
            Like::factory()->for($user)->for($posts[0])->create();
            Comment::factory()->for($user)->for($posts[1])->create();

            foreach ($posts as $post) {
                PooPin::factory()->for($post)->create();
            }
        }
    }
}
