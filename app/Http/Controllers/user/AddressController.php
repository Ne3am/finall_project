<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Address;
class AddressController extends Controller
{
    
    public function index()
    {
        $address = Address::all()->where('user_id',auth()->user()->id);
            return view('User.update_address',[
                'address' => Address::all()->where('user_id',auth()->user()->id)
            ]);
        
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        // $request->validate([
        //     'lang' => 'required',
        //     'lati' => 'required',
        //     'langForRest' => 'required',
        //     'latiForRest'=>'required',
        // ]);
        $address = Address::all()->where('user_id',$request->input('id_user'));
        if(isset($address)){
            
            Address::where('user_id',$request->input('id_user'))->delete();
            
            $addr = new Address();
        $addr->user_id =strip_tags($request->input('id_user'));
        $addr->area = strip_tags($request->input('area'))  ;
        $addr->street = strip_tags($request->input('street')) ;
        $addr->building = strip_tags($request->input('building')) ;
        $addr->flat =strip_tags($request->input('flat')) ;
        $addr->longitude=strip_tags($request->input('lang')) ;//Crypt::encryptString(10) ;
        $addr->latitude =strip_tags($request->input('lati')) ;
        $addr->longitudeForRest =  strip_tags($request->input('langForRest')) ;
        $addr->latitudeForRest = strip_tags($request->input('latiForRest')) ;
        $addr->save();
        return redirect('checkout');
        }else{
            
            $addr = new Address();
        $addr->user_id =strip_tags($request->input('id_user'));
        $addr->area = Crypt::encryptString(strip_tags($request->input('area'))) ;
        $addr->street = strip_tags($request->input('street')) ;
        $addr->building = strip_tags($request->input('building')) ;
        $addr->flat =strip_tags($request->input('flat')) ;
        $addr->longitude=strip_tags($request->input('lang')) ;// Crypt::encryptString(10) ;
        $addr->latitude =strip_tags($request->input('lati')) ;
        $addr->longitudeForRest = strip_tags($request->input('langForRest')) ;
        $addr->latitudeForRest = strip_tags($request->input('latiForRest')) ; 
        $addr->distance = '10' ;//strip_tags($request->input('distance')) ; ;
        $addr->cost = '0' ;
        $addr->save();
        return redirect('checkout');
        }
    }

    public function show(string $id)
    {
        return view('Admin.location' , [
            'address' => Address::get()->where('user_id',$id)->first()
        ]);
    }

    
    public function edit(string $id)
    { 

    }

    
    public function update(Request $request, string $id)
    {
        
    }

    
    public function destroy(string $id)
    {
        
    }
}
