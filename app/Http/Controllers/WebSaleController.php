<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\Image;
use App\Order;
use App\DetailOrder;
use Cart;
use DB;

class WebSaleController extends Controller
{
	public function index(){
		$products = DB::table('products')->get();
		foreach ($products as $key => $product) {
			$product->products_detail = DB::table('detail_products')->where('detail_products.product_id', $product->id)->leftJoin('images', 'images.product_id', '=', 'detail_products.id')->select('detail_products.id','detail_products.name','detail_products.quantity','detail_products.price','detail_products.life_expectancy','detail_products.slug','detail_products.sale_price', 'images.thumbnail')->get();
		}
		// dd($products);
    	// $products_detail = DB::table('detail_products')->leftJoin('images', 'images.product_id', '=', 'detail_products.id')->select('detail_products.name','detail_products.quantity','detail_products.price','detail_products.life_expectancy','detail_products.slug','detail_products.sale_price', 'images.thumbnail')->get();
		return view('contentWebSale.content-index',compact('products'));
	}

	public function detail($slug){
		
		$products_detail = ProductDetail::where('slug', $slug)->first();
		$products_detail->images = Image::where('product_id', $products_detail->id)->select('thumbnail')->get();
		return view('contentWebSale.contentdetail', ['products_detail' => $products_detail]);
	}

	public function addToCart($id){
		$add_product = DB::table('detail_products')->where('id',$id)->first();
		// dd($add_product);
		$add_product->images = Image::where('product_id', $add_product->id)->select('thumbnail')->first();
		Cart::add(array('id' => $id,'name' => $add_product->name,'qty' => 1,'price' => $add_product->sale_price,'options' => array('img' => $add_product->images)));
		$content = Cart::content();
		// foreach (Cart::content() as $value) {
		// 	$content->img = $value->options->img;
		// }
		// dd($content);
		return redirect()->route('cart.Cart');
	}

	public function Cart(){
		$content = Cart::content();
		$sub_total = Cart::subtotal();
		// dd($content);
		return view('contentWebSale.content-cart', compact('content','sub_total'));
	}

	public function deleteCart(){
		Cart::destroy();
		return redirect()->route('cart.Cart');
	}

	//giảm số lượng sp
	public function reduceNumber($id){
		$rowId = $id;
		// dd($rowId);
		$content = Cart::get($rowId);
		if($content->qty > 1) {
			$content->qty--;
			Cart::update($rowId, $content->qty);
		}
		if($content->qty == 1){
			Cart::remove($rowId);
		}
		return redirect()->route('cart.Cart');
	}

	public function checkOut(Request $request){ 
		

		$total = Cart::subtotal();
		$total = str_replace(",","",$total);
		$total = str_replace(".","",$total);
		// dd($cart_content);
		$order = Order::create([
			'name_customer' => request('name_customer'),
			'address_customer' => request('address_customer'),
			'mobile_customer' => request('mobile_customer'),
			'total' => $total
		]);
		//dd(Cart::content());
		foreach (Cart::content() as $key => $value) {

			$detail_order = DetailOrder::create([
				'detail_product_id' => $value->id,
				'name' => $value->name,
				'quantity' => $value->qty,
				'sale_price' => $value->price,
				'total' => $total
			]);
		}

		Cart::destroy();
		return redirect('/');
	}
}
