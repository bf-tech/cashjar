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

        $expensesIn = collect([]);

        $participantingIn = collect([]);
        foreach ($user->groupevents as $groupevent) {
            if ($groupevent->paid == false) {
                $participantingIn->push($groupevent);
            }
        }

        foreach ($participantingIn as $groupevent) {
            foreach ($groupevent->expenses as $expense) {
                $expensesIn->push($expense);
            }
        }
        $sortedExpenses = $expensesIn->sortByDesc('created_at');

        return view('home')->with(['user' => $user, 'sortedExpenses' => $sortedExpenses]);
    }
}