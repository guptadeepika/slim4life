@extends('admin.layout.admin')
@php
$imgSrc = url('/') . '/public/admin/images/common/avatar.png';
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
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
           {{ Form::open(array('class'=>'form-horizontal has-validation-callback', 'id'=>'registerForm', 'method'=>'POST','enctype' => 'multipart/form-data')) }}	
              <div class="box-body">
                <div class="form-group">
					<label for="exampleInputEmail1">Gym Name</label>
					{{ Form::text('name', '', array('class'=>'form-control', 'placeholder' => 'Gym Name', 'autofocus', 'data-validation'=> 'required')) }}
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
					{{ Form::text('email', '', array('class'=>'form-control', 'autofocus','data-validation'=>'required email', 'placeholder' => 'Email', 'id' =>'email')) }}
					<span id="availability-status"></span>	
                </div> 
                <div class="form-group">
					<div class="form-group col-lg-6">											
						<label class="formLable">Profile Image</label>	
						{{ Form::file('image', ['class' => 'btn btn-default btn-file', 'id' => 'image']) }}
						
						<span class="imageShow img-preview">
							{{ Html::image($imgSrc, 'image', array('id' => 'imagePreview', 'title' => 'Image Preview')) }}
						</span>
					</div>
                </div>
                <div class="form-group">
                  <label for="exampleInputAddress">Address</label>
                  {{ Form::text('address', '', array('class'=>'form-control', 'placeholder' => 'Address', 'autofocus', 'data-validation'=> 'required')) }}
                </div>                
                <div class="form-group">
                  <label for="exampleInputMobile">Latitude</label>
                  {{ Form::text('latitude', '', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Latitude')) }} 
                </div>
                <div class="form-group">
					<label for="exampleInputMobile">Longitude</label>
					{{ Form::text('longitude', '', array('class'=>'form-control', 'autofocus', 'data-validation'=> 'required', 'placeholder' => 'Longitude')) }}
                </div>
                <div class="form-group">
					{!! Form::label('opening_days','Select Opening Days'); !!}     
					{!! Form::select('opening_days[]',$openingDaysList, null, ['multiple'=>true,'class' => 'form-control chosen-select','id' => 'opening_days', 'autofocus', 'data-validation'=> 'required']) !!}
                </div>
                <div class="form-group">
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
              </div>
              <div class="box-footer">
                {{ Form::submit('Submit', array('class'=>'btn btn-primary btn-block btn-flat')) }}
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
<script>
$(document).ready(function(){
	$('#morning_from_time').datetimepicker({
		autoclose: true
	});
	$('#morning_to_time').datetimepicker();
	$('#evening_from_time').datetimepicker();
	$('#evening_to_time').datetimepicker();	
	$.validate(); 
	
});
</script>
@endsection




