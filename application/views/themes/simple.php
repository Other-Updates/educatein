<!DOCTYPE html>
<html lang="en">
    <head> 
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Our website provides a list of top and best schools in <?php echo @$city; ?>. Select the best schools for your children with our listings.">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="google-site-verification" content="P1yWUghRk-hb1dFlB9FD2Mvmiv1a6LLTHH4wo7tnAzA" />
        <title>Schools in <?php echo @$city; ?> - Best CBSE, International, Kindergarten, Matriculation, Special Schools in <?php echo @$city; ?> â€“ Edugatein</title>
        <link rel="shortcut icon" href="<?php echo base_url("assets/front/images/favicon.ico"); ?>">
        <!-- All CSS -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/responsive.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/dashboard.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/fonts/icon-font/style.css"> 
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/owl.carousel.min.css"> 
        <link rel="canonical" href="https://www.edugatein.com/">
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="List of Top and Best Schools in Coimbatore | Edugatein"/>
        <meta property="og:description" content="Edugatein provides Top and Best Schools in Coimbatore. Find the school location details, admission procedure and facilities. Select the best schools for your children with our listings " />
        <meta property="og:url" content="https://www.edugatein.com/" />
        <meta property="og:site_name" content="Edugatein" />
        <meta name="robots"  content ="Index,Follow">
        <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
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
        <?php
        foreach ($js as $file) {
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
        } echo "\n\t";
        ?>
        <?php
        foreach ($css as $file) {
            echo "\n\t\t";
            ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
        } echo "\n\t";
        ?>
        <?php
        if (!empty($meta))
            foreach ($meta as $name => $content) {
                echo "\n\t\t";
                ?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
            }
        ?> 
    </head>
    <body> 
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!--header Start-->
        <header>
            <!--  START NAVBAR   -->
            <nav class="navbar navbar-expand-xl navbar-light border bg-light navbar-offcanvas px-4">
                <a class="navbar-brand mr-auto" href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url() ?>assets/front/images/logo.png" width="180" alt="">
                </a>
                <button class="navbar-toggler" type="button" id="navToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="header-text">
                    <h2>Over 100+ inter-connect schools with Edugate-in.</h2>
                    <h6>Parents and education community on a single platform to create mutual benefit.</h6>
                </div>
                <div class="navbar-collapse offcanvas-collapse">
                    <div class="close-btn" id="navToggle">
                        <i class="fa fa-close"></i>
                    </div><!-- /close-btn -->

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item home ">
                            <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
                        </li>
                        <li class="nav-item about">
                            <a class="nav-link" href="<?php echo base_url() ?>about-us">About us</a>
                        </li>
                        <li class="nav-item dropdown hidden-xl">
                            <a class="nav-link dropdown-toggle" href="" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">School Categories</a>
                            <div class="dropdown-menu" aria-labelledby="">
                                <?php
                                $this->db->select('*')->where('is_active =', 1);
                                $this->db->from('affiliations');
                                $query = $this->db->get();

                                foreach ($query->result() as $row) {
                                    $affiliation_name1 = ucwords($row->affiliation_name);
                                    $affiliation_name = str_replace(" ", "-", $row->affiliation_name);
                                    if ($affiliation_name === "stateboard-schools") {
                                        $affiliation_name = "state-board-schools";
                                    }
                                    ?>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore" id="<?php echo $row->id; ?>"><?php echo $affiliation_name1; ?> Schools</a>
                                <?php } ?>
                            </div><!-- /dropdown-menu -->
                        </li>

                        <li class="nav-item dropdown hidden-xl">
                            <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Activity Classes</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <?php
                                $activity = $this->db->get('institute_categories');
                                foreach ($activity->result() as $row1) {
                                    $category_name1 = ucwords($row1->category_name);
                                    $category_name = str_replace(" ", "-", $row1->category_name);
                                    $category_name = strtolower($category_name);
                                    ?>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-coimbatore" id="<?php echo $row1->id; ?>"> <?php echo $category_name1; ?></a>
                                <?php } ?>
                            </div><!-- /dropdown-menu -->
                        </li>

                        <!-- <li class="nav-item news">
                            <a class="nav-link" href="<?php echo base_url() ?>blog">News</a>
                        </li>
                        <li class="nav-item career">
                            <a class="nav-link" href="<?php echo base_url() ?>careers">Careers</a>
                        </li>
                        <li class="nav-item exam">
                            <a class="nav-link" href="<?php echo base_url() ?>exams/how-to-get-your-exam-results-online">Exams/Results</a>
                        </li> -->
                        <li class="nav-item contact">
                            <a class="nav-link" href="<?php echo base_url() ?>contact-us">Contact</a>
                        </li>
                        <?php if (isset($username)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="fa fa-user-circle"></i> <?php echo $username; ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item dropdown login-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Post Free/Login</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item"  href="<?php echo base_url() ?>signin" target="_blank">
                                        <div class="media" id="school">
                                            <div class="media-left">
                                                <img src="<?php echo base_url() ?>assets/front/images/dashboard/school.png" width="40px" alt="">
                                            </div>
                                            <div class="media-body pl-3">
                                                <h6>Schools</h6>
                                                <small>Schools can add Listing</small>
                                            </div>
                                        </div><!-- /media -->
                                    </a>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>schools/post_free" target="_blank">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?php echo base_url() ?>assets/front/images/dashboard/student.png" width="40px" alt="">
                                            </div>
                                            <div class="media-body pl-3">
                                                <h6>Post free</h6>
                                                <small></small>
                                            </div>
                                        </div>
                                        <!-- /media -->
                                    </a>
                                    <!-- <a class="dropdown-item" href="<?php echo base_url() ?>signin-student" target="_blank">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?php echo base_url() ?>assets/front/images/dashboard/student.png" width="40px" alt="">
                                            </div>
                                            <div class="media-body pl-3">
                                                <h6>Students</h6>
                                                <small>Student Portal</small>
                                            </div>
                                        </div> -->
                                        <!-- /media -->
                                    <!-- </a>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>signin-parent" target="_blank">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="<?php echo base_url() ?>assets/front/images/dashboard/parents.png" width="40px" alt="">
                                            </div>
                                            <div class="media-body pl-3">
                                                <h6>Parents</h6>
                                                <small>Parent Portal</small>
                                            </div>
                                        </div> -->
                                        <!-- /media -->
                                    <!-- </a> -->
                                </div>
                            </li><!-- /login-dropdown -->
                        <?php } ?>

                    </ul>
                </div><!-- /offcanvas-collapse -->
            </nav>
        </header>   
        <!--header End--> 
        <?php echo $output; ?>  

        <script>
            $(window).on("load", function () {
                $('#preloader').fadeOut('slow', function () {
                    $(this).remove();
                });
            });
            $(document).ready(function () {
                var str = window.location.pathname;
                var str2 = str.split('/');
                console.log(str);
                if (str == "/")
                {
                    $(".home").addClass('active');
                } else if (str == "/about-us")
                {
                    $(".about").addClass('active');
                } else if (str == "/blog")
                {
                    $(".news").addClass('active');
                } else if (str == "/careers")
                {
                    $(".career").addClass('active');
                } else if (str == "/exams/how-to-get-your-exam-results-online")
                {
                    $(".exam").addClass('active');
                } else if (str == "/contact-us")
                {
                    $(".contact").addClass('active');
                } else if (str2[1] == "exams")
                {
                    $(".exam").addClass('active');
                } else if (str2[1] == "blogdetails")
                {
                    $(".news").addClass('active');
                } else
                {
                    $(".home").addClass('active');

                }

            });
        </script>  
        <!-- Core JS --> 
        <script src="<?php echo base_url() ?>assets/front/js/popper.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url() ?>assets/front/js/custom.js"></script> 
        <script src="<?php echo base_url() ?>assets/front/js/dashboard.js"></script>
        <script src="<?php echo base_url() ?>assets/front/js/sweetalert.min.js"></script> 
    </body>
</html>