@extends('template')

@section('content')

<h1 class="page-header">Quick Overview <small>{{$user->name}}</small></h1>

<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12">


                <div>
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">$ {{ $total }}</div>
                                    <div>Total Expenses</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Whom Shall I Pay
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                @foreach ($user->owees() as $owee)
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> {{$owee->name}} <span class="badge pull-right">$ {{round($user->owe($owee->id))}}</span>
                                </a>
                                @endforeach
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">(If negative) "They OWE You"</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Recent Activity
                        </div>

                            <!-- List group -->
                            <ul class="list-group">
                            @foreach($notifications as $notification)
                                <li class="list-group-item">
                                    <p>{{ $notification->notification }}
                                    <span class="small pull-right">{{ $notification->created_at }}</span></p>
                                </li>
                            @endforeach
                            </ul>
                        
                    </div>

</div><div class="col-lg-8 col-md-8 col-sm-12">


                <div id="topay" class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Active Expenses
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                @if(count($sortedExpenses))
                    <ul class="timeline">
                        @foreach($sortedExpenses as $expense)
                            <li {{ ($user->id == $expense->user->id) ? '' : 'class=timeline-inverted' }}>
                                <!--<div class="timeline-badge pull-right"><i class="fa fa-check"></i></div>-->
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">{{ $expense->desc }} <span class="label label-primary pull-right">$ {{ $expense->cost }}</span></h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>{{ $expense->groupevent->desc }} <span class="text-muted">[{{ $expense->user->name }}]</span></p>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{ $expense->created_at }}</small><span class="pull-right"><a href="/expense/{{ $expense->id }}/edit"><i class="fa fa-wrench"></i></a></span></p>
                                        </div>
                                    </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    No Active Expenses
                @endif
                </div>
            </div>
                        <!-- /.panel-body -->
                    </div>
            </div>

@endsection