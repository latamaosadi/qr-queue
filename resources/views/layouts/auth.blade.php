<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tampilan Admin</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="bg-gray-200 flex min-h-screen">
        <div class="bg-white m-auto p-6 rounded-lg shadow-lg">
            @yield('content')
            <p class="text-center text-gray-500 text-xs">
                &copy;2020 BPJAMSOSTEK All rights reserved.
            </p>
        </div>
    </div>
    {{-- Error Alert --}}
    @if(session('error'))
        <div class="fixed top-0 inset-x-0">
            <div class="max-w-xs mx-auto p-6" role="alert">
                <div class="bg-white rounded shadow-lg p-4 text-red-500">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</body>
</html>