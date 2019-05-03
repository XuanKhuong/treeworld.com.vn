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
              <table id="colors-table" class="table table-bordered table-hover" style="width: 1043px; ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
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
					<form  data-url="{{ route('colors.store') }}"  id="form-add" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Color</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">Choose Color </label><br>
								<input type="radio" class=" redColor" id="redColor" name="add_color" checked="checked"> Red
								<input type="radio" class=" blueColor" id="blueColor" name="add_color"> Blue
								<input type="radio" class=" blackColor" id="blackColor" name="add_color"> Black
								<input type="radio" class=" greenColor" id="greenColor" name="add_color"> Green
								<input type="radio" class=" yellowColor" id="yellowColor" name="add_color"> Yellow
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

		{{-- show --}}

		<div class="modal fade" id="modal_show">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Show Color</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" style="text-align: center;">
						<h2>name:</h2>
						<h3 id="name-show"></h3>
						<h2>color:</h2>
						<div class="colorDT " id="showColor" style="width: 100px; height: 100px; border-radius: 12px; margin: 0px auto;"></div>
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

					<form id="form_edit"  method="POST" role="form">
						<!-- enctype="multipart/form-data" -->
						@csrf
					<div class="modal-header">
						<h4 class="modal-title">Edit Color</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
							<div class="form-group">
								
								<input type="hidden" class="form-control" class="id_edit" id="id_edit">
								<label for="">Choose Color </label><br>
								<input type="radio" class=" redColor" id="redColor_edit" name="edit_color" checked="checked"> Red
								<input type="radio" class=" blueColor" id="blueColor_edit" name="edit_color"> Blue
								<input type="radio" class=" blackColor" id="blackColor_edit" name="edit_color"> Black
								<input type="radio" class=" greenColor" id="greenColor_edit" name="edit_color"> Green
								<input type="radio" class=" yellowColor" id="yellowColor_edit" name="edit_color"> Yellow
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
	<script type="text/javascript"src="js/color.js"></script>
@endsection;



