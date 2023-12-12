<div
  data-te-chip-init
  data-te-ripple-init
  {{ $attributes->merge(['class' => 'my-[5px] mr-4 flex h-[32px] cursor-pointer items-center justify-between rounded-[16px] bg-danger-600 text-white px-[12px] py-0 text-[13px] font-normal normal-case leading-loose shadow-none transition-[opacity] duration-300 ease-linear hover:!shadow-none active:bg-[#cacfd1] dark:bg-neutral-600 dark:text-neutral-200']) }}
  data-te-close="false">
  {{ $slot }}
</div>


