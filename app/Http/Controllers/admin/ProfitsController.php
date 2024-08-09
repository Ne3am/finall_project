<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\NumOrderOfUser;
use App\Models\Evaluation;
use App\Models\Menu;
class ProfitsController extends Controller
{
    
    public function index()
    {

        return view('Admin/Profits', [
            'orders' => Orders::get(),
            'users' => NumOrderOfUser::orderBy('num_orders','DESC')->get(),
            'menu' => Menu::all(),
            'eva_fast' => Menu::all()->where('category','fast food'),
            'eva_main' => Menu::all()->where('category','main dish'),
            'eva_drink' => Menu::all()->where('category','drinks'),
            'eva_dessert' => Menu::all()->where('category','desserts'),
            'orders_dialy' => '&',
            'orders_monthly' => '&'
        ]);
    }
    
    public function create()
    {
        return view('Admin/dialy_reports', [
            'orders' => Orders::get()
        ]);
    }
    
    public function store(Request $request)
    {
        return view('Admin/Profits', [
            'orders' => Orders::get(),
            'users' => NumOrderOfUser::orderBy('num_orders','DESC')->get(),
            'menu' => Menu::all(),
            'eva_fast' => Menu::all()->where('category','fast food'),
            'eva_main' => Menu::all()->where('category','main dish'),
            'eva_drink' => Menu::all()->where('category','drinks'),
            'eva_dessert' => Menu::all()->where('category','desserts'),
            'orders_dialy' => Orders::all()->where('created_at',$request->input('date')),
            'orders_monthly' => '&'
        ]);
    }
    
    public function show(string $id)
    {
        return view('Admin/monthly_reports', [
            'orders' => Orders::get()
        ]);
    }
    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function destroy(string $id)
    {
        //
    }
}
