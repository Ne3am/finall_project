<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\NumOrderOfUser;
use App\Models\Evaluation;
use App\Models\Menu;

class insure_mealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.insure');
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
        $orders = Orders::all();
        $orders_monthly = [];
        foreach($orders as $order){
            if(strtotime(date('Y-m',strtotime($order['created_at']))) ==
            strtotime(date('Y-m',strtotime($request->input('date'))))){
                        $orders_monthly[] = $order;
            }
        }
        
        return view('Admin/Profits', [
            'orders' => Orders::get(),
            'users' => NumOrderOfUser::orderBy('num_orders','DESC')->get(),
            'menu' => Menu::all(),
            'eva_fast' => Menu::all()->where('category','fast food'),
            'eva_main' => Menu::all()->where('category','main dish'),
            'eva_drink' => Menu::all()->where('category','drinks'),
            'eva_dessert' => Menu::all()->where('category','desserts'),
            'orders_dialy' => '&',
            'orders_monthly' => $orders_monthly
        ]);
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
