<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
            [
                'title' => 'required | max: 150',
                'description' => 'required | max: 400',
                'start_date' => 'required | date',
                'end_date' => 'required | date | after:start_date',
                'location' => 'required | max: 150',
                'price' => 'required'
            ];
    }
}
