<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Enrollment;
use App\Models\Strand;
use App\Models\Track;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Enrollment::class, function (Faker $faker) {
    $track = Track::all()->random()->id;
    $strand = Strand::where('track_id', $track)->inRandomOrder()->first();

    $gender = ['Male', 'Female'];
    return [
        "user_id" => 1,
        "school_year" => '2022-2023',
        "lrn_status" => 'No LRN',
        "returning" => 'No',
        "grade_level_to_enroll" => 11,
        "track_id" => $track,
        "strand_id" => $strand ? $strand->id : null,
        "last_grade_level_completed" => 10,
        "last_school_yr_completed" => '2021-2022',
        "last_school_attended_name" => $faker->country,
        "last_school_attended_address" => $faker->address,
        "last_school_attended_id" => rand(10000, 99999),
        "school_type" => 'Public',
        "school_to_enroll_name" => $faker->country,
        "school_to_enroll_address" => $faker->address,
        "school_to_enroll_in_id" => rand(10000, 99999),
        "psa" => rand(1000000, 9999999),
        "lrn" => rand(1000000, 9999999),
        "last_name" => $faker->lastName,
        "first_name" => $faker->firstName,
        "middle_name" => $faker->lastName,
        "extension_name" => "",
        "date_of_birth" => rand(1990, 2022) . '-' . rand(1, 12) . '-' . rand(1, 31),
        "age" => rand(18, 30),
        "gender" => $gender[rand(0, 1)],
        "has_children" => 'No',
        "indigenous_status" => 'No',
        "indigenous_status_name" => '',
        "mother_tongue" => 'Bisaya',
        "religion" => 'Catholic',
        "is_special_education" => 'No',
        "is_special_education_name" => '',
        "has_devices_available_at_home" => 'No',
        "has_devices_available_at_home_name" => '',
        "email" => $faker->email,
        "house_number_street" => $faker->address,
        "subdivision_village_zone" => $faker->address,
        "barangay" => $faker->address,
        "municipality" => $faker->country,
        "province" => $faker->country,
        "region" => 8,
        "father" => $faker->name,
        "father_contact" => $faker->numerify('###-####-####'),
        "father_heighest_edu_attainment" => '',
        "mother" => $faker->name,
        "mother_contact" => $faker->numerify('###-####-####'),
        "mother_heighest_edu_attainment" => '',
        "available_device" => 'No',
        "has_internet_connection" => 'No',
        "is_4ps_benificiary" => 'Yes',
        "limited_classes_allowed" => 'No',
        'enrolled_date' => Carbon::now()->subDays(rand(1, 10))->format('Y-m-d'),
    ];
});
