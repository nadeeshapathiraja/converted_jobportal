    <div class="border-title"><h3>Address</h3></div>
    <div class="col-lg-12">         
        <div class="pf-field">
            <input id="geo_autocomplete" placeholder="Enter address to autofill" onFocus="geolocate()" type="text"></input>
        </div>                                    
    </div>
    <div id="geo_details" style="display:none;">        
            <div class="col-md-6">
                <span class="pf-title-slim" for="address1">Address1</span>
                <div class="pf-field">
                    <input id="address1" type="text" class=" data-geolocation" name="address1">
                </div>
            </div>
            <div class="col-md-6">
                <span class="pf-title-slim" for="address2">Address2</span>
                <div class="pf-field">
                    <input id="address2" type="text" class=" data-geolocation" name="address2">
                </div>
            </div>        
        
            <div class="col-md-6">
                <span class="pf-title-slim" for="city">City</span>
                <div class="pf-field">
                    <input id="city" type="text" class=" data-geolocation" name="city">
                </div>
            </div>
            <div class="col-md-6">
                <span class="pf-title-slim" for="state">State</span>
                <div class="pf-field">
                    <input id="state" type="text" class=" data-geolocation" name="state">
                </div>
            </div>        
        
            <div class="col-md-6">
                <span class="pf-title-slim" for="zipcode">Postcode</span>
                <div class="pf-field">
                    <input id="zipcode" type="text" class=" data-geolocation" name="zipcode">
                </div>
            </div>
            <div class="col-md-6">
                <span class="pf-title-slim" for="country">Country</span>
                <div class="pf-field">                
                    {!! Form::select('country', $country, null, ['id'=>'country', 'class' => 'chosen data-geolocation']) !!}
                </div>
            </div>
             
    </div>
{!! HTML::script('js/geolocation.js') !!}       
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=initAutocomplete" async="" defer=""></script>

