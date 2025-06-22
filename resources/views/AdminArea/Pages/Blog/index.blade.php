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
            Blog Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Blog List</h5>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                        Add New Blog
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Content</th>
                                    <th>Tags</th>
                                    <th>Special Thing</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{!! Str::limit($item->content, 50) !!}</td>
                                    <td>{{ $item->tags }}</td>
                                    <td>{{ $item->special_thing }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                            data-toggle="modal" data-target="#uploadImageModal"
                                            onclick="openUploadImageModal('{{ $item->blogId }}')">
                                            <i class="ri-add-circle-line menu-icon"></i>
                                        </button>
                                        <a href="{{ route('Blog.viewBlogImageAll', $item->blogId) }}"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="ri-eye-line menu-icon"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-inline-flex gap-1">
                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm"
                                                onclick="editBlog('{{ $item->id }}', '{{ $item->title }}', '{{ $item->date }}', `{{ $item->content }}`, '{{ $item->tags }}', '{{ $item->special_thing }}')">
                                                <i class="ri-edit-box-line"></i>
                                            </button>
                                        </div>
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

<!-- Add Blog Modal -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addBlogForm" action="{{ route('blog.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBlogModalLabel">Add New Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <div id="fullEditor"></div>
                        <textarea class="form-control d-none" id="content" name="content" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        {{-- <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g., tech, news, tutorial"> --}}

                          <input type="text" class="form-control" id="tags" name="tags"
                      data-role="tagsinput">
                    </div>
                    <div class="mb-3">
                        <label for="special_thing" class="form-label">Special Thing</label>
                        <input type="text" class="form-control" id="special_thing" name="special_thing">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Blog Modal -->
<div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBlogForm" action="{{ route('blog.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_blog_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_content" class="form-label">Content</label>
                        <div id="editFullEditor"></div>
                        <textarea class="form-control d-none" id="edit_content" name="content" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tags" class="form-label">Tags</label>
                        {{-- <input type="text" class="form-control" id="edit_tags" name="tags"> --}}
                              <input type="text" class="form-control" id="edit_tags" name="tags"
                      data-role="tagsinput">
                    </div>
                    <div class="mb-3">
                        <label for="edit_special_thing" class="form-label">Special Thing</label>
                        <input type="text" class="form-control" id="edit_special_thing" name="special_thing">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteBlogModal" tabindex="-1" aria-labelledby="deleteBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteBlogForm" action="{{ route('blog.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="blogId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBlogModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this blog?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Add New Blog Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Blog.blogImageAdd') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                    @csrf
                    <input type="hidden" id="uploadBlogId" name="blogId">
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image <span style="color: red;">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
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
    // Initialize Quill editor for add form
    const addEditor = new Quill('#fullEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Initialize Quill editor for edit form
    const editEditor = new Quill('#editFullEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Sync Quill editor content with textarea for add form
    addEditor.on('text-change', function() {
        document.getElementById('content').value = addEditor.root.innerHTML;
    });

    // Sync Quill editor content with textarea for edit form
    editEditor.on('text-change', function() {
        document.getElementById('edit_content').value = editEditor.root.innerHTML;
    });

    function editBlog(id, title, date, content, tags, special_thing) {
        document.getElementById('edit_blog_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_date').value = date;
        document.getElementById('edit_content').value = content;
        document.getElementById('edit_tags').value = tags;
        document.getElementById('edit_special_thing').value = special_thing;
        editEditor.root.innerHTML = content;
        $('#editBlogModal').modal('show');
    }

    function confirmDelete(blogId) {
        document.getElementById('blogId').value = blogId;
        $('#deleteBlogModal').modal('show');
    }

    function openUploadImageModal(blogId) {
        document.getElementById('uploadBlogId').value = blogId;
        $('#uploadImageModal').modal('show');
    }
</script>
@endpush
