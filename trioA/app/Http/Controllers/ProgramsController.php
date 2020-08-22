<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Program;
use App\User;

class ProgramsController extends Controller
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
        $programs_id = app('App\Http\Controllers\PermissionsController')->getProgramsID(Auth()->User()->id);
        $programs = Program::whereIn('id', $programs_id)->orderBy('name','asc')->get(); 
        return view('programs.index')->with('programs',$programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'program_name'=>'required',
            'program_arname'=>'required',
            'program_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('program_image')){
            // Get just ext
            $extension = $request->File('program_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('program_image')->storeAs('public/img/programs/images', $imageToStore);
        } else{
            $imageToStore = 'noimage.jpg';
        }

        //create program
        $program = new program();
        $program->name = $request->input('program_name');
        $program->arname = $request->input('program_arname');
        $program->contract = $request->input('contract-ckeditor');
        $program->description = $request->input('program_description');
        $program->goals = $request->input('goals-ckeditor');
        $program->image = $imageToStore;
        $program->save();
        //permission
        $permission = app('App\Http\Controllers\PermissionsController')->makePermission('owner','programs',$program->id,Auth()->User()->id);
        return redirect('/programs')->with('success','program added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::find($id);
        return view('programs.view')->with('program',$program);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $program = Program::find($id); 
        return view('programs.edit')->with('program',$program); 
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
            'program_name'=>'required',
            'program_arname'=>'required',
            'program_image'=>'image|nullable|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('program_image')){
            // Get just ext
            $extension = $request->File('program_image')->getClientOriginalExtension();
            // fileName to store
            $imageToStore = Auth()->User()->id.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('program_image')->storeAs('public/img/programs/images', $imageToStore);
        } 

        $program = program::find($id);
        $infoChanged = false;
        if($program->name != $request->input('program_name')){
            $program->name = $request->input('program_name');
            $infoChanged = true;
        }
        if($program->arname != $request->input('program_arname')){
            $program->arname = $request->input('program_arname');
            $infoChanged = true;
        }
        if($request->hasFile('program_image')){
            if($program->image != 'noimage.jpg'){
                //delete older image
                Storage::delete('public/img/programs/images/'.$program->image);
            }
            $program->image = $imageToStore;
            $infoChanged = true;
        }
        if($program->arname != $request->input('program_description')){
            $program->description = $request->input('program_description');
            $infoChanged = true;
        }
        if($program->details != $request->input('contract-ckeditor')){
            $program->contract = $request->input('contract-ckeditor');
            $infoChanged = true;
        }
        if($program->details != $request->input('goals-ckeditor')){
            $program->goals = $request->input('goals-ckeditor');
            $infoChanged = true;
        }

        if($infoChanged){
            $program->save();
            return redirect('/programs')->with('success','program updated');
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
        $program = Program::find($id);
        $program->delete();
        return redirect('/programs')->with('success','Program deleted');
    }
}
