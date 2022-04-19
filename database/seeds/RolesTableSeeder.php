<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Instructor', 'Student', 'AnotherRoles'];

        foreach ($roles as $value) {
            $role = Role::where('name', $value)->get();

            if (count($role) == 0) {
                Role::updateOrCreate([
                    'name' => $value,
                ]);
            }
        }
    }
}
