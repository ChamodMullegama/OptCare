<!-- resources/views/AdminArea/Pages/WebsiteSettings/index.blade.php -->
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
            Website Settings
        </li>
    </ol>
    <!-- Breadcrumb ends -->
</div>

<div class="app-body">
    <div class="row gx-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Website Settings</h5>
                    @if (!$settings)
                        <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addSettingsModal">
                            Add Details
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @if ($settings)
                        <div class="table-responsive">
                            <table id="basicExample" class="table truncate m-0 align-middle">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>RCode</th>
                                        <th>Logo</th>
                                        <th>Website Name</th>
                                        <th>Email</th>
                                        <th>Contact No 1</th>
                                        <th>City</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $settings->rcode }}</td>
                                        <td>
                                            @if ($settings->logo)
                                                <img src="{{ asset('storage/' . $settings->logo) }}" class="img-shadow img-2x rounded-5" alt="Website Logo" style="max-width: 100px;">
                                            @else
                                                <span>No Logo</span>
                                            @endif
                                        </td>
                                        <td>{{ $settings->websiteName }}</td>
                                        <td>{{ $settings->email }}</td>
                                        <td>{{ $settings->contactNo1 }}</td>
                                        <td>{{ $settings->city }}</td>
                                        <td>
                                            <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewSettingsModal">
                                                <i class="ri-eye-line"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editSettingsModal">
                                                <i class="ri-edit-box-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No settings found. Please add website settings.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Settings Modal -->
<div class="modal fade" id="addSettingsModal" tabindex="-1" aria-labelledby="addSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addSettingsForm" action="{{ route('settings.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSettingsModalLabel">Add Website Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="logo" class="form-label">Logo <span style="color: red;">*</span></label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" required>
                        </div>
                        <div class="col-md-6">
                            <label for="websiteName" class="form-label">Website Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="websiteName" name="websiteName" placeholder="Website Name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="col-md-6">
                            <label for="contactNo1" class="form-label">Contact No 1 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="contactNo1" name="contactNo1" placeholder="Contact Number 1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="contactNo2" class="form-label">Contact No 2</label>
                            <input type="text" class="form-control" id="contactNo2" name="contactNo2" placeholder="Contact Number 2">
                        </div>
                        <div class="col-md-6">
                            <label for="addressLine1" class="form-label">Address Line 1 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="addressLine1" name="addressLine1" placeholder="Address Line 1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="addressLine2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="addressLine2" name="addressLine2" placeholder="Address Line 2">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="whatsappLink" class="form-label">WhatsApp Link</label>
                            <input type="url" class="form-control" id="whatsappLink" name="whatsappLink" placeholder="WhatsApp Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="instagramLink" class="form-label">Instagram Link</label>
                            <input type="url" class="form-control" id="instagramLink" name="instagramLink" placeholder="Instagram Profile Link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="facebookLink" class="form-label">Facebook Link</label>
                            <input type="url" class="form-control" id="facebookLink" name="facebookLink" placeholder="Facebook Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="linkedinLink" class="form-label">LinkedIn Link</label>
                            <input type="url" class="form-control" id="linkedinLink" name="linkedinLink" placeholder="LinkedIn Profile Link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="twitterLink" class="form-label">Twitter Link</label>
                            <input type="url" class="form-control" id="twitterLink" name="twitterLink" placeholder="Twitter Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="footerText" class="form-label">Footer Text</label>
                            <input type="text" class="form-control" id="footerText" name="footerText" placeholder="Footer Text">
                        </div>
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


<!-- Edit Settings Modal -->
<div class="modal fade" id="editSettingsModal" tabindex="-1" aria-labelledby="editSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editSettingsForm" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="settings_id" name="id" value="{{ $settings->id ?? 1 }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSettingsModalLabel">Edit Website Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="edit_logo" name="logo" accept="image/*">
                            @if ($settings && $settings->logo)
                                <img src="{{ asset('storage/' . $settings->logo) }}" class="img-shadow img-2x rounded-5 mt-2" alt="Current Logo" style="max-width: 100px;">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="edit_websiteName" class="form-label">Website Name <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="edit_websiteName" name="websiteName" value="{{ $settings->websiteName ?? '' }}" placeholder="Website Name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_email" class="form-label">Email <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" id="edit_email" name="email" value="{{ $settings->email ?? '' }}" placeholder="Email Address" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_contactNo1" class="form-label">Contact No 1 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="edit_contactNo1" name="contactNo1" value="{{ $settings->contactNo1 ?? '' }}" placeholder="Contact Number 1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_contactNo2" class="form-label">Contact No 2</label>
                            <input type="text" class="form-control" id="edit_contactNo2" name="contactNo2" value="{{ $settings->contactNo2 ?? '' }}" placeholder="Contact Number 2">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_addressLine1" class="form-label">Address Line 1 <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="edit_addressLine1" name="addressLine1" value="{{ $settings->addressLine1 ?? '' }}" placeholder="Address Line 1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_addressLine2" class="form-label">Address Line 2</label>
                            <input type="text" class="form-control" id="edit_addressLine2" name="addressLine2" value="{{ $settings->addressLine2 ?? '' }}" placeholder="Address Line 2">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_city" class="form-label">City <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" id="edit_city" name="city" value="{{ $settings->city ?? '' }}" placeholder="City" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_whatsappLink" class="form-label">WhatsApp Link</label>
                            <input type="url" class="form-control" id="edit_whatsappLink" name="whatsappLink" value="{{ $settings->whatsappLink ?? '' }}" placeholder="WhatsApp Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_instagramLink" class="form-label">Instagram Link</label>
                            <input type="url" class="form-control" id="edit_instagramLink" name="instagramLink" value="{{ $settings->instagramLink ?? '' }}" placeholder="Instagram Profile Link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_facebookLink" class="form-label">Facebook Link</label>
                            <input type="url" class="form-control" id="edit_facebookLink" name="facebookLink" value="{{ $settings->facebookLink ?? '' }}" placeholder="Facebook Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_linkedinLink" class="form-label">LinkedIn Link</label>
                            <input type="url" class="form-control" id="edit_linkedinLink" name="linkedinLink" value="{{ $settings->linkedinLink ?? '' }}" placeholder="LinkedIn Profile Link">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_twitterLink" class="form-label">Twitter Link</label>
                            <input type="url" class="form-control" id="edit_twitterLink" name="twitterLink" value="{{ $settings->twitterLink ?? '' }}" placeholder="Twitter Profile Link">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_footerText" class="form-label">Footer Text</label>
                            <input type="text" class="form-control" id="edit_footerText" name="footerText" value="{{ $settings->footerText ?? '' }}" placeholder="Footer Text">
                        </div>
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

<!-- View Settings Modal -->
<div class="modal fade" id="viewSettingsModal" tabindex="-1" aria-labelledby="viewSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #2c3e50; color: white;">
                <h5 class="modal-title" id="viewSettingsModalLabel" style="margin: 0;">
                    <i class="fas fa-eye" style="margin-right: 8px;"></i>Website Preview
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding: 0; background: #f5f5f5;">
                @if ($settings)
                    <!-- Website Preview Container -->
                    <div style="border: 2px solid #ddd; background: white; margin: 20px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">

                        <!-- Navigation Bar Preview -->
                        <div style="background: #2c3e50; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                @if ($settings->logo)
                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" style="height: 35px; width: auto; margin-right: 12px; border-radius: 4px;">
                                @else
                                    <div style="width: 35px; height: 35px; background: #3498db; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                        <i class="fas fa-globe" style="color: white; font-size: 16px;"></i>
                                    </div>
                                @endif
                                <h3 style="margin: 0; font-size: 1.3rem; font-weight: bold;">{{ $settings->websiteName }}</h3>
                            </div>
                            <div style="display: flex; gap: 20px; font-size: 14px;">
                                <span>Home</span>
                                <span>About</span>
                                <span>Services</span>
                                <span>Contact</span>
                            </div>
                        </div>

                        <!-- Main Content Area Preview -->
                        <div style="padding: 30px 20px;">

                            <!-- Hero Section -->
                            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 40px; text-align: center; border-radius: 8px; margin-bottom: 30px;">
                                <h1 style="margin: 0 0 10px 0; font-size: 2rem;">Welcome to {{ $settings->websiteName }}</h1>
                                <p style="margin: 0; opacity: 0.9; font-size: 1.1rem;">Your trusted partner in {{ $settings->city }}</p>
                            </div>

                            <!-- Content Sections -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">

                                <!-- About Section -->
                                <div>
                                    <h3 style="color: #2c3e50; margin-bottom: 15px; font-size: 1.4rem;">About Us</h3>
                                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                        @if ($settings->logo)
                                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Company Logo" style="width: 80px; height: 60px; object-fit: contain; margin-right: 15px; border: 1px solid #eee; border-radius: 4px; padding: 5px;">
                                        @else
                                            <div style="width: 80px; height: 60px; background: #ecf0f1; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                <i class="fas fa-building" style="color: #bdc3c7; font-size: 1.5rem;"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <p style="margin: 0; color: #666; font-size: 14px; line-height: 1.5;">
                                                We are a professional company based in <strong>{{ $settings->city }}</strong>,
                                                committed to providing excellent services to our valued clients.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Info -->
                                <div>
                                    <h3 style="color: #2c3e50; margin-bottom: 15px; font-size: 1.4rem;">Contact Information</h3>
                                    <div style="font-size: 14px; line-height: 1.8; color: #666;">
                                        <p style="margin: 8px 0; display: flex; align-items: center;">
                                            <i class="fas fa-envelope" style="color: #3498db; width: 20px; margin-right: 8px;"></i>
                                            <a href="mailto:{{ $settings->email }}" style="color: #3498db; text-decoration: none;">{{ $settings->email }}</a>
                                        </p>
                                        <p style="margin: 8px 0; display: flex; align-items: center;">
                                            <i class="fas fa-phone" style="color: #27ae60; width: 20px; margin-right: 8px;"></i>
                                            <a href="tel:{{ $settings->contactNo1 }}" style="color: #27ae60; text-decoration: none;">{{ $settings->contactNo1 }}</a>
                                        </p>
                                        @if($settings->contactNo2)
                                        <p style="margin: 8px 0; display: flex; align-items: center;">
                                            <i class="fas fa-phone" style="color: #27ae60; width: 20px; margin-right: 8px;"></i>
                                            <a href="tel:{{ $settings->contactNo2 }}" style="color: #27ae60; text-decoration: none;">{{ $settings->contactNo2 }}</a>
                                        </p>
                                        @endif
                                        <p style="margin: 8px 0; display: flex; align-items: flex-start;">
                                            <i class="fas fa-map-marker-alt" style="color: #e74c3c; width: 20px; margin-right: 8px; margin-top: 2px;"></i>
                                            <span>
                                                {{ $settings->addressLine1 }}
                                                @if($settings->addressLine2), {{ $settings->addressLine2 }}@endif
                                                <br>{{ $settings->city }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media Section -->
                            <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 8px; margin-bottom: 20px;">
                                <h4 style="color: #2c3e50; margin-bottom: 15px; font-size: 1.2rem;">Follow Us</h4>
                                <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                                    @if($settings->whatsappLink)
                                        <a href="{{ $settings->whatsappLink }}" target="_blank" style="color: #25d366; font-size: 1.8rem; text-decoration: none; padding: 8px;">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif
                                    @if($settings->facebookLink)
                                        <a href="{{ $settings->facebookLink }}" target="_blank" style="color: #1877f2; font-size: 1.8rem; text-decoration: none; padding: 8px;">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    @endif
                                    @if($settings->instagramLink)
                                        <a href="{{ $settings->instagramLink }}" target="_blank" style="color: #e4405f; font-size: 1.8rem; text-decoration: none; padding: 8px;">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($settings->linkedinLink)
                                        <a href="{{ $settings->linkedinLink }}" target="_blank" style="color: #0a66c2; font-size: 1.8rem; text-decoration: none; padding: 8px;">
                                            <i class="fab fa-linkedin"></i>
                                        </a>
                                    @endif
                                    @if($settings->twitterLink)
                                        <a href="{{ $settings->twitterLink }}" target="_blank" style="color: #1da1f2; font-size: 1.8rem; text-decoration: none; padding: 8px;">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Footer Preview -->
                        <div style="background: #2c3e50; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div style="display: flex; align-items: center;">
                                @if ($settings->logo)
                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" style="height: 25px; width: auto; margin-right: 10px; border-radius: 3px;">
                                @else
                                    <div style="width: 25px; height: 25px; background: #3498db; border-radius: 3px; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                        <i class="fas fa-globe" style="color: white; font-size: 12px;"></i>
                                    </div>
                                @endif
                                <div>
                                    <h5 style="margin: 0; font-size: 1rem;">{{ $settings->websiteName }}</h5>
                                    <p style="margin: 0; font-size: 12px; color: #bdc3c7;">{{ $settings->footerText ?? 'Thank you for choosing us!' }}</p>
                                </div>
                            </div>
                            <div style="font-size: 12px; color: #bdc3c7; text-align: right;">
                                <p style="margin: 0;">&copy; 2024 {{ $settings->websiteName }}. All rights reserved.</p>
                                <p style="margin: 0;">{{ $settings->city }} | {{ $settings->email }}</p>
                            </div>
                        </div>
                    </div>

                @else
                    <div style="text-align: center; padding: 60px 20px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #ffc107; margin-bottom: 20px;"></i>
                        <h5 style="color: #495057; margin-bottom: 10px;">No Settings Available</h5>
                        <p style="color: #6c757d; margin: 0;">Please configure your website settings first to see the preview.</p>
                    </div>
                @endif
            </div>

            <div class="modal-footer" style="background: #f8f9fa; border-top: 1px solid #dee2e6;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close Preview</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@push('js')
<script>
    // JavaScript to handle modal interactions (if needed)
    document.addEventListener('DOMContentLoaded', function () {
        $('#editSettingsModal, #addSettingsModal').on('show.bs.modal', function () {
            // Values are prefilled via Blade
        });
    });
</script>
@endpush
