<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DetailItem;
use App\Detail;

class DetailItemController extends Controller
{
    public function store(Request $request) {
        $details = Detail::all()->toArray();
        $data = $request->toArray();
        foreach ($details as $detail) {
            if(isset($request[$detail['id']])) {
            	DetailItem::create(['item_id'   => $request['item_id'],
            						'detail_id' => $detail['id'],
            						'value'     => $request[$detail['id']]]);
            }
        }
        return view('pages.add_images')->with('item_id', $request['item_id']);
    }
}
