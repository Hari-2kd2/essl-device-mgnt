@extends('superadmin.parts.main', [
    'breadcum' => 'importAttendance',
    'route' => 'importAttendance',
])
@section('content')
    <div class="flex flex-col">
        <div class="w-1/2   m-auto">
            <form id="store_user" class="flex flex-col w-full px-6  h-auto py-8" action=""
                data-token="{{ csrf_token() }}">
                @csrf

                <div class="w-full">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Device IP
                        Address
                    </label>
                    <select id="ip_address" name="ip_address"
                        class="ip_address w-full py-2.5 px-2.5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-muted_hover hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="0" selected disabled>
                            <--------- Select IP Address ----------->
                        </option>
                        @foreach ($ipAddress as $address)
                            <option value={{ $address->ip_address }}> {{ $address->ip_address }}</option>
                        @endforeach

                    </select>
                </div>

                <div date-rangepicker="" id="dateRangePickerId" datepicker-orientation=" right bottom left"
                    class="flex items-center  pb-8 flex flex-row w-full space-x-2">
                    <div class="flex flex-col w-1/2 ">
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">From
                            Date
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class=" w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>

                            <input name="from_date" id="from_date" type="text" autocomplete="off" datepicker-autohide
                                type="text"
                                class="from_date w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                                placeholder="Select date start">
                        </div>
                    </div>

                    <div class="flex flex-col w-1/2 ">
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">End
                            Date
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class=" w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>

                            <input name="to_date" id="to_date" type="text" autocomplete="off" datepicker-autohide
                                type="text"
                                class="to_date w-full bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                                placeholder="Select date start">
                        </div>
                    </div>
                </div>


                <div class="flex  items-center  space-x-2 w-full rounded-b dark:border-gray-600 submitBtn">
                    <button type="submit" id="create" data-token="{{ csrf_token() }}"
                        class="w-1/2 text-white bg-blue-500
                        hover:bg-primary_hover focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg
                        text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-blue-800">
                        Yeah, Create it</button>
                    <button type="button" onclick="userStoreModal()"
                        class="w-1/2 text-gray-500 bg-white hover:bg-muted_hover focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, Cancel</button>
                </div>

            </form>
        </div>
    </div>
    <div id="store">

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.submitBtn').click(function(e) {
                e.preventDefault();
                var ip_address = $('.ip_address').val();
                var from_date = $('.from_date').val();
                var to_date = $('.to_date').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('storeLogsByDate') }}",

                    data: {
                        ip_address: ip_address,
                        from_date: from_date,
                        to_date: to_date,
                        _token: "{{ csrf_token() }}",
                    },

                    success: function(response) {
                        console.log(response);
                        if (response.status == true) {

                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });

            });
        });
    </script>
@endpush

@section('extras')
@endsection
