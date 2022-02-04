<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head> 
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quoteside </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  
  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	
    <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.css')}}" />
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Outline&family=Open+Sans:ital,wght@0,600;0,800;1,400&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
	<link rel="stylesheet" href="{{asset('public/assets/css/main.css')}}"> 
	<link rel="stylesheet" href="{{asset('public/assets/css/animate.min.css')}}"> 
 </head>
<body>
  
<header class="main-header">
    <div class="container">
	    <div class="row justify-content-center">
		      <div class="col-lg-5 col-md-7 col-sm-12 col-12 pt-4 pb-3">
			     <a href="{{url('/')}}"><img src="{{asset('public/assets/images/logo.png')}}" class="img-fluid" /></a>
			  </div>
			  
			  <div class="col-12 text-center">
			     <nav class="navbar navbar-expand-lg navbar-light">
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  </button>
					  <div class="collapse navbar-collapse" id="navbarNav">
					   <ul class="navbar-nav m-auto">
						  <li class="nav-item ">
							<a class="nav-link" href="{{url('features')}}">Features</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="{{url('pricing')}}">Pricing</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="{{url('about-us')}}">Company</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="{{url('contact')}}">Contact us</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="{{url('industry-news')}}">Industry News</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="{{url('schedule-demo')}}">Schedule Demo</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="javascript:void();" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
						  </li>
						 
						</ul> 
					  </div>
											
				</nav>
			  
			  </div>
		</div>
	</div>
</header> 

@yield('content')


<footer class="footer_bg">
	<div class="container">
<div class="row justify-content-center">
	<div class="col-md-4 col-sm-12 col-12 mb-md-0 mb-4">
	<h3 class="footer_tile">Why QUOTESIDE?</h3>
	 <ul>
	    <li><a href="{{url('contact')}}">Contact Us</a> </li>
		<li><a href="#">Our platform</a> </li>
		<li><a href="{{url('integration')}}">Integration</a> </li>
	 </ul>
	</div>
    <div class="col-md-4 col-sm-12 col-12 mb-md-0 mb-4">
		<h3 class="footer_tile">FOR BUYERS</h3>
		 <ul>
			<li><a href="#">FAQs</a> </li>
			<li><a href="#">Request a Demo</a> </li>
			<li><a href="#">Pricing</a> </li>
		 </ul>
	</div>
    <div class="col-md-4 col-sm-12 col-12 mb-md-0 mb-4">
		<h3 class="footer_tile">FOR SUPPLIERS</h3>
		 <ul>
			<li><a href="#">Hows it works</a> </li>
			<li><a href="#">Testimonials</a> </li>
			<li><a href="#">Advertise with us</a> </li>
		 </ul>
	</div>
</div>
</div>
</footer>

<section class="copyright-section">
     <div class="container">
	     <div class="row">
			<div class="col-12 text-center "><h3 class="text-white">COPYRIGHT 2021 QUOTESIDE</h3></div>
		 </div>
	 </div>
</section>

<!-- Modal -->
<div class="modal fade loginbox" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
       <div class="modal-body">
                                <h3 class="title">User Login</h3>
                                <p class="description">Login with Quoteside</p>
									@if(session('loginerror'))
										<div class="alert alert-danger fade in alert-dismissible show">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:9px;">
											  <span aria-hidden="true" style="font-size:20px">×</span>
											</button>    
											{{ session('loginerror') }}
										</div>
										@endif
										
                               <form class="form-horizontal form-simple" method="POST" action="{{ url('loginApi') }}" novalidate>
									 @csrf
										<div class="form-group">
											<span style="top:22px;" class="input-icon"><i class="fa fa-user"></i></span>
												<input type="text" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" id="user-name" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" required>
												<div class="form-control-position">
													<i class="ft-user font-medium-4"></i>
												</div>
												  @error('email')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										<div class="form-group">
										   <span style="top:22px;" class="input-icon"><i class="fas fa-key"></i></span>
											 <input id="user-password" placeholder="Enter Password" required type="password" class="form-control form-control-lg input-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
										   
										   
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
										<div class="form-group row">
											<div class="col-md-6 col-12 text-center text-md-left">
												<fieldset>
													<input type="checkbox" id="remember-me" class="chk-remember">
													<label for="remember-me"> Remember Me</label>
												</fieldset>
											</div>
											
											 @if (Route::has('password.request'))
												 <div class="col-md-6 col-12 text-center text-md-right"><a href="{{url('forgot-password')}}" class="card-link">Forgot Password?</a></div>
												
												
											@endif
											
											
										</div>
										<button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
									</form>
                            </div>
      
    </div>
  </div>
</div>



<script>
    setInterval(function(){
        if(document.activeElement instanceof HTMLIFrameElement){
            document.getElementById('cover').style.opacity=0;
            document.getElementById('player').style.opacity=1;
        }
    } , 50);
	

</script>
<script src="{{asset('public/assets/js/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/js/wow.min.js')}}"></script>
<script src="{{asset('public/assets/js/custom.js')}}"></script>


<script>
		var loginerror = "<?php echo session('loginerror'); ?>";
		var error = "";
		if($('.invalid-feedback strong').length > 0){
			var error = $('.invalid-feedback strong').html();
		}

		if(loginerror == ""){
			if(error == ''){
		
				var loginerror = "";
			}else{
				var loginerror = "1";
			}
		}
		
	
		$(document).ready(function(){
			if(loginerror != ""){
				$('#exampleModalCenter').modal('show');
			}
		});
</script>

</body>
</html>
