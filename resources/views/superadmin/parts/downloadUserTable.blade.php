@extends('essential.pagination')
@section('table')
    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-muted dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-muted_hover border-muted_hover rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            User ID

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Name

                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Finger ID
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            From Ip Address
                        </div>
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        To Ip Address
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($getdeviceUser as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-muted dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-muted_hover border-muted_hover rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->sdwEnrollNumber }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->sName }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->idwFingerIndex }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->ip }}
                        </th>
                        {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="w-44">
                            <select id="ipaddress" name="ipaddress"
                                class="ipaddress w-48 py-2.5 px-2.5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-muted_hover hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <option value="0" selected disabled>Selected Device</option>
                                @foreach ($ipAddress as $address)
                                    <option value={{ $address->ip_address }}> {{ $address->ip_address }}</option>
                                @endforeach

                            </select>
                        </div>
                    </th> --}}

                        {{-- <td class=" ipaddress flex flex-row px-6 py-4">
                        <a href="#" onclick="uploadUser('{{ $address->ip_address }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>

                        </a>

                    </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@push('scripts')
    <script>
        function uploadUser(id) {
            $.ajax({
                type: "POST",
                url: "essl_upload_user",
                data: {
                    ip_address: ip,
                },
                success: function(response) {
                    console.log(response);
                    $('#loader').hide();
                }
            });
        }
        $('#ipaddress').change(function(e) {
            e.preventDefault();
            $ip = $('#ipaddress').val();
            uploadUser($ip);
        });

        function getData(ip) {
            $('#loader').show();
            $.ajax({
                type: "POST",
                url: "essl_upload_user",
                data: {
                    ip_address: ip,
                },
                success: function(response) {
                    console.log(response);
                    $('#table').html(response);
                    $('#loader').hide();
                }
            });

        }
    </script>
@endpush

@section('extras')
@endsection
