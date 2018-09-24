@php
	$imageFolderUrl = \Config::get('constants.ImageFolderUrl');
@endphp

<script id="upload-template" type="text/template">
    <div class="file-container">
        {{ Form::file('record_images[image][]', ['class' => 'upload-file', 'multiple']) }}
    </div>
</script>
        
<script type="text/javascript"> 
    //Multiple images preview in browser
    var divCount = 1;
    var imagesPreview = function(input, divCount) {	
                            if(input.files)
                            {
                                var filesAmount = input.files.length;
                    
                                for (i = 0; i < filesAmount; i++)
                                {
                                    var reader = new FileReader();
                    
                                    reader.onload = function(event) {
                                        var uploadedImageHtml = '<div class="thumbnail_box">';
                                        uploadedImageHtml += '<img alt="Thumbnail Image" title="Image Preview" src="' + event.target.result + '">';
                                        uploadedImageHtml += '<i class="fa fa-close remove-uploaded-file" id="' + divCount + '"></i>';
                                        uploadedImageHtml += '</div>';
                                        
                                        $('.thumbnail_section').append(uploadedImageHtml);
                                        $('.photo-error').html('');
                                    }
                    
                                    reader.readAsDataURL(input.files[i]);
                                }
                            }	
                        };
                        
    var template = $('#upload-template').html();            
    $('#uploads').append(template);
                        
    $(document).on('change', '.upload-file',function(){
        $(this).parent('.file-container').attr('id', 'file-input-' + divCount);
        $(this).parent('.file-container').css({'display': 'none'});
        
        imagesPreview(this, divCount);
        
        divCount++;
        
        $('#uploads').append(template);
    });
 
    var deletedFilenames = '';
    $(document).on("click", ".delete-file", function(){
        deletedFilenames = deletedFilenames  + ',' + $(this).attr('id');
         
        $("#deleted_files").attr('value', deletedFilenames);		  
         
        var id = $(this).attr('id');
        $(this).parents('.thumbnail_box').remove();
        $('#file-input-' + id).remove();
    });	
		
    $(document).on("click", ".remove-uploaded-file", function(){
        var id = $(this).attr('id');
        $(this).parents('.thumbnail_box').remove();
        $('#file-input-' + id).remove();
    });
	
	$(document).on('change', '#upload-image',function(){
		uploadedImagePreview(this);		
	});
		
	function uploadedImagePreview(input)
	{
		if(input.files && input.files[0])
		{
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('.thumbnail_box').show();
				
				var uploadedFileName = $("#upload-image").val();
				var extension = uploadedFileName.split('.').pop().toLowerCase();
				var imagePreviewSrc = '';
				
				switch(extension){
					case 'jpg': imagePreviewSrc = e.target.result; break;
					case 'jpeg': imagePreviewSrc = e.target.result; break;
					case 'png': imagePreviewSrc = e.target.result; break;
					case 'doc': imagePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/doc.png'; break;
					case 'docx': imagePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/doc.png'; break;
					case 'pdf': imagePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/pdf.png'; break;
					case 'mp3': imagePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/mp3.png'; break;
					case 'mp4': imagePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/mp4.png'; break;
					default:
						imagePreviewSrc = '';
				}
				
				$('#image_preview').attr('src', imagePreviewSrc);
			};
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	/*for multiple file upload on same page*/
	$(document).on('change', '.attach-file',function(){
		uploadedFilePreview(this, $(this).attr('id'));		
	});
	
	function uploadedFilePreview(input, elementId = null)
	{
		if(input.files && input.files[0])
		{
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('#' + elementId + '_preview_box').show();
				
				var uploadedFileName = input.files[0].name;
				var extension = uploadedFileName.split('.').pop().toLowerCase();
				var filePreviewSrc = '';
				
				switch(extension){
					case 'jpg': filePreviewSrc = e.target.result; break;
					case 'jpeg': filePreviewSrc = e.target.result; break;
					case 'png': filePreviewSrc = e.target.result; break;
					case 'doc': filePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/doc.png'; break;
					case 'docx': filePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/doc.png'; break;
					case 'pdf': filePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/pdf.png'; break;
					case 'mp3': filePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/mp3.png'; break;
					case 'mp4': filePreviewSrc = '{{ $imageFolderUrl }}' + 'front/common/mp4.png'; break;
					default:
						filePreviewSrc = '';
				}
				
				$('#' + elementId + '_preview').attr('src', filePreviewSrc);
			};
	
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
