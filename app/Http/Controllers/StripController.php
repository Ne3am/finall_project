<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripController extends Controller
{
    public function index(){
                
        return view('strip.index');
    }

    public function checkout(){

                \Stripe\Stripe::setApiKey(config('stripe.sk'));
                $session = \Stripe\Checkout\Session::create([
                            
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'USD',
                            'product_data' => [
                                'name' => 'send me money',
                            ],
                            'unit_amount'  => 580 , 
                            ],
                            'quantity' => 1 ,
                        ],
                    ],
                    'mode' => 'payment',
                   // 'success_url'=> route('success'),
                    //'cancel_url' => route('success')
                        
                ]);
                return reddirect()->away($session->url);
    }

    public function success(){
        return view('strip.index');
    }

}
