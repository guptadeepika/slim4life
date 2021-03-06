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
						<div class="col-lg-4">                                        
								{{ Form::text('name', app('request')->input('name'), ['placeholder'=>'Name', 'class'=>'form-control']) }}					
						</div>
						<div class="col-lg-4">	
								{{ Form::submit('Search', ['class'=>'btn btn-primary']) }}
						</div>						
					{{ Form::close() }}	
					<div class="col-lg-4">  	
						 <a href="{{url('/admin/feature-add')}}" class="btn btn-primary pull-right addButton">Add</a>
					</div>		
				</div>	
			</div>
			  
			 
			<!-- /.box-header -->
			<div class="box-body">
				<table  class="table">
					@if(count($featurelist) > 0)
					<thead>
						<tr>
							<th>@sortablelink('id')</th>
							<th>@sortablelink('name')</th>
							<th>@sortablelink('status')</th>                        
							<th>Action</th>
						</tr>
					</thead>
					<tbody>						
						@foreach($featurelist as $feature)
							<tr>
								<td>{{ $feature->id }}</td>
								<td>{{ $feature->name }}</td>
								<td>{{ ($feature->status == 1) ? 'Active' : 'Inactive' }}</td>									
								<td>
									{!! Form::open(array('class'=>'form-horizontal has-validation-callback', 'method'=>'POST', 'url'=>url('/admin/edit-feature').'/'.\Crypt::encryptString($feature->id))) !!}														
									{!! Form::button('', array('type' => 'submit', 'class' => 'pull-left fa fa-edit', 'title' => 'Edit Feature')) !!}
									{!! Form::close() !!}											
									
									{!! Form::open(array('class'=>'form-horizontal has-validation-callback', 'method'=>'POST', 'url'=>url('/admin/delete-feature').'/'.\Crypt::encryptString($feature->id))) !!}
									{!! Form::button('', array('type' => 'submit', 'class' => 'delete-confirm pull-left fa fa-trash', 'title' => 'Delete Feature')) !!}
									{!! Form::close() !!}																	  
								</td>
							</tr>
						@endforeach
					</tbody>
					@else
							<td colspan="6" class="error-msg">{{\Config::get('flash_msg.NoRecordFound')}}</td>
					@endif 
				</table>
				 @if(count($featurelist) > 0)    
					<div class="col-sm-7">
						<div class="pagination"> {!! $featurelist->links() !!} </div>
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




