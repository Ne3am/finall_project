<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
class ContuctController extends Controller
{
    
    public function index()
    {
        return view('User.contuct');
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'msg'=>'required',
        ]);
        $sms = new Message();
        $sms->name =strip_tags($request->input('name'));
        $sms->number = strip_tags($request->input('number')) ;
        $sms->email = strip_tags($request->input('email')) ;
        $sms->letter=strip_tags($request->input('msg')) ;
        $sms->user_id= $request->input('user_id');
        $sms->save();
        return redirect('dashboard');
    }

    
    public function show(string $id)
    {
        
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
