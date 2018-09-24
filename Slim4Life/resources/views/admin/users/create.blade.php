@extends('admin.layout.admin')
@php
$imgSrc = url('/') . '/public/admin/images/common/avatar.png';
@endphp
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Add Customer
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
		{!! Form::open(array('url' => '/admin/user', 'id' => 'userForm','files' => true,'name'=>'userRegistration')) !!}
		  <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="firstName">First Name</label>
						{{ Form::text('first_name', '', array('class'=>'form-control required', 'autofocus', 'id'=>'firstName','placeholder' => 'First Name')) }}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="exampleInputEmail1">Last Name</label>
						{{ Form::text('last_name', '', array('class'=>'form-control required', 'autofocus', 'id'=>'lastName','placeholder' => 'Last Name')) }}
					</div>  
				</div>
			</div>
			<!--- .row ---->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						 <label for="email">Email</label>
						{{ Form::text('email', '', array('class'=>'form-control required', 'autofocus', 'id'=>'email','placeholder' => 'Email')) }}
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
						{{ Form::text('mobile','', array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Mobile')) }} 
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('password','Password'); !!} 
						{{ Form::password('password', array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Password')) }}	
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
	// check email availibility
	$('#email').blur(function()
    {
		jQuery.ajax({
		url: "{{url('admin/check-customer')}}",
		data:'email='+$(this).val(),
		type: "GET",
		success:function(data){
			if(data == 1)
			{
				var msg = "Already registered with us!";
				$("#availability-status").show();
				$("#availability-status").addClass('error');
				$("#availability-status").html(msg);
			}
			else
			{
				$("#availability-status").hide();
			}
		},
		error:function (){}
		});
	});
});
</script>
@endsection




