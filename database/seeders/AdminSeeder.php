<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'name' => 'admin',
                'email' => env('ADMIN_EMAIL'),
                'username' => 'admin',
                'password' => bcrypt(env('ADMIN_DEFAULT_PASSWORD')),
                'type' => '1',
            ],
        );
    }
}
