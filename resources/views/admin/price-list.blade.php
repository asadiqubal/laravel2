@extends('layouts.admin.admin')
@section('title', 'Price Setup')
@section("content")
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
			  <div class="content-header-left col-md-6 col-12 mb-1">
				<h3 class="content-header-title">Price Setup</h3>
			  </div>
			  <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
				<div class="breadcrumb-wrapper col-12">
				  <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a>
					</li>
					<li class="breadcrumb-item"><a href="#">Price</a>
                </li>
					<li class="breadcrumb-item active">Price Setup
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
                    <div class="card-body card-dashboard">
                        <table id="exported_data" class="table table-striped table-bordered">
                            <thead>
                               <tr>
								
								<th>No. of Users</th>
                                <th>Price</th>
                                <th>Created Date</th>
                                <th class="notexport">Actions</th>  
                               </tr>
                            </thead>
                            <tbody>

                                @if(isset($price_list) && !empty($price_list) && count($price_list) > 0)
                                    @foreach($price_list as $eachitem)
                                    <tr>
                                        @if($eachitem['end_to'] == 0)
											<td>> {{$eachitem['start_from']}} </td>
										@else
											<td>{{$eachitem['start_from']}} - {{$eachitem['end_to']}}</td>
										@endif
                                        
                                       
                                        <td>${{$eachitem['price']}}</td>
                                        
                                        <td>{{ date('d-m-Y', strtotime($eachitem['created_at'])) }}</td>
                                        <td> <a href="{{url('/admin/edit-price')}}/{{$eachitem['id']}}">Edit</a> | <a  onclick="deleteFunc('PriceSetup',{{$eachitem['id']}})" href="javascript:void(0)">Delete</a></td>
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