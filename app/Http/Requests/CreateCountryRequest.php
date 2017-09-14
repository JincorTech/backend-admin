<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Country;

class CreateCountryRequest extends FormRequest
{
    use AuthorizedRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Country::$rules;
    }
}
