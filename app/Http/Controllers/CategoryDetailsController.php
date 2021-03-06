<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryDetail;
class CategoryDetailsController extends Controller
{
    /**
         * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = CategoryDetail :: all() -> where('status','1');
        return view('category.list',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Form Validation
        $this -> validate($request,[ 'name' => 'required|max:15' ]); 
        //Insert Values
        if (request('status') === 'on') {
            $status = 1;
            # code...
        }
        else{
            $status = 0;
        }
        //$a = user :: find($id);
        CategoryDetail :: Create([
            'name' => request('name'),
            'status' => $status,
            'created_at',
            'created_by' => '1',
            'updated_at',
            'updated_by' => '1'
        ]);
        \Session :: flash('create','inserted successfully');
        return redirect('category/list'); 
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
        $category = CategoryDetail :: find($id);
        $encrypt = \Crypt::encrypt($category);
        return view('category.edit',compact('category','encrypt'));
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
        $this -> validate($request,[ 'name' => 'required|max:15' ]);
        $category = CategoryDetail :: find($id);
        $category -> name = request('name');           
        if (request('status') === 'on') {
            $category -> status = 1;
            # code...
        }
        else{
            $category -> status = 0;
        }

        //$task->TaskDetail=request('status');
        $category -> updated_by = '5';
        $category -> save();
        \Session :: flash('update','updated successfully');
        return redirect('category/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CategoryDetail :: find($id);
        $category -> status = 0;
        $category -> save();
        \Session :: flash('delete','Deleted successfully');
        return redirect('category/list');
    }
}
