 
<?php
//$yourcity = array();
//$aff_url = end($this->uri->segments);
//$yourcity = explode("-", $aff_url);
//$yourcity = $this->session->userdata("search_city");
//$uccity = ucfirst($yourcity);
// echo $uccity;
// exit();
//if ($uccity == "Enquiry" || $uccity == "Otp") {
//    $yourcity_id = 1;
//    $yourcity = "coimbatore";
//} else {
//    $this->db->select('*')->where('city_name =', $uccity);
//    $this->db->from('cities');
//    $yourcityarray = $this->db->get();
//    foreach ($yourcityarray->result() as $yourcitys) {
//
//        $yourcity_id = $yourcitys->id;
//        //echo $areas->area_name;
//        //exit();
//    }
//}

 
?>
<style>
    .ui-front {
        z-index: 1000 !important;
    }
</style>
<!--Home Page Start-->
<div class="bgMotionEffects">
    <span class="fill1 shape"></span>
    <span class="fill2 shape"></span>
    <span class="fill3 shape"></span>
    <span class="fill4 shape"></span>
</div>  
<?php // if ($aff_url != "") { ?>
    <div class="summercamp-popup wow bounceIn faster">
        <a href="<?php echo base_url(); ?>list-of-best-summer-camp-in-<?php echo $city; ?>">
            <img src="<?php echo base_url() ?>assets/front/images/summer-camp.png" width="180" alt="summer-camp">
        </a>
    </div>
    <!-- /summercamp-popup -->
<?php // } else { ?>
<!--    <div class="summercamp-popup wow bounceIn faster">
        <a href="" class="summer">
            <img src="<?php echo base_url() ?>assets/front/images/summer-camp.png" width="180" alt="summer-camp">
        </a>
    </div>-->
    <!-- /summercamp-popup -->
<?php // } ?>   

<style>
    .summercamp-popup {
        position: absolute;
        right: 100px;
        top: 150px;
        animation-delay: 2s;
        /* animation: blinker 1.5s linear infinite; */
        z-index: 1010;
    }
    @keyframes blinker {
        50% {
            opacity: 0.1;
        }
    }
    .popup .modal .close {
        background-color: #000;
        width: 25px;
        height: 25px;
        opacity: 1;
        border: 0;
        border-radius: 50%;
        font-size: 16px;
        text-shadow: none;
        top: -10px;
        right: -10px;
        color: #fff;
    }
    .popup .modal .close:hover {
        opacity: 1;
        color: #fff;
    }
    @media (min-width: 360px) and (max-width: 1023px) {
        .summercamp-popup {
            display: none;
        }
    }
    @media (min-width: 576px) and (max-width: 767px) {
        .home-logo {
            margin-bottom: 50px;
            text-align: left!important;
            padding: 0 50px;
        }
        h1,h2,h3 {
            font-size: 16px!important;
        }
    }
    @media (min-width: 320px) and (max-width: 575px) {
        .home-logo {
            margin-bottom: 50px;
            text-align: left!important;
            padding: 0 20px;
        }
    }


    .pac-con    tainer:after{display:none !important;}
    #pushalert-ticker {
        width: 50px;
        height: 50px;
        text-align: center;
    }
    #pushalert-ticker svg {
        margin-left: 0px;
    }
</style> 

<!-- Modal -->
<div class="popup">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-keyboard="false" data-backdrop="static"  >
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-4"> 
                    <div class="d-flex flex-wrap">
                        <?php
                        foreach ($allcity as $allcitys) {
                            $lowercity = strtolower($allcitys->city_name);
                            ?>
                            <div class="col-12 col-md-4"><a href="<?php echo base_url() ?>list-of-best-schools-in-<?php echo $lowercity; ?>"><i class="fa fa-angle-right"></i> <?php echo $allcitys->city_name; ?></a></div>                               
                        <?php } ?> 
                    </div> 
                </div>
            </div>
        </div>
    </div><!-- /popup -->
</div><!-- /popup -->   
<div class="home-search-widget pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form action="<?php echo base_url() ?>schools-list" method="post">
                            <div class="input-group mb-3 shadow-lg">
                                <div class="input-group-prepend">
                                    <?php if ($aff_url != "") { ?>
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <?php echo (empty($uccity) ? "select your city" : $uccity ); ?> <i class="fa fa-angle-down"></i>  </button>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <?php echo (empty($uccity) ? "select your city" : $uccity ); ?><span id="uccity"></span> <i class="fa fa-angle-down"></i>  </button>
                                    <?php } ?> 
                                    <div class="dropdown-menu shadow-lg">
                                        <ul class="list-inline">
                                            <?php
                                            foreach ($allcity as $allcitys) {
                                                $lowercity = strtolower($allcitys->city_name);
                                                ?>

                                                <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-schools-in-<?php echo $lowercity; ?>"><i class="fa fa-angle-right"></i> <?php echo $allcitys->city_name; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div><!-- /dropdown-menu -->
                                </div>
                                <input type="text" id="tags" class="form-control"  name="search" placeholder="Search..." aria-label="" aria-describedby="button-addon2">
                                <?php if ($aff_url != "") { ?>
                                    <input type="hidden" style="display:none"  class="form-control"  name="searchcity" value="<?php echo $searchcity; ?>" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                                <?php } else { ?>
                                    <input type="hidden" style="display:none" id="searchcity" class="form-control"  name="searchcity" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                                <?php } ?>
                                <!-- <div id="map"></div> -->
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" ><i class="fa fa-search"></i></button>
                                </div>
                            </div><!-- /input-group -->
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div><!-- /container -->
</div><!-- /home-search-widget -->
 
    <div class="schools-section mat-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <a href="<?php echo base_url() ?>list-of-best-kindergarten-schools-in-<?php echo $city; ?>" >
                        <figure class="snip1571 wow bounceIn anim1s">
                            <div class="object-fit" style="height: 280px;">
                                <img src="<?php echo base_url() ?>assets/front/images/kinder-1.jpg" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" style="height: 280px;object-fit: cover;" />
                            </div><!-- /object-fit -->
                            <figcaption>
                                <h1><a href="<?php echo base_url() ?>list-of-best-kindergarten-schools-in-<?php echo $city; ?>" >Kindergarten Schools</a></h1>
                            </figcaption>
                        </figure><!-- /snip1571 -->
                    </a>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <a href="<?php echo base_url() ?>list-of-best-cbse-schools-in-<?php echo $city; ?>" >
                        <figure class="snip1571 wow bounceIn anim2s">
                            <div class="object-fit" style="height: 280px;">
                                <img src="<?php echo base_url(); ?>assets/front/images/cbse-11.jpg" class="w-100" alt="best cbse schools in <?php echo $city; ?>" style="height: 280px;object-fit: cover;" />
                            </div><!-- /object-fit -->
                            <figcaption>
                                <h1 style="font-size: 20px;"><a href="<?php echo base_url() ?>list-of-best-cbse-schools-in-<?php echo $city; ?>" >CBSE Schools</a></h1>
                            </figcaption>
                        </figure><!-- /snip1571 -->
                    </a>
                </div>
            </div><!-- /row -->

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <a href="<?php echo base_url() ?>list-of-best-international-schools-in-<?php echo $city; ?>" >
                        <figure class="snip1571 wow bounceIn anim3s">
                            <img src="<?php echo base_url() ?>assets/front/images/inter-1.jpg" class="w-100" alt="best international schools in <?php echo $city; ?>"/>
                            <figcaption>
                                <h2 style="font-size: 20px;"><a href="<?php echo base_url() ?>list-of-best-international-schools-in-<?php echo $city; ?>" >International Schools</a></h2>
                            </figcaption>
                        </figure><!-- /snip1571 -->
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo $city; ?>" >
                        <figure class="snip1571 wow bounceIn anim4s">
                            <img src="<?php echo base_url() ?>assets/front/images/matric-1.jpg" class="w-100" alt="matriculation schools in <?php echo $city; ?>"/>
                            <figcaption>
                                <h3><a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo $city; ?>" >Matriculation Schools</a></h3>
                            </figcaption>
                        </figure><!-- /snip1571 -->
                    </a>
                </div>
                <div class="col-sm-6 offset-sm-3 col-lg-4 offset-lg-0" >
                    <a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo $city; ?>" >
                        <figure class="snip1571 wow bounceIn anim5s">
                            <img src="<?php echo base_url() ?>assets/front/images/state-1.jpg" class="w-100" alt="best state board schools in <?php echo $city; ?>"/>
                            <figcaption>
                                <h3><a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo $city; ?>" >Special Schools</a></h3>
                            </figcaption>
                        </figure><!-- /snip1571 -->
                    </a>
                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /schools-section -->
 
<div class="sticy-activity-widget" style="display: none;">
    <!-- Modal-Trigger -->
    <div class="sticky-widget">
        <button class="btn sticky-btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-align-justify"></i></button>
    </div><!-- /sticky-widget -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                    <ul class="list-unstyled">
                        <h5 class="list-group-item list-group-item-action text-white bg-blue">Activity Classes</h5>
                        <a href="<?php echo base_url() ?>list-of-best-dance-classes-in-coimbatore" class="list-group-item">Dance Classes</a>
                        <a href="<?php echo base_url() ?>list-of-best-music-classes-in-coimbatore" class="list-group-item">Music Classes</a>
                        <a href="<?php echo base_url() ?>list-of-best-drawing-classes-in-coimbatore" class="list-group-item">Drawing Classes</a>
                        <a href="<?php echo base_url() ?>list-of-best-swimming-classes-in-coimbatore" class="list-group-item">Swimming Classes</a>
                        <a href="<?php echo base_url() ?>list-of-best-multimedia-classes-in-coimbatore" class="list-group-item">Multimedia Classes</a>
                    </ul>
                </div><!-- /modal-body -->
            </div>
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->
</div><!-- /sticy-activity-widget -->
<!--Footer Section Start-->
<?php echo $this->load->view("footer_home"); ?>
<!--Footer Section End-->
<!-- /content-footer -->
<!--Footer Section End-->
<!-- /content-footer -->

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>	
</div><!-- /top-to-bottom --> 
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

                    <form action="<?php echo base_url() ?>otp" method="post" class="mt-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="otp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="OTP">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required>
                        </div>

                        <button type="submit"  class="btn btn-primary btn-block">Submit</button>
                    </form>
                <?php } ?>
            </div><!-- /modal-body -->
        </div><!-- /modal-content -->
    </div>
</div>
<!-- /modal --> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    $(window).on("load", function () {
        //Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });

        // Trigger animation
        new WOW().init();
        // back to top button
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
    });
    $(document).ready(function () {
        //        Location Popup Start
<?php if (empty($this->session->userdata("search_city"))) { ?>
            setTimeout(function () {
                $('#exampleModalCenter').modal('show', {backdrop: 'static', keyboard: false});
            }, 1000);
<?php } ?>
        //        setTimeout(function () {
        //            $('#exampleModalCenter').modal('hide');
        //        }, 5000);
        //        Location Popup End
        var str = window.location.pathname;
        if (str == "/enquiry") {
            $('#exampleModalCenter').modal('show');
        }

        // Feedback-form
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active');
        });

        // Disabled the back button on the browser 
        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    });

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
    $(function () {
        var availableTags = [
            <?php
                    foreach (@$schools as $school) {
                        echo '"'.@$school["school_name"]. '",';
                    }
            ?>
             
        ];
        $("#tags").autocomplete({
            source: availableTags
        });
    });
</script> 




