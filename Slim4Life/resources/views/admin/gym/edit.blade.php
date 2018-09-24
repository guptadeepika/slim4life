@extends('admin.layout.admin')
@php
$imgSrc = (!empty($gymDetail->image))? url('/') . '/public/images/uploaded/gym/'.$gymDetail->image : url('/') . '/public/admin/images/common/avatar.png';
@endphp
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   {{$mainTitle}}
  </h1>      
	@include('admin.elements.breadcrumb')
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-md-12">
		
	 <div class="box box-primary">
		{{ Form::open(array('class'=>'has-validation-callback', 'id'=>'registerForm', 'name'=>'gymRegisterForm', 'method'=>'POST','enctype' => 'multipart/form-data', 'url'=>url('/admin/update-gym').'/'.\Crypt::encryptString($gymDetail->id))) }}
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="gymName">Gym Name</label>
							{{ Form::text('name', $gymDetail->name, array('class'=>'form-control required', 'placeholder' => 'Gym Name', 'autofocus')) }}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Email</label>
							{{ Form::text('email', $gymDetail->email, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Email', 'id' =>'email', 'readonly'=>true)) }}
							<span id="availability-status"></span>	
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8 col-md-12">
									<label class="formLable">Profile Image</label>	
									{{ Form::file('image', ['class' => 'btn btn-default btn-file', 'id' => 'image']) }}
								</div>
							<div class="col-lg-4 col-md-12">							
									<span class="pull-right img-full">
										{{ Html::image($imgSrc, 'image', array('id' => 'imagePreview', 'title' => 'Image Preview', 'class'=>'img-responsive')) }}
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="address">Address</label>
							{{ Form::text('address', $gymDetail->address, array('class'=>'form-control required', 'placeholder' => 'Address', 'autofocus')) }}
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="latitude">Latitude</label>
							{{ Form::text('latitude',  $gymDetail->latitude, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Latitude')) }} 
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="longitude">Longitude</label>
							{{ Form::text('longitude', $gymDetail->longitude, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Longitude')) }}
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('opening_days','Select Opening Days'); !!}     
							{!! Form::select('opening_days[]',$openingDaysList, $sel_opening_day, ['multiple'=>true,'class' => 'form-control chosen-select required','id' => 'opening_days', 'autofocus']) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('mobile','Mobile'); !!}     
							{{ Form::text('mobile',  $gymDetail->mobile, array('class'=>'form-control required', 'autofocus', 'id'=> 'mobile', 'placeholder' => 'Mobile')) }}
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('morning_time','Morning Time'); !!}   
							{{ Form::text('morning_from_time',  $gymDetail->time_slot->morning_from_time, array('class'=>'form-control required', 'autofocus', 'id'=> 'morning_from_time', 'placeholder' => 'From')) }}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="morning_to_time"></label>
							{{ Form::text('morning_to_time', $gymDetail->time_slot->morning_to_time, array('class'=>'form-control required','id'=>'morning_to_time', 'autofocus', 'placeholder' => 'To')) }}	
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('evening_time','Evening Time'); !!}   
							{{ Form::text('evening_from_time', $gymDetail->time_slot->evening_from_time, array('class'=>'form-control required', 'autofocus', 'id'=> 'evening_from_time', 'placeholder' => 'From')) }}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="evening_to_time"></label>
							{{ Form::text('evening_to_time', $gymDetail->time_slot->evening_to_time, array('class'=>'form-control required','id'=>'evening_to_time', 'autofocus', 'placeholder' => 'To')) }}	
						</div>  
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('pass_price','Pass Price'); !!}   
							{{ Form::text('pass_price', $gymDetail->pass_price, array('class'=>'form-control required', 'autofocus', 'placeholder' => 'Pass Price')) }}
						</div>
					</div>			
				</div>
			</div><!-- /.box-body -->
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
	</div>
  </div><!-- /.row -->
</section>

</div>
<script>
$(document).ready(function(){
	$('#morning_from_time').timepicker();
	$('#morning_to_time').timepicker();
	$('#evening_from_time').timepicker();
	$('#evening_to_time').timepicker();	
	$("form[name='gymRegisterForm']").validate({
		rules: {
		  // on the right side
		  name: "required",
		  email: {
			required: true,
			email: true
		  },
		  password: {
			required: true,
			minlength: 5
		  }
		},
		// Specify validation error messages
		messages: {
		  password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 5 characters long"
		  },
		  //email: "Please enter a valid email address"
		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
	
});
</script>
@endsection



