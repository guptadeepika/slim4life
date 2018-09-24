@extends('admin.layout.login')

@section('content')
	<div class="login-box">
	  <div class="login-logo">
		<a href="{{url('/').'/admin'}}"><b>PEDAL</b></a>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
		<p class="login-box-msg">Sign in to start your session</p>

		{{ Form::open(array('class'=>'login-form', 'id'=>'loginForm', 'method'=>'POST')) }}	
		  <div class="form-group has-feedback">
		    {{ Form::text('email', null, array('class'=>'form-control required', 'placeholder' => 'Email', 'autofocus')) }}
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		  </div>
		  <div class="form-group has-feedback">
			{{ Form::password('password', array('class'=>'form-control required', 'placeholder' => 'Password')) }} 
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		  </div>
		  <div class="row">
			<div class="col-xs-8">
			  <div class="checkbox icheck col-xs-12">
				<label>
				  {{ Form::checkbox('remember', 'Yes') }} Remember Me
				</label>
			  </div>
			</div>
			<!-- /.col -->
			<div class="col-xs-4">
			{{ Form::submit('Sign In!', array('class'=>'btn btn-primary btn-block btn-flat')) }} 
			  
			</div>
			<!-- /.col -->
			</div>
			{{ Form::close() }}
	  </div>
	  <!-- /.login-box-body -->
	</div>

@endsection




