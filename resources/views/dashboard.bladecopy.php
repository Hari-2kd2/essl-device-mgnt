<style>
    .form {
        padding: 5% 20% 5% 20%;
        width: 100%;
    }

    table {
        background-color: #4593d3;
        table-layout: fixed;
        width: 95%;
        margin: 2.5%;
    }

    th {
        text-transform: uppercase;
        font-size: 14px;
    }

    tr {
        text-transform: capitalize;
        font-size: 13px;
    }

    tr,
    th,
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #9fcdf3;
    }

    tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    tbody tr:nth-child(even) {
        background-color: #cfe8fd;
    }

    tbody tr {
        background-image: url(noise.png);
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @php
                    $e = ['error' => 'red', 'success' => 'green', 'info' => 'blue'];
                @endphp
                @if ($errors->any())
                    <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                        </svg>
                        @foreach ($errors->all() as $error)
                            <p><strong>{!! $error !!}</strong></p><br>
                        @endforeach
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <h3
                    style="margin: 2.5% 2.5% 0 2.5%;background: #4593d3;padding:0.5% 0.5% 0.5% 1.5%;color:#ffffff; text-transform:capitalize;">
                    Recent Attendance Information</h3>
                <table class="table-auto" >
                    <thead>
                        <tr style="color: #ffffff">
                            <th>Table Data Name</th>
                            <th>Device Data in No's</th>
                            <th>Software Data in No's</th>
                            <th>Server Data in No's</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($dataSet as $data) --}}
                            <tr>
                                <td>{{ ['tableName'] }}</td>
                                <td>{{ ['microsoftSql'] }}</td>
                                <td>{{ ['mySql'] }}</td>
                                <td>{{ ['server'] }}</td>
                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                <div class="form" hidden>
                    <form method="GET" action="{{ route('searchTable') }}">
                        @csrf
                        <!-- Table Name -->
                        <x-label for="table" class="font-semibold" :value="__('Table Name')" />

                        <x-input id="table_name" class="block mt-1 w-full" placeholder="Example: T_LG202301" style="font-size: 13px;color:#4593d3"
                            type="text" name="table_name" onkeydown="if(['Space'].includes(arguments[0].code)){return false;}" :value="old('table_name')" required autofocus />

                        <div class="flex items-end justify-end mt-4">
                            <x-button class="mt-4" style="background: #4593d3">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
