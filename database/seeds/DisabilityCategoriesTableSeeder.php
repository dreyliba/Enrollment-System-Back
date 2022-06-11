<?php

use App\DisabilityCategory;
use Illuminate\Database\Seeder;

class DisabilityCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Autism',
            'Deaf-blindness',
            'Developmental Delay',
            'Emotional Disturbance',
            'Hearing Impairments',
            'Mental Retardation',
            'Multiple Disabilities',
            'Orthopedic Impairments',
            'Other Health Impairments',
            'Specific Learning Disabilities',
            'Speech or Language Impairments',
            'Traumatic Brain Injury',
            'Visual Impairments including blindness',
        ];

        foreach ($categories as $category) {
            DisabilityCategory::updateOrCreate([
                'name' => $category,
            ]);
        }
    }
}
