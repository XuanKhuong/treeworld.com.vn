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
              <table id="categories-table" class="table table-bordered table-hover" style="width: 1043px; ">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Thumbnail</th>
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
					<form  data-url="{{ route('categories.store') }}"  id="form-add" method="POST" role="form" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">
							<h4 class="modal-title">Add Category</h4>
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

		{{-- Modal show chi tiết todo --}}
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
		                  <img class="d-block w-100"
		                    src="" alt="First slide" id="thumbnail-show" >
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
		            <h4 class="h4-responsive">
		              <span class="green-text">
		                <strong><h3 id="price-show"></h3></strong>
		              </span>
		            </h4>

		            <!--Accordion wrapper-->
		            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

		              <!-- Accordion card -->
		              <div class="card">

		                <!-- Card header -->
		                <div class="card-header" role="tab" id="headingOne1">
		                  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
		                    aria-controls="collapseOne1">
		                    <h5 class="mb-0">
		                      Description <i class="fas fa-chevron-down"></i>
		                    </h5>
		                  </a>
		                </div>

		                <!-- Card body -->
		                <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
		                  data-parent="#accordionEx">
		                  <div class="card-body">
		                    <h5 id="description-show"></h5>
		                  </div>
		                </div>
		              </div>
		            </div>
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

					<form id="form_edit"  method="POST" role="form" {{-- enctype="multipart/form-data" --}}>
						<!-- enctype="multipart/form-data" -->
						@csrf
					<div class="modal-header">
						<h4 class="modal-title">Edit Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
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


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection;
@section('footer')
	<script type="text/javascript"src="js/category.js"></script>
@endsection;