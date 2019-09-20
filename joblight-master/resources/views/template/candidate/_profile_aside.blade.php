	<aside class="col-lg-3 column border-right">
 		<div class="widget">
 			<div class="tree_widget-sec">
 				<ul class="nav"> 					
				    <li class="nav-child active" id="tab_contact_nav">
				    	<a class="editnavbar" data-toggle="tab" href="#tab_contact" form="form-save-contact"> <i class="la la-user"></i> {{ trans('front/candidate.tab_1') }}</a>
				    </li>
				    <li class="nav-child" id="tab_work_nav">
				    	<a class="editnavbar" data-toggle="tab" href="#tab_work" form="form-save-work"> <i class="la la-briefcase"></i> {{ trans('front/candidate.tab_2') }}</a>
				    </li>
				    <li class="nav-child" id="tab_school_nav">
				    	<a class="editnavbar" data-toggle="tab" href="#tab_school" form="form-save-school"> <i class="la la-money"></i> {{ trans('front/candidate.tab_3') }}</a>
				    </li>
				    <li class="nav-child" id="tab_addskill_nav">
				    	<a class="editnavbar" data-toggle="tab" href="#tab_addskill" form="form-save-skill"> <i class="la la-paper-plane"></i> {{ trans('front/candidate.tab_4') }}</a>
				    </li>
				    <li class="nav-child" id="tab_addpreference_nav">
				    	<a class="editnavbar" data-toggle="tab" href="#tab_addpreference" form="form-save-preference"> <i class="la la-file-text"></i> {{ trans('front/candidate.tab_5') }}</a>
				    </li>
 				</ul>
 			</div>
 		</div>
 		<div class="widget">
 			<div class="skill-perc">
 				<h3>Skills Percentage </h3>
 				<p>Put value for "Cover Image" field to increase your skill up to "15%"</p>
 				<div class="skills-bar">
 					<span>85%</span>
 					<div 
 						class="second circle" 
 						data-size="155"
 						data-thickness="60">
				    </div>
 				</div>
 			</div>
 		</div>
 	</aside>