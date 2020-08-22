<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile',array('user'=>Auth::user()));
    }
    public function edit()
    {
        return view('auth.edit');
    }
    public function update(Request $request)
    {
        $this->validate($request , [
            'name'=>'required',
        ]);

        //Handle File Upload 
        if($request->hasFile('user_avatar')){
            // Get fileName with the extension
            $fileNameWithExt = $request->file('user_avatar')->getClientOriginalName();
            // Get just fileName
            $fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->File('user_avatar')->getClientOriginalExtension();
            // fileName to store
            $userAvatarToStore = Auth()->User()->id.'.'.$extension;//$fileName.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('user_avatar')->storeAs('public/img/users', $userAvatarToStore);
        } else{
            $userAvatarToStore = 'noimage.jpg';
        }

        $infoChanged = false;
        $validation =true;
        $user = User::find(Auth()->User()->id);
        if($user->name != $request->input('name')){
            $user->name = $request->input('name');
            $infoChanged = true;
        }
        if($user->national_id != $request->input('national_id')){
            $user->national_id = $request->input('national_id');
            $infoChanged = true;
        }
        if($user->address != $request->input('address')){
            $user->address = $request->input('address');
            $infoChanged = true;
        }
        if($userAvatarToStore != 'noimage.jpg'){
        //if($request->hasFile('user_avatar')){
            //delete older image
            if($user->avatar != 'noimage.jpg'){
                Storage::delete('public/img/users/'.$user->avatar);
            }
            $user->avatar = $userAvatarToStore;
            $infoChanged = true;
        }
        if($user->email != $request->input('email')){
            $user->email = $request->input('email');
            $infoChanged = true;
        }
        if($user->phone != $request->input('phone')){
            $user->phone = $request->input('phone');
            $infoChanged = true;
        }
        if($request->input('new_password')!=''){
            if($request->input('new_password')==$request->input('confirm_password') ){
                if(password_verify($request->input('current_password'),$user->password)){
                    $user->password = \Hash::make($request->input('new_password'));
                    $infoChanged = true;
                } else{
                    return \Redirect::back()->withInput()->with('error','current password is incorrect');
                }
            } else{
                return \Redirect::back()->withInput()->with('error','confirm your password please');
            }
        }

        if($infoChanged & $validation){
            $user->save();
            return redirect('/dashboard')->with('success','user information updated');
        }
        else if(!$infoChanged){
            return \Redirect::back()->withInput()->with('error','No information to Change');
        }
    }
}
