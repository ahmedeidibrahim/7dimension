<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Project;
use App\SubProject;
use App\User;

class SubProjectsController extends Controller
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
        $sub_projects_id = app('App\Http\Controllers\PermissionsController')->getsubprojectsID(Auth()->User()->id);
        $sub_projects = SubProject::whereIn('id', $sub_projects_id)->orderBy('name','asc')->get(); 
        return view('sub_projects.index')->with('sub_projects',$sub_projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        $project = Project::find($project_id);
        return view('sub_projects.create')->with(['project'=>$project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        $this->validate($request , [
            'sub_project_name'=>'required',
            'sub_project_arname'=>'required',
            'sub_project_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('sub_project_image')){
            // Get just ext
            $extension = $request->File('sub_project_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('sub_project_image')->storeAs('public/img/sub_projects/images', $imageToStore);
        } else{
            $imageToStore = 'noimage.jpg';
        }

        //create sub_project
        $sub_project = new SubProject();
        $sub_project->name = $request->input('sub_project_name');
        $sub_project->arname = $request->input('sub_project_arname');
        $sub_project->description = $request->input('sub_project_description');
        $sub_project->goals = $request->input('goals-ckeditor');
        $sub_project->image = $imageToStore;
        $sub_project->project_id = $project_id;
        $sub_project->save();
        //permission
        $permission = app('App\Http\Controllers\PermissionsController')->makePermission('owner','sub_projects',$sub_project->id,Auth()->User()->id);
        return redirect('/projects/'.$project_id)->with('success','sub_project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_project = SubProject::find($id);
        return view('sub_projects.view')->with('sub_project',$sub_project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_project = SubProject::find($id); 
        return view('sub_projects.edit')->with('sub_project',$sub_project); 
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
            'sub_project_name'=>'required',
            'sub_project_arname'=>'required',
            'sub_project_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('sub_project_image')){
            // Get just ext
            $extension = $request->File('sub_project_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('sub_project_image')->storeAs('public/img/sub_projects/images', $imageToStore);
        } 

        $sub_project = SubProject::find($id);
        $infoChanged = false;
        if($sub_project->name != $request->input('sub_project_name')){
            $sub_project->name = $request->input('sub_project_name');
            $infoChanged = true;
        }
        if($sub_project->arname != $request->input('sub_project_arname')){
            $sub_project->arname = $request->input('sub_project_arname');
            $infoChanged = true;
        }
        if($request->hasFile('sub_project_image')){
            if($sub_project->image != 'noimage.jpg'){
                //delete older image
                Storage::delete('public/img/sub_projects/images/'.$sub_project->image);
            }
            $sub_project->image = $imageToStore;
            $infoChanged = true;
        }
        if($sub_project->description != $request->input('sub_project_description')){
            $sub_project->description = $request->input('sub_project_description');
            $infoChanged = true;
        }
        if($sub_project->goals != $request->input('goals-ckeditor')){
            $sub_project->goals = $request->input('goals-ckeditor');
            $infoChanged = true;
        }

        if($infoChanged){
            $sub_project->save();
            return redirect('/sub_projects/'.$sub_project->id)->with('success','sub_project updated');
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
        $sub_project = SubProject::find($id);
        $sub_project->delete();
        return \Redirect::back();
    }
}
