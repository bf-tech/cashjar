<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
    </head>
    <body>
        <p><strong>User Name</strong> {{$user->name}}</p>
        <p><strong>Expenses</strong></p>
        @if(count($user->expenses))
            @foreach($user->expenses as $expense)
                <p><strong>Description</strong> {{$expense->desc}}</p>
                <p><strong>Cost</strong> {{$expense->cost}}</p>
                <p><strong>GroupEvent</strong> {{$expense->groupevent->desc}}</p>
            @endforeach
        @endif
    </body>
</html>