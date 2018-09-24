@extends('admin.layout.admin')
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
		<div class="col-xs-12">
		  <div class="box">
			<div class="box-header">
			  <div class="col-lg-12 searchBox showhidesearch boxShadow">
					{{ Form::open(array('method' => 'get')) }}
						{{ Form::open(array('method' => 'get')) }}
						<div class="col-lg-3">                                        
								{{ Form::text('name', app('request')->input('name'), ['placeholder'=>'Name', 'class'=>'form-control']) }}					
						</div>
						<div class="col-lg-3">                                        
								{{ Form::text('email', app('request')->input('email'), ['placeholder'=>'Email', 'class'=>'form-control']) }}					
						</div>

						<div class="col-lg-3">	
								{{ Form::submit('Search', ['class'=>'btn btn-primary']) }}
						</div>						
					{{ Form::close() }}	
					<div class="col-lg-3">  	
                        <a href="{{url('/admin/create-gym')}}" class="btn btn-primary pull-right addButton">Create Gym</a>                                

					</div>	
                  
                   
				</div>	
			</div>
            <div class="col-lg-12 ">
                <a href="{{request()->fullUrlWithQuery(["export"=>"true"])}}" title="Export data" ><i class="fa fa-share-square-o" aria-hidden="true"></i></a>
            </div>
			 
			<!-- /.box-header -->
			<div class="box-body">
				<table  class="table">
					@if(count($gymList) > 0)
					<thead>
						<tr>
							<th>@sortablelink('id')</th>
							<th>@sortablelink('name', 'Name')</th>
							<th>@sortablelink('email')</th>
							<th>@sortablelink('mobile')</th>                         
							<th>Address</th>                         
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
							@foreach($gymList as $gym)
								<tr>
									<td>{{ $gym->id }}</td>
									<td>{{ $gym->name }}</td>
									<td>{{ $gym->email }}</td>
									<td>{{ $gym->mobile }}</td>
									<td>{{ $gym->address }}</td>
									<td>
										{!! Form::open(array('class'=>'form-horizontal has-validation-callback', 'id'=>'registerForm', 'method'=>'POST', 'url'=>url('/admin/edit-gym').'/'.\Crypt::encryptString($gym->id))) !!}														
										{!! Form::button('', array('type' => 'submit', 'class' => 'pull-left fa fa-edit', 'title' => 'Edit User')) !!}
										{!! Form::close() !!}											
										
										{!! Form::open(array('class'=>'form-horizontal has-validation-callback', 'id'=>'registerForm', 'method'=>'POST', 'url'=>url('/admin/delete-gym').'/'.\Crypt::encryptString($gym->id))) !!}
										{!! Form::button('', array('type' => 'submit', 'class' => 'delete-confirm pull-left fa fa-trash', 'title' => 'Delete User')) !!}
										{!! Form::close() !!}			
																  
									</td>
								</tr>
							@endforeach
						 

					</tbody>
					@else
								<td colspan="6" class="error-msg">{{\Config::get('flash_msg.NoRecordFound')}}</td>
						@endif 
				</table>
				 @if(count($gymList) > 0)    
					<div class="col-sm-7">
						<div class="pagination"> {!! $gymList->links() !!} </div>
					</div>
				@endif
			</div>
			<!-- /.box-body -->
		  </div>
		  </div>
		  <!-- /.box -->
		</div>
		<!-- /.col -->
	</section>

</div>
@include('admin.elements.js_file')     

@endsection




