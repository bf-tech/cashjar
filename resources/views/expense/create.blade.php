@extends('template')

@section('content')

<h1 class="page-header">Create a new Expense</h1>

<form class="form-horizontal" role="form" action="/expense" method="POST">
  <fieldset>
    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	
	<div class="form-group">
        <label class="col-sm-3 control-label">Description</label>
        <div class="col-sm-8">
        	<input class="form-control" name="desc" type="text" placeholder="Enter text">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Cost</label>
        <div class="col-sm-8">
        	<input class="form-control" name="cost" type="integer" placeholder="00000.00">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Groupevent</label>
        <div class="col-sm-8">
        <select name="groupevent_id" class="form-control">
        @foreach($groupevents as $groupevent)
            @if(!$groupevent->paid)
            <option value="{{ $groupevent->id }}">{{ $groupevent->desc }}</option>
            @endif
        @endforeach
        </select>
        </div>
    </div>
    <div class="col-sm-offset-3 col-sm-8">
    	<button type="submit" class="btn btn-lg btn-outline btn-default">Submit</button>
    </div>
  </fieldset>
</form>


@endsection