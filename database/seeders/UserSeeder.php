<?php

namespace Database\Seeders;

use App\Enums\CountryEnum;
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
        DB::table('users')->insert(
            [
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
            ]
        );
    }
}
