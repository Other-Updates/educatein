<?php
$date = date("Y/m/d");

$this->db->select('*')->where('date =', $date);
$this->db->from('homepage_counts');
$homepage = $this->db->get();
if ($homepage->num_rows() > 0) {
    foreach ($homepage->result() as $homepages) {
        $view_count = $homepages->view_count;
    }

    $this->db->set('view_count', $view_count + 1)->where('date', $date)->update('homepage_counts');
} else {
    $homepage_count = array(
        'date' => $date,
        'view_count' => 1,
    );

    $this->db->insert('homepage_counts', $homepage_count);
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

$this->db->select('*')->where('date =', $date);
$this->db->where('ip =', $ipaddress);
$this->db->from('user_analys');
$ip = $this->db->get();

if ($ip->num_rows() > 0) {
    foreach ($ip->result() as $ips) {
        $old_ip = $ips->ip;
        $page_view = $ips->page_view;
    }

    $this->db->set('page_view', $page_view + 1);
    $this->db->where('date', $date);
    $this->db->where('ip', $ipaddress);

    $update = $this->db->update('user_analys');

    // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
} else {
    $user_count = array(
        'ip' => $ipaddress,
        'date' => $date,
        'page_view' => 1,
    );

    $this->db->insert('user_analys', $user_count);
}
?> 
<style>
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

<div class="bread-crumb1 mab-50 text-center">
    <div class="container">
        <h1 class="text-white">Contact Us</h1>
        <ul class="list-inline py-3 mab-30">
            <li class="list-inline-item"><a href="<?php echo base_url() ?>"><b>Home</b></a></li>
            <li class="list-inline-item">/</li>
            <li class="list-inline-item"><b>Contact Us</b></li>
        </ul>
    </div>
</div>
<svg id="deco-clouds2" class="" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
    <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100
          M5 100 Q 10 30 15 100
          M10 100 Q 15 10 20 100
          M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100
          M25 100 Q 30 10 35 100
          M30 100 Q 35 30 40 100
          M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100
          M45 100 Q 50 20 55 100
          M50 100 Q 55 40 60 100
          M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100
          M65 100 Q 70 20 75 100
          M70 100 Q 75 45 80 100
          M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100
          M85 100 Q 90 50 95 100
          M90 100 Q 95 25 100 100
          M95 100 Q 100 15 105 100 Z">
    </path>
</svg>

<div class="contact-page">
    <div class="container">
        <div class="section-title text-center mab-50">
            <h1 class="mb-2 wow fadeInDown" data-wow-delay="300ms">We are here to Help!</h1>
            <div class="line1 wow fadeInDown" data-wow-delay="400ms"></div>
        </div><!-- /section-title -->

        <div class="row">
            <div class="col-lg-4 mab-30">
                <div class="contact-head">
                    <h3 class="mb-2 wow fadeInUp" data-wow-delay="500ms">Find Us There</h3>
                    <p class="wow fadeInUp" data-wow-delay="400ms">Being a parent, you know that, it’s a great responsibility to find a perfect school which offers a great education to mold the future of your kids. If you are looking for the best schools in Coimbatore.</p>
                </div><!-- /contact-head -->

                <div class="contact-body">
                    <!-- <div class="media my-4 wow fadeInUp" data-wow-delay="600ms">
                            <div class="media-left mr-3 mt-2">
                                    <img src="<?php //echo base_url()   ?>images/icons/location.png" alt="support">
                            </div>

                            <div class="media-body">
                                    <p class="lead"><b>Location:</b></p>
                                    <p>No.1, sri valsam, sabari garden, Nallampalayam Rd, Ramasamy Nagar Extension I, Nallampalayam, Coimbatore, Tamil Nadu 641027</p>
                            </div>
                    </div> -->

                    <div class="media my-4 wow fadeInUp" data-wow-delay="600ms">
                        <div class="media-left mr-3 mt-2">
                            <img src="<?php echo base_url("assets/front/") ?>images/icons/call1.png" alt="support">
                        </div><!-- /media-left -->

                        <div class="media-body">
                            <p class="lead"><b>Phone:</b></p>
                            <p><a href="tel:1800120235600" style="color: #606060;">1800-120-235600</a></p>
                        </div><!-- /media-body -->
                    </div><!-- /media -->

                    <div class="media my-4 wow fadeInUp" data-wow-delay="700ms">
                        <div class="media-left mr-3 mt-2">
                            <img src="<?php echo base_url("assets/front/") ?>images/icons/email1.png" alt="support">
                        </div><!-- /media-left -->

                        <div class="media-body">
                            <p class="lead"><b>Email:</b></p>
                            <p><a href="mailto:support@edugatein.com" style="color: #606060;">support@edugatein.com</a></p>
                        </div><!-- /media-body -->
                    </div><!-- /media -->
                </div><!-- /contact-body -->					
            </div><!-- /col-lg-4 -->

            <div class="col-lg-8 mab-30">
                <h3 class="mb-4 wow fadeInUp" data-wow-delay="400ms">Contact Us</h3>

                <form action="<?php echo base_url() ?>contacts/insert" method="post">
                    <div class="row wow fadeInUp" data-wow-delay="500ms">
                        <div class="col-lg-6 col-sm-6 mab-30">
                            <input type="text" name="name" class="form-control" 	placeholder="Your name*" required>
                        </div>
                        <div class="col-lg-6 col-sm-6 mab-30">
                            <input type="email" name="email" class="form-control" placeholder="Email Address*" required>
                        </div>
                    </div><!-- /row -->

                    <div class="row wow fadeInUp" data-wow-delay="600ms">
                        <div class="col-lg-6 col-sm-6 mab-30">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <div class="col-lg-6 col-sm-6 mab-30">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number*" pattern="[6789][0-9]{9}" required>
                        </div>
                    </div><!-- /row -->

                    <div class="row wow fadeInUp" data-wow-delay="700ms">
                        <div class="col-lg-12 mab-30">
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="5" placeholder="Type your message"></textarea>
                        </div>
                    </div><!-- /row -->
                    <button type="submit" class="btn btn-primary wow fadeInUp" data-wow-delay="800ms">Send Message</button>
                </form>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /contact-page -->

<div class="map-section mab-50">
    <div class="container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3915.914272827812!2d76.95474155062834!3d11.045054063340947!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8986437e697d3f2f!2sEdugatein!5e0!3m2!1sen!2sin!4v1545299622902" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div><!-- /container -->
</div><!-- /map-section -->

<svg id="deco-clouds" style="background-color: #fff;" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
    <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100
          M5 100 Q 10 30 15 100
          M10 100 Q 15 10 20 100
          M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100
          M25 100 Q 30 10 35 100
          M30 100 Q 35 30 40 100
          M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100
          M45 100 Q 50 20 55 100
          M50 100 Q 55 40 60 100
          M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100
          M65 100 Q 70 20 75 100
          M70 100 Q 75 45 80 100
          M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100
          M85 100 Q 90 50 95 100
          M90 100 Q 95 25 100 100
          M95 100 Q 100 15 105 100 Z">
    </path>
</svg>

<!-- Footer templete -->
<?php $this->load->view('footer'); ?>

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>	
</div><!-- /top-to-bottom -->

<script>
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });

    $("html").easeScroll(2000);

    new WOW().init();

    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
</script>
