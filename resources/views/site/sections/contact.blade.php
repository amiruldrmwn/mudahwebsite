<section id="{{ $sectionId }}" class="sec">
    <div class="site-container grid gap-12 lg:grid-cols-5">
        <div class="lg:col-span-2">
            @if ($d['title'])<h2 class="sec-title">{{ $d['title'] }}</h2>@endif
            @if ($d['text'])<p class="sec-sub">{{ $d['text'] }}</p>@endif
            @include('site.partials.contact-list', ['class' => 'muted mt-8 text-lg'])
            @if ($site->get('maps_url'))
                <a href="{{ $site->get('maps_url') }}" target="_blank" rel="noopener" class="btn mt-8">Lihat di Google Maps</a>
            @endif
        </div>
        @if ($d['show_form'] === 'yes')
            <div class="lg:col-span-3">
                <form method="POST" action="{{ route('contact.send') }}#{{ $sectionId }}" class="card grid gap-4 sm:p-8">
                    @csrf
                    @if (session('contact_sent'))
                        <div class="rounded p-4 font-medium" style="background: var(--brand-soft); color: var(--brand-dark)">Terima kasih, pesan Anda sudah terkirim. Kami akan segera membalas.</div>
                    @endif
                    <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <label class="grid gap-1.5 text-sm font-medium">Nama
                            <input name="name" value="{{ old('name') }}" required maxlength="100" class="field">
                            @error('name')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </label>
                        <label class="grid gap-1.5 text-sm font-medium">Email
                            <input type="email" name="email" value="{{ old('email') }}" required maxlength="150" class="field">
                            @error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                        </label>
                    </div>
                    <label class="grid gap-1.5 text-sm font-medium">Nomor telepon (opsional)
                        <input name="phone" value="{{ old('phone') }}" maxlength="30" class="field">
                    </label>
                    <label class="grid gap-1.5 text-sm font-medium">Pesan
                        <textarea name="body" rows="5" required maxlength="3000" class="field">{{ old('body') }}</textarea>
                        @error('body')<span class="text-sm text-red-600">{{ $message }}</span>@enderror
                    </label>
                    <div><button type="submit" class="btn">Kirim Pesan</button></div>
                </form>
            </div>
        @endif
        @if ($map = $site->mapEmbedUrl())
            <div class="lg:col-span-5">
                <iframe src="{{ $map }}" title="Peta lokasi" class="site-map h-80 w-full border-0" style="border-radius: var(--radius)" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
            </div>
        @endif
    </div>
</section>
