@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
            @include('inc.profilesidebar')
        </div>
        <div class="col-md-8">
            <div class="card"  style="box-shadow: 3px 2px;">
                <div class="card-header">
                    <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
                </div>
                <div class="card-body">
                    @if(count($programs)>0)
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Arabic language</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($programs as $program)
                            <tr>
                                <td class="align-middle"><a href="/programs/{{$program->id}}"><img class="rounded-circle" style="height:30px;, width:30px" src="/storage/img/programs/images/{{$program->image}}"></a></td>
                                <td class="align-middle"><a href="/programs/{{$program->id}}">{{$program->name}}</a></td>
                                <td class="align-middle"><a href="/programs/{{$program->id}}">{{$program->arname}}</a></td>
                                <td class="align-middle">
                                    <a class="btn btn-outline-info btn-default" href="/programs/{{$program->id}}/edit">Edit</a>
                                </td>
                                <td class="align-middle">
                                    {!!Form::open(['action'=>['ProgramsController@destroy', $program->id],'method'=>'POST','class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>no programs added</p>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="/programs/create" class="btn btn-outline-primary">Create New Program</a>
                    <a href="/dashboard" class="btn btn-outline-dark pull-right"><i class="fa fa-step-backward "></i> Dashboard</a>
                </div>
            </div>
        </div>
    </div>
@endsection