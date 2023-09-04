<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // TO Category Page
    public function list()
    {
        $categories = Category::when(request('search'), function ($query) {
            $query->where('name', 'like',"%".request('search')."%");
        })->orderBy('id','desc')->paginate(10);
        return view('admin.category.list',compact('categories'));
    }


    // TO Create Page
    public function create()
    {
        return view('admin.category.create');
    }

    // Create Category
    public function store(Request $req)
    {
        $this->categoryValidationCheck($req);//to private
        $data = $this->createDataToArray($req);// to array
        Category::create($data);
        return redirect()->route('category#list')->with([
            'message' => 'Category Created Succesfull !',
            'color' => '#0f5132',
            'backgroundColor' => '#d1e7dd',
            'borderColor' => '#c3e6cb'
        ]);
    }

    // Delete Category
    public function delete($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('category#list')->with([
            'message' => 'Products Deleted.',
            'color' => '#721c24',
            'backgroundColor' => '#f8d7da',
            'borderColor' => '#f5c6cb'
        ]);
    }

    // TO Edit Page {{== just go to edit page not update ==}}
    public function edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }


    // Update Category
    public function update(Request $req)
    {
        $this->categoryValidationCheck($req);//to private
        $data = $this->createDataToArray($req);// to array
        $id = $req->id;

        Category::where('id',$id)->update($data);
        return redirect()->route('category#list')->with([
            'message' => 'Category Updated.',
            'color' => '#856404',
            'backgroundColor' => '#fff3cd',
            'borderColor' => '#ffeeba'
        ]);
    }






    // {{{  ==( PRIVATE FUNCTION )==   }}}
    private function categoryValidationCheck($req)
    {
        Validator::make($req->all(),['categoryName' => 'required|unique:categories,name,'.$req['id']])->validate();
    }

    private function createDataToArray($req)
    {
        return ['name' => $req->categoryName];
    }
}
