@extends('layouts.front')

@section('content')



<section class="page-title">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <!--<span class="text-white"></span>-->
          <h1 class="text-capitalize text-lg text-white">Get in Touch</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Contact Us</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>

<section class="contact section-padding">
    <div class="container">
	
	    <!-- <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <h3>Our Address</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <h3>Email Us</h3>
              <p>info@quoteside.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>

        </div>---->
		
		<div class="row">

         <div class="col-lg-6 ">
                <div class="theme-background contact-details">
				    <div class="image"><img src="{{asset('public/assets/images/contact.png')}}"/> </div>
				    <ul class=""> 
					   <li><i class="fas fa-map-marker-alt mr-2" aria-hidden="true"></i> 30 North Gould Street Sheridan, Wyoming 82801</li>
					   <li><i class="fas fa-phone mr-2" aria-hidden="true"></i> <a href="tel:7752253122">(775) 225-3122</a> </li>
					   <li><i class="fas fa-envelope mr-2" aria-hidden="true"></i> <a href="mailto:info@quoteside.com">info@quoteside.com</a> </li>
					</ul>
				</div>
          </div>

          <div class="col-lg-6">
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
				
            <form action="{{url('submitContact')}}" method="post" role="form" class="php-email-form">
				@csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>
              </div>
			  <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="company" class="form-control" id="company" placeholder="Company" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" required="">
                </div>
              </div>
            
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required=""></textarea>
              </div>
              <!--<div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>-->
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>
		
		
	</div>
</section>

@endsection

<script>
    setInterval(function(){
        if(document.activeElement instanceof HTMLIFrameElement){
            document.getElementById('cover').style.opacity=0;
            document.getElementById('player').style.opacity=1;
        }
    } , 50);
</script>

<script src="assets/js/jquery-3.0.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>