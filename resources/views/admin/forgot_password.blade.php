@extends('layouts.app')

@section("content")
    <div class="row"> 
        <div class="col-md-6 leftBg">
            <img src="/assets/media/loginImage.svg" width="700" class="img-responsive" alt="" title="">
        </div>
        <div class="col-md-6">
            <div class="text-center sdi-logo">
                <!-- <img src="assets/media/sdi-logo.svg" width="" class="img-responsive" alt="" title=""> --> 
            </div>
			<form action="{{url('/admin/forgot_password_link')}}" class="form loginform">
            
                <div class="login-panel newForm">
                    <div class="logoRa text-center">
                        <img src="/assets/media/kaushlam_logo.png" width="" class="img-responsive" alt="" title="">
                    </div>
                    <h1>Forgot Password</h1>
                        <div class="form-group">
                            <!-- <label class="control-label">Username</label> -->
                            <input type="text" name="email" class="form-control" required="required" placeholder="Email">
                        </div>
                        <div class="inlineRow">
                            <div class="checkbox">
                                <a href="{{url('/admin/login')}}">Back To Login?</a>
                            </div>
                            <button type="submit" class="btn btn-blue loginField">Confirm</button>
                        </div>
                </div>
           </form>
        </div>
    </div>
@endsection