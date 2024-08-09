<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Menu;
class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        $evaluats = Evaluation::all()->where('user_id',$request->input('id_user'));
        $var = 0;
        foreach($evaluats as $evaluat){
            if($evaluat['pid']== $request->input('id_product')){
                $diff = $request->input('evaluation') - $evaluat['evaluat'];
                $evaluat->evaluat = strip_tags($request->input('evaluation')) ;
                $evaluat->save();
                $products = Menu::all()->where('id',$request->input('id_product'));
                foreach($products as $product){
                            $product->evaluation = $product->evaluation + $diff;
                            $product->save();
                            
                }
                return redirect('menu');
            }
        }
        if($var==0) {
            $evaluat = new Evaluation();
            $evaluat->user_id =strip_tags($request->input('id_user'));
            $evaluat->pid = strip_tags($request->input('id_product')) ;
            $evaluat->evaluat = strip_tags($request->input('evaluation')) ;
            $evaluat->save();
            $products = Menu::all()->where('id',$request->input('id_product'));
            foreach($products as $product){
            $product->evaluation = $product->evaluation + $request->input('evaluation');
            $product->save();
            }
            return redirect('menu');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
