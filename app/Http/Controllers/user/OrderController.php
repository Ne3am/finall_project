<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use App\Events\TrackingDelivery;
use App\Models\Orders;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\User;
use App\Models\Address;
use App\Models\NumOrderOfUser;
use Illuminate\Notifications\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('User/orders',['orders'=> Orders::all()->where('user_id',auth()->user()->id),
                            'address' => Address::all()->where('user_id' ,auth()->user()->id )->first()
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'component'=> 'required',
            'method'=> 'required',
            'opt_products'=>'required',
            'total_price'=>'required',
            'payment_status'=>'required',
            'user_id' => 'required'
        ]);

        if($request->input('method') == 'Balance'){

            $users = User::all()->where('email',$request->input('email'));
            foreach($users as $user){
                if($user['balance'] >=  $request->input('total_price')){
                    $order = new Orders();
                    $order->name =strip_tags($request->input('name'));
                    $order->number = strip_tags($request->input('number')) ;
                    $order->email = strip_tags($request->input('email')) ;
                    $order->component =strip_tags($request->input('component')) ;
                    $order->opt_products =strip_tags($request->input('opt_products')) ;
                    $order->total_price =strip_tags($request->input('total_price')) ;
                    $order->payment_status =strip_tags($request->input('payment_status')) ;
                    $order->method=($request->input('method'));
                    $order->user_id= $request->input('user_id');
                    $order->save();
                    /////////////////////
                    $user->balance = $user->balance - $request->input('total_price');
                    $user->save();
                    ////////////////////
                    $menu = Menu::all();
                    $product = Cart::all()->where('user_id',$request->input('user_id'));
                    foreach($product as $p){
                            $v = $p->quantity;
                            $d = Menu::all()->where('id',$p->pid);
                                foreach($d as $m){
                                        $m->quantity_sell = $m->quantity_sell + $v;
                                        $m->save();
                                        break;
                                    
                                }
                    }
                    Cart::where('user_id',$request->input('user_id'))->delete();
                    $num = NumOrderOfUser::all()->where('user_id',$request->input('user_id'));
                        $var = 0;
                        foreach($num as $n){
                                if($n->user_id == $request->input('user_id') ){
                                    $n->num_orders = $n->num_orders + 1;
                                    $n->save();
                                    $var = 1;
                                    break;
                                }
                        }
                        if($var == 0){
                            $num_order =  new NumOrderOfUser();
                            $num_order->user_id =strip_tags($request->input('user_id'));
                            $num_order->num_orders = strip_tags(1);
                            $num_order->save();
                        }
                        $user = User::all()->where('role','admin')->first();
                        $order_id = Orders::latest()->first();
                        $user->notify(new \App\Notifications\AddOrder($order_id));
                        return redirect('orders')->with('message','Your Order registerd successfully ');
                    }
        else{
            return back()->with("message", "your balance not enough.");
        }
        break;
    }}
        // No balance method
        else{
        $order = new Orders();
        $order->name =strip_tags($request->input('name'));
        $order->number = strip_tags($request->input('number')) ;
        $order->email = strip_tags($request->input('email')) ;
        $order->component =strip_tags($request->input('component')) ;
        $order->opt_products =strip_tags($request->input('opt_products')) ;
        $order->total_price =strip_tags($request->input('total_price')) ;
        $order->payment_status =strip_tags($request->input('payment_status')) ;
        $order->method=($request->input('method'));
        $order->user_id= $request->input('user_id');
        $order->save();
        $menu = Menu::all();
        $product = Cart::all()->where('user_id',$request->input('user_id'));
        foreach($product as $p){
                $v = $p->quantity;
                $d = Menu::all()->where('id',$p->pid);
                    foreach($d as $m){
                            $m->quantity_sell = $m->quantity_sell + $v;
                            $m->save();
                            break;
                        
                    }
        }
        Cart::where('user_id',$request->input('user_id'))->delete();
        $num = NumOrderOfUser::all()->where('user_id',$request->input('user_id'));
            $var = 0;
            foreach($num as $n){
                    if($n->user_id == $request->input('user_id') ){
                        $n->num_orders = $n->num_orders + 1;
                        $n->save();
                        $var = 1;
                        break;
                    }
            }
            if($var == 0){
                $num_order =  new NumOrderOfUser();
                $num_order->user_id =strip_tags($request->input('user_id'));
                $num_order->num_orders = strip_tags(1);
                $num_order->save();
            }
            $user = User::all()->where('role','admin')->first();
            $order_id = Orders::latest()->first();
            $user->notify(new \App\Notifications\AddOrder($order_id));
            // Notification::send($user, new \App\Notifications\AddOrder($order_id));

            return redirect('orders')->with('message','Your Order registerd successfully ');
    }
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
        $update_order = Orders::findOrfail($id);
        $update_order ->payment_status = strip_tags($request->input('payment_status')) ;
        $update_order ->save();
        // $user = User::all()->where('id',$update_order['user_id'] )->first();
        $user = User::all()->where('role','admin')->first();
        $user->notify(new \App\Notifications\UpdateOrder($update_order['payment_status'],$update_order['id']));
        return view('Delivery/pending',['orders'=> Orders::all()->where('payment_status','pending'),'address' => Address::all()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function MarkAsRead_all(){
        $userUnReadNotification = auth()->user()->unreadNotifications;
        if($userUnReadNotification){
            $userUnReadNotification->markAsRead();
            return back();
        }
    }
}
