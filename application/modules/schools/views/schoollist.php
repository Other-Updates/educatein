<?php
// $this->db->select('*')->where('id =', 1);
// $this->db->from('careers');
// $career = $this->db->get();
// foreach($career->result() as $careers){
//    $file = $careers->file; 
//        echo $file;
//        exit();
// }
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
// exit();
// $aff_url = str_replace("-schools-in-coimbatore","",$aff_url);
// $aff_url = str_replace("-schools-in-tiruppur","",$aff_url);
// $aff_url = str_replace("-schools-in-karur","",$aff_url);
// $aff_url = str_replace("-schools-in-namakkal","",$aff_url);
// $aff_url = str_replace("-schools-in-ooty","",$aff_url);
// $aff_url = str_replace("-schools-in-salem","",$aff_url);
// $aff_url = str_replace("-schools-in-erode","",$aff_url);
// $aff_url = str_replace("-schools-in-madurai","",$aff_url);
// $aff_url = str_replace("-in-coimbatore","",$aff_url);
// $aff_url = str_replace("-in-tiruppur","",$aff_url);
// $aff_url = str_replace("-in-karur","",$aff_url);
// $aff_url = str_replace("-in-namakkal","",$aff_url);
// $aff_url = str_replace("-in-ooty","",$aff_url);
// $aff_url = str_replace("-in-salem","",$aff_url);
// $aff_url = str_replace("-in-erode","",$aff_url);
// $aff_url = str_replace("-in-madurai","",$aff_url);

$aff_url = str_replace("list-of-best-", "", $aff_url);

if ($aff_url == "enquiry" || $aff_url == "otp") {
    $aff_url = "cbse";
}

$aff_url1 = str_replace("-", " ", $aff_url);
$aff_url2 = ucwords($aff_url1);
if ($aff_url1 === "state board schools") {
    $aff_url1 = "state board schools";
}



if ($aff_url2 === "State board Schools") {
    $aff_url2 = "State Board Schools";
}
//echo $aff_url;
//exit();
?>	
<?php
// echo $aff_url;
// exit();
if ($aff_url == "cbse") {
    ?>
    <meta name="description" content='Get all the details about list of top and best cbse schools in <?php echo $yourcity; ?> that is necessary before choosing the right school.'>  
    <title>Best CBSE Schools in <?php echo ucfirst($yourcity); ?> - Best CBSE Affiliated Schools – Edugatein</title>
    <?php
} elseif ($aff_url == "international") {
    ?>
    <meta name="description" content="Looking for top and best international schools in <?php echo $yourcity; ?>? check Phone Numbers, Address, Reviews, Photos, Maps at any time on Edugatein.">      
    <title>Top International Schools in <?php echo ucfirst($yourcity); ?> - Best International boarding Schools – Edugatein</title>    
    <?php
} elseif ($aff_url == "matriculation") {
    ?>
    <meta name="description" content="Find list of best matriculation higher secondary schools in <?php echo $yourcity; ?> with contact details at Edugatein.">
    <title>Best Matriculation Schools in <?php echo ucfirst($yourcity); ?> - Matric Higher Secondary Schools – Edugatein</title>
    <?php
} elseif ($aff_url == "special") {
    ?>
    <meta name="description" content="Looking for top and best special schools in <?php echo $yourcity; ?>? Get it now the details about schools for mentally challenged, schools for Leraning Diabled, schools for physically challenged in <?php echo $yourcity; ?>. Get contact addresses, Phone Numbers, ratings, reviews on Edugatein.">
    <title>Best Special Schools in <?php echo ucfirst($yourcity); ?> - Best Schools For Special Children - Edugatein</title>
    <?php
} elseif ($aff_url == "kindergarten") {
    ?>
    <meta name="description" content="Find list of best Kindergarten Schools in <?php echo $yourcity; ?>. Get Phone Numbers, Address, Reviews, Photos, Maps for top Play Schools near me and more in <?php echo $yourcity; ?> at Edugatein.">
    <title>Best Kindergarten schools in <?php echo ucfirst($yourcity); ?> - Best Pre Primary Schools – Edugatein</title>
    <?php
}
?>       
<link rel="canonical" href="<?php echo base_url("list-of-best-" . $aff_url1 . "-schools-in-" . $yourcity); ?>" >
<meta property="og:title" content="List of Best <?php echo $aff_url2; ?> Schools in <?php echo $yourcity; ?> | Top <?php echo $aff_url2; ?> Schools | Edugatein">
<meta property="og:description" content=" Edugatein provides list of top and best <?php echo $aff_url2; ?> schools in <?php echo $yourcity; ?>. Find the school location details, admission procedure and facilities. Select the best <?php echo $aff_url1; ?> schools for your children with our listings" >
<meta property="og:url" content="<?php echo base_url('list-of-best-' . $aff_url1 . '-schools-in-' . $yourcity); ?>">

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
$aff_url = str_replace("-", " ", $aff_url);
if ($aff_url == "enquiry" || $aff_url == "otp") {
    $aff_url = "cbse";
}
$this->db->select('*')->where('affiliation_name =', $aff_url);
$this->db->from('affiliations');
$affiliation1 = $this->db->get();
foreach ($affiliation1->result() as $affiliations) {
    $affiliation = $affiliations->id;
}
$aff_name = ucwords($affiliations->affiliation_name);
$aff_name = strtolower($aff_name);
// echo $aff_name;
// exit();
?>
<div class="breadrumb-new mab-50">
    <div class="container-fluid" style="padding: 0 60px;">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><?php echo $affiliations->affiliation_name; ?> Schools</li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /bread-crumb -->

<!-- /summercamp-popup -->

<style>
    .summercamp-popup {
        position: absolute;
        right: 50px;
        top: 190px;
        animation-delay: 2.5s;
        animation: blinker 1.8s linear infinite;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .summercamp-popup {
            right: 150px;
            top: 5px;
        }
        .summercamp-popup img {
            width: 120px;
        }
    }
    @media (min-width: 576px) and (max-width: 767px) {
        .summercamp-popup {
            top: 5px;
            right: 150px;
        }
        .summercamp-popup img {
            width: 100px;
        }
    }
    @media (min-width: 320px) and (max-width: 575px) {
        .summercamp-popup {
            top: 5px;
            right: 90px;
        }
        .summercamp-popup img {
            width: 100px;
        }
    } 
    .categories {
        background-color: #fff;
        border-radius: 8px;
        border: 2px solid #eaeaea;
        padding: 25px;
        font-family: 'Rubik',sans-serif;
    }
    .categories .lead {
        color: #d12881;
        font-weight: 500;
    }
    .categories ul li {
        line-height: 28px;
        font-weight: 400;
    }
    .categories li a {
        color: #303030;
        transition: .2s all;
        text-decoration: none;
        font-size: 15px;
    }
    .categories li a:hover {
        padding-left: 5px;
        color: #d12881;
    }
    .categories hr {
        margin-top: 5px;
        margin-bottom: 10px;
        border-color: #eaeaea;
    } 
    .bubbles {
        display: inline-block;
        position: relative;
    }
    .bubbles h1, .bubbles h2 {
        position: relative;
        margin: 0 0 0;
        font-family: 'Luckiest Guy', cursive;
        background: linear-gradient(135deg, rgb(195, 39, 2) 0%,rgb(224, 164, 60) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        z-index: 2;
    }
    .individual-bubble {
        position: absolute;
        border-radius: 100%;
        bottom: 10px;
        background-color: #ed2e2e;
        z-index: 1;
    }
</style>
<div class="sidebar-section">
    <div class="container-fluid" style="padding-left: 60px;padding-right: 60px;">
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
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-<?php echo $yourcity; ?>" id="<?php echo $row->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $affiliation_name1; ?> Schools</a>
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
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-<?php echo $yourcity; ?>" id="<?php echo $row1->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $category_name1; ?></a>
                            </li>
                        <?php } // $aff_name = ucwords($affiliations->affiliation_name);  ?>
                    </ul>
                </div><!-- /sidebar-categories -->
            </div><!-- /sticky -->
        </div><!-- /sidebar -->

        <div id="main">
            <div class="section-title mab-30">
                <div class="bubbles">
                    <h1 class="display-4">Exclusive Schools</h1>
                </div><hr>
            </div><!-- /section-title -->
            <?php
            $where = "is_active=1 AND activated_at != 'NULL' AND status=1 AND valitity != 'NULL'  AND school_category_id=1 AND affiliation_id=" . $affiliation . " AND city_id =" . $yourcity_id . " AND deleted_at is NULL";
            $this->db->select('*')->where($where);
            $this->db->from('school_details');
            $bestschool = $this->db->get();
            foreach ($bestschool->result() as $best) {
                
            }

            // if (isset($best->logo)) {
                ?>

                <?php
                // $this->db->select('*')->where('id =', $best->affiliation_id);
                // $this->db->from('affiliations');
                // $affili = $this->db->get();
                // foreach ($affili->result() as $affilis) {
                //     //echo $areas->area_name;
                //     //exit();
                // }

                // $this->db->select('*')->where('id =', $best->area_id);
                // $this->db->from('areas');
                // $area = $this->db->get();
                // foreach ($area->result() as $areas) {
                //     //echo $areas->area_name;
                //     //exit();
                // }

                // $this->db->select('*')->where('id =', $best->city_id);
                // $this->db->from('cities');
                // $city = $this->db->get();
                // foreach ($city->result() as $cities) {
                //     //echo $areas->area_name;
                //     //exit();
                // }

                if ($aff_url1 == "enquiry" || $aff_url1 == "otp") {
                    $affili_name = str_replace(" ", "-", $affilis->affiliation_name);
                } else {
                    $affili_name = str_replace(" ", "-", $aff_url1);
                }

                $school_name = str_replace(" ", "-", $best->school_name);
                ?>

                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affili_name ?>-schools-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" target="_blank">
                    <!-- <div class="cbse-school-widget mab-50">
                        <figure class="figure wow fadeInUp">

                            <div class="cbse-school-widget-imgbox" style="width: 100%;height: 400px;overflow: hidden;">
                            <?php if(isset($best->logo)){ ?>
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $best->logo ?>" class="rounded" alt="" style="width: 100%;height: 400px;object-fit: cover;">	
                            <?php } else { ?>
                                <img src="<?php echo base_url() ?>assets/front/images/list-1.jpg" style="width: 100%;height: 300px;object-fit: cover;" class="w-100" alt="" />
                            <?php } ?>    
                            </div>

                            <figcaption class="figure-caption">
                                <div class="figure-caption-content">
                                    <h2 class="text-white"><?php echo $best->slug; ?> </h2>
                                    <p class="text-white lead"><i class="fa fa-map-marker"></i> &nbsp;<?php echo $areas->area_name ?>, <?php echo $cities->city_name ?></p>
                                    <p><small><?php echo ucfirst($affiliations->affiliation_name); ?> School</small></p>
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $affili_name ?>-schools-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" class="btn btn-primary mt-3" target="_blank">View Details</a>
                                </div>
                            </figcaption>
                        </figure>
                    </div> -->
                    <!-- /cbse-school-widget -->
                </a>

                <?php
            // } elseif ($aff_name == "cbse") {
                ?>


                <!-- <div class="cbse-school-widget mab-50">
                    <figure class="figure wow fadeInUp">
                        <a href="<?php echo base_url() ?>schools-signup" target="_blank"><img src="<?php echo base_url("assets/front/images/cbse-banner.jpg"); ?>" class="figure-img w-100 rounded" alt=""></a>
                    </figure>
                </div> -->
                <!-- /cbse-school-widget -->

                <?php
            // } elseif ($aff_name == "international") {
                ?>

                <!-- <div class="cbse-school-widget mab-50">
                    <figure class="figure wow fadeInUp">
                        <a href="<?php echo base_url() ?>schools-signup" target="_blank"><img src="<?php echo base_url("assets/front/images/inter-banner.jpg"); ?>" class="figure-img w-100 rounded" alt=""></a>
                    </figure>
                </div> -->
                <!-- /cbse-school-widget -->

                <?php
            // } elseif ($aff_name == "matriculation") {
                ?>


                <!-- <div class="cbse-school-widget mab-50">
                    <figure class="figure wow fadeInUp">
                        <a href="<?php echo base_url() ?>schools-signup" target="_blank"><img src="<?php echo base_url("assets/front/") ?>images/matri-banner.jpg" class="figure-img w-100 rounded" alt=""></a>
                    </figure>
                </div> -->
                <!-- /cbse-school-widget -->

                <?php
            // } elseif ($aff_name == "special") {
                ?>


                <!-- <div class="cbse-school-widget mab-50">
                    <figure class="figure wow fadeInUp">
                        <a href="<?php echo base_url() ?>schools-signup" target="_blank"><img src="<?php echo base_url("assets/front/") ?>images/special-banner.jpg" class="figure-img w-100 rounded" alt=""></a>
                    </figure>
                </div> -->
                <!-- /cbse-school-widget -->

                <?php
            // } elseif ($aff_name == "kindergarten") {
                ?>

                <!-- <div class="cbse-school-widget mab-50">
                    <figure class="figure wow fadeInUp">
                        <a href="<?php echo base_url() ?>schools-signup" target="_blank"><img src="<?php echo base_url("assets/front/") ?>images/kinder-banner.jpg" class="figure-img w-100 rounded" alt=""></a>
                    </figure>
                </div> -->
                <!-- /cbse-school-widget -->

                <?php
            // }

            $where1 = "sd.is_active=1 AND sd.status=1 AND sd.activated_at != 'NULL' AND sd.valitity != 'NULL' AND sd.school_category_id=1 AND sd.affiliation_id=" . $affiliation . " AND sd.city_id =" . $yourcity_id . " AND sd.deleted_at is NULL";
            $this->db->select('sd.*,si.images as banner')->where($where1);
            $this->db->join('school_images as si', 'sd.id = si.school_id and school_activity_id = 2', 'left');
            $this->db->order_by('rand()');
            $this->db->from('school_details as sd');
            $topschool = $this->db->get();
            // echo $topschool->num_rows();
            // exit();
            ?>

            <div class="top-school-widget mab-50">
                <div class="section-title mab-30">
                    <div class="bubbles">
                        <h2 class="mb-3">Top Schools in <?php echo $yourcity; ?></h2>
                    </div><hr>
                </div><!-- /section-title -->
                <div class="owl-carousel owl-theme">
                    <?php
                    $delay = 4;
                    $topcount = 0;
                    if ($topschool->num_rows() > 0) {
                        foreach ($topschool->result() as $top) {

                            if ($topcount < 5) {

                                $this->db->select('*')->where('id =', $top->area_id);
                                $this->db->from('areas');
                                $area = $this->db->get();
                                foreach ($area->result() as $areas) {
                                    //echo $areas->area_name;
                                    //exit();
                                }

                                $school_name = str_replace(" ", "-", $top->school_name);
                                $affname_url = strtolower($aff_name);
                                $affname_url = str_replace(" ", "-", $affname_url);
                                // echo $affname_url;
                                // exit();
                                ?>
                                
                    <div class="home-tsw top-school-widget mab-50">
                        <!-- <div class="owl-one owl-carousel owl-theme"> -->
                            <div class="item wow bounceIn platinum" style="animation-delay: .<?php echo $delay; ?>s;">
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affname_url ?>-schools-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" target="_blank" target="_blank">
                                    <figure>
                                        <div class="package-name">Platinum</div>
                                        <div class="object-fit">
                                            <?php if(isset($top->banner)){ ?>
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $top->banner ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                                <?php } else { ?>
                                            <img src="<?php echo base_url() ?>assets/front/images/list-1.jpg" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                            <?php } ?>
                                        </div>
                                        <figcaption class="item-footer">
                                            <h6><?php echo ucfirst($top->school_name) ?></h6>
                                            <p><i class="fa fa-book"></i> Grades : KG To Class 10</p>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        <!-- </div> -->
                    </div>




                                    <?php
                                

                                $delay++;
                                $topcount++;
                            }
                        }
                    }

                    ?>						
                </div><!-- /owl-carousel -->
            </div><!-- /top-school-widget -->

            <?php
            $where2 = "sd.is_active=1 AND sd.activated_at != 'NULL' AND sd.valitity != 'NULL' AND sd.school_category_id=2 AND sd.affiliation_id=" . $affiliation . " AND sd.city_id =" . $yourcity_id . " AND sd.deleted_at is NULL";
            $this->db->select('sd.*,si.images as banner')->where($where2);
            $this->db->join('school_images as si', 'sd.id = si.school_id and school_activity_id = 2', 'left');
            $this->db->order_by('rand()');
            $this->db->from('school_details as sd');
            $school_premium = $this->db->get();
            ?>

            <div class="third-cat mab-50">
                <div class="section-title mab-30">
                    <div class="bubbles">
                        <h2 class="mb-3"><?php echo ucfirst($aff_name); ?> Schools in <?php echo $yourcity; ?></h2>
                    </div><hr>  
                </div><!-- /section-title -->

                <!-- <div class="section-title mab-30">
                        <h2 class="mb-3"></h2><hr>
                </div> --><!-- /section-title -->
                <?php
                $delay = 4;
                ?>
                <div class="row equal">
                    <?php
                    foreach ($school_premium->result() as $schools) {
                        $this->db->select('*')->where('id =', $schools->city_id);
                        $this->db->from('cities');
                        $city = $this->db->get();
                        foreach ($city->result() as $cities) {
                            //echo $areas->area_name;
                            //exit();
                        }

                        $this->db->select('*')->where('id =', $schools->area_id);
                        $this->db->from('areas');
                        $area = $this->db->get();
                        foreach ($area->result() as $areas) {
                            //echo $areas->area_name;
                            //exit();
                        }
                        $school_name = str_replace(" ", "-", $schools->school_name);
                        $affname_url = strtolower($aff_name);
                        $affname_url = str_replace(" ", "-", $affname_url);
                        // echo $school_name;
                        ?>
                        <div class="col-lg-3 col-sm-4 col-xs-6 mab-30">
                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $affname_url; ?>-schools-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" target="_blank">
                                <div class="home-tsw top-school-widget mab-50">
                                    <div class="card wow fadeInUp premium" style="animation-delay: .<?php echo $delay; ?>s;">
                                                <?php
                                                if (isset($schools->banner)) {
                                                    $school_name = str_replace(" ", "-", $schools->school_name);
                                                    ?>
                                        <figure>
                                                <div class="package-name">Premium</div>
                                                <div class="object-fit">
                                                    <?php if(isset($schools->banner)){ ?>
                                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $schools->banner ?>" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                                        <?php } else { ?>
                                                    <img src="<?php echo base_url() ?>assets/front/images/list-1.jpg" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
                                                    <?php } ?>
                                                </div>
                                            <figcaption class="item-footer">
                                                <h6><?php echo ucfirst($schools->school_name) ?></h6>
                                                <p><i class="fa fa-book"></i> Grades : KG To Class 10</p>
                                            </figcaption>
                                        </figure>
                                    </div><!-- /card -->
                                </div>
                            </a>
                        </div><!-- /col-lg-4 -->
                            <?php
                        }
                        $delay++;
                    }

                    ?>
                </div><!-- /row -->
            </div>
        </div>
    </div>
</div>

<div class="add-section" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mab-30">
                <div class="section-title">
                    <h2 class="mb-2 wow fadeInLeft" data-wow-delay="500ms">Let's Get Started with<br>Our Platform</h2>
                    <div class="line wow fadeInLeft" data-wow-delay="600ms"></div>

                    <?php if ($aff_url == "cbse") { ?>

                        <div class="platform mat-30">
                            <span class="wow fadeInLeft" data-wow-delay="700ms">CBSE curriculum is growing forward based on application skills, they study concept and methodology in syllabus. This helps to students apply those concepts in various contexts. Other than all India board exam, the cbse required basic general knowledge for moving to forward in education. The main <h3>benefit of cbse board</h3> is to transferrable working parents across India and easy facing of competitive exams.</span>
                            <br><br>

                            <span>While choosing the <h3>best CBSE School</h3> is not taken an easy. Parent’s way of thinking is different such as faculty, sports and co-curricular activities and value for money. CBSE would be better choice for long term development.</span>
                        </div>

                    <?php } elseif ($aff_url == "international") { ?>

                        <div class="platform mat-30">
                            <span class="wow fadeInLeft" data-wow-delay="700ms">Students attend <h3>international schools to learn the language of the international school</h3> and to obtain qualifications for employment or <h3>higher education in a foreign country.</h3> And when the child develops new and exciting skills, they grow more confident and learn how to communicate and work with other children</span>
                        </div>

                    <?php } elseif ($aff_url == "matriculation") { ?>

                        <div class="platform mat-30">
                            <span class="wow fadeInLeft" data-wow-delay="700ms">The <h3>Matriculation Schools in Tamilnadu</h3> and Pondicherry will be affiliated to the separate matriculation Board and they would continue to be fee based and use English as medium of instruction.</span>
                            <br><br>

                            <span>Choose your kids the <h3>best matriculation schools</h3> from the best environment. It is a co-educational school promoting healthy relationship, open for admission from classes k.g to 12th. Selecting excellent academia for your kids and can help them receive a sound educational experience.</span>
                        </div>

                    <?php } elseif ($aff_url == "special") { ?>

                        <div class="platform mat-30">
                            <span class="wow fadeInLeft" data-wow-delay="700ms">The schools teaching <h3>State syllabus charge lesser fees</h3> than CBSE schools.As state syllabus gives preference for local issues, it is convenient for those students who want to write state-level entrance examinations. Studying in <h3> syllabus is easier</h3> than that of other boards</span>
                            <br><br>

                            <p>Over the last few years, education systems are confused. To help you select the <h3>best special school</h3> for your kids, listed school in Coimbatore. Many new education systems have become popular in Coimbatore.</p>
                        </div>

                    <?php } elseif ($aff_url == "kindergarten") { ?>

                        <div class="platform mat-30">
                            <span class="wow fadeInLeft" data-wow-delay="700ms">Children will feel a lot more relaxed and free in kindergartens than they do at school. These activities help the kids find something they’re interested in and encourage their creative thinking. What’s more, every child has the right to pursue their own creative expression. The <h3>benefits of early childhood education</h3> and iterative learning process can make a significant difference in your child’s life.</span>
                            <br><br>
                            <span><h3>Best kindergarten school</h3> is the first big step in your kid's educational future. Most of the peoples are evaluating best school curriculum, scheduling and methodology. Teachers lead to new ideas, creative learning and how to implement them.</span>
                        </div>
                    <?php } ?>
                </div>
                <a href="<?php echo base_url() ?>contact-us" class="btn btn-primary1 mt-4 wow fadeInLeft" data-wow-delay="800ms">Contact Now</a>
            </div>
            <div class="col-lg-5 mab-30">
                <img src="<?php echo base_url("assets/front/") ?>images/right1.png" class="w-100 wow flipInY" data-wow-delay="500ms" alt="add">
            </div>
        </div>
    </div><!-- /container -->
</div><!-- /add-section -->

<svg id="deco-clouds" xmlns="https://www.w3.org/2000/svg" version="1.1" style="background-color: #f4f4f4;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
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
        //Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    jQuery(document).ready(function () {
        // Define a blank array for the effect positions. This will be populated based on width of the title.
        var bArray = [];
        // Define a size array, this will be used to vary bubble sizes
        var sArray = [4, 6, 8, 10];

        // Push the header width values to bArray
        for (var i = 0; i < $('.bubbles').width(); i++) {
            bArray.push(i);
        }

        // Function to select random array element
        // Used within the setInterval a few times
        function randomValue(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        // setInterval function used to create new bubble every 350 milliseconds
        setInterval(function () {

            // Get a random size, defined as variable so it can be used for both width and height
            var size = randomValue(sArray);
            // New bubble appeneded to div with it's size and left position being set inline
            // Left value is set through getting a random value from bArray
            $('.bubbles').append('<div class="individual-bubble" style="left: ' + randomValue(bArray) + 'px; width: ' + size + 'px; height:' + size + 'px;"></div>');

            // Animate each bubble to the top (bottom 100%) and reduce opacity as it moves
            // Callback function used to remove finsihed animations from the page
            $('.individual-bubble').animate({
                'bottom': '100%',
                'opacity': '-=0.7'
            }, 3000, function () {
                $(this).remove()
            }
            );


        }, 350);
    });

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    // Slider-carousel
    $(document).ready(function () {
        $(".owl-carousel").owlCarousel();
    });

    // Wow animation trigger
    new WOW().init();

    // Sticky-sidebar
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