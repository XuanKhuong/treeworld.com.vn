@extends('layouts.layoutWebSale')

@section('content')

<section class="cart bgwhite p-t-70 p-b-100">
	<div class="container">
		<!-- Cart item -->
		<div class="container-table-cart pos-relative">
			<div class="wrap-table-shopping-cart bgwhite">
				@if (Cart::content() != null)
				<a href="/delete-cart/" class="btn btn-warning" style="color: white;">Delete Cart</a>
				<table class="table-shopping-cart" id="table-cart">
					<tr class="table-head">
						<th class="column-1"></th>
						<th class="column-2">Product</th>
						<th class="column-3">Price</th>
						<th class="column-4 p-l-70">Quantity</th>
					</tr>
					@foreach ($content as $info)
					<tr class="table-row">
						
						<td class="column-1">
							<div class="cart-img-product b-rad-4 o-f-hidden">
								<img src="/storage/{!! $info->options->img->thumbnail !!}" style="width: 90px; height: 120px;" alt="IMG-PRODUCT">
							</div>
						</td>
						
						<td class="column-2">{!! $info->name !!}</td>
						<td class="column-3">{!! number_format($info->price,0,",",".") !!}.VNĐ</td>
						<td class="column-4">
							<div class="flex-w bo5 of-hidden w-size17">
								<a href="/reduction/{{ $info->rowId }}" class="color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</a>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="{!! $info->qty !!}">

								<a href="/add-to-cart/{{ $info->id }}/{{ $info->name }}" class="color1 flex-c-m size7 bg8 eff2" id="them">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</a>
							</div>
						</td>
					</tr>
					@endforeach
					<tr class="table-row">
						<td colspan="4" style="text-align: left; padding-left: 5%;">
							Total: {!! $sub_total !!}
						</td>
					</tr>
				</table>
				@endif
			</div>
		</div>

		<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
			<div class="flex-w flex-m w-full-sm">
				<div class="size11 bo4 m-r-10">
					<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
				</div>

				<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Apply coupon
					</button>
				</div>
			</div>

			<div class="size10 trans-0-4 m-t-10 m-b-10">
				<!-- Button -->
				<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="btn-order">
					Order
				</button>
			</div>
		</div>

		<!-- Total -->
		<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
			<h5 class="m-text20 p-b-24">
				Cart Totals
			</h5>

			<!--  -->
			<div class="flex-w flex-sb-m p-b-12">
				<span class="s-text18 w-size19 w-full-sm">
					Subtotal:
				</span>

				<span class="m-text21 w-size20 w-full-sm">
					$39.00
				</span>
			</div>

			<!--  -->
			<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
				<span class="s-text18 w-size19 w-full-sm">
					Shipping:
				</span>

				<div class="w-size20 w-full-sm">
					<p class="s-text8 p-b-23">
						There are no shipping methods available. Please double check your address, or contact us if you need any help.
					</p>

					<span class="s-text19">
						Calculate Shipping
					</span>

					<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
						<select class="selection-2" name="country">
							<option>Select a country...</option>
							<option>US</option>
							<option>UK</option>
							<option>Japan</option>
						</select>
					</div>

					<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="state" placeholder="State /  country">
					</div>

					<div class="size13 bo4 m-b-22">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="postcode" placeholder="Postcode / Zip">
					</div>

					<div class="size14 trans-0-4 m-b-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Update Totals
						</button>
					</div>
				</div>
			</div>

			<!--  -->
			<div class="flex-w flex-sb-m p-t-26 p-b-30">
				<span class="m-text22 w-size19 w-full-sm">
					Total:
				</span>

				<span class="m-text21 w-size20 w-full-sm">
					{!! $sub_total !!}
				</span>
			</div>

			<div class="size15 trans-0-4">
				<!-- Button -->
				<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
					Proceed to Checkout
				</button>
			</div>
		</div>

		<div class="modal fade" id="modal-info" style="z-index: 99999999;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form  data-url="{{ route('check-out.checkOut') }}" id="form-info" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h1 class="modal-title" style="margin: 0px auto;">Your Infomation</h1>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label style="font-size: 15px;" for="">name</label>
								<input type="text" class="form-control name" id="name" name="name" multiple="" title="Tên ít nhất có 3 ký tự"
								@if (Auth::check())
									value="{!! Auth::user()->name !!}" 
								@endif
								>
							</div>
							<div class="form-group">
								<label style="font-size: 15px;" for="">address</label>
								<input type="text" class="form-control address" id="address" name="address" multiple="" title="địa chỉ ít nhất có 5 ký tự"
								@if (Auth::check())
									value="{!! Auth::user()->email !!}" 
								@endif
								>
							</div>
							<div class="form-group">
								<label style="font-size: 15px;" for="">phone number</label>
								<input type="number" class="form-control phone_number" id="phone_number" name="phone_number"
								@if (Auth::check())
									value="{!! Auth::user()->phone !!}" 
								@endif
								>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Add</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('footer')

	<script type="text/javascript" src="js/web-sale.js"></script>

@endsection