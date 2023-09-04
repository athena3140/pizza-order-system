<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    public function list()
    {
        $pizzas = Product::select('products.*','categories.name as categoryName')
                ->when(request('search'), function ($query) {
                    $query->where('products.name', 'like',"%".request('search')."%");
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderBy('products.id','desc')->paginate(8);
        return view('admin.product.list',compact('pizzas'));
    }

    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    public function store(Request $req)
    {
        $this->productValidationCheck($req,'create');
        $data = $this->createProductToArray($req);

        $name = str_replace(' ', '', ucwords($req->name));
        $fileName = $name . '_' . uniqid() . '.' . $req->file('img')->getClientOriginalExtension();
        $req->file('img')->storeAs('public/images/products',$fileName);
        $data['image'] = $fileName;

        Product::create($data);

        return redirect()->route('products#list')->with([
            'message' => 'Product Created Succesfull !',
            'color' => '#0f5132',
            'backgroundColor' => '#d1e7dd',
            'borderColor' => '#c3e6cb'
        ]);
    }

    public function delete($id)
    {
        $img = Product::find($id)->image;
        Storage::delete('public/images/products/'.$img);

        Product::find($id)->delete();

        return redirect()->route('products#list')->with([
            'message' => 'Category Deleted.',
            'color' => '#721c24',
            'backgroundColor' => '#f8d7da',
            'borderColor' => '#f5c6cb'
        ]);
    }

    public function show($id)
    {
        $pizza = Product::select('products.*','categories.name as categoryName')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.detail',compact('pizza'));
    }

    public function edit($id)
    {
        $pizza = Product::find($id);
        $category = category::get();
        return view('admin.product.edit',compact('pizza','category'));
    }

    public function update(Request $req,$id)
    {
        $req['id'] = $id;
        $this->productValidationCheck($req,'update');
        $data = $this->createProductToArray($req);


        if ($req->hasFile('img')) {
            $name = str_replace(' ', '', ucwords($req->name));
            $fileName = $name . '_' . uniqid() . '.' . $req->file('img')->getClientOriginalExtension();
            $oldImg = Product::find($id)->image;
            if($oldImg != null) {
                Storage::delete('public/images/products/'.$oldImg);
            }
            $req->file('img')->storeAs('public/images/products',$fileName);
            $data['image'] = $fileName;
        }

        Product::where('id',$id)->update($data);
        return redirect()->route('products#list')->with([
            'message' => 'Product Updated Succesful!',
            'color' => '#1b1e21',
            'backgroundColor' => '#d6d8d9',
            'borderColor' => '#c6c8ca'
        ]);
    }




    // {{{  ==( PRIVATE FUNCTION )==   }}}

    private function productValidationCheck(Request $req,$action)
    {
        $validationRules = [
            'name' => 'required|unique:products,name,'.$req->id,
            'img' => 'required|mimes:jpg,jpeg,png,gif,webp,svg',
            'category' => 'required|not_in:default',
            'description' => 'required',
            'price' => 'required|integer',
            'waitingTime' => 'required',
        ];

        if ($action == 'update') {
            $validationRules['img'] = 'mimes:jpg,jpeg,png,gif,webp,svg';
        }
        Validator::make($req->all(),$validationRules)->validate();
    }

    private function createProductToArray(Request $req)
    {
        return [
            'name' => $req->name,
            'category_id' => $req->category,
            'description' => $req->description,
            'price' => $req->price,
            'waiting_time' => $req->waitingTime,
        ];
    }
}
