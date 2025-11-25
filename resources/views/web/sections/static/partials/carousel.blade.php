<section id="splide_header" class="splide bg-black" aria-label="">
  <div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide" data-splide-interval="5000">
                <div class="h-[550px]">
                    <img src="{{ asset('img/puertomontt.jpg') }}" class="block w-full h-full object-cover brightness-50" alt="..." />
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-left pl-5 text-white md:block w-full md:w-auto border-l-8 border-danger">
                        <img src="{{ asset('img/logo_muni_2.png') }}" class="h-full w-72 mb-4" alt="...">
                        <h5 class="slide_title text-5xl text-white font-bold">
                            Encuentra increibles lugares en Puerto Montt
                        </h5>
                        <p class="slide_subtitle mt-5">
                           Explora maravillosos lugares donde hospedarte, donde ir de compras, hacerse un cambio de "look", recibir masajes o visitar areas locales en la Comuna de Puerto Montt.
                        </p>
                    </div>

                </div>
            </li>
            @foreach($business as $b)
                @if(!empty($b))
                @php
                    $image = get_images_from_folder('business',$b->id,'gallery');
                @endphp
                <li class="splide__slide" data-splide-interval="5000">
                    <div class="h-[550px]">

                        <img src="{{ asset('uploads/business/'.reset($image)) }}" class="block w-full h-full object-cover brightness-50" alt="..." />
                        <div class="absolute top-1/2 right-0 md:right-80 -translate-y-1/2 text-right pr-5 text-white md:block md:w-[50%] border-r-8 border-danger">
                            <h5 class="slide_title text-5xl font-bold">
                                {{ $b->name }}
                            </h5>
                            <p class="slide_subtitle my-3">
                                <i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $b->address.' #'.$b->number }}</span>
                                <br>
                                {{ strip_tags(substr($b->description, 0, 200)) }} ...<x-link href="{{ route('business.show', ['id' => $b->id ]) }}">
                                Saber más &raquo;  </x-link>
                            </p>
                        </div>

                    </div>
                </li>
                @endif
            @endforeach
		</ul>
  </div>
  <div class="splide__progress">
		<div class="splide__progress__bar"> </div>
  </div>
</section>

<script type="module">

    var header = new Splide( '#splide_header', {
        type: 'fade',
        autoplay: 'playing',
        rewind: true,
        speed: 900,
        clones: 0,
        autoScroll: {
            speed: 0.5,
            pauseOnHover: false,
            pauseOnFocus: false,
            rewind: true,
        }
    }).mount();

    header.on('active', function(e) {
        const title = e.slide.querySelector('.slide_title');
        const subtitle = e.slide.querySelector('.slide_subtitle');

        title.classList.add('animate__animated', 'animate__fadeInLeft');
        subtitle.classList.add('animate__animated', 'animate__fadeInLeft', 'animate__delay-1s', 'animate__fast');
    });

    header.on('hidden', function(e) {
        const title = e.slide.querySelector('.slide_title');
        const subtitle = e.slide.querySelector('.slide_subtitle');

        title.classList.remove('animate__animated', 'animate__fadeInLeft');
        subtitle.classList.remove('animate__animated', 'animate__fadeInLeft', 'animate__delay-1s', 'animate__fast');
    });
</script>
