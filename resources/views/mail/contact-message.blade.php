Ada pesan baru dari form kontak {{ $siteName }}.

Nama   : {{ $contact->name }}
Email  : {{ $contact->email }}
@if ($contact->phone)
Telepon: {{ $contact->phone }}
@endif

{{ $contact->body }}

---
Balas email ini untuk langsung membalas ke pengirim.
Semua pesan: {{ $adminUrl }}
