<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 31.07.17
 * Time: 15:00
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Display a listing of the EconomicalActivityType.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('dashboard.index');
    }


}
