<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Item;
use App\CategoryDetail;
use App\Detail;
use App\DetailItem;
use App\User;
use App\City;

class ItemController extends Controller
{
    public function index() {
        $items = Item::where('is_sold', '0')->latest()->get();
        $categories = Category::all();
        $cities = City::all();
        return view('welcome')->with([
            'items' => $items, 
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    // public function search_category(Request $request) {
    //     $items = Item::where(['is_sold' => '0', 'category_id' => $request->category_id])->latest()->get();
    //     $categories = Category::all();
    //     $cities = City::all();
    //     return view('welcome')->with([
    //         'items' => $items, 
    //         'categories' => $categories,
    //         'cities' => $cities
    //     ]);
    // }

    public function search(Request $request) {
        if($request->category_id == 'all'  && $request->city_id != 'all') {
            $sql = 'select * FROM items where 
            is_sold = 0 and 
            seller_id in (select id from users where city_id = ' . $request->city_id . ') ORDER BY created_at DESC;';
        } elseif($request->category_id != 'all'  && $request->city_id == 'all') {
            $sql = 'select * FROM items where 
            is_sold = 0 and 
            category_id = ' . $request->category_id . ' ORDER BY created_at DESC;';
        } elseif($request->category_id == 'all'  && $request->city_id == 'all') {
            $sql = 'select * FROM items where 
            is_sold = 0 ORDER BY created_at DESC';
        } else {
            $sql = 'select * FROM items where 
            is_sold = 0 and 
            seller_id in (select id from users where city_id = ' . $request->city_id . ') and 
            category_id = ' . $request->category_id . ' ORDER BY created_at DESC;';
        }
        $result = DB::select($sql);
        $items = Item::hydrate($result);
        $categories = Category::all();
        $cities = City::all();
        return view('welcome')->with([
            'items' => $items, 
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function create() {
        $categories = Category::all();
    	return view('pages.add_item')->with('categories', $categories);
    }

    public function delete(Request $request) {
        $item = Item::where('id', $request->item_id);
        $item->delete();
        session()->flash('flash_message', 'You have deleted this item successfully!');
        return redirect(url('/home'));
    } 

    public function store(Request $request) {
    	$this->validate($request, [
            'name'  => 'required', 
            'price' => 'numeric|required', 
            'image' => 'required'
        ]);
        $item = Item::create([
            'seller_id'   => $request->user()->id, 
            'is_sold'     => 0, 
            'name'        => $request->name, 
            'price'       => $request->price, 
            'description' => $request->description, 
            'category_id' => $request->category_id
        ]);
        $file = $request->file('image');
        $destinationPath = public_path() . '/images/item';
        $fileName = $item->id . "_" . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->move($destinationPath, $fileName);
        $item->image = $fileName;
        $item->save();
        $details = Detail::all();
        $cat_dets = CategoryDetail::where('category_id', $item->category_id)->get();
        return view('pages.add_detail_item')->with(['cat_dets' => $cat_dets, 
            'details' => $details, 
            'item' => $item]);

    }

    public function show($id) {
        $item = Item::where('id', $id)->first();
        $details = Detail::all();
        $detail_items = DetailItem::where('item_id', $id)->get();
        $seller = User::where('id', $item->seller_id)->first();
        return view('pages.show_item')->with([
            'item'         => $item,
            'details'      => $details, 
            'detail_items' => $detail_items, 
            'seller'       => $seller
        ]);
    }

    public function buy($id, Request $request) {
        $item = Item::where('id', $id)->first();
        $item->is_sold = 1;
        $item->buyer_id = $request->user()->id;
        $item->save();
        session()->flash('flash_message', 'You have bought this item successfully!');
        return redirect(url('/items/' . $id));
    }
}
