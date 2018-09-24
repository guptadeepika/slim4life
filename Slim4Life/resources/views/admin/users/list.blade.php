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
						<a href="{{url('/admin/user/create')}}" class="btn btn-primary pull-right addButton">Create Customer</a>
					</div>
				</div>	
			</div>
			<div class="col-lg-12 ">
                <a href="{{request()->fullUrlWithQuery(["export"=>"true"])}}" title="Export data" ><i class="fa fa-share-square-o" aria-hidden="true"></i></a>
            </div>
			<!-- /.box-header -->
			<div class="box-body">
				<table  class="table">
					@if(count($userList) > 0)
					<thead>
						<tr>
							<th>@sortablelink('id')</th>
							<th>@sortablelink('first_name', 'Name')</th>
							<th>@sortablelink('email')</th>
							<th>@sortablelink('mobile')</th>
							<th>Address</th>                      
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($userList as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->full_name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->mobile }}</td>
								<td>{{ $user->address }}</td>
								<td>
									{!! Form::open(['method' => 'GET', 'route' => ['user.edit', \Crypt::encryptString($user->id)]]) !!}
									{!! Form::button('', array('type' => 'submit', 'class' => 'pull-left fa fa-edit', 'title' => 'Edit User')) !!}
									{!! Form::close() !!}											

									{!! Form::open(['method' => 'DELETE', 'route' => ['user.destroy', \Crypt::encryptString($user->id)]]) !!}
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
				 @if(count($userList) > 0)    
					<div class="col-sm-7">
						<div class="pagination"> {!! $userList->links() !!} </div>
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




