<?php

namespace App\Http\Controllers;

use Request;
use App\User;
use App\City;

use App\Http\Requests;

class UserController extends Controller
{
    public function show_users() {
    	$users = User::latest()->get();
    	$cities = City::all();
    	return view('admin.show_users')->with([
    		'users' => $users,
    		'cities' => $cities,
    	]);
    }

    public function posting() {
    	$input = Request::all();
    	$user = User::find($input['id']);
    	if(isset($input['delete_btn'])) {
    		$user->delete();
    		return redirect()->back(); 
    	} elseif (isset($input['admin_btn'])) {
    		if($user->is_admin === 0) {
    			$user->is_admin = '1';
    			$user->save();
    		} elseif ($user->is_admin === 1) {
    			$user->is_admin = '2';
    			$user->save();
    		} elseif ($user->is_admin === 2) {
    			$user->is_admin = '0';
    			$user->save();
    		}
    		return redirect()->back(); 
    	}
    	 	
    }
}
