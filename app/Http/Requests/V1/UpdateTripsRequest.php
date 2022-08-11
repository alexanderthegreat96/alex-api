<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripsRequest extends FormRequest
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
     * @return string[]
     */
    public function rules()
    {
        return
            [
                'title' => 'required | max: 150',
                'description' => 'required | max: 400',
                'start_date' => 'date',
                'end_date' => 'date | after:start_date',
                'location' => 'max: 150',
                'price' => 'min: 1'
            ];
    }
}
