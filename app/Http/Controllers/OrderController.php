<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class OrderController extends Controller
{
    public function index(){
   		return view('orders.content_index');
   	}

   	public function getorders()
    {
        $order = Order::all();
        return datatables()->of($order)
        // ->editColumn('thumbnail',function($post){
        //     return'<img src="'.asset('').'storage/'.$post->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
        ->addColumn('action',function($order){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$order->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$order->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$order->id.'">Delete</a></li>
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
    	$order=Order::create($request->all());
	    return response()->json(['order'=>$order],200);
    }

    public function show($id)
    {
        $order=Order::find($id);
        // dd($product);
        return response()->json(['data'=>$order],200);
    }

    public function edit($id)
    {
        $order = Order::find($id);
        //die($post);
        return response()->json(['data'=>$order],200);
    }

    public function update(Request $request, $id)
	{

         $order = Order::find($id);
         $order->name_customer = $request->name_customer;
         $order->address_customer = $request->address_customer;
         $order->mobile_customer = $request->mobile_customer;
         $order->customer_id = $request->customer_id;
         $order->status = $request->status;
         $order->employee_id = $request->employee_id;
         $order->total = $request->total;
         $order->save();
    
       return response()->json(['data'=>$order],200);
	}

    public function destroy($id)
	{
	    Order::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
