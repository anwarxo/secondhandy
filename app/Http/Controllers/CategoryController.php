<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function create() {
    	return view('admin.add_category');
    }

    public function store(Request $request) {
    	$this->validate($request, ['name' => 'required']);
    	Category::create($request->all());
    	session()->flash('flash_message', 'The category "' . $request->name . '" has been added successfully!');
    	return redirect()->back();
    }
}
