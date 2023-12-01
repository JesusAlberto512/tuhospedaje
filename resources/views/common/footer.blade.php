{{--Footer Section Start --}}
<footer class="main-panel card border footer-bg p-4 d-none d-lg-block" id="footer">
    <div class="container-fluid container-fluid-90">
        <div class="row">
            <div class="col-6 col-sm-3 mt-4">
                <h2 class="font-weight-700">{{ __('Hosting') }}</h2>
                <div class="row">
                    <div class="col p-0">
                        <ul class="mt-1">
                            @if (isset($footer_first))
                                @foreach ($footer_first as $ff)
                                <li class="pt-3 text-16">
                                    <a href="{{ url($ff->url) }}">{{ $ff->name }}</a>
                                </li>

                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-3 mt-4">
                <h2 class="font-weight-700">{{ __('Company') }}</h2>
                <div class="row">
                    <div class="col p-0">
                        <ul class="mt-1">
                            @if (isset($footer_second))
                                @foreach ($footer_second as $fs)
                                <li class="pt-3 text-16">
                                    <a href="{{ url($fs->url) }}">{{ $fs->name }}</a>
                                </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-3 mt-4">
                 @if (!top_destinations()->isEmpty())
                    <h2 class="font-weight-700">{{ __('Top Destination') }}</h2>
                    <div class="row">
                        <div class="col p-0">
                            <ul class="mt-1">
                                    @foreach (top_destinations() as $pc)
                                        <li class="pt-3 text-16">
                                            <a href="{{ url('search?location=' .  $pc->name . '&checkin=' . date('d-m-Y') . '&checkout=' . date('d-m-Y') . '&guest=1">') }}">{{ $pc->name }}</a>
                                        </li>
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>


            <div class="col-6 col-sm-3 mt-5">
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('/') }}">{!! getLogo('img-130x32') !!}</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="social mt-4">
                        <ul class="list-inline text-center">
                            @if (isset($join_us))
                                @for ($i=0; $i<count($join_us); $i++)
                                    @if ($join_us[$i]->value <> '#')
                                        <li class="list-inline-item">
                                            <a class="social-icon  text-color text-18" target="_blank" href="{{ $join_us[$i]->value }}" aria-label="{{ $join_us[$i]->name }}"><i class="fab fa-{{ str_replace('_','-',$join_us[$i]->name) }}"></i></a>
                                        </li>
                                    @endif
                                @endfor
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-center text-underline">
                            <a href="#" aria-label="modalLanguge" data-toggle="modal" data-target="#languageModalCenter"> <i class="fa fa-globe"></i> {{ Session::get('language_name')  ?? 'Español' }} </a>
                            <a href="#" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter"> <span class="ml-4">{!! Session::get('symbol')  !!} - <u>{{ Session::get('currency')  }}</u> </span></a>
                        </div>
                    </div>
                </div>
        </div>
    </div>

	<div class="border-top p-0 mt-4">
		<div class="row  justify-content-between p-2">
			<p class="col-lg-12 col-sm-12 mb-0 mt-4 text-14 text-center">
			© 2017-{{ date('Y') }} {{ 'TuHospedaje' }}. {{ __('All Rights Reserved') }}</p>
		</div>
	</div>
</footer>
@if(Auth::user())
<footer id="bar-menu-movil-bottom" class="bar-menu-movil-bottom d-lg-none d-flex justify-content-around align-items-center footer-bg border-top px-2 py-2">
    <div class="text-center px-1 item {{ request()->routeIs("search") ? 'active' : '' }}">
        <a href="{{ route("search") }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg><br>
            {{ __('LBL_EXPLORE') }}
        </a>
    </div>
    <div class="text-center px-1 item {{ request()->routeIs("favorite") ? 'active' : '' }}">
        <a href="{{ route("favorite") }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg><br>
            {{ __('LBL_FAVORITES') }}
        </a>
    </div>
    <div class="text-center px-1 item {{ request()->routeIs("tripsActive") ? 'active' : '' }}">
        <a href="{{ route("tripsActive") }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-airplane-fill" viewBox="0 0 16 16">
                <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.376-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Z"/>
            </svg><br>
            {{ __('LBL_TRAVELS') }}
        </a>
    </div>
    <div class="text-center px-1 item {{ request()->routeIs("inbox") ? 'active' : '' }}">
        <a href="{{ route("inbox") }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
            </svg><br>
            {{ __('LBL_MESSAGES') }}
        </a>
    </div>
    <div class="text-center px-1 item {{ request()->routeIs("userProfile") ? 'active' : '' }}">
        <a href="{{ route("userProfile") }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg><br>
            {{ __('LBL_PROFILE') }}
        </a>
    </div>
</footer>
@endif

<div class="row">
    {{--Language Modal --}}
    <div class="modal fade mt-5 z-index-high" id="languageModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 pt-3">
                        <h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle">{{ __('Choose Your Language') }}</h5>
                    </div>

                    <div>
                        <button type="button" class="close text-28 mr-2 filter-cancel" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body pb-5">
                    <div class="row">
                        @foreach ($language as $key => $value)
							<div class="col-md-6 mt-4">
								<a href="javascript:void(0)" class="language_footer {{ (Session::get('language') == $key) ? 'text-success' : '' }}" data-lang="{{ $key }}">{{ $value }}</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

    {{--Currency Modal --}}
    <div class="modal fade mt-5 z-index-high" id="currencyModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="w-100 pt-3">
						<h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle">{{ __('Choose a Currency') }}</h5>
					</div>

					<div>
						<button type="button" class="close text-28 mr-2 filter-cancel font-weight-500" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>

				<div class="modal-body pb-5">
					<div class="row">
						@foreach ($currencies as $key => $value)
						<div class="col-6 col-sm-3 p-3">
							<div class="currency pl-3 pr-3 text-16 {{ (Session::get('currency') == $value->code) ? 'border border-success rounded-5 currency-active' : '' }}">
								<a href="javascript:void(0)" class="currency_footer " data-curr="{{ $value->code }}">
									<p class="m-0 mt-2  text-16">{{ $value->name }}</p>
									<p class="m-0 text-muted text-16">{{ $value->code }} - {!! $value->org_symbol !!} </p>
								</a>
							</div>
						</div>
						@endforeach

					</div>
				</div>
			</div>
        </div>
    </div>
</div>
