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
                <a href="index.html">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Hospital Dashboard</span>
                </a>
              </li>

                 <li>
    <a href="{{ route('oct.upload') }}">
        <i class="ri-scan-line"></i>
        <span class="menu-text">OCT Analyzer</span>
    </a>
</li>

<li>
    <a href="{{ route('oct.patients') }}">
        <i class="ri-user-heart-line"></i>
        <span class="menu-text">Patient</span>
    </a>
</li>
<li>
    <a href="{{ route('review.DoctorReviewAll') }}">
        <i class="ri-user-heart-line"></i>
        <span class="menu-text">Patient Review</span>
    </a>
</li>



{{--
                   <li>
                <a href="{{ route('doctors.all') }}">
                     <i class="ri-user-heart-line"></i>
                  <span class="menu-text">Doctors</span>
                </a>
              </li> --}}

              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">Eduction Content</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{ route('eyeScans.all') }}">Scans</a>
                  </li>
                        <li>
                    <a href="{{ route('eyeIssues.all') }}">Eye Disease</a>
                  </li>
                         </li>
                        <li>
                    <a href="{{ route('surgicaltreatments.all') }}">Surgical treatments</a>

                  </li>
                        <li>
                    <a href="{{ route('nonsurgicaltreatments.all') }}">Nonsurgical treatments</a>
                  </li>
                         <li>
                    <a href="{{ route('eye.hospitals.all') }}">Eye Hospitals</a>
                  </li>
          <li>
                    <a href="{{ route('optic.centers.all') }}">Vision Centers</a>
                  </li>


                </ul>
              </li>
               <li>
                <a href="{{ route('blog.all') }}">
               <i class="ri-edit-line"></i>
                  <span class="menu-text">Blog</span>
                </a>
              </li>
              <li>
                <a href="{{ route('gallery.all') }}">
                  <i class="ri-tent-line"></i>
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

                  <span class="menu-text">
Faq’s</span>
                </a>
              </li>

                 <li class="treeview">
                <a href="#!">
              <i class="ri-shopping-bag-line"></i>

                  <span class="menu-text">Shop</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{ route('productCategories.all') }}">Product Categories</a>
                  </li>
                        <li>
                    <a href="{{ route('products.all') }}">Product</a>
                  </li>
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
                          <i class="ri-settings-3-line"></i>
                  <span class="menu-text">Public Page</span>
                </a>
              </li> --}}

          </div>
          <!-- Sidebar menu ends -->

          <!-- Sidebar contact starts -->
          <div class="sidebar-contact">
            <p class="fw-light mb-1 text-nowrap text-truncate">Emergency Contact</p>
            <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
            <i class="ri-phone-line"></i>
          </div>
          <!-- Sidebar contact ends -->

        </nav>

