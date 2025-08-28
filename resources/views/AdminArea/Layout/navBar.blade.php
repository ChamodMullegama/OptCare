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
          <div class="d-flex">
              <button class="toggle-sidebar">
                  <i class="ri-menu-line"></i>
              </button>
              <button class="pin-sidebar">
                  <i class="ri-menu-line"></i>
              </button>
          </div>
          <div class="app-brand ms-3">
              <a href="{{ route('admin.dashboard') }}" class="d-lg-block d-none">
                  <img src="{{ asset('PublicArea/images/footer-logo.png') }}" class="logo"
                      alt="Medicare Admin Template">
              </a>
              <a href="{{ route('admin.dashboard') }}" class="d-lg-none d-md-block">
                  <img src="{{ asset('PublicArea/images/footer-logo.png') }}" class="logo"
                      alt="Medicare Admin Template">
              </a>
          </div>
          <div class="header-actions">
              <div class="search-container d-lg-block d-none mx-3">
                  <input type="text" class="form-control" id="searchId" placeholder="Search">
                  <i class="ri-search-line" style="color: #000; font-size: 17px;"></i>
              </div>
              <div class="d-lg-flex d-none gap-2">
              </div>
              <div class="dropdown ms-2">
                  <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="avatar-box">AD<span class="status busy"></span></div>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end shadow-lg">
                      <div class="px-3 py-2">
                          <h6 class="m-0">{{ session('admin.name', 'Admin') }}</h6>
                      </div>
                      <div class="mx-3 my-2 d-grid">
                          <form action="{{ route('admin.logout') }}" method="POST">
                              @csrf
                              <button type="submit" class="btn btn-danger">Logout</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
