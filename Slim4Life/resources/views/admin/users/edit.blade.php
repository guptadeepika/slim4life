@extends('admin.layout.admin')

@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Edit
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
		{{ Form::model($userDetail, array('route' => array('user.update', \Crypt::encryptString($userDetail->id)), 'method' => 'PUT','files' => true,'id'=>'userRegistration')) }}
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="firstName">First Name</label>
						{{ Form::text('first_name', null, array('class'=>'form-control required', 'autofocus', 'id'=>'firstName','placeholder' => 'First Name')) }}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Last Name</label>
						{{ Form::text('last_name', null, array('class'=>'form-control required', 'autofocus', 'id'=>'lastName','placeholder' => 'Last Name')) }}
					</div>  
				</div>
			</div>
			<!--- .row ---->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						 <label for="email">Email</label>
						{{ Form::text('email', null, array('class'=>'form-control required', 'autofocus', 'id'=>'email','placeholder' => 'Email', 'readonly' => true)) }}
						<span id="availability-status"></span>	
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						 <label for="address">Address</label>
						{{ Form::text('address',null, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Address')) }} 
					</div>  
				</div>
			</div>
			<!--- .row ---->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="mobile">Mobile</label>
						{{ Form::text('mobile', null, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Mobile')) }} 
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
	<!--/.col (left) -->
	<!-- right column -->
	
	<!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>
<script>
$(function() {
	$("form[name='userRegistration']").validate({
		rules: {
			// on the right side
			first_name: "required",
			last_name: "required",
			email: {
			required: true,
			email: true
			},
			address: "required",
			mobile: "required",
			password: {
				required: true,
				minlength: 5
			}
		},
		// Specify validation error messages
		messages: {
			first_name: "Please enter your firstname",
			last_name: "Please enter your lastname",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: "Please enter a valid email address",
			address: "Please enter your address",
			mobile: "Please enter your mobile nunber"
		},
		submitHandler: function(form) {
		form.submit();
		}
	});
	
});
</script>
@endsection




