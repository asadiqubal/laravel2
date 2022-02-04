@extends('layouts.front')

@section('content')



<section class="page-title">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <!--<span class="text-white">Plan</span>-->
          <h1 class="text-capitalize text-lg text-white">Pricing</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-padding">
    <div class="container">
	
	<div class="row"> 
	
	   <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4">
	    <div class="card card-pricing text-center">
            <span class="h6 w-100 mx-auto mb-0 bg-pricing-plan  text-white shadow-sm">Individual</span>
            <div class="bg-pricing-box card-header">
                <h1 class="h1 plan-pricing font-weight-normal text-warning  text-center mb-4 position-relative" data-pricing-value="15"><span class="doller-sign">$</span><span class="price">29</span><span class="h6 text-white ml-2">/ Month</span></h1>
				<p>(Billed Annually)</p>
            </div>
            <div class="card-body pt-4">
                <ul class="list-unstyled mb-0">
                    <li><i class="far fa-check-circle text-success mr-2" aria-hidden="true"></i> 1 User</li>
                  
                </ul>
                
            </div>
			<hr/>
            <button type="button" class="btn btn-outline-warning order-btn mb-3">Order Now</button>
        </div>
	   
	   </div>
	   
	   <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4">
	       <div class="card card-pricing text-center">
            <span class="h6 w-100 mx-auto mb-0 bg-pricing-plan  text-white shadow-sm">BASIC</span>
            <div class="bg-pricing-box card-header">
                <h1 class="h1 plan-pricing font-weight-normal text-warning  text-center mb-4 position-relative" data-pricing-value="15"><span class="doller-sign">$</span><span class="price">19</span><span class="h6 text-white ml-2">/ Month</span></h1>
				<p>Per User up to 5 Licenses<br/>(Billed Annually)</p>
            </div>
            <div class="card-body pt-4">
                <ul class="list-unstyled mb-0">
                    <li><i class="far fa-check-circle text-success mr-2" aria-hidden="true"></i>2-5 Users</li>
                  
                </ul>
                
            </div>
			<hr/>
            <button type="button" class="btn btn-outline-warning order-btn mb-3">Order Now</button>
        </div>
	   
	   </div>
	   <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4">
	        <div class="card card-pricing text-center">
				<span class="h6 w-100 mx-auto mb-0 bg-pricing-plan  text-white shadow-sm">PROFESSIONAL</span>
				<div class="bg-pricing-box card-header">
					<h1 class="h1 plan-pricing font-weight-normal text-warning  text-center mb-4 position-relative" data-pricing-value="15"><span class="doller-sign">$</span><span class="price">15</span><span class="h6 text-white ml-2">/ Month</span></h1>
					<p>Per User up to 10 Licenses<br/>(Billed Annually)</p>
				</div>
				<div class="card-body pt-4">
					<ul class="list-unstyled mb-0">
						<li><i class="far fa-check-circle text-success mr-2" aria-hidden="true"></i>6-10 Users</li>
					  
					</ul>
				   
				</div>
				<hr/>
				<button type="button" class="btn btn-outline-warning order-btn mb-3">Order Now</button>
			</div>
	   
	   </div>
	   <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-lg-0 mb-4">
	        
		 <div class="card card-pricing text-center">
            <span class="h6 w-100 mx-auto mb-0 bg-pricing-plan text-white shadow-sm">ENTERPRISE</span>
            <div class="bg-pricing-box last-box card-header">
                <p>Call us for special licensing pricing</p>
            </div>
            <div class="card-body pt-4">
                <ul class="list-unstyled mb-0">
                    <li><i class="far fa-check-circle text-success mr-2" aria-hidden="true"></i>11+ Users</li>
                  
                </ul>
				
            </div>
			<hr/>
            <button type="button" class="btn btn-outline-warning order-btn mb-3">Order Now</button>
        </div>
	   </div>
	   
	</div>
	
	
</div>
</section>





@endsection