<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;

class EmployeesController extends Controller
{
    
    public function index()
    {   
        //return view('Admin.add_employees');

        return view('Admin.employees' , [
        'employees' => Employees::all()
        ]);
    }

    
    public function create()
    {
        return view('Admin.add_employees');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'number'=>'required',
            'address'=>'required',
            'role'=>'required',
            'img'=>'required'
        ]);
        
        $newImageName = $request->name . '.' . 'png';
        $request->img->move(public_path('images'),$newImageName);
        $emp = new Employees();
        $emp->name =strip_tags($request->input('name'));
        $emp->email = strip_tags($request->input('email')) ;
        $emp->password = strip_tags($request->input('password')) ;
        $emp->number = strip_tags($request->input('number')) ;
        $emp->address = strip_tags($request->input('address')) ;
        $emp->role = strip_tags($request->input('role')) ;
        $emp->img = strip_tags($newImageName) ;
        $emp->save();
        //تسجيل حساب للموظف ضمن جدول المستخدمين في حال كان ديليفيري
        if($request->input('role') == 'delivery'){

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'number'=>['required'],
                'role'=>['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                //'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'number' =>  $request->number,
                'role' =>  $request->role,
                'password' => Hash::make($request->password),
            ]);

        }
        return redirect('admins');
    }
    public function show(string $id)
    {
    
    }

    
    public function edit(string $id)
    {
        return view('Admin.update_employee', [
            'employee' => Employees::findOrfail($id)
        ]);
    }
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required|integer',
            'email' => 'required',
            'address'=>'required',
            'role' => 'required'
        ]);
        $newImageName = $request->name . '.' . 'png';
        $update_employee = Employees::findOrfail($id);
        $update_employee ->name =strip_tags($request->input('name'));
        $update_employee ->number = strip_tags($request->input('number')) ;
        $update_employee ->email = strip_tags($request->input('email')) ;
        $update_employee ->address = strip_tags($request->input('address')) ;
        $update_employee ->img = strip_tags($newImageName) ;
        $update_employee ->role =strip_tags($request->input('role')) ;
        $update_employee ->save();
        return redirect()->route('admins.index');
    }
    
    public function destroy(string $id)
    {
        Employees::where('id',$id)->delete();
        return redirect('admins');
    }
}
