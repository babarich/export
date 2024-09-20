@extends('layouts.app')
@section('content')
<!--Page Title-->
<section class="page-title" style="background-image:url(images/background/5.jpg)">
    	<div class="auto-container">
        	<h2>About us</h2>
            <ul class="page-breadcrumb">
            	<li><a href="{{route('home')}}">home</a></li>
                <li>About us</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Story Section -->
	<section class="story-section">
		<div class="auto-container">
			<div class="row clearfix">
				
				<!-- Content Column -->
				<div class="content-column col-lg-8 col-md-12 col-sm-12">
					<div class="inner-column">
						<h2>Our Story In The Industry</h2>
						<div class="bold-text">we specialize in facilitating smooth and efficient international trade, connecting businesses around the globe with the products they need. With years of experience in the export-import industry, we take pride in delivering top-tier services that cater to various industries, ensuring timely and secure shipments.</div>
						<div class="text">
							<p>
                                We help businesses expand their markets by exporting high-quality products to international destinations. Our team manages the logistics,
                                 documentation, and compliance with local and international regulations to make the process seamless for you.
                            </p>
							<p>At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.</p>
						</div>
					</div>
				</div>
				
				<!-- Image Column -->
				<div class="image-column col-lg-4 col-md-12 col-sm-12">
					<div class="inner-column">
						<div class="image">
							<img src="{{asset('assets/images/main-slider/sustainable-agriculture.jpg')}}" alt="" />
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- End Story Section -->
	
	<!-- Interior Section -->
	<section class="interior-section style-three">
		<div class="auto-container">
			<div class="inner-container">
				<div class="row clearfix">
					
					<!-- Image Column -->
					<div class="image-column col-lg-4 col-md-12 col-sm-12">
						<div class="inner-column">
							<div class="image">
								<img src="{{asset('assets/images/main-slider/running.jpg')}}" alt="" />
							</div>
						</div>
					</div>
					
					<!-- Content Column -->
					<div class="content-column col-lg-8 col-md-12 col-sm-12">
						<div class="inner-column">
							<h2>Why Choose Us </h2>
							<div class="text">To give you a product/service that lasts, we bring you only the best in everything — quality raw materials, state-of-the-art manufacturing, rigorous quality checks, professional installations and transparent prices.</div>
							<div class="row clearfix">
							
								<!-- Interior Block -->
								<div class="interior-block col-lg-4 col-md-4 col-sm-12">
									<div class="block-inner">
										<div class="icon-box">
											<span class="icon flaticon-award-1"></span>
										</div>
										<h3>Superior Quality</h3>
									</div>
								</div>
								
								<!-- Interior Block -->
								<div class="interior-block col-lg-4 col-md-4 col-sm-12">
									<div class="block-inner">
										<div class="icon-box">
											<span class="icon flaticon-answer"></span>
										</div>
										<h3>Professional Team</h3>
									</div>
								</div>
								
								<!-- Interior Block -->
								<div class="interior-block col-lg-4 col-md-4 col-sm-12">
									<div class="block-inner">
										<div class="icon-box">
											<span class="icon flaticon-hand"></span>
										</div>
										<h3>Unmatched Warranty</h3>
									</div>
								</div>
								
							</div>
							
							<div class="bold-text">Get in touch with us to solve any challenge</div>
							<div class="column-text">Talk to our  expert and get your solution</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	<!-- End Interior Section -->
	
	








@endsection