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
            return view('actions.edit', compact('categorys', "categorys_list"));
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
    public function show_all_subcats_of_a_product($id)
    {
        $main = $id;
        $all_subs = Category::get()->where("parent_id", "=", $id);
        return view("actions.show_all_subs_off_main_category", compact("all_subs" , 'main'));
    }

    public function destroy($id)
    {
        $check_if_main = Category::findOrFail($id);
        if($check_if_main->parent_id !== 0)
        {
            Category::find($id)->delete();
            return back();
        }else{
            $check_if_has_sub = DB::table('categorys')
                                ->select('categorys.*')
                                ->where("parent_id", "=", $id)
                                ->get();
            if(count($check_if_has_sub) > 0)
            {
                $main_category = $check_if_main->id;
                return redirect('/category/show_sub/'.$main_category);
            }else{
                Category::find($id)->delete();
                return back();
            }
        }
        
    }
}
