@extends('layouts.front')

@section('content')


<section class="page-title">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <!--<span class="text-white">Plan</span>-->
          <h1 class="text-capitalize text-lg text-white">Company</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-padding">
    <div class="container">
	
     <div class="row">
	       <div class="col-md-6 col-sm-12 col-12 pt-4">
		      <img src="{{asset('public/assets/images/company.jpg')}}" class="img-fluid w-100" />
		   </div>
		   
		    <div class="col-md-6 col-sm-12 col-12 text-justify">
			<div class="section-title ">
			  <h6 class="text-uppercase mb-3">About us</h6>
			  <h3 class="text-uppercase mb-3">Company</h3>
			  </div>
		      <p>Quoteside was founded by purchasing professionals who have been in the purchasing field for over 30 years. Our experts have years of valuable experience in the food, retail, biotech, aerospace and defense, electronics and service industries. During this time, it was discovered that many organizations lacked robust and efficient tools to use in the quoting process. Manual quoting, individual emails and a lack of centralized quote data analysis led to delays and inefficient quoting and buying. This was our foundation and inspiration. After months of collecting input from purchasing professionals, Quoteside was imagined and created.</p>
			  <p>Quoteside will help you eliminate inefficiency to focus on competitive buying!</p>
			  
		   </div>
		   
	 </div>
</div>
</section>


@endsection

