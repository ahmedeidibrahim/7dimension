@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.activitysidebar')
        </div>
        <div class="col-md-8  col-lg-8"> 
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#participants_tab">participants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#sessions_tab">Sesssions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#crews_tab">Crews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#Post_tab">Post</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="participants_tab" class="tab-pane active"><br>
                    @include('activities.participantstab')
                </div>
                <div id="sessions_tab" class="container tab-pane fade"><br>
                    @include('activities.sessionstab')
                </div>
                <div id="crews_tab" class="container tab-pane fade"><br>
                    @include('activities.crewstab')
                </div>
                <div id="post_tab" class="container tab-pane fade"><br>
                    @include('activities.posttab')
                </div>
            </div>
        </div>
    </div>
@endsection 