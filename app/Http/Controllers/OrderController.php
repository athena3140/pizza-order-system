<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::select('orders.*','users.name as user_name')
                        ->when(request('search'), function ($query) {
                            $query->where('orders.id', 'like',"%".request('search')."%")
                                  ->orWhere('orders.user_id', 'like',"%".request('search')."%")
                                  ->orWhere('orders.order_code', 'like',"%".request('search')."%")
                                  ->orWhere('orders.total_price', 'like',"%".request('search')."%")
                                  ->orWhere('users.name', 'like',"%".request('search')."%");
                        })
                        ->orderBy('id','desc')
                        ->leftJoin('users','users.id','orders.user_id')
                        ->paginate(8);
        return view('admin.order.list',compact('orders'));


    }


    public function orderIdList($orderCode)
    {
        $orders = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name' ,'products.price as product_price')
                    ->where('order_code',$orderCode)
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->get();

        $subtotal = 0;

        foreach ($orders as $o) {
            $subtotal += $o->total;
        }

        $totalPrice = Order::where('order_code', $orderCode)->value('total_price');
        return view('admin.order.orderInfo',compact('orders','totalPrice','subtotal'));
    }
}
