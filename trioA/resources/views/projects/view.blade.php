@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-4 offset-lg-0">
            @include('inc.projectsidebar')
        </div>
        <div class="col-md-8  col-lg-8"> 
            <div class="card"  style="box-shadow: 3px 2px;">
                <div class="card-header" tyle="vertical-align: middle;">
                    <div class="widget welcome-message">
                        <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
                        -> <a href="/programs/{{$project->program->id}}"> {{$project->program->name}} </a> 
                        -> <a href="/projects/{{$project->id}}"> {{$project->name}} </a> 
                        -> <b>Sub_Projects</b>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($project->sub_projects)>0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Arabic language</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($project->sub_projects as $sub_project)
                            <tr>
                                <td class="align-middle"><a href="/sub_projects/{{$sub_project->id}}"><img class="rounded-circle" style="height:30px;, width:30px" src="/storage/img/sub_projects/images/{{$sub_project->image}}"></a></td>
                                <td class="align-middle" style="max-width:30%;"><a href="/sub_projects/{{$sub_project->id}}">{{$sub_project->name}}</a></td>
                                <td class="align-middle"><a href="/sub_projects/{{$sub_project->id}}">{{$sub_project->arname}}</a></td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-info btn-default" href="/sub_projects/{{$sub_project->id}}/edit">Edit</a>
                                </td>
                                <td class="align-middle">
                                    {!!Form::open(['action'=>['SubProjectsController@destroy', $sub_project->id],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>no sub_projects added</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('sub_projects.create',$project->id) }}" class="btn btn-outline-primary">Create New sub_project</a>
                </div>
            </div>
        </div>
    </div>
@endsection 