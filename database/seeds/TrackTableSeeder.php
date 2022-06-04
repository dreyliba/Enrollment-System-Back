<?php

use App\Models\Strand;
use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tvl = Track::create([
            'code' => 'TVL',
            'name' => 'Technical-Vocational-Livelihood',
            'description' => 'It calls out to eligible students with subjects focused on job-ready skills',
        ]);
        $acad = Track::create([
            'code' => 'Academic Track',
            'name' => 'Academic Track',
            'description' => 'This track appeals to those who have set their minds towards college education',
        ]);

        $sports = Track::create([
            'code' => 'Sports Track',
            'name' => 'Sports Track',
            'description' => 'Developed to equip SHS students with sports-related and physical fitness and safety knowledge, this track appeals to those who wish to venture into athletics, fitness, and recreational industries.',
        ]);

        $arts = Track::create([
            'code' => 'Arts and Design Track',
            'name' => 'Arts and Design Track',
            'description' => 'Inside this course, students with a penchant for the Arts can enroll in subjects that will hone their skills in visual design and the performing arts.',
        ]);

        Strand::create([
            'track_id' => $tvl->id,
            'name' => 'Agri-Fishery Arts',
            'description' => 'Agri-Fishery Arts',
        ]);
        Strand::create([
            'track_id' => $tvl->id,
            'name' => 'Home Economics',
            'description' => 'Home Economics',
        ]);
        Strand::create([
            'track_id' => $tvl->id,
            'name' => 'Industrial Arts',
            'description' => 'Industrial Arts',
        ]);
        Strand::create([
            'track_id' => $tvl->id,
            'name' => 'Information and Communications Technology (ICT)',
            'description' => 'Information and Communications Technology (ICT)',
        ]);


        Strand::create([
            'track_id' => $acad->id,
            'name' => 'GA',
            'description' => 'General Academic',
        ]);
        Strand::create([
            'track_id' => $acad->id,
            'name' => 'HUMMS',
            'description' => 'Humanities and Social Sciences',
        ]);
        Strand::create([
            'name' => 'STEM',
            'track_id' => $acad->id,
            'description' => 'Science, Technology, Engineering and Mathematics',
        ]);
        Strand::create([
            'track_id' => $acad->id,
            'name' => 'ABM',
            'description' => 'Accountancy, Business and Management',
        ]);
    }
}
