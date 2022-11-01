<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;

class ImageController extends Controller
{
    public function editgalleryimage($id) {
        $image = Images::find($id); 
        return view('admin.editgallery',[
            'image' => $image
        ]);
    }

    public function updategalleryimage(Request $request,$id) {
        $image = Images::find($id);
        $image_path = $request->file('image')->store('image','public');
        $image->image = $image_path;
        $image->update();
        return redirect()->back();
    }

    //
    public function deletegalleryimage(Request $request, $id) {
        $image = Images::find($id);
        if($image->delete()) {
            return redirect()->back();
        }
    }
}