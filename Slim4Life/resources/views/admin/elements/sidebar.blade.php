<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <ul class="sidebar-menu" data-widget="tree">
		<li><a href="{{url('/admin/dashboard')}}"><i class="fa fa-home fa-fw"></i>Dashboard</a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/user')}}"><i class="fa fa-circle-o"></i>Users List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Manage Gym</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/gym-list')}}"><i class="fa fa-circle-o"></i>Gym List</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-money"></i> <span>Manage Payments history</span>
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="javascript:void(0);"><i class="fa fa-circle-o"></i>History List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket"></i>
            <span>Manage Passes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="gym-passes"><i class="fa fa-circle-o"></i> Passes List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pencil"></i>
            <span>Manage Gym Request</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="edit_req"><i class="fa fa-circle-o"></i> Edit Request List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i>
            <span>Manage CMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/cms-pages')}}"><i class="fa fa-circle-o"></i> Page List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i>
            <span>Manage Activities</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="activity-list"><i class="fa fa-circle-o"></i> Activity List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-list-alt"></i>
            <span>Manage Features</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="feature-list"><i class="fa fa-circle-o"></i> Feature List</a></li>
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart"></i>
            <span>Reports and statistics</span>  
             <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>          
          </a> 
          <ul class="treeview-menu">
            <li><a href="javascript:void(0);"><i class="fa fa-circle-o"></i>Reports List</a></li>
            <li><a href="javascript:void(0);"><i class="fa fa-circle-o"></i>Reports Chart</a></li>
          </ul>         
        </li> -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sliders"></i>
            <span>Settings</span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>           
          </a>   
          <ul class="treeview-menu">
            <li><a href="my-profile"><i class="fa fa-circle-o"></i>Edit Profile</a></li>
            <li><a href="change-password"><i class="fa fa-circle-o"></i>Change Password</a></li>
          </ul>       
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
