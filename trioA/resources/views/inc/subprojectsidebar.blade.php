<div class="sidebar ">
    <!-- User Widget -->
    <div class="widget border text-center"  style=" border-radius:15px; padding:20px; box-shadow: 3px 2px;">
        
        <!-- User Image -->
        <div class="profile-thumb">
            <img src="/storage/img/sub_projects/images/{{$sub_project->image}}" alt="" class="border rounded-circle " style="border-image-outset: 100px; width:50%; height: 150px;">
        </div>

        <!-- User Name -->
        <h3 class="text-center">{{$sub_project->name}}</h3>

        <!-- description & Goals -->
        <div  class="list-group text-left">

            <a class="list-group-item list-group-item-light list-group-item-action" data-toggle="collapse" data-target="#description" onclick="showGoals('descriptionBtn');">
                <i class="fa fa-bookmark-o"></i> Description 
                <span id="descriptionBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
            </a>
            <div id="description" class="border collapse">
                {{($sub_project->description=='')? 'no data':$sub_project->description}}
            </div>

            <a class="list-group-item list-group-item-light list-group-item-action" data-toggle="collapse" data-target="#goals" onclick="showGoals('goalsBtn');">
                <i class="fa fa-bookmark-o"></i> Goals 
                <span id="goalsBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
            </a>
            <div id="goals" class="border collapse">
                {!! ($sub_project->goals=='')? 'no data':$sub_project->goals !!}
            </div>
        </div>

        <br>
        <a href="/sub_projects/{{$sub_project->id}}/edit" class="btn btn-outline-success">Edit sub_project</a>
    </div>

    <!-- Dashboard Links -->
    <div class="widget border"  style=" border-radius:15px; margin-top:25px; margin-bottom:25px; padding:20px;  box-shadow: 3px 2px;">
        <a class="list-group-item list-group-item-light list-group-item-action" id="numbersDiv" data-toggle="collapse" data-target="#numbers" onclick="show('numbers');">
            <i class="fa fa-bookmark-o"></i> Numbers 
            <span id="numbersBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
        </a>
        <div  class="list-group collapse" id="numbers">
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Created At 
                <span class="badge badge-pill badge-primary pull-right">{{($sub_project->created_at=='')? 'not activated':$sub_project->created_at->format('M d,Y')}}</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Permissions
                <span class="badge badge-pill pull-right">12</span>
            </a>
            <a class="list-group-item list-group-item-light list-group-item-action">
                <i class="fa fa-bookmark-o"></i> Activities
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