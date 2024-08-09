<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Notifications\Notification;
use App\Models\User;
class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.meal');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $products = new Menu();
        $products->name =strip_tags($request->input('name'));
        $products->price = strip_tags($request->input('price')) ;
        $products->category = strip_tags($request->input('category')) ;
        $products->image = strip_tags($request->input('image')) ;
        $products->component=strip_tags($request->input('component')) ;
        $products->calories=strip_tags($request->input('calories')) ;
        $products->gluten =strip_tags($request->input('gluten')) ;
        $products->Vegetarian =strip_tags($request->input('Vegetarian')) ;
        $products->Kidney_friendly =strip_tags($request->input('Kidney_friendly')) ;
        $products->Carbohydrate =strip_tags($request->input('Carbohydrate')) ;
        $products->quantity_Carbohydrate =strip_tags($request->input('quantity_Carbohydrate')) ;
        $products->save();

            // $user = User::all()->where('role','user');
            // $product = Menu::latest()->first();
            // $user->notify(new \App\Notifications\AddProduct($product['name']));

        return redirect('products');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
