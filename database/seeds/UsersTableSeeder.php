<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Andrian',
            'last_name' => 'Pontejo',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $role = Role::where('name', 'Admin')->first();
        $user->assignRole($role);
    }
}
