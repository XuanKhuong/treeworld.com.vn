<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Image;
use App\User;
use DB;
class ProductController extends Controller
{
  public function index(){
   return view('contentProduct.content_index');
 }

 public function add(Request $request, $id){
  $product->user_id = Auth::user()->$id;
  return response()->json(['data'=>$product],200);
}

public function getproducts()
{
  $products = Product::all();
        // $products = DB::table('products')->leftJoin('images', 'images.product_id', '=', 'products.id')->select('products.*', 'images.thumbnail')->get();
        // dd( $products);
  return datatables()->of($products)
        // ->editColumn('thumbnail',function($products){
        //     return'<img src="'.asset('').'storage/'.$products->thumbnail.'" alt="" style="width: 50px; height: 50px; border-radius: 12px;">';
        // })
  ->addColumn('action',function($products){
    return '
    <div class="margin">
    <div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle drd" data-toggle="dropdown" style="background-color: lightgreen; border-color: lightgreen;">
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu" style="width: 130px; left: -131px">
    <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn-detail" data-id="'.$products->id.'">Show</a></li>
    <li><a href="#" class="btn-edit" data-id="'.$products->id.'">Edit</a></li>
    <li><a href="#" class="btn-delete" data-id="'.$products->id.'">Delete</a></li>
    <li><a href="#" class="btn-detail-product" data-id="'.$products->id.'">Detail Product</a></li>
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
  // dd($request->all());
  $user_id = Auth::id();
  $path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());
  // dd($path);
  $product=Product::create([
    'name' => request('name'),
    'user_id' => $user_id,
    'thumbnail' => $path,
    'description' => request('description'),
    'slug' => request('slug'),
    'category_id' => request('category_id'),
  ]);
  return response()->json(['data'=>$product],200);
}

public function getImages($id){
  $product = Product::find($id);
  return response()->json(['data'=>$product],200);
}

public function postImages(Request $request){
 $image = $request->file('file');
 foreach ($image as $key => $value){
  $path = $value->storeAs('product_img', $image[$key]->getClientOriginalName());
  $product_id = $request->productId;
  $imageUpload = Image::create([
   'product_id' => $product_id,
   'thumbnail' =>$path,
 ]);
}
}
public function show($id)
{
  $products=Product::join('images', 'images.product_id', '=', 'products.id')
  ->select('products.*', 'images.thumbnail', 'products.id as product_id', 'images.id as image_id')
  ->where('products.id', '=', $id)
  ->get();
         // dd( $products);
  return response()->json(['data'=>$products],200);
}

public function edit($id)
{
  $product = Product::find($id);
  return response()->json(['data'=>$product],200);
}

public function update(Request $request, $id)
{
  // dd($request->all());
  $path = $request->thumbnail->storeAs('product_img',$request->thumbnail->getClientOriginalName());
  $user_id = Auth::id();
  $product = Product::find($id);
  $product->name = $request->name;
  $product->description = $request->description;
  $product->slug = $request->slug;
  $product->thumbnail = $path;
  $product->user_id = $user_id;
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
