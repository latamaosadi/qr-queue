@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Daftar Customer Service</h1>

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
                            <a href="{{ route('admin.cs.edit', ['customerService' => $cs->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection