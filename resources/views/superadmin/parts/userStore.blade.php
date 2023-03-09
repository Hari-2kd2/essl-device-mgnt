<div class="">
    <form id="update_device" class="space-y-2 pt-2 w-96 px-4" action="">
        @csrf
        <input hidden type="text" value="{{ $essl->id }}" name="id" id="id">
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
                    <select name="status" id="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
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
