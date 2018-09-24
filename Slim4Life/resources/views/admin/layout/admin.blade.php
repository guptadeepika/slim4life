<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>PEDAL | Admin Panel</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
<link href="<?=url('/')?>/public/css/jquery.css" rel="stylesheet" >
<link href="<?=url('/')?>/public/admin/css/bootstrap.min.css" rel="stylesheet">	
<link href="<?=url('/')?>/public/admin/css/font-awesome.min.css" rel="stylesheet">	    
<link href="<?=url('/')?>/public/admin/css/ionicons.min.css" rel="stylesheet">    
<link href="<?=url('/')?>/public/admin/css/AdminLTE.min.css" rel="stylesheet">
<link href="<?=url('/')?>/public/admin/css/_all-skins.min.css" rel="stylesheet">
<link href="<?=url('/')?>/public/admin/css/custom.css" rel="stylesheet">
<link href="<?=url('/')?>/public/css/jquery.timepicker.min.css" rel="stylesheet">

<script src="<?=url('/')?>/public/js/jquery_002.js"></script>
<script src="<?=url('/')?>/public/js/jquery.js"></script>
<!--script src="<?=url('/')?>/public/admin/js/jquery.min.js"></script-->
<script src="<?=url('/')?>/public/admin/js/bootstrap.min.js"></script>
<script src="<?=url('/')?>/public/admin/js/fastclick.js"></script>
<script src="<?=url('/')?>/public/admin/js/adminlte.min.js"></script>
<script src="<?=url('/')?>/public/admin/js/demo.js"></script>
<script src="<?=url('/')?>/public/admin/js/jquery.validate.js"></script>
<script src="<?=url('/')?>/public/js/jquery.confirm.min.js"></script>
<script src="<?=url('/')?>/public/js/jquery.timepicker.min.js"></script>
<script>
    var APP_URL = '<?=url('/')?>';
</script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	@include('admin.elements.header')
	@include('admin.elements.sidebar')
    @include('flash_message')
	@yield('content')
	@include('bootstrap_model')	
	@include('admin.elements.footer')
 </div>
</body>
</html>
