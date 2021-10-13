<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// echo $this->session->flashdata('school');
// exit();
$userid = base64_decode($_GET['id']);

	$this->db->select('*');
	$this->db->from('user_register');
	$this->db->where("id", $userid);
    $user = $this->db->get();

    foreach ($user->result() as $users) 
    {
        $username = $users->name;
        $userid = $users->id;
        $image = $users->image;
        $free_trial = $users->free_trial;
	}    

?>



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edugatein | Best Schools in Coimbatore</title>
    <link rel="shortcut icon" href="<?php echo base_url("assets/front/"); ?>images/favicon.ico">

    <!-- Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/front/"); ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/front/"); ?>css/responsive.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/front/"); ?>css/dashboard.css">
</head>
<body>
	<!-- <div class="dashboard-menu">
		<div class="container">
			<ul class="list-inline">
				<li class="list-inline-item noclick"><a href="<?php echo base_url(); ?>my-account/<?php echo $userid; ?>"><i class="lnr lnr-user"></i> My Account</a></li>
				<li class="list-inline-item noclick"><a href="<?php echo base_url(); ?>package" class="active"><i class="lnr lnr-gift"></i> Package Details</a></li>
				<li class="list-inline-item " ><a href="https://www.edugatein.com"><i class="lnr lnr-exit"></i> Logout</a></li>
			</ul>
		</div>
	</div> -->

	<div class="student-dashboard-body">
		<div class="container-fluid">
			<div class="row">
				

				<div class="col-lg-13 pl-4">
					<div class="row">
						<div class="col-lg-6">
							<div class="section-title mb-4">
								<h2 class="mb-2">Select Your Plan</h2>
							</div><!-- /section-title -->
						</div>						
					</div>
					<hr class="mab-30">
				
	
					<div class="package-tab-section">
						<style>
							strike {
								font-size: 20px;
								color: #d12882;
								font-weight: 400;
								opacity: .8;
							}
							.package-widget:hover strike {
								color: #fff;
							}
						</style>

						<div class="tab-content" id="myTabContent">
						  	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						  		<div class="row">
						  			<div class="col-lg-3">
						  				<p class="school-package">Activity Class Package</p>
						  				<div class="package-widget">
						  					<span class="package-info">Trial Package</span>
						  					<div class="package-head">
						  						<p class="lead">Trial</p>
						  					</div>
						  					<div class="price-box">
						  						<p class="price">&#8377;0.00</p>
						  						<span>10 Days + 20 Days</span>	
						  					</div>
						  					<div class="benefit-box">
						  						<span class="benefits">Benefits</span>
							  					<p><i class="fa fa-check"></i> Attractive mini website</p>
							  					<p><i class="fa fa-check"></i> Thumbnail Image</p>
							  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
							  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
							  					<p><i class="fa fa-check"></i> Link home website</p>
							  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
							  					<p><i class="fa fa-check"></i> Report Submission</p>	
						  					</div>
						  					<div class="text-center">
						  						<a href="<?php echo base_url(); ?>institute_trial/update_trial/<?php echo base64_encode($school_id); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
						  					</div>
                                            <?php if($free_trial == ""){ ?>

                                            <?php } ?>                                               

						  				</div>

						  				<div class="alert alert-success mat-30" role="alert">
										  	<p>Advertise on platinum package to get 3 times more than Regular  package.</p>
										</div>
						  			</div>

									  <div class="col-lg-3">
						  				<p class="school-package">Activity Class Package</p>
						  				<div class="package-widget">
						  					<span class="package-info">Regular Package</span>
						  					<div class="package-head">
						  						<p class="lead">Spectrum</p>
						  					</div>
						  					<div class="price-box">
						  						<p class="price"><strike>&#8377;15000</strike> &#8377;12,500</p>
						  						<span>90 Days + 10 Days</span>	
						  					</div>
						  					<div class="benefit-box">
						  						<span class="benefits">Benefits</span>
							  					<p><i class="fa fa-check"></i> Attractive mini website</p>
							  					<p><i class="fa fa-check"></i> Thumbnail Image</p>
							  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
							  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
							  					<p><i class="fa fa-check"></i> Link home website</p>
							  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
							  					<p><i class="fa fa-check"></i> Report Submission</p>	
						  					</div>
						  					<div class="text-center">
						  						<a href="<?php echo base_url(); ?>institute_listing_third/update_spectrum/<?php echo base64_encode($school_id); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
						  					</div>
                                            <?php if($free_trial == ""){ ?>

                                            <?php } ?>                                               

						  				</div>

						  				<div class="alert alert-success mat-30" role="alert">
										  	<p>Advertise on platinum package to get 3 times more than Regular  package.</p>
										</div>
						  			</div>

						  			<div class="col-lg-3">
						  				<p class="school-package">Activity Class Package</p>
						  				<div class="package-widget">
						  					<span class="package-info package-info1">Recommend</span>
						  					<div class="package-head">
						  						<p class="lead">Premium</p>
						  					</div>
						  					<div class="price-box">
						  						<p class="price">&#8377;30,000</p>
						  						<span>90 Days + 10 Days</span>	
						  					</div>
						  					<div class="benefit-box">
						  						<span class="benefits">Benefits</span>
							  					<p><i class="fa fa-check"></i> Attractive mini website</p>
							  					<p><i class="fa fa-check"></i> Highly Visual Thumbnail Image</p>
							  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
							  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
							  					<p><i class="fa fa-check"></i> Offers and special addition in gallery</p>
							  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
							  					<p><i class="fa fa-check"></i> Report Submission</p>	
							  					<p><i class="fa fa-check"></i> City Mailer</p>
							  					<p><i class="fa fa-check"></i> Link home website</p>
						  					</div>
						  					<div class="text-center mb-3">
						  						<a href="<?php echo base_url(); ?>institute_listing_second/update_premium/<?php echo base64_encode($school_id); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
						  					</div>
						  				</div>

										<div class="alert alert-success mat-30" role="alert">
										  	<p>Advertise on premium package to get 2 times more than Regular  package.</p>
										</div>
						  			</div>

						  			<div class="col-lg-3">
						  				<p class="school-package">Activity Class Package</p>
						  				<div class="package-widget">
						  					<span class="package-info package-info2">Highly Recommend</span>
						  					<div class="package-head">
						  						<p class="lead">Platinum</p>
						  					</div>
						  					<div class="price-box">
						  						<p class="price">&#8377;65,000</p>
						  						<span>90 Days + 10 Days</span>	
						  					</div>
						  					<div class="benefit-box">
						  						<span class="benefits">Benefits</span>
							  					<p><i class="fa fa-check"></i> Attractive mini website</p>
							  					<p><i class="fa fa-check"></i> Highly Visual banner</p>
							  					<p><i class="fa fa-check"></i> Leader in city page</p>
							  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
							  					<p><i class="fa fa-check"></i> City mailer</p>
							  					<p><i class="fa fa-check"></i> Link home website</p>
							  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>	
							  					<p><i class="fa fa-check"></i> Can place school images</p>
							  					<p><i class="fa fa-check"></i> Display attractive extra curricular</p>
							  					<p><i class="fa fa-check"></i> Search related advertisement</p>
							  					<p><i class="fa fa-check"></i> Partner site banner impressions</p>
							  					<p><i class="fa fa-check"></i> Report submission</p>
						  					</div>
						  					<div class="text-center">
						  						<a href="<?php echo base_url(); ?>institute_listing_first/update_platinum/<?php echo base64_encode($school_id); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
						  					</div>
						  				</div>

						  				<div class="alert alert-success mat-30" role="alert">
										  	<p>Advertise on platinum package to get 3 times more than Regular package.</p>
										</div>
						  			</div>
						  		</div><!-- /row -->
						  	</div>
						</div><!-- /tab-content -->
					</div><!-- /package-tab-section -->

				</div><!-- /col-lg-9 -->
			</div><!-- /row -->
		</div><!-- /container-fluid -->
	</div><!-- /student-dashboard-body -->

	<!-- <div class="dashboard-content">
		<div class="container">
			<div class="section-title text-center mab-50">
				<h1 class="mb-2">Package Details</h1>
				<p>In order to access some features of the service, you will <br> have to fill out your account details.</p>
			</div>

			<div class="package-tab-section">
				<ul class="nav nav-tabs justify-content-center mab-50" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ADD SCHOOL</a>
				  	</li>
				  	<li class="nav-item">
				    	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ACTIVITY CLASS</a>
				  	</li>
				</ul>

				<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				  		<div class="row">
				  			<div class="col-lg-4">
				  				<p class="school-package">School Package</p>
				  				<div class="package-widget">
				  					<span class="package-info">Regular Package</span>
				  					<div class="package-head">
				  						<p class="lead">Spectrum</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;10,000</p>
				  						<span>90 Days + 10 Days</span>	
				  					</div>
				  					<div class="benefit-box">
				  						<span class="benefits">Benefits</span>
					  					<p><i class="fa fa-check"></i> Attractive mini website</p>
					  					<p><i class="fa fa-check"></i> Thumbnail Image</p>
					  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
					  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
					  					<p><i class="fa fa-check"></i> Link home website</p>
					  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
					  					<p><i class="fa fa-check"></i> Report Submission</p>	
				  					</div>
				  					<div class="text-center">
				  						<a href="<?php echo base_url(); ?>schoolthird?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
				  					</div>
				  					<p class="text-center mt-2"><a href="<?php echo base_url(); ?>school-free-trail?id=<?php echo base64_encode($userid); ?>"><u>Free Trial for 5 days</u></a></p>
				  				</div>

				  				<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on platinum package to get 3 times more than Regular package.</p>
								</div>
				  			</div>

				  			<div class="col-lg-4">
				  				<p class="school-package">School Package</p>
				  				<div class="package-widget">
				  					<span class="package-info package-info1">Recommend</span>
				  					<div class="package-head">
				  						<p class="lead">Premium</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;25,000</p>
				  						<span>90 Days + 10 Days</span>	
				  					</div>
				  					<div class="benefit-box">
				  						<span class="benefits">Benefits</span>
					  					<p><i class="fa fa-check"></i> Attractive mini website</p>
					  					<p><i class="fa fa-check"></i> Highly Visual Thumbnail Image</p>
					  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
					  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
					  					<p><i class="fa fa-check"></i> Offers and special addition in gallery</p>
					  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
					  					<p><i class="fa fa-check"></i> Report Submission</p>	
					  					<p><i class="fa fa-check"></i> City Mailer</p>
					  					<p><i class="fa fa-check"></i> Link home website</p>
					  					<p><i class="fa fa-check"></i> Add Social Links</p>
				  					</div>
				  					<div class="text-center mb-3">
				  						<a href="<?php echo base_url(); ?>schoolsecond?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
				  					</div>
				  				</div>

								<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on premium package to get 2 times more than Regular  package.</p>
								</div>
				  			</div>

				  			<div class="col-lg-4">
				  				<p class="school-package">School Package</p>
				  				<div class="package-widget">
				  					<span class="package-info package-info2">Highly Recommend</span>
				  					<div class="package-head">
				  						<p class="lead">Platinum</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;50,000</p>
				  						<span>90 Days + 10 Days</span>	
									</div>
									<div class="benefit-box">
										<span class="benefits">Benefits</span>
										<p><i class="fa fa-check"></i> Attractive mini website</p>
										<p><i class="fa fa-check"></i> Highly Visual banner</p>
										<p><i class="fa fa-check"></i> Leader in city page</p>
										<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
										<p><i class="fa fa-check"></i> City mailer</p>
										<p><i class="fa fa-check"></i> Link home website</p>
										<p><i class="fa fa-check"></i> Anytime modify gallery</p>	
										<p><i class="fa fa-check"></i> Can place school images</p>
										<p><i class="fa fa-check"></i> Display attractive extra curricular</p>
										<p><i class="fa fa-check"></i> Search related advertisement</p>
										<p><i class="fa fa-check"></i> Partner site banner impressions</p>
										<p><i class="fa fa-check"></i> Report submission</p>
										<p><i class="fa fa-check"></i> Map View Location</p>
										<p><i class="fa fa-check"></i> New Offers Advertisement</p>
									</div>
									<div class="text-center">
										<a href="<?php echo base_url(); ?>schoolfirst?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
									</div>
								</div>

				  				<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on platinum package to get 3 times more than Regular  package.</p>
								</div>
				  			</div>
				  		</div>
				  	</div>

				  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				  		<div class="row">
				  			<div class="col-lg-4">
				  				<p class="school-package">Activity Class Package</p>
				  				<div class="package-widget">
				  					<span class="package-info">Regular Package</span>
				  					<div class="package-head">
				  						<p class="lead">Spectrum</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;10,000</p>
				  						<span>90 Days + 10 Days</span>	
				  					</div>
				  					<div class="benefit-box">
				  						<span class="benefits">Benefits</span>
					  					<p><i class="fa fa-check"></i> Attractive mini website</p>
					  					<p><i class="fa fa-check"></i> Thumbnail Image</p>
					  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
					  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
					  					<p><i class="fa fa-check"></i> Link home website</p>
					  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
					  					<p><i class="fa fa-check"></i> Report Submission</p>	
				  					</div>
				  					<div class="text-center">
				  						<a href="<?php echo base_url(); ?>institutethird?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
				  					</div>
				  					<p class="text-center mt-2"><a href="<?php echo base_url(); ?>institute-free-trail?id=<?php echo base64_encode($userid); ?>"><u>Free Trial for 5 days</u></a></p>
				  				</div>

				  				<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on platinum package to get 3 times more than Regular  package.</p>
								</div>
				  			</div>

				  			<div class="col-lg-4">
				  				<p class="school-package">Activity Class Package</p>
				  				<div class="package-widget">
				  					<span class="package-info package-info1">Recommend</span>
				  					<div class="package-head">
				  						<p class="lead">Premium</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;25,000</p>
				  						<span>90 Days + 10 Days</span>	
				  					</div>
				  					<div class="benefit-box">
				  						<span class="benefits">Benefits</span>
					  					<p><i class="fa fa-check"></i> Attractive mini website</p>
					  					<p><i class="fa fa-check"></i> Highly Visual Thumbnail Image</p>
					  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
					  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>
					  					<p><i class="fa fa-check"></i> Offers and special addition in gallery</p>
					  					<p><i class="fa fa-check"></i> Search Related Advertisement</p>
					  					<p><i class="fa fa-check"></i> Report Submission</p>	
					  					<p><i class="fa fa-check"></i> City Mailer</p>
					  					<p><i class="fa fa-check"></i> Link home website</p>
				  					</div>
				  					<div class="text-center mb-3">
				  						<a href="<?php echo base_url(); ?>institutesecond?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
				  					</div>
				  				</div>

								<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on premium package to get 2 times more than Regular  package.</p>
								</div>
				  			</div>

				  			<div class="col-lg-4">
				  				<p class="school-package">Activity Class Package</p>
				  				<div class="package-widget">
				  					<span class="package-info package-info2">Highly Recommend</span>
				  					<div class="package-head">
				  						<p class="lead">Platinum</p>
				  					</div>
				  					<div class="price-box">
				  						<p class="price">&#8377;50,000</p>
				  						<span>90 Days + 10 Days</span>	
				  					</div>
				  					<div class="benefit-box">
				  						<span class="benefits">Benefits</span>
					  					<p><i class="fa fa-check"></i> Attractive mini website</p>
					  					<p><i class="fa fa-check"></i> Highly Visual banner</p>
					  					<p><i class="fa fa-check"></i> Leader in city page</p>
					  					<p><i class="fa fa-check"></i> Highly impressive to viewers</p>
					  					<p><i class="fa fa-check"></i> City mailer</p>
					  					<p><i class="fa fa-check"></i> Link home website</p>
					  					<p><i class="fa fa-check"></i> Anytime modify gallery</p>	
					  					<p><i class="fa fa-check"></i> Can place school images</p>
					  					<p><i class="fa fa-check"></i> Display attractive extra curricular</p>
					  					<p><i class="fa fa-check"></i> Search related advertisement</p>
					  					<p><i class="fa fa-check"></i> Partner site banner impressions</p>
					  					<p><i class="fa fa-check"></i> Report submission</p>
				  					</div>
				  					<div class="text-center">
				  						<a href="<?php echo base_url(); ?>institutefirst?id=<?php echo base64_encode($userid); ?>" class="btn btn-primary btn-plan">Select Plan</a>	
				  					</div>
				  				</div>

				  				<div class="alert alert-success mat-30" role="alert">
								  	<p>Advertise on platinum package to get 3 times more than Regular package.</p>
								</div>
				  			</div>
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
	</div> -->

	<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #f4f6f8;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
       	</path>
    </svg>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Subscribe Newsletter</h4>
			            <small>We will send updates once a week.</small>
		          	</div><!-- /footer-heading -->

		          	<form action="<?php echo base_url(); ?>abouts/newsletter" class="form-inline" method="post">
		              	<div class="input-group w-100">
		                	<input type="email" name="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter your email*" required>
		                	<div class="input-group-prepend">
		                    	<div class="input-group-text">
		                  			<button type="submit" class="fa fa-send-o"></button>
		                  		</div><!-- /input-group-text -->
		                	</div><!-- /input-group-prepend -->
		              	</div><!-- /input-group -->
		          	</form><!-- /Newsletter -->
				</div>

				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Edugatein</h4>
			            <small>We make your school in 1st Place...</small>
		          	</div><!-- /footer-heading -->

		          	<ul class="social-icons list-unstyled list-inline"> 
				      	<li><a href="https://www.facebook.com/edugatein" target="_blank"><i class="fa fa-facebook"></i></a></li> 
				      	<li><a href="https://twitter.com/edugatein" target="_blank"><i class="fa fa-twitter"></i></a></li>
				      	<li><a href="https://www.linkedin.com/company/edugatein/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				      	<li><a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
				      	<li><a href="https://www.instagram.com/edugatein/" target="_blank"><i class="fa fa-instagram"></i></a></li>
				  	</ul>
				</div>

				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Help Center</h4>
		          	</div><!-- /footer-heading -->

		          	<ul class="list-unstyled help-center">
			            <li><i class="fa fa-fw fa-envelope"></i> <a href="mailto:support@edugatein.com">support@edugatein.com</a></li>
			            <li><i class="fa fa-fw fa-phone"></i> <a href="tel:1800120235600">1800-120-235600</a></li>
		          	</ul>
				</div>
			</div><!-- /row -->

			<hr style="border-color: #fff;opacity: .1;">

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<p>&copy; 2019 <b>Edugatein.</b> All Rights Reserved.</p>
						</div>

						<div class="col-lg-6 col-sm-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></li>
								<li class="list-inline-item"><a href="<?php echo base_url(); ?>terms-and-conditions">Terms & Conditions</a></li>
							</ul>
						</div>
					</div><!-- /row -->
				</div><!-- /contaienr -->
			</div><!-- /copytight -->
		</div><!-- /container -->
	</footer>

    <!-- Core JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("assets/front/"); ?>js/dashboard.js"></script>
    <script src="<?php echo base_url("assets/front/"); ?>js/jquery.stickit.js"></script>

    <script>
    $('a.logout').click(function(){
        return confirm('Are you sure want to logout....!!!')
    })
    </script>
    
	<style>
		.noclick  {
		  	pointer-events: none;
		}
	</style>
 
</body>
</html>