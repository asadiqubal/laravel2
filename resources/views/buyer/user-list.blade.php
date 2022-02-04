@extends("layouts.buyer.buyer")
@section('title', 'User List')
@section("content")




    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">User List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('buyer/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Company</a>
                </li>
					<li class="breadcrumb-item active">User List
					</li>
				  </ol>
				</div>
			  </div>
        </div>
        <div class="content-body"><!-- Sales stats -->
		
				<section id="dom">
    
        <div class="col-12">
            <div class="card">
               
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
					<!--<a class="btn btn-info" href="{{action('AdminController@export')}}">Export</a>-->
					  
					  
					  
					
					   <div class="dataTables_scroll table-responsive">
					   
<style>
table.dataTable{overflow:auto;}
</style>					   
					   
                        <table id="exported_data" class="table table-striped table-bordered">
                            <thead>
                               <tr>
								<th>Contact Name</th>
                                
                                <th>Contact Email</th>

								<!--<th>Contact Phone</th>
								<th>Register Link</th>
								-->
							
                
								<th>Created Date</th>
								
                                <th class="notexport">Actions</th>    
                               </tr>
                            </thead>
                            <tbody>
								@if(count($company_user_list) > 0)
                                    @foreach($company_user_list as $eachitem)
                                    <tr>
                                      
										<!--<td>{{$eachitem['company_name']}}</td>-->
                                        <td>{{$eachitem['name']}}</td>
										
                                        <td>{{$eachitem['email']}}</td>

										<!--<td>{{$eachitem['phone']}}</td>-->
									
                    
                                        <td>{{$eachitem['created_at']}}</td>
										<?php /*
											if(isset($eachitem['encoded_id']) && !empty($eachitem['encoded_id'])){
										?>
                                        <td>https://sitestagingserver.xyz/quoteside/buyer/registration/{{$eachitem['encoded_id']}}</td>
										<?php
											}else{
										?>
										<td>https://sitestagingserver.xyz/quoteside/buyer/registration/<?php echo base64_encode($eachitem['id']); ?></td>
										<?php
											}*/
										?>
                                        <td> <a href="{{url('/buyer/edit-user')}}/{{$eachitem['id']}}">Edit</a> | <a  onclick="deleteFunc('User',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                            </tfoot>
                        </table>
						
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

<script>

    function statusChange(status,id){
        if(confirm("Are you sure you want to change status?")){
            window.location.href = "{{ url('/admin/changeRfqStatus') }}/"+status+'/'+id;
        }
        else{
            return false;
        }

    }

</script>
