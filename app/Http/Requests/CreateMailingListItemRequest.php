<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMailingListItemRequest extends FormRequest
{
    use AuthorizedRequest;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'mailingListId' => [
                'required',
                'email',
                Rule::in(['ico@jincor.com', 'beta@jincor.com', 'test@jincor.com']),
            ],
        ];
    }
}
