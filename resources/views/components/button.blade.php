@props([
    'type' => 'button',
    'value' => 'primary',
    'disabled' => false
])

@if ( $value == 'primary')
    <button type={{ $type }} value={{ $value }} {{ $attributes->merge(['class' => 'inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-sm font-medium leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong']) }} />
        {{ $slot }}
    </button>
@elseif ( $value == 'secondary' )
    <button type={{ $type }} value={{ $value }} {{ $attributes->merge(['class' => 'inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-sm font-medium leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 motion-reduce:transition-none dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400']) }} />
        {{ $slot }}
    </button>
@elseif ( $value == 'danger')
    <button type={{ $type }} {{ $attributes->merge(['class' => 'inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-sm font-medium leading-normal text-white shadow-danger-3 transition duration-150 ease-in-out hover:bg-danger-accent-300 hover:shadow-danger-2 focus:bg-danger-accent-300 focus:shadow-danger-2 focus:outline-none focus:ring-0 active:bg-danger-600 active:shadow-danger-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong']) }} {{ $disabled == false ? '' : 'disabled' }} />
        {{ $slot }}
    </button>
@elseif ( $value == 'success' )
    <button type={{ $type }} {{ $attributes->merge(['class' => 'inline-block rounded bg-success px-6 pb-2 pt-2.5 text-sm font-medium leading-normal text-white shadow-success-3 transition duration-150 ease-in-out hover:bg-success-accent-300 hover:shadow-success-2 focus:bg-success-accent-300 focus:shadow-success-2 focus:outline-none focus:ring-0 active:bg-success-600 active:shadow-success-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong']) }} {{ $disabled == false ? '' : 'disabled' }}>
        {{ $slot }}
    </button>
@endif
