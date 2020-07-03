@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold">Buat Counter Pelayanan Baru</h1>
        <form
            action="{{ route('admin.counter.create') }}"
            method="POST"
            class="mt-8"
        >
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Kode Counter
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="Nama"
                        value="{{ old('name') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ip">
                        Alamat IP
                    </label>
                    <input
                        id="ip"
                        name="ip"
                        type="text"
                        placeholder="xxx.xxx.xxx.xxx"
                        value="{{ old('ip') }}"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection