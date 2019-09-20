<aside class="col-lg-3 column border-right">
	<form method="GET" action="{{ route('talentsearch') }}" accept-charset="UTF-8" id="seek" name="seek"> 		
		<div class="widget">
			<div class="search_widget_job">
				<div class="field_w_search">
					<input name="keyword" type="text" placeholder="Search Keywords" class="searchcriteria-text" value=""/>
					<i class="la la-search"></i>
				</div><!-- Search Widget -->				
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title open">Experience</h3>
			<div class="posted_widget">
				@foreach ($experience as $key => $value)                        	                                
	            <input type="radio" name="experience" id="exp_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="exp_{{$key}}">{{$value}}</label><br />
	        @endforeach  								
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title open">Job Type</h3>
			<div class="posted_widget">
				@foreach ($job_type as $key => $value)                        	                                
	            <input type="radio" name="job_type" id="exp_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="exp_{{$key}}">{{$value}}</label><br />
	        @endforeach  								
			</div>
		</div>			
		<div class="widget">
			<h3 class="sb-title closed">Industry</h3>
			<div class="specialism_widget">
			<div class="field_w_search">
					<input type="text" placeholder="Search Spaecialisms" />
				</div><!-- Search Widget -->
				<div class="simple-checkbox scrollbar">					
				</div>
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title closed">Career Level</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
													
				</div>
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title closed">Offerd Salary</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
				<p><input type="checkbox" name="smplechk" id="1"><label for="1">10k - 20k</label></p>
				<p><input type="checkbox" name="smplechk" id="2"><label for="2">20k - 30k</label></p>
				<p><input type="checkbox" name="smplechk" id="3"><label for="3">30k - 40k</label></p>
				<p><input type="checkbox" name="smplechk" id="4"><label for="4">40k - 50k</label></p>
				</div>
			</div>
		</div>				 		
		<div class="widget">
			<h3 class="sb-title closed">Experince</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
				<p><input type="checkbox" name="smplechk" id="9"><label for="9">1Year to 2Year</label></p>
				<p><input type="checkbox" name="smplechk" id="10"><label for="10">2Year to 3Year</label></p>
				<p><input type="checkbox" name="smplechk" id="11"><label for="11">3Year to 4Year</label></p>
				<p><input type="checkbox" name="smplechk" id="12"><label for="12">4Year to 5Year</label></p>
				</div>
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title closed">Gender</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
				<p><input type="checkbox" name="smplechk" id="13"><label for="13">Male</label></p>
				<p><input type="checkbox" name="smplechk" id="14"><label for="14">Female</label></p>
				<p><input type="checkbox" name="smplechk" id="15"><label for="15">Others</label></p>
				</div>
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title closed">Industry</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
				<p><input type="checkbox" name="smplechk" id="16"><label for="16">Meezan Job</label></p>
				<p><input type="checkbox" name="smplechk" id="17"><label for="17">Speicalize Jobs</label></p>
				<p><input type="checkbox" name="smplechk" id="18"><label for="18">Business Jobs</label></p>
				</div>
			</div>
		</div>
		<div class="widget">
			<h3 class="sb-title closed">Qualification</h3>
			<div class="specialism_widget">
				<div class="simple-checkbox">
				<p><input type="checkbox" name="smplechk" id="19"><label for="19">Matriculation</label></p>
				<p><input type="checkbox" name="smplechk" id="20"><label for="20">Intermidiate</label></p>
				<p><input type="checkbox" name="smplechk" id="21"><label for="21">Gradute</label></p>
				</div>
			</div>
		</div>				 		
	</form>	
</aside>