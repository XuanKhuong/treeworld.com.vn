@extends('layouts.masterAdmin')

@section('dropzone')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('css/myStyle.css') }}">

@endsection

@section('content')

<div class="content-wrapper" style="padding: 12px;">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Tables
			<small>advanced tables</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Tables</a></li>
			<li class="active">Data tables</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"style="padding-bottom: 12px;">
						<a href="#" class="btn btn-success btn-add">Add</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="products-table" class="table table-bordered table-hover" style="width: 1043px; ">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<div class="modal fade" id="modal-add" style="z-index: 99999999;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form  data-url="{{ route('products.store') }}"  id="form-add" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">name</label>
								<input type="text" class="form-control name" id="name" name="name">
							</div>
							<div class="form-group">
								<label for="">thumbnail</label>
								<input type="file" class="form-control thumbnail" id="thumbnail" name="thumbnail">
							</div>
							<div class="form-group">
								<label for="">description</label>
								<input type="text" class="form-control description" id="description" name="description">
							</div>
							<div class="form-group">
								<label for="">category</label><br>
								<input type="radio" class="main_product" id="main_product" name="category"> Main Product &nbsp; &nbsp; &nbsp;
								<input type="radio" class="byproduct" id="byproduct" name="category"> Accessory
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control slug" id="slug" name="slug">
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

		<div class="modal fade" id="modal_show">
			<div class="modal-dialog">
				<div class="modal-content" style="min-height: 500px;">
					<div class="modal-header">
						<h4 class="modal-title">Show Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<img src="" id="thumbnail-show" style="width: 200px; height: 200px; border-radius: 12px;"><hr>
						<h2>Name:</h2>
						<h3 id="name-show"></h3><hr>
						<h2>Description:</h2>
						<h3 id="description-show"></h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-edit">
			<div class="modal-dialog">
				<div class="modal-content">

					<form id="form_edit"  method="POST" role="form" enctype="multipart/form-data">
						<!-- enctype="multipart/form-data" -->
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Edit Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="hidden" name="id_edit" id="id_edit" class="id_edit">
							</div>
							<div class="form-group">
								<label for="">name</label>
								<input type="text" class="form-control name_edit" id="name_edit" name="name_edit">
							</div>
							<div class="form-group">
								<label for="">thumbnail</label>
								<input type="file" class="form-control thumbnail_edit" id="thumbnail_edit" name="thumbnail_edit">
							</div>
							<div class="form-group">
								<label for="">description</label>
								<input type="text" class="form-control description_edit" id="description_edit" name="description_edit">
							</div>
							<div class="form-group">
								<label for="">category</label><br>
								<input type="radio" class="main_product_edit" id="main_product_edit" name="category_edit"> Main Product &nbsp; &nbsp; &nbsp;
								<input type="radio" class="byproduct_edit" id="byproduct_edit" name="category_edit"> Accessory
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control slug_edit" id="slug_edit" name="slug_edit">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" class="save-edit">Edit</button>

						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-detail-product">
			<div class="modal-dialog" style="max-width: 900px;">
				<div class="modal-content" style="padding: 12px;">
					<div class="box-header"style="padding-bottom: 12px;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style=" font-size: 2.5rem;">&times;</button>
						<h1 style="text-align: center;">DETAIL PRODUCTS</h1>
						<a href="#" class="btn btn-success btn-add-detail-product" id="btn-add-detail-product" data-id="">Add</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="detail-products-table" class="table table-bordered table-hover" >
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Life Expectancy</th>
									<th>Sale Price</th>
									<th></th>
								</tr>
							</thead>
						</table>
						<input type="hidden" class="get-product-id" id="get-product-id" name="get-product-id">
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-add-detail-product" style="z-index: 99999999999999;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form  data-url="{{ route('detail-products.store') }}"  id="form-add-detail-product" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Detail Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">name</label>
								<input type="text" class="form-control name-detail-product" id="name-detail-product" name="name-detail-product">
							</div>
							<div class="form-group">
								<label for="">quantity</label>
								<input type="number" class="form-control quantity-detail-product" id="quantity-detail-product" name="quantity-detail-product">
							</div>
							<div class="form-group">
								<label for="">price</label><br>
								<input type="number" class="form-control price-detail-product" id="price-detail-product" name="price-detail-product">
							</div>
							<div class="form-group">
								<label for="">sale price</label><br>
								<input type="number" class="form-control sale-price-detail-product" id="sale-price-detail-product" name="sale-price-detail-product">
							</div>
							<div class="form-group">
								<label for="">Choose Color</label><br>
								<input type="radio" class=" redColor" id="redColor" name="add_color" checked="checked"> Red &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" blueColor" id="blueColor" name="add_color"> Blue &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" blackColor" id="blackColor" name="add_color"> Black &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" greenColor" id="greenColor" name="add_color"> Green &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" yellowColor" id="yellowColor" name="add_color"> Yellow &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<label for="">life expectancy </label><br>
								<input type="radio" class="tuoi-dai" id="tuoi-dai" name="add_life-expectancy" checked="checked"> Long &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" tuoi-trung-binh" id="tuoi-trung-binh" name="add_life-expectancy"> Medium &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" tuoi-ngan" id="tuoi-ngan" name="add_life-expectancy"> Short &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<label for="">status </label><br>
								<input type="radio" class="con-hang" id="con-hang" name="add-status-detail-product" checked="checked"> Still in stock &nbsp; &nbsp; &nbsp;
								<input type="radio" class="gan-het" id="gan-het" name="add-status-detail-product"> Nearly sold out &nbsp; &nbsp; &nbsp;
								<input type="radio" class="het-hang" id="het-hang" name="add-status-detail-product"> Out of stock &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control slug-detail-product" id="slug-detail-product" name="slug-detail-product">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control product-id-detail-product" id="product-id-detail-product" name="product-id-detail-product">
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

		<div class="modal fade" id="modal-edit-detail-product" style="z-index: 99999999999999;">
			<div class="modal-dialog">
				<div class="modal-content">
					<form id="form-edit-detail-product" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Edit Detail Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="hidden" class="form-control edit-id-detail-product" id="edit-id-detail-product" name="edit-id-detail-product">
							</div>
							<div class="form-group">
								<label for="">name</label>
								<input type="text" class="form-control edit-name-detail-product" id="edit-name-detail-product" name="edit-name-detail-product">
							</div>
							<div class="form-group">
								<label for="">quantity</label>
								<input type="number" class="form-control edit-quantity-detail-product" id="edit-quantity-detail-product" name="edit-quantity-detail-product">
							</div>
							<div class="form-group">
								<label for="">price</label><br>
								<input type="number" class="form-control edit-price-detail-product" id="edit-price-detail-product" name="edit-price-detail-product">
							</div>
							<div class="form-group">
								<label for="">sale price</label><br>
								<input type="number" class="form-control edit-sale-price-detail-product" id="edit-sale-price-detail-product" name="edit-sale-price-detail-product">
							</div>
							<div class="form-group">
								<label for="">Choose Color</label><br>
								<input type="radio" class=" edit-redColor" id="edit-redColor" name="edit-color" checked="checked"> Red &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-blueColor" id="edit-blueColor" name="edit-color"> Blue &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-blackColor" id="edit-blackColor" name="edit-color"> Black &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-greenColor" id="edit-greenColor" name="edit-color"> Green &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-yellowColor" id="edit-yellowColor" name="edit-color"> Yellow &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<label for="">life expectancy </label><br>
								<input type="radio" class="edit-tuoi-dai" id="edit-tuoi-dai" name="edit-life-expectancy" checked="checked"> Long &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-tuoi-trung-binh" id="edit-tuoi-trung-binh" name="edit-life-expectancy"> Medium &nbsp; &nbsp; &nbsp;
								<input type="radio" class=" edit-tuoi-ngan" id="edit-tuoi-ngan" name="edit-life-expectancy"> Short &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<label for="">status </label><br>
								<input type="radio" class="edit-con-hang" id="edit-con-hang" name="edit-status-detail-product" checked="checked"> Still in stock &nbsp; &nbsp; &nbsp;
								<input type="radio" class="edit-gan-het" id="edit-gan-het" name="edit-status-detail-product"> Nearly sold out &nbsp; &nbsp; &nbsp;
								<input type="radio" class="edit-het-hang" id="edit-het-hang" name="edit-status-detail-product"> Out of stock &nbsp; &nbsp; &nbsp;
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control edit-slug-detail-product" id="edit-slug-detail-product" name="edit-slug-detail-product">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control edit-product-id-detail-product" id="edit-product-id-detail-product" name="edit-product-id-detail-product">
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

		<div class="modal fade" id="modal_dtProduct_show">
			<div class="modal-dialog">
				<div class="modal-content" style="min-height: 500px;">
					<div class="modal-header">
						<h4 class="modal-title">Show Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<img src="" id="thumbnail-dtProduct-show" style="width: 200px; height: 200px; border-radius: 12px;"><hr>
						<h2>Name:</h2>
						<h3 id="name-dtProduct-show"></h3><hr>
						<h2>Quantity:</h2>
						<h3 id="quantity-dtProduct-show"></h3><hr>
						<h2>Price</h2>
						<h3 id="price-dtProduct-show"></h3><hr>
						<h2>Life expectancy</h2>
						<h3 id="life-expectancy-dtProduct-show"></h3><hr>
						<h2>Sale price</h2>
						<h3 id="sale-price-dtProduct-show"></h3><hr>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="modal_add_img">
			<div class="modal-dialog">
				<div class="modal-content" style="min-height: 500px;">
					<div class="modal-header">
						<h4 class="modal-title">Add Images</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<form action="{{ asset('upload-img/store') }}" class="dropzone" id="myDropzone">
							@csrf;
							<div class="fallback">
								<input name="file" type="file" multiple />
							</div>
							<input name="product_id" id="product_id" type="hidden" />
						</form><br>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success" id="addimgpro">Add</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection;
@section('footer')
<script type="text/javascript"src="js/product.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">
	Dropzone.options.myDropzone = {
		maxFileSize : 4,
		parallelUploads : 10,
		uploadMultiple: true,
		autoProcessQueue : false,
		addRemoveLinks : true,
		init: function() {
			var submitButton = document.querySelector("#addimgpro")
			myDropzone = this;
			submitButton.addEventListener("click", function() {
				myDropzone.processQueue(); 
			});

		},
	};
</script>
@endsection;