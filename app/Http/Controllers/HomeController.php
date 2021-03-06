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

        $expensesIn = collect([]);
        $total = 0;

        $participantingIn = collect([]);
        foreach ($user->groupevents as $groupevent) {
            if ($groupevent->paid == false) {
                $participantingIn->push($groupevent);
            }
        }

        foreach ($participantingIn as $groupevent) {
            foreach ($groupevent->expenses as $expense) {
                $expensesIn->push($expense);
                $total += $expense->cost;
            }
        }
        $sortedExpenses = $expensesIn->sortByDesc('created_at');

        $notifications = DB::table('notifications')->orderBy('created_at', 'DESC')->take(7)->get();


        return view('home')->with([
            'user' => $user,
            'sortedExpenses' => $sortedExpenses,
            'notifications' => $notifications,
            'total' => $total
            ]);
    }
}


