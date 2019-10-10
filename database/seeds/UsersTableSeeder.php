<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'test@gmail.com',
            'business_id' => '1111',
            'access_tocken' => '2222',
        ]);
    }
}
