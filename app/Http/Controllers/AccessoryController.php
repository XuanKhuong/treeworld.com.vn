<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accessory;
class AccessoryController extends Controller
{
    public function index(){
    	return view("accessories.content_index");
    }

    public function getaccessories()
    {
        $accessory = Accessory::all();
        return datatables()->of($accessory)
        ->editColumn('thumbnail',function($accessory){
            return'<img src="'.asset('').'storage/'.$accessory->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        })
        ->addColumn('action',function($accessory){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$accessory->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$accessory->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$accessory->id.'">Delete</a></li>
                          </ul>
                        </div>
                    </div>
                     ';
            
        })
        ->rawColumns(['thumbnail','action'])
        ->toJson();
    }

    public function store(Request $request)
    {
    	$path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());
                 //die($path);
             
         $accessory=Accessory::create([
                        'name' => request('name'),
                        'thumbnail' => $path,
                        'description' => request('description'),
                        'price' => request('price'),
                        'category_id' => request('category_id')
                        ]);
        return response()->json(['accessory'=>$accessory],200);
    }

    public function show($id)
    {
        $accessory=Accessory::find($id);
        return response()->json(['data'=>$accessory],200);
    }

    public function edit($id)
    {
        $accessory = Accessory::find($id);
        //die($post);
        return response()->json(['data'=>$accessory],200);
    }

    public function update(Request $request, $id)
	{
	     $path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());

         $accessory = Accessory::find($id);
         $accessory->name = $request->name;
         $accessory->description = $request->description;
         $accessory->price = $request->price;
         $accessory->category_id = $request->category_id;
         $accessory->thumbnail =  $path;
         $accessory->save();
         // die($accessory->all());
    
       return response()->json(['data'=>$accessory],200);
	}

	public function destroy($id)
	{
	    Accessory::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
