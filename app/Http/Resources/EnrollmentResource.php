<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'user' => $this->user,
            'track' => $this->track,
            'strand' => $this->strand,
            'household_member' => explode(',', $this->household_member),
            'available_device' => explode(',', $this->available_device),
            'internet_connection' => explode(',', $this->internet_connection),
            'distance_learning' => explode(',', $this->distance_learning),
            'learning_challenges' => explode(',', $this->learning_challenges),
            'limited_face_to_face' => explode(',', $this->limited_face_to_face),
        ]);
    }
}
