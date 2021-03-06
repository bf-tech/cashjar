@extends('template')

@section('content')

<h1 class="page-header">List of Groupevents - <small>{{$user->name}}</small></h1>

    @foreach($groupevents as $groupevent)
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$groupevent->desc}} <span class="pull-right"> @if($groupevent->paid) <span class="label label-success">PAID</span> @else <a class="text-success" href="/groupevent/markAsPaid/{{$groupevent->id}}"><i class="fa fa-check-square-o"></i> as Paid</a> | <a href="/groupevent/join/{{$groupevent->id}}">Join <i class="fa fa-sign-in"></i></a> <a class="text-danger" href="/groupevent/leave/{{$groupevent->id}}"><i class="fa fa-sign-out"></i> Leave</a> @endif</span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>({{$groupevent->participants()->count()}} Participant/s)</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($groupevent->participants() as $participant)
                                <tr>
                                    <td>{{$participant->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            
                        </div>

                        <hr>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Cost</th>
                                    <th>Payer</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($groupevent->expenses))
                            @foreach($groupevent->expenses as $expense)
                                <tr>
                                    <td><a href="/expense/{{$expense->id}}/edit"><i class="fa fa-cog"></i></a></td>
                                    <td>{{$expense->desc}}</td>
                                    <td>{{$expense->cost}}</td>
                                    <td>{{$expense->user()->first()->name}}</td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                            <!-- /.table-responsive -->
                </div>
                        <!-- /.panel-body -->
                </div>
                    <!-- /.panel -->
            </div>
    @endforeach

@endsection