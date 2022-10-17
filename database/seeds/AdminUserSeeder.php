<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->email = 'root@admin';
        $admin->name = 'Admin';
        $admin->email_verified_at = date(now());
        $admin->password = bcrypt('testroot');
        $admin->save();
    }
}
