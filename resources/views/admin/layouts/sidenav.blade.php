 <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('home') }}"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
      
     <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Productions</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="quick-link" href="{{ route('worker.index') }}" target="iBody"><i class="fa fa-circle-o text-green"></i>Add new Worker</a></li>
            <li><a class="quick-link" href="{{ route('product.index') }}" target="iBody"><i class="fa fa-circle-o text-green"></i>Add new Product</a></li>
            <li><a class="quick-link" href="{{ route('production.index') }}" target="iBody"><i class="fa fa-circle-o text-green"></i> Production entry</a></li>
          
          </ul>              
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>