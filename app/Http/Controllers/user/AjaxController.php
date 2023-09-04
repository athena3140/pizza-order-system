<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // public function list(Request $req)
    // {
    //     $data = Product::orderBy('id',$req->status)->get();
    //     return $data;
    // }

    public function filter($id)
    {
        $data = Product::where('category_id',$id)->get();
        if ($data->isEmpty()) {
            return 0;
        }
        return $data;
    }

    public function cart(Request $req)
    {
        $data = $req->all();
        Cart::create($data);

        return response()->json(['message' => 'Item successfully added to cart.'],200);
    }

    public function order(Request $req)
    {
        $total = 5;
        $data = $req->all();
        foreach ($data as $data) {
            $dbData = OrderList::create($data);
            $total += $dbData->total;
        }

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $dbData->order_code,
            'total_price' => $total,
        ]);

        Cart::where('user_id',Auth::user()->id)->delete();

        return response()->json(['message' => 'Thank you for your order! It has been received and is being processed.'],200);
    }

    public function cartClear()
    {
        Cart::where('user_id', Auth::user()->id)->delete();

        return response()->json(['message' => 'Cart Cleared'],200);
    }

    public function cartProductClear($id)
    {
        Cart::where('user_id',Auth::user()->id)->where('id',$id)->delete();
        return response()->json(['message' =>  'Item Removed'],200);
    }



    // {{== Admin Admin Admin Admin Admin Admin Admin==}}
    public function statusSort($status)
    {
        $query = Order::select('orders.*', 'users.name as user_name')
        ->orderBy('id', 'desc')
        ->leftJoin('users', 'users.id', 'orders.user_id');
        if ($status != "default") {
            $query->where('status', $status);
        }
        $data = $query->get();
        return response()->json($data, JsonResponse::HTTP_OK);
    }

    public function updateOrderStatus($id,$status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return response()->json(['message' => 'Order status changed.'], 200);
    }

    public function sortList($sort)
    {
        $data = User::where('role', $sort)->get();
        return response()->json($data, 200);
    }

    public function viewcount(Request $req)
    {
        $product = Product::where('id',$req->id)->first();
        $product->increment('view_count');
    }

    public function contact(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:5'
        ]);

        Contact::create($validatedData);
        return response()->json(null,200);
    }
}
