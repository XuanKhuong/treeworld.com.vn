<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
class AddressController extends Controller
{
    public function index(){
    	return view("addresses.content_index");
    }

    public function getaddresses()
    {
        $address = Address::all();
        return datatables()->of($address)
        // ->editColumn('thumbnail',function($post){
        //     return'<img src="'.asset('').'storage/'.$post->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
        ->addColumn('action',function($address){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$address->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$address->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$address->id.'">Delete</a></li>
                          </ul>
                        </div>
                    </div>
                     ';
            
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function store(Request $request)
    {
    	$address=Address::create($request->all());
	    return response()->json(['data'=>$address],200);
    }

    public function show($id)
    {
        $address=Address::find($id);
        return response()->json(['data'=>$address],200);
    }

    public function edit($id)
    {
        $address = Address::find($id);
        //die($post);
        return response()->json(['data'=>$address],200);
    }

    public function update(Request $request, $id)
	{
       $address = Address::find($id)->update($request->all());
       return response()->json(['data'=>$address],200);
	}

    public function destroy($id)
	{
	    Address::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
