<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categorys', 'products.Category_ID', '=', 'categorys.id')
            ->select('products.*', 'categorys.name as Category')
            ->paginate(10);
        return view('home')->with('products', $products);
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('edit_products', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categorys = Category::get();
        $mainCategory = DB::table('products')
            ->join('categorys', 'products.Category_ID', '=', 'categorys.id')
            ->select('categorys.name','categorys.id')
            ->get();
        return view('edit_products', compact('product', 'categorys', 'mainCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        request()->validate([
            'Name'=>["required", "alpha_num" ,'min:3'],
            'Description'=>["required", 'min:10'],
            'Quantity'=>["required", "numeric", 'min:1'],
            'Sale_Price'=>["required", "numeric", 'min:1'],
            'Category'=>["required", "numeric", 'min:1'],
        ]);
        $product = Product::findOrFail($id);
        $product->Name = request('Name');
        $product->Description = request('Description');
        $product->Quantity = request('Quantity');
        $product->Sale_Price = request('Sale_Price');
        $product->Category_ID = request('Category');
        $product ->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect('/home');

    }
}
