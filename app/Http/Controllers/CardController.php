<?php

namespace App\Http\Controllers;

use App\Mail\SentMail;
use App\Models\Order;
use App\Models\Products;
use App\Models\Province;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;



class CardController extends Controller
{
    public function add_cart (Request $request){
       $product_id = $request->input('product_id');
    $product_qty = $request->input('product_qty');
       if(is_null(Session::get('cart')))
       {
         Session::put('cart',[
            $product_id => $product_qty
        ]);
         return redirect('/cart');
       }
       else{
        $cart = Session::get('cart');
        if(array_key_exists($product_id, $cart)){
            $cart[$product_id] += $product_qty;
            Session::put('cart', $cart);
            return redirect('/cart');
        } else {
            $cart[$product_id] = $product_qty;
            Session::put('cart', $cart);
            return redirect('/cart');
       }
        }
    }
    public function show_cart(){
        $cart = Session::get('cart');
        $product_id = array_keys($cart);
        $products = Products::whereIn('id', $product_id)->get();
        $provinces = Province::all();
        return view('cart', compact('products', 'provinces'));
    }
    public function delete_cart(Request $request){
        $cart = Session::get('cart');
        $product_id = $request -> id ;
        unset($cart[$product_id]);
        Session::put('cart', $cart);
        return redirect('/cart');
    }
    public function update_cart(Request $request){
        $cart = $request -> product_id;
         Session::put('cart', $cart);
        return redirect('/cart');

    }
    public function send_order(Request $request){
       
        $token = Str::random(12);
        $order = new Order;
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->city = $request->input('city'); 
        $order->district = $request->input('district');
        $order->ward = $request->input('ward');
        $order->address = $request->input('address');
        $order->note = $request->input('note');
        $order_detail = json_encode($request->input('product_id')) ;
        $order-> order_detail = $order_detail;
        $order->token = $token;
        $order->save();
       Session::forget('cart');
        $mailinfor = $order->email;
        $nameinfor = $order->name;
        $mail = Mail::to($mailinfor) -> send(new SentMail($nameinfor));
        Notification::send($order, new EmailNotification( $order));
        return redirect('order/confirm');
       

    }
}
