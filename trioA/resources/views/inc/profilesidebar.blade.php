

<div class="sidebar ">
    <!-- User Widget -->
    <div class="widget border text-center"  style=" border-radius:15px; padding:20px; box-shadow: 3px 2px;">
        <!-- User Image -->
        <div class="profile-thumb">
            <img src="/storage/img/users/{{Auth()->User()->avatar}}" alt="" class="border rounded-circle " style="border-image-outset: 100px; width:50%;">
        </div>
        <!-- User Name -->
        <h5 class="text-center">{{Auth()->User()->name}}</h5>
        <p>Joined {{Auth()->User()->created_at->format('M d,Y')}}</p>

        <!-- details -->
        <div  class="list-group text-left">

            <a class="list-group-item list-group-item-light list-group-item-action" data-toggle="collapse" data-target="#details" onclick="showGoals('detailsBtn');">
                <i class="fa fa-bookmark-o"></i> Details 
                <span id="detailsBtn" class="badge badge-pill badge-primary pull-right">show<i class="fa fa-angle-double-down"></i></span>
            </a>
            <div id="details" class="border collapse">
                <div  class="list-group">
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bookmark-o"></i> phone <span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->phone=='')? 'not added':Auth()->User()->phone}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-file-archive-o"></i>Email <span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->email=='')? 'not added':Auth()->User()->email}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> National ID<span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->national_id=='')? 'not added':Auth()->User()->national_id}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> Address<span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->address=='')? 'not added':Auth()->User()->address}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> Gender<span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->gender=='')? 'not added':Auth()->User()->gender}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> qualification<span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->qualification=='')? 'not added':Auth()->User()->qualification}}</span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> accomodation <span class="badge badge-pill badge-info pull-right"> accomodation </span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> Work place <span class="badge badge-pill badge-info pull-right"> work </span></a>
                    <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> Job<span class="badge badge-pill badge-info pull-right">{{(Auth()->User()->job=='')? 'not added':Auth()->User()->job}}</span></a>
                </div>
            </div>
        </div>
        <br>
        <a href="/edit" class="btn btn-outline-success">Edit Profile</a>
    </div>
                
    <!-- Dashboard Links -->
    <div class="widget border"  style=" border-radius:15px; margin-top:25px; margin-bottom:25px; padding:20px;  box-shadow: 3px 2px;">
        <div  class="list-group">
            <a class="list-group-item list-group-item-action" href="#">
                <i class="fa fa-user"></i> My CV
            </a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bookmark-o"></i> My Points <span class="badge badge-pill badge-primary pull-right">5</span></a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-file-archive-o"></i>Programs <span class="badge badge-pill badge-primary pull-right">2</span></a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-file-archive-o"></i>Projects <span class="badge badge-pill badge-primary pull-right">5</span></a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-file-archive-o"></i>Certified Activities <span class="badge badge-pill badge-primary pull-right">12</span></a>
            <a class="list-group-item list-group-item-action" href="#"><i class="fa fa-bolt"></i> Permissions<span class="badge badge-pill badge-primary pull-right">23</span></a>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showGoals(elementId)
    {       
        if (document.getElementById(elementId).innerHTML == 'show<i class="fa fa-angle-double-down"></i>')
        {
            document.getElementById(elementId).innerHTML = 'hide<i class="fa fa-angle-double-up"></i>';
            document.getElementById(elementId).className='badge badge-pill badge-danger pull-right';
        } else {
            document.getElementById(elementId).innerHTML = 'show<i class="fa fa-angle-double-down"></i>';
            document.getElementById(elementId).className = 'badge badge-pill badge-primary pull-right';
        }
    }
</script>