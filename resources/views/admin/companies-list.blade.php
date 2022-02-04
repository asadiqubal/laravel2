@extends('layouts.admin.admin')
@section('title', 'Company List')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Company List</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Company</a>
                </li>
					<li class="breadcrumb-item active">Company List
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
            @if(session('success1'))
			<div class="alert alert-success fade in alert-dismissible show">                
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				 <span aria-hidden="true" style="font-size:20px">×</span>
				</button>
				{{ session('success1') }}
			</div>
			@endif
			@if(session('error'))
			<div class="alert alert-danger fade in alert-dismissible show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true" style="font-size:20px">×</span>
				</button>    
				{{ session('error') }}
			</div>
			@endif
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard table-responsive">
					<!--<a style="float: right;top: 13px;position: relative;" class="btn btn-info" href="{{action('AdminController@exportCompany')}}">Export</a>-->
                       <table id="exported_data" class="table table-striped table-bordered">
                            <thead>
                               <tr>
								
								<th>Company Name</th>
								<th>Contact Name</th>
								<th>Email</th>
								<th>Phone</th>
                                <th>RFQ # Range</th>
                                <th>Created Date</th>
                               <th class="notexport">Actions</th> 
                               </tr>
                            </thead>
                            <tbody>

                                @if(count($company_list) > 0)
                                    @foreach($company_list as $eachitem)
                                    <tr>
                                       
                                        <td>{{$eachitem['name']}}</td>
										 <td>{{$eachitem['contact_name']}}</td>
										 <td>{{$eachitem['email']}}</td>
										  <td>{{$eachitem['phone']}}</td>
                                        <td>{{$eachitem['sequence_letter']}}{{$eachitem['start_from']}} - {{$eachitem['sequence_letter']}}{{$eachitem['end_to']}}</td>
                                        <td>{{$eachitem['created_at']}}</td>
                                        <td><a href="{{url('admin/company-details')}}/{{$eachitem['id']}}">Detail</a> | <a href="{{url('/admin/edit-company')}}/{{$eachitem['id']}}">Edit</a> | <a  onclick="deleteFunccom('Company',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                                
                                
                            </tbody>
                        </table>
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