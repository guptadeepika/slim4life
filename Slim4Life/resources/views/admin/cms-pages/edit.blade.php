@extends('admin.layout.admin')

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit
      </h1>
      
        @include('admin.elements.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
          
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$subTitle}}
                    </div>
                        
                    <div class="panel-body">						
                        {!! Form::model($cmsPage, array('route' => array('cms-pages.update', \Crypt::encryptString($cmsPage->id)), 'id' => 'cmsPageForm', 'method' => 'PUT')) !!}							
                            <div class="row">
                                <div class="col-lg-12">									
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            {{ Form::label('title', 'Page Title') }}
                                            {{ Form::text('title', null, ['placeholder'=>'Page Title', 'class' => 'form-control required', 'maxlength' => '20']) }}
                                        </div>
                                        <div class="form-group col-lg-6">
                                            {!! Form::label('meta_title') !!}
                                            {{ Form::text('meta_title', null, ['placeholder'=>'Meta Title', 'class' => 'form-control', 'maxlength' => '250']) }}
                                        </div>									
                                    </div>
								
									<div class="row">
										<div class="form-group col-lg-6">
                                            {!! Form::label('meta_description') !!}
                                            {{ Form::text('meta_description', null, ['placeholder'=>'Meta Description', 'class' => 'form-control']) }}
										</div>
										<div class="form-group col-lg-6">	
											{!! Form::label('heading', 'Page Heading') !!}
                                            {{ Form::text('heading', null, ['placeholder'=>'Page Heading', 'class' => 'form-control required', 'maxlength' => '100']) }}
										</div>
									</div>
                                        
                                    <div class="row">
										<div class="form-group col-lg-12">
                                            {!! Form::label('description') !!}	
											{{ Form::textarea('description', null, ['id'=>'description', 'placeholder'=>'Description', 'class'=>'form-control required']) }}
										</div>
									</div>									
									
                                    {{ Form::submit('Submit', ['class'=>'btn btn-default']) }}
                                    {{ Form::reset('Reset', ['class' => 'btn btn-default']) }}
                                </div>
                            </div>
						{{ Form::close() }}
                    </div>
                </div>
            </div>
		</div>
    </section>
    </div>
        
    {!! Html::script('/public/plugins/template-editor/ckeditor-4-full/ckeditor.js'); !!}	
		
	<script>
		$(document).ready(function(){
            CKEDITOR.replace('description');
            
            $("#cmsPageForm").validate({
                ignore: [],
                debug: false,
                rules: {
                    description: {
                        required: function() 
                        {
                            CKEDITOR.instances.description.updateElement();
                        }
                    }
                },
                messages: {
                    description: {
                        required: "{{\Config::get('flash_msg.FieldRequired')}}"
                    }
                }
            });
            
            $("form").submit( function(e) {
                var descriptionLength = CKEDITOR.instances['description'].getData().replace(/<[^>]*>/gi, '').length;
    
                if(!descriptionLength)
                {    
                    alertModel("{{\Config::get('flash_msg.EnterDescription')}}");
    
                    e.preventDefault();    
                }    
            });
		});
	</script>
@endsection