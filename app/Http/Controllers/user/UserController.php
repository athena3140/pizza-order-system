<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $pizzas = Product::orderBy('id','desc')->paginate(9);
        $category = Category::withCount('products')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $pizzaCount = count(Product::get());
        $orderCount = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','cart','pizzaCount','orderCount'));
    }

    public function profile()
    {
        return view('user.account.profile');
    }
    public function edit()
    {
        return view('user.account.edit');
    }
    public function changePassword()
    {
        return view('user.account.changePassword');
    }
    public function updatePassword(Request $req)
    {
        $id = Auth::user()->id;
        $dbPassword = User::select('password')->where('id',$id)->first()->password; // Hash Value
        $this->passwordValidationCheck($req);

        if (Hash::check($req->oldPassword, $dbPassword)) {
            User::where('id',$id)->update([
                'password' => Hash::make($req->newPassword)
            ]);

            return back()->with(['passChangeSuccess' => 'Your password was successfully changed.']);
        } else {
            return back()->with(['status'=>'Your old password does not match our records. Please try again.']);
        }
    }
    // update profile {{{{  post method  }}}}
    public function update(Request $req)
    {
        $id = Auth::user()->id;
        $this->accountValidation($req);
        $data = $this->getUserData($req);

        if($req->hasFile('img')) {
            $fileName = Auth::user()->name."_".uniqid().'.'.$req->file('img')->getClientOriginalExtension();
            $oldImg = User::where('id',$id)->first()->image;

            if($oldImg != null) {
                Storage::delete('public/images/profiles/'.$oldImg);
            }

            $req->file('img')->storeAs('public/images/profiles',$fileName);
            $data['image'] = $fileName;
        }


        User::where('id',$id)->update($data);
        return redirect()->route('user#profile')->with([
            'message' => 'Profile Updated Succesful!',
            'color' => '#1b1e21',
            'backgroundColor' => '#d6d8d9',
            'borderColor' => '#c6c8ca'
        ]);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        $pizzas = Product::get();
        return view('user.main.detail',compact('product','pizzas'));
    }

    public function cart()
    {
        $total = 0;
        $carts = Cart::select('carts.*','products.name as pizzaName','products.image as pizzaImg','products.price as pizzaPrice')
                ->leftJoin('products','products.id','carts.product_id')
                ->where('user_id',Auth::user()->id)->get();
        // dd($carts->toArray());
        foreach ($carts as $c) {
            $total += $c->pizzaPrice *  $c->qty;
        };
        return view('user.main.cart',compact('carts','total'));
    }

    public function history()
    {
        $lists = Order::orderBy('id','desc')->where('user_id',Auth::user()->id)->get();
        return view('user.main.history',compact('lists'));
    }

    public function contact()
    {
        return view('user.main.contact');
    }




    // {{{  ==( PRIVATE FUNCTION )==   }}}

    // password Validation
    private function passwordValidationCheck($req)
    {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:255|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
            'confirmPassword' => 'required|same:newPassword',
        ];

        $validationMessages = [
            'newPassword.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ];

        Validator::make($req->all(),$validationRules,$validationMessages)->validate();
    }

    // request data to array
    private function getUserData(Request $req)
    {
        return [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'gender' => $req->gender,
            'address' => $req->address,
        ];
    }

    // account update validation
    private function accountValidation(Request $req)
    {
        $validationRules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required|not_in:default',
            'img' => 'mimes:jpg,jpeg,png,gif,webp,svg',
            'address' => 'required'
        ];

        Validator::make($req->all(),$validationRules)->validate();
    }
}
