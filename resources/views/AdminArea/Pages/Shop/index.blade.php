<!-- resources/views/AdminArea/Pages/Products/index.blade.php -->
@extends('AdminArea.Layout.main')
@section('Admincontainer')

<div class="app-hero-header d-flex align-items-center">
    <!-- Breadcrumb starts -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item text-primary" aria-current="page">
            Product Management
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Product List</h5>
                    <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add New Product
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basicExample" class="table truncate m-0 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discounted Price</th>
                                    <th>Color</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->productId }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{!! Str::limit($item->description, 50) !!}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rs.{{ number_format($item->price, 2) }}</td>
                                    <td>
                                        @if ($item->discount > 0)
                                            ${{ number_format($item->price * (1 - $item->discount / 100), 2) }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $item->product_color }}</td>
                                    <td>{{ $item->brand_name }}</td>
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#uploadImageModal"
                                            onclick="openUploadImageModal('{{ $item->productId }}')">
                                            <i class="ri-add-circle-line menu-icon"></i>
                                        </button>
                                        <a href="{{ route('products.viewProductImageAll', $item->productId) }}" class="btn btn-outline-info btn-sm">
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
                                                onclick="editProduct('{{ $item->id }}', '{{ $item->name }}', '{{ $item->description }}', '{{ $item->quantity }}', '{{ $item->price }}', '{{ $item->category_id }}', '{{ $item->product_color }}', '{{ $item->brand_name }}', '{{ $item->discount }}')">
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addProductForm" action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div id="fullEditorProduct"></div>
                        <textarea class="form-control d-none" id="description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="product_color" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="product_color" name="product_color" required>
                    </div>
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="brand_name" name="brand_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Product Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editProductForm" action="{{ route('products.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_product_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <div id="editFullEditor"></div>
                        <textarea class="form-control d-none" id="edit_description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="edit_quantity" name="quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_discount" class="form-label">Discount (%)</label>
                        <input type="number" class="form-control" id="edit_discount" name="discount" min="0" max="100" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="edit_product_color" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="edit_product_color" name="product_color" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_brand_name" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" id="edit_brand_name" name="brand_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_category_id" class="form-label">Product Category</label>
                        <select class="form-select" id="edit_category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteProductForm" action="{{ route('products.delete') }}" method="POST">
                @csrf
                <input type="hidden" id="productId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <img src="{{ asset('AdminArea/images/bin.gif') }}" alt="Delete Confirmation" width="80">
                    </div>
                    <h5>Are you sure you want to delete this product?</h5>
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
                <h5 class="modal-title" id="uploadImageModalLabel">Add New Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.productImageAdd') }}" method="POST" enctype="multipart/form-data" id="uploadImageForm">
                    @csrf
                    <input type="hidden" id="uploadProductId" name="productId">
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image <span style="color: red;">*</span></label>
                        <input type="file" class="form-control" id="image" name="image[]" multiple required accept="image/*">
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
    const addEditor = new Quill('#fullEditorProduct', {
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
        document.getElementById('description').value = addEditor.root.innerHTML;
    });

    // Sync Quill editor content with textarea for edit form
    editEditor.on('text-change', function() {
        document.getElementById('edit_description').value = editEditor.root.innerHTML;
    });

    function editProduct(id, name, description, quantity, price, category_id, product_color, brand_name, discount) {
        document.getElementById('edit_product_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;
        editEditor.root.innerHTML = description;
        document.getElementById('edit_quantity').value = quantity;
        document.getElementById('edit_price').value = price;
        document.getElementById('edit_category_id').value = category_id;
        document.getElementById('edit_product_color').value = product_color;
        document.getElementById('edit_brand_name').value = brand_name;
        document.getElementById('edit_discount').value = discount;
        $('#editProductModal').modal('show');
    }

    function confirmDelete(productId) {
        document.getElementById('productId').value = productId;
        $('#deleteProductModal').modal('show');
    }

    function openUploadImageModal(productId) {
        document.getElementById('uploadProductId').value = productId;
        $('#uploadImageModal').modal('show');
    }
</script>
@endpush
