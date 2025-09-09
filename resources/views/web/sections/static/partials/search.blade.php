<div class="block rounded-lg bg-white p-8 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
    <h5 class="mb-5 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
        Busca lo que necesites
    </h5>
    <form action="{{ route('search.show') }}" method="get" id="search_form">
        @csrf
        <div clasS="grid grid-cols-12">
            <div class="col-span-12">
                <div class="flex mb-3">
                    <x-radio name="option" :checked="(request()->option) == 0 ? 'checked' : null" id="input-radio-products" value="0">Negocios</x-radio>
                    <x-radio name="option" :checked="(request()->option) == 1 ? 'checked' : null" id="input-radio-business" value="1">Productos</x-radio>
                    <x-radio name="option" :checked="(request()->option) == 2 ? 'checked' : null" id="input-radio-trades" value="2">Oficios Tradicionales</x-radio>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 mb-3">
                <x-input-large id="input_search" class="w-full" type="text" name="search" placeholder="Ingrese lo que quiera buscar" value="{{ request()->search }}" />
            </div>
            <div class="col-span-12 md:col-span-4 mb-3">
                <select data-te-select-init data-te-select-size="lg" data-te-select-filter="true" id="categories_id" name="categories_id">
                    {{ category_list( old('categories_id', request()->categories_id ?? 0) ) }}
                </select>
                <label data-te-select-label-ref>Categoría</label>

                <select data-te-select-init data-te-select-size="lg" data-te-select-filter="true" id="trade_id" name="trade_id">
                    {{ trade_skills_list( old('trade_id', request()->trade_id ?? 0) ) }}
                </select>
                <label data-te-select-label-ref>Oficios</label>
            </div>
            <div class="col-span-12 md:col-span-2">
                <x-button type="submit" class="w-full !px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                </x-button>
            </div>

        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const optionRadios      = document.querySelectorAll("input[name='option']");
        
        const categoriesSelect  = document.getElementById('categories_id');
        const tradeSelect       = document.getElementById('trade_id');

        // Seleccionamos los wrappers generados por TWE via el atributo data-te-select-wrapper-ref
        const categoriesWrapper = categoriesSelect.closest('[data-te-select-wrapper-ref]');
        const tradeWrapper      = tradeSelect.closest('[data-te-select-wrapper-ref]');

        function updateSelects() {
            const selectedOption = document.querySelector("input[name='option']:checked").value;

            if(selectedOption == '2'){ // Oficios
                categoriesWrapper.classList.add('hidden');
                tradeWrapper.classList.remove('hidden');
            } else { // Negocios o Productos
                categoriesWrapper.classList.remove('hidden');
                tradeWrapper.classList.add('hidden');
            }
        }
        // Escuchar cambios
        optionRadios.forEach(radio => radio.addEventListener('change', updateSelects));
        // Ejecutar al cargar la página
        updateSelects();
    });
</script>


