<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img style="width: 200x; height:200px" src="{{asset('backend/images/zawad_logo.jpeg')}}" alt="Stata logo">
						  {{-- <h3><b>NART</b> <span style="color: rgb(255, 255, 255)" >by</span> <b>ZANA</b></h3> --}}
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		<li>
          <a href="index.html">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>
		
        <li class="treeview">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('category.view') }}"><i class="ti-more"></i>Category</a></li>
            <li><a href="{{ route('subCategory.view') }}"><i class="ti-more"></i>Sub Category</a></li>
          </ul>
        </li> 

        <li class="treeview">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('product.add') }}"><i class="ti-more"></i>Add Product</a></li>
            <li><a href="{{ route('manage-product') }}"><i class="ti-more"></i>Manage Product</a></li>
          </ul>
        </li>  

         <li class="treeview">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('shipped-product') }}"><i class="ti-more"></i>View Orders</a></li>
          </ul>
        </li> 


        <li class="treeview">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('all-reports') }}"><i class="ti-more"></i>View Reports</a></li>
          </ul>
        </li> 
		  
        

        {{-- <li class="header nav-small-cap">User Interface</li>
		
		  
		  
		<li>
          <a href="auth_login.html">
            <i data-feather="lock"></i>
			<span>Log Out</span>
          </a>
        </li> 
        
      </ul> --}}
    </section>
	
  </aside>