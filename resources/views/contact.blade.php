@extends('layouts.app')
@section('content')

 <!--Page Title-->
 <section class="page-title">
    	<div class="auto-container">
        	<h2>Contact Us</h2>
            <ul class="page-breadcrumb">
            	<li><a href="{{route('home')}}">home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Contact Form Section -->
	<section class="contact-form-section">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h2>Get In Touch</h2>
				<div class="text">Do you have anything in your mind to let us know?  Kindly don't delay to connect to us by means of our contact form.</div>
			</div>
			
			<div class="row clearfix">
				
				<!-- Form Column -->
				<div class="form-column col-lg-7 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!-- Contact Form -->
						<div class="contact-form">
								
							<!--Contact Form-->
							<form method="post" action="#" id="contact-form">
								<div class="row clearfix">
									<div class="form-group col-lg-6 col-md-6 col-sm-12">
										<input type="text" name="username" placeholder="Your name" required>
									</div>
									
									<div class="form-group col-lg-6 col-md-6 col-sm-12">
										<input type="text" name="email" placeholder="Email address" required>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<input type="text" name="subject" placeholder="Subject" required>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
									
									<div class="form-group col-lg-12 col-md-12 col-sm-12">
										<button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Submit now</span></button>
									</div>
								</div>
							</form>
						</div>
						
					</div>
				</div>
				
				<!-- Info Column -->
				<div class="info-column col-lg-5 col-md-12 col-sm-12">
					<div class="inner-column">
						
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>Address :</strong><br>AgronoExport,Dar Es Salaam, 7544</li>
						</ul>
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>Phone : </strong><a href="tel:+255713 999 934">(255) 742 210 802</a></li>
							<li><strong>Email : </strong><a href="mailto:info@agronoexport.co.tz">info@agronoexport.co.tz</a></li>
						</ul>
						<!-- Contact Info List -->
						<ul class="contact-info-list">
							<li><strong>Opening Hours :</strong><br>8:00 AM – 10:00 PM <br> Monday – Sunday</li>
						</ul>
						
					</div>
				</div>
				
			</div>
			
		</div>
	</section>
	<!-- End Contact Form Section -->





@endsection