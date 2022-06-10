<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "school_year",
        "lrn_status",
        "returning",
        "grade_level_to_enroll",
        "track_id",
        "last_year_track_id",
        "strand_id",
        "last_year_strand_id",
        "last_grade_level_completed",
        "last_school_yr_completed",
        "last_school_attended_name",
        "last_school_attended_address",
        "last_school_attended_id",
        "school_type",
        "school_to_enroll_name",
        "school_to_enroll_address",
        "school_to_enroll_in_id",
        "psa",
        "lrn",
        "last_name",
        "first_name",
        "middle_name",
        "extension_name",
        "date_of_birth",
        "age",
        "gender",
        "has_children",
        "indigenous_status",
        "indigenous_status_name",
        "mother_tongue",
        "religion",
        "is_special_education",
        "is_special_education_name",
        "has_devices_available_at_home",
        "has_devices_available_at_home_name",
        "email",
        "house_number_street",
        "subdivision_village_zone",
        "barangay",
        "municipality",
        "province",
        "region",
        "father",
        "father_contact",
        "father_heighest_edu_attainment",
        "mother",
        "mother_contact",
        "mother_heighest_edu_attainment",
        "guardian",
        "guardian_contact",
        "guardian_heighest_edu_attainment",
        "kinder",
        "grade_1",
        "grade_2",
        "grade_3",
        "grade_4",
        "grade_5",
        "grade_6",
        "grade_7",
        "grade_8",
        "grade_9",
        "grade_10",
        "grade_11",
        "grade_12",
        "other_grade",
        "household_member",
        "available_device",
        "available_device_others",
        "has_internet_connection",
        "internet_connection",
        "distance_learning",
        "distance_learning_others",
        "learning_challenges",
        "learning_challenges_others",
        "is_4ps_benificiary",
        "limited_classes_allowed",
        "limited_face_to_face",
        "limited_face_to_face_others",
        'enrolled_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class);
    }

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return implode(' ', [$this->first_name, $this->middle_name, $this->last_name]);
    }
}
