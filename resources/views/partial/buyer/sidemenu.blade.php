 <div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
				  <li class="nav-item"><a href="{{url('buyer/dashboard')}}"><i class="icon-home"></i>
					  <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
					  </a>
					
				  </li>
				  <li class="nav-item"><a href="#"><i class="icon-settings"></i> Setup</a>
									<ul class="menu-content">
									
									  <li><a href="#"> Product Group</a>
									     <ul>
										  <li class="{{ request()->is('buyer/add-product-group') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/add-product-group')}}">Add</a></li>
										  <li class="{{ request()->is('buyer/product-group-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/product-group-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									  <li><a href="#">Ship to Location</a>
									     <ul>
										  <li class="{{ request()->is('buyer/add-ship-location') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/add-ship-location')}}">Add</a></li>
										  <li class="{{ request()->is('buyer/ship-location-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/ship-location-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									  <li><a href="#">Payment Terms</a>
									     <ul>
										  <li class="{{ request()->is('buyer/add-payment-terms') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/add-payment-terms')}}">Add</a></li>
										  <li class="{{ request()->is('buyer/payment-terms-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/payment-terms-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									  <li><a href="#">Ship Method</a>
									     <ul>
										  <li class="{{ request()->is('buyer/add-ship-method') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/add-ship-method')}}">Add</a></li>
										  <li class="{{ request()->is('buyer/ship-method-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/ship-method-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									   <li><a href="#">Delivery Terms</a>
									     <ul>
										  <li  class="{{ request()->is('buyer/add-delivery-terms') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/add-delivery-terms')}}">Add</a></li>
										  <li  class="{{ request()->is('buyer/delivery-terms-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{url('buyer/delivery-terms-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									  <li><a href="#">Unit of Measures</a>
										<ul>
										  <li class="{{ request()->is('buyer/add-unit-measures') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/add-unit-measures')}}">Add</a></li>
										  <li class="{{ request()->is('buyer/unit-measures-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/unit-measures-list')}}">List</a></li>
										</ul>
									  </li>
									  
									   <li><a href="#">Items</a>
									     <ul>
										  <li  class="{{ request()->is('buyer/add-item') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/add-item')}}">Add</a></li>
										  <li  class="{{ request()->is('buyer/import-items') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/import-items')}}">Import Items</a></li>
										  <li  class="{{ request()->is('buyer/item-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/item-list')}}">List</a></li>
										</ul>
									  
									  </li>
									  
									  
									  <li><a href="#">Suppliers</a>
										<ul>
										  <li  class="{{ request()->is('buyer/add-supplier') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/add-supplier')}}">Add</a></li>
										   <li  class="{{ request()->is('buyer/import-supplier') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/import-supplier')}}">Import Supplier</a></li>
										  <li  class="{{ request()->is('buyer/supplier-list') ? 'active' : '' }}"><a class="dropdown-item" href="{{ url('buyer/supplier-list')}}">List</a></li>
										  <!--<li><a href="supplier-risk-level.html">Supplier Risk Level</a></li>-->
										</ul>
									  </li>
									</ul>
				  </li>
				  <?php
					$user_role = Auth::user()->role_id;
					if($user_role != 3){
				  ?>
				  <li class="nav-item"><a href="#"><i class="ft-align-left"></i> Users</a>
						<ul class="menu-content">
						  <li class="{{ request()->is('buyer/add-user') ? 'active' : '' }}"><a href="{{ url('buyer/add-user')}}">Create New</a></li>
						  <li class="{{ request()->is('buyer/user-list') ? 'active' : '' }}"><a href="{{ url('buyer/user-list')}}">List</a>
						  </li>
						</ul>
				  </li>
				  <?php
					}
				  ?>
				   <li class="nav-item"><a href="#"><i class="ft-align-left"></i> Manage RFQ's</a>
									<ul class="menu-content">
									  <li class="{{ request()->is('buyer/create-rfq') ? 'active' : '' }}"><a href="{{ url('buyer/create-rfq')}}">Create RFQ</a></li>
									    <li class="{{ request()->is('buyer/draft-rfq-list') ? 'active' : '' }}"><a href="{{ url('buyer/draft-rfq-list')}}">Drafts </a>
									  </li>
									  <li class="{{ request()->is('buyer/rfq-list') ? 'active' : '' }}"><a href="{{ url('buyer/rfq-list')}}">RFQ List</a>
									  </li>
									</ul>
				  </li>
				</ul>
      </div>
    </div>