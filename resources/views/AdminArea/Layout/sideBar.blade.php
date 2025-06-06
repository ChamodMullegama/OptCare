      <nav id="sidebar" class="sidebar-wrapper">

          <!-- Sidebar profile starts -->
          <div class="sidebar-profile">
            <img src="assets/images/user6.png" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
            <div class="m-0">
              <h5 class="mb-1 profile-name text-nowrap text-truncate">Nick Gonzalez</h5>
              <p class="m-0 small profile-name text-nowrap text-truncate">Dept Admin</p>
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
                <a href="dashboard2.html">
                  <i class="ri-home-smile-2-line"></i>
                  <span class="menu-text">Medical Dashboard</span>
                </a>
              </li>
              <li>
                <a href="dashboard3.html">
                  <i class="ri-home-5-line"></i>
                  <span class="menu-text">Dentist Dashboard</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="fas fa-stethoscope"></i>

                  <span class="menu-text">Doctors</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="doctor-dashboard.html">Doctors Dashboard</a>
                  </li>
                  <li>
                    <a href="doctors-list.html">Doctors List</a>
                  </li>
                  <li>
                    <a href="doctors-cards.html">Doctors Cards</a>
                  </li>
                  <li>
                    <a href="doctors-profile.html">Doctors Profile</a>
                  </li>
                  <li>
                    <a href="add-doctors.html">Add Doctor</a>
                  </li>
                  <li>
                    <a href="edit-doctors.html">Edit Doctor</a>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-heart-pulse-line"></i>
                  <span class="menu-text">Patients</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="patient-dashboard.html">Patients Dashboard</a>
                  </li>
                  <li>
                    <a href="patients-list.html">Patients List</a>
                  </li>
                  <li>
                    <a href="add-patient.html">Add Patient</a>
                  </li>
                  <li>
                    <a href="edit-patient.html">Edit Patient Details</a>
                  </li>
                </ul>
              </li>
                   <li>
                <a href="{{ route('doctors.all') }}">
                     <i class="ri-user-heart-line"></i>
                  <span class="menu-text">Doctors</span>
                </a>
              </li>

              <li class="treeview">
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
                    <a href="{{ route('treatments.all') }}">Treatments</a>
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
                 <li>
                <a href="{{ route('settings.all') }}">
                          <i class="ri-settings-3-line"></i>
                  <span class="menu-text">Settings</span>
                </a>
              </li>

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
