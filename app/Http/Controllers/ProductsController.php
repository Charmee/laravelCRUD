<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view("product_crud.add_products");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' =>'required',
            'rate' => 'required',
            'product_type' => 'required',
            'amount'=>'required'
        ]);
        
        $testing = new Products();
        $testing->fill($request->all());
        $testing->discount = $request->discount;
        $testing->userid = auth()->user()->id;
        $testing->save();
        return redirect()->route("dashboard")->with('success','user has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('product_crud.edit_products',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'quantity' =>'required',
            'rate' => 'required',
            'product_type' => 'required',
            'amount'=>'required'
        ]);
            $products = Products::find($id);
            $products->quantity = $request->quantity;
            $products->rate = $request->rate;
            $products->product_type = $request->product_type;
            $products->discount=$request->discount;
            $products->amount = $request->amount;
            $products->save();
            return redirect()->route('dashboard')
            ->with('success','Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('dashboard')->with('success','user has been deleted successfully');
    }
}
