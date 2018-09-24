@extends('admin.layout.admin')

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Password
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
            <!-- /.box-header -->
            <!-- form start -->
            {{ Form::open(array('id'=>'adminForm', 'method'=>'POST')) }}
           
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Current Password</label>
				 {{ Form::password('old_password', ['placeholder'=>'Enter Current Password', 'class'=>'form-control required', 'data-validation'=> 'required']) }}
                </div>
                <div class="form-group">
                   <label for="exampleInputEmail1">New Password</label>
					  {{ Form::password('password', ['id' => 'password', 'placeholder'=>'Enter New Password', 'class'=>'form-control required ', 'minlength'=>'6', 'maxlength'=>'16', 'data-validation'=> 'required']) }}
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm New Password</label>
					{{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'placeholder'=>'Enter Confirm Password', 'class'=>'form-control required', 'data-validation'=> 'required']) }}
                </div>              
              </div>
              <!-- /.box-body -->                
              <div class="box-footer">
                {{ Form::submit('Submit', array('class'=>'btn btn-primary btn-block btn-flat')) }}
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<script>
    $(document).ready(function(){

       $("#adminForm").validate();
    });
</script>
@endsection




