<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;

class ImageController extends Controller
{
    public function store(Request $request) {
        $data = $request->toArray();
        for ($i = 1; $i <= 4; $i++) { 
            if(isset($data['image' . $i])) {
                $image = Image::create(['item_id' => $request->item_id]);
                $file = $request->file('image' . $i);
                $destinationPath = public_path() . '/images/item/' . $request->item_id;
                $fileName =preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($destinationPath, $fileName);
                $image->image = $fileName;
                $image->save();
            }
        }
        session()->flash('flash_message', 'Your item has been added successfully!');
        return redirect(url('/items/' . $request->item_id));
    }
}
