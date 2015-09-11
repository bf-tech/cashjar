@extends('template')

@section('content')

<h1 class="page-header">Blank</h1>

        <p><strong>User Name</strong> {{$user->name}}</p>
        <p><strong>GroupEvents</strong></p>
        @if(count($user->groupevents))
            @foreach($user->groupevents as $groupevent)
                <p>{{$groupevent->desc}}</p>
                @if(count($groupevent->expenses))
                    @foreach($groupevent->expenses as $expense)
                        <p><strong>Description</strong> {{$expense->desc}}</p>
                        <p><strong>Cost</strong> {{$expense->cost}}</p>
                        <p><strong>Payer</strong> {{$expense->user()->first()->name}}</p>
                    @endforeach
                @endif
            @endforeach
        @endif

@endsection