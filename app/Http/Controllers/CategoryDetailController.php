<?php

namespace App\Http\Controllers;

use Request;
use App\Category;
use App\Detail;
use App\CategoryDetail;

class CategoryDetailController extends Controller
{
    public function create() {
        $categories = Category::all();
        $details = Detail::all();
        return view('admin.connect_category_detail', ['categories' => $categories, 
            'details' => $details]);
    }

    public function store() {
        CategoryDetail::create(Request::all());
        session()->flash('flash_message', 'The connection done successfully!');
        return redirect()->back();
    }
}
