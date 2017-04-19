var options = {
    types: ['geocode'],
    componentRestrictions: {country: 'fr'}
};

function initializeAutocomplete(id) {
    var element = document.getElementById(id);
    if (element) {
        var autocomplete = new google.maps.places.Autocomplete(element, options);
        google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
    }
}

function onPlaceChanged() {
    var place = this.getPlace();

    console.log(place);  // Uncomment this line to view the full object returned by Google API.

    //tableau de correspondance
    $tableauCorrespond = {
        'street_number' : 'address_streetNumber',
        'route' : 'address_street',
        'postal_code' : 'address_cp',
        'locality' : 'address_city'
    };

    for (var i in place.address_components) {
        var component = place.address_components[i];
        for (var j in component.types) {  // Some types are ["country", "political"]
            var type = component.types[j];
            var realType = $tableauCorrespond[type];
            var type_element = document.getElementById(realType);
            if (type_element) {
                type_element.value = component.long_name;
            }
        }
    }
}

google.maps.event.addDomListener(window, 'load', function() {
    initializeAutocomplete('user_input_autocomplete_address');
});