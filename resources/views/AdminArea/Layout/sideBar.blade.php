<nav id="sidebar" class="sidebar-wrapper">
    <!-- Sidebar profile starts -->
    <div class="sidebar-profile">
        <img src="{{ asset('AdminArea/images/admin.png') }}" class="img-shadow img-3x me-3 rounded-5" alt="Doctor Profile">
        <div class="m-0">
            <h5 class="mb-1 profile-name text-nowrap text-truncate">{{ session('admin.name', 'Admin') }}</h5>
            <p class="m-0 small profile-name text-nowrap text-truncate"></p>
        </div>
    </div>
    <!-- Sidebar profile ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebarMenuScroll">
        <ul class="sidebar-menu">
            <li class="active current-page">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="ri-home-6-line"></i>
                    <span class="menu-text">Admin Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('doctors.all') }}">
                    <i class="ri-stethoscope-line"></i>
                    Doctors
                </a>
            </li>

            <!-- Medical Services Category -->
            <li class="treeview">
                <a href="#!">
                    <i class="ri-hospital-line"></i>
                    <span class="menu-text">Specialties & Services</span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <a href="{{ route('eyeScans.all') }}">
                            <i class="ri-eye-line"></i>
                            Eye Investigations
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('eyeIssues.all') }}">
                            <i class="ri-heart-pulse-line"></i>
                            Eye Disease
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('surgicaltreatments.all') }}">
                            <i class="ri-scissors-line"></i>
                            Surgical Treatments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nonsurgicaltreatments.all') }}">
                            <i class="ri-medicine-bottle-line"></i>
                            Nonsurgical Treatments
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('eye.hospitals.all') }}">
                            <i class="ri-hospital-line"></i>
                            Eye Hospitals
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('optic.centers.all') }}">
                            <i class="ri-eye-line"></i>
                            Vision Centers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('service.all') }}">
                            <i class="ri-service-line"></i>
                            Services
                        </a>
                    </li>
                </ul>
            </li>


            <!-- Content Management Category -->
            <li class="treeview">
                <a href="#!">
                    <i class="ri-file-text-line"></i>
                    <span class="menu-text">Content Management</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('blog.all') }}">
                            <i class="ri-edit-line"></i>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.all') }}">
                            <i class="ri-image-line"></i>
                            Gallery
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('qa.all') }}">
                            <i class="ri-question-answer-line"></i>
                            FAQs
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Patient Management Category -->
            <li class="treeview">
                <a href="#!">
                    <i class="ri-user-heart-line"></i>
                    <span class="menu-text">Patient Management</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('customerMessage.all') }}">
                            <i class="ri-message-3-line"></i>
                            Patient Messages
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.all') }}">
                            <i class="ri-user-3-line"></i>
                            Patients
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('appointment.viewAdminAppointments') }}">
                            <i class="ri-calendar-check-line"></i>
                            View Appointments
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('review.all') }}">
                            <i class="ri-feedback-line"></i>
                            User Reviews
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Shop Management Category -->
            <li class="treeview">
                <a href="#!">
                    <i class="ri-shopping-bag-line"></i>
                    <span class="menu-text">Shop Management</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('productCategories.all') }}">
                            <i class="ri-folder-line"></i>
                            Product Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.all') }}">
                            <i class="ri-shopping-cart-line"></i>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}">
                            <i class="ri-file-list-3-line"></i>
                            Orders
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Team and Subscriptions Category -->
            <li class="treeview">
                <a href="#!">
                    <i class="ri-group-line"></i>
                    <span class="menu-text">Team & Subscriptions</span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('team.all') }}">
                            <i class="ri-team-line"></i>
                            Team
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subscriptions.all') }}">
                            <i class="ri-vip-crown-line"></i>
                            Subscriptions
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Settings -->
            <li>
                <a href="{{ route('settings.all') }}">
                    <i class="ri-settings-3-line"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </li>

            <!-- Public Page -->
            <li>
                <a href="{{ route('Home.home') }}">
                    <i class="ri-global-line"></i>
                    <span class="menu-text">Public Page</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar menu ends -->


</nav>
