
@extends('layouts.masterAdmin')

@section('dropzone')

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/myStyle.css') }}">

@endsection

@section('content')
	<br>
	<form action="{{ asset('upload-img/store') }}" class="dropzone" id="myDropzone">
		@csrf;
	  <div class="fallback">
	    <input name="file" type="file" multiple />
	  </div>
	  <input name="productId" type="hidden" value="{{ $id }}" />
	</form><br>
	<button type="button" class="btn btn-success" id="addimgpro" style="float: right;">add</button>
@endsection

@section('footer')

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

@endsection