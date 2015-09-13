<?php

namespace Cashjar\Http\Controllers;

use Illuminate\Http\Request;

use Cashjar\Http\Requests;
use Cashjar\Http\Controllers\Controller;
use DB;

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
        $toPay = 0;
        foreach ($user->groupevents as $groupevent) {
            foreach ($groupevent->expenses as $expense) {
                $toPay += $expense->cost;
            }
            
        }

        $owees = DB::table('users')->whereNotIn('id', [$user->id])->get();

        return view('home')->with(['user' => $user,'owees' => $owees, 'toPay' => $toPay]);
    }
}