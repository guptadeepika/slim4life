@extends('admin.layout.admin')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Add Activity
  </h1>
  @include('admin.elements.breadcrumb')
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
	<!-- left column -->
	<div class="col-md-12">
	  <!-- general form elements -->
	  <div class="box box-primary">
		<!-- form start -->
		{!! Form::open(array('url' => '/admin/activity-add', 'id' => 'activityForm','files' => true,'name'=>'activityForm')) !!}
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="firstName">Name</label>
						{{ Form::text('name', '', array('class'=>'form-control required', 'autofocus', 'id'=>'firstName','placeholder' => 'Name')) }}
					</div>
				</div>
				
			</div>
			<!--- .row ---->
			            
		  </div>
		  <!-- /.box-body -->                
		  <div class="box-footer">
			<div class="row">
				<div class="col-lg-2 col-md-4">
					<div class="form-group">
						{{ Form::submit('Submit', array('class'=>'btn btn-primary btn-block btn-flat')) }}
					</div>
				</div>
			</div>
		</div>
		{{Form::close()}}
	  </div>
	  <!-- /.box -->	
  </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<script>
$(function() {
	$("form[name='activityForm']").validate({
		rules: {
			// on the right side
			name: "required"
		},
		// Specify validation error messages
		messages: {
			name: "Please enter activity"
		},
		submitHandler: function(form) {
		form.submit();
		}
	});
});
</script>

@endsection




