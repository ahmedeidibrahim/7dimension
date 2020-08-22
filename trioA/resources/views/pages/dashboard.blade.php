@extends('layouts.app')

@section('content') 
    <div class="row justify-content-center">
        <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
            @include('inc.profilesidebar')
        </div>
        <div class="col-md-8  col-lg-8">
            <div class="card"  style="box-shadow: 3px 2px;">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>

                <div class="card-footer">
                    <a href="/programs" class="btn btn-outline-primary">Go TO Your Programs</a>
                </div>
            </div>
        </div>
    </div>
@endsection
