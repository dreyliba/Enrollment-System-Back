<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|nullable',
            'school_year' => 'required',
            'lrn_status' => 'required',
            'grade_level_to_enroll' => 'required',
            'school_to_enroll_name' => 'required',
            'school_to_enroll_address' => 'required',
            'school_to_enroll_in_id' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'region' => 'required',
            'mother_tongue' => 'required',
            'household_member' => 'array',
            'available_device' => 'array',
            'internet_connection' => 'array',
            'distance_learning' => 'array',
            'learning_challenges' => 'array',
        ];
    }
}
