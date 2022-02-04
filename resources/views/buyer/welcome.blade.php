<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content=" ">
	<meta name="keywords" content=" ">
	<meta name="author" content=" ">
	<title>Registration - Quoteside</title>
	<link rel="apple-touch-icon" href="{{asset('public/admin/app-assets/images/ico/apple-icon-120.png')}}">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/css/vendors.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/vendors/css/forms/icheck/icheck.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/vendors/css/forms/icheck/custom.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- END VENDOR CSS-->
	<!-- BEGIN ROBUST CSS-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/css/app.min.css')}}">
	<!-- END ROBUST CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/css/core/menu/menu-types/vertical-menu.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/css/core/colors/palette-gradient.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/app-assets/css/pages/login-register.min.css')}}">
	<!-- END Page Level CSS-->
	<!-- BEGIN Custom CSS-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/admin/assets/css/style.css')}}">
    <!-- END Custom CSS-->
  </head>
  <body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-md-4 col-10  p-0">
		    <div class="p-1 text-center"><img src="{{asset('public/admin/app-assets/images/logo.png')}}" alt="Quoteside" class="img-fluid"></div>
			<div class="box-shadow-2">
            <div class="card border-grey Welcome_box border-lighten-3 m-0">
                <div class="card-header border-0 header_text">
                    <div class="card-title text-center">
                       <h3> Welcome to Quoteside</h3>
					   <p class="mb-0 font-medium-1"  style="line-height:18px">Please login with your email and temparray password sent on your regitered email.</p>
                    </div>
                   
                </div>
                <div class="card-content">
                    <div class="card-body">
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
						<form class="form-horizontal form-simple" method="POST" action="{{ url('/buyer/templogin') }}" novalidate>
							 @csrf
							<div class="form-horizontal form-simple" novalidate>
							   <div class="">
								<fieldset class="form-group position-relative has-icon-left mb-0">
									<input name="email" value="{{$username}}" type="email" class="form-control form-control-lg input-lg" id="user-name" placeholder="Email" required>
									<div class="form-control-position">
										<i class="ft-user font-medium-4"></i>
									</div>
								</fieldset>
								<fieldset class="form-group position-relative has-icon-left">
									<input name="password" value="{{$password}}" type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Temporary Password" required>
									<div class="form-control-position">
										<i class="fa fa-key font-medium-4"></i>
									</div>
								</fieldset>
								 <button type="submit" class="btn btn-info btn-lg btn-block welocme_btn round btn-min-width">Sign In</button>
								
								</div>
							</div>
							
						</form>
						
                    </div>
                </div>
                
            </div>
			
			
			<div class="card border-grey change_password border-lighten-3 m-0" style="display:none;">
                <div class="card-header border-0 header_text">
                    <div class="card-title text-center">
                       <h3>Set Your Password</h3>
					   <p class="mb-0 font-medium-1" style="line-height:18px">Please set a new password that youl will use later to login to Quoteside.</p>
                    </div>
                   
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-horizontal form-simple" novalidate>
						   <fieldset class="form-group position-relative has-icon-left mb-0">
									<input type="password" class="form-control form-control-lg input-lg mb-0" id="user-name" placeholder="Your New password" required>
									<div class="form-control-position">
										<i class="fa fa-key font-medium-4"></i>
									</div>
								</fieldset>
								<fieldset class="form-group position-relative has-icon-left">
									<input type="password" class="form-control form-control-lg input-lg" id="user-password" placeholder="Confirm New password" required>
									<div class="form-control-position">
										<i class="fa fa-key font-medium-4"></i>
									</div>
								</fieldset>
								<a href="login.html" class="btn btn-info btn-lg btn-block  round btn-min-width">Save</a>
							
							
							
                        </div>
                    </div>
                </div>
                
            </div>
			
			
			   
			   
			   
			
			</div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('public/admin/app-assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('public/admin/app-assets/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('public/admin/app-assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{asset('public/admin/app-assets/app-assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('public/admin/app-assets/app-assets/js/core/app.min.js')}}"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('public/admin/app-assets/app-assets/js/scripts/forms/form-login-register.min.js')}}"></script>
    <!-- END PAGE LEVEL JS-->
	<script>
	   $(document).ready(function() {
		     $('.welocme_btn').click(function(){
			    //alert("dsfsd");
				$('.Welcome_box').hide();
				//$('.header_text').hide();
				$('.change_password').show();
			 
			 })
	  });
	</script>
  </body>
</html>