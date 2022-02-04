@extends('layouts.front')

@section('content')

<section class="page-title">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <!--<span class="text-white">Plan</span>-->
          <h1 class="text-capitalize text-lg text-white">Features</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-padding">
    <div class="container">
	
     <div class="row">
	       <div class="col-md-6 col-sm-12 col-12 pt-4">
		      <img src="{{asset('public/assets/images/Features.jpg')}}" class="img-fluid w-100" />
		   </div>
		   
		    <div class="col-md-6 col-sm-12 col-12 text-justify">
			  <h3 class="text-uppercase mb-3">Create Time with Quoteside</h3>
			  <h6>A simple, yet powerful tool to generate, collect and analyze RFQ's</h6>
			  <ul class="features-list mt-4"> 
			     <li>Quickly import item and supplier data</li>
				 <li>Automatically capture quote responses into an easy-to-use format that exports to Excel for full analysis</li>
				 <li>Prepare, send and receive RFQ's with a few clicks</li>
				 <li>Automated reminder notifications to suppliers of open quotes and deadlines</li>
				 <li>Send to multiple suppliers for fast, efficient and competitive quoting</li>
				 <li>Cuts out time searching through emails and multiple databases for past quotes </li>
				 <li>Developed to integrate with most ERP solutions </li>
				 <li>Quote deadline tracking made simple and effective</li>
				 <li>Automated supplier notifications of bid invitations</li>
				 <li>Secure platform</li>
				 <li>Competitively priced</li>
				 <li>Intuitive</li>
			  </ul>
			  
		   </div>
		   
	 </div>
</div>
</section>

@endsection