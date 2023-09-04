<?php

namespace App\Http\Controllers\API;

use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function get()
    {
        $products = Product::get();
        return response()->json($products, 200);
    }

    public function createCategory(Request $req)
    {
        try {
            Category::create($req->all());
            return response()->json(['status' => 'Ok'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'error' => $e->getMessage()], 500);
        }
    }

    public function createContact(Request $req)
    {
        try {
            Contact::create($req->all());
            return response()->json(['status' => 'Ok'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'error' => $e->getMessage()], 500);
        }
    }

    public function deleteCategory(Request $req)
    {
        $category = Category::find($req->id);

        if ($category) {
            $category->delete();
            return response()->json(['status'=>'Ok','message' => 'Delete successful'], 200);
        } else {
            return response()->json(['status'=>'Error','message' => 'Category not found'], 404);
        }
    }

    public function categoryDetails($id)
    {
        $category = Category::find($id);

        if ($category) {
            return response()->json($category, 200);
        } else {
            return response()->json(['status'=>'Error','message' => 'Category not found'], 404);
        }
    }

    public function categoryUpdate($id,Request $req)
    {
        $category = Category::find($id);

        if ($category) {
            $category->name = $req->name;
            $category->save();
            return response()->json(['status' => 'Ok', 'message' => 'Category updated successfully'], 200);
        } else {
            return response()->json(['status'=>'Error','message' => 'Category not found'], 404);
        }
    }
}
