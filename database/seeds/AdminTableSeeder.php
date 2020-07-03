<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Queue Admin';
        $admin->email = 'admin@qr-queue.com';
        $admin->password = Hash::make('admin');
        $admin->username = 'admin';

        $admin->save();
    }
}
