@extends('template')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style-tuhospedaje.css') }}">
@endpush
@section('main') 
<div class="main-banner"  style="background-image: url('{{ getBanner() }}');">
	<div class="container margin-top-65 min-height">
	    <div class="d-flex justify-content-center">
			<div class="p-5 mt-5 mb-5 border w-450 floting-window">
					<h2 class="thj-title">{{__('Complete your register')}}</h2>
					<br/>
					<form id="signup_form" name="signup_form" method="post" action="{{ route('registration.create') }}" class='signup-form login-form' accept-charset='UTF-8' onsubmit="return ageValidate();">
						{{ csrf_field() }}
						<div class="row text-16">
							<input type="hidden" name='email_signup' id='form'>
							<input type="hidden" name="default_country" id="default_country" class="form-control">

							<input type="hidden" name="carrier_code" id="carrier_code" class="form-control" value="{{session('loginCode')->carrier_code}}">
                            <input type="hidden" name="phone" id="phone" class="form-control" value="{{session('loginCode')->phone}}">
							<input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control" value="+{{session('loginCode')->carrier_code}}{{session('loginCode')->phone}}" >

							<div class="form-group col-sm-12 p-0">
	                            <label for="first_name">{{ __('First Name') }} <span class="text-13 text-danger">*</span></label>
								@if ($errors->has('first_name')) <p class="error-tag">{{ $errors->first('first_name') }}</p> @endif
								<input type="text" class='form-control text-14 p-2' value="{{ old('first_name') }}" name='first_name' id='first_name' placeholder='{{ __('First Name') }}' maxlength="25">
							</div>

							<div class="form-group col-sm-12 p-0">
	                            <label for="last_name">{{ __('Last Name') }} <span class="text-13 text-danger">*</span></label>
									@if ( $errors->has('last_name') ) <p class="error-tag">{{ $errors->first('last_name') }}</p> @endif
									<input type="text" class='form-control text-14 p-2' value="{{ old('last_name') }}" name='last_name' id='last_name' placeholder='{{ __('Last Name') }}' maxlength="25">
							</div>

							<div class="form-group col-sm-12 p-0">
	                            <label for="email">{{ __('Email') }} <span class="text-13 text-danger">*</span></label>
									<input type="text" class='form-control text-14 p-2' value="{{ old('email') }}" name='email' id='email' placeholder='{{ __('Email') }}' maxlength="100">
									@if ($errors->has('email'))
										<p class="error-tag">
										{{ $errors->first('email') }}
										</p>
									@endif
									<div id="emailError"></div>
							</div>

							<div class="form-group col-sm-12 p-0">
	                            <label for="password">{{ __('Password') }} <span class="text-13 text-danger">*</span></label>
									@if ( $errors->has('password') ) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
									<input type="password" class='form-control text-14 p-2' name='password' id='password' placeholder='{{ __('Password') }}' maxlength="25">
							</div>

							<div class="col-sm-12 p-0">
								<label class="l-pad-none text-16">{{ __('Birthday') }} <span class="text-13 text-danger">*</span></label>
							</div>

							<div class="col-sm-12 p-0">
									@if ($errors->has('birthday_month') || $errors->has('birthday_day') || $errors->has('birthday_year'))
									<p class="error-tag">{{ $errors->first('date_of_birth') }}</p>
									@else
										<p class="error-tag">{{ $errors->first('date_of_birth') }}</p>
									@endif
							</div>


							<div class="form-group col-sm-12 p-0">
									<div class="row">
										<div class="col-sm-4 mt-2">
											<select name='birthday_day' class='form-control text-14' id='user_birthday_day'>
												<option value=''>{{ __('Day') }}</option>
												@for ($m=1; $m<=31; ++$m)
												<option value="{{ $m }}" {{ old('birthday_day') == $m ? 'selected = "selected"' : '' }}>{{ $m }}</option>
												@endfor
											</select>
										</div>

										<div class="col-sm-4 pl-0 mt-2">
												<select name='birthday_month' class='form-control text-14 p-2' id='user_birthday_month'>
													<option value=''>{{ __('Month') }}</option>
														<option value="1" {{ old('birthday_month') == 1 ? 'selected = "selected"' : '' }}>{{ __('January') }}</option>
														<option value="2" {{ old('birthday_month') == 2 ? 'selected = "selected"' : '' }}>{{ __('February') }}</option>
														<option value="3" {{ old('birthday_month') == 3 ? 'selected = "selected"' : '' }}>{{ __('March') }}</option>
														<option value="4" {{ old('birthday_month') == 4 ? 'selected = "selected"' : '' }}>{{ __('April') }}</option>
														<option value="5" {{ old('birthday_month') == 5 ? 'selected = "selected"' : '' }}>{{ __('May') }}</option>
														<option value="6" {{ old('birthday_month') == 6 ? 'selected = "selected"' : '' }}>{{ __('June') }}</option>
														<option value="7" {{ old('birthday_month') == 7 ? 'selected = "selected"' : '' }}>{{ __('July') }}</option>
														<option value="8" {{ old('birthday_month') == 8 ? 'selected = "selected"' : '' }}>{{ __('August') }}</option>
														<option value="9" {{ old('birthday_month') == 9 ? 'selected = "selected"' : '' }}>{{ __('September') }}</option>
														<option value="10" {{ old('birthday_month') == 10 ? 'selected = "selected"' : '' }}>{{ __('October') }}</option>
														<option value="11" {{ old('birthday_month') == 11 ? 'selected = "selected"' : '' }}>{{ __('November') }}</option>
														<option value="12" {{ old('birthday_month') == 12 ? 'selected = "selected"' : '' }}>{{ __('December') }}</option>
												</select>
										</div>

										<div class="col-sm-4 pr-0 mt-2">
										<select name='birthday_year' class='form-control text-14' id='user_birthday_year'>
											<option value=''>{{ __('Year') }}</option>
											@for ($m=date('Y'); $m > date('Y')-100; $m--)
												<option value="{{ $m }}"{{ old('birthday_year') == $m ? 'selected = "selected"' : '' }}>{{ $m }}</option>
											@endfor
										</select>
										</div>
									</div>

								<span class="text-danger text-13">
									<label id='dobError'></label>
								</span>
							</div>

							<button type='submit' id="btn" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 ml-0 mr-0 mb-3"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="btn_next-text">{{ __('Register me') }}</span>
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

<script type="text/javascript" src="{{ asset('public/js/sign-up-login3.js') }}"></script>

@endsection

