<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
class SearchController extends Controller
{
    public function index(Request $request){
                if($request->filled('search')){
                    return view('User/search',['products' => Menu::search($request->search)->get()]);
                }else{
                    return view('User/search',['products' => Menu::get() ]);
                }
                
    }
}
