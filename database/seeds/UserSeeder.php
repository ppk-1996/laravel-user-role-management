<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
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
        User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        $user = new User;
        $user->name = "John";
        $user->email = "admin@admin.com";
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach($adminRole);

        $user = new User;
        $user->name = "Edward";
        $user->email = "editor@editor.com";
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach($editorRole);

        $user = new User;
        $user->name = "Paul";
        $user->email = "user@user.com";
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach($userRole);
    }
}
