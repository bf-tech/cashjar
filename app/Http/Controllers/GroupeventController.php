<?php

namespace Cashjar\Http\Controllers;

use Illuminate\Http\Request;

use Cashjar\Http\Requests;
use Cashjar\Http\Controllers\Controller;

use Cashjar\Groupevent;
use Cashjar\User;
use DB;

class GroupeventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function join($groupevent_id)
    {
        $user = \Auth::user();
        DB::table('groupevent_user')->insert(['user_id' => $user->id, 'groupevent_id' => $groupevent_id]);
        $groupevents = Groupevent::all();
        return redirect('groupevent');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function leave($groupevent_id)
    {
        $user = \Auth::user();
        DB::table('groupevent_user')->where('user_id', $user->id)->where('groupevent_id', $groupevent_id)->delete();
        $groupevents = Groupevent::all();
        return redirect('groupevent');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();
        $groupevents = Groupevent::all();
        return view('groupevent.index')->with(['user' => $user, 'groupevents' => $groupevents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::all();
        return view('groupevent.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = \Request::all();
        $groupevent = new Groupevent($input);
        \Auth::user()->groupevents()->save($groupevent);
        
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return view('groupevent.create')->with(['groupevent' => Groupevent::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $groupevent = Groupevent::findOrFail($id);
        return view('groupevent.edit')->with('groupevent', $groupevent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $groupevent = Groupevent::findOrFail($id);
        $groupevent->update($request->all());
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $groupevent = Groupevent::findOrFail($id);
        $groupevent->delete();
        return redirect('home');
    }
}
