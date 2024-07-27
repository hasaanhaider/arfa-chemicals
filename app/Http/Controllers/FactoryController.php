<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactoryController extends Controller
{
    // public function index()
    // {
    //     return view('fac');
    // }

    public function create()
    {
        return view('factories.create');
    }
}
