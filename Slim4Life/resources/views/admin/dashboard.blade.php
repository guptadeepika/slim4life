@extends('admin.layout.admin')

@section('content')
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      
        @include('admin.elements.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- Small boxes (Stat box) -->
  <div class="row">
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-aqua">
		<div class="inner">
		  <h3>{{$gymCount}}</h3>

		  <p>Total Number of Gyms</p>
		</div>
		<div class="icon">
		  <i class="fa fa-user-plus"></i>
		</div>
		<a href="{{url('admin/gym-list')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-green">
		<div class="inner">
		  <h3>{{$customerCount}}</h3>

		  <p>Total number of users</p>
		</div>
		<div class="icon">
		  <i class="fa fa-user-plus"></i>
		</div>
		<a href="{{url('admin/user')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-yellow">
		<div class="inner">
		  <h3>{{$activatedGymPassCount}}</h3>

		  <p>Total active passes</p>
		</div>
		<div class="icon">
		  <i class="fa fa-ticket"></i>
		</div>
		<a href="{{url('admin/gym-passes')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-blue">
		<div class="inner">
		  <h3>{{$purchasedGymPassCount}}</h3>

		  <p>Purchased passes</p>
		</div>
		<div class="icon">
		  <i class="fa fa-ticket"></i>
		</div>
		<a href="{{url('admin/gym-passes')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	  <!-- small box -->
	  <div class="small-box bg-red">
		<div class="inner">
		  <h3>{{$redeemedGymPassCount}}</h3>

		  <p>Redeemed passes</p>
		</div>
		<div class="icon">
		  <i class="fa fa-ticket"></i>
		</div>
		<a href="{{url('admin/gym-passes')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	  </div>
	</div>
	<!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
	<!-- Left col -->
	
	
  </div>
  <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>	
@endsection



