@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="{{ route('admin.dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Eye Scans Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Eye Scan Image List</h5>
                    <button class="btn btn-dark" onclick="window.location.href='{{ route('eyeScans.all') }}'">
                        <i class="ri-arrow-left-line"></i>
                        Back
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eye_scan_images as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->eyeScanImageId }}</td>
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" class="img-shadow img-2x rounded-5 me-1"
                                                    alt="Eye Scan Image">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $hasActive = $eye_scan_images->contains('isPrimary', 1);
                                            @endphp
                                            @if ($item->isPrimary == 1)
                                                <span class="badge badge-pill badge-soft-success font-size-20 rounded-pill">Primary</span>
                                                <a href="{{ route('EyeScans.isPrimary', $item->id) }}" class="text-danger ms-2">
                                                    <i class="ri-toggle-fill menu-icon"></i>
                                                </a>
                                            @else
                                                <span class="badge badge-pill badge-soft-danger font-size-12 rounded-pill">Secondary</span>
                                                <a href="{{ route('EyeScans.isPrimary', $item->id) }}"
                                                    class="text-primary ms-2 {{ $hasActive ? 'disabled' : '' }}"
                                                    style="{{ $hasActive ? 'pointer-events: none; opacity: 0.5;' : '' }}">
                                                    <i class="ri-toggle-fill menu-icon"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteImageForm" action="{{ route('EyeScans.viewEyeScanImageDelete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this image?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@push('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    function confirmDelete(id) {
        document.getElementById('id').value = id;
        $('#deleteImageModal').modal('show');
    }
</script>
@endpush
