<p>
    Selamat Datang, <strong>{{ $customer->profile->nama }}</strong>
</p>
<p class="p-2 text-center text-base mt-4">
    NO. Antrian Anda: <strong>{{ $customer->readableQueue }}</strong>
</p>
<div class="font-mono text-base mt-4">
    <div class="flex">
        <div class="w-1/5">NIK:</div>
        <div class="w-4/5">{{ $customer->profile->nik }}</div>
    </div>
    <div class="flex">
        <div class="w-1/5">NO HP:</div>
        <div class="w-4/5">{{ $customer->profile->no_hp }}</div>
    </div>
    <div class="flex">
        <div class="w-1/5">ALAMAT:</div>
        <div class="w-4/5">{{ $customer->profile->alamat }}</div>
    </div>
    <div class="flex">
        <div class="w-1/5">PROGRAM:</div>
        <div class="w-4/5">{{ $customer->profile->program }}</div>
    </div>
</div>

<p class="mt-8 text-center">
    Silahkan menuju tempat mengantri.
</p>