<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;

class UserManagement extends Controller
{
   	public function editProfile()
   	{
   		$user = User::findOrFail(auth()->user()->id);

   		return view('frontend.user-management.editprofile', compact('user'));
   	}

   	public function updateProfile()
   	{
   		request()->validate([
   			'name' => ['required', 'string', 'max:255'],
   			'alamat' => ['required', 'string', 'min:6']
   		]);
   		
   		$user = User::findOrFail(auth()->user()->id)->update([
   			'name' => request('name'),
   			'alamat' => request('alamat'),
   		]);

   		return redirect()->back()->with('success', 'Update Profile Successfully.');
   	}

   	public function editPassword()
   	{
   		return view('frontend.user-management.changepassword');
   	}

   	public function updatePassword()
   	{
   		request()->validate([
   			'password' => ['required', 'string', 'min:8', 'confirmed'],
   		]);

   		$user = User::findOrFail(auth()->user()->id);

   		if(\Hash::check(request('old_password'), $user->password)) {
	   		$user->update([
	   			'password' => \Hash::make(request('password')),
	   		]);
   		} else {
   			return redirect()->back()->with('error', 'The Old Password Wrong!');
   		}

   		return redirect()->back()->with('success', 'Change Password Successfully.');
   	}
}
