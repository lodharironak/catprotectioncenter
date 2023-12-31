<?php 

/**
 Template Name: Map
 */

get_header();
?>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" lang="en-us"></script> 
<script type="text/javascript">
    var geocoder;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successFunction);
    }
    //Get the latitude and the longitude;
    function successFunction(position) {
        var lat = 40.714224;
        var lng = -73.961452;
        codeLatLng(lat, lng)
    }

    

    function initialize() {
        geocoder = new google.maps.Geocoder();



    }

    function codeLatLng(lat, lng) {

        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                console.log(results)
                if (results[1]) {
                    //formatted address
                    //alert(results[0].formatted_address)
                    document.getElementById('<%= citylbl.ClientID %>').value = results[0].formatted_address;
                    //find country name
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        for (var b = 0; b < results[0].address_components[i].types.length; b++) {

                            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                            if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                                //this is the object you are looking for
                                city = results[0].address_components[i];
                                break;
                            }
                        }
                    }
                    //city data
                    //alert(city.short_name+" " + city.long_name);


                } else {
                    alert("No results found");
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }
</script> 
</head>
<body onload="initialize()">
<asp:HiddenField ID="citylbl" runat="server" />
  </body>