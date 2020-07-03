<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tampilan Admin</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav id="header" class="bg-white fixed w-full z-10 top-0 shadow">


        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 pt-3 pb-3 md:pb-0">

            <div class="w-1/2 pl-2 md:pl-0">
                <a class="text-gray-900 text-base xl:text-xl no-underline hover:no-underline font-bold" href="#">
                    <i class="fas fa-qrcode text-orange-600 pr-3"></i> Admin QR Queue
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative inline-block float-right">

                    <div class="relative text-sm">
                        <a href="{{ route('admin.logout') }}" class="px-4 py-2 block text-blue-500 hover:text-blue-700 no-underline hover:no-underline">Logout</a>
                        {{-- <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300" alt="Avatar of User"> <span class="hidden md:inline-block">Hi, User </span>
                            <svg class="pl-2 h-2" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                                <g>
                                    <path d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                                </g>
                            </svg>
                        </button>
                        <div id="userMenu" class="bg-white rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 opacity-0">
                            <ul class="list-reset">
                                <li><a href="{{ route('admin.logout') }}" class="px-4 py-2 block text-gray-900 hover:bg-gray-400 no-underline hover:no-underline">Logout</a></li>
                            </ul>
                        </div> --}}
                    </div>


                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

            </div>


            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white z-20" id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a
                            href="{{ route('admin.index') }}"
                            class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin') ? 'border-orange-600 text-orange-600' : 'border-white text-gray-500' }} hover:border-orange-600"
                        >
                            <i class="fas fa-home fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a
                            href="{{ route('admin.counter.index') }}"
                            class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/counters*') ? 'border-pink-600 text-pink-600' : 'border-white text-gray-500' }} hover:border-pink-600"
                        >
                            <i class="fas fa-box fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Counter</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a
                            href="{{ route('admin.cs.index') }}"
                            class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-gray-900 border-b-2 {{ request()->is('admin/customer-services*') ? 'border-green-600 text-green-600' : 'border-white text-gray-500' }} hover:border-green-600"
                        >
                            <i class="fas fa-users fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Customer Service</span>
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>

    <!--Container-->
    <div class="container w-full mx-auto pt-20">
        <div
            id="app"
            class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal bg-white min-h-screen"
        >
            @yield('content')
        </div>
    </div>
    <!--/container-->

    {{-- <script src="{{ mix('js/admin.js') }}" type="text/javascript"></script> --}}
</body>

</html>