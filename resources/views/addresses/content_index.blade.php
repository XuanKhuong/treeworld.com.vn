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
            <div class="box-header"style="padding-bottom: 12px;">
              <a href="#" class="btn btn-success btn-add">Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="addresses-table" class="table table-bordered table-hover" style="width: 1043px; ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Address</th>
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
					<form  data-url="{{ route('addresses.store') }}"  id="form-add" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Address</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">address</label>
								<input type="text" class="form-control address" id="name" name="address">
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

		{{-- Modal show chi tiết todo --}}
		<div class="modal fade" id="modal-show">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Show Address</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<h2>Address:</h2>
						<h3 id="address-show"></h3>
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
						<h4 class="modal-title">Edit Accessory</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
							<div class="form-group">
								
								<input type="hidden" class="form-control" class="id_edit" id="id_edit">
								<label for="">Address</label>
								<input type="text" class="form-control address_edit" name="address_edit" id="address_edit">
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


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection;
@section('footer')
	<script type="text/javascript"src="js/address.js"></script>
@endsection;