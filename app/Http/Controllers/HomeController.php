<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellItems = Item::where('seller_id', Auth::user()->id)->latest()->get();
        $buyItems = Item::where('buyer_id', Auth::user()->id)->latest()->get();
        return view('home')->with([
            'sellItems' => $sellItems, 
            'buyItems' => $buyItems
        ]);
    }
}
