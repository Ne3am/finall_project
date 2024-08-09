<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Notifications\Notification;

class ProductController extends Controller
{
    
    public function index()
    {
        
        return view('Admin.products' , [
            'products' => Menu::all()
        ]);
    }


    public function create()
    {
        return view('Admin.products');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'component'=>'required',
            'image'=>'required',
            'gluten' => 'required',
            'calories' => 'required',
            'Vegetarian' => 'required' ,
            'Kidney_friendly' => 'required' ,
            'Carbohydrate' => 'required' ,
            'quantity_Carbohydrate' => 'required'
        ]);
        $newImageName = $request->name . '.' . 'png';
        $request->image->move(public_path('images'),$newImageName);
        $product = new Menu();
        $product->name =strip_tags($request->input('name'));
        $product->price = strip_tags($request->input('price')) ;
        $product->category = strip_tags($request->input('category')) ;
        $product->image = strip_tags('images/'.$newImageName) ;
        $product->component=strip_tags($request->input('component')) ;
        $product->calories=strip_tags($request->input('calories')) ;
        $product->gluten =strip_tags($request->input('gluten')) ;
        $product->quantity_Carbohydrate =strip_tags($request->input('quantity_Carbohydrate')) ;
        $product->Kidney_friendly =strip_tags($request->input('Kidney_friendly')) ;
        $product->Vegetarian =strip_tags($request->input('Vegetarian')) ;
        $product->Carbohydrate =strip_tags($request->input('Carbohydrate')) ;
        
        $product->save();

            $user = User::all()->where('role','user');
            $product = Menu::latest()->first();
            $user->notify(new \App\Notifications\AddProduct($product['name']));

        return redirect('products');
    }

    public function show(string $id)
    {
        return view('User.quick_view', [
            'product' => Menu::findOrfail($id)
        ]);
    }

    
    public function edit(string $id)
    {
        return view('Admin.update-product', [
            'product' => Menu::findOrfail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {    
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'component'=>'required',
        ]);
        $newImageName = $request->name . '.' . 'png';
        $update_product = Menu::findOrfail($id);
        $update_product ->name =strip_tags($request->input('name'));
        $update_product ->price = strip_tags($request->input('price')) ;
        $update_product ->category = strip_tags($request->input('category')) ;
        $update_product ->image = strip_tags($newImageName) ;
        $update_product ->component=strip_tags($request->input('component')) ;
        $update_product ->save();
        return redirect()->route('products.index');
    }
    public function destroy(string $id)
    {
        Menu::where('id',$id)->delete();
        return redirect('Admin-home');
    }
}
