@extends('template.include.master')

@section('main')
	<section>
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="main-featured-sec witherror">
							<ul class="main-slider-sec text-arrows">
								<li><img src="http://placehold.it/1600x800" alt="" /></li>
								<li><img src="http://placehold.it/1600x800" alt="" /></li>
								<li><img src="http://placehold.it/1600x800" alt="" /></li>
							</ul>
							<div class="error-sec">
								<img src="{{ URL::asset('new/images/404.png') }}" alt="" />
								<span>We Are Sorry, Page Not Found</span>
								<p>Unfortunately the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exist. Check the Url you entered for any mistakes and try again.</p>
								<form>
									<input type="text" placeholder="Enter any Keyword" /><button type="submit"><i class="la la-search"></i></button>
								</form>
								<h6><a href="{{route('mainindex')}}" title="">Back To Homepage</a></h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop
