<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailOrderController extends Controller
{
    public function index(){
   		return view('contentProduct.content_index');
   	}

   	public function getproducts()
    {
        $product = Product::all();
        return datatables()->of($product)
        // ->editColumn('thumbnail',function($post){
        //     return'<img src="'.asset('').'storage/'.$post->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
        ->addColumn('action',function($product){
            return '
                    <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
                            <span class="fa fa-ellipsis-v"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
                            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-detail" data-id="'.$product->id.'">Show</a></li>
                            <li><a href="#" class="btn-edit" data-id="'.$product->id.'">Edit</a></li>
                            <li><a href="#" class="btn-delete" data-id="'.$product->id.'">Delete</a></li>
                            <li><a href="/detail-products" class="btn-detail-product">Detail Product</a></li>
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
    	$product=Product::create($request->all());
	    return response()->json(['data'=>$product],200);
    }

    public function postImages(Request $request){
    	$image = $request->file('file');
    	foreach ($image as $key => $value){
    		$path = $value->storeAs('product_img', $image[$key]->getClientOriginalName());
    		$imageUpload = Image::create([
    			'product_id' => 200,
    			'thumbnail' =>$path,
    		]);
    	}
    }
    public function show($id)
    {
        $product=Product::find($id);
        // dd($product);
        return response()->json(['data'=>$product],200);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        //die($post);
        return response()->json(['data'=>$product],200);
    }

    public function update(Request $request, $id)
	{

         $product = Product::find($id);
         $product->name = $request->name;
         $product->description = $request->description;
         $product->slug = $request->slug;
         $product->user_id = $request->user_id;
         $product->category_id = $request->category_id;
         $product->save();
    
       return response()->json(['data'=>$product],200);
	}

    public function destroy($id)
	{
	    Product::where('id',$id)->delete();
	    return response()->json(['data'=>'removed'],200);
	}
}
