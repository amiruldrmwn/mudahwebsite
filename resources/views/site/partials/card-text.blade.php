{{-- A card's text: one paragraph, or a check list when it has several lines. --}}
@php($lines = array_values(array_filter(array_map('trim', preg_split('/\R/', $text)), fn ($l) => $l !== '')))
@if (count($lines) > 1)
    <ul class="muted mt-3 space-y-1.5 text-sm leading-relaxed">
        @foreach ($lines as $line)<li class="flex gap-2"><span class="card-check shrink-0" style="color: var(--brand)">✓</span><span>{{ ltrim($line, '-• ') }}</span></li>@endforeach
    </ul>
@elseif ($lines)
    <p class="muted mt-2 leading-relaxed">{{ $lines[0] }}</p>
@endif
