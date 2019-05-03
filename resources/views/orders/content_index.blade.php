@extends('layouts.masterAdmin')

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
            <!-- /.box-header -->
            <div class="box-body">
              <table id="orders-table" class="table table-bordered table-hover" style="width: 1043px; ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name Customer</th>
                  <th>Address Customer</th>
                  <th>Mobile Customer</th>
                  <th>Total</th>
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

      

		{{-- show --}}

		<div class="modal fade" id="modal_show">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Show Post</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<h2>name customer:</h2>
						<h3 id="name-customer-show"></h3><hr>
						<h2>address customer:</h2>
						<h3 id="address-customer-show"></h3><hr>
						<h2>mobile customer:</h2>
						<h3 id="mobile-customer-show"></h3><hr>
						<h2>customer id:</h2>
						<h3 id="customer-id-show"></h3><hr>
						<h2>status:</h2>
						<h3 id="status-show"></h3><hr>
						<h2>employee id:</h2>
						<h3 id="employee-id-show"></h3><hr>
						<h2>total:</h2>
						<h3 id="total-show"></h3><hr>
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

					<form id="form_edit"  method="POST" role="form" {{-- enctype="multipart/form-data" --}}>
						<!-- enctype="multipart/form-data" -->
						@csrf
					<div class="modal-header">
						<h4 class="modal-title">Edit Order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
							<div class="form-group">
								
								<input type="hidden" class="form-control" class="id_edit" id="id_edit">
								<label for="">name customer</label>
								<input type="text" class="form-control name-customer_edit" name="name-customer_edit" id="name-customer_edit">
								<label for="">address customer</label>
								<input type="text" class="form-control address-customer_edit" name="address-customer_edit" id="address-customer_edit">
								<label for="">mobile customer</label>
								<div class="img-edit">
									<input type="text" name="mobile-customer_edit" class="form-control mobile-customer_edit" id="mobile-customer_edit">
								</div>
								<label for="">total</label>
								<input type="number" class="form-control total_edit" name="total_edit" id="total_edit">
								<input type="hidden" class="form-control customer-id_edit" name="customer-id_edit" id="customer-id_edit">
								<input type="hidden" class="form-control status_edit" name="status_edit" id="status_edit">
								<input type="hidden" class="form-control employee-id_edit" name="employee-id_edit" id="employee-id_edit">
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
		
		<div class="modal fade" id="modal-detail-order">
			<div class="modal-dialog" style="max-width: 900px;">
				<div class="modal-content" style="padding: 12px;">
					<div class="box-header"style="padding-bottom: 12px;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style=" font-size: 2.5rem;">&times;</button>
						<h1 style="text-align: center;">DETAIL ORDER</h1>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="detail-orders-table" class="table table-bordered table-hover" >
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection;
@section('footer')
	<script type="text/javascript"src="js/order.js"></script>
@endsection;