@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style-tuhospedaje.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
@endpush

@section('main')
<div class="main-banner"  style="background-image: url('{{ getBanner() }}');">
	<div class="container margin-top-65 min-height">
		<div class="d-flex justify-content-center">
			<div class="p-5 mt-5 mb-5 border w-450 floting-window" >
				<h2 class="thj-title">{{__('login')}}</h2>
				<br/>

				<form id="login_form" method="post" action="{{ url('authenticate') }}"  accept-charset='UTF-8'>
					{{ csrf_field() }}
					<div class="form-group col-sm-12 p-0">
	                    <label for="first_name">{{ __('Email') }} <span class="text-13 text-danger">*</span></label>
						@if ($errors->has('email'))
							<p class="error">{{ $errors->first('email') }}</p>
						@endif
						<input type="email" class="form-control text-14" value="{{ old('email') }}" name="email" placeholder = "{{ __('Email') }}">
					</div>

					<div class="form-group col-sm-12 p-0">
	                    <label for="first_name">{{ __('Password') }} <span class="text-13 text-danger">*</span></label>
						@if ($errors->has('password'))
							<p class="error">{{ $errors->first('password') }}</p>
						@endif
						<input type="password" class="form-control text-14" value="" name="password" placeholder = "{{ __('Password') }}">
					</div>

					<div class="form-group col-sm-12 p-0 mt-3" >
						<div class="d-flex justify-content-between">
							<div class="m-3 text-14">
								<input type="checkbox" class='remember_me' id="remember_me2" name="remember_me" value="1">
								{{ __('Remember me') }}
							</div>

							<div class="m-3 text-14">
								<a href="{{ url('forgot_password') }}" class="forgot-password text-right">{{ __('Forgot password?') }}</a>
							</div>
						</div>
					</div>

					<div class="form-group col-sm-12 p-0" >
						<button type='submit' id="btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-success w-100"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="btn_next-text">{{ __('Login') }}</span>
						</button>
					</div>
				</form>
				@if ($social['google_login'])
					<a href="{{ url('googleLogin') }}">
						<button class="btn btn-outline-danger pt-3 pb-3 text-16 w-100 mt-3">
							<span><i class="fab fa-google-plus-g  mr-2 text-16"></i>  {{ __('Sign up with Google') }}</span>
						</button>
					</a>
				@endif
				<div class="mt-3 text-14">
					{{ __('Don’t have an account?') }}
					<a href="{{ url('mobile-authenticate') }}" class="font-weight-600">
					{{ __('Register') }}
					</a>
				</div>

				@if ($social['google_login'] || $social['facebook_login'])
	                    <p class="text-center font-weight-700 mt-1">  </p>
	            @endif

				@if (Session::has('message'))
					<div class="row mt-3">
						<div class="col-md-12 p-2 text-center text-14 alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
							<a href="#"  class="close text-18" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('message') }}
						</div>
					</div>
				@endif
	               

	               

	                
			</div>
		</div>
	</div>
</div>
@endsection

@section('validation_script')
<script type="text/javascript" src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	'use strict'
	let fieldRequirdText = "{{ __('This field is required.') }}";
	let maxlengthText = "{{ __('Please enter no more than 255 characters.') }}";
	let validEmailText = "{{ __('Please enter a valid email address.') }}";
	let loginText = "{{ __('Login') }}..";
	let page = 'login';

		
</script>
<script type="text/javascript" src="{{ asset('public/js/login.min.js') }}"></script>

@endsection
