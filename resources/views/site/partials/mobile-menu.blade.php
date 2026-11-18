{{-- Collapsible menu for small screens, no JavaScript needed. --}}
<details class="relative {{ ($breakpoint ?? 'md') === 'lg' ? 'lg:hidden' : 'md:hidden' }}">
    <summary class="flex cursor-pointer list-none items-center rounded p-2 [&::-webkit-details-marker]:hidden" aria-label="Menu">
        <svg class="size-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
    </summary>
    <div class="absolute right-0 z-50 mt-2 flex w-56 flex-col gap-3 rounded-lg border p-4 shadow-xl" style="background: var(--surface); color: var(--ink); border-color: var(--line)">
        @include('site.partials.menu')
    </div>
</details>
