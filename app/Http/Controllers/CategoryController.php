<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function createcategory() {
        return view('admin.categories.createcategory');
    }

    public function createsubcategory() {
        $category = Category::all();
        return view('admin.categories.createsubcategory',[
            'category' =>  $category
        ]);
    }

    public function storecategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'category' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $category = new Category;
        $category->category = $request->input('category');
        $category->save();
        return redirect('/category');
    }

    public function categoryindex() {
        $category = Category::all();
        $subcategory = SubCategory::with('category')->get();
        $childcategory = ChildCategory::with('subcategory')->with('category')->get();
        return view('admin.categories.index',[
            'category' => $category,
            'subcategory' => $subcategory,
            'childcategory' => $childcategory
        ]);
    }

    public function storesubcategory(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'subcategory' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // dd($request->all());
        $subcategory = new SubCategory;
        $subcategory->cat_id = $request->input('category_id');
        $subcategory->subcategory = $request->input('subcategory');
        $subcategory->save();
        return redirect('/category');
    }

    public function createchildcategory() {
        $category = Category::all();
        return view('admin.categories.createchildcategory',[
            'category' => $category
        ]);
    }

    public function getsubcat(Request $request) {
        // return $request->cat_id;
        $data = SubCategory::where("cat_id",$request->cat_id)->get();
        return response()->json($data);
    }

    public function storechildcategory(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'childcategory' => 'required'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $childcat = new ChildCategory;
        $childcat->cat_id = $request->cat_id;
        $childcat->subcat_id = $request->subcat_id;
        $childcat->childcategory = $request->childcategory;
        $childcat->save();
        return  redirect('/category');
    }

    public function getchildcat(Request $request) {
        $childcat = ChildCategory::where('cat_id',$request->cat_id)->where('subcat_id',$request->subcat_id)->get();
        return response()->json($childcat);
    }
}