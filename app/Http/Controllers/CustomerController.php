<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
class CustomerController extends Controller
{
    public function index(){
   		return view('customers.content_index');
   	}

   	public function getcustomers()
    {
        $customer = Customer::all();
        return datatables()->of($customer)
        ->editColumn('thumbnail',function($customer){
            return'<img src="'.asset('').'storage/'.$customer->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        })
        ->addColumn('action',function($customer){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$customer->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$customer->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$customer->id.'">Delete</a></li>
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

    	$path = $request->thumbnail->storeAs('customer_img',$request->thumbnail->getClientOriginalName());
                 //die($path);
             
      $customer=Customer::create([
      'name' => request('name'),
      'thumbnail' => $path,
      'address' => request('address'),
      'email' => request('email'),
      'phone' => request('phone'),
      'user_id' => request('user_id'),
      'level_user' => request('level_user'),
      ]);
	    return response()->json(['customer'=>$customer],200);
    }

    public function show($id)
    {
        $customer=Customer::find($id);
        // dd($product);
        return response()->json(['data'=>$customer],200);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        //die($post);
        return response()->json(['data'=>$customer],200);
    }

    public function update(Request $request, $id)
	{

        $path = $request->thumbnail->storeAs('customer_img',$request->thumbnail->getClientOriginalName());

         $customer = Customer::find($id);
         $customer->name = $request->name;
         $customer->address = $request->address;
         $customer->email = $request->email;
         $customer->phone = $request->phone;
         $customer->user_id = $request->user_id;
         $customer->level_user = $request->level_user;
         $customer->thumbnail =  $path;
         $customer->save();
    
       return response()->json(['data'=>$customer],200);
	}

    public function destroy($id)
	{
	    Customer::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
