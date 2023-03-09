@extends('essential.layout')
@section('body')

    <body>
        {{-- <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.3/dist/flowbite.min.css" /> --}}

        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
        {{-- <script src="https://unpkg.com/flowbite@1.4.3/dist/flowbite.js"></script> --}}
        <script src="https://unpkg.com/flowbite@1.4.3/dist/datepicker.js"></script>
        @include('superadmin.parts.side')
        <div class="p-3 sm:ml-52">
            @include('essential.topbar')
            @yield('content')
        </div>
        @yield('extras')
        @include('essential.scripts')

    </body>
@endsection
