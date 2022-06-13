<?php

use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Enrollment::class, 20)->create();
    }
}
