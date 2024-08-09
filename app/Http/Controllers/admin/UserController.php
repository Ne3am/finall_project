<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NumOrderOfUser;
class UserController extends Controller
{
    
    public function index()
    {
        return view('Admin.users' , [
            'users' => User::all()->where('role','user'),
            'numOfOrders' => NumOrderOfUser::all() 
            ]);
    }
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    
    public function show(string $id)
    {
        
    }

    
    public function edit(string $id)
    {
        return view('Admin.update_user', [
            'user' => User::findOrfail($id)
        ]);
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'balance' => 'required',
        ]);
        $update_balance = User::findOrfail($id);
        $update_balance ->balance = strip_tags($request->input('balance'));
        $update_balance ->save();
        return redirect()->route('users.index');
    }

    public function destroy(string $id)
    {
        User::where('id',$id)->delete();
        return redirect('users');
    }
}
