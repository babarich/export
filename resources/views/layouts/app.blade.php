<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'AgriKonneckt') }}</title>
    <meta name="Description" content="AgriKonneckt">
    <meta name="Author" content="">

@include('components.header')
@vite(['resources/js/app.js'])
</head>


<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>

    @include('components.head')
 
    <main>
    @yield('content')

    <!-- Call To Action Section -->
	<section class="call-to-action-section" style="background-image: url(images/background/1.jpg); margin-top:40px">
		<div class="auto-container">
			<h2>Think trading. Think AgronoExport </h2>
			<div class="text">We source products globally to meet your business needs. 
                Whether it’s raw materials, machinery, or finished goods, 
                we ensure that you receive high-quality products, on time, and at competitive prices.<br>We connect businesses from one place to another.</div>
			<a href="contact.html" class="theme-btn btn-style-two"><span class="txt">contact us</span></a>
		</div>
	</section>
	<!-- End Call To Action Section -->
    </main>



	<!--Main Footer-->
    <footer class="main-footer">
		<div class="auto-container">
        	<!--Widgets Section-->
            <div class="widgets-section">
            	<div class="row clearfix">
                	
                    <!--big column-->
                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">
                        
                            <!--Footer Column-->
                            <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                <div class="footer-widget logo-widget">
									<div class="logo">
                                    	<a href="{{route('home')}}"><img src="{{asset('assets/images/logo.svg')}}" alt="" /></a>
                                    </div>
                                    <div class="text">An import and export company based on helping customers trade by exporting goods to destiantion and importing also to required destination.</div>
                                    <ul class="social-icons">
                                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                                    </ul>
								</div>
							</div>
							
							<!--Footer Column-->
                            <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                	<h2>Quick links</h2>
									<div class="widget-content">
										<ul class="list">
                                        	<li><a href="{{route('about')}}">About</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Terms & Conditions</a></li>
                                            <li><a href="#">Faq</a></li>
                                        </ul>
                                    </div>
								</div>
							</div>
						
						</div>
					</div>
					
					<!--big column-->
                    <div class="big-column col-lg-6 col-md-12 col-sm-12">
                        <div class="row clearfix">
                        
                            <!--Footer Column-->
                            <div class="footer-column col-lg-5 col-md-6 col-sm-12">
                                <div class="footer-widget contact-widget">
									<h2>Contact Info</h2>
									<div class="widget-content">
										<a href="tel:+255 713 999 934" class="contact-number">(255) 742 999 9347</a>
										<ul>
											<li>AgronoExport Dar Es Salaam, 7544</li>
											<li>Email :<a href="mailto:info@stellaorre.com">  info@agornoexport.co.tz</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<!--Footer Column-->
                            <div class="footer-column col-lg-7 col-md-6 col-sm-12">
                                <div class="footer-widget newsletter-widget">
                                	<h2>Newsletter</h2>
									<div class="text">Get Special offers & Discounts</div>
									<!-- Newsletter Form -->
									<div class="newsletter-form">
										<form method="post" action="templateshub.net">
											<div class="form-group">
												<input type="email" name="email" value="" placeholder="Enter your email address" required>
												<button type="submit" class="theme-btn btn-style-one"><span class="txt">Subscribe</span></button>
											</div>
										</form>
									</div>
								</div>
							</div>
						
						</div>
					</div>
					
				</div>
			</div>
		
			
		</div>
	</footer>
	
</div>  
<!--End pagewrapper-->


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

@include('components.footer')
@yield('scripts')
<script>
    $(document).ready(function (){
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif

   
    });
</script>
</body>

</html>
