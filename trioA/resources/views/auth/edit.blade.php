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
                        <h2>profile Information</h2>
                        <p>information message ....</p>
                    </div>
                </div>
                
                {!! Form::open( [ 'action' => ['UserController@update'] , 'method'=>'POST'  , 'enctype'=>'multipart/form-data']) !!}
                <div class="card-body row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">Personal Information</div>
                            <div class="card-body">
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'name' , 'User Name')}}
                                    {{ Form::text('name', Auth()->User()->name ,['class' => 'form-control' , 'placeholder'=>'Name']) }}
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'national_id' , 'National ID')}}
                                    {{Form::text( 'national_id' , Auth()->User()->national_id , [ 'class'=>'form-control' , 'placeholder'=>'National ID' ])}}
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'address' , 'Address')}}
                                    {{Form::text( 'address' , Auth()->User()->address , [ 'class'=>'form-control' , 'placeholder'=>'Enter your address' ])}}
                                </div>
                            </div>
                        </div>
                    </div>
 
                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">Profile avatar</div>
                            <div class="card-body">
                                <div class="form-group text-center" style="margin-bottom:0px;">
                                    <!-- {{Form::label( 'user_avatar' , 'User Avatar')}} -->
                                    {{Form::file( 'user_avatar' ,[ 'class' => 'form-control-static'])}}
                                    <img src="/storage/img/users/{{Auth()->User()->avatar}}" alt="" class="border " style="width:100%; postion:absolute;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <div class="card"  style=" margin-bottom:15px; box-shadow: 3px 2px;">
                            <div class="card-header">Contacts Information</div>
                            <div class="card-body">
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'email' , 'Email')}}
                                    {{Form::text( 'email' , Auth()->User()->email , [ 'class'=>'form-control' , 'placeholder'=>'Email' ])}}
                                </div>
                                <hr>
                                <div class="form-group" style="margin-bottom:20px;">
                                    {{Form::label( 'phone' , 'Phone')}}
                                    {{Form::text( 'phone' , Auth()->User()->phone , [ 'class'=>'form-control' , 'placeholder'=>'#01---------' ])}}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6  col-lg-6">
                        <div class="card"  style=" margin-bottom:15px;  box-shadow: 3px 2px;">
                            <div class="card-header">
                                Edit Password
                            </div>
                            <div class="card-body">
                                <div class="form-group" style="margin-bottom:20px;">
                                    <div class="input-group-append">
                                            {{ Form::password('current_password', ['class' => 'form-control' ,'id' => 'current-password-id' , 'placeholder'=>'Current Password' ,  'onkeyup' =>'checkPassword();' ] ) }}
                                            <i class="input-group-text fa fa-eye" aria-hidden="true"  id = "current-password-id" onmouseover="showPassword(this.id);" onmouseout="showPassword(this.id);"></i>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom:20px;">
                                    <div class="input-group-append">
                                            {{ Form::password('new_password', ['class' => 'form-control' ,'id' => 'new-password-id' , 'placeholder'=>'New Password' ,  'onkeyup' =>'checkPassword();' ] ) }}
                                            <i class="input-group-text fa fa-eye" aria-hidden="true"  id = "new-password-id" onmouseover="showPassword(this.id);" onmouseout="showPassword(this.id);"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group-append">
                                            {{ Form::password('confirm_password', ['class' => 'form-control' ,'id' => 'confirm-password-id' , 'placeholder'=>'Confirm New Password' ,  'onkeyup' =>'checkPassword();' ] ) }}
                                            <i class="input-group-text fa fa-eye" aria-hidden="true" id = "confirm-password-id" onmouseover="showPassword(this.id);" onmouseout="showPassword(this.id);"></i>
                                    </div>
                                    <span id='password-message-id'></span>
                                </div>
                                
                                <script type="text/javascript">
                                    function checkPassword()
                                    {
                                        if (document.getElementById('new-password-id').value == document.getElementById('confirm-password-id').value) 
                                        {
                                            document.getElementById('password-message-id').style.color = 'green';
                                            document.getElementById('password-message-id').innerHTML = 'matching';
                                            
                                            if (document.getElementById('current-password-id').value == '')
                                            {
                                                document.getElementById('password-message-id').style.color = 'red';
                                                document.getElementById('password-message-id').innerHTML = 'please enter your current password';
                                                document.getElementById('current-password-id').focus();
                                            }
                                        } else {
                                            document.getElementById('password-message-id').style.color = 'red';
                                            document.getElementById('password-message-id').innerHTML = 'not matching';
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-center">
                    {{ Form::hidden('_method','PUT')}}
                    {{ Form::submit('submit ',['class'=>'btn btn-outline-primary']) }}
                    <a href="/dashboard" class="btn btn-outline-dark">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
