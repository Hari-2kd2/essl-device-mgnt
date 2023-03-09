<div class="bg-white px-5 rounded-lg">
    <div class="flex items-center justify-between py-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">
            EDIT DEVICE
        </h3>
        <button type="button" onclick="toggleModal('modal-edit')"
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

    <form id="update_device" class="space-y-2 w-96" action="">
        @csrf

        <input hidden type="text" value="{{ $essl->essl_device_id }}" name="essl_device_id" id="essl_device_id">
        <div class="flex flex-row w-full">

            <div class="w-full">
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">IP
                        Address
                    </label>
                    <input type="text" name="ip_address" id="ip_address" value="{{ $essl->ip_address }}"
                        class="mb-2 bg-muted border border-muted_hover text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="0.0.0.0" required>
                </div>
                <div class="">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Status
                    </label>
                    <select name="status" id="status" value="{{ $essl->status }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if ($essl->status == 0)
                            <option value="0">Active</option>
                        @else
                            <option value="1">Inactive</option>
                        @endif
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                </div>

                <div class="">
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Device
                        Type
                    </label>
                    <select name="device_type" id="device_type" value="{{ $essl->device_type }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if ($essl->device_type == 'IN')
                            <option value="IN">IN</option>
                        @elseif($essl->device_type == 'OUT')
                            <option value="OUT">OUT</option>
                        @else
                            <option value="IN/OUT">IN/OUT</option>
                        @endif
                        <option value="IN">IN</option>
                        <option value="OUT">OUT</option>
                        <option value="IN/OUT">IN/OUT</option>


                    </select>
                </div>

                <div>
                    <label for="name"
                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Description
                    </label>
                    <textarea name="description" id="description" rows="5" class="rounded-lg w-full ">{{ $essl->description }}</textarea>
                    {{-- <input type="text" name="description" id="description" maxlines="4" value="{{ $essl->description }}"
                        class=" bg-muted border border-muted_hover text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block w-full px-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="description" required style="vertical-align:"> --}}
                </div>
            </div>
        </div>
        <div class="flex items-center p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button type="submit" id="update"
                class=" w-64 text-white bg-blue-500 hover:bg-primary_hover focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-blue-800">
                Update</button>
            <button onclick="toggleModal('modal-edit')" type="button"
                class=" w-64 text-gray-500 bg-white hover:bg-muted_hover focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
        </div>

    </form>
</div>





{{-- 
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
<div class="hidden opacity-25 fixed inset-0 z-40 bg-black" id="modal-add-backdrop"></div> --}}
<script>
    $('#update_device').submit(function(e) {
        e.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            type: "POST",
            url: "update_device",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    $("#update_device")[0].reset();
                    toggleModal('modal-edit');
                    toastr.success(response.message);
                    getDataTable();
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
