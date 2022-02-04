@extends('layouts.front')

@section('content')

<section class="page-title">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <!--<span class="text-white">Plan</span>-->
          <h1 class="text-capitalize text-lg text-white">Schedule Demo</h1>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section-padding">
    <div class="container">
	
     <div class="row">
	       <div class="col-md-6 col-sm-12 col-12 mb-md-0 mb-4">
		      <div class="schedule-box">
			      <h4>Schedule Your <br/>
Personal Demo</h4>				  
				  <p>Get in touch with our experts that will guide you through a live customized demo of Quoteside. Explore all the features that will make your RFx process more efficient and streamlined.</p>
                  
                  {{-- error --}}
			 @if(session('success'))
				<div class="alert alert-success fade in alert-dismissible show">                
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					 <span aria-hidden="true" style="font-size:20px">×</span>
					</button>
					{{ session('success') }}
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
				
            <form action="{{url('submitscheduleDemo')}}" method="post" role="form" class="php-email-form">
				@csrf			   
			   <div class="row mt-5">
				    <div class="col-md-6 col-sm-12 col-12"> 
					     <div class="form-group">
							  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
						  </div>
					</div>
					<div class="col-md-6 col-sm-12 col-12"> 
					      <div class="form-group">
							  <input type="Email" name="email" class="form-control" id="email" placeholder="Your Email" required="">
						  </div>
					</div>
					<div class="col-md-12 col-sm-12 col-12"> 
					      <div class="form-group">
							  <input type="text" name="company" class="form-control" id="company" placeholder="Company Name" required="">
						  </div>
					</div>
					<div class="col-md-6 col-sm-12 col-12"> 
					     
							  <input type="submit" name="submit" class="btn btn-warning" value="Request a Demo">
						  
					</div>
				</div>
				</form>
			  </div>
		   </div>
		   
		   <div class="col-md-6 col-sm-12 col-12 p-4">
		      <img src="{{asset('public/assets/images/schedule.png')}}" class="img-fluid" />
		   </div>
		   
		
		   
	 </div>
</div>
</section>







@endsection