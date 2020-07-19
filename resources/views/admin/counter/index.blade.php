@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Daftar Loket Pelayanan</h1>

        <div class="mt-2">
            <a href="{{ route('admin.counter.create') }}" class="px-4 py-2 bg-blue-500 border border-blue-700 text-white rounded hover:bg-blue-700 hover:shadow-md transition-all duration-150">Tambah Loket</a>
        </div>

        <table class="border-collapse table-auto w-full mt-8">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Alamat IP</th>
                    <th class="border px-4 py-2">CS Aktif</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($counters as $counter)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $counter->name }}</td>
                        <td class="border px-4 py-2">{{ $counter->ip }}</td>
                        <td class="border px-4 py-2">{{ $counter->customerService->name ?? 'Kosong' }}</td>
                        <td class="border px-4 py-2">{{ $counter->status }}</td>
                        <td class="border px-4 py-2">
                            <a
                                href="{{ route('admin.counter.edit', ['counter' => $counter->id]) }}"
                                class="text-blue-600"
                            >Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection