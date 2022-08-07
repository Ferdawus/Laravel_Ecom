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
        if(request()->ajax()){
            return $subCategory = Datatables::of($this->dtQuery())->addColumn('action','layouts.dt_buttons')->make(true);
        }
        return view('admin.category.subcategory.index',compact('category'));
    }
    public function dtQuery()
    {
        return $subCategory = DB::table('subcategories')
        ->leftjoin('categories','subcategories.category_id','categories.id')
        ->select('subcategories.*','categories.category_name')->get();
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subcategory_name' => ['required','max:255'],
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $data['subcat_slug'] = Str::slug($request->subcategory_name, '-');
        // dd($data);
        DB::table('subcategories')->insert($data);
        $notification = array('messege' => 'SubCategory inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function edit($id)
    {
        // $category = Category::all();
        // $data = SubCategory::find($id);

        $category = DB::table('categories')->get();
        $data=DB::table('subcategories')->where('id',$id)->first();
        dd($data);
        return view('admin.category.subcategory.edit',compact('data','category'));
    }
    public function destroy($id)
    {
        // $subCategory = SubCategory::find($id)->delete();

        DB::table('subcategories')->where('id',$id)->delete();
        $notification = array('messege' => 'SubCategory deleted!', 'alert-type' => 'danger');
        return redirect()->back()->with($notification);
    }

}
