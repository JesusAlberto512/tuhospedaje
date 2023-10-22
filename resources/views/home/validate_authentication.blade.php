@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style-tuhospedaje.css') }}">
@endpush
@section('main')
<div class="container mb-4 margin-top-85 min-height">
    <div class="d-flex justify-content-center">
		<div class="p-5 mt-5 mb-5 border w-450">
			<h2 class="thj-title">{{__('confirm phone')}}</h2>
			<small class="thj-politics">{{__('guide sms')}}<br/>
				+56 978949157
			</small>
			<br/>
			<hr/>
				<form id="form_verify_code" name="form_verify_code" method="post" action="{{ route('validate-mobile.update') }}" class='signup-form login-form' accept-charset='UTF-8'>
					{{ csrf_field() }}
					<div class="row text-16">
                        @if (session('loginCode'))
                            <input type="hidden" name="field02" id="field02" class="form-control" value="{{session('loginCode')->code_id}}">
                            <input type="hidden" name="field04" id="field04" class="form-control" value="{{session('loginCode')->phone}}">
                        @endif

						<div class="form-group col-sm-12 p-0">
                            <label for="validation_code">{{ __('Validation Code') }}</label>
							@if ($errors->has('validation_code')) <p class="error-tag">{{ $errors->first('validation_code') }}</p> @endif
							<input type="number" class="code-validation form-control text-14 p-2" value="{{ old('validation_code') }}" name='field06' id='field06' placeholder='------' maxlength="6" onKeyPress="if( this.value.length == 6 ) return false; ">
						</div>

						<div class="form-group col-sm-12 p-0">
							<span class="text-danger text-13">
								<label id='dobError'></label>
							</span>
						</div>

						<button type='submit' id="btn" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 ml-0 mr-0 mb-3"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text">{{ __('Sign Up') }}</span>
						</button>
					</div>
				</form>

			</div>
    </div>
</div>
@endsection

@section('validation_script')
<script type="text/javascript" src="{{ asset('public/js/jquery.validate.min.js') }}"></script>

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
	let minAge = "{{ __('You are not old enough!') }}";
</script>

<script type="text/javascript" src="{{ asset('public/js/sign-up-login.js') }}"></script>

@endsection

