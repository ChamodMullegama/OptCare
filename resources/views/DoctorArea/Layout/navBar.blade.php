      <div class="app-header d-flex align-items-center">


           <div id="loading-wrapper">
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
      <div class="spin-wrapper">
        <div class="circle"></div>
        <div class="circle"></div>
      </div>
    </div>
        <!-- Toggle buttons starts -->
        <div class="d-flex">
          <button class="toggle-sidebar">
            <i class="ri-menu-line"></i>
          </button>
          <button class="pin-sidebar">
            <i class="ri-menu-line"></i>
          </button>
        </div>
        <!-- Toggle buttons ends -->

        <!-- App brand starts -->
        <div class="app-brand ms-3">
          <a href="index.html" class="d-lg-block d-none">
            <img src="assets/images/logo.svg" class="logo" alt="Medicare Admin Template">
          </a>
          <a href="index.html" class="d-lg-none d-md-block">
            <img src="assets/images/logo-sm.svg" class="logo" alt="Medicare Admin Template">
          </a>
        </div>
        <!-- App brand ends -->

        <!-- App header actions starts -->
        <div class="header-actions">

          <!-- Search container starts -->
          <div class="search-container d-lg-block d-none mx-3">
            <input type="text" class="form-control" id="searchId" placeholder="Search">
            <i class="fas fa-search"></i>

          </div>
          <!-- Search container ends -->


          <!-- Header actions ends -->

          <!-- Header user settings starts -->
       @php
    $doctorName = session('doctor.name', 'Doctor');
    $initials = strtoupper(substr($doctorName, 0, 2));
@endphp

<div class="dropdown ms-2">
    <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        <div class="avatar-box">{{ $initials }}<span class="status busy"></span></div>
    </a>
    <div class="dropdown-menu dropdown-menu-end shadow-lg">
        <div class="px-3 py-2">
            <h6 class="m-0">{{ $doctorName }}</h6>
        </div>
        <div class="mx-3 my-2 d-grid">
            <a href="login.html" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

          <!-- Header user settings ends -->

        </div>
        <!-- App header actions ends -->

      </div>
