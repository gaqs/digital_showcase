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
//if navbar exist
if (navbar !== null) {
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
}

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


/*-----------------LEAFLET MAP-----------------------*/ 

function cortarHastaPuertoMontt(texto) {
    const corte = "Puerto Montt";
    const idx = texto.indexOf(corte);
    if (idx !== -1) {
        return texto.substring(0, idx-2);
    }
    return texto;
}

var lat = document.getElementById('input_latitude');
var lon = document.getElementById('input_longitude');

var lat_value = (lat != null) ? lat.value : '-41.47002';
var lon_value = (lon != null) ? lon.value : '-72.94078';

const coorDefault = { lat: parseFloat(lat_value), lng: parseFloat(lon_value) };

window.addEventListener('load', function() {

    //verify if id map is loaded
    if (document.getElementById('map') === null) return; // Salir si el elemento no existe

    // Inicializar el mapa centrado en Santiago de Chile
    const map = L.map('map').setView(coorDefault, 13);

    // Añadir capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Variables globales
    let marker = null;
    let selectedAddress = null;
    let debounceTimer = null;

    var markerIcon = L.icon({
        iconUrl: '/img/marker_2.svg', // Ruta al icono del marcador
        iconSize: [60, 60],           // Ajusta el tamaño según tu SVG
        iconAnchor: [30, 60],         // Ajusta el ancla según tu SVG
        popupAnchor: [0, -60]
    });

    // Elementos del DOM
    const addressInput = document.getElementById('input_address');
    const suggestionsContainer = document.getElementById('suggestions_container');

    const addressLoading = document.getElementById('address_loading');

    const latitudeInput = document.getElementById('input_latitude');
    const longitudeInput = document.getElementById('input_longitude');

    // Configurar Nominatim (limitado a Chile)
    const nominatimEndpoint = 'https://nominatim.openstreetmap.org/search';
    const nominatimParams = {
        format: 'json',
        countrycodes: 'cl', // Limitar a Chile,
        addressdetails: 1,
        namedetails: 1,
        limit: 5,
        'accept-language': 'es' // Para resultados en español
    };

    // Función para obtener sugerencias de direcciones
    async function getAddressSuggestions(query) {
        if (!query || query.length < 3) return [];
        
        const params = new URLSearchParams({
            ...nominatimParams,
            q: query + ', Puerto Montt'
        });
        
        try {
            const response = await fetch(`${nominatimEndpoint}?${params.toString()}`);
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener sugerencias:', error);
            return [];
        }
    }

    // Función para mostrar sugerencias
    function showSuggestions(suggestions) {
        if (suggestions.length === 0) {
            suggestionsContainer.style.display = 'none';
            return;
        }
        
        suggestionsContainer.innerHTML = '';
        
        suggestions.forEach(suggestion => {
            const item = document.createElement('div');
            item.className = 'suggestion-item';
            // Mostrar la dirección formateada
            const address = cortarHastaPuertoMontt(suggestion.display_name);
            item.innerHTML = address;
            
            item.addEventListener('click', () => {
                selectSuggestion(suggestion);
            });
            
            suggestionsContainer.appendChild(item);
        });
        
        suggestionsContainer.style.display = 'block';
    }

    // Función para seleccionar una sugerencia
    function selectSuggestion(suggestion) {
        //console.log('Sugerencia seleccionada:', suggestion);
        const saddress = suggestion.address;
        const selectedAddress = cortarHastaPuertoMontt(suggestion.display_name);
        addressInput.value = selectedAddress;
        suggestionsContainer.style.display = 'none';
        
        // Centrar el mapa en la ubicación seleccionada
        const lat = parseFloat(suggestion.lat);
        const lon = parseFloat(suggestion.lon);

        //console.log(lat+', ' + lon);
        
        // Actualizar coordenadas en pantalla
        latitudeInput.value = lat.toFixed(5);
        longitudeInput.value = lon.toFixed(5);
        
        // Eliminar marcador anterior si existe
        if (marker) {
            map.removeLayer(marker);
        }
        // Crear nuevo marcador (arrastrable)
        marker = L.marker([lat, lon], {
            icon: markerIcon,
            draggable: true
        }).addTo(map);

        marker.bindPopup('<b>¿Aqui no es? MUEVEME!</b>').openPopup();

        // Centrar el mapa en la nueva ubicación
        map.setView([lat, lon], 16);

        marker.on('drag', function(e) {
            const newLatLng = e.latlng;
            latitudeInput.value = newLatLng.lat.toFixed(5);
            longitudeInput.value = newLatLng.lng.toFixed(5);
        });
        
        // Escuchar eventos de arrastre del marcador
        marker.on('dragend', function() {
            const newLatLng = marker.getLatLng();
            latitudeInput.value = newLatLng.lat.toFixed(5);
            longitudeInput.value = newLatLng.lng.toFixed(5);

            marker.bindPopup('<b>¿Ahora si?</b>').openPopup();
        });
    }

    // Evento de entrada para el campo de búsqueda
    addressInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        if(addressLoading) addressLoading.style.display = 'inline-block'; 
        debounceTimer = setTimeout(async () => {            
            const query = addressInput.value.trim();
            if (query.length >= 3) {
                const suggestions = await getAddressSuggestions(query);
                showSuggestions(suggestions);
                if(addressLoading) addressLoading.style.display = 'none'; // Ocultar ícono
            } else {
                suggestionsContainer.style.display = 'none';
                if(addressLoading) addressLoading.style.display = 'none'; // Ocultar ícono
            }
        }, 300);
    });

    // Ocultar sugerencias al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (e.target !== addressInput) {
            suggestionsContainer.style.display = 'none';
        }
    });

    // Evento para permitir que los clics en las sugerencias no se cierren
    suggestionsContainer.addEventListener('click', (e) => {
        e.stopPropagation();
    });

    // Crear nuevo marcador (arrastrable)
    marker = L.marker([lat_value, lon_value], {
        icon: markerIcon,
        draggable: true,
    }).addTo(map);

    marker.on('drag', function(e) {
        const newLatLng = e.latlng;
        latitudeInput.value = newLatLng.lat.toFixed(5);
        longitudeInput.value = newLatLng.lng.toFixed(5);
    });

    marker.on('dragend', function() {
        const newLatLng = marker.getLatLng();
        latitudeInput.value = newLatLng.lat.toFixed(5);
        longitudeInput.value = newLatLng.lng.toFixed(5);
    });
})

/*-----------------LEAFLET MAP-----------------------*/ 

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

    input.value = valor;
}

//dark mode change
document.addEventListener('DOMContentLoaded', () => {
    const darkModeSwitch = document.getElementById('dark_mode_switch');
    const htmlElement = document.documentElement;

    // Aplicar el tema guardado en localStorage al cargar la página
    if (!darkModeSwitch) return; // Asegurarse de que el switch existe
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        htmlElement.classList.add('dark');
        darkModeSwitch.checked = true;
    } else {
        htmlElement.classList.remove('dark');
        darkModeSwitch.checked = false;
    }

    // Cambiar entre los modos oscuro y claro al alternar el switch
    darkModeSwitch.addEventListener('change', () => {
        if (darkModeSwitch.checked) {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark'); // Guardar preferencia en localStorage
        } else {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light'); // Guardar preferencia en localStorage
        }
    });
});
