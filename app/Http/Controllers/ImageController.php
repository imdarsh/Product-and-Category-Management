<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;

class ImageController extends Controller
{
    // Open Edit Page Gallery Image 
    public function editgalleryimage($id) {
        $image = Images::find($id); 
        return view('admin.editgallery',[
            'image' => $image
        ]);
    }

    // Update Gallery Image
    public function updategalleryimage(Request $request,$id) {
        $image = Images::find($id);
        $image_path = $request->file('image')->store('image','public');
        $image->image = $image_path;
        $image->update();
        return redirect()->back();
    }

    // Delete Gallery Image
    public function deletegalleryimage(Request $request, $id) {
        $image = Images::find($id);
        if($image->delete()) {
            return redirect()->back();
        }
    }
}