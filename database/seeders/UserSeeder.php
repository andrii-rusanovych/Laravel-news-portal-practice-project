<?php

namespace Database\Seeders;

use App\Contracts\ReversibleSeeder;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder implements ReversibleSeeder
{
    public function run(): void
    {
        User::create([
            'name' => config('seeder.user_name'),
            'email' => config('seeder.user_email'),
            'password' => Hash::make(config('seeder.user_password'))
        ]);
    }

    /**
     * Deletes all users from db as an revert of seeder
     *
     * @return void
     */
    public function down() {
        DB::table('users')->where('email', config('seeder.user_email'))->delete();
    }
}
