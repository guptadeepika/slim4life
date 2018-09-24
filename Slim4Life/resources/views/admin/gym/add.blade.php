@extends('admin.layout.admin')
@php
$imgSrc = url('/') . '/public/images/admin/common/avatar.png';
@endphp
@section('content')
<section class="content">
  <div class="row">       
	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<div class="create" style="width:400px; margin:0px auto;">
				<h1>Add New</h1>
				{{ Form::open(array('class'=>'form-horizontal has-validation-callback', 'id'=>'registerForm', 'method'=>'POST','enctype' => 'multipart/form-data')) }}	
				<div class="form-group">
					{{ Form::text('name', '', array('class'=>'form-control', 'placeholder' => 'Gym Name', 'autofocus', 'data-validation'=> 'required' ,'data-validation-error-msg-required'=> 'Enter gym name')) }}			
				</div>
				<div class="form-group">
					{{ Form::text('email', '', array('class'=>'form-control', 'autofocus','data-validation'=>'required', 'placeholder' => 'Email', 'id' =>'email')) }}				
				</div>
				<div class="form-group">
                    <div class="image-upload">
                          <div class="file-label" style="text-align: center">Upload Image</div>
                          {{ Form::file('profile_image', ['id' => 'image']) }}
                    </div>
                       <div>
                          {{ Html::image($imgSrc, 'image', array('style' => 'max-width:100px;', 'id' => 'headshot_preview', 'title' => 'Image Preview')) }}
                      </div>
                               
                </div>
				<div class="form-group">
					{{ Form::text('address', '', array('class'=>'form-control', 'placeholder' => 'Address', 'autofocus', 'data-validation'=> 'required')) }}				
				</div>
				<div class="form-group">
					{{ Form::text('latitude', '', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Latitude')) }}				
				</div>
				<div class="form-group">
					{{ Form::text('longitude', '', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Longitude')) }}				
				</div>
				<div class="form-group">					
					{!! Form::label('opening_days','Select Opening Days'); !!}     
					{!! Form::select('opening_days[]',$openingDaysList, null, ['multiple'=>true,'class' => 'form-control chosen-select','id' => 'opening_days', 'autofocus', 'data-validation'=> 'required']) !!}
				</div>
				<div class="form-group date" id="datetimepicker1">
					{!! Form::label('morning_time','Morning Time'); !!}   
					{{ Form::text('morning_from_time', '', array('class'=>'form-control', 'autofocus', 'id'=> 'morning_from_time', 'data-validation'=> 'required', 'placeholder' => 'From')) }}
				</div>
				<div class="form-group">	
					{{ Form::text('morning_to_time', '', array('class'=>'form-control','id'=>'morning_to_time', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'To')) }}				
				</div>
				<div class="form-group">
					{!! Form::label('evening_time','Evening Time'); !!}   
					{{ Form::text('evening_from_time', '', array('class'=>'form-control','id'=>'evening_from_time', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'From')) }}							
				</div>				
				<div class="form-group">	
					{{ Form::text('evening_to_time', '', array('class'=>'form-control','id'=>'evening_to_time', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'To')) }}						
				</div>				
				<div class="form-group">
					{{ Form::text('pass_price', '', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Pass Price')) }}				
				</div>					
				<div class="form-group">
					{{ Form::password('password', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Password')) }} 
				</div>
				<div class="row">
					<div class="col-xs-4">
					  <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
  </div>
</section>
</div>

<script>
$(function() {
	$.validate();
	$('#morning_from_time').datetimepicker();
	$('#morning_to_time').datetimepicker();
	$('#evening_from_time').datetimepicker();
	$('#evening_to_time').datetimepicker();	
});
</script>
@endsection




