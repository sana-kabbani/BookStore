<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;


class AdminController extends Controller
{
    public function view_product()
    {
        return view('admin.product');
    }
    public function add_product(Request $request )
    {
        $product = new product;
        $product->title= $request->title;
        $product->description= $request->description;
        $product->price= $request->price;
        $product->quantity= $request->quantity;


        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();

        $request->image->move('product' ,$imagename);

        $product->image=$imagename;
        $product->save();

        return redirect()->back();


    }
    public function show_product()
    {
        $product = product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id)
    {
        $product = product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Ürün başarıyla silinmiştir');
    }
    public function update_product($id)
    {
        $product = product::find($id);
       return view('admin.update_product',compact('product'));
    }
    public function update_product_confirm(Request $request,$id)
    {
        $product = product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;

        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $image = $request->image;
        if($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('product' ,$imagename);
    
            $product->image=$imagename;
        
        }
        $product->save();
      

        return redirect()->back()->with('message','Ürün başarıyla güncellenmiştir');;

    }
    public function order()
    {
        $order = order::all();

       return view('admin.order' , compact('order'));
    }
    public function delivered($id)
    {
        $order = order::find($id);
        $order->delivery_status="delivered";
        $order->save();

        return redirect()->back();  
      }

}
