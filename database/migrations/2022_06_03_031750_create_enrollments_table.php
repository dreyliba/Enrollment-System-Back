<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string("school_year");
            $table->string("lrn_status", 25);
            $table->string("returning")->nullable();
            $table->string("grade_level_to_enroll");
            $table->string("last_grade_level_completed")->nullable();
            $table->string("last_school_yr_completed")->nullable();
            $table->string("last_school_attended_name")->nullable();
            $table->string("last_school_attended_address")->nullable();
            $table->string("last_school_attended_id")->nullable();
            $table->string("school_type", 25)->nullable();
            $table->string("school_to_enroll_name");
            $table->string("school_to_enroll_address");
            $table->string("school_to_enroll_in_id");
            $table->string("psa")->nullable();
            $table->string("lrn")->nullable();
            $table->string("last_name");
            $table->string("first_name");
            $table->string("middle_name")->nullable();
            $table->string("extension_name")->nullable();
            $table->string("date_of_birth");
            $table->string("gender");
            $table->string("indigenous_status", 25);
            $table->string("indigenous_status_name");
            $table->string("mother_tongue");
            $table->string("religion");
            $table->string("is_special_education", 25);
            $table->string("is_special_education_name");
            $table->string("has_devices_available_at_home", 25);
            $table->string("has_devices_available_at_home_name");
            $table->string("email")->nullable();
            $table->string("house_number_street")->nullable();
            $table->string("subdivision_village_zone")->nullable();
            $table->string("barangay");
            $table->string("municipality");
            $table->string("province");
            $table->string("region");
            $table->string("father")->nullable();
            $table->string("father_contact")->nullable();
            $table->string("father_heighest_edu_attainment")->nullable();
            $table->string("mother")->nullable();
            $table->string("mother_contact")->nullable();
            $table->string("mother_heighest_edu_attainment")->nullable();
            $table->string("guardian")->nullable();
            $table->string("guardian_contact")->nullable();
            $table->string("guardian_heighest_edu_attainment")->nullable();
            $table->string("kinder")->nullable();
            $table->string("grade_1")->nullable();
            $table->string("grade_2")->nullable();
            $table->string("grade_3")->nullable();
            $table->string("grade_4")->nullable();
            $table->string("grade_5")->nullable();
            $table->string("grade_6")->nullable();
            $table->string("grade_7")->nullable();
            $table->string("grade_8")->nullable();
            $table->string("grade_9")->nullable();
            $table->string("grade_10")->nullable();
            $table->string("grade_11")->nullable();
            $table->string("grade_12")->nullable();
            $table->string("other_grade")->nullable();
            $table->string("household_member");
            $table->string("available_device");
            $table->string("available_device_others")->nullable();
            $table->string("internet_connection", 25);
            $table->string("distance_learning");
            $table->string("distance_learning_others")->nullable();
            $table->string("learning_challenges");
            $table->string("learning_challenges_others")->nullable();
            $table->string("is_benificiary", 25);
            $table->string("limited_face_to_face");
            $table->string("limited_classes_allowed");
            $table->string("limited_face_to_face_others")->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
