@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/js/intl-tel-input-13.0.0/build/css/intlTelInput.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style-tuhospedaje.css') }}">
@endpush
@section('main')
<div class="main-banner"  style="background-image: url('{{ getBanner() }}');">
	<div class="container margin-top-65 min-height">
	    <div class="d-flex justify-content-center">
			<div class="p-5 mt-5 mb-5 border w-450 floting-window">
				<h2 class="thj-title">{{__('login or register')}}</h2>
	                <br/>
					<form id="signup_form" name="signup_form" method="post" action="{{ route('authenticate.store') }}" class='signup-form login-form' accept-charset='UTF-8' >
						{{ csrf_field() }}
						<div class="row text-16">
							<input type="hidden" name='email_signup' id='form'>
							<input type="hidden" name="default_country" id="default_country" class="form-control">
							<input type="hidden" name="carrier_code" id="carrier_code" class="form-control">
							<input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control">


							<div class="form-group col-sm-12 p-0">
	                            <label for="phone">{{ __('Phone') }} <span class="text-13 text-danger">*</span></label>
									<input type="tel" class="form-control text-14 p-2" id="phone" name="phone">
									<span id="tel-error" class="text-13 text-danger"></span>
									<span id="phone-error" class="text-13 text-danger"></span>
							</div>
							<small class="thj-politics">{{__('terms and prices')}}</small>

							
							<button type='submit' id="btnPhone" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 ml-0 mr-0 mb-3"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="btn_next-text">{{ __('Sign Up') }}</span>
							</button>
						</div>
					</form>

					 @if ($social['google_login'] || $social['facebook_login'])
						<p class="text-center font-weight-700 mt-1">- {{ __('or') }} -</p>
					@endif

					 @if ($social['facebook_login'])
						<a href="{{ isset($facebook_url) ? $facebook_url : url('facebookLogin') }}">
							<button class="btn btn-outline-primary pt-3 pb-3 text-16 w-100">
								<span><i class="fab fa-facebook-f mr-2 text-16"></i> {{ __('Sign up with Facebook') }}</span>
							</button>
						</a>
					@endif

					@if ($social['google_login'])
						<a href="{{ url('googleLogin') }}">
							<button class="btn btn-outline-danger pt-3 pb-3 text-16 w-100 mt-3">
								<span><i class="fab fa-google-plus-g  mr-2 text-16"></i>  {{ __('Sign up with Google') }}</span>
							</button>
						</a>
					@endif
						<a href="{{ url('login') }}">
							<button class="btn btn-outline-secondary pt-3 pb-3 text-16 w-100 mt-3">
								<span><!--i class="fab fa-google-plus-g  mr-2 text-16"></i-->
								<i class="far fa-envelope mr-2 text-16"></i>
								  {{ __('Sign up with Mail') }}</span>
							</button>
						</a>

				</div>
	    </div>
	</div>
</div>
@endsection

@section('validation_script')
<script type="text/javascript" src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/intl-tel-input-13.0.0/build/js/intlTelInput.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

<script type="text/javascript">

	'use strict'
	let requiredFieldText = "{{ __('This field is required.') }}";
	let minLengthText = "{{ __('Please enter at least 6 characters.') }}";
	let maxLengthText = "{{ __('Please enter no more than 255 characters.') }}";
	let oldLimitationText = "{{ __('Age must be greater than 18.') }}";
	let validEmailText = "{{ __('Please enter a valid email address.') }}";
	let checkUserURL = "{{ route('checkUser.check') }}";
	var token = "{{ csrf_token() }}";
	let emailExistText = "{{ __('Email address is already Existed.') }}";
	let validInternationalNumber = '{{ __("Please enter a valid International Phone Number.") }}';
    let numberExists = "{{ __('The number has already been taken!') }}";
	let signedUpText = "{{ __('Sign Up') }}..";
	let baseURL = "{{ url('/') }}";
	let duplicateNumberCheckURL = "{{ url('duplicate-phone-number-check') }}";
</script>

<script type="text/javascript" src="{{ asset('public/js/sign-up-login2.js') }}"></script>

@endsection

