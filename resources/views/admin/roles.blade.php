@extends("layouts.admin.admin")
@section('title', 'Users Roles')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Roles </h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Settings</a>
                </li>
					<li class="breadcrumb-item active">Roles 
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
               
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								   <th>ID</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 </td>
                                    <td>Admin</td>
                                     <td><a href="#">Edit</a> | <a href="#">Deactivate</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Buyer</td>
                                    <td><a href="#">Edit</a> | <a href="#">Deactivate</a></td>
                                </tr>
                                
                            </tbody>
                        </table>
                   
							
							
							

				   </div>
                </div>
            </div>
        </div>
    </div>
	
	
	<div class="row justify-content-center">
	<div class="col-12">
	
	    <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
						<h4 class="card-title">Add New Role</h4>
						   <div class="row input_fields_wrap">
							   <div class="col-md-6 col-sm-12 col-12">
								   <div><input type="text" class="form-control" placeholder="Add New Role" name="mytext[]"></div>
							   </div>
							   <div class="col-md-6 col-sm-12 col-12">
								  <button class="btn btn-warning">Add New Role</button>
							   </div>
						   </div>
						
	 					</div>
	                </div>	
				 </div>		
	</div>
	</div>
</section>
<!-- DOM - jQuery events table -->
	


        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

   @endsection