@component('mail::message')
# Hi, {{ $name }}

Ini adalah email konfirmasi nomor antrian Anda.

Nomor antrian Anda adalah

# {{ $queueNumber }}

Terima Kasih,<br>
BPJAMSOSTEK
{{-- {{ config('app.name') }} --}}
@endcomponent
