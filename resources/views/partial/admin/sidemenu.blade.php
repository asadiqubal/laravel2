<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">
               <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}"><a href="{{url('admin/dashboard')}}"><i class="icon-home"></i>
		      <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
			  </a>
            
          </li>
         
		  <li class=" nav-item"><a href="{{url('admin/industries')}}"><i class="icon-support"></i><span class="menu-title" data-i18n="nav.menu_levels.main">Settings</span></a>
            <ul class="menu-content">
             <!-- <li class="{{ request()->is('admin/payments-terms') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/payments-terms')}}" data-i18n="nav.menu_levels.second_level">Payment Terms</a>
              </li>-->
			  <li class="{{ request()->is('admin/industries') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/industries')}}" data-i18n="nav.menu_levels.second_level">Industries</a>
              </li>
			  <li class="{{ request()->is('admin/supplier-risk-level') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/supplier-risk-level')}}" data-i18n="nav.menu_levels.second_level">Supplier Risk Level</a>
              </li>
			   <li class=" nav-item"><a href="{{url('admin/price-list')}}"><span class="menu-title" data-i18n="nav.menu_levels.main">Billing Setup</span></a>
            <ul class="menu-content">
              <li class="{{ request()->is('admin/add-price') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/add-price')}}" data-i18n="nav.menu_levels.second_level">Add New</a>
              </li>
			  <li class="{{ request()->is('admin/price-list') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/price-list')}}" data-i18n="nav.menu_levels.second_level">List</a>
              </li>
             
            </ul>
          </li>
			<!--  <li class="{{ request()->is('admin/roles') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/roles')}}" data-i18n="nav.menu_levels.second_level">Roles</a>
              </li>-->
            </ul>
          </li>	
		 
		  
		
		  
		  <li class=" nav-item"><a href="{{url('admin/company-list')}}"><i class="icon-layers"></i><span class="menu-title" data-i18n="nav.menu_levels.main">Companies</span></a>
            <ul class="menu-content">
              <li class="{{ request()->is('admin/add-company') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/add-company')}}" data-i18n="nav.menu_levels.second_level">Add New</a>
              </li>
			  <li class="{{ request()->is('admin/company-list') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/company-list')}}" data-i18n="nav.menu_levels.second_level">List</a>
              </li>
             
            </ul>
          </li>
		<!--
		 <li class=" nav-item"><a href="{{url('admin/company-user-list')}}"><i class="icon-user"></i><span class="menu-title" data-i18n="nav.menu_levels.main">Company Users</span></a>
            <ul class="menu-content">
              <li class="{{ request()->is('admin/add-company-users') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/add-company-users')}}" data-i18n="nav.menu_levels.second_level">Add New</a>
              </li>
			  <li class="{{ request()->is('admin/company-user-list') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/company-user-list')}}" data-i18n="nav.menu_levels.second_level">List</a>
              </li>
            </ul>
          </li>-->
		  
		   <li class=" nav-item"><a href="{{url('admin/company-list')}}"><i class="icon-layers"></i><span class="menu-title" data-i18n="nav.menu_levels.main">RFQ </span></a>
            <ul class="menu-content">
			<li class="nav-item {{ request()->is('admin/rfq-range-list') ? 'active' : '' }}"><a href="{{url('admin/rfq-range-list')}}"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="nav.form_repeater.main">RFQ Range List</span></a>
			</li>
             <li class="nav-item {{ request()->is('admin/rfq-range') ? 'active' : '' }}"><a href="{{url('admin/rfq-range')}}"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="nav.form_repeater.main">Add RFQ Range</span></a>
			</li>
			 <li class="nav-item {{ request()->is('admin/rfq-status') ? 'active' : '' }}"><a href="{{url('admin/rfq-status')}}"><i class="icon-check"></i><span class="menu-title" data-i18n="nav.form_repeater.main">RFQ Status</span></a>
          </li>
             
            </ul>
          </li>
		  
         
		  
        </ul>
      </div>
    </div>