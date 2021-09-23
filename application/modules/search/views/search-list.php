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

<div class="breadrumb-new mab-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 home-search-widget">
                <div>
                    <form action="<?php echo base_url() ?>schools-list" method="get">
                        <div class="input-group">
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
            </div>
            <div class="col-lg-6 col-sm-6 text-right">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><?php echo $search; ?></li>
                </ul>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->
<div class="site-content container">
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
        <?php if(!empty($schools) || !empty($activityclass)){ ?>
            <?php if(!empty($schools)){ ?>
                <div id="main" class="mab-30">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="custom-section-title mab-30">
                                <h3 class="mb-2"><?php echo $search; ?></h3>
                            </div><!-- /section-title -->
                        </div>
                    </div><!-- /row -->
                    <div class="row search-schoolist">
                        <?php
                        foreach ($schools as $school) {
                                    $school_name = str_replace(" ", "-", $school["school_name"]);
                            ?>
                            <div class="col-lg-4 col-sm-6 home-tsw">
                                    <?php if($school['school_category_id'] == 1){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp platinum">
                                    <?php }else if($school['school_category_id'] == 2){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp premium">
                                    <?php }else if($school['school_category_id'] == 3){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp spectrum">
                                    <?php }else if($school['school_category_id'] == 4){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp trial">
                                        <?php } ?>
                                    <a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.$city.'/'. strtolower($school_name)); ?>" target="_blank">
                                        <?php if($school['school_category_id'] == 1){ ?>
                                            <div class="package-name">Platinum</div>
                                        <?php }else if($school['school_category_id'] == 2){ ?>
                                            <div class="package-name">Premium</div>
                                        <?php }else if($school['school_category_id'] == 3){ ?>
                                            <div class="package-name">Spectrum</div>
                                        <?php }else if($school['school_category_id'] == 4){ ?>
                                            <div class="package-name">Trial</div>
                                        <?php } ?>
                                        <div class="object-fit">
                                            <?php if(!empty($school["logo"])){ ?>
                                                <img src="<?php echo base_url("laravel/public/".$school["logo"]); ?>"  alt="schools nearby">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $school['affiliation_name'] ?> in <?php echo $city; ?>" />
                                            <?php } ?>     
                                        </div>
                                    </a>
                                    <div class="nearby-widget-body">
                                        <h6 class="mb-2"><a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.$city.'/'. strtolower($school_name)); ?>"><?php echo $school["school_name"]; ?></a></h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1"><i class="fa fa-fw fa-book"></i> <?php echo ucfirst($school["affiliation_name"]); ?> School</li>
                                            <li><i class="fa fa-fw fa-map-marker"></i> <?php echo $school["area_name"]; ?></li>
                                        </ul> 
                                        
                                    </div><!-- /nearby-widget-body -->
                                </div><!-- /nearby-widget -->
                            </div>
                        <?php }
                        ?>
                    </div>

                </div>
            <?php } ?>

            <?php if(!empty($activityclass)){ ?>
                <div id="main" class="mab-30">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="custom-section-title mab-30">
                                <h3 class="mb-2"><?php echo $search; ?></h3>
                            </div><!-- /section-title -->
                        </div>
                    </div><!-- /row -->
                    <div class="row search-schoolist">
                        <?php
                        foreach ($activityclass as $class) {
                                    $school_name = str_replace(" ", "-", $class["institute_name"]);
                                    $type = str_replace(" ","-",$class['category_name'])
                            ?>
                            <div class="col-lg-4 col-sm-6 home-tsw">
                                    <?php if($class['position_id'] == 1){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp platinum">
                                    <?php }else if($class['position_id'] == 2){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp premium">
                                    <?php }else if($class['position_id'] == 3){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp spectrum">
                                    <?php }else if($class['position_id'] == 4){ ?>
                                <div class="nearby-widget mab-30 wow fadeInUp trial">
                                        <?php } ?>
                                    <a href="<?php echo base_url('list-of-best-'.strtolower($type).'-in-'.$city.'/'. strtolower($school_name)); ?>" target="_blank">
                                        <?php if($class['position_id'] == 1){ ?>
                                            <div class="package-name">Platinum</div>
                                        <?php }else if($class['position_id'] == 2){ ?>
                                            <div class="package-name">Premium</div>
                                        <?php }else if($class['position_id'] == 3){ ?>
                                            <div class="package-name">Spectrum</div>
                                        <?php }else if($class['position_id'] == 4){ ?>
                                            <div class="package-name">Trial</div>
                                        <?php } ?>
                                        <div class="object-fit">
                                            <?php if(!empty($class["logo"])){ ?>
                                                <img src="<?php echo base_url("laravel/public/".$class["logo"]); ?>"  alt="schools nearby">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $class['category_name'] ?> in <?php echo $city; ?>" />
                                            <?php } ?>     
                                        </div>
                                    </a>
                                    <div class="nearby-widget-body">
                                        <h6 class="mb-2"><a href="<?php echo base_url('list-of-best-'.strtolower($type).'-in-'.$city.'/'. strtolower($school_name)); ?>"><?php echo $class["institute_name"]; ?></a></h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1"><i class="fa fa-fw fa-book"></i> <?php echo ucfirst($type); ?> School</li>
                                            <li><i class="fa fa-fw fa-map-marker"></i> <?php echo $class["area_name"]; ?></li>
                                        </ul> 
                                        
                                    </div><!-- /nearby-widget-body -->
                                </div><!-- /nearby-widget -->
                            </div>
                        <?php }
                        ?>
                    </div>

                </div>
            <?php } ?>
        <?php }else{ ?>
        <h1 style="text-align:center;">Record Not Found!</h1>
        <?php } ?>
    </div>
</div>
<?php echo $links ?>

<!-- Footer templete -->
<svg id="deco-clouds" xmlns="https://www.w3.org/2000/svg" version="1.1" style="background-color: #fff;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
<path d="M-5 100 Q 0 20 5 100 Z
      M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
      M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
      M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
      M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
      M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
</path>
</svg>

<!-- Footer templete -->
<?php $this->load->view('footer'); ?>
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