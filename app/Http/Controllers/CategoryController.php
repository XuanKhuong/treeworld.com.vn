<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index(){
   		return view('categories.content_index');
   	}

   	public function getcategories()
    {
        $categories = Category::all();
        return datatables()->of($categories)
        ->editColumn('thumbnail',function($categories){
            return'<img src="'.asset('').'storage/'.$categories->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        })
        ->addColumn('action',function($categories){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$categories->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$categories->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$categories->id.'">Delete</a></li>
                          </ul>
                        </div>
                    </div>
                     ';
            
        })
        ->rawColumns(['thumbnail','action'])
        ->toJson();
    }
 //    public function addtest(PostStoreRequest $request)
 //    {
 //        dd('done');
 //    }

    public function store(Request $request)
    {
    	// dd($request->all());
    	$path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());
                 //die($path);
             
         $categories=Category::create([
                        'name' => request('name'),
                        'thumbnail' => $path,
                        'description' => request('description'),
                        'slug' => request('slug'),
                        ]);
        return response()->json(['categories'=>$categories],200);
    }
    public function show($id)
    {
        $categories=Category::find($id);
        // dd($product);
        return response()->json(['data'=>$categories],200);
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        //die($post);
        return response()->json(['data'=>$categories],200);
    }

    public function update(Request $request, $id)
	{
        // dd($request->all());
         $path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());

         $categories = Category::find($id);
         $categories->name = $request->name;
         $categories->description = $request->description;
         $categories->slug = $request->slug;
         $categories->thumbnail = $path;
         $categories->save();
    
       return response()->json(['data'=>$categories],200);
	}

    public function destroy($id)
	{
	    Category::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
