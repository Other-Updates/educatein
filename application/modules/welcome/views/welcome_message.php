<?php
$yourcity = array();
$aff_url = end($this->uri->segments);
$yourcity = explode("-", $aff_url);
$yourcity = $this->session->userdata("search_city");
$uccity = ucfirst($yourcity);
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
    <!-- <div class="summercamp-popup wow bounceIn faster">
        <a href="<?php echo base_url(); ?>list-of-best-summer-camp-in-<?php echo $city; ?>">
            <img src="<?php echo base_url() ?>assets/front/images/summer-camp.png" width="180" alt="summer-camp">
        </a>
    </div> -->
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
                <div class="modal-body"> 
                    <div class="d-flex flex-wrap">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="select-city-tit">Select City</div>
                                <div class="select-city-icon"><img src="<?php echo base_url() ?>assets/front/images/select_city.gif" alt="best kindergarten schools in <?php echo $city; ?>" /></div>
                            </div>
                            <?php
                            foreach ($allcity as $allcitys) {
                                $lowercity = strtolower($allcitys->city_name);
                                ?>
                                <div class="col-12 col-md-4"><div class="city-list"><a href="<?php echo base_url() ?>list-of-best-schools-in-<?php echo $lowercity; ?>"><i class="lnr lnr-map-marker"></i> <?php echo $allcitys->city_name; ?></a></div></div>                               
                            <?php } ?> 
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div><!-- /popup -->
</div><!-- /popup -->
<div class="home-search-section">
    <div class="home-search-section-bg"></div>
    <div class="hss-inner">
        <div class="hss-tit">Over 100+ inter-connect schools with Edugate-in.</div>
        <div class="hss-subtit">Parents and education community on a single platform to create mutual benefit</div>
        <div class="home-search-widget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form action="<?php echo base_url() ?>schools-list" id="school_search_form" method="get">
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
                                        <?php if ($searchcity != "") { ?>
                                            <input type="hidden" style="display:none"  class="form-control"  name="searchcity" value="<?php echo ucfirst($searchcity); ?>" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                                        <?php } else { ?>
                                            <input type="hidden" style="display:none" id="searchcity" class="form-control"  name="searchcity" placeholder="Search..." aria-label="" aria-describedby="button-addon2" required>                                    
                                        <?php } ?>
                                        <input type="text" id="search_school" class="form-control"  name="search" placeholder="Search..." aria-label="" aria-describedby="button-addon2">
                                        <div class="search-list"><ul id="suggesstion-box"></ul></div>
                                        
                                        <!-- <div id="map"></div> -->
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" id="search_school_submit" type="submit" ><i class="fa fa-search"></i></button>
                                        </div>
                                    </div><!-- /input-group -->
                                </form>
                            </div>
                            <div class="col-lg-2">
                                <div class="hss-activity-link wow bounceIn faster">
                                    <a href="<?php echo base_url(); ?>list-of-best-summer-camp-in-<?php echo strtolower($city); ?>">
                                        <img src="<?php echo base_url(); ?>assets/front/images/summer-camp.png" class="w-100" alt="best schools in <?php echo $city; ?>" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
            </div><!-- /container -->
        </div><!-- /home-search-widget -->
        <div class="schools-section mat-30">
            <div class="container chools-section-inner">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <div class="hss-school">
                            <a href="<?php echo base_url() ?>list-of-best-kindergarten-schools-in-<?php echo strtolower($city); ?>" >
                                <figure class="snip1571 wow bounceIn anim1s hss-school-left">
                                    <div class="object-fit">
                                        <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    </div><!-- /object-fit -->
                                    <figcaption>
                                        <h1><a href="<?php echo base_url() ?>list-of-best-kindergarten-schools-in-<?php echo strtolower($city); ?>" >Kindergarten Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 pl-0">
                        <div class="hss-school">
                            <a href="<?php echo base_url() ?>list-of-best-cbse-schools-in-<?php echo strtolower($city); ?>" >
                                <figure class="snip1571 wow bounceIn anim2s hss-school-right">
                                    <div class="object-fit">
                                        <img src="<?php echo base_url(); ?>assets/front/images/cbse_1.jpg" class="w-100" alt="best cbse schools in <?php echo $city; ?>" />
                                    </div><!-- /object-fit -->
                                    <figcaption>
                                        <h1 style="font-size: 20px;"><a href="<?php echo base_url() ?>list-of-best-cbse-schools-in-<?php echo strtolower($city); ?>" >CBSE Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                        <div class="hss-school">
                            <a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo strtolower($city); ?>" >
                                <figure class="snip1571 wow bounceIn anim4s hss-school-right">
                                    <div class="object-fit">
                                        <img src="<?php echo base_url() ?>assets/front/images/matric_1.jpg" class="w-100" alt="matriculation schools in <?php echo $city; ?>"/>
                                    </div>
                                    <figcaption>
                                        <h1><a href="<?php echo base_url() ?>list-of-best-matriculation-schools-in-<?php echo strtolower($city); ?>" >Matriculation Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 pl-0">
                        <div class="hss-school">
                            <a href="<?php echo base_url() ?>list-of-best-international-schools-in-<?php echo strtolower($city); ?>" >
                                <figure class="snip1571 wow bounceIn anim3s hss-school-right">
                                    <div class="object-fit">
                                        <img src="<?php echo base_url() ?>assets/front/images/inter_1.jpg" class="w-100" alt="best international schools in <?php echo $city; ?>"/>
                                    </div>
                                    <figcaption>
                                        <h1 style="font-size: 20px;"><a href="<?php echo base_url() ?>list-of-best-international-schools-in-<?php echo strtolower($city) ?>" >International Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                        <div class="hss-school">
                            <a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo strtolower($city); ?>" >
                                <figure class="snip1571 wow bounceIn anim5s hss-school-right">
                                    <div class="object-fit">
                                        <img src="<?php echo base_url() ?>assets/front/images/state_1.jpg" class="w-100" alt="best state board schools in <?php echo $city; ?>"/>
                                    </div>
                                    <figcaption>
                                        <h1><a href="<?php echo base_url() ?>list-of-best-special-schools-in-<?php echo strtolower($city); ?>" >Special Schools</a></h1>
                                    </figcaption>
                                </figure><!-- /snip1571 -->
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /container -->
        </div><!-- /schools-section -->
    </div>
</div>   
<?php //if(!empty($platinum_data)){ ?>
    <!-- <div class="container">
        <div class="custom-section-title">
            <h3 class="mb-2">Top Schools in <span><?php echo ucfirst($city) ?></span></h3>
        </div>
        <div class="home-tsw top-school-widget mab-30">
            <div class="owl-one owl-carousel owl-theme">
                <?php foreach($platinum_data as $key=>$platinum){ ?>
                <div class="item wow bounceIn platinum" style="animation-delay: .<?php echo $delay; ?>s;">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $platinum['affiliation_name'] ?>-schools-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$platinum['schoolname']); ?>" target="_blank">
                        <figure>
                            <div class="package-name">Platinum</div>
                            <div class="object-fit">
                                <?php if(!empty($platinum['banner'])){ ?>
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $platinum['banner'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                <?php } ?>
                            </div>
                            <figcaption class="item-footer">
                                <h6><?php echo ucfirst($platinum['schoolname']) ?></h6>
                                <p><i class="fa fa-book"></i>&nbsp;<?php echo ucfirst($platinum['affiliation_name']).' School' ?></p>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div> -->
<?php //} ?>
<?php //if(!empty($activity_platinum)){ ?>
    <!-- <div class="container">
        <div class="custom-section-title">
            <h3 class="mb-2">Top Activity Classes in <span><?php echo ucfirst($city) ?></span></h3>
        </div>
        <div class="home-tsw top-school-widget mab-50">
            <div class="owl-one owl-carousel owl-theme">
                <?php foreach($activity_platinum as $platinum){ 
                $type = str_replace(" ","-",$platinum['type']);
                $type = strtolower($type);
                ?>
                <div class="item wow bounceIn platinum" style="animation-delay: .<?php echo $delay; ?>s;">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $type ?>-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$platinum['institute_name']); ?>" target="_blank">
                        <figure>
                            <div class="package-name">Platinum</div>
                            <div class="object-fit">
                                <?php if(!empty($platinum['logo'])){ ?>
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $platinum['logo'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                <?php } ?>
                            </div>
                            <figcaption class="item-footer">
                                <h6><?php echo ucfirst($platinum['institute_name']) ?></h6>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div> -->
<?php //} ?>
<div class="container">
    <div class="ads-school-widget mab-30">
        <div class="row">
            <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/1-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/2-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/3-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
        </div>
    </div>
</div>
<?php //if(!empty($premium_data) || !empty($spectrum_data)){ ?>

    <!-- <div class="container">
        <div class="custom-section-title">
            <h3 class="mb-2">Best Schools in <span><?php echo ucfirst($city) ?></span></h3>
        </div>
        <div class="home-tsw top-school-widget mab-50">
            <div class="owl-two owl-carousel owl-theme"> -->
                <?php //foreach($premium_data as $key=>$premium){ ?>
                <!-- <div class="item wow bounceIn premium" style="animation-delay: .<?php echo $delay; ?>s;">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $premium['affiliation_name'] ?>-schools-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$premium['schoolname']); ?>" target="_blank">
                        <figure>
                            <div class="package-name">Premium</div>
                            <div class="object-fit">
                                <?php if(!empty($premium['banner'])){ ?>
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $premium['banner'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        <?php } else { ?>
                                    <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    <?php } ?>
                            </div>
                            <figcaption class="item-footer">
                                <h6><?php echo ucfirst($premium['schoolname']) ?></h6>
                                <p><i class="fa fa-book"></i>&nbsp;<?php echo ucfirst($premium['affiliation_name']).' School' ?></p>
                            </figcaption>

                        </figure>
                    </a>
                </div> -->
                <?php //} ?>
                <?php //foreach($spectrum_data as $spectrum){ ?>
                    <!-- <div class="item wow bounceIn spectrum" style="animation-delay: .<?php echo $delay; ?>s;">
                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $spectrum['affiliation_name'] ?>-schools-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$spectrum['schoolname']); ?>" target="_blank">
                            <figure>
                                <div class="package-name">Spectrum</div>
                                <div class="object-fit">
                                <?php if(!empty($spectrum['banner'])){ ?>
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $spectrum['banner'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                            <?php } else { ?>
                                        <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        <?php } ?>
                                </div>
                                <figcaption class="item-footer">
                                    <h6><?php echo ucfirst($spectrum['schoolname'])?></h6>
                                    <p><i class="fa fa-book"></i>&nbsp;<?php echo ucfirst($spectrum['affiliation_name']).' School' ?></p>
                                </figcaption>
                            </figure>
                        </a>
                    </div> -->
                <?php //} ?>
            </div>
        </div>
    </div>
    <?php//} ?>
   
<?php// if(!empty($activity_premium) || !empty($activity_spectrum)){ ?>
    <!-- <div class="container">
        <div class="custom-section-title">
            <h3 class="mb-2">Best Activity Classes in <span><?php echo ucfirst($city) ?></span></h3>
        </div>
        <div class="home-tsw top-school-widget mab-50">
            <div class="owl-two owl-carousel owl-theme"> -->
                <?php// foreach($activity_premium as $premium){ 
                // $type = str_replace(" ","-",$premium['type']);
                // $type = strtolower($type);    
                ?>
                <!-- <div class="item wow bounceIn premium" style="animation-delay: .<?php echo $delay; ?>s;">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $type ?>-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$premium['institute_name']); ?>" target="_blank">
                        <figure>
                            <div class="package-name">Premium</div>
                            <div class="object-fit">
                                <?php if(!empty($premium['logo'])){ ?>
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $premium['logo'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        <?php } else { ?>
                                    <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    <?php } ?>
                            </div>
                            <figcaption class="item-footer">
                                <h6><?php echo ucfirst($premium['institute_name']) ?></h6>
                            </figcaption>

                        </figure>
                    </a>
                </div> -->
                <?php// } ?>
                <?php //foreach($activity_spectrum as $spectrum){
                    //  $type = str_replace(" ","-",$spectrum['type']);
                    //  $type = strtolower($type);
                ?>
                <!-- <div class="item wow bounceIn spectrum" style="animation-delay: .<?php echo $delay; ?>s;">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $type ?>-in-<?php echo $city; ?>/<?php echo str_replace(" ","-",$spectrum['institute_name']); ?>" target="_blank">
                        <figure>
                            <div class="package-name">Spectrum</div>
                            <div class="object-fit">
                            <?php if(!empty($spectrum['logo'])){ ?>
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $spectrum['logo'] ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                        <?php } else { ?>
                                    <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                    <?php } ?>
                            </div>
                            <figcaption class="item-footer">
                                <h6><?php echo ucfirst($spectrum['institute_name'])?></h6>
                            </figcaption>
                        </figure>
                    </a>
                </div> -->
                <?php// } ?>
            </div>
        </div>
    </div>
<?php //} ?>
<div class="container">
    <div class="about-widget mab-30">
        <div class="row">
            <div class="col-md-5"><img src="<?php echo base_url() ?>assets/front/images/home-abouts-img.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" /></div>
            <div class="col-md-7">
                <div class="about-widget-text">
                    <h3>Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit.</h3>
                    <p>Edugatein offer a detailed and well-researched guide about schools type, curriculum, facilities, activity classes, contact details and location through map. This information is directly from school management. In particular, we allocate the separate page for the schools in all over tamilnadu to provide the details of the school. By this information parents can choose schools in efficient manner and school management also gives all their unique information.</p>
                    <p>If you are looking for the best schools in coimbatore, We have Top and Best schools lists are available here and also to find the best CBSE, International, Matriculation, State Board and Kindergarten in the right place. Our goal is to develop creative skills and extra-curricular activities such as sports, dance, music, swimming, yoga and much more.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="ads-school-widget-bottom mab-30">
        <div class="row">
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/4-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/5-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/6-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/4-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/7-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            <div class="col-md-2"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/8-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>            
        </div>
    </div>
</div>
 
    
 
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
    $(document).ready(function () {
        $(".owl-one").owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:true,
                    loop:false
                }
            }
        });
        $('.owl-two').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:5,
                    nav:true,
                    loop:false
                }
            }
        })
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
$(document).ready(function(){
    // $("#search_school_submit").on('click',function (event) {
    //     event.preventDefault();
    //     $("#school_search_form").validate({
    //         rules: {
    //             search: "required",
    //             },
    //             // messages: {
    //             //     search: "required"
    //             // },
    //             errorElement: 'div',
    //             errorLabelContainer: '.errorTxt',
    //             errorPlacement: function (error, element) {
    
    //                     element.parents('.form-group').append(error);
    //             }
    //     });
    // });
});
</script>
<!-- <script src="<?php echo base_url('assets/admin/js/jquery.validate.min.js'); ?>" ></script>   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
</script> 
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>






