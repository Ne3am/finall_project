<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Address;
class allOfOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin/orders',['orders'=> Orders::all(),
        'address' => Address::all()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            //echo Address::all()->groupBy('area');
        return view('Admin/orders_area',['orders'=> Orders::all(),
        'address' => Address::all()->groupBy('area')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        Orders::where('id',$id)->delete();
        return back();
    }
}
