<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="<?=url('/')?>/public/admin/css/bootstrap.min.css" rel="stylesheet">	
	<link href="<?=url('/')?>/public/admin/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">	    
	<link href="<?=url('/')?>/public/admin/css/ionicons.min.css" rel="stylesheet">    
	<link href="<?=url('/')?>/public/admin/css/admin.css" rel="stylesheet">
	<link href="<?=url('/')?>/public/admin/css/plugins/iCheck/square/blue.css" rel="stylesheet">
  
		<script src="<?=url('/')?>/public/admin/js/jquery.min.js"></script>
		<script src="<?=url('/')?>/public/admin/js/bootstrap.min.js"></script>
		
		<script src="<?=url('/')?>/public/admin/js/iCheck/icheck.min.js"></script>


</head>
<body class="hold-transition login-page">
    @include('flash_message')
	   @yield('content') 

</body> 
    
</html>
