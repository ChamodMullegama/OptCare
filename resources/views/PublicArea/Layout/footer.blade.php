

<!-- main-footer -->
<footer class="main-footer p_relative">
    <div class="footer-top">
        <div class="auto-container">
            <div class="top-inner">
                <ul class="footer-menu">
                    <li><a href="#">Home</a></li>
                    <li><a href="{{ route('oct.uploadOctPublic') }}">Oct Analyzer</a></li>
                    <li><a href="{{ route('PublicAreDoctors.all') }}">Doctor</a></li>
                </ul>
                <div class="footer-logo">
                    <figure class="logo">
                        <a href="index.html">
                            <img src="{{ asset('PublicArea/images/footer-logo.png') }}" alt="">
                        </a>
                    </figure>
                </div>
                <ul class="footer-menu">
                    <li><a href="{{ route('PublicAreaBlog.all') }}">Blog</a></li>
                    <li><a href="{{ route('aboutUs') }}">About</a></li>
                    <li><a href="{{ route('contactUs') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="widget-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
           <div class="about-widget footer-widget mr_40">
    <div class="widget-title">
        <h3>About</h3>
    </div>
    <div class="widget-content">
        <p>OptCare is an AI-powered web application for analyzing OCT eye scans and identifying retinal diseases. It also provides vision health education to support early detection and patient awareness.</p>
        <ul class="social-links clearfix">
            <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
            <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
            <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
        </ul>
    </div>
</div>

                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="links-widget footer-widget ml_100">
                        <div class="widget-title">
                        <h3>Quick Links</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="index.html">Oct Analyzer</a></li>
                                <li><a href="{{ route('public.products.index') }}">Shop</a></li>
                                <li><a href="index.html">Doctors</a></li>
                                <li><a href="index.html">Blog</a></li>
                                <li><a href="index.html">About</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                    <div class="links-widget footer-widget ml_30">
                        <div class="widget-title">
                            <h3>Specialties</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('publicEyeInvestigations.all') }}">Eye Investigations</a></li>
                                <li><a href="{{ route('PublicAreaEyeIssues.all') }}">Eye Diseases</a></li>
                                <li><a href="{{ route('public.optic-centers.all') }}">Vision Centers</a></li>
                                <li><a href="{{ route('public.eye-hospitals.all') }}">Eye Hospital</a></li>
                                <li><a href="{{ route('public.surgical-treatments.all') }}">Surgical Treatment</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="contact-widget footer-widget ml_50">
                        <div class="widget-title">
                            <h3>Contacts</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="info clearfix">
                                <li>No. 120, Galle Road, Colombo 03, Sri Lanka</li>
                                <li><a href="tel:23055873407">(+94) 702 74 0542</a></li>
                                <li><a href="mailto:sample@example.com">optcare@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom centred">
        <div class="auto-container">
            <div class="copyright">
                <p><a href="index.html">Optcare</a> &copy; 2022 All Right Reserved</p>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->

<!-- scroll to top -->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fal fa-long-arrow-up"></i>
</button>
