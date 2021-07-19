<?php
//$yourcity =array();
//$aff_url = end($this->uri->segments); 
//$yourcity = explode("-",$aff_url);
//$yourcity = end($yourcity);
//$uccity = ucfirst($yourcity);
//
//// echo $uccity;
//// exit();
//if($uccity == "Enquiry" || $uccity == "Otp")
//{
//    $yourcity_id = 1;
//    $yourcity = "coimbatore";
//
//}else
//{
//    $this->db->select('*')->where('city_name =', $uccity);
//    $this->db->from('cities');
//    $yourcityarray = $this->db->get();
//    foreach($yourcityarray->result() as $yourcitys)
//    { 
//    
//        $yourcity_id = $yourcitys->id;
//           //echo $areas->area_name;
//           //exit();
//    }
//    
//
//}
//
//// echo $yourcity_id;
//// exit();
//
//$this->db->select('*')->where('is_active =', 1);
//$this->db->from('cities');
//$city = $this->db->get();
//foreach($city->result() as $cities){ 
//    //    echo $cities->city_name;
//
//       $urlcity = strtolower($cities->city_name);
//       
//       $aff_url = str_replace("-schools-in-".$urlcity,"",$aff_url);
//       $aff_url = str_replace("-in-".$urlcity,"",$aff_url);
//}
//
//$ipaddress = '';
//if (isset($_SERVER['HTTP_CLIENT_IP']))
//$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_X_FORWARDED']))
//$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
//$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//else if(isset($_SERVER['HTTP_FORWARDED']))
//$ipaddress = $_SERVER['HTTP_FORWARDED'];
//else if(isset($_SERVER['REMOTE_ADDR']))
//$ipaddress = $_SERVER['REMOTE_ADDR'];
//else
//$ipaddress = 'UNKNOWN';
?>
<style>
    @media (min-width: 360px) and (max-width: 767px) {
        .breadrumb-new {
            position: relative;
            /*margin-top: 115px;*/
        }
        .breadrumb-new .container-fluid {
            padding: 0 15px!important;
        }
    }
    .career-section .modal-body {
        padding: 25px;
        text-transform: uppercase;
    }
    .upload {
        text-transform: none;
        color: #303030;
        font-weight: 600;
        margin-bottom: 10px;
        margin-left: 5px;
        margin-top: 15px;
    }
    .career-section .form-control {
        font-size: 14px;
        color: #7d7d7d;
        border-color: #ddd;
    }
    .career-section ::placeholder {
        font-size: 12px;
        color: #aaa;
    }
    .career-section .close {
        position: absolute;
        width: 25px;
        height: 25px;
        line-height: 25px;
        top: -10px;
        right: -10px;
        background: #000;
        color: #fff;
        z-index: 1000;
        opacity: 1;
        border-radius: 50px;
        font-size: 14px;
    }
    .career-section .close:hover span {
        opacity: 1;
        text-shadow: 0;
        color: #fff;
    }
    .career-section .btn-primary {
        border-radius: 50px;
        background-color: #007bff;
        border-color: #007bff;
        padding: 8px 30px;
        color: #fff;
        text-transform: uppercase;
    }
</style>

<div class="social-sidebar">
    <ul class="list-unstyled">
        <li><a href="https://www.facebook.com/edugatein" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/edugatein" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <li><a href="https://www.instagram.com/edugatein/" target="_blank"><i class="fa fa-instagram"></i></a></li>
        <li><a href="https://www.linkedin.com/company/edugatein/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="https://api.whatsapp.com/send?phone=919952610393&text=&source=&data=" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
        <li><a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
    </ul>
</div><!-- /social-sidebar -->
<!-- Header template -->
<?php
$this->db->select('*')->where('is_active =', 1);
$this->db->from('affiliations');
$query = $this->db->get();
?>
<div class="breadrumb-new mab-50">
    <div class="container-fluid" style="padding: 0 60px;">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.edugatein.com/">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item">Exam & Results</li>

                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /bread-crumb -->

<!-- google adsense -->
<!-- <div align="center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-4740793344625684"
     data-ad-slot="4908920712"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> -->
<!-- google adsense -->

<div class="sidebar-section">
    <div class="container-fluid" style="padding: 0 100px;">
        <div class="sidebar">
            <div id="sticky">
                <div class="sidebar-categories">
                    <ul class="list-unstyled">
                        <li class="lead">School Categories</li>
                        <?php
                        foreach ($query->result() as $row) {
                            $affiliation_name1 = ucwords($row->affiliation_name);
                            $affiliation_name = str_replace(" ", "-", $row->affiliation_name);
                            if ($affiliation_name === "stateboard-schools") {
                                $affiliation_name = "state-board-schools";
                            }
                            ?>
                            <li>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore" id="<?php echo $row->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $affiliation_name1; ?> Schools</a>
                            </li>
                        <?php } ?>
                        <!-- /School Categories -->

                        <li class="lead lead1 mt-3">Activity Classes</li>
                        <?php
                        $activity = $this->db->get('institute_categories');
                        foreach ($activity->result() as $row1) {
                            $category_name1 = ucwords($row1->category_name);
                            $category_name = str_replace(" ", "-", $row1->category_name);
                            $category_name = strtolower($category_name);
                            ?>
                            <li>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-coimbatore" id="<?php echo $row1->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $category_name1; ?></a>
                            </li>
                        <?php } // $aff_name = ucwords($affiliations->affiliation_name);  ?>
                    </ul>
                </div><!-- /sidebar-categories -->
            </div><!-- /sticky -->
        </div><!-- /sidebar -->

        <style>
            .categories {
                background-color: #f2f2f2;
                border-radius: 8px;
                border: 2px solid #eaeaea;
                padding: 25px;
                font-family: 'Rubik',sans-serif;
            }
            .categories .lead,
            .categories .lead1 {
                background-color: #33317c;
                color: #fff;
                border-radius: 50px;
                padding: 0 10px;
                font-weight: normal;
                margin-bottom: 10px;
            }
            .categories .lead1 {
                background-color: #d12881!important;
            }
            .categories ul li {
                line-height: 28px;
                font-weight: 500;
            }
            .categories li a {
                color: #606060;
                transition: .2s all;
                text-decoration: none;
                font-size: 16px;
            }
            .categories li a:hover {
                color: #d12881;
            }
            .categories hr {
                margin-top: 5px;
                margin-bottom: 10px;
                border-color: #eaeaea;
            }
            .result-widget {
                border-radius: 3px;
                padding: 15px 0px;
                border-bottom: 1px solid #dee2e6!important;
            }
            .result-widget:last-child {
                border-bottom: 0px!important;
            }
            .result-widget a {
                color: #303030;
                font-weight: 500;
            }
            .result-widget a:hover {
                color: #d12881;
            }
            .result-widget span {
                font-weight: 14px;
                padding: 3px 6px;
                color: #fff;
                font-size: 12px;
                border-radius: 4px;
            }
        </style>

        <div id="main" class="mab-50">
            <div class="row">
                <div class="col-lg-9">
                    <div class="section-title mab-30">
                        <h2>Exam & Results</h2>
                        <div class="line"></div>
                    </div><!-- /section-title -->

                    <?php
                    $this->db->select('*')->where("deleted_at", NULL);
                    $this->db->from('results');
                    $this->db->order_by("created_at", "desc");
                    $results = $this->db->get();
                    foreach ($results->result() as $resultss) {
                        $date = date('d-M-Y', strtotime($resultss->created_at));


                        $slug_name = str_replace(" ", "-", $resultss->slug);
                        $slug_name1 = str_replace("?", "..", $slug_name);
                        $slug_name2 = str_replace("'", "_", $slug_name1);
                        ?>
                        <div class="result-widget mb-2">
                            <p class="lead mb-1"><a href="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online/<?php echo $slug_name2 ?>"><?php echo $resultss->name ?></a> &nbsp;<span class="bg-info"><?php echo $date; ?></span></p>
                        </div><!-- /result-widget -->
                        <?php
                    }
                    ?>

                </div>

                <!-- <div class="col-lg-3">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-4740793344625684"
        data-ad-slot="6699201454"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
</script>

                </div> -->
            </div><!-- /row -->
            <!-- google adsense -->

            <!-- <div align="center" class="mt-5">          
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4740793344625684"
                    data-ad-slot="4908920712"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div> -->


        </div><!-- /#main -->



    </div><!-- /container-fluid -->

</div><!-- /sidebar-section -->



<div class="add-section" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mab-30">
                <div class="section-title">
                    <h2 class="mb-2 wow fadeInLeft" data-wow-delay="500ms">Let's Get Started with<br>Our Platform</h2>
                    <div class="line wow fadeInLeft" data-wow-delay="600ms"></div>

                    <div class="platform mat-30 wow fadeInLeft" data-wow-delay="900ms">
                        <span>CBSE curriculum is growing forward based on application skills, they study concept and methodology in syllabus. This helps to students apply those concepts in various contexts. Other than all India board exam, the cbse required basic general knowledge for moving to forward in education. The main <h3>benefit of cbse board</h3> is to transferrable working parents across India and easy facing of competitive exams.</span>
                        <br><br>

                        <span>While choosing the <h3>best CBSE School</h3> is not taken an easy. Parent’s way of thinking is different such as faculty, sports and co-curricular activities and value for money. CBSE would be better choice for long term development.</span>
                    </div>
                </div>
                <a href="<?php echo base_url("contact-us"); ?>" class="btn btn-primary1 mt-4 wow bounceIn" data-wow-delay="800ms">Contact Now</a>
            </div>
            <div class="col-lg-5 mab-30">
                <img src="<?php echo base_url("assets/front/images/right1.png"); ?>" class="w-100 wow flipInY" data-wow-delay="500ms" alt="add">
            </div>
        </div>
    </div><!-- /container -->
</div><!-- /add-section -->


<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #f4f4f4;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
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
        <img src="<?php echo base_url("assets/front/images/feed.png"); ?>" class="toggle" alt="feedback">	
    </div>

    <div class="feedback-head">
        <div class="media mb-2">
            <div class="media-left">
                <img src="<?php echo base_url("assets/front/images/support.png"); ?>" width="45px" alt="feedback">
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
                    <?php
                    $this->db->select('*')->where('is_active =', 1);
                    $this->db->from('cities');
                    $city = $this->db->get();
                    foreach ($city->result() as $cities) {
                        ?>
                        <option value="<?php echo $cities->city_name; ?>"><?php echo $cities->city_name; ?></option>

                        <?php
                    }
                    ?>
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

                $this->db->select('*')->where('random', $ran);
                $this->db->from('otp_tracker');
                $otp = $this->db->get();


                foreach ($otp->result() as $otps) {
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


<script>
     $(window).on("load", function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });

            var str = window.location.pathname;

            if (str == "/results/enquiry") {
                $('#exampleModalCenter').modal('show');
            }
        });
    $(document).ready(function () {
       
        $(".owl-carousel").owlCarousel();
    });

    new WOW().init();

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    $(document).ready(function () {
        // Back-to-top
        var btt = $('.back-to-top');

        btt.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });

        $(window).on('scroll', function () {
            var self = $(this),
                    height = self.height(),
                    top = self.scrollTop();

            if (top > height) {
                if (!btt.is(':visible')) {
                    btt.show();
                }
            } else {
                btt.hide();
            }
        });
    });


    $(document).ready(function (e) {
        $('#btnModal').click(function () {
            //Using ajax post
            $.post('otp.php', function (xx) {
                $('#tmpModal').php(xx)
                //Calling Modal
                $('#testModal').otp('show');
            })
        })
    });
</script>
<script>
    $(function () { //document ready
        if ($('#sticky').length) { //make sure "#sticky" elements exists
            var el = $('#sticky');
            var stickyTop = $('#sticky').offset().top; //returns number
            var stickyHeight = $('#sticky').height();

            $(window).scroll(function () { //Scroll event
                var limit = $('#footer').offset().top - stickyHeight - 60;

                var windowTop = $(window).scrollTop(); //returns number

                if (stickyTop < windowTop) {
                    el.css({
                        position: 'fixed',
                        top: 0,
                        bottom: '50px'
                    });
                } else {
                    el.css('position', 'static');
                }

                if (limit < windowTop) {
                    var diff = limit - windowTop;
                    el.css({
                        top: diff
                    });
                }
            });
        }
    });
</script>