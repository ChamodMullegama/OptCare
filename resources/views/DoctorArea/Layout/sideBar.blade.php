<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"
        style="color: #E91E63; font-weight: bold; font-family: 'Poppins', sans-serif; font-size: 24px; text-transform: uppercase;">
        Ayur Essence
     </a>

        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img src="{{ asset('AdminArea/images/footer.jpeg') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>
        <ul class="navbar-nav">
          <li class="nav-item nav-search d-none d-md-flex">
            <div class="nav-link">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">




          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="{{ asset('AdminArea/images/faces/face5.jpg') }}" alt="profile"/>
                <span>{{ session('user_name') ?? session('email') }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                <div class="dropdown-divider"></div>
                <form action="{{ route('AdminLogin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-power-off text-primary"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>

          {{-- <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <img src="images/faces/face5.jpg" alt="profile"/>
                <span class="ml-2">{{ session('user_name', 'User') }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                    <i class="fas fa-user text-primary"></i>
                    {{ session('user_email', 'No Email') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('AdminLogin.logout') }}">
                    <i class="fas fa-power-off text-primary"></i>
                    Logout
                </a>
            </div>
        </li> --}}


        </ul>

      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close fa fa-times"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close fa fa-times"></i>
        <ul class="nav nav-tabs" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove fa fa-times-circle"></i>
                </li>
              </ul>
            </div>
            <div class="events py-4 border-bottom px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
              <p class="text-gray mb-0">build a js based app</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="fa fa-times-circle text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ url('/dashboard') }}">
          <i class="fa fa-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#sale-layouts" aria-expanded="false" aria-controls="page-layouts">
            <i class="fas fa-shopping-cart menu-icon"></i>
            <span class="menu-title">Sale Medicinal Plants</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="sale-layouts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('SalePlants.all') }}">Sale Plants</a></li>
            <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('orderManagement.show') }}">Orders</a></li>
            <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('SalePlants.portfolioAll') }}">Add Portfilo</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false" aria-controls="page-layouts">
            <i class="fas fa-seedling menu-icon"></i>
            <span class="menu-title">Plants Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="page-layouts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('PlantManagement.plantCategoryAll') }}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('PlantManagement.plantAll') }}">Add Plants</a></li>
            <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="{{ route('PlantManagement.plantDiseasesAll') }}">Plant Diseases</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
            <i class="fas fa-user-md menu-icon"></i>
           <span class="menu-title">Doctors Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="sidebar-layouts">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('DoctorManagement.specializationAll') }}">Specialization</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('DoctorManagement.doctorAll') }}">Add Doctors</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/layout/sidebar-hidden.html">View Appointment</a></li>

          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="fas fa-book menu-icon"></i>

          <span class="menu-title">Educational Contents</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('EducationalContent.ayurvedaGuideAll') }}">Add Ayurveda Guide</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('EducationalContent.blogAll') }}">Add Blogs</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('EducationalContent.meetingAndEventAll') }}">Meeting/ Events</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('EducationalContent.conservationAwarenessAll') }}">Conservation/ Awareness</a></li>

          </ul>
          </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
            <i class="fas fa-box menu-icon"></i>

          <span class="menu-title">Products Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-advanced">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('ProductManagement.productCategoryAll') }}">Products Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('ProductManagement.productAll') }}">Products</a></li>

          </ul>
        </div>
      </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('Gallery.all') }}">
                <i class="fas fa-images menu-icon"></i>

              <span class="menu-title">Gallery</span>
            </a>
          </li>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('Service.all') }}">
            <i class="fas fa-concierge-bell menu-icon"></i>
          <span class="menu-title">Services</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('Treatment.all') }}">
            <i class="fas fa-leaf menu-icon"></i>
          <span class="menu-title">Treatments</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('QuestionsAndAnswers.all') }}">
            <i class="fas fa-mortar-pestle menu-icon"></i>
          <span class="menu-title">Q And A</span>
        </a>
      </li>



      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/todo') }}">
            <i class="fas fa-star menu-icon"></i>

          <span class="menu-title">Customer Reviews</span>
        </a>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#customer" aria-expanded="false" aria-controls="customer">
            <i class="fas fa-star menu-icon"></i>
          <span class="menu-title">Customer</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="customer">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('CustomerManagement.contactUsAll') }}">Contact Us</a></li>
            {{-- <li class="nav-item"> <a class="nav-link" href="#">Customer Reviews</a></li> --}}
            <li class="nav-item"> <a class="nav-link" href="{{ route('CustomerManagement.getHealthAll') }}">Get Health</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('CustomerManagement.newsLetterAll') }}">Subscription</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
          <i class="fas fa-map-marker-alt menu-icon"></i>
          <span class="menu-title">Locations</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="maps">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('Location.herbalGardenAll') }}">Herbal Gardens</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('Location.ayurvedicHospitalAll') }}">Ayurvedic Hospitals</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('Location.localPharmacyAll') }}">Local Pharmacies</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
            <i class="fa fa-cogs menu-icon"></i>
          <span class="menu-title">Settings</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="settings">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('Setting.all') }}">Basic Data</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('Setting.userRoleAll') }}">User Management</a></li>

          </ul>
        </div>
      </li>


    </ul>
  </nav>
