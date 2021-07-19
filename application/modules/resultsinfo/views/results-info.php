<?php
$yourcity = array();
$aff_url = end($this->uri->segments);
$yourcity = explode("-", $aff_url);
$yourcity = end($yourcity);
$uccity = ucfirst($yourcity);

// echo $uccity;
// exit();
if ($uccity == "Enquiry" || $uccity == "Otp") {
    $yourcity_id = 1;
    $yourcity = "coimbatore";
} else {
    $this->db->select('*')->where('city_name =', $uccity);
    $this->db->from('cities');
    $yourcityarray = $this->db->get();
    foreach ($yourcityarray->result() as $yourcitys) {

        $yourcity_id = $yourcitys->id;
        //echo $areas->area_name;
        //exit();
    }
}

// echo $yourcity_id;
// exit();

$this->db->select('*')->where('is_active =', 1);
$this->db->from('cities');
$city = $this->db->get();
foreach ($city->result() as $cities) {
    //    echo $cities->city_name;

    $urlcity = strtolower($cities->city_name);

    $aff_url = str_replace("-schools-in-" . $urlcity, "", $aff_url);
    $aff_url = str_replace("-in-" . $urlcity, "", $aff_url);
}


$ipaddress = '';
if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
else if (isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
else if (isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
else if (isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
else
    $ipaddress = 'UNKNOWN';
?>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2"></script>
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
</style> 

<!-- Header template -->
<?php
$this->db->select('*')->where('is_active =', 1);
$this->db->from('affiliations');
$query = $this->db->get();

$aff_url = end($this->uri->segments);
$aff_url = str_replace("-", " ", $aff_url);
$aff_url = str_replace("..", "?", $aff_url);
$aff_url = str_replace("_", "'", $aff_url);
$uri_name = end($this->uri->segments);

$this->db->select('id')->where('slug =', $aff_url);
$this->db->from('results');
$slugs = $this->db->get();
foreach ($slugs->result() as $slugss) {
    $result_id = $slugss->id;

    //print_r($schooldets);
    //echo $blogdets->id;
    //exit(); 
}
?>
<div class="breadrumb-new mab-50">
    <div class="container-fluid" style="padding: 0 60px;">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online">Exam & Results</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><?php echo $aff_url ?></li>
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
            .results-info span {
                font-weight: 300!important;
                color: #909090;
            }
            .results-info .section-title a {
                color: #d12881!important;
                font-weight: bold;
            }
            .results-info ul li {
                line-height: 25px;
            }
        </style>



        <?php
        $this->db->select('*')->where('id =', $result_id);
        $this->db->from('results');
        $results = $this->db->get();
        foreach ($results->result() as $resultss) {
            $date = date('F d, Y', strtotime($resultss->created_at));
        }
        ?>


        <div id="main" class="mab-50">
            <div class="row results-info">
                <div class="col-lg-9 col-md-6 mab-30">
                    <div class="section-title mab-30">
                        <h2><?php echo $resultss->name ?></h2>
                        <span>Updated <?php echo $date ?> by <a href="<?php echo base_url() ?>">Edugatein Team</a></span>
                    </div><!-- /section-title -->

                    <p class="mab-30"><strong><?php echo $resultss->slug ?>:</strong> <?php echo $resultss->description ?></p>

                    <h5 class="mb-1">How to see the <?php echo $resultss->slug ?>?</h5>
                    <span><i>Students can follow the procedure given below to check their Exams/Result online:-</i></span>

                    <ul class="list-unstyled mt-3">
                        <li><?php echo $resultss->procdure1 ?></li>
                    </ul>

                    <a href="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online" class="btn btn-secondary mt-4">Go Back</a>
                </div>

                <div class="col-lg-3 col-md-6 mab-30">
                    <!-- <a href="https://www.edugatein.com">
                            <img src="https://www.edugatein.com/images/result-img.jpg" class="w-100" alt="edugatein">
                    </a> -->
                    <!-- google adsense -->
                    <!-- <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-4740793344625684"
                        data-ad-slot="6699201454"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>                         -->
                </div>
            </div><!-- /row -->

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
                <a href="<?php echo base_url("contact-us"); ?>" class="btn btn-primary1 mt-4 wow fadeInLeft" data-wow-delay="800ms">Contact Now</a>
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

<!-- Feedback-form -->
<!-- <div class="feedback-form shadow-lg">
        <div class="feedback-img">
                <img src="https://www.edugatein.com/images/feed.png" class="toggle" alt="feedback">	
        </div>

        <div class="feedback-head">
                <div class="media mb-2">
                        <div class="media-left">
                                <img src="https://www.edugatein.com/images/support.png" width="45px" alt="feedback">
                        </div>

                        <div class="media-body pl-3">
                                <h5 class="text-white">Need more help?</h5>
                                <small>Contact our support team!</small>
                        </div>
                </div>

                <ul class="list-unstyled">
                        <li>Phone: <a href="tel:1800120235600" class="text-white">1800-120-235600</a></li>
                        <li>Email: <a href="mailto:support@edugatein.com" class="text-white">support@edugatein.com</a></li>
                </ul>
        </div>

        <div class="feedback-body">
        <h5 class="mb-3">Submit A Enquiry Form</h5>
        <form  action="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online/enquiry" method="post">
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
                            <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $ipaddress ?>" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="city" id="city" required>
                                <option value="" selected disabled>-- Select City --</option>
                                <option>Chennai</option>
                                <option>Vellore</option>
                                <option>Thiruvannamalai</option>
                                <option>Cuddalore</option>
                                <option>Villuppuram</option>
                                <option>Kancheepuram</option>
                                <option>Thiruvallur</option>
                                <option>Kallakurichi</option>
                                <option>Thanjavur</option>
                                <option>Thiruchirappalli</option>
                                <option>Nagapattinam</option>
                                <option>Thiruvarur</option>
                                <option>Karur</option>
                                <option>Perambalur</option>
                                <option>Ariyalur</option>
                                <option>Coimbatore</option>
                                <option>Nilgiris</option>
                                <option>Salem</option>
                                <option>Dharmapuri</option>
                                <option>Erode</option>
                                <option>Namakkal</option>
                                <option>Krishnagiri</option>
                                <option>Thiruppur</option>
                                <option>Kanyakumari</option>
                                <option>Madurai</option>
                                <option>Ramanathapuram</option>
                                <option>Tirunelveli</option>
                                <option>Pudukkottai</option>
                                <option>Virudhunagar</option>
                                <option>Sivagangai</option>
                                <option>Dindigul</option>
                                <option>Thoothukudi</option>
                                <option>Theni</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Your Comments"></textarea>
                        </div>

                        
                        <button type="submit" class="btn btn-primary btn-block mb-2" data-toggle="modal">Submit</button>
        </form>
</div>
</div> -->
<!-- /feedback-form -->

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>	
</div><!-- /top-to-bottom -->
<script>
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    new WOW().init();

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    // Back-to-top
    window.onload = function () {
        var btn = $('#button');

        $(window).scroll(function () {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, '300');
        });
    }

    $(document).ready(function () {
        $(window).on("load", function () {
            var str = window.location.pathname;

            if (str == "/exams/how-to-get-your-exam-results-online/enquiry") {
                $('#exampleModalCenter').modal('show');
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