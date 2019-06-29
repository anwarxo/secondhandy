<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Detail;

class DetailController extends Controller
{
    public function create() {
        return view('admin.add_detail');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required|unique:details']);
        Detail::create($request->all());
        session()->flash('flash_message', 'The detail "' . $request->name .'" has been added successfully!');
        return redirect()->back();
    }
}
