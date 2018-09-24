@extends('admin.layout.login')

@section('content')
<div class="register-box">
  <div class="register-logo">
    <a href="{{url('/'.'/admin')}}"><b>PEDAL</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

   {{ Form::open(array('class'=>'register-form', 'id'=>'registerForm', 'method'=>'POST')) }}	
      <div class="form-group has-feedback">
        {{ Form::text('first_name', '', array('class'=>'form-control required', 'placeholder' => 'First Name', 'autofocus')) }}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{ Form::text('last_name', '', array('class'=>'form-control required', 'placeholder' => 'Last Name', 'autofocus')) }}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{ Form::text('email', '', array('class'=>'form-control required', 'placeholder' => 'Email', 'autofocus')) }}
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {{ Form::password('password', array('class'=>'form-control required', 'placeholder' => 'Password')) }} 
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       {{ Form::password('confirm_password', array('class'=>'form-control required', 'placeholder' => 'Confirm Password')) }} 
      </div>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
   {{ Form::close() }}
  </div>
  <!-- /.form-box -->
</div>
@endsection




