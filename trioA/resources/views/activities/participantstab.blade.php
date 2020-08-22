<div class="card"  style="box-shadow: 3px 2px;">
    <div class="card-header" tyle="vertical-align: middle;">
        <div class="widget welcome-message">
            <a href="/programs"><i class="fa fa-link "></i> Programs </a> 
            -> <a href="/programs/{{$activity->sub_project->project->program->id}}"> {{$activity->sub_project->project->program->name}} </a> 
            -> <a href="/projects/{{$activity->sub_project->project->id}}"> {{$activity->sub_project->project->name}} </a> 
            -> <a href="/sub_projects/{{$activity->sub_project->id}}"> {{$activity->sub_project->name}} </a> 
            -> <a href="/activities/{{$activity->id}}"> {{$activity->name}} </a> 
            -> <b>participants</b>
        </div>
    </div>
    <div class="card-body">
        @if(count($activity->participants)>0)
            <table class="table table-striped">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Place</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($activity->participants as $participant)
                <tr>
                    <td class="align-middle"><a href="/participants/{{$participant->id}}"><img class="rounded-circle" style="height:30px;, width:30px" src="/storage/img/participants/images/{{$participant->image}}"></a></td>
                    <td class="align-middle" style="max-width:30%;"><a href="/participants/{{$participant->id}}">{{$participant->name}}</a></td>
                    <td class="align-middle"><a href="/participants/{{$participant->id}}">{{$participant->start_date}}</a></td>
                    <td class="align-middle"><a href="/participants/{{$participant->id}}">{{$participant->org_implementation_id}}</a></td>
                    <td class="align-middle">
                        <a class="btn btn-outline-info btn-default" href="/participants/{{$participant->id}}/edit">Edit</a>
                    </td>
                    <td class="align-middle">
                        {!!Form::open(['action'=>['ActivitiesController@destroy', $participant->id],'method'=>'POST','class'=>'pull-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </td>
                </tr>
                @endforeach
            </table>
        @else
            <p>no participants registered</p>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('participants.create',$activity->id) }}" class="btn btn-outline-primary">Create New participant</a>
    </div>
</div>