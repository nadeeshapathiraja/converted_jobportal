
  //Script for autocomplete..
    var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('geo_autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        $('#geo_details').show();
        var place = autocomplete.getPlace();
        //console.log(place);

        //Customization
        var arrAddress = place.address_components;
        var itemRoute='';
        var itemSubLocality= ';'
        var itemLocality='';
        var itemState='';
        var itemCountry='';
        var itemPostcode='';
        $('.data-geolocation').val('');
        $.each(arrAddress, function (i, address_component) {
                //console.log('address_component:'+i);

            if (address_component.types[0] == "route"){
                //console.log(i+": route:"+address_component.long_name);
                itemRoute = address_component.long_name;
                document.getElementById('address1').value = itemRoute;
            }

            if (address_component.types[0] == "sublocality_level_1"){
                //console.log(i+": sublocality_level_1:"+address_component.long_name);
                itemSubLocality = address_component.long_name;
                document.getElementById('address2').value = itemSubLocality;
            }

            if (address_component.types[0] == "locality"){
                //console.log("city:"+address_component.long_name);
                itemLocality = address_component.long_name;
                document.getElementById('city').value = itemLocality;
            }

            if (address_component.types[0] == "administrative_area_level_1"){
                //console.log("administrative_area_level_1:"+address_component.long_name);
                itemState = address_component.long_name;
                document.getElementById('state').value = itemState;
            }

            if (address_component.types[0] == "country"){
                //console.log("country:"+address_component.long_name);
                itemCountry = address_component.short_name;
                document.getElementById('country').value = itemCountry;
                $('#country').val(itemCountry).change().trigger("chosen:updated");                    
            }

            if (address_component.types[0] == "postal_code"){
                //console.log("postcode:"+address_component.long_name);
                itemPostcode = address_component.long_name;
                document.getElementById('zipcode').value = itemPostcode;
            }

        });
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        /*if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            document.getElementById('latitude').value = geolocation.lat.toFixed(6);
            document.getElementById('longitude').value = geolocation.lng.toFixed(6);      
            //console.log(geolocation);      
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }*/
      }

      function geolocate_min() {
        // var map = new google.maps.Map(document.getElementById('geo_autocomplete'), {
        //     center: {lat: -33.8688, lng: 151.2195},
        //     zoom: 13
        // });
        // var card = document.getElementById('pac-card');
        // map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('geo_autocomplete')),
            {types: ['geocode']});
        //autocomplete.bindTo('bounds', map);
   
        // var infowindow = new google.maps.InfoWindow();
        // var infowindowContent = document.getElementById('infowindow-content');
        // infowindow.setContent(infowindowContent);
        // var marker = new google.maps.Marker({
        //     map: map,
        //     anchorPoint: new google.maps.Point(0, -29)
        // });
        autocomplete.addListener('place_changed', function(){
            //infowindow.close();
            //marker.setVisible(false);      
            var place = autocomplete.getPlace();
            //console.log(place);
            //Customization
            var arrAddress = place.address_components;        
            var itemState='';
            var itemCountry='';
            
            $('.data-geolocation').val('');
            $.each(arrAddress, function (i, address_component) {

                if (address_component.types[0] == "locality"){
                    //console.log("administrative_area_level_1:"+address_component.long_name);
                    itemState = address_component.long_name;
                    document.getElementById('geo_autocomplete').value = itemState;
                }

                if (address_component.types[0] == "administrative_area_level_1"){
                    //console.log("administrative_area_level_1:"+address_component.long_name);
                    itemState = address_component.long_name;
                    document.getElementById('state').value = itemState;
                }

                if (address_component.types[0] == "country"){
                    //console.log("country:"+address_component.long_name);
                    itemCountry = address_component.short_name;
                    document.getElementById('country').value = itemCountry;
                    $('#country').val(itemCountry).change().trigger("chosen:updated");                    
                }
                

            });
        });
      }
      
