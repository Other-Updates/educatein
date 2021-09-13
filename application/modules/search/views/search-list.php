<!-- All CSS -->
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

<div class="breadrumb-new mab-50">
    <div class="container-fluid" style="padding: 0 60px;">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><?php echo $search; ?></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-6 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->
<div class="site-content container-fluid">
    <div class="">
        <div class="sidebar">
            <div id="sticky">
                <div class="sidebar-categories">
                    <ul class="list-unstyled">
                        <li class="lead">School Categories</li>
                        <?php
                        foreach ($affiliations as $row) {
                            $affiliation_name1 = ucwords($row->affiliation_name);
                            $affiliation_name = str_replace(" ", "-", $row->affiliation_name);
                            if ($affiliation_name === "stateboard-schools") {
                                $affiliation_name = "state-board-schools";
                            }
                            ?>
                            <li>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore" id="<?php echo $row->id; ?>"><i class="fa fa-circle"></i> <?php echo $affiliation_name1; ?> Schools</a>
                            </li>   
                        <?php } ?>
                        <!-- /School Categories -->

                        <li class="lead lead1 mt-3">Activity Classes</li>
                        <?php
                        foreach ($institute_categories as $row1) {
                            $category_name1 = ucwords($row1->category_name);
                            $category_name = str_replace(" ", "-", $row1->category_name);
                            $category_name = strtolower($category_name);
                            ?>
                            <li>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-coimbatore" id="<?php echo $row1->id; ?>"><i class="fa fa-circle"></i> <?php echo $category_name1; ?></a>
                            </li>    
                        <?php } ?>
                        <!-- /Activity Classes -->
                    </ul>
                </div><!-- /sidebar-categories -->
            </div><!-- /sticky -->
        </div><!-- /sidebar -->
        <div id="main" class="mab-30">
            <div class="row">
                <div class="col-lg-8 col-sm-7">
                    <div class="section-title mab-30">
                        <h1><?php echo $search; ?></h1>
                        <div class="line"></div>
                    </div><!-- /section-title -->
                </div>
            </div><!-- /row -->
            <div class="row">
                <?php
                foreach ($schools as $school) {
                             $school_name = str_replace(" ", "-", $school["school_name"]);
                    ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="nearby-widget mab-30 wow fadeInUp">
                            <a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.$city.'/'. strtolower($school_name)); ?>" target="_blank">
                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                    <img src="<?php echo base_url("laravel/public/".$school["logo"]); ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                </div>
                            </a>
                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                <h6 class="mb-2"><?php echo $school["school_name"]; ?></h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-1"><b>Type:</b> <?php echo ucfirst($school["affiliation_name"]); ?> School</li>
                                    <li class="mb-1"><b>Location:</b> <?php echo $school["area_name"]; ?></li>
                                </ul>
                                <a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.$city.'/'. strtolower($school_name)); ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                
                            </div><!-- /nearby-widget-body -->
                        </div><!-- /nearby-widget -->
                    </div>
                <?php }
                ?>
            </div>

        </div>
    </div>
</div>
<!-- Footer templete -->
<?php // $this->load->view('footer'); ?>

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>    
</div><!-- /top-to-bottom -->
 
<script>
    $(window).on("load", function () {
        //Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });
    new WOW().init();
    $("html").easeScroll(2000);

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    $(function () { //document ready
        if ($('#sticky').length) { //make sure "#sticky" elements exists
            var el = $('#sticky');
            var stickyTop = $('#sticky').offset().top; //returns number
            var stickyHeight = $('#sticky').height();

            $(window).scroll(function () { //Scroll event
                var limit = $('#footer').offset().top - stickyHeight - 30;

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

    // Swiper-3d-Effect
    var swiper = new Swiper('.swiper-container', {
        effect: 'cube',
        grabCursor: true,
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
            autoplay: 1000,
        },
        pagination: {
            el: '.swiper-pagination',
        },
        autoplay: {
            delay: 1300,
        },
    });
</script>