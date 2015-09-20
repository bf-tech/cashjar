@extends('page')

@section('content')

<div class="login-panel panel panel-default">
    <div class="panel-body">
    <h1 class="text-center lead">Cash Jar</h1>
        <form role="form" method="POST" action="/password/email">
            {!! csrf_field() !!}

            <fieldset>
                <div class="form-group">
                    <input class="form-control" placeholder="E-mail"  type="email" name="email" value="{{ old('email') }}" autofocus>
                </div>

                <button type="submit" class="btn btn-lg btn-outline btn-primary btn-block">Send Password Reset Link</button>
            </fieldset>
        </form>
    </div>
    <div class="panel-footer text-right">
        <a href="/auth/register">Register</a>
    </div>
</div>

@endsection