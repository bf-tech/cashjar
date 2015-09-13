@extends('template')

@section('content')

<h1 class="page-header">Create a new Groupevent</h1>

<form class="form-horizontal" role="form" action="/groupevent" method="POST">
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
	    @foreach($users as $user)
	    <div class="checkbox col-sm-offset-3 col-sm-3">
	  		<label>
	    		<input type="checkbox" name="user_id" value="{{ $user->id }}">
	    		{{ $user->name }}
	  		</label>
		</div>
		@endforeach
	</div>

    <div class="col-sm-offset-3 col-sm-8">
    	<button type="submit" class="btn btn-lg btn-outline btn-default">Submit</button>
    </div>
  </fieldset>
</form>


@endsection