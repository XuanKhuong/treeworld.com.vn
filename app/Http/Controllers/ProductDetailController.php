<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDetail;
use App\Product;
use App\Image;
use DB;
class ProductDetailController extends Controller
{


    // public function index(){
    // 	return view('contentProduct.content_detail_product');
    // }

    public function getdetailproducts($id)
    {
        // $detail_product = ProductDetail::all();
        $detail_products = ProductDetail::where('detail_products.product_id', '=' , $id)->get();
        // dd($detail_product);
        return datatables()->of($detail_products)
        // ->editColumn('thumbnail',function($post){
        //     return'<img src="'.asset('').'storage/'.$post->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
        ->addColumn('action',function($detail_products){
            return '
            <div class="margin">
            <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
            <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
            <li><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-show-detail-product" data-id="'.$detail_products->id.'">Show</a></li>
            <li><a href="#" class="btn-edit-detail-product" data-id="'.$detail_products->id.'">Edit</a></li>
            <li><a href="#" class="btn-delete-detail-product" data-id="'.$detail_products->id.'">Delete</a></li>
            <li><a href="#" class="btn-add-img-detail-product" data-id="'.$detail_products->id.'">Add Images</a></li>
            </ul>
            </div>
            </div>
            ';
            
        })
        ->rawColumns(['action'])
        ->make(true);
        // ->toJson();
    }

    public function store(Request $request)
    {

        // dd($request->all());
    	$detail_product= ProductDetail::create($request->all());
       return response()->json(['data'=>$detail_product],200);
   }

   public function getImages($id){
    $detail_product = ProductDetail::find($id);
    return response()->json(['data'=>$detail_product],200);
} 

public function postImages(Request $request){
        // dd($request->all());
   $image = $request->file('file');
   foreach ($image as $key => $value){
      $path = $value->storeAs('product_img', $image[$key]->getClientOriginalName());
      $product_id = $request->product_id;
      $imageUpload = Image::create([
       'product_id' => $product_id,
       'thumbnail' =>$path,
   ]);
  }
}
public function show($id)
{
    $detail_product=ProductDetail::join('images', 'images.product_id', '=', 'detail_products.id')
    ->select('detail_products.*', 'images.thumbnail', 'detail_products.id as product_id', 'images.id as image_id')
    ->where('detail_products.id', '=', $id)
    ->get();
    return response()->json(['data'=>$detail_product],200);
}

public function edit($id)
{
    $detail_product = ProductDetail::find($id);
        //dd($detail_product);
    return response()->json(['data'=>$detail_product],200);
}

public function update(Request $request, $id)
{
        // dd($request->all());
    $detail_product = ProductDetail::find($id);
        // $slug = str_replace(" ","-",$request->name);
    $detail_product->name = $request->name;
    $detail_product->quantity = $request->quantity;
    $detail_product->color_id = $request->color_id;
    $detail_product->slug = $request->slug;
    $detail_product->price = $request->price;
    $detail_product->life_expectancy = $request->life_expectancy;
    $detail_product->product_id = $request->product_id;
    $detail_product->status = $request->status;
    $detail_product->sale_price = $request->sale_price;
    $detail_product->save();
    return response()->json(['data'=>$detail_product],200);
}

public function destroy($id)
{
   ProductDetail::where('id',$id)->delete();
   return response()->json(['data'=>'removed'],200);
}
}
