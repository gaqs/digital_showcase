<div class="my-3">
    @include('web.sections.static.partials.search')
</div>

<div class="md:container-xl container-xl">
    <div class="grid grid-cols-12 gap-4">
        @if( $results->isEmpty() )
            <div class="col-span-12 flex flex-col items-center justify-center mt-28">
                <img src="{{ asset('img/lost.svg') }}" alt="No results" class="w-80 mb-2">
                <p><i>- "Donde estoy?, aquí no hay nada."</i></p>
            </div>
        @else

        <div class="col-span-12 md:col-span-6">
            @foreach ( $results as $r )
            @php
                $avatar = 'uploads/business/'.get_images_from_folder('business',$r->id,'avatar');
            @endphp

                <div id="business_container" class="mb-4 border-4 border-neutral flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row cursor-pointer" >
                    <div id="marker_info" class="hidden" data-lat="{{ $r->latitude }}" data-lng="{{ $r->longitude }}" data-name="{{ $r->name }}" data-address="{{ $r->address }}"></div>
                    <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset($avatar ?? 'img/business/1.jpg') }}" alt="" />
                    <div class="flex flex-col justify-start p-6 pb-0 w-full">
                        <h5 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                            {{ $r->name }}
                        </h5>
                        <span class="mb-4"><i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $r->address }}</span>
                        <p class="text-base text-sm text-neutral-600 dark:text-neutral-200 mb-2">
                            {{ strip_tags(substr($r->description, 0, 200)) }}...
                            <br>
                        </p>

                        <div class="border-t-2 border-neutral-100 pt-4 dark:border-neutral-600 dark:text-neutral-50 mb-4">

                            <div class="flex justify-between items-center">

                                <div class="flex flex-row">
                                    <div class="pr-3">
                                        <div id="score" class="bg-green-700 w-fit font-bold text-white p-3 rounded-xl">
                                            {{ $r->score }}
                                        </div>
                                    </div>
                                    <div>
                                        <div id="stars" class="inline">
                                            <?= print_stars($r->score) ?>
                                            <div id="qty_reviews" class="text-neutral-600 text-sm">{{ $r->qty_comments }} comentarios</div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('business.show', ['id' => $r->id]) }}">
                                        <x-button value="danger">Saber más &raquo;</x-button>
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

            <div class="pagination">
                {{ $results->onEachSide(2)->links('vendor.pagination.tailwind') }}
            </div>
        </div>
        <div class="hidden md:block md:col-span-6 sticky top-0 h-screen">
            <div id="mapSearch" class="h-full w-full"></div>
        </div>
        @endif
    </div>
</div>
<script>

var lat_value = '-41.47002';
var lon_value = '-72.94078';

window.addEventListener('load', function() {
    // Crear nuevo marcador (arrastrable)
    const coorDefault = { lat: parseFloat(lat_value), lng: parseFloat(lon_value) };
    
    const map = L.map('mapSearch').setView(coorDefault, 14);

    // Añadir capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var markerIcon = L.icon({
            iconUrl: '/img/marker_2.svg', // Ruta al icono del marcador
            iconSize: [60, 60],           // Ajusta el tamaño según tu SVG
            iconAnchor: [30, 60],         // Ajusta el ancla según tu SVG
            popupAnchor: [0, -60]
        });

    marker = L.marker([lat_value, lon_value], {
        icon: markerIcon,
        draggable: false,
    }).addTo(map);

    businesses = document.querySelectorAll('#business_container');

    businesses.forEach(function(business) {
        var marker_info = business.querySelector('#marker_info');
        
        business.addEventListener('click', function() {

            var lat = marker_info.getAttribute('data-lat');
            var lng = marker_info.getAttribute('data-lng');
            var name = marker_info.getAttribute('data-name');
            var address = marker_info.getAttribute('data-address');

            // Actualizar la posición del marcador
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            // Quitar border-danger de todos los negocios
            businesses.forEach(function(b) {
                b.classList.remove('border-danger');
            });

            business.classList.add('border-danger');

            // Mostrar popup con información del negocio
            marker.bindPopup(`<b>${name}</b><br>${address}`).openPopup();
        });

    });
    
});
</script>



