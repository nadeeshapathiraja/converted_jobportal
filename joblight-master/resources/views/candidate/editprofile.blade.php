@extends('include.global_template')
@include('include.candidate.mainheader')
@section('main')
<div id="feature-wrapper">
    <div class="container">
        <div class="row 200%">
            <div class="12u 12u$(medium) important(medium)">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>                    
                </ul>   
            </div>
            <div class="12u 12u$(medium) important(medium)" style="padding-top:10px;">
            	@if($mode == 'view')				
					<iframe src="{{URL::to('/internal/profile')}}" height='1000px' width='100%' onload="resizeIframe(this)"></iframe>				
				@else
					<iframe src="{{URL::to('/internal/profile/edit')}}" height='1000px' width='100%' ></iframe>
				@endif
            </div>
        </div>
    </div>
</div>
@if($mode == 'edit')		

@endif
@stop
@section('scripts')
<script>
  function resizeIframe(obj) {
    var ht = obj.contentWindow.document.body.scrollHeight;
    if(ht > 0)
        obj.style.height = ht + 'px';
  }
</script>
@stop