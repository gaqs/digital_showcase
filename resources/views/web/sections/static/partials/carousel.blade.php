<section id="splide_header" class="splide bg-black" aria-label="">
  <div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide">
                <div class="h-[550px]">

                    <img src="{{ asset('img/puertomontt.jpg') }}" class="block w-full h-full object-cover brightness-50" alt="..." />
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-left pl-5 text-white md:block w-full md:w-auto border-l-8 border-danger">
                        <h5 class="slide_title text-5xl text-white font-bold animate__animated animate__fadeInLeft">
                            Encuentra increibles lugares en Puerto Montt
                        </h5>
                        <p class="slide_subtitle mt-5 animate__animated animate__fadeInLeft animate__delay-1s animate__fast" >
                           Explora maravillosos lugares donde hospedarte, donde ir de compras, hacerse un cambio de "look", recibir masajes o visitar areas locales en la Comuna de Puerto Montt.
                        </p>
                    </div>

                </div>
            </li>
            @for ($i=0; $i < 2; $i++)
                @if(!empty($carousel))
                @php
                    $image = show_business_gallery($carousel[$i]['folder']);
                    $image = reset($image);
                @endphp
                <li class="splide__slide">
                    <div class="h-[550px]">

                        <img src="{{ asset('uploads/business/'.$carousel[$i]['folder'].'/'.$image) }}" class="block w-full h-full object-cover brightness-50" alt="..." />
                        <div class="absolute top-1/2 right-0 md:right-56 -translate-y-1/2 text-right pr-5 text-white md:block w-full md:w-96 border-r-8 border-danger">
                            <h5 class="slide_title text-5xl font-bold">
                                {{ $carousel[$i]['name'] }}
                            </h5>
                            <p class="slide_subtitle my-3">
                                <i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $carousel[$i]['address'] }}
                            </p>
                            <p class="slide_subtitle">
                               {{ substr($carousel[$i]['description'], 0, 80) }} ...<x-link href="{{ route('business.show', ['id' => $carousel[$i]['id'] ]) }}">
                                Saber más &raquo;
                            </x-link>
                            </p>
                        </div>

                    </div>
                </li>
                @endif
            @endfor
		</ul>
  </div>
</section>

<script type="module">
    var header = new Splide( '#splide_header', {
        type  : 'fade',
        rewind: true,
        speed: 900,
        clones: 0
    });

    header.mount();

    header.on('active', function(e) {
        const title = e.slide.querySelector('.slide_title');
        const subtitle = e.slide.querySelector('.slide_subtitle');

        //title.classList.add('animate__animated', 'animate__fadeInLeft');
        //subtitle.classList.add('animate__animated', 'animate__fadeInLeft', 'animate__delay-1s', 'animate__fast');
    });

    header.on('hidden', function(e) {
        const title = e.slide.querySelector('.slide_title');
        const subtitle = e.slide.querySelector('.slide_subtitle');

        //title.classList.remove('animate__animated', 'animate__fadeInLeft');
        //subtitle.classList.remove('animate__animated', 'animate__fadeInLeft', 'animate__delay-1s', 'animate__fast');
    });
</script>
