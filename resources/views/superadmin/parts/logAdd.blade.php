{{-- @extends('superadmin.parts.main')

@section('content')
    <div class="">
        <form id="store_user" class="flex flex-row w-full h-auto p-10 space-x-8" action=""
            data-token="{{ csrf_token() }}">
            @csrf
            <div class="flex flex-col">
                <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">IP
                    Address
                </label>
                <input type="text" name="ip_address" id="ip_address"
                    class="mb-2 bg-muted border border-muted_hover text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="0.0.0.0" required>
            </div>
            <div date-rangepicker="" id="dateRangePickerId" datepicker-orientation=" right bottom left"
                class="flex items-center underline space-x-8">
                <div class="flex flex-col">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">From Date
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class=" w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <input name="from_date" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                            placeholder="Select date start">
                    </div>
                </div>

                <div class="flex flex-col">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">End Date
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class=" w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        <input name="to_date" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                            placeholder="Select date start">
                    </div>
                </div>
            </div>
            <div class="flex items-center p-4 space-x-8  rounded-b dark:border-gray-600">
                <button type="submit" id="create"
                    class="w-48 text-white bg-blue-500 hover:bg-primary_hover focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-blue-800">
                    Yeah, Create it</button>
                <button type="button" onclick="userStoreModal()"
                    class="w-48 text-gray-500 bg-white hover:bg-muted_hover focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    No, Cancel</button>
            </div>


        </form>
    </div>
@endsection

<script>
    $('#store_user').submit(function(e) {
        alert('sadjsaoijh');

        e.preventDefault();
        var form_data = new FormData(this);
        console.log(form_data);

    });
</script> --}}
