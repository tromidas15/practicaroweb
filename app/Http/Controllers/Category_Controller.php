<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
class Category_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys_list= Category::paginate(10);
        return view('actions.add_category', compact('categorys_list'));
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
        if(request()->has('Subcategory')){
            request()->validate([
                'Name'=>["required", "alpha_num" ,'min:3'],
            ]);
             Category::create([
                'name' => request('Name'),
                'parent_id' => request('Master_Category'),
            ]);

        }else{
            request()->validate([
                'Name'=>["required", "alpha_num" ,'min:3'],
            ]);
             Category::create([
                'name' => request('Name'),
                'parent_id' => 0,
            ]);
        }
        return redirect('/category');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorys = Category::findOrFail($id);
        $categorys_list= Category::get();
        if($categorys->parent_id !== 0){
            $id = $categorys->parent_id;
            $main= DB::table('categorys')->where('id', '=',  $id)->get();
            return view('actions.edit', compact('categorys', "categorys_list" , 'main'));
        }else{
            return view('actions.edit', compact('categorys', "categorys_list" ));
        }
        
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
        request()->validate([
            'Name'=>["required", "alpha_num" ,'min:3'],
        ]);
        $product =  Category::find($id);
        if(request()->has("Master_Category")){
        $product->parent_id = request('Master_Category');
        $product->Name = request('Name');  
        }else{
                  $product->Name = request('Name');  
        }

        $product ->save();
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect('/category');
    }
}
