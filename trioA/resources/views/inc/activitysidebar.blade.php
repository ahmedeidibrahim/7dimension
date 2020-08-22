<div class="sidebar ">
    <!-- User Widget -->
    <div class="widget border text-center"  style=" border-radius:15px; padding:20px; box-shadow: 3px 2px;">
        
        <!-- User Image -->
        <div class="profile-thumb">
            <img src="/storage/img/activities/images/{{$activity->image}}" alt="" class="border rounded-circle " style="border-image-outset: 100px; width:50%; height: 150px;">
        </div>

        <!-- User Name -->
        <h3 class="text-center">{{$activity->name}}</h3>
        <h5 class="text-center">place : </h5>
        <p>{{$activity->start_date}}</p>
        <!-- description -->
        <div  class="list-group text-left">

            <a class="list-group-item list-group-item-light list-group-item-action" id="descriptionDiv" data-toggle="collapse" data-target="#description" onclick="show('description');">
                <i class="fa fa-bookmark-o"></i> Description 
                <span id="descriptionBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
            </a>
            <div id="description" class="border collapse">
                <h5>{{($activity->description=='')? 'no data':$activity->description}}</h5>
                <p>{{$activity->start_date}} -> {{$activity->end_date}}</p>
            </div>
            <a class="list-group-item list-group-item-light list-group-item-action" id="registrationDiv" data-toggle="collapse" data-target="#registraion" onclick="show('registraion');">
                <i class="fa fa-bookmark-o"></i> Registration 
                <span id="registraionBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
            </a>
            <div id="registraion" class="border collapse">
                <a class="btn btn-outline-info btn-default pull-right"  data-toggle="modal" data-target="#releaseModal{{$activity->id}}" href="">change registration Dates</a><br><br>
                Online registration is
                @if($activity->open_date == null)
                    not defined
                @elseif($activity->open_date > now())
                    Comming
                @elseif($activity->close_date < now())
                    Closed
                @else
                    Live
                @endif 
                <br>
                open form : {{date('Y-m-d\TH:i', strtotime($activity->open_date))}}
                <br>
                close form : {{date('Y-m-d\TH:i', strtotime($activity->close_date))}}
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
            </div>
        </div>
        <br>
        <a href="/activities/{{$activity->id}}/edit" class="btn btn-outline-info">Edit activity</a>
    </div>

    <!-- Sessions -->
    <div class="widget border"  style=" border-radius:15px; margin-top:25px; margin-bottom:25px; padding:20px;  box-shadow: 3px 2px;">
        <a class="list-group-item list-group-item-light list-group-item-action" id="sessionsDiv" data-toggle="collapse" data-target="#sessions" onclick="show('sessions');">
            <i class="fa fa-bookmark-o"></i> <b>Sessions </b>
            <span id="sessionsBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
        </a>
        <div  class="list-group collapse" id="sessions">
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> session 1
                <span class="badge badge-pill badge-primary pull-right">2020-08-20 16:00:00</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> session 2
                <span class="badge badge-pill badge-primary pull-right">2020-08-20 16:00:00</span>
            </a>
        </div>
    </div>

    <!-- Crews -->
    <div class="widget border"  style=" border-radius:15px; margin-top:25px; margin-bottom:25px; padding:20px;  box-shadow: 3px 2px;">
        <a class="list-group-item list-group-item-light list-group-item-action" id="crewsDiv" data-toggle="collapse" data-target="#crews" onclick="show('crews');">
            <i class="fa fa-bookmark-o"></i> <b>Crews </b>
            <span id="crewsBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
        </a>
        <div  class="list-group collapse" id="crews">
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> crew 1
                <span class="badge badge-pill badge-primary pull-right">9</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> crew 2
                <span class="badge badge-pill badge-primary pull-right">8</span>
            </a>
        </div>
    </div>

    <!-- Numbers Links -->
    <div class="widget border"  style=" border-radius:15px; margin-top:25px; margin-bottom:25px; padding:20px;  box-shadow: 3px 2px;">
        <a class="list-group-item list-group-item-light list-group-item-action" id="numbersDiv" data-toggle="collapse" data-target="#numbers" onclick="show('numbers');">
            <i class="fa fa-bookmark-o"></i> Numbers 
            <span id="numbersBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
        </a>
        <div  class="list-group collapse" id="numbers">
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Created At 
                <span class="badge badge-pill badge-primary pull-right">{{($activity->created_at=='')? 'not activated':$activity->created_at->format('M d,Y')}}</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Permissions
                <span class="badge badge-pill pull-right">12</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Sessions
                <span class="badge badge-pill pull-right">20</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> participants
                <span class="badge badge-pill pull-right">20</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> crews
                <span class="badge badge-pill pull-right">120</span>
            </a>
        </div>
    </div>

</div>


<script type="text/javascript">
    function show(elementId)
    {      
        if (document.getElementById(elementId+'Btn').innerHTML == 'show<i class="fa fa-angle-double-down"></i>')
        {
            document.getElementById(elementId+'Btn').innerHTML = 'hide<i class="fa fa-angle-double-up"></i>';
            document.getElementById(elementId+'Btn').className='badge badge-pill badge-danger pull-right';
        } else {
            document.getElementById(elementId+'Btn').innerHTML = 'show<i class="fa fa-angle-double-down"></i>';
            document.getElementById(elementId+'Btn').className = 'badge badge-pill badge-primary pull-right';
        }
    }
</script>