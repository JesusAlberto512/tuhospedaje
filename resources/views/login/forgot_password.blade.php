@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style-tuhospedaje.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
@endpush
@section('main')
<div class="main-banner"  style="background-image: url('{{ getBanner() }}');">
	<div class="container margin-top-65 min-height">
		<div class="d-flex justify-content-center">
			<div class="p-5 mt-5 mb-5 border w-450 floting-window">
				<div class="row">
					<h4 class="font-weight-700 text-18">{{ __('Reset Password') }}</h4>
				</div>
					@if (Session::has('message'))
						<div class="row mt-5">
							<div class="col-md-12 text-13  alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
								<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
								{{ Session::get('message') }}
							</div>
						</div>
					@endif

				<form id="forgot_password_form" method="post" action="{{ url('forgot_password') }}" class='signup-form login-form mt-3' accept-charset='UTF-8'>
					{{ csrf_field() }}
					<div class="col-sm-12">
							<p>{{ __('Please enter your email address') }}</p>
						</div>

						<div class="col-sm-12">
							<input type="text" id="email" class="form-control" name="email" placeholder = "Email">
							@if ($errors->has('email'))<label class="text-danger email-error">{{ $errors->first('email') }}</label>@endif
						</div>

						<div class="col-sm-12 mt-4">
							<button id="reset_btn" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 " type="submit" > <i class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="btn_next-text">{{ __('Reset Link has been sent') }}</span>

							</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('validation_script')
	<script type="text/javascript" src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
		'use strict'
		let nextText = "{{ __('Next') }}..";
		let resetLinkSentText = "{{ __('Reset Link has been sent') }}..";
		let fieldRequirdText = "{{ __('This field is required.') }}";
		let maxlengthText = "{{ __('Please enter no more than 255 characters.') }}";
		let validEmailText = "{{ __('Please enter a valid email address.') }}";
		let page = 'forgotPass';
	</script>
	<script type="text/javascript" src="{{ asset('public/js/login.min.js') }}"></script>

@endsection

