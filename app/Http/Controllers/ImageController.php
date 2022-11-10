<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Validator;
>>>>>>> 2dda92a (Product and Category Management)
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
<<<<<<< HEAD
=======

    // Open Add Gallery Image Page
    public function addgalleryimage($id) {
        return view('admin.addgallery',[
            'product_id' => $id
        ]);
    }

    // Store Gallery Image
    public function storegalleryimage(Request $request, $id) {
        // $validator = Validator::make([
        //     'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        // ]);

        // if($validator->fails()) {
        //     return redirect()->back()->withErrors($validator->errors())->withInput();
        // }

        $image = new Images;
        if($request->file('images')) {
            foreach($request->file('images') as $imagefile) {     
                $image = new Images;
                $path = $imagefile->store('images', 'public');
                $image->image = $path;
                $image->product_id = $id;
                $image->save();
            }
        }
        return redirect('/products/details/'.$id);
    }
>>>>>>> 2dda92a (Product and Category Management)
}