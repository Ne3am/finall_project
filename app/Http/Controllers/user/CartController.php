<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Sale;

class CartController extends Controller
{
    
    public function index()
    {
        return view('User.cart' , [
            'carts' => Cart::all()->where('user_id',auth()->user()->id),
            'sales' => Sale::all()
        ]);
    }
    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'pid'=>'required',
            'image'=> 'required',
            'qty'=> 'required',
            'user_id' => 'required'
        ]);
        $cart = new Cart();
        $cart->name =strip_tags($request->input('name'));
        $cart->price = strip_tags($request->input('price')) ;
        $cart->quantity = strip_tags($request->input('qty')) ;
        $cart->image =strip_tags($request->input('image')) ;
        $cart->component =strip_tags($request->input('category')) ;
        $cart->user_id= $request->input('user_id');
        $cart->pid= $request->input('pid');
        $cart->save();
        return redirect('menu')->with('message','the meal is added successfully');
    }

    public function show(string $id)
    {
        return view('User.cart' , [
            'carts' => Cart::all()->where('user_id',auth()->user()->id)
        ]);
    }
    
    public function edit(string $id)
    {
        Cart::where('id',$id)->delete();
        return redirect('cart')->with('message','the meal deleted successfully ');
    }

    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'pid'=>'required',
            'image'=> 'required',
            'qty'=> 'required',
            'user_id' => 'required'
        ]);
        $cart = Cart::findOrfail($id);
        $cart->name =strip_tags($request->input('name'));
        $cart->price = strip_tags($request->input('price')) ;
        $cart->quantity = strip_tags($request->input('qty')) ;
        $cart->image =strip_tags($request->input('image')) ;
        $cart->component =strip_tags($request->input('category')) ;
        $cart->user_id= $request->input('user_id');
        $cart->pid= $request->input('pid');
        $cart->save();
        return redirect('cart')->with('message','the meal is updated successfully');
    }

    public function destroy(string $id)
    {
        Cart::where('user_id',$id)->delete();

        return redirect('cart');
    }
}
