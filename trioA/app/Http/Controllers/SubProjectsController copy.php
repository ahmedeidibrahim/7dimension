<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\sub_project;
use App\Activity;
use App\User;

class ActivitiesController extends Controller
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
        $activities_id = app('App\Http\Controllers\PermissionsController')->getActivitiesID(Auth()->User()->id);
        $activities = Activity::whereIn('id', $activities_id)->orderBy('name','asc')->get(); 
        return view('activities.index')->with('activities',$activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sub_project_id)
    {
        $sub_project = sub_project::find($sub_project_id);
        return view('activities.create')->with(['sub_project'=>$sub_project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sub_project_id)
    {
        $this->validate($request , [
            'activity_name'=>'required',
            'activity_arname'=>'required',
            'activity_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('activity_image')){
            // Get just ext
            $extension = $request->File('activity_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('activity_image')->storeAs('public/img/activities/images', $imageToStore);
        } else{
            $imageToStore = 'noimage.jpg';
        }

        //create activity
        $activity = new Activity();
        $activity->name = $request->input('activity_name');
        $activity->arname = $request->input('activity_arname');
        $activity->description = $request->input('activity_description');
        $activity->goals = $request->input('goals-ckeditor');
        $activity->image = $imageToStore;
        $activity->sub_project_id = $sub_project_id;
        $activity->save();
        //permission
        $permission = app('App\Http\Controllers\PermissionsController')->makePermission('owner','activities',$activity->id,Auth()->User()->id);
        return redirect('/sub_projects/'.$sub_project_id)->with('success','activity added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        return view('activities.view')->with('activity',$activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id); 
        return view('activities.edit')->with('activity',$activity); 
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
            'activity_name'=>'required',
            'activity_arname'=>'required',
            'activity_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('activity_image')){
            // Get just ext
            $extension = $request->File('activity_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('activity_image')->storeAs('public/img/activities/images', $imageToStore);
        } 

        $activity = Activity::find($id);
        $infoChanged = false;
        if($activity->name != $request->input('activity_name')){
            $activity->name = $request->input('activity_name');
            $infoChanged = true;
        }
        if($activity->arname != $request->input('activity_arname')){
            $activity->arname = $request->input('activity_arname');
            $infoChanged = true;
        }
        if($request->hasFile('activity_image')){
            if($activity->image != 'noimage.jpg'){
                //delete older image
                Storage::delete('public/img/activities/images/'.$activity->image);
            }
            $activity->image = $imageToStore;
            $infoChanged = true;
        }
        if($activity->description != $request->input('activity_description')){
            $activity->description = $request->input('activity_description');
            $infoChanged = true;
        }
        if($activity->goals != $request->input('goals-ckeditor')){
            $activity->goals = $request->input('goals-ckeditor');
            $infoChanged = true;
        }

        if($infoChanged){
            $activity->save();
            return redirect('/activities/'.$activity->id)->with('success','activity updated');
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
        $activity = Activity::find($id);
        $activity->delete();
        return \Redirect::back();
    }
}
