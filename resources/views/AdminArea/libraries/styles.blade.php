<!-- ========== CSS SECTION ========== -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('AdminArea/fonts/remix/remixicon.css') }}">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

<!-- Scrollbar CSS -->
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

<!-- Quill Editor -->
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/quill/quill.core.css') }}">

<!-- Uploader CSS -->
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/dropzone/dropzone.min.css') }}">
<link href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/datatables/dataTables.bs5.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/datatables/dataTables.bs5-custom.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/datatables/buttons/dataTables.bs5-custom.css') }}">

<link rel="stylesheet" href="{{ asset('AdminArea/css/main.min.css') }}">

    <!-- Input Tags css -->
<link rel="stylesheet" href="{{ asset('AdminArea/vendor/input-tags/tagsinput.css') }}">

<style>
    .modal-backdrop.show {
    opacity: 0.4;
    background-color: #000;
}

   .toast-success {
        background-color: #28a745 !important;
    }

    .toast-error {
        background-color: #dc3545 !important;
    }
</style>
@stack('css')
