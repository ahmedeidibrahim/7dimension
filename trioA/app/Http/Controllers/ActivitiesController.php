<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\SubProject;
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
        $sub_project = SubProject::find($sub_project_id);
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
            'activity_image'=>'image|nullable|max:1999',
            'certification_image'=>'image|nullable|max:1999'
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

        //Handle File Upload
        if($request->hasFile('certification_image')){
            // Get just ext
            $extension = $request->File('certification_image')->getClientOriginalExtension();
            // fileName to store
            $certificationimageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('certification_image')->storeAs('public/img/activities/certification_images/images', $certificationimageToStore);
        } else{
            $certificationimageToStore = 'noimage.jpg';
        }

        //create activity
        $activity = new Activity();
        $activity->name = $request->input('activity_name');
        $activity->arname = $request->input('activity_arname');
        $activity->description = $request->input('activity_description');
        $activity->start_date = $request->input('activity_start_date');
        $activity->end_date = $request->input('activity_end_date');
        $activity->image = $imageToStore;
        $activity->certification_image = $certificationimageToStore;
        //Place
        $activity->organization_implementation_id = "1";
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

    public function release(Request $request, $id)
    {
        $this->validate($request , [
            'activity_open_date'=>'required',
            'activity_close_date'=>'required'
        ]);
        $activity = Activity::find($id); 
        $activity->open_date = $request->input('activity_open_date');
        $activity->close_date = $request->input('activity_close_date');
        $activity->save();
        return \Redirect::back();
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
            'activity_image'=>'image|nullable|max:1999',
            'certification_image'=>'image|nullable|max:1999'
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

        //Handle File Upload
        if($request->hasFile('certification_image')){
            // Get just ext
            $extension = $request->File('certification_image')->getClientOriginalExtension();
            // fileName to store
            $certificationimageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('certification_image')->storeAs('public/img/certification_images/images', $certificationimageToStore);
        } 

        $activity = Activity::find($id);
        $infoChanged = false;
        //Place
        //$activity->organization_implementation_id = "1";
        if($activity->start_date != $request->input('activity_start_date') & $request->input('activity_start_date') != null){
            $activity->start_date = $request->input('activity_start_date');
            $infoChanged = true;
        }
        if($activity->end_dade != $request->input('activity_end_date') & $request->input('activity_end_date') != null){
            $activity->end_date = $request->input('activity_end_date');
            $infoChanged = true;
        }
        if($activity->name != $request->input('activity_name') & $request->input('activity_name') != null){
            $activity->name = $request->input('activity_name');
            $infoChanged = true;
        }
        if($activity->arname != $request->input('activity_arname') & $request->input('activity_arname') != null){
            $activity->arname = $request->input('activity_arname');
            $infoChanged = true;
        }
        if($activity->description != $request->input('activity_description') & $request->input('activity_description') != null){
            $activity->description = $request->input('activity_description');
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
        if($request->hasFile('certification_image')){
            if($activity->certification_image != 'noimage.jpg'){
                //delete older image
                Storage::delete('public/img/activities/certification_images/'.$activity->certification_image);
            }
            $activity->certification_image = $certificationimageToStore;
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
