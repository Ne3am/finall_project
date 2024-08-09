<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Address;
class DeliveryController extends Controller
{
    public function active()
    {
        return view('Delivery/active',['orders'=> Orders::all()->where('payment_status','active'),
        'address' => Address::all()
    ]);
    }
    public function completed()
    {
        return view('Delivery/completed',['orders'=> Orders::all()->where('payment_status','completed'),'address' => Address::all()]);
    }
    public function pending()
    {
        return view('Delivery/pending',['orders'=> Orders::all()->where('payment_status','pending'),'address' => Address::all()]);
    }
    public function Area()
    {
        return view('Delivery/Area',['orders'=> Orders::all()->where('payment_status','pending'),
        'address' => Address::all()->groupBy('area')]);
    }

}
