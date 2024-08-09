<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class SocialiteController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->stateless()->redirect();     
    }
    public function handleCallback(){
        try{
                    $user_t = Socialite::driver('google')->stateless()->user();
                    $finduser = User::where('social_id',$user_t->id)->first();
                    if($finduser){
                        Auth::login($finduser);
                        return redirect('menu');
                    }else{
                        $newUser = User::create([
                            'name' => $user_t->name,
                            'email' => $user_t->email,
                            'number' => '0994092466',
                            'role' => 'user',
                            'social_id' => $user_t->id,
                            'social_type' => 'google',
                            'password' => 'my-google',
                        ]);
                        Auth::login($newUser);
                        return redirect('menu');
                    }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

}

