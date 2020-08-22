@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.profilesidebar')
        </div>
        
        <div class="col-md-8 col-lg-8">
            <div class="card"  style="border-radius:15px; box-shadow: 3px 2px;">
                <div class="card-header">
                    <div class="widget welcome-message">
                        <a href="/programs"><i class="fa fa-link "></i> Programs </a> -> <b>Create program</b>
                    </div>
                </div>
                
                {!! Form::open(['action'=>'ProgramsController@store' , 'method'=>'POST' , 'enctype'=>'multipart/form-data']) !!}
                <div class="card-body row">

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                Program Information
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{Form::label( 'program_name' , 'programs Name')}}
                                    {{ Form::text('program_name', '' ,['class' => 'form-control' , 'placeholder'=>'program Name']) }}
                                </div>
                                <div class="form-group">
                                    {{Form::label( 'program_arname' , 'Arabic Name')}}
                                    {{Form::text( 'program_arname' , '' , [ 'class'=>'form-control' , 'placeholder'=>'Arabic Name' ])}}
                                </div>
                                <hr>
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'program_description' , 'description')}}
                                    {{Form::text( 'program_description' , '' , [ 'class'=>'form-control' , 'placeholder'=>'write a description' ])}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">program Images</div>
                            <div class="card-body">
                                <div class="form-group text-center" style="margin-bottom:0px;">
                                    <!-- {{Form::label( 'program_image' , 'program Image')}} -->
                                    {{Form::file( 'program_image' ,[ 'class' => 'form-control-static'])}}
                                    <img src="/storage/img/programs/images/noimage.jpg" alt="" class="border " style="max-width:100%; max-height:250px; postion:absolute;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">
                                Contract Information
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::textarea('contract-ckeditor','',['id'=>'contract-ckeditor', 'name'=>'contract-ckeditor', 'rows'=>10, 'cols'=>10, 'class' => 'form-control' , 'placeholder'=>'Contract']) }}
                                    <script>
                                        CKEDITOR.replace( 'contract-ckeditor', 
                                            {
                                                height:100,
                                            } );
                                    </script>
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
                    <a href="{{ url()->previous() }}" class="btn btn-outline-dark">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
