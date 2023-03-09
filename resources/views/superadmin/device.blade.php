@extends('superadmin.parts.main', [
    'breadcum' => 'Device',
    'route' => 'device',
])


@section('content')
    <div class="p-4">
        <div class="flex items-start justify-between">
            <div class="flex items-start">
                <div id="loader" class="pt-1" hidden>
                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
                <button type="button" onclick="userAddModel()"
                    class="py-2.5 px-2.5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-muted_hover hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>
                <button type="button" id="refresh"
                    class="py-2.5 px-2.5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-muted_hover hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </button>
                <div class="w-48">
                    <select id="ipaddress" name="ipaddress"
                        class="w-48 py-2.5 px-2.5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-muted_hover hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <option value="0" selected disabled>Select Ping Device</option>
                        @foreach ($ipAddress as $address)
                            <option value={{ $address->ip_address }}> {{ $address->ip_address }}</option>
                        @endforeach

                    </select>
                </div>

            </div>
        </div>
        <div class="flex flex-col w-full" id="essls">

        </div>


    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#ipaddress').change(function(e) {
            e.preventDefault();
            $ip = $('#ipaddress').val();
            getData($ip);
        });

        function getData(ip) {
            $('#loader').show();
            $.ajax({
                type: "GET",
                url: "ping_device",
                data: {
                    ip_address: ip,
                },
                success: function(response) {
                    if (response == 'Success') {
                        toastr.success(response);
                    } else {
                        toastr.error(response);
                    }
                    $('#loader').hide();
                }
            });

        }
        $(document).ready(function() {
            getDataTable();
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getDataTableFilter(page);
        });

        $('#search').keyup(function(e) {
            e.preventDefault();
            $search = $('#search').val();
            getDataTableFilter();
        });

        $('#refresh').click(function(e) {
            e.preventDefault();
            getDataTable();
            toastr.success("Data Refreshed...");
        });

        function getDataTable() {
            $.ajax({
                type: "GET",
                url: "get_device",
                success: function(response) {
                    $('#essls').html(response);
                }
            });
        }

        function getDataTableFilter(page) {
            $.ajax({
                type: "GET",
                url: "getuser" + "?page=" + page,
                data: {
                    search: $search,
                    name_asc: $name,
                    email_asc: $email,
                    phone_asc: $phone,
                    role: $role,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#users').html(response);
                }
            });
        }

        $('#addessl').submit(function(e) {
            e.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                type: "POST",
                url: "add_device",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        getDataTable();
                        toggleModal('modal-add');
                        $("#addessl")[0].reset();
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });



        function userAddModel() {
            toggleModal('modal-add');
        }



        function showDelete(id) {
            $('#deleteIDNew').val(id);
            toggleModal('modal-id');
        }

        $('#deleteItem').click(function(e) {
            e.preventDefault();
            $id = $('#deleteIDNew').val();
            $.ajax({
                type: "GET",
                url: "delete_device",
                data: {
                    id: $id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == true) {
                        getDataTable();
                        toggleModal('modal-id');
                        $('#deleteIDNew').val("");
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });


        $('#startDate').change(function() {
            var date = $('#startDate');
            console.log(this.value);
        });

        function showEdit(id) {
            $.ajax({
                type: "get",
                url: "edit_device",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#deviceEditPart').html(response);
                    toggleModal('modal-edit');
                }
            });
        }
    </script>
@endpush


@section('extras')
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="modal-id">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                <!--footer-->
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <input hidden type="text" id="deleteIDNew">
                    <h3 class="mb-8 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete
                        this product?</h3>
                    <button type="button" id="deleteItem"
                        class="w-48 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button type="button" onclick="toggleModal('modal-id')"
                        class="w-48 text-gray-500 bg-white hover:bg-muted_hover focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-id-backdrop"></div>




    {{-- User Edit --}}
    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="modal-edit">

        <div id="deviceEditPart"></div>

    </div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-edit-backdrop"></div>




    {{-- User Edit --}}







    <div class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center"
        id="modal-add">
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
            <!--content-->
            <div
                class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">

                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Add Essl Device
                    </h3>
                    <button type="button" onclick="toggleModal('modal-add')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="addessl" class="space-y-2 w-96" action="">
                    <div class="p-4">
                        @csrf
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">IP
                                Address
                            </label>
                            <input type="text" name="ip_address" id="ip_address"
                                class="mb-2 bg-muted border border-muted_hover text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="0.0.0.0" required>
                        </div>
                        <div class="">
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Status
                            </label>
                            <select name="status" id="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Device Type
                            </label>
                            <select name="device_type" id="device_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option>Pls Select One</option>
                                <option value="IN">IN</option>
                                <option value="OUT">OUT</option>
                                <option value="IN/OUT">IN/OUT</option>
                            </select>
                        </div>


                        <div>
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Discription
                            </label>

                            <input type="text" name="description" id="description" maxlines="4"
                                class=" bg-muted border border-muted_hover text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5 py-6 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="description" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" id="create"
                            class="w-48 text-white bg-blue-500 hover:bg-primary_hover focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-blue-800">
                            Yeah, Create it</button>
                        <button type="button" onclick="userAddModel()"
                            class="w-48 text-gray-500 bg-white hover:bg-muted_hover focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-add-backdrop"></div>







    <!-- //add user modal -->
@endsection
