@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Daftar Customer Service</h1>

        <div class="mt-2">
            <a href="{{ route('admin.cs.create') }}" class="px-4 py-2 bg-blue-500 border border-blue-700 text-white rounded hover:bg-blue-700 hover:shadow-md transition-all duration-150">Tambah Customer Service</a>
        </div>

        <table class="border-collapse table-auto w-full mt-8">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No.</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">NIP</th>
                    <th class="border px-4 py-2">Username</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customerServices as $cs)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $cs->name }}</td>
                        <td class="border px-4 py-2">{{ $cs->nip }}</td>
                        <td class="border px-4 py-2">{{ $cs->username }}</td>
                        <td class="border px-4 py-2">{{ $cs->status }}</td>
                        <td class="border px-4 py-2">
                            <a
                                href="{{ route('admin.cs.edit', ['customerService' => $cs->id]) }}"
                                class="text-blue-600"
                            >Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection