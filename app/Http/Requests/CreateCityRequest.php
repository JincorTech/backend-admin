<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\City;

class CreateCityRequest extends FormRequest
{
    use AuthorizedRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return City::$rules;
    }
}
