<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Images;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    
    // List Products
    public function index() {
        $products = Product::all();
        // dd($products->category->category);
        return view('admin.index',[
            'products' => $products
        ]);
    }

    // Product Detail Page
    public function detail($id) {
        $product = Product::find($id);
        $images = Images::where('product_id',$product->id)->get();
        return view('admin.detail',[
            'product' => $product,
            'images' => $images
        ]);
    }

    // Open Add Product Page
    public function create() {
        $category = Category::all();
        return view('admin.create',[
            'category'  => $category
        ]);
    }

    // Store Product
    public function store(Request $request) {
        // Validation for store method
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:40',
            'product_category' => 'required',
            'product_subcategory' => 'required',
            'product_childcategory' => 'required',
            'product_description' => 'required',
            'product_colors' => 'required|alpha',
            'product_price' => 'required|numeric',
            'discounted_price' => 'lte:product_price|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }   

        $product = new Product;
        $image_path = $request->file('image')->store('image','public');
        $product->product_name = $request->input('product_name');
        $product->product_category = $request->input('product_category');
        $product->product_subcategory = $request->input('product_subcategory');
        $product->product_childcategory = $request->input('product_childcategory');
        $product->product_description = $request->input('product_description');
        $product->product_colors = $request->input('product_colors');
        $product->product_price = $request->input('product_price');
        $product->discounted_price = $request->input('discounted_price');
        $product->image = $image_path;
        $product->save();
        if($request->file('images')) {
            foreach($request->file('images') as $imagefile) {     
                $image = new Images;
                $path = $imagefile->store('images', 'public');
                $image->image = $path;
                $image->product_id = $product->id;
                $image->save();
            }
        }
        return redirect('/');
    }

    // Open Edit Product Page
    public function edit($id) {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.edit',[
            'product' =>  $product,
            'category' => $category
        ]);
    }

    // Update Product
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:40',
            'product_category' => 'required',
            'product_subcategory' => 'required',
            'product_childcategory' => 'required',
            'product_description' => 'required',
            'product_colors' => 'required|alpha',
            'product_price' => 'required|numeric',
            'discounted_price' => 'lte:product_price|numeric',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        $product = Product::find($id);
        if($request->file('image')){
            $image_path = $request->file('image')->store('image','public');
            $product->image = $image_path;
        }
        $product->product_name = $request->input('product_name');
        $product->product_category = $request->input('product_category');
        $product->product_subcategory = $request->input('product_subcategory');
        $product->product_childcategory = $request->input('product_childcategory');
        $product->product_description = $request->input('product_description');
        $product->product_colors = $request->input('product_colors');
        $product->product_price = $request->input('product_price');
        $product->discounted_price = $request->input('discounted_price');
        
        $product->update();
        return redirect('/');        
    }

    // Delete Product
    public function destroy($id) {
        $product =  Product::find($id);
        if($product->delete()) {
            return redirect('/');
        }
    }
}