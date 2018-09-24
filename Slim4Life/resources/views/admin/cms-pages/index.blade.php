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
						<div class="col-lg-4">                                        
								{{ Form::text('search', app('request')->input('search'), ['placeholder'=>'Page title', 'class'=>'form-control']) }}					
						</div>

						<div class="col-lg-4">	
								{{ Form::submit('Search', ['class'=>'btn btn-primary']) }}
						</div>						
					{{ Form::close() }}	
					<div class="col-lg-4">	
						 <a href="{{url('/admin/cms-pages/create')}}" class="btn btn-primary pull-right addButton">Create New Page</a>
					</div>		
				</div>	
			</div>
			  
			 
			<!-- /.box-header -->
			<div class="box-body">
				 <table class="table">
                            <tbody>                      
                                <tr>
                                    <th>@sortablelink('id')</th>
                                    <th>@sortablelink('title', 'Page Title')</th>
                                    <th>Meta Title</th>
                                    <th>Meta Description</th>
									<th>@sortablelink('heading', 'Page Heading')</th>
									{{--<th>Description</th>--}}                      
                                    <th class="action-col2">Action</th>
                                </tr>					    
                             
								@if(count($cmsPages) > 0)
                                    @foreach($cmsPages as $cmsPage)
                                        <tr>
                                            <td>{{ $cmsPage->id }}</td>
                                            <td>{{ $cmsPage->title }}</td>
                                            <td>{{ $cmsPage->meta_title }}</td>
											<td>{{ $cmsPage->meta_description }}</td>
											<td>{{ $cmsPage->heading }}</td>
											{{--<td>{{ strip_tags($cmsPage->description) }}</td>--}}
                                       
                                            <td>										 
                                                {{ Form::open(['method' => 'GET', 'route' => ['cms-pages.edit', \Crypt::encryptString($cmsPage->id)]]) }}
                                                    {{ Form::button('', array('type' => 'submit', 'class' => 'pull-left fa fa-edit', 'title' => 'Edit CMS')) }}
                                                {{ Form::close() }}											
                                        
                                                {{ Form::open(['method' => 'DELETE', 'route' => ['cms-pages.destroy', \Crypt::encryptString($cmsPage->id)]]) }}
                                                    {{ Form::button('', array('type' => 'submit', 'class' => 'delete-confirm pull-left fa fa-trash', 'title' => 'Delete CMS')) }}
                                                {{ Form::close() }}							  
                                            </td>
                                        </tr>
                                    @endforeach
								@else
									<td colspan="8" class="error-msg">{{\Config::get('flash_msg.NoRecordFound')}}</td>
								@endif                                     
                            </tbody>
                        </table>
				 @if(count($cmsPages) > 0)    
					<div class="col-sm-7">
						<div class="pagination"> {!! $cmsPages->links() !!} </div>
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


























































