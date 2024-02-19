<ul class="list-group customlisting">
	<li>
		<a class="btn  text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'basics'?'btn-primary':'btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/basics"):"#" }}">{{ __('Basics') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'description'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/description"):"#" }}">{{ __('Description') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'location'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/location"):"#" }}"> {{ __('Location') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'amenities'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/amenities"):"#" }}"> {{ __('Amenities') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'photos'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/photos"):"#" }}"> {{ __('Photos') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'pricing'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/pricing"):"#" }}"> {{ __('Pricing') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'booking'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/booking"):"#" }}"> {{ __('Booking') }}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'calendar'?'btn-primary':' btn-outline-secondary' }}" href="{{ $result->status != ""? url("listing/" . $result->id . "/calendar"):"#" }}"> {{ __('Calender') }}</a>
	</li>
</ul>
