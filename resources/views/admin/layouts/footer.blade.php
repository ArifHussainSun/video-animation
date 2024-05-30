<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet alert init js-->
<script src="{{asset('backend/assets/js/pages/sweet-alerts.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('backend/assets/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/parsleyjs/parsley.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>

<!--tinymce js-->
<script src="{{asset('backend/assets/libs/tinymce/tinymce.min.js')}}"></script>
<!-- form repeater js -->
<script src="{{asset('backend/assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
{{-- <script src="{{ asset('backend/ckeditor/ckeditor.js')}}"></script> --}}
<script src="{{ asset('backend/assets/libs/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    setTimeout(() => {
        $(document).find('.btn-close').trigger('click');
    }, 3000);

    function printErrorMsg (msg) {
        $('.alert-message').html('<div class="alert alert-success">'+msg+'</div>');
    }

    function showMsg(type, message) {
        $(document).find('.alert-message').html('<div class="alert alert-' + type + '">' + message + '</div>');
    }


</script>

@stack('customScripts')
