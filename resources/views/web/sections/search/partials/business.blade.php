<div class="my-3">
    @include('web.sections.static.partials.search')
</div>

<div class="md:container container-xl">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-7">

            @foreach ( $results as $r )
            @php
                $avatar = 'uploads/business/'.show_business_avatar($r->folder);
            @endphp

                <div id="business_container" class="mb-4 border-4 border-neutral flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row cursor-pointer" >
                    <div id="marker_info" class="hidden" data-lat="{{ $r->latitude }}" data-lng="{{ $r->longitude }}" data-name="{{ $r->name }}" data-address="{{ $r->address }}"></div>
                    <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset($avatar ?? 'img/business/1.jpg') }}" alt="" />
                    <div class="flex flex-col justify-start p-6 pb-0">
                        <h5 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                            {{ $r->name }}
                        </h5>
                        <span class="mb-4"><i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $r->address }}</span>
                        <p class="text-base text-sm text-neutral-600 dark:text-neutral-200 mb-2">
                            {{ substr($r->description, 0, 100) }}...
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
        <div class="hidden md:block md:col-span-5 sticky top-0 h-screen">
            <div id="mapSearch" class="h-full"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMapSearch&libraries=places&v=weekly" defer></script>
        </div>
    </div>
</div>
<script>

function initMapSearch() {
    const map = new google.maps.Map(document.getElementById("mapSearch"), {
        center: { lat: -41.47002, lng: -72.94078 },
        zoom: 5,
        mapTypeControl: false,
    });

    var locations = document.querySelectorAll('#marker_info');

    let infowindows = [];

    locations.forEach(l => {
        const lat = parseFloat(l.getAttribute('data-lat'));
        const lng = parseFloat(l.getAttribute('data-lng'));
        const name = l.getAttribute('data-name');
        const address = l.getAttribute('data-address');

        const marker = new google.maps.Marker({
            position: { lat: lat, lng: lng },
            map,
            anchorPoint: new google.maps.Point(0, -29),
        });

        const infowindowContent = `<div id="infowindow-content-search">
                                        <span id="place-name" class="title text-lg font-semibold"><b>${name}</b></span><br />
                                        <span id="place-address" class="font-medium">
                                            <i class="text-rose-500 fa-solid fa-location-dot"></i> ${address}
                                        </span>
                                        <br><br>
                                        <span>
                                            <a href="https://www.google.com/maps/search/?api=1&query=${lat},${lng}" target="_blank" class="text-danger-700 focus:outline-none mt-3">
                                                Ver en Google Maps
                                            </a>
                                        </span>
                                    </div>`;

        const infowindow = new google.maps.InfoWindow();
        infowindow.setContent(infowindowContent);

        infowindows.push(infowindow);

        var business = l.parentNode;

        business.addEventListener('click', () => {

            closeAllInfoWindows();

            map.setCenter(marker.getPosition());
            map.setZoom(15);
            infowindow.open(map,marker);

            business.classList.add('border-danger');

        });
    });

    function closeAllInfoWindows() {
        document.querySelectorAll('#business_container').forEach(business => {
            business.classList.remove('border-danger');
        })
        infowindows.forEach(info => {
            info.close();
        });
    }

}

window.initMapSearch = initMapSearch;
</script>



