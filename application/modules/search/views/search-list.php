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
<?php 
// print_r($_GET['searchcity']);
    if(!empty($_GET['searchcity'])){
        $searchcity = $_GET['searchcity'];
    }else{
        $searchcity = $this->session->userdata('search_city');
    }
?>
<div class="breadrumb-new mab-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 home-search-widget">
                <div>
                    <form action="<?php echo base_url() ?>schools-list" method="get">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <?php if ($searchcity != "") { ?>
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <?php echo (empty($searchcity) ? "select your city" : $searchcity ); ?> <i class="fa fa-angle-down"></i>  </button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="lnr lnr-map-marker"></i> <?php echo (empty($searchcity) ? "select your city" : $searchcity ); ?><span id="uccity"></span> <i class="fa fa-angle-down"></i>  </button>
                                <?php } ?> 
                                <div class="dropdown-menu shadow-lg">
                                    <ul class="list-inline">
                                        <?php
                                        foreach ($allcity as $allcitys) {
                                            $lowercity = strtolower($allcitys->city_name);
                                            // $lowercity = $allcitys->city_name;
                                            ?>

                                            <li class="list-inline-item"><a href="<?php echo base_url() ?>schools-list?searchcity=<?php echo $lowercity ?>"><i class="fa fa-angle-right"></i> <?php echo $allcitys->city_name; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div><!-- /dropdown-menu -->
                            </div>
                            <input type="text" id="search_school" class="form-control search_filter"  name="search" placeholder="Search school" aria-label="" aria-describedby="button-addon2">
                            <div class="search-list"><ul id="suggesstion-box"></ul></div>
                            <?php if ($searchcity != "") { ?>
                                <input type="hidden" style="display:none"  class="form-control"  name="searchcity" value="<?php echo $searchcity; ?>" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                            <?php } else { ?>
                                <input type="hidden" style="display:none" id="searchcity" class="form-control"  name="searchcity" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                            <?php } ?>
                            <!-- <div id="map"></div> -->
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary search_filter_button" type="submit" ><i class="fa fa-search"></i></button>
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
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-<?php echo strtolower($searchcity) ?>" id="<?php echo $row->id; ?>"><i class="fa fa-circle"></i> <?php echo $affiliation_name1; ?> Schools</a>
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
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-<?php echo strtolower($searchcity) ?>" id="<?php echo $row1->id; ?>"><i class="fa fa-circle"></i> <?php echo $category_name1; ?></a>
                            </li>    
                        <?php } ?>
                        <!-- /Activity Classes -->
                    </ul>
                </div><!-- /sidebar-categories -->
            </div><!-- /sticky -->
        </div><!-- /sidebar -->
        <?php 
        $session = $this->session->userdata();
        $where = "sd.is_active=1 AND sd.status=1 AND sd.expiry_status !=1 AND sd.valitity IS NOT NULL AND sd.deleted_at is NULL ";
        $this->db->select('sd.*,af.affiliation_name,ar.area_name');
        if(!empty($session['city_id']))
        $this->db->where('sd.city_id',$session['city_id']);
        if(!empty($session['search_city']))
        $this->db->where('ci.city_name',ucfirst($session['search_city']));
        $this->db->where($where);
        $this->db->like('sd.school_name',$search_school);
        $this->db->order_by('school_category_id');
        $this->db->from('school_details as sd');
        $this->db->join('cities as ci','sd.city_id=ci.id','left');
        $this->db->join('affiliations as af','sd.affiliation_id=af.id','left');
        $this->db->join('areas as ar','sd.area_id=ar.id','left');
        $total_school_count = $this->db->get()->num_rows();

        $session = $this->session->userdata();
        $where = "ind.is_active=1 AND ind.status=1 AND ind.expiry_status !=1 AND ind.valitity IS NOT NULL AND ind.deleted_at is NULL ";
        $this->db->select('ind.*,ic.category_name,ar.area_name');
        if(!empty($session['city_id']))
        $this->db->where('ind.city_id',$session['city_id']);
        $this->db->where($where);
        $this->db->like('ind.institute_name',$search_class);
        $this->db->order_by('position_id');
        $this->db->from('institute_details as ind');
        $this->db->join('institute_categories as ic','ind.category_id=ic.id','left');
        $this->db->join('areas as ar','ind.area_id=ar.id','left');
        $this->db->limit($page,$limit);
        $total_class_count = $this->db->get()->num_rows();
        ?>
        <input type="hidden" name="search_school" id="get_school_search" value="<?php echo $search_school; ?>">
        <input type="hidden" name="search_class" id="get_class_search" value="<?php echo $search_class; ?>">
        <input type="hidden" name="search_class" id="total_school_count" value="<?php echo $total_school_count; ?>">
        <input type="hidden" name="search_class" id="total_class_count" value="<?php echo $total_class_count; ?>">
        <input type="hidden" name="school_search_current_count" id="school_search_current_count" value="<?php echo count($schools); ?>">
        <input type="hidden" name="class_search_current_count" id="class_search_current_count" value="<?php echo count($activityclass); ?>">
        <input type="hidden" name="get_city_name" id="get_city_name" value="<?php echo strtolower($city); ?>">
        <input type="hidden" name="school_spectrum_data_exists" id="school_spectrum_data_exists" value="<?php echo (count($schools) < 12) ? 0 : 1;?>">
        <input type="hidden" name="class_search_data_exists" id="class_search_data_exists" value="<?php echo (count($activityclass) < 12) ? 0 : 1;?>">
        <input type="hidden" id="image_status" value=""/>
        <input type="hidden" id="ajax_call" value="0"/>

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
                                    <a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.strtolower($city).'/'. strtolower($school_name)); ?>" target="_blank">
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
                                            <?php if(file_exists(FCPATH.'laravel/public/'.$school['logo']) && !empty($school['logo'])){ ?>
                                                <img src="<?php echo base_url("laravel/public/".$school["logo"]); ?>">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $school['affiliation_name'] ?> in <?php echo $city; ?>" />
                                            <?php } ?>     
                                        </div>
                                    </a>
                                    <div class="nearby-widget-body">
                                        <h6 class="mb-2"><a href="<?php echo base_url('list-of-best-'.$school["affiliation_name"].'-schools-in-'.strtolower($city).'/'. strtolower($school_name)); ?>"><?php echo $school["school_name"]; ?></a></h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1"><i class="fa fa-fw fa-book"></i> <?php echo ucfirst($school["affiliation_name"]); ?> School</li>
                                            <li><i class="fa fa-fw fa-map-marker"></i> <?php echo $school["area_name"]; ?></li>
                                        </ul> 
                                        
                                    </div><!-- /nearby-widget-body -->
                                </div><!-- /nearby-widget -->
                            </div>
                        <?php }
                        ?>
                        <!-- <div class="custom-pagination pagination"><?php echo $links ?></div> -->
                    </div>
                    <div class="scroll_school"></div>
                    <div class="loading" id="loading"></div>                                    
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
                                            <?php if(file_exists(FCPATH.'laravel/public/'.$class["logo"]) && !empty($class["logo"])){ ?>
                                                <img src="<?php echo base_url("laravel/public/".$class["logo"]); ?>"  alt="schools nearby">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $class['category_name'] ?> in <?php echo $city; ?>" />
                                            <?php } ?>     
                                        </div>
                                    </a>
                                    <div class="nearby-widget-body">
                                        <h6 class="mb-2"><a href="<?php echo base_url('list-of-best-'.strtolower($type).'-in-'.strtolower($city).'/'. strtolower($school_name)); ?>"><?php echo $class["institute_name"]; ?></a></h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-1"><i class="fa fa-fw fa-book"></i> <?php echo ucfirst($type); ?> School</li>
                                            <li><i class="fa fa-fw fa-map-marker"></i> <?php echo $class["area_name"]; ?></li>
                                        </ul> 
                                        
                                    </div><!-- /nearby-widget-body -->
                                </div><!-- /nearby-widget -->
                            </div>
                        <?php }
                        ?>
                        <!-- <div class="custom-pagination pagination"><?php echo $links ?></div> -->
                    </div>
                    <div class="scroll_class"></div>
                    <div class="loading" id="loading"></div>

                </div>
            <?php } ?>
        <?php }else{ ?>
            <div id="main" class="no-data-list">
                <div class="home-tsw top-school-widget top-school-sigle mab-30">
                    <div class="custom-section-title mab-10">
                        <h3 class="mb-2">Exclusive <?php echo $search; ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data-single.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="home-tsw top-school-widget mab-30">
                    <div class="custom-section-title mab-10">
                        <h3 class="mb-2">Top <?php echo $search; ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="schoolist-inner mab-20">
                    <div class="custom-section-title mab-10">
                        <h3 class="mb-2">Best <?php echo $search; ?></h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="wow bounceIn no-data-img" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>schools-signup">
                                    <figure>
                                        <div class="object-fit">
                                            <img src="<?php echo base_url() ?>assets/front/images/no-data.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        </div>
                                    </figure>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

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

    // $(function () { //document ready
    //     if ($('#sticky').length) { //make sure "#sticky" elements exists
    //         var el = $('#sticky');
    //         var stickyTop = $('#sticky').offset().top; //returns number
    //         var stickyHeight = $('#sticky').height();

    //         $(window).scroll(function () { //Scroll event
    //             var limit = $('#footer').offset().top - stickyHeight - 30;

    //             var windowTop = $(window).scrollTop(); //returns number

    //             if (stickyTop < windowTop) {
    //                 el.css({
    //                     position: 'fixed',
    //                     top: 0,
    //                     bottom: '50px'
    //                 });
    //             } else {
    //                 el.css('position', 'static');
    //             }

    //             if (limit < windowTop) {
    //                 var diff = limit - windowTop;
    //                 el.css({
    //                     top: diff
    //                 });
    //             }
    //         });
    //     }
    // });

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
    $(document).ready(function(){
        $("#search_school").keyup(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>welcome/search_school",
                data:'keyword='+$(this).val(),
                beforeSend: function(){
                    $("#search_school").css("background","#FFF");
                },
                success: function(data){
                    data = JSON.parse(data);
                    var html = '';
                    $.each(data, function(key,val) {
                        html += '<li onClick="selectSchool(`'+val['school_name']+'`)">'+val['school_name']+'</li>';
                    });
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(html);
                        $("#search_school").css("background","#FFF");
                }
            });
        });
    });
    //To select country name
    function selectSchool(val) {
        $("#search_school").val(val);
        $("#suggesstion-box").hide();
    } 
    $('body').on('click','.search_filter_button',function(e){ 
        e.preventDefault(); 
        if($(this).closest('form').find('.search_filter').val() == ''){
        $(this).closest('form').find('.search_filter').addClass('search-err');
            return 
        }else{
            $(this).closest('form').submit();
        }
    });

    $('body').on('keyup','.search_filter',function(e){ 
        e.preventDefault(); 
        if($(this).val() == ''){
        $(this).addClass('search-err');
            return 
        }else{
            $(this).removeClass('search-err');
        }
    });
    $(document).ready(function(){
        var SITEURL = "<?php echo base_url(); ?>";
        var isDataLoading = true;
        var isLoading = false;
        //search school autoload
        if($('#get_school_search').val() != ''){
            $(window).scroll(function () {
                var search = $('#get_school_search').val();
                var page = $('#school_search_current_count').val();
                var data_exists = $('#school_spectrum_data_exists').val();
                var ajax_call = $('#ajax_call').val();
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                    if (isLoading == false) {
                        isLoading = true;
                        if (isDataLoading && data_exists == 1 && ajax_call == 0) {
                            load_more(page,search);
                            $('.loading').html("<div class='preloader'><span></span><span></span><span></span><span></span><span></span></div>");
                        }
                    }
                }
            });
        }
        

        function load_more(page,search) {
            // var affiliation = $('#affiliation').val();
            // var yourcity_id = $('#yourcity_id').val();
            var page = page;
            var search = search;
            // var affname = $('#AffiliationName').val();
            // var city = $('#YourCity').val();
            $.ajax({
                url: SITEURL+"search/autoload_school",
                type: "POST",
                data: {page:page,search:search},
                // dataType: "html",
            }).done(function (data) {
                isLoading = false;
                if (data.length == 0) {
                    isDataLoading = false;
                    // $('#loader').hide();
                    return;
                }
                data = $.parseJSON(data);
                console.log(data);
                var city = $('#get_city_name').val();
                var school = '';
                    
                school += '<div class="row search-schoolist">';
                $.each(data, function(index,value) {
                    $.ajax({
                    url:SITEURL+'laravel/public/'+value.logo,
                    type:'HEAD',
                    async: false,
                    error: function(msg)
                    {
                            $('#image_status').val("Not Found");
                    },
                    success: function(msg)
                    {
                        $('#image_status').val("Found");
                    }
                });
                    schoolname = value.school_name.toLowerCase();
                    school += '<div class="col-lg-4 col-sm-6 home-tsw">';
                    if(value.school_category_id == 1){
                        school +='<div class="nearby-widget mab-30 wow fadeInUp platinum">';
                    }
                    if(value.school_category_id == 2){
                        school +='<div class="nearby-widget mab-30 wow fadeInUp premium">';
                    }
                    if(value.school_category_id == 3){
                        school +='<div class="nearby-widget mab-30 wow fadeInUp spectrum">';
                    }
                    if(value.school_category_id == 4){
                        school +='<div class="nearby-widget mab-30 wow fadeInUp trial">';
                    }
                    school += '<a href='+SITEURL+'list-of-best-'+value.affiliation_name+'-schools-in-'+city+'/'+schoolname.replace(/\s/g,"-")+' target="_blank">';
                    if(value.school_category_id == 1){
                        school += '<div class="package-name">Platinum</div>';
                    }
                    if(value.school_category_id == 2){
                        school += '<div class="package-name">Premium</div>';
                    }
                    if(value.school_category_id == 3){
                        school += '<div class="package-name">Spectrum</div>';
                    }
                    if(value.school_category_id == 4){
                        school += '<div class="package-name">Trial</div>';
                    }
                    school += '<div class="object-fit">';
                    if($('#image_status').val() == "Not Found"){
                        school += '<img src="'+SITEURL+'assets/front/images/list-default.png" class="w-100" " />';
                    }
                    if($('#image_status').val() == "Found"){
                        school += '<img src="'+SITEURL+'laravel/public/'+value.logo+'">';
                    } 
                    school += '<div>';
                    school +='</a>';
                    school += '<div class="nearby-widget-body">';
                    school += '<h6 class="mb-2"><a href="'+SITEURL+'list-of-best-'+value.affiliation_name+'-schools-in-'+city+'/'+schoolname.replace(/\s/g,"-")+'">'+value.school_name+'</a></h6>';
                    school += '<ul class="list-unstyled">';
                    school += '<li class="mb-1"><i class="fa fa-fw fa-book"></i> '+value.affiliation_name+' School</li>';
                    school += '<li><i class="fa fa-fw fa-map-marker"></i> '+value.area_name+'</li>';
                    school += '</ul> ';
                    school += '</div>';
                    school += '</div>';
                    school += '</div>';
                    school += '</div>';
                    school += '</div>';
                })
                school += '</div>';
                $('.scroll_school').html(school);
                var current_length = parseInt(data.length) + 12;
                $('#school_search_current_count').val(current_length);
                if($('#total_school_count').val() == current_length){
                    $('.loading').hide();
                    $('#ajax_call').val('1');
                }
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('No response');
            });
        }

        //search class autoload
        if($('#get_class_search').val() != ''){
            $(window).scroll(function () {
                var search = $('#get_class_search').val();
                var page = $('#class_search_current_count').val();
                var data_exists = $('#class_search_data_exists').val();
                var ajax_call = $('#ajax_call').val();
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
                    if (isLoading == false) {
                        isLoading = true;
                        if (isDataLoading && data_exists == 1 && ajax_call==0) {
                            load_more_class(page,search);
                            $('.loading').html("<div class='preloader'><span></span><span></span><span></span><span></span><span></span></div>");
                        }
                    }
                }
            });
        }

        function load_more_class(page,search) {
            // var affiliation = $('#affiliation').val();
            // var yourcity_id = $('#yourcity_id').val();
            var page = page;
            var search = search;
            // var affname = $('#AffiliationName').val();
            // var city = $('#YourCity').val();
            $.ajax({
                url: SITEURL+"search/autoload_class",
                type: "POST",
                data: {page:page,search:search},
                // dataType: "html",
            }).done(function (data) {
                isLoading = false;
                if (data.length == 0) {
                    isDataLoading = false;
                    // $('#loader').hide();
                    return;
                }
                data = $.parseJSON(data);
                var city = $('#get_city_name').val();
                var school = '';
                    
                school += '<div class="row search-schoolist">';
                        $.each(data, function(index,value) {
                            $.ajax({
                                url:SITEURL+'laravel/public/'+value.logo,
                                type:'HEAD',
                                async: false,
                                error: function(msg)
                                {
                                        $('#image_status').val("Not Found");
                                },
                                success: function(msg)
                                {
                                    $('#image_status').val("Found");
                                }
                            });
                        institutename = value.institute_name.toLowerCase();
                        category_name = value.category_name.toLowerCase();
                        school += '<div class="col-lg-4 col-sm-6 home-tsw">';
                            if(value.position_id == 1){
                                school +='<div class="nearby-widget mab-30 wow fadeInUp platinum">';
                            }
                            if(value.position_id == 2){
                                school +='<div class="nearby-widget mab-30 wow fadeInUp premium">';
                            }
                            if(value.position_id == 3){
                                school +='<div class="nearby-widget mab-30 wow fadeInUp spectrum">';
                            }
                            if(value.position_id == 4){
                                school +='<div class="nearby-widget mab-30 wow fadeInUp trial">';
                            }
                                school += '<a href='+SITEURL+'list-of-best-'+category_name.replace(" ","-")+'-in-'+city+'/'+institutename.replace(/\s/g,"-")+' target="_blank">';
                                    if(value.position_id == 1){
                                        school += '<div class="package-name">Platinum</div>';
                                    }
                                    if(value.position_id == 2){
                                        school += '<div class="package-name">Premium</div>';
                                    }
                                    if(value.position_id == 3){
                                        school += '<div class="package-name">Spectrum</div>';
                                    }
                                    if(value.position_id == 4){
                                        school += '<div class="package-name">Trial</div>';
                                    }
                                    school += '<div class="object-fit">';
                                    if($('#image_status').val() == "Not Found"){
                                        school += '<img src="'+SITEURL+'assets/front/images/list-default.png" class="w-100" " />';
                                    }
                                    if($('#image_status').val() == "Found"){
                                        school += '<img src="'+SITEURL+'laravel/public/'+value.logo+'">';
                                    }
                                    school += '</div>';
                                school +='</a>';
                                school += '<div class="nearby-widget-body">';
                                    school += '<h6 class="mb-2"><a href="'+SITEURL+'list-of-best-'+category_name.replace(" ","-")+'-in-'+city+'/'+institutename.replace(/\s/g,"-")+'">'+value.institute_name+'</a></h6>';
                                    school += '<ul class="list-unstyled">';
                                        school += '<li class="mb-1"><i class="fa fa-fw fa-book"></i> '+value.category_name+' School</li>';
                                        school += '<li><i class="fa fa-fw fa-map-marker"></i> '+value.area_name+'</li>';
                                school += '</ul> ';
                            school += '</div>';
                            school += '</div>';
                        school += '</div>';
                    })
                school += '</div>';
                $('.scroll_class').html(school);
                var current_length = parseInt(data.length) + 12;
                $('#class_search_current_count').val(current_length);
                if($('#total_class_count').val() == current_length){
                    $('.loading').hide();
                    $('#ajax_call').val('1');
                }
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('No response');
            });
        }
    })
</script>