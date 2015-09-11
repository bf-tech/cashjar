@extends('page')

@section('content')

<div class="login-panel panel panel-default">
    <div class="panel-body">
    <h1 class="text-center lead">Cash Jar</h1>
        <form role="form" method="POST" action="/auth/register">
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="Name"  type="text" name="name" value="{{ old('name') }}" autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="E-mail"  type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password" value="">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="password" value="">
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-outline btn-primary btn-block">Register</button>
            </fieldset>
        </form>
    </div>
    <div class="panel-footer text-right">
        <a href="/auth/login">Login</a>
    </div>
</div>


@endsection