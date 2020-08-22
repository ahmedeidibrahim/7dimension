<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Program;
use App\Project;
use App\User;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects_id = app('App\Http\Controllers\PermissionsController')->getProjectsID(Auth()->User()->id);
        $projects = Project::whereIn('id', $projects_id)->orderBy('name','asc')->get(); 
        return view('projects.index')->with('projects',$projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($program_id)
    {
        $program = Program::find($program_id);
        return view('projects.create')->with(['program'=>$program]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $program_id)
    {
        $this->validate($request , [
            'project_name'=>'required',
            'project_arname'=>'required',
            'project_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('project_image')){
            // Get just ext
            $extension = $request->File('project_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('project_image')->storeAs('public/img/projects/images', $imageToStore);
        } else{
            $imageToStore = 'noimage.jpg';
        }

        //create project
        $project = new project();
        $project->name = $request->input('project_name');
        $project->arname = $request->input('project_arname');
        $project->description = $request->input('project_description');
        $project->goals = $request->input('goals-ckeditor');
        $project->image = $imageToStore;
        $project->program_id = $program_id;
        $project->save();
        //permission
        $permission = app('App\Http\Controllers\PermissionsController')->makePermission('owner','projects',$project->id,Auth()->User()->id);
        return redirect('/programs/'.$program_id)->with('success','project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.view')->with('project',$project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id); 
        return view('projects.edit')->with('project',$project); 
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
        $this->validate($request , [
            'project_name'=>'required',
            'project_arname'=>'required',
            'project_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('project_image')){
            // Get just ext
            $extension = $request->File('project_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('project_image')->storeAs('public/img/projects/images', $imageToStore);
        } 

        $project = Project::find($id);
        $infoChanged = false;
        if($project->name != $request->input('project_name')){
            $project->name = $request->input('project_name');
            $infoChanged = true;
        }
        if($project->arname != $request->input('project_arname')){
            $project->arname = $request->input('project_arname');
            $infoChanged = true;
        }
        if($request->hasFile('project_image')){
            if($project->image != 'noimage.jpg'){
                //delete older image
                Storage::delete('public/img/projects/images/'.$project->image);
            }
            $project->image = $imageToStore;
            $infoChanged = true;
        }
        if($project->description != $request->input('project_description')){
            $project->description = $request->input('project_description');
            $infoChanged = true;
        }
        if($project->goals != $request->input('goals-ckeditor')){
            $project->goals = $request->input('goals-ckeditor');
            $infoChanged = true;
        }

        if($infoChanged){
            $project->save();
            return redirect('/projects/'.$project->id)->with('success','project updated');
        }
        else if(!$infoChanged){
            return \Redirect::back()->withInput()->with('error','No information to Change');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return \Redirect::back();
    }
}
