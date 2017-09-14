<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 13.09.17
 * Time: 21:09
 */

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;

trait AuthorizedRequest
{
    public function authorize()
    {
        return Auth::check();
    }
}
