@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')		
	<div id="features-wrapper">
		<div class="container">		
            <div class="row">     	         
                <div class="6u 12u(medium)">
                <!-- Box -->
                    <section class="box feature">
                        <form method="POST" id="my_form" action="{{Route('confirmcredits', 100)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}    
                            <a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;" class="image featured">
                            <div class="inner">
                                <div class="main_box_create"></div>    
                                <header>
                                    <h2>Buy 100 Credits</h2>
                                    <p>Use to download resumes</p>
                                </header>
                                <p></p>
                            </div>
                            </a>                  
                        </form>                         
                    </section>
                </div>    
                <div class="6u 12u(medium)">
                <!-- Box -->
                    <section class="box feature">
                        <form method="POST" id="my_form_500" action="{{Route('confirmcredits', 500)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}    
                            <a href="javascript:{}" onclick="document.getElementById('my_form_500').submit(); return false;" class="image featured">
                            <div class="inner">
                                <div class="main_box_create"></div>    
                                <header>
                                    <h2>Buy 500 Credits</h2>
                                    <p>Use to download resumes</p>
                                </header>
                                <p></p>
                            </div>
                            </a>                  
                        </form>                         
                    </section>
                </div>   
             </div>                                                                      
		</div>
	</div>

@stop
