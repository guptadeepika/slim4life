@extends('admin.layout.admin')
@section('content')
<div class="content-wrapper">		
	@include('flash_message')
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
						<div class="col-lg-4">                                        
								{{ Form::text('pass_code', app('request')->input('pass_code'), ['placeholder'=>'Pass Code', 'class'=>'form-control']) }}					
						</div>
						<div class="col-lg-4">                                        
								{{ Form::text('gymName', app('request')->input('gymName'), ['placeholder'=>'Gym Name', 'class'=>'form-control']) }}					
						</div>

						<div class="col-lg-4">	
								{{ Form::submit('Search', ['class'=>'btn btn-primary']) }}
						</div>						
					{{ Form::close() }}	
						
				</div>	
			</div>
			  
			 
			<!-- /.box-header -->
			<div class="box-body">
				<table  class="table">
					@if(count($gymPassList) > 0)
					<thead>
						<tr>
							<th>@sortablelink('id')</th>
							<th>@sortablelink('pass_code', 'Pass Code')</th>
                            <th>@sortablelink('gymName', 'Gym Name')</th>
                            <th>@sortablelink('userName', 'User Name')</th>
							<th>@sortablelink('status')</th>
                            <th>@sortablelink('activate_date', 'Activate Date')</th>                       
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
							@foreach($gymPassList as $gymPass)
								<tr>
									<td>{{ $gymPass->id }}</td>
									<td>{{ $gymPass->pass_code }}</td>
									<td>{{ $gymPass->gymName }}</td>
									<td>{{ $gymPass->userName }}</td>
									<td>{{ $gymPass->status }}</td>
                                    <td>{{ !empty($gymPass->activate_date)?$gymPass->activate_date:'----' }}</td>
									<td>
                                        @if($gymPass->status == 'Activated')
                                        
                                        {!! Form::open(array('class'=>'form-horizontal has-validation-callback', 'id'=>'', 'method'=>'POST', 'url'=>url('/admin/gym-passes/change-status/Redeemed').'/'.\Crypt::encryptString($gymPass->id))) !!}														
										{!! Form::button('Redeem', array('type' => 'submit', 'class' => 'pull-left change-status-confirm', 'title' => 'Redeem this pass')) !!}
										{!! Form::close() !!}
                                        
                                        @endif
                                        
                                      
																					
										
											
																  
									</td>
								</tr>
							@endforeach
						 

					</tbody>
					@else
								<td colspan="6" class="error-msg">{{\Config::get('flash_msg.NoRecordFound')}}</td>
						@endif 
				</table>
				 @if(count($gymPassList) > 0)    
					<div class="col-sm-7">
						<div class="pagination"> {!! $gymPassList->links() !!} </div>
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




