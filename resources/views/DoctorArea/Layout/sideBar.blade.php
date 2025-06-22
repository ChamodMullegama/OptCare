<nav id="sidebar" class="sidebar-wrapper">

    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        @if(session('doctor.image'))
            <img src="{{ asset('storage/' . session('doctor.image')) }}" class="img-shadow img-3x me-3 rounded-5" alt="Doctor Profile">
        @else
            <img src="{{ asset('assets/images/user6.png') }}" class="img-shadow img-3x me-3 rounded-5" alt="Default Profile">
        @endif
        <div class="m-0">
            <h5 class="mb-1 profile-name text-nowrap text-truncate">{{ session('doctor.name', 'Doctor') }}</h5>
            <p class="m-0 small profile-name text-nowrap text-truncate">{{ session('doctor.designation', 'Designation') }}</p>
        </div>
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="active current-page">
                <a href="{{ route('doctor.dashboard') }}">
                    <i class="ri-home-6-line"></i>
                    <span class="menu-text">Doctor Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('oct.upload') }}">
                    <i class="ri-focus-3-line"></i>
                    <span class="menu-text">OCT Analyzer</span>
                </a>
            </li>

            <li>
                <a href="{{ route('oct.patients') }}">
                    <i class="ri-user-3-line"></i>
                    <span class="menu-text">Patient</span>
                </a>
            </li>

            <li>
                <a href="{{ route('review.DoctorReviewAll') }}">
                    <i class="ri-chat-3-line"></i>
                    <span class="menu-text">Patient Review</span>
                </a>
            </li>

            <li>
                <a href="{{ route('appointment.all') }}">
                    <i class="ri-calendar-check-line"></i>
                    <span class="menu-text">Appointment</span>
                </a>
            </li>

            <li>
                <a href="{{ route('appointment.today') }}">
                    <i class="ri-time-line"></i>
                    <span class="menu-text">Today Appointment</span>
                </a>
            </li>

            <li>
                <a href="{{ route('doctor.needHelp.requests') }}">
                    <i class="ri-customer-service-2-line"></i>
                    <span class="menu-text">Request Respon</span>
                </a>
            </li>

            {{-- Uncomment and use these if needed --}}
            {{--
            <li>
                <a href="{{ route('blog.all') }}">
                    <i class="ri-edit-line"></i>
                    <span class="menu-text">Blog</span>
                </a>
            </li>

            <li>
                <a href="{{ route('gallery.all') }}">
                    <i class="ri-image-line"></i>
                    <span class="menu-text">Gallery</span>
                </a>
            </li>

            <li>
                <a href="{{ route('service.all') }}">
                    <i class="ri-service-line"></i>
                    <span class="menu-text">Service</span>
                </a>
            </li>

            <li>
                <a href="{{ route('qa.all') }}">
                    <i class="ri-question-answer-line"></i>
                    <span class="menu-text">Faq’s</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#!">
                    <i class="ri-shopping-bag-line"></i>
                    <span class="menu-text">Shop</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('productCategories.all') }}">
                            <i class="ri-list-check"></i> Product Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.all') }}">
                            <i class="ri-shopping-bag-line"></i> Product
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#!">
                    <i class="ri-dossier-line"></i>
                    <span class="menu-text">Eduction Content</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('eyeScans.all') }}">
                            <i class="ri-scan-2-line"></i> Scans
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('eyeIssues.all') }}">
                            <i class="ri-eye-line"></i> Eye Disease
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('surgicaltreatments.all') }}">
                            <i class="ri-medicine-bottle-line"></i> Surgical treatments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nonsurgicaltreatments.all') }}">
                            <i class="ri-heart-pulse-line"></i> Nonsurgical treatments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('eye.hospitals.all') }}">
                            <i class="ri-hospital-line"></i> Eye Hospitals
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('optic.centers.all') }}">
                            <i class="ri-eye-2-line"></i> Vision Centers
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('settings.all') }}">
                    <i class="ri-settings-3-line"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </li>

            <li>
                <a href="{{ route('Home.home') }}">
                    <i class="ri-global-line"></i>
                    <span class="menu-text">Public Page</span>
                </a>
            </li>
            --}}
        </ul>
    </div>
    <!-- Sidebar menu ends -->
</nav>
