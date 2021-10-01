<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$yourcity =array();
$aff_url = end($this->uri->segments); 
$yourcity = explode("-",$aff_url);
$yourcity = end($yourcity);
$uccity = ucfirst($yourcity);

// echo $uccity;
// exit();
if($uccity == "Enquiry" || $uccity == "Otp")
{
    $yourcity_id = 1;
    $yourcity = "coimbatore";

}else
{
    $this->db->select('*')->where('city_name =', $uccity);
    $this->db->from('cities');
    $yourcityarray = $this->db->get();
    foreach($yourcityarray->result() as $yourcitys)
    { 
    
        $yourcity_id = $yourcitys->id;
           //echo $areas->area_name;
           //exit();
    }
    

}






?>
 


 

	<!-- <div class="summercamp-popup wow bounceIn slower">
    	<a href="https://www.edugatein.com/list-of-best-cbse-schools-in-coimbatore">
    		<img src="https://www.edugatein.com/images/back-to-school.png" width="150" alt="summer-camp">
    	</a>
    </div> -->
    <!-- /summercamp-popup -->

    <div class="bgMotionEffects">
        <span class="fill1 shape"></span>
        <span class="fill2 shape"></span>
        <span class="fill3 shape"></span>
        <span class="fill4 shape"></span>
    </div>

    <style>
    	.summercamp-popup {
    		position: absolute;
    		right: 50px;
    		top: 130px;
			animation-delay: 2.5s;
			z-index: 1010;
			animation: blinker 1.8s linear infinite;
    	}
    	.summer-camp-section {
			padding: 80px 0 0 0;
			/*background-color: #f9f1dc;*/
			color: #404040;
		}
    	@keyframes blinker {
		    50% {
		        opacity: 0;
		    }
		}
		@media (min-width: 768px) and (max-width: 991px) {
	      	.summercamp-popup {
	        	right: 150px;
	        	top: 10px;
	      	}
	      	.summercamp-popup img {
        	width: 120px;
	      }
	    }
	    @media (min-width: 576px) and (max-width: 767px) {
	      	.summercamp-popup {
		        top: 10px;
		        right: 150px;
	      	}
	      	.summercamp-popup img {
	        	width: 100px;
	      	}
	    }
	    @media (min-width: 320px) and (max-width: 575px) {
	      	.summercamp-popup {
		        top: 10px;
		        right: 90px;
	      	}
	      	.summercamp-popup img {
	        	width: 100px;
	      	}
	      	.navbar-brand img {
				width: 150px;
			}
	    }
    </style>
	
    <!-- Header template -->
    <?php // $this->load->view('header'); ?>

	<div class="summer-camp-section" style="overflow: hidden;">
		<div class="container">
			<div class="section-title text-center mab-30">
				<h1 class="display-4 mb-2 ">ACTIVITY CLASSES</h1>
				<div class="line1"></div>
			</div><!-- /section-title -->

			<div class="summer-search-box text-center">
				<div class="row">
					<div class="col-lg-3"></div>

					<div class="col-lg-6">
						<form action="<?php echo base_url() ?>schools-list" method="get">
							<div class="input-group">
							  	<input type="text" class="form-control" name="search_class search_filter" id="search_class" placeholder="Search your activity classes..." aria-label="Recipient's username" aria-describedby="button-addon2">
							  	<input type="hidden" class="form-control" name="city" value="<?php echo $yourcity; ?>"  aria-label="Recipient's username" aria-describedby="button-addon2">
								  <div class="search-list"><ul id="suggesstion-box"></ul></div>
			
							  	<div class="input-group-append">
							    	<button class="btn btn-primary search_filter_button" type="submit" id="button-addon2">SEARCH</button>
							  	</div>
							</div><!-- /input-group -->
						</form>
					</div>

					<div class="col-lg-2">
						<div class="hss-activity-link pt-2 wow bounceIn faster">
							<a style="color:#0c0c0c;"href="<?php echo base_url(); ?>">
								<img src="<?php echo base_url(); ?>assets/front/images/school-camp.png" class="w-100" alt="best schools in <?php echo $city; ?>" />
							</a>
						</div>
					</div>
					<div class="col-lg-3"></div>
				</div><!-- /row -->
			</div><!-- /summer-search-box -->			
		</div><!-- /container -->

		<div class="container-fluid" style="padding: 50px;">
			<div class="row">
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInLeft" data-wow-delay="100ms">
					<a href="<?php echo base_url();?>list-of-best-dance-class-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/dance.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInLeft" data-wow-delay="200ms">
					<a href="<?php echo base_url();?>list-of-best-music-class-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/music.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInRight" data-wow-delay="300ms">
					<a href="<?php echo base_url();?>list-of-best-coaching-centres-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/coaching.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInRight" data-wow-delay="400ms">
					<a href="<?php echo base_url();?>list-of-best-fitness-centre-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/yoga.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="500ms">
					<a href="<?php echo base_url();?>list-of-best-martial-arts-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/karate.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="600ms">
					<a href="<?php echo base_url();?>list-of-best-school-kits-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/kits.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="700ms">
					<a href="<?php echo base_url();?>list-of-best-arts-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/drawing.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="800ms">
					<a href="<?php echo base_url();?>list-of-best-sports-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/badminton.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow fadeInUp" data-wow-delay="200ms">
					<a href="<?php echo base_url();?>list-of-best-coaching-centres-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/neet.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow fadeInUp" data-wow-delay="300ms">
					<a href="<?php echo base_url();?>list-of-best-coaching-centres-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/spoken-english.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="400ms">
					<a href="<?php echo base_url();?>list-of-best-sports-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/cricket.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow bounceIn" data-wow-delay="500ms">
					<a href="<?php echo base_url();?>list-of-best-sports-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/swimming.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInLeft" data-wow-delay="300ms">
					<a href="<?php echo base_url();?>list-of-best-sports-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/skating.png" class="w-100" alt="">
					</a>
				</div>
				<!-- <div class="col-lg-3 p-4 mab-30 wow slideInLeft" data-wow-delay="400ms">
					<a href="https://www.edugatein.com/list-of-best-sports-in-coimbatore">
						<img src="https://www.edugatein.com/images/summer-camp/tennis.png" class="w-100" alt="">
					</a>
				</div> -->
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInRight" data-wow-delay="500ms">
					<a href="<?php echo base_url();?>list-of-best-costume-designers-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/embroidery.png" class="w-100" alt="">
					</a>
				</div>
				<div class="col-lg-3 col-sm-4 p-4 mab-30 wow slideInRight" data-wow-delay="600ms">
					<a href="<?php echo base_url();?>list-of-best-coaching-centres-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/multimedia.png" class="w-100" alt="">
					</a>
				</div>
				<!-- <div class="col-lg-3"></div> -->
				<div class="col-lg-3 col-sm-4 p-4 wow bounceIn" data-wow-delay="700ms">
					<a href="<?php echo base_url();?>list-of-best-transports-in-<?php echo $yourcity ?>">
						<img src="https://www.edugatein.com/images/summer-camp/transport1.png" class="w-100" alt="">
					</a>
				</div>
				<!-- <div class="col-lg-3 p-4 wow bounceIn" data-wow-delay="800ms">
					<a href="https://www.edugatein.com/list-of-best-transports-in-coimbatore">
						<img src="https://www.edugatein.com/images/summer-camp/driving.png" class="w-100" alt="">
					</a>
				</div> -->
			</div><!-- /row -->
		</div><!-- /container-fluid -->
	</div><!-- /summer-camp-section -->

	<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background: transparent;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
	    <path d="M-5 100 Q 0 20 5 100 Z
	      	M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
	      	M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
	      	M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
	      	M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
	      	M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
	   	</path>
    </svg>

    <!-- Footer template -->
    <?php $this->load->view('footer'); ?>

	<!-- ============ Back-to-top ============ -->
	<div class="top-to-bottom">
		<a id="button">
	    	<i class="fa fa-chevron-up"></i>
	    </a>	
    </div><!-- /top-to-bottom -->
    
    <!-- Feedback-form -->
  	<div class="feedback-form shadow-lg">
		<div class="feedback-img">
			<img src="<?php echo base_url() ?>images/feed.png" class="toggle" alt="feedback">	
		</div>

 		<div class="feedback-head">
 			<div class="media mb-2">
 				<div class="media-left">
 					<img src="<?php echo base_url() ?>images/support.png" width="45px" alt="feedback">
 				</div>

 				<div class="media-body pl-3">
 					<h5 class="text-white">Need more help?</h5>
 					<small>Contact our support team!</small>
 				</div>
 			</div><!-- /media -->

 			<ul class="list-unstyled">
 				<li>Phone: <a href="tel:1800120235600" class="text-white">1800-120-235600</a></li>
 				<li>Email: <a href="mailto:support@edugatein.com" class="text-white">support@edugatein.com</a></li>
 			</ul>
 		</div><!-- /feedback-head -->

		<div class="feedback-body">
    		<h5 class="mb-3">Submit A Enquiry Form</h5>
	        <form  action="<?php echo base_url() ?>about-us/enquiry" method="post">
	        	<div class="form-group">
				    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your Name*"  required>
			  	</div>
			  	<div class="form-group">
				    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email*" required>
			  	</div>
			  	<div class="form-group">
				    <input type="text" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Mobile Number*" pattern="[6789][0-9]{9}" required>
			  	</div>

			  	<div class="form-group">
				    <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
			  	</div>
			  	<div class="form-group">
				    <select class="form-control" name="city" id="city" required>
				      <option value="" selected disabled>-- Select City --</option>
				      <option value="Coimbatore">Coimbatore</option>
				      <option value="Chennai">Chennai</option>
				      <option value="Bangalore">Bangalore</option>
				      <option value="Madurai">Madurai</option>
				      <option value="Tripur">Tripur</option>
				      <option value="Salem">Salem</option>
				    </select>
			  	</div>
			  	<div class="form-group">
				    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Your Comments"></textarea>
			  	</div>

			  	<!-- Button trigger modal -->
				<button type="submit" class="btn btn-primary btn-block mb-2" data-toggle="modal">Submit</button>
	        </form>
    	</div><!-- /feedback-body -->
 	</div><!-- /feedback-form -->
 	
<?php
$ip = $_SERVER['REMOTE_ADDR'];
//echo $ip;
?>

	<!-- OTP-Form -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  	<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
		      	<div class="modal-body p-5">
		      		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	        		
	        		<?php
	        		$ran = $random;

						$this->db->select('*')->where('random',$ran);
						$this->db->from('otp_tracker');
						$otp = $this->db->get();
					       
					       
					       foreach($otp->result() as $otps){
					           $mobile = $otps->mobile;
					           $mobile = substr($mobile, -4);
					?>
					        		
	        		
	        		
		      		<h3 class="modal-title mb-3" id="exampleModalCenterTitle">Enter One Time Password</h3>
		      		<p class="mb-2">One Time Password (OTP) has been sent to your mobile ******<?php echo $mobile; ?>, please enter the same here to login.</p>

					<form action="<?php echo base_url() ?>about-us/otp" method="post" class="mt-3">
						<div class="form-group">
						    <input type="text" class="form-control" name="otp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="OTP">
					  	</div>
					  	
					<div class="form-group">
					    <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
				  	</div>
					  	
				  	  	<button type="submit"  class="btn btn-primary btn-block">Submit</button>
					</form>
		      	</div><!-- /modal-body -->
	  		</div><!-- /modal-content -->
		</div>
	</div><!-- /modal -->
   	<?php } ?>

	<!-- Core JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://www.edugatein.com/js/popper.min.js"></script>
    <script src="https://www.edugatein.com/js/bootstrap.min.js"></script>

    <!-- Other JS -->
    <script src="https://www.edugatein.com/js/custom.js"></script>
    <script src="https://www.edugatein.com/js/owl.carousel.min.js"></script>
    <script src="https://www.edugatein.com/js/wow.min.js"></script>
    <script src="https://www.edugatein.com/js/jquery.easeScroll.js"></script>
    <script src="https://www.edugatein.com/js/parallax.min.js"></script>
    <script src="https://www.edugatein.com/js/jquery.fancybox.min.js"></script>
    <script src="https://www.edugatein.com/js/dashboard.js"></script>
    <script src="js/jquery.sticky-kit.min.js"></script>

    <script>
    	new WOW().init();
    </script>

	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/5bfe712579ed6453ccab8370/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
		})();

		//Move objects animation background
		var lFollowX = 0,
	        lFollowY = 0,
	        x = 0,
	        y = 0,
	        friction = 1 / 30;

		function moveBackground() {
		    x += (lFollowX - x) * friction;
		    y += (lFollowY - y) * friction;

		    translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

		    $('.fill1,.fill2,.fill3,.fill4,.image-box,.move-image').css({
		        '-webit-transform': translate,
		        '-moz-transform': translate,
		        'transform': translate
		    });

		    window.requestAnimationFrame(moveBackground);
		}

		$(window).on('mousemove click', function (e) {

		    var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
		    var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
		    lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
		    lFollowY = (10 * lMouseY) / 100;

		});

		moveBackground();
		$(document).ready(function(){
			$("#search_class").keyup(function(){
				$.ajax({
				type: "POST",
				url: "<?php echo base_url() ?>summercamp/search_activity_class",
				data:'keyword='+$(this).val(),
				beforeSend: function(){
					$("#search_class").css("background");
				},
				success: function(data){
					data = JSON.parse(data);
					var html = '';
					$.each(data, function(key,val) {
						html += '<li onClick="selectSchool(`'+val['institute_name']+'`)">'+val['institute_name']+'</li>';
					});
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(html);
					$("#search_class").css("background","#FFF");
				}
				});
			});
		});

		function selectSchool(val) {
			$("#search_class").val(val);
			$("#suggesstion-box").hide();
		}
		$('body').on('click','.search_filter_button',function(e){ 
			e.preventDefault(); 
			if($(this).closest('form').find('.search_filter').val() == ''){
				$(this).closest('form').find('.search_filter').css({'background':'red'});
					return 
				}else{
					$(this).closest('form').submit()
				}
		})
	</script>
	<!--End of Tawk.to Script-->
    
</body>
</html>