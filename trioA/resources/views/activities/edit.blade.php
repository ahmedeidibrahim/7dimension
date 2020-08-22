@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.Activitysidebar')
        </div>
        
        <div class="col-md-8 col-lg-8">
            <div class="card"  style="border-radius:15px; box-shadow: 3px 2px;">
                <div class="card-header">
                    <div class="widget welcome-message">
                        <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
                        -> <a href="/programs/{{$activity->sub_project->project->program->id}}"> {{$activity->sub_project->project->program->name}} </a> 
                        -> <a href="/projects/{{$activity->sub_project->project->id}}"> {{$activity->sub_project->project->name}} </a> 
                        -> <a href="/sub_projects/{{$activity->sub_project->id}}"> {{$activity->sub_project->name}} </a> 
                        -> <a href="/activities/{{$activity->id}}"> {{$activity->name}} </a> 
                        -> <b>Edit activity</b>
                    </div>
                </div>
                
                {!! Form::open( ['action' => ['ActivitiesController@update', $activity->id],'method'=>'POST'  , 'enctype'=>'multipart/form-data']) !!}
                <div class="card-body row">

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                activity Information
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label( 'activity_name' , 'activities Name')}}
                                    {{ Form::text('activity_name', $activity->name ,['class' => 'form-control' , 'placeholder'=>'activity Name']) }}
                                </div>
                                <div class="form-group">
                                    {{Form::label( 'activity_arname' , 'Arabic Name')}}
                                    {{Form::text( 'activity_arname' , $activity->arname , [ 'class'=>'form-control' , 'placeholder'=>'Arabic Name' ])}}
                                </div>
                                <hr>
                                <div class="form-group">
                                    {{Form::label( 'activity_description' , 'description')}}
                                    {{Form::text( 'activity_description' , $activity->description , [ 'class'=>'form-control' , 'placeholder'=>'write a description' ])}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                activity Date and Place
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label( 'activity_start_date' , 'Start Date')}}
                                    {{ Form::datetimelocal('activity_start_date', $activity->start_date , [ 'class' => 'form-control datetime' ]) }}
                                </div>
                                <div class="form-group">
                                    {{Form::label( 'activity_end_date' , 'End Date')}}
                                    {{ Form::datetimelocal('activity_end_date', $activity->end_date , [ 'class' => 'form-control datetime' ]) }}
                                </div>
                                <hr>
                                <div class="form-group" >
                                    {{Form::label( 'activity_place' , 'Place')}}
                                    {{Form::text( 'activity_place' , $activity->organization_implementation_id , [ 'class'=>'form-control' , 'placeholder'=>'select the place' ])}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">activity Image</div>
                            <div class="card-body">
                                <div class="form-group text-center" style="margin-bottom:0px;">
                                    {{Form::file( 'activity_image' ,[ 'class' => 'form-control-static'])}}
                                    <img src="/storage/img/activities/images/{{$activity->image}}" alt="" class="border " style="max-width:100%; max-height:250px; postion:absolute;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">Certification Image</div>
                            <div class="card-body">
                                <div class="form-group text-center" style="margin-bottom:0px;">
                                    {{Form::file( 'certification_image' ,[ 'class' => 'form-control-static'])}}
                                    <img src="/storage/img/activities/certification_images/{{$activity->certification_image}}" alt="" class="border " style="max-width:100%; max-height:250px; postion:absolute;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-center">
                    {{ Form::hidden('_method','PUT')}}
                    {{ Form::submit('submit ',['class'=>'btn btn-outline-primary']) }}
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
