<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;

class ColorController extends Controller
{
    public function index(){
   		return view('colors.content_index');
   	}

   	public function getcolors()
    {
        $colors = Color::all();
        return datatables()->of($colors)
        // ->editColumn('thumbnail',function($post){
        //     return'<img src="'.asset('').'storage/'.$post->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
        ->addColumn('action',function($colors){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$colors->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$colors->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$colors->id.'">Delete</a></li>
                          </ul>
                        </div>
                    </div>
                     ';
            
        })
        ->rawColumns(['action'])
        ->toJson();
    }
 //    public function addtest(PostStoreRequest $request)
 //    {
 //        dd('done');
 //    }

    public function store(Request $request)
    {
    	$colors=Color::create($request->all());
	    return response()->json(['data'=>$colors],200);
    }

    public function show($id)
    {
        $colors=Color::find($id);
        // dd($product);
        return response()->json(['data'=>$colors],200);
    }

    public function edit($id)
    {
        $colors = Color::find($id);
        //die($post);
        return response()->json(['data'=>$colors],200);
    }

    public function update(Request $request, $id)
	{
         $colors = Color::find($id);
         $colors->name = $request->name;
         $colors->code_color = $request->code_color;
         $colors->save();
    
       return response()->json(['data'=>$colors],200);
	}

    public function destroy($id)
	{
	    Color::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
