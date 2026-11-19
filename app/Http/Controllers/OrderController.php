<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderEditRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class OrderController extends Controller
{
    public function orderadd(OrderRequest $request){
        $order = new Order();
        $order->user_id = Auth::id();
        $order->name = $request->name;
        $order->event = $request->event;
        $order->date = $request->date;
        $order->oplata = $request->oplata;
        $order->save();
        return response()->json(["id"=>$order->id]);
    }
    public function orderUser(){
        return ["orders"=>Order::where("user_id", Auth::id())->get()];
    }
}
