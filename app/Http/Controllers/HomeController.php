<?php

namespace Cashjar\Http\Controllers;

use Illuminate\Http\Request;

use Cashjar\Http\Requests;
use Cashjar\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();

        return view('home')->with(['user' => $user]);
    }
}