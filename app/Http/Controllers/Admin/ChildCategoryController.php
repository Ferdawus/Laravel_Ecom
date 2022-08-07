<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Str;


class ChildCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = DB::table('categories')->get();
        // if($request->ajax()){
        //     $data = DB::table('childcategories')
        //     ->leftJoin('categories','childcategories.category_id')
        //     ->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
        //     ->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();
            
        //     return Datatables::of($data)
        //     ->addIndexColumn()
        //     ->addColumn('action',function($row){
        //         $actionbtn = '<a href="" class="btn btn-info btn-sm " id="EditBtn" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>

        //         <a href="#" id="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
        //         return $actionbtn;
        //     })->rawColumns(['action'])->make(true);
        // }
       
        return view('admin.category.childcategory.index',compact('category'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
