<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">
               <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class=" nav-item {{ request()->is('supplier/dashboard') ? 'active' : '' }}"><a href="{{url('supplier/dashboard')}}"><i class="icon-home"></i>
		      <span class="menu-title" data-i18n="nav.dash.main">Dashboard</span>
			  </a>
            
          </li>
         
		 
		 
		  
		   <li class=" nav-item"><a href="{{url('supplier/rfq-list')}}"><i class="icon-layers"></i><span class="menu-title" data-i18n="nav.menu_levels.main">RFQ List </span></a>
            <ul class="menu-content">
			<li class="nav-item {{ request()->is('supplier/rfq-list') ? 'active' : '' }}"><a href="{{url('supplier/rfq-list')}}"><i class="icon-shuffle"></i><span class="menu-title" data-i18n="nav.form_repeater.main">RFQ List</span></a>
			</li>
             
			 
          </li>
             
            </ul>
          </li>
		  
         
		  
        </ul>
      </div>
    </div>