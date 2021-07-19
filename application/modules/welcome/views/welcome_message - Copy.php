<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// echo $_POST['demo'];;
// exit();
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


$json = file_get_contents("http://api.ipstack.com/$ipaddress?access_key=568cb70a320a074c060506651b81a793");
$json = json_decode($json, true);

$uccity = $json['city'];

$city = strtolower($uccity);
// echo $uccity;
// exit();
$city_check = 0;
$yourcity = array();
$aff_url = end($this->uri->segments);
// echo $aff_url;
// exit();
if ($aff_url != "") {
    $yourcity = explode("-", $aff_url);
    $city = end($yourcity);
    $ucity = ucfirst($city);
    $searchcity = ucfirst($city);

    $this->db->select('*')->where('is_active =', 1);
    $this->db->from('cities');
    $allcity = $this->db->get();

    foreach ($allcity->result() as $allcitys) {

        if ($allcitys->city_name == $ucity) {
            $uccity = ucfirst($city);
        }
    }



// echo $city;
// exit();
} else {
    $this->db->select('*')->where('is_active =', 1);
    $this->db->from('cities');
    $allcity = $this->db->get();

    foreach ($allcity->result() as $allcitys) {

        if ($allcitys->city_name == $uccity) {
            $city_check++;
        }
    }
// echo $city;
// exit();
    if ($city_check == 0) {
        $uccity = "Coimbatore";
        $city = "coimbatore";
    }
}

// echo $uccity;
// exit();

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

<!DOCTYPE html> 
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Our website provides a list of top and best schools in <?php echo $city; ?>. Select the best schools for your children with our listings.">

        <meta name="google-site-verification" content="P1yWUghRk-hb1dFlB9FD2Mvmiv1a6LLTHH4wo7tnAzA" />
        <title>Schools in <?php echo $city; ?> - Best CBSE, International, Kindergarten, Matriculation, Special Schools in <?php echo $city; ?> – Edugatein</title>
        <link rel="shortcut icon" href="https://edugatein.com/images/favicon.ico"> 

        <!-- All CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/responsive.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/dashboard.css">
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

        <link rel="canonical" href="https://www.edugatein.com/">
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="List of Top and Best Schools in Coimbatore | Edugatein"/>
        <meta property="og:description" content="Edugatein provides Top and Best Schools in Coimbatore. Find the school location details, admission procedure and facilities. Select the best schools for your children with our listings " />
        <meta property="og:url" content="https://www.edugatein.com/" />
        <meta property="og:site_name" content="Edugatein" />
        <meta name="robots"  content ="Index,Follow">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129163040-1"></script>

        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-129163040-1');
        </script>

        <script type='application/ld+json'> 
            {
            "@context": "http://www.schema.org",
            "@type": "WebSite",
            "name": "Edugatein",
            "alternateName": "Edugatein",
            "url": "https://www.edugatein.com/",
            "sameAs": ["https://www.facebook.com/edugatein",
            "https://twitter.com/edugatein",
            "https://www.linkedin.com/company/edugatein/",
            "https://plus.google.com/u/0/collection/Y7iLfE",
            "https://www.instagram.com/edugatein/"]
            }
        </script>
        <!-- sendpulse web push notifications -->
        <!-- <script charset="UTF-8" src="//cdn.sendpulse.com/js/push/9c79650c7e694d8609046df5d5361cde_1.js" async></script> -->

        <!-- PushAlert -->
        <script type="text/javascript">
            (function (d, t) {
                var g = d.createElement(t),
                        s = d.getElementsByTagName(t)[0];
                g.src = "https://cdn.pushalert.co/integrate_1818c0b81d3ef928fa555d56203a0f71.js";
                s.parentNode.insertBefore(g, s);
            }(document, "script"));
        </script>
        <!-- End PushAlert -->

    </head>
    <body>
        <!-- Preloader -->
        <!--        <div id="preloader">
                    <div class="preloader">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>-->
        <!-- /preloader -->
        <?php $this->load->view('header'); ?>
        <!--Home Page Start-->
        <div class="bgMotionEffects">
            <span class="fill1 shape"></span>
            <span class="fill2 shape"></span>
            <span class="fill3 shape"></span>
            <span class="fill4 shape"></span>
        </div>

        <?php if ($aff_url != "") { ?>
            <div class="summercamp-popup wow bounceIn faster">
                <a href="https://www.edugatein.com/list-of-best-summer-camp-in-<?php echo $city; ?>">
                    <img src="https://www.edugatein.com/images/summer-camp.png" width="180" alt="summer-camp">
                </a>
            </div>
            <!-- /summercamp-popup -->
        <?php } else { ?>
            <div class="summercamp-popup wow bounceIn faster">
                <a href="" class="summer">
                    <img src="https://www.edugatein.com/images/summer-camp.png" width="180" alt="summer-camp">
                </a>
            </div>
            <!-- /summercamp-popup -->
        <?php } ?>   

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
        </style>

        <!-- Modal -->
        <div class="popup">
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body" style="padding: 5px;">
                            <img src="https://www.edugatein.com/images/popup2.jpg" class="w-100" alt="">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- /popup -->

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

        <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function () {
                    $('#exampleModalCenter').modal('show');
                }, 1000);
                setTimeout(function () {
                    $('#exampleModalCenter').modal('hide');
                }, 5000);
            });
        </script>




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
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <?php echo $uccity; ?> <i class="fa fa-angle-down"></i>  </button>

                                            <?php } else { ?>
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <span id="uccity"></span> <i class="fa fa-angle-down"></i>  </button>

                                            <?php } ?>



                                            <div class="dropdown-menu shadow-lg">
                                                <ul class="list-inline">
                                                    <?php
                                                    $this->db->select('*')->where('is_active =', 1);
                                                    $this->db->order_by("city_name", "asc");
                                                    $this->db->from('cities');
                                                    $allcity = $this->db->get();

                                                    foreach ($allcity->result() as $allcitys) {
                                                        $lowercity = strtolower($allcitys->city_name);
                                                        ?>

                                                        <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-schools-in-<?php echo $lowercity; ?>"><i class="fa fa-angle-right"></i> <?php echo $allcitys->city_name; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </div><!-- /dropdown-menu -->
                                        </div>
                                        <input type="text" id="pac-input" class="form-control"  name="search" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>
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


        <?php if ($aff_url != "") { ?>

            <div class="schools-section mat-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a href="<?php echo base_url() ?>list-of-best-kindergarten-schools-in-<?php echo $city; ?>" >
                                <figure class="snip1571 wow bounceIn anim1s">
                                    <div class="object-fit" style="height: 280px;">
                                        <img src="<?php echo base_url() ?>images/kinder-1.jpg" class="w-100" alt="best kindergarten schools in coimbatore"/ style="height: 280px;object-fit: cover;">
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
                                        <img src="<?php echo base_url() ?>images/cbse-11.jpg" class="w-100" alt="best cbse schools in coimbatore"/ style="height: 280px;object-fit: cover;">
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
                                    <img src="<?php echo base_url() ?>images/inter-1.jpg" class="w-100" alt="best international schools in coimbatore"/>
                                    <figcaption>
                                        <h2 style="font-size: 20px;"><a href="<?php echo base_url() ?>list-of-best-international-schools-in-<?php echo $city; ?>" >International Schools</a></h2>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo $city; ?>" >
                                <figure class="snip1571 wow bounceIn anim4s">
                                    <img src="<?php echo base_url() ?>images/matric-1.jpg" class="w-100" alt="matriculation schools in coimbatore"/>
                                    <figcaption>
                                        <h3><a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo $city; ?>" >Matriculation Schools</a></h3>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>

                        <div class="col-sm-6 offset-sm-3 col-lg-4 offset-lg-0" >
                            <a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo $city; ?>" >
                                <figure class="snip1571 wow bounceIn anim5s">
                                    <img src="<?php echo base_url() ?>images/state-1.jpg" class="w-100" alt="best state board schools in coimbatore"/>
                                    <figcaption>
                                        <h3><a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo $city; ?>" >Special Schools</a></h3>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div><!-- /row -->
                </div><!-- /container -->
            </div><!-- /schools-section -->

        <?php } else { ?>

            <div class="schools-section mat-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a href="" class="kinder">
                                <figure class="snip1571 wow bounceIn anim1s">
                                    <div class="object-fit" style="height: 280px;">
                                        <img src="<?php echo base_url() ?>images/kinder-1.jpg" class="w-100" alt="best kindergarten schools in coimbatore"/ style="height: 280px;object-fit: cover;">
                                    </div><!-- /object-fit -->
                                    <figcaption>
                                        <h1><a href="" class="kinder">Kindergarten Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>

                        <div class="col-lg-6 col-sm-6">
                            <a href="" class="cbse">
                                <figure class="snip1571 wow bounceIn anim2s">
                                    <div class="object-fit" style="height: 280px;">
                                        <img src="<?php echo base_url() ?>images/cbse-11.jpg" class="w-100" alt="best cbse schools in coimbatore"/ style="height: 280px;object-fit: cover;">
                                    </div><!-- /object-fit -->
                                    <figcaption>
                                        <h1 style="font-size: 20px;"><a href="" class="cbse">CBSE Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div><!-- /row -->

                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <a href="" class="inter">
                                <figure class="snip1571 wow bounceIn anim3s">
                                    <img src="<?php echo base_url() ?>images/inter-1.jpg" class="w-100" alt="best international schools in coimbatore"/>
                                    <figcaption>
                                        <h2 style="font-size: 20px;"><a href="" class="inter">International Schools</a></h2>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <a href="" class="matri">
                                <figure class="snip1571 wow bounceIn anim4s">
                                    <img src="<?php echo base_url() ?>images/matric-1.jpg" class="w-100" alt="matriculation schools in coimbatore"/>
                                    <figcaption>
                                        <h3><a href="" class="matri">Matriculation Schools</a></h3>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>

                        <div class="col-sm-6 offset-sm-3 col-lg-4 offset-lg-0" >
                            <a href="" class="spec">
                                <figure class="snip1571 wow bounceIn anim5s">
                                    <img src="<?php echo base_url() ?>images/state-1.jpg" class="w-100" alt="best state board schools in coimbatore"/>
                                    <figcaption>
                                        <h3><a href="" class="spec">Special Schools</a></h3>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div><!-- /row -->
                </div><!-- /container -->
            </div><!-- /schools-section -->

        <?php } ?>

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
        <div class="content-footer mat-80 section-pad">
            <div class="container">
                <div class="heading-collapse">Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit. Let's Join with us to find your information like where your school located, what are the facilities and promotional offers in Edugate-india.</div><br>

                <div class="heading-collapse">Edugatein offer a detailed and <h5>well-researched guide about schools</h5> type, curriculum, facilities, activity classes, contact details and location through map. This information is directly from school management. In particular, we allocate the separate page for the schools in all over tamilnadu to provide the details of the school. By this information parents can choose schools in efficient manner and school management also gives all their unique information.</div> <br>

                <div class="heading-collapse">If you are looking for the <h5>best schools in <?php echo $city; ?></h5>, We have <h5>Top and Best schools lists</h5> are available here and also to find the best CBSE, International, Matriculation, State Board and Kindergarten in the right place. Our goal is to develop creative skills and extra-curricular activities such as sports, dance, music, swimming, yoga and much more.</div>

                <!-- <h6>Some of our services that will prove that we are best:</h6> -->

                <div class="content-footer-list">
                    <div class="row">
                        <div class="col-lg-4 mab-20">
                            <h5 class="mb-2">CBSE Schools</h5>
                            <div class="heading-collapse">The CBSE carries out continuous research and development for the advancement of the academic standards in the country. It has recently introduced the Grading system based on continuous and comprehensive evaluation. Here choose <h6>best CBSE schools in <?php echo $city; ?>.</h6></div>
                        </div>

                        <div class="col-lg-4 mab-20">
                            <h5 class="mb-2">International Schools</h5>
                            <div class="heading-collapse">An international school is a school that promotes international education, in an international environment, either by adopting IGCSE, IB and Edexcal. Choose interested board from <h6>best International Schools in <?php echo $city; ?>.</h6></div>
                        </div>

                        <div class="col-lg-4 mab-20">
                            <h5 class="mb-2">Matriculation Schools</h5>
                            <div class="heading-collapse">Schools use English as the language of instruction. They have a unique curriculum until class 10 and follow the <?php echo $city; ?> State Board curriculum for classes 11 and 12. You can choose <h6>best Matriculation schools in <?php echo $city; ?>.</h6></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mab-20">
                            <h5 class="mb-2">Special Schools</h5>
                            <div class="heading-collapse">Each and every State Government provides Primary, Secondary and Higher Secondary Education in its respective state. Here we listed <h6>best Special Schools</h6> in <?php echo $city; ?> state government.</div>
                        </div>

                        <div class="col-lg-4 mab-20">
                            <h5 class="mb-2">Kindergarten Schools</h5>
                            <div class="heading-collapse">Kindergarten program plays an important role for the children, as it helps them to grow emotionally, physically and mentally. Choose <h6>best kindergarten schools</h6> in <?php echo $city; ?> from our list.</div>
                        </div>

                        <div class="col-lg-4 mab-20">
                            <h4 class="mb-3 mt-3">Keep In Touch</h4>
                            <ul class="list-inline"> 
                                <li class="list-inline-item"><a href="https://www.facebook.com/edugatein" target="_blank"><i class="fa fa-facebook"></i></a></li> 
                                <li class="list-inline-item"><a href="https://twitter.com/edugatein" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.linkedin.com/company/edugatein/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/edugatein/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /content-footer-list -->
                <hr>
                <div class="text-center mat-50">
                    <p>&copy; Copyright 2019 Edugatein. All Rights Reserved.</p>
                </div>
            </div><!-- /container -->
        </div>
         <!--Footer Section End-->
        <!-- /content-footer -->

        <!-- ============ Back-to-top ============ -->
        <div class="top-to-bottom">
            <a id="button">
                <i class="fa fa-chevron-up"></i>
            </a>	
        </div><!-- /top-to-bottom -->

        <!-- Feedback-form -->
        <!-- <div class="feedback-form shadow-lg">
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
                        </div>

                        <ul class="list-unstyled">
                                <li>Phone: <a href="tel:1800120235600" class="text-white">1800-120-235600</a></li>
                                <li>Email: <a href="mailto:support@edugatein.com" class="text-white">support@edugatein.com</a></li>
                        </ul>
                </div>

                <div class="feedback-body">
                <h5 class="mb-3">Submit A Enquiry Form</h5>
                <form  action="<?php echo base_url() ?>enquiry" method="post">
                        <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your Name*" required>
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

                                <button type="submit" class="btn btn-primary btn-block mb-2" data-toggle="modal">Submit</button>
                </form>
        </div>
        </div> -->
        <!-- /feedback-form -->

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
                        </div><!-- /modal-body -->
                    </div><!-- /modal-content -->
                </div>
            </div><!-- /modal -->

        <?php } ?>

        <!-- Core JS -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
        <script src="<?php echo base_url() ?>js/popper.min.js"></script>
        <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>js/wow.min.js"></script>
        <script src="<?php echo base_url() ?>js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url() ?>js/custom.js"></script>
        <script src="<?php echo base_url() ?>js/jquery.stickit.js"></script>
        <script src="<?php echo base_url() ?>js/dashboard.js"></script>
        <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU5mKV4oCZcxKQfOka5Mz5LlcqS3eB2YU&libraries=places&signed_in=true&callback=initMap"></script> -->

        <script type="text/javascript">


            $(window).on('load', function () {
                // Trigger animation
                new WOW().init();
            });

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

            //Preloader
            $(window).on("load", function () {
                $('#preloader').fadeOut('slow', function () {
                    $(this).remove();
                });
            });

            $(document).ready(function () {
                var str = window.location.pathname;
                if (str == "/enquiry") {
                    $('#exampleModalCenter').modal('show');
                }
            });

            // Feedback-form
            $(document).ready(function () {
                $('.toggle').click(function () {
                    $('.feedback-form').toggleClass('active')
                })
            })

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
        </script>


<!-- <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>  -->

        <?php
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('cities');
        $allcity = $this->db->get()->result();

        foreach ($allcity as $allcitys) {
            $cityname[] = $allcitys->city_name;
        }
        ?>

        <script>
            var arr = <?php echo json_encode($cityname); ?>;
            function getLocation() {
                // console.log("main test");
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, showError);

                } else {
                    $("#uccity").html("Chennai");
                    $("#lowercity").html("chennai");
                    $("#searchcity").val("chennai");

                    $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                    $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                    $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                    $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                    $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                    $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                }
            }


            function showPosition(position) {
                lat = position.coords.latitude;
                lon = position.coords.longitude;
                displayLocation(lat, lon);

            }

            function showError(error) {
                //    console.log(error);
                //    alert(error);
                switch (error.code) {
                    // $("#uccity").html("Chennai"); 
                    // break;
                    case error.PERMISSION_DENIED:
                        // console.log("test5");
                        $("#uccity").html("chennai");
                        $("#lowercity").html("chennai");
                        $("#searchcity").val("chennai");
                        $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                        $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                        $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                        $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                        $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                        $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                        break;
                    case error.POSITION_UNAVAILABLE:
                        // console.log("test4");
                        $("#uccity").html("Chennai");
                        $("#lowercity").html("chennai");
                        $("#searchcity").val("chennai");
                        $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                        $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                        $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                        $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                        $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                        $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                        break;
                    case error.TIMEOUT:
                        // console.log("test3");
                        $("#uccity").html("Chennai");
                        $("#lowercity").html("chennai");
                        $("#searchcity").val("chennai");
                        $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                        $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                        $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                        $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                        $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                        $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                        break;
                    case error.UNKNOWN_ERROR:
                        // console.log("test2");
                        $("#uccity").html("chennai");
                        $("#lowercity").html("chennai");
                        $("#searchcity").val("chennai");
                        $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                        $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                        $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                        $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                        $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                        $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                        break;
                    default:
                        // console.log("test1");
                        $("#uccity").html("chennai");
                        $("#lowercity").html("chennai");
                        $("#searchcity").val("chennai");
                        $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                        $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                        $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                        $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                        $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                        $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                        break;
                }
            }

            function displayLocation(latitude, longitude) {

                var geocoder;

                geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(latitude, longitude);

                geocoder.geocode(
                        {'latLng': latlng},
                        function (results, status) {

                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    var add = results[0].formatted_address;
                                    var value = add.split(",");

                                    count = value.length;



                                    var cityname = [];
                                    for (valcount = 1; valcount <= count; valcount++)
                                    {
                                        if (typeof value[count - valcount] !== 'undefined')
                                        {
                                            cityname[valcount - 1] = value[count - valcount].trim();
                                        }

                                    }





                                    // var arr = ['Coimbatore','Tiruppur','Nilgiris','Erode','Karur','Namakkal','Salem','Nagapattinam','Tiruvarur','Thanjavur','Madurai','Ariyalur','kallakurichi','Kanchipuram','Pudukkottai','Tiruchirappalli','Dharmapuri','Tirunelveli','Vellore','Viluppuram','Virudhunagar','Chennai','Kanyakumari','Dindigul','Tiruvannamalai'];

                                    var city = '';
                                    for (var i = 0; i < arr.length; i++) {
                                        var name = arr[i];

                                        for (var j = 0; j <= cityname.length; j++)
                                        {
                                            if (name == cityname[j])
                                            {
                                                city = cityname[j];
                                                break;
                                            }
                                        }
                                        // console.log(city);
                                        // if(name == city1){
                                        // city = city1;

                                        // break;
                                        // }else if(name == city2){
                                        // city = city2;

                                        // break;
                                        // }else if(name == city3){
                                        // city = city3;

                                        // break;
                                        // }else if(name == city4){
                                        // city = city4;

                                        // break;
                                        // }else if(name == city5){
                                        // city = city5;

                                        // break;
                                        // }else if(name == city6){
                                        // city = city6;

                                        // break;
                                        // }

                                    }

                                    if (city == '')
                                    {
                                        city = 'Chennai';
                                    } else if (city == 'undefined')
                                    {
                                        city = 'Chennai';
                                    }



                                    // x.innerHTML =  city;
                                    var lowercity = city.toLowerCase();
                                    // y.innerHTML =  lowercity;

                                    $("#uccity").html(city);
                                    $("#lowercity").html(lowercity);
                                    $("#searchcity").val(city);
                                    $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-" + lowercity)
                                    $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-" + lowercity)
                                    $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-" + lowercity)
                                    $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-" + lowercity)
                                    $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-" + lowercity)
                                    $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-" + lowercity)





                                } else {
                                    $("#uccity").html("Chennai");
                                    $("#lowercity").html("chennai");
                                    $("#searchcity").val("chennai");
                                    $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                                    $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                                    $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                                    $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                                    $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                                    $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                                }
                            } else {
                                $("#uccity").html("Chennai");
                                $("#lowercity").html("chennai");
                                $("#searchcity").val("chennai");
                                $("a.kinder").attr("href", "<?php echo base_url() ?>list-of-best-kindergarten-schools-in-chennai")
                                $("a.cbse").attr("href", "<?php echo base_url() ?>list-of-best-cbse-schools-in-chennai")
                                $("a.inter").attr("href", "<?php echo base_url() ?>list-of-best-international-schools-in-chennai")
                                $("a.matri").attr("href", "<?php echo base_url() ?>list-of-best-matriculation-schools-in-chennai")
                                $("a.spec").attr("href", "<?php echo base_url() ?>list-of-best-special-schools-in-chennai")
                                $("a.summer").attr("href", "<?php echo base_url() ?>list-of-best-summer-camp-in-chennai")
                            }
                        }
                );
                // return city;
            }

        </script>


        <style>
            .pac-container:after{display:none !important;}
        </style>  

        <!--Start of Tawk.to Script-->
<!--        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5bfe712579ed6453ccab8370/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>-->
        <!--End of Tawk.to Script-->

        <!-- Disabled the back button on the browser -->
        <script type="text/javascript">
            $(document).ready(function () {
                window.history.pushState(null, "", window.location.href);
                window.onpopstate = function () {
                    window.history.pushState(null, "", window.location.href);
                };
            });
        </script>

        <style>
            #pushalert-ticker {
                width: 50px;
                height: 50px;
                text-align: center;
            }
            #pushalert-ticker svg {
                margin-left: 0px;
            }
        </style>




        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCOvYpdQDGP4aHQZGplukwyk4M600bycw&callback=getLocation" type="text/javascript"></script>


    </body>
</html>