<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;




use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index(){
        $product = Product::paginate(9);
        return view('home.userpage', compact('product'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype=='1')
        {
            return view('admin.home');
        }
        else{
            $product = Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }
    public function product_details($id)
    {
        $product = Product::find($id);


        return view('home.product_details',compact('product'));
    }
    public function add_cart(Request $request ,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $product = product::find($id);
            $cart = new cart;
            $cart->name = $user->name;
            $cart->email=$user->email;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;
            $cart->price = $product->price * $request->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->product_id;

            $cart->quantity=$request->quantity;
            $cart->save();

            return redirect()->back();



        }
        else
        {
            return redirect('login');
        }


    }
    public function show_cart()
    {
        if(Auth::id())
        {
        $id=Auth::user()->id;
        $cart=Cart::where('user_id','=',$id)->get();
        return view('home.showcart',compact('cart'));
        }
        else 
        {
            return redirect('login');
        }
    }
    public function remove_cart($id)
    {
        
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order()
    {
        
        $user = Auth::user();
        $userid = $user->id;
        $data = cart::where('user_id','=' , $userid)->get();
        foreach($data as $data)
        {
            $order = new order;
            $order->name =$data->name;
            $order->email =$data->email;
            $order->user_id =$data->user_id;

            $order->product_title =$data->product_title;
            $order->price =$data->price;
            $order->quantity =$data->quantity;

            $order->product_id =$data->product_id;

            $order->image =$data->image;
            $order->product_id =$data->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status ='processing';
            $order->save();
            $cart_id= $data->id;

            $cart=Cart::find($cart_id);
            $cart->delete();

        }
        return redirect()->back();
    
    }
    public function stripe($totalprice)
    {
        
       return view('home.stripe' , compact('totalprice'));
    }
    public function stripePost(Request $request , $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Teşşekür Ederiz" 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    public function product($totalprice)
    {
        
       return view('home.all_product');
    }



}