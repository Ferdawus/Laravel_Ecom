<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * SubCategory ShowAll
    */
    public function index()
    {
        
        $category = DB::table('categories')->get();
        // return Datatables::of( DB::table('subcategories')->get())->make();
        if(request()->ajax())
        {
            return $subCategory = Datatables::of($this->dtQuery())->addColumn('action','layouts.dt_buttons')->make(true);
        }
        return view('admin.category.subcategory.index',compact('category'));
    }
    /**
     * catagory & subcategary realationship
    */
    public function dtQuery()
    {
        return $subCategory = DB::table('subcategories')
        ->leftjoin('categories','subcategories.category_id','categories.id')
        ->select('subcategories.*','categories.category_name')->get();
    }
    /**
     * SubCategory data create
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => ['required','max:255'],
        ]);
        $data                     = array();
        $data['category_id']      = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug']      = Str::slug($request->subcategory_name, '-');
        // dd($data);

        $notification = array('messege' => 'SubCategory inserted!', 'alert-type' => 'success');
        DB::table('subcategories')->insert($data);
        return redirect()->back();
    }
    /**
     * SubCategory edit form data show query & return query blade page
    */
    public function edit($id)
    {
        $category = DB::table('categories')->get();
        return $data     = DB::table('subcategories')->where('id',$id)->first();
        // dd($data);

        return view('admin.category.subcategory.index',compact('data','cateory'));
    }
    /**
     * SubCategory delete data
    */
    public function destroy($id)
    {
        DB::table('subcategories')->where('id',$id)->delete();
        
        $notification = array('messege' => 'SubCategory Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with('message');
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $data=array();
    	$data['category_id']=$request->category_id;
    	$data['subcategory_name']=$request->subcategory_name;
    	$data['subcat_slug']=Str::slug($request->subcategory_name, '-');
    	DB::table('subcategories')->where('id',$request->id)->update($data);
        return redirect()->back();
    }

}