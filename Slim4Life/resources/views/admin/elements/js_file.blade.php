<script>
    $(document).ready(function(){
        $(".delete-confirm").click(function(e) {
	   e.preventDefault();
            confirmModel("{{\Config::get('flash_msg.ConfirmDelete')}}", this);
        });
        
        $(".change-status-confirm").click(function(e) {
            e.preventDefault();
            
            confirmModel("{{\Config::get('flash_msg.ConfirmChangeStatus')}}", this);
        });
    });
    function confirmModel(msg, $this)
	{
		$.confirm({
			text: msg,
			confirm: function() {	
				$($this).closest("form").submit();
			},
			cancel: function() {	
				return false;
			}
		});	
	}

	function alertModel(msg)
	{
		var bootstrapModal = $('#bootstrapAlertModal');
		bootstrapModal.find('.modal-body').text(msg);
		bootstrapModal.modal('show');
	}
    
</script>
