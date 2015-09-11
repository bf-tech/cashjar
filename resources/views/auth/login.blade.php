@extends('page')

@section('content')

<div class="login-panel panel panel-default">
    <div class="panel-body">
    <h1 class="text-center lead">Cash Jar</h1>
        <form role="form" method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="E-mail"  type="email" name="email" value="{{ old('email') }}" autofocus>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password" value="">
                </div>
                <div class="text-center"><a href="">Forgot Password?</a></div>
                <div class="checkbox text-center">
                    <label>
                        <input name="remember" type="checkbox">Remember Me
                    </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-lg btn-outline btn-primary btn-block">Login</button>
            </fieldset>
        </form>
    </div>
    <div class="panel-footer text-right">
        <a href="/auth/register">Register</a>
    </div>
</div>

@endsection