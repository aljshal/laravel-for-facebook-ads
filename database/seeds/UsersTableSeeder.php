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
            'email' => 'aljshal@gmail.com',
            'business_id' => '174056747059771',
            'access_tocken' => 'EAAKh01UzLjMBAOtc1lPBsn5rbPCujTYsOqMYmRV2jSQSmQZBIjgZB7p1rMb95J7a3zv7SWigFHZApsd5V8Hg6lmUW5yE632HHGtdyRvM3g6bKRQucIpXvuI5ie7b6z83QCZAcONtNZBuXcUrubEYV4peZCIn2eHMG2EUPQuJZA0BWXfGaLTWLoU',
        ]);
    }
}
