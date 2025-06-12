<div class="loader-wrap">
    <div class="preloader">
        <div class="preloader-close">x</div>
        <div id="handle-preloader" class="handle-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="o" class="letters-loading">o</span>
                    <span data-text-preloader="p" class="letters-loading">p</span>
                    <span data-text-preloader="t" class="letters-loading">t</span>
                    <span data-text-preloader="c" class="letters-loading">c</span>
                    <span data-text-preloader="a" class="letters-loading">a</span>
                    <span data-text-preloader="r" class="letters-loading">r</span>
                    <span data-text-preloader="e" class="letters-loading">e</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- preloader end -->

<!-- main header -->
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="auto-container">
            <div class="top-inner">
                <div class="left-column">
                    <ul class="info clearfix">
                        <li><i class="fas fa-envelope"></i> Email: <a href="mailto:sample@example.com">sample@example.com</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> 380 Albert St, Melborne</li>
                        <li><i class="fas fa-phone-alt"></i> Call: <a href="tel:123045615523">+1 (230)-456-155-23</a></li>
                    </ul>
                </div>
                <div class="right-column">
                    <div class="schedule">
                        @if(Session::has('customer_email'))
                            <span style="color: white; margin-right: 10px;"><i class="fas fa-user"></i> {{ Session::get('customer_email') }}</span>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="color: white; text-decoration: none;" onmouseover="this.style.color='#03c0b4'" onmouseout="this.style.color='white'">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="color: white; text-decoration: none;" onmouseover="this.style.color='#03c0b4'" onmouseout="this.style.color='white'">
                                <i class="fas fa-user"></i> Login
                            </a>
                        @endif
                    </div>
                    <ul class="social-links clearfix">
                        <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="index.html"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo-box pull-left">
                        <a href="index.html">
                            <img src="{{ asset('PublicArea/images/logo.png') }}" alt="Logo">
                        </a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="dropdown"><a href="index.html">Treatments</a>
                                    <ul>
                                        <li><a href="treatment.html">Treatment 1</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="index.html">Specialties & Services</a>
                                    <ul>
                                        <li class="dropdown"><a href="index.html">Treatments</a>
                                            <ul>
                                                <li><a href="team-2.html">Surgical Treatment</a></li>
                                                <li><a href="{{ route('public.non-surgical-treatments.all') }}">Non Surgical Treatment</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('Shop.all') }}{{ route('Shop.all') }}">Shop</a></li>
                                        <li><a href="{{ route('PublicAreaEyeIssues.all') }}">Eye Diseases</a></li>

                                        <li><a href="error.html">404</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('PublicAreDoctors.all') }}">Doctors</a></li>
                                <li><a href="{{ route('PublicAreaBlog.all') }}">Blog</a></li>
                                <li><a href="{{ route('aboutUs') }}">About</a></li>
                                <li><a href="{{ route('contactUs') }}">Contact</a></li>
                                <li><a href="{{ route('gallery.all') }}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="nav-right">
                    <div class="btn-box">
                        <a href="index.html" class="theme-btn btn-one">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box">
                <div class="logo-box">
                    <figure class="logo-box pull-left">
                        <a href="index.html">
                            <img src="{{ asset('PublicArea/images/logo.png') }}" alt="Logo">
                        </a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="nav-right">
                    <div class="btn-box">
                        <a href="index.html" class="theme-btn btn-one">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>
    <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"> <img src="{{ asset('PublicArea/images/logo-2.png') }}" alt="Logo"></a></div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Chicago 12, Melborne City, USA</li>
                <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                <li><a href="mailto:info@example.com">info@example.com</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->
