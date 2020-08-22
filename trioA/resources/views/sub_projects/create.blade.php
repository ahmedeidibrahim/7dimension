@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.projectsidebar')
        </div>
        
        <div class="col-md-8 col-lg-8">
            <div class="card"  style="border-radius:15px; box-shadow: 3px 2px;">
                <div class="card-header">
                    <div class="widget welcome-message">
                        <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
                        -> <a href="/programs/{{$project->program->id}}"> {{$project->program->name}} </a>
                        -> <a href="/projects/{{$project->id}}"> {{$project->name}} </a>
                        -> <b>Create sub_project</b>
                    </div>
                </div>
                
                {!! Form::open(['action' => ['SubProjectsController@store', $project->id] , 'method'=>'POST' , 'enctype'=>'multipart/form-data']) !!}
                <div class="card-body row">

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                sub_project Information
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label( 'sub_project_name' , 'sub_projects Name')}}
                                    {{ Form::text('sub_project_name', '' ,['class' => 'form-control' , 'placeholder'=>'sub_project Name']) }}
                                </div>
                                <div class="form-group">
                                    {{Form::label( 'sub_project_arname' , 'Arabic Name')}}
                                    {{Form::text( 'sub_project_arname' , '' , [ 'class'=>'form-control' , 'placeholder'=>'Arabic Name' ])}}
                                </div>
                                <hr>
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'sub_project_description' , 'description')}}
                                    {{Form::text( 'sub_project_description' , '' , [ 'class'=>'form-control' , 'placeholder'=>'write a description' ])}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">sub_project Images</div>
                            <div class="card-body">
                                <div class="form-group text-center" style="margin-bottom:0px;">
                                    <!-- {{Form::label( 'sub_project_image' , 'sub_project Image')}} -->
                                    {{Form::file( 'sub_project_image' ,[ 'class' => 'form-control-static'])}}
                                    <img src="/storage/img/sub_projects/images/noimage.jpg" alt="" class="border " style="max-width:100%; max-height:250px; postion:absolute;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                Goals
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::textarea('goals-ckeditor','',['id'=>'goals-ckeditor', 'name'=>'goals-ckeditor', 'class' => 'form-control' , 'placeholder'=>'Goals']) }}
                                    <script>
                                        CKEDITOR.replace( 'goals-ckeditor', {height:100} );
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-center">
                    {{ Form::submit('submit ',['class'=>'btn btn-outline-primary']) }}
                    <a href="/sub_projects" class="btn btn-outline-dark">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
