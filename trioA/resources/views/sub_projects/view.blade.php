@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.subprojectsidebar')
        </div>
        <div class="col-md-8  col-lg-8"> 
            <div class="card"  style="box-shadow: 3px 2px;">
                <div class="card-header" tyle="vertical-align: middle;">
                    <div class="widget welcome-message">
                        <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
                        -> <a href="/programs/{{$sub_project->project->program->id}}"> {{$sub_project->project->program->name}} </a> 
                        -> <a href="/projects/{{$sub_project->project->id}}"> {{$sub_project->project->name}} </a> 
                        -> <a href="/sub_projects/{{$sub_project->id}}"> {{$sub_project->name}} </a> 
                        -> <b>activities</b>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($sub_project->activities)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Place</th>
                                <th>Registration</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($sub_project->activities as $activity)
                            <tr>
                                <td class="align-middle"><a href="/activities/{{$activity->id}}"><img class="rounded-circle" style="height:30px;, width:30px" src="/storage/img/activities/images/{{$activity->image}}"></a></td>
                                <td class="align-middle" style="max-width:30%;"><a href="/activities/{{$activity->id}}">{{$activity->name}}</a></td>
                                <td class="align-middle"><a href="/activities/{{$activity->id}}">{{$activity->start_date}}</a></td>
                                <td class="align-middle"><a href="/activities/{{$activity->id}}">{{$activity->organization_implementation_id}}</a></td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-info btn-default"  data-toggle="modal" data-target="#releaseModal{{$activity->id}}" href="">
                                        @if($activity->open_date == null)
                                            Release
                                        @elseif($activity->open_date > now())
                                            Comming
                                        @elseif($activity->close_date < now())
                                            Closed
                                        @else
                                            Live
                                        @endif
                                    </a>  
                                    <!-- Release activity Modal -->
                                    <div class="modal fade" id="releaseModal{{$activity->id}}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                {!! Form::open( ['action' => ['ActivitiesController@release', $activity->id],'method'=>'POST'  , 'enctype'=>'multipart/form-data']) !!}
                                            
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Registratin Date</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        {{Form::label( 'activity_open_date' , 'Open Date')}}
                                                        {{ Form::datetimelocal('activity_open_date', date('Y-m-d\TH:i', strtotime($activity->open_date)) , [ 'class' => 'form-control datetime' ]) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{Form::label( 'activity_close_date' , 'Close Date')}}
                                                        {{ Form::datetimelocal('activity_close_date', date('Y-m-d\TH:i', strtotime($activity->close_date)) , [ 'class' => 'form-control datetime' ]) }}
                                                    </div>
                                                </div>
                                                
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    {{ Form::hidden('_method','PUT')}}
                                                    {{ Form::submit('submit ',['class'=>'btn btn-outline-primary']) }}
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
        
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-info btn-default" href="/activities/{{$activity->id}}/edit">Edit</a>
                                </td>
                                <td class="align-middle">
                                    {!!Form::open(['action'=>['ActivitiesController@destroy', $activity->id],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>no activities added</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('activities.create',$sub_project->id) }}" class="btn btn-outline-primary">Create New activity</a>
                </div>
            </div>
        </div>
    </div>

@endsection 