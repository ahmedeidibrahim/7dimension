<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Program;
use App\Project;
use App\SubProject;
use App\Activity;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //methods
    public function makePermission($permission_type,$table_name,$object_id,$user_id)
    {
        //create permission
        $permission =new Permission();
        $permission->permission_type = $permission_type;
        $permission->table_name = $table_name;
        $permission->object_id = $object_id;
        $permission->user_id = $user_id;
        $permission->save();
        return $permission;
    }

    public function getProgramsID($user_id)
    {
        $activities_id = $this->getAuthorizedObjectsID('activities',$user_id);
        $activity_model = new Activity;
        $sub_projects_id = $this->getAuthorizedObjectsIDFromDown($activity_model,'sub_projects',$activities_id,'sub_project_id',$user_id);

        $sub_project_model = new SubProject;
        $projects_id = $this->getAuthorizedObjectsIDFromDown($sub_project_model,'projects',$sub_projects_id,'project_id',$user_id);

        $project_model = new Project;
        $programs_id = $this->getAuthorizedObjectsIDFromDown($project_model,'programs',$projects_id,'program_id',$user_id);
        
        return $programs_id;
    }

    public function getProjectsID($user_id)
    {
        $activities_id = $this->getAuthorizedObjectsID('activities',$user_id);
        $activity_model = new Activity;
        $sub_projects_id = $this->getAuthorizedObjectsIDFromDown($activity_model,'sub_projects',$activities_id,'sub_project_id',$user_id);

        $sub_project_model = new SubProject;
        $projects_id1 = $this->getAuthorizedObjectsIDFromDown($sub_project_model,'projects',$sub_projects_id,'project_id',$user_id);

        $programs_id = $this->getAuthorizedObjectsID('programs',$user_id);
        $projects_id2 = Project::whereIn('id', $programs_id)->pluck('id');
        
        return $projects_id1->concat($projects_id2);;
    }

    public function getAuthorizedObjectsID($table_name,$user_id)
    {
        return Permission::where('table_name',$table_name)->where('user_id',$user_id)->pluck('object_id');
    }

    public function getAuthorizedObjectsIDFromDown($model,$table_name,$childs_id,$pluck_col,$user_id)
    {
        $objects_id1 = $model::whereIn('id', $childs_id)->pluck($pluck_col);
        $objects_id2 = $this->getAuthorizedObjectsID($table_name,$user_id);
        return $objects_id1->concat($objects_id2);
    }
}
