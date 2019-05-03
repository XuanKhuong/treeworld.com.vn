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
              <table id="customers-table" class="table table-bordered table-hover" style="width: 1043px; ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Thumbnail</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Phone</th>
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
					<form  data-url="{{ route('customers.store') }}"  id="form-add" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Customer</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="">name</label>
								<input type="text" class="form-control name-add" id="name-add" name="name-add">
							</div>
							<div class="form-group">
								<label for="">thumbnail</label>
								<input type="file" class="form-control thumbnail-add" id="thumbnail-add" name="thumbnail-add">
							</div>
							<div class="form-group">
								<label for="">address</label>
								<input type="text" class="form-control address-add" id="address-add" name="address-add">
							</div>
							<div class="form-group">
								<label for="">email</label>
								<input type="email" class="form-control email-add" id="email-add" name="email-add">
							</div>
							<div class="form-group">
								<label for="">phone</label>
								<input type="text" class="form-control phone-add" id="phone-add" name="phone-add">
							</div>
							<div class="form-group">
								<label for="">usid</label>
								<input type="text" class="form-control usid-add" id="usid-add" name="usid-add">
							</div>
							<div class="form-group">
								<label for="">level</label>
								<input type="text" class="form-control level-add" id="level-add" name="level-add">
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

		<div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		  aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-body">
		        <div class="row">
		          <div class="col-lg-5">
		            <!--Carousel Wrapper-->
		            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
		              data-ride="carousel">
		              <!--Slides-->
		              <div class="carousel-inner" role="listbox">
		                <div class="carousel-item active">
		                  <img class="d-block w-100" src="" alt="First slide" id="thumbnail-show" >
		                </div>
		              </div>
		              <!--/.Slides-->
		              <!--Controls-->
		              <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
		                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		                <span class="sr-only">Previous</span>
		              </a>
		              <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
		                <span class="carousel-control-next-icon" aria-hidden="true"></span>
		                <span class="sr-only">Next</span>
		              </a>
		            </div>
		            <!--/.Carousel Wrapper-->
		          </div>
		          <div class="col-lg-7">
		            <h2 class="h2-responsive product-name">
		              <strong><h3 id="name-show"></h3></strong>
		            </h2>
		            <span>Address</span>
		            <h5 id="address-show"></h5>
		            <span>Email</span>
		            <h5 id="email-show"></h5>
		            <span>Phone</span>
		            <h5 id="phone-show"></h5>
		            <div class="card-body">
		              <div class="text-center">

		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		              </div>
		            </div>
		            <!-- /.Add to Cart -->
		          </div>
		        </div>
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
						<h4 class="modal-title">Edit Customer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" class="form-control id_edit" id="id_edit" name="id_edit">
						<div class="form-group">
							<label for="">name</label>
							<input type="text" class="form-control name-edit" id="name-edit" name="name-edit">
						</div>
						<div class="form-group">
							<label for="">thumbnail</label>
							<input type="file" class="form-control thumbnail-edit" id="thumbnail-edit" name="thumbnail-edit">
							<img src="" class="show-thumbnail-edit" id="show-thumbnail-edit" name="show-thumbnail-edit">
						</div>
						<div class="form-group">
							<label for="">address</label>
							<input type="text" class="form-control address-edit" id="address-edit" name="address-edit">
						</div>
						<div class="form-group">
							<label for="">email</label>
							<input type="email" class="form-control email-edit" id="email-edit" name="email-edit">
						</div>
						<div class="form-group">
							<label for="">phone</label>
							<input type="text" class="form-control phone-edit" id="phone-edit" name="phone-edit">
						</div>
							<input type="hidden" class="form-control user_id-edit" id="user_id-edit" name="user_id-edit">
							<input type="hidden" class="form-control level_user-edit" id="level_user-edit" name="level_user-edit">
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
	<script type="text/javascript"src="js/customer.js"></script>
@endsection;