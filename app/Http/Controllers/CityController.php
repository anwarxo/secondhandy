<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    public function create() {
    	return view('admin.add_city');
    }

    public function store(Request $request) {
    	$this->validate($request, ['name' => 'required|unique:cities|alpha']);
    	City::create($request->all());
    	session()->flash('flash_message', 'The city "' . $request->name . '" has been added successfully!');
    	return redirect()->back();
    }

}
