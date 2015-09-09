<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <p>User Name:</p>
        <p>{{$user->name}}</p>
        @if(count($user->expenses))
            @foreach($user->expenses as $expense)
                <p>{{$expense->desc}}</p>
                <p>{{$expense->cost}}</p>
            @endforeach
        @endif
    </body>
</html>
