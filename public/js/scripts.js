//change color depending on the score
const scoreContainer = document.querySelectorAll('#score');

scoreContainer.forEach( scoreContainer => {
    const scoreValue = parseFloat(scoreContainer.textContent);
    if( scoreValue >= 4.0 ){
        scoreContainer.classList.add('bg-green-700');
    }else if( scoreValue >= 2.0 ){
        scoreContainer.classList.add('bg-yellow-500');
    }else{
        scoreContainer.classList.add('bg-red-500');
    }
})


//navbar animation on scroll
var navbar = document.getElementById('navbar_top');
document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
        if (window.scrollY > 150) {
          navbar.classList.add('fixed-top');
          navbar_height = navbar.offsetHeight;
        } else {
            navbar.classList.remove('fixed-top');
        }
    });
});


//change the color of the rrss icon if href dosent exist
window.addEventListener('load', function() {
    const rrss = document.getElementById('rrss');
    if(rrss){
        var links = rrss.querySelectorAll('a');
        links.forEach(link => {
            const href = link.getAttribute('href');
            if( href == '' || href == '#'){
                link.querySelector('img').classList.add('grayscale');
            }
        });
    }
});


//Google Map API
var lat = document.getElementById('input_latitude');
var lon = document.getElementById('input_longitude');

var lat_value = (lat != null) ? lat.value : '-41.47002';
var lon_value = (lon != null) ? lon.value : '-72.94078';

const coorDefault = { lat: parseFloat(lat_value), lng: parseFloat(lon_value) };

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: coorDefault,
        zoom: 15,
        mapTypeControl: false,
    });

    const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
    };

    const input = document.getElementById("input_address");

    if(input != null){

        const autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.bindTo("bounds", map);

        var name = document.getElementById('business_name') ?? '';
        var address = document.getElementById('business_address') ?? '';

        name = (name != '') ? name.innerHTML : '';
        address = (address != '') ? address.innerHTML : '';

        const infowindowContent = `<div id="infowindow-content">
                                        <span id="place-name" class="title text-lg font-semibold"><b>${name}</b></span><br />
                                        <span id="place-address" class="font-medium">
                                            ${address}
                                        </span>
                                    </div>`;

        const infowindow = new google.maps.InfoWindow();
        infowindow.setContent(infowindowContent);

        const marker = new google.maps.Marker({
            position: coorDefault,
            map,
            draggable: true,
            anchorPoint: new google.maps.Point(0, -29),
        });

        google.maps.event.addListener(marker, 'dragend', function(evt){
            lat.value = evt.latLng.lat().toFixed(5);
            lon.value = evt.latLng.lng().toFixed(5);
        });

        google.maps.event.addListener(marker, 'click', function(evt){
            if( name != ''){
                infowindow.open(map,marker);
            }
        });

        autocomplete.addListener("place_changed", () => {
            infowindow.close();
            marker.setVisible(false);

            const place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            //infowindowContent.children["place-name"].textContent = place.name;
            //infowindowContent.children["place-address"].textContent = place.formatted_address;

            lat.value = marker.getPosition().lat().toFixed(5);
            lon.value = marker.getPosition().lng().toFixed(5);

            if( name != ''){
                infowindow.open(map,marker);
            }
        });

    }

}

window.initMap = initMap;

//global form for deleting
var delete_form = document.getElementById('delete_something');
if( delete_form != null ){
    delete_form.addEventListener('submit', function(event) {
        event.preventDefault(); // Detiene el envío del formulario

        if (confirm('¿Estás seguro de que deseas eliminar? No podrás recuperarlo una vez eliminado.')) {
          this.submit();
        }
    });
}

//global link for deleting
var delete_link = document.querySelectorAll('#delete_link');
if( delete_link != null ){
    delete_link.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Detiene el direccionamiento
            if (confirm('¿Estás seguro de que deseas eliminar? No podrás recuperarlo una vez eliminado.')) {
                //console.log(delete_link.getAttribute('href'));
                location.href = link.getAttribute('href');
            }
        });
    });
}


//global submit button load
const form = document.querySelector('form');
if( form != null){
    form.addEventListener('submit', (e) => {
        const submitButton = document.querySelector('button[type=submit]');
        submitButton.disabled = true;
        if(submitButton.children[0]){
            submitButton.children[0].className = 'fa-solid fa-circle-notch fa-spin';
        }

    });
}

//formatea el precio agregando puntos cada miles
function formatearPrecio(input) {
    let valor = input.value.replace(/[^0-9]/g, '');
    valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    input.value = '$' + valor;
}
