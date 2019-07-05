<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class Add_Product extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::get();
        return view('create_product')->with('categorys', $categorys);
    }

    public function store(Request $request)
    {
        //Upload Image
        $image = $request->file('image');
        $input['imagename']=time().".".$image->getClientOriginalExtension();
        $destinationPart=public_path('images/');
        $image->move($destinationPart, $input['imagename']);
        request()->validate([
            'Name'=>["required", "alpha_num" ,'min:3'],
            'Description'=>["required", 'min:10'],
            'Quantity'=>["required", "numeric", 'min:1'],
            'Sale_Price'=>["required", "numeric", 'min:1'],
            'Category'=>["required", "numeric", 'min:1'],
        ]);
        Product::create([
            'Name' => request('Name'),
            'Description' =>request('Description'),
            'Quantity' => request('Quantity'),
            'Sale_Price' => request('Sale_Price'),
            'Category_ID' => request('Category'),
            'Photo' => $input['imagename'],
        ]);
        return redirect('/home');
    }
}
