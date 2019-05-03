@extends('layouts.layoutWebSale')

@section('content')

<!-- Slide1 -->
<section class="slide1">
	<div class="wrap-slick1">
		<div class="slick1">
			<div class="item-slick1 item1-slick1" style="background-image: url({{ asset('storage/images/master-slide-02.jpg') }});">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
						Bonsai Collection 2018
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
						New lifes
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>

			<div class="item-slick1 item2-slick1" style="background-image: url({{ asset('storage/images/master-slide-03.jpg') }});">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
						Women Collection 2018
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
						New arrivals
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>

			<div class="item-slick1 item3-slick1" style="background-image: url({{ asset('storage/images/master-slide-04.jpg') }});">
				<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
					<span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
						Women Collection 2018
					</span>

					<h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight">
						New arrivals
					</h2>

					<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
						<!-- Button -->
						<a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
							Shop Now
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

<section class="banner bgwhite p-t-40 p-b-40">
	<div class="container">
		<div class="row">
			@foreach ($products as $product_line)
			<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
				<!-- block1 -->
				<div class="block1 hov-img-zoom pos-relative m-b-30">
					<img src="storage/{{ $product_line->thumbnail }}" alt="IMG-BENNER" style="width: 370px; height: 339px;">

					<div class="block1-wrapbtn w-size2">
						<!-- Button -->
						<a href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
							{{ $product_line->name }}
						</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>

<!-- New Product -->
<section class="newproduct bgwhite p-t-45 p-b-105">
	<div class="container">
		<div class="sec-title p-b-60">
			<h3 class="m-text5 t-center">
				Featured Products
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="wrap-slick2">
			<div class="slick2">
				
				@foreach ($products as $product)
				@foreach ($product->products_detail as $key => $product_detail)
				
				@for ($i = 0; $i <= 10 ; $i+=3)
				@if ($key == $i)
				<div class="item-slick2 p-l-15 p-r-15">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
							<img src="/storage/{{ $product_detail->thumbnail }}" alt="IMG-PRODUCT" style="width: 270px; height: 360px;">

							<div class="block2-overlay trans-0-4">
								<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
									<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
									<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
								</a>

								<div class="block2-btn-addcart w-size1 trans-0-4">
									<!-- Button -->
									<a href="/add-to-cart/{{ $product_detail->id }}/{{ $product_detail->name }}" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Add to Cart
									</a>
								</div>
							</div>
						</div>

						<div class="block2-txt p-t-20">
							<a href="/web-detail/{{ $product_detail->slug }}" class="block2-name dis-block s-text3 p-b-5">
								{{ $product_detail->name }}
							</a>

							<span class="block2-price m-text6 p-r-5" style="text-decoration: line-through; color: red;">
								{{ number_format($product_detail->price,0,",",".") }}.VNĐ
							</span>

							<h5 >
								{{ number_format($product_detail->sale_price,0,",",".") }}.VNĐ
							</h5>
							
						</div>
					</div>
				</div>
				@endif
				@endfor

				@endforeach
				
				@endforeach

			</div>
		</div>

	</div>
</section>

@endsection

@section('footer')

<script type="text/javascript" src="{{ asset('web-sale/web-sale.js') }}"></script>

@endsection