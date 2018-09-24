@extends('admin.layout.admin')
@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Account        
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
            <div class="box-header with-border">
              <h3 class="box-title">Update Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			{{ Form::model($user, array( 'method' => 'PUT','id'=>'addEditForm')) }}
           
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
		    {{ Form::text('first_name', null, array('class'=>'form-control required', 'id'=>'firstName','placeholder' => 'First Name')) }}
                </div>
                 <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
		    {{ Form::text('last_name', null, array('class'=>'form-control required', 'id'=>'lastName','placeholder' => 'Last Name')) }}
                </div> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Email Id</label>
		    {{ Form::text('email', null, array('class'=>'form-control required',  'id'=>'emailId','placeholder' => 'Email Id' ,'')) }}
                </div>          
              
                <div class="form-group">
                  <label for="exampleInputMobile">Mobile</label>
                  {{ Form::text('mobile',null, array('class'=>'form-control required', 'placeholder' => 'Mobile')) }} 
                </div>
                 
                
              </div>
              <!-- /.box-body -->
                
              <div class="box-footer">
                {{ Form::submit('Submit', array('class'=>'btn btn-primary btn-block btn-flat')) }}
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
    $(document).ready(function(){
       $('#addEditForm').validate(); 
    });
    </script>
@endsection




