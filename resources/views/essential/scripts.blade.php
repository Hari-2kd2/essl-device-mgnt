<!-- BEGIN: JS Assets-->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    function toggleModal(modalID) {
        document.getElementById(modalID).classList.toggle("hidden");
        document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
        document.getElementById(modalID).classList.toggle("flex");
        document.getElementById(modalID + "-backdrop").classList.toggle("flex");
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).ready(function() {
        getDataTable(1);
    });

    $('#search').keyup(function(e) {
        getDataTable(1);
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getDataTable(page);
    });

    function AddModal() {
        toggleModal('modal-add');
    }

    function deleteModal(essl_device_id) {
        $('#deleteID').val(essl_device_id);
        toggleModal('modal-delete');
    }


</script>
@stack('scripts')
<!-- END: JS Assets-->
