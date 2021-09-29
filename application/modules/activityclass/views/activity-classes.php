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
</style> 
<style>
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
<?php
$yourcity = array();
$aff_url = end($this->uri->segments);
$yourcity = explode("-", $aff_url);
$yourcity = end($yourcity);
$uccity = ucfirst($yourcity);
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

$this->db->select('*')->where('is_active =', 1);
$this->db->from('cities');
$city = $this->db->get();
foreach ($city->result() as $cities) {
//    echo $cities->city_name;
    $urlcity = strtolower($cities->city_name);
    $aff_url = str_replace("-schools-in-" . $urlcity, "", $aff_url);
    $aff_url = str_replace("-in-" . $urlcity, "", $aff_url);
}

$this->db->select('*')->where('is_active =', 1);
$this->db->order_by("city_name", "asc");
$this->db->from('cities');
$allcity = $this->db->get()->result();
// $aff_url = str_replace("-schools-in-coimbatore","",$aff_url);
// $aff_url = str_replace("-schools-in-tiruppur","",$aff_url);
// $aff_url = str_replace("-schools-in-karur","",$aff_url);
// $aff_url = str_replace("-schools-in-namakkal","",$aff_url);
// $aff_url = str_replace("-schools-in-ooty","",$aff_url);
// $aff_url = str_replace("-schools-in-salem","",$aff_url);
// $aff_url = str_replace("-schools-in-erode","",$aff_url);
// $aff_url = str_replace("-in-coimbatore","",$aff_url);
// $aff_url = str_replace("-in-tiruppur","",$aff_url);
// $aff_url = str_replace("-in-karur","",$aff_url);
// $aff_url = str_replace("-in-namakkal","",$aff_url);
// $aff_url = str_replace("-in-ooty","",$aff_url);
// $aff_url = str_replace("-in-salem","",$aff_url);
// $aff_url = str_replace("-in-erode","",$aff_url);

$aff_url = str_replace("list-of-best-", "", $aff_url);
$aff_url1 = str_replace("-", " ", $aff_url);
$aff_url2 = ucwords($aff_url1);
?>

<?php
if ($aff_url == "dance-class") {
    $bestlogo = "dancefirstlogo.jpg";
    $toplogo = "dancesecondlogo.jpg";
    ?>
    <meta name="description" content="Find your best dance trainer with us. Get phone numbers, address, reviews are available in edugatein.">
    <meta name="keywords" content="Dance classes in <?php echo $yourcity; ?>, best dance class in <?php echo $yourcity; ?>, dance school in <?php echo $yourcity; ?>, dance schools near me, best western dance trainer in <?php echo $yourcity; ?>, best dance trainers in <?php echo $yourcity; ?>, best western dance classes in <?php echo $yourcity; ?>, western dance trainer in <?php echo $yourcity; ?>, dance academy in <?php echo $yourcity; ?>.">   
    <title>List of Top 100 Dance Instructor in <?php echo $yourcity; ?>, India – Edugatein</title>
    <?php
} elseif ($aff_url == "music-class") {
    $bestlogo = "musicfirstlogo.jpg";
    $toplogo = "musicsecondlogo.jpg";
    ?>
    <meta name="description" content="Best professional music coaching schools in <?php echo $yourcity; ?>. check the numbers, address, reviews in edugatein.">
    <meta name="keywords" content="Music classes in <?php echo $yourcity; ?>, music schools in <?php echo $yourcity; ?>, music schools near me, best music class in <?php echo $yourcity; ?>, music academy in <?php echo $yourcity; ?>, music classes for kids in <?php echo $yourcity; ?>, music class near me, musical instruments shop in <?php echo $yourcity; ?>.">  <title>Sounds of music | List of top 100 school music classes in <?php echo $yourcity; ?>– Edugatein</title>    
    <?php
} elseif ($aff_url == "coaching-centres") {
    $bestlogo = "coachfirstlogo.jpg";
    $toplogo = "coachingsecondlogo.jpg";
    ?>
    <meta name="description" content="To provide exceptional Quality Coaching Classes in <?php echo $yourcity; ?>. Follows on Edugatein to get the list of Bank Exams, Reviews, Address, Phone Number in <?php echo $yourcity; ?>. ">
    <meta name="keywords" content="Coaching centre in <?php echo $yourcity; ?>, coaching classes in <?php echo $yourcity; ?>, training institute in <?php echo $yourcity; ?>, trining classes in <?php echo $yourcity; ?>, Computer training institutes in <?php echo $yourcity; ?>, bank exam tutorials, computer trainer in <?php echo $yourcity; ?>,Tally, java, cad, graphic design course in <?php echo $yourcity; ?>.">
    <title>List of good coaching classes | Coaching Institute, Schools, Academy in <?php echo $yourcity; ?> | Edugatein</title>
    <?php
} elseif ($aff_url == "school-kits") {
    $bestlogo = "schoolfirstlogo.jpg";
    $toplogo = "schoolsecondlogo.jpg";
    ?>
    <meta name="description" content="Best deals for list of stationery – printers, scanner, books, note, pen, pencil, Uniform, bag, water bottle and shoes are available in <?php echo $yourcity; ?> at edugatein">
    <meta name="keywords" content="Stationary shops in <?php echo $yourcity; ?>, kids uniform shops in <?php echo $yourcity; ?>, best School stationery shops in <?php echo $yourcity; ?>, school kits for kids, Kids science kits in <?php echo $yourcity; ?>.">
    <title>Best School Stationery Shops in <?php echo $yourcity; ?> | Edugatein</title>
    <?php
} elseif ($aff_url == "fitness-centre") {
    $bestlogo = "fitnessfirstlogo.jpg";
    $toplogo = "fitnesssecondlogo.jpg";
    ?>
    <meta name="description" content="Contact us to know about the Best Fitness Center in <?php echo $yourcity; ?> - Yoga, Gymnastic, Fitness, Weight Reduction at edugatein">
    <meta name="keywords" content="Best gym in <?php echo $yourcity; ?>, Fitness centre in <?php echo $yourcity; ?>, Fitness gym in <?php echo $yourcity; ?>, Gym in <?php echo $yourcity; ?>, Beat fitness trainer in <?php echo $yourcity; ?>, Gymnastic trainer in <?php echo $yourcity; ?>, Fitness coaching classes in <?php echo $yourcity; ?>.">
    <title>List of Top 100 Fitness | Gymnastic | Yoga Classes Near me in <?php echo $yourcity; ?> | Edugatein</title>
    <?php
} elseif ($aff_url == "sports") {
    $bestlogo = "sportsfirstlogo.jpg";
    $toplogo = "sportssecondlogo.jpg";
    ?>
    <meta name="description" content="Find your best sports coach in <?php echo $yourcity; ?>. Follows on edugatein to get the details about sports goods in <?php echo $yourcity; ?>.">

    <meta name="keywords" content="Best sports shop in <?php echo $yourcity; ?>, sports shop in <?php echo $yourcity; ?>, sports goods shop in <?php echo $yourcity; ?>, Cricket classes near me, best sports trainers in <?php echo $yourcity; ?>, sports academy in <?php echo $yourcity; ?>, sports school in <?php echo $yourcity; ?>, sports centre in <?php echo $yourcity; ?>.">       
    <title>Let the games begin | List of Top Cricket, Badmiton, carom, Chess, Football, Tennis trainers in <?php echo $yourcity; ?> | Edugatein</title>    
    <?php
} elseif ($aff_url == "martial-arts") {
    $bestlogo = "martialfirstlogo.jpg";
    $toplogo = "martialsecondlogo.jpg";
    ?>
    <meta name="description" content="Look out the Martial Arts Coach in <?php echo $yourcity; ?>? To know the methods of fighting check now at Edugatein.">
    <meta name="keywords" content="Martial arts in <?php echo $yourcity; ?>, Martial arts training in <?php echo $yourcity; ?>, Martial arts academy, karate classes for kids in <?php echo $yourcity; ?>, self defence classes in <?php echo $yourcity; ?>, Best martial arts academy in <?php echo $yourcity; ?>.">       
    <title>List of Top 100 Martial Arts Instructor in <?php echo $yourcity; ?>, India – Edugatein</title>    
    <?php
} elseif ($aff_url == "event-managements") {
    $bestlogo = "eventfirstlogo.jpg";
    $toplogo = "eventsecondlogo.jpg";
    ?>
    <meta name="description" content="Check the Best  Event Management companies in <?php echo $yourcity; ?>. Contact Edugatein">
    <meta name="keywords" content="Event organizers in <?php echo $yourcity; ?>, Event companies in <?php echo $yourcity; ?>, Event planners in <?php echo $yourcity; ?>, Best event management companies in <?php echo $yourcity; ?>, Event management companies in <?php echo $yourcity; ?>.">       
    <title>Event Planning Experts | List of Top 100 Best Event Management in <?php echo $yourcity; ?> | Edugatein</title>    
    <?php
} elseif ($aff_url == "costume-designers") {
    $bestlogo = "costumefirstlogo.jpg";
    $toplogo = "costumesecondlogo.jpg";
    ?>
    <meta name="description" content="Best Costume Designers in <?php echo $yourcity; ?> - kids school uniform shops, uniform stitching tailors, stitching work in <?php echo $yourcity; ?> at edugatein">
    <meta name="keywords" content="Costume designer in <?php echo $yourcity; ?>, Fashion designer in <?php echo $yourcity; ?>, School uniform shop in <?php echo $yourcity; ?>, List of fancy dress available in <?php echo $yourcity; ?>.">       
    <title>List of Top 100 Best Costume Designers | Fancy Dress Botique in <?php echo $yourcity; ?>, India – Edugatein</title>    
    <?php
} elseif ($aff_url == "arts") {
    $bestlogo = "artfirstlogo.jpg";
    $toplogo = "artsscondlogo.jpg";
    ?>
    <meta name="description" content="Searching for Best Drawing Training in <?php echo $yourcity; ?> - Drawing, Swimming classes, Training near me, Coaches, Institute, Schools in <?php echo $yourcity; ?> at edugatein">
    <meta name="keywords" content="Art classes in <?php echo $yourcity; ?>, Drawing classes in <?php echo $yourcity; ?>, Swimming Trainers in <?php echo $yourcity; ?>, Drawing artist in <?php echo $yourcity; ?>, Swimming classes for kids.">       
    <title>Drawing for Absolute Beginners | List of Top 100 Best Drawing Training in <?php echo $yourcity; ?>, India – Edugatein</title>    
    <?php
} elseif ($aff_url == "transports") {
    $bestlogo = "transportfirstlogo.jpg";
    $toplogo = "transportsecondlogo.jpg";
    ?>
    <meta name="description" content="Best Transport Services in <?php echo $yourcity; ?> – School Bus, Auto, Cab Driver , get phone numbers, address, reviews are available in edugatein">
    <meta name="keywords" content="Transport services in <?php echo $yourcity; ?>, Transport companies in <?php echo $yourcity; ?>, School bus services in <?php echo $yourcity; ?>, School transport facility in <?php echo $yourcity; ?>.">       
    <title>List of Top 100 Best Transport Services in <?php echo $yourcity; ?>, India – Edugatein</title>    
    <?php
}
?>
<div class="breadrumb-new mab-20">
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

                                            <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_url ?>-in-<?php echo $lowercity; ?>"><i class="fa fa-angle-right"></i> <?php echo $allcitys->city_name; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div><!-- /dropdown-menu -->
                            </div>
                            <input type="text" id="search_class" class="form-control"  name="search_class" placeholder="Search..." aria-label="" aria-describedby="button-addon2">
                            <div class="search-list"><ul id="suggesstion-box"></ul></div>
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
                    <li class="list-inline-item"><?php echo ucwords($aff_url) ?></li>
                </ul>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /bread-crumb -->

<!-- <div class="summercamp-popup wow bounceIn slower">
    <a href="https://www.edugatein.com/list-of-best-summer-camp-in-<?php //echo $yourcity;        ?>">
      <img src="https://www.edugatein.com/images/back-to-school.png" width="120" alt="summer-camp">
    </a>
</div> -->
<!-- /summercamp-popup -->
<div class="sidebar-section">
    <div class="container">
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
                            <li class="<?php if($affiliation_name1 == $aff_url2){echo "active";} ?>">
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-<?php echo $yourcity; ?>" id="<?php echo $row->id; ?>"><i class="fa fa-circle"></i> <?php echo $affiliation_name1; ?> Schools</a>
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
                            <li class="<?php if($category_name1 == $aff_url2){echo "active";} ?>">
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-<?php echo $yourcity; ?>" id="<?php echo $row1->id; ?>"><i class="fa fa-circle"></i> <?php echo $category_name1; ?></a>
                            </li>  
                        <?php } ?>
                    </ul>
                </div><!-- /sidebar-categories -->
            </div><!-- /sticky -->
        </div><!-- /sidebar -->

        <?php
        //$aff_url = end($this->uri->segments);
        $aff_url = str_replace("-", " ", $aff_url);

        if ($aff_url == "enquiry" || $aff_url == "otp") {
            $aff_url = "dance class";
            $aff_url1 = "dance class";
        }

        $this->db->select('*')->where('category_name =', $aff_url1);
        $this->db->from('institute_categories');
        $affiliation1 = $this->db->get();
        foreach ($affiliation1->result() as $affiliations) {
            $affiliation = $affiliations->id;
            //echo $best->area_id;
            //exit();
        }
        // echo $affiliations->category_name;
        // echo $affiliations->category_name;
        // echo $affiliations->category_name;
        // echo $affiliation;
        // exit();
        $aff_name = ucwords($affiliations->category_name);
        ?>
        <div id="main">
            <div class="section-title mab-30 dnone">
                <div class="bubbles">
                    <h1 class="display-4">Exclusive <?php echo $aff_name; ?></h1>
                </div><hr>
            </div><!-- /section-title -->



            <!-- <div class="section-title mab-30">
                    <h1>Exclusive <?php echo $aff_name; ?> </h1>
                    <div class="line"></div>
            </div> -->
            <!-- /section-title -->

            <?php
            $where = "is_active=1 AND position_id=1 AND category_id=" . $affiliation . " AND city_id =" . $yourcity_id . " AND deleted_at is NULL ";
            $this->db->select('*')->where($where);
            $this->db->from('institute_details');
            $bestschool = $this->db->get();
            foreach ($bestschool->result() as $best) {
                //echo $affiliation;
                //exit();
            }
            ?>
            <?php
            if (isset($best)) {


                $this->db->select('*')->where('id =', $best->area_id);
                $this->db->from('areas');
                $area = $this->db->get();
                foreach ($area->result() as $areas) {
                    //echo $areas->area_name;
                    //exit();
                }


                $this->db->select('*')->where('id =', $best->city_id);
                $this->db->from('cities');
                $city = $this->db->get();
                foreach ($city->result() as $cities) {
                    //echo $areas->area_name;
                    //exit();
                }
                $institute_name = str_replace(" ", "-", $best->institute_name);
                $aff_name1 = str_replace(" ", "-", $aff_name);
                //echo  $aff_name1;
                // exit();
                $aff_name1 = strtolower($aff_name1);
                ?>

                <!-- <div class="cbse-school-widget mab-50">
                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name1; ?>-in-<?php echo $yourcity; ?>/<?php echo $institute_name; ?>" target="_blank">
                        <figure class="figure wow fadeInUp">
                            <?php
                            if ($best->logo != "") {
                                ?>

                                <div class="object-cover" style="width: 100%;height: 400px;overflow: hidden;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $best->logo ?>" class="figure-img img-fluid rounded" alt="" style="width: 100%;height: 400px;object-fit: cover;">
                                </div>							


                                <?php
                            } else {
                                ?>



                            <?php } ?>
                            <figcaption class="figure-caption">
                                <div class="figure-caption-content">
                                    <h2 class="text-white"><?php echo $best->institute_name; ?></h2>
                                    <p class="text-white lead d-none d-sm-block"><i class="fa fa-map-marker"></i> &nbsp;<?php echo $areas->area_name ?>, <?php echo $cities->city_name ?></p>
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name1; ?>-in-<?php echo $yourcity; ?>/<?php echo $institute_name; ?>" target="_blank" class="btn btn-primary mt-3">View Details</a>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div> -->
                <!-- /cbse-school -->
                <?php
            } 
            // else {
                ?>
                <div class="cbse-school-widget mab-50 dnone">
                    <a href="<?php echo base_url() ?>signupschool" target="_blank">
                        <figure class="figure wow fadeInUp">
                            <div class="object-cover" style="width: 100%;height: 400px;overflow: hidden;">
                                <img src="https://edugatein.com/laravel/public/<?php echo $bestlogo ?>" class="figure-img img-fluid rounded" alt="" style="width: 100%;height: 400px;object-fit: cover;">
                            </div>
                        </figure>
                    </a>
                </div><!-- /cbse-school -->

                <?php
            // }
            $where1 = "is_active=1 AND position_id=1 AND status=1 AND category_id=" . $affiliation . " AND city_id =" . $yourcity_id . " AND deleted_at is NULL";
            $this->db->select('*')->where($where1);
            $this->db->order_by('rand()');
            $this->db->from('institute_details');
            $topschool = $this->db->get();
            $delay = 4;
            $topcount = 0;
            if ($topschool->num_rows() > 5) {
                $restriction = 5;
            } else {
                $restriction = $topschool->num_rows();
            }

            // echo $topcount;
            // exit();
            $where2 = "ind.is_active=1 AND ind.position_id=2 AND ind.status=1 AND ind.category_id=" . $affiliation . " AND ind.city_id =" . $yourcity_id . " AND ind.valitity IS NOT NULL AND ind.deleted_at IS NULL";
            $this->db->select('ind.*,ar.area_name')->where($where2);
            // $this->db->order_by('rand()');
            $this->db->from('institute_details as ind');
            $this->db->join('areas as ar','ind.area_id=ar.id','left');
            $school_premium = $this->db->get()->result_array();

            $where2 = "ind.is_active=1 AND ind.position_id=3 AND ind.status=1 AND ind.category_id=" . $affiliation . " AND ind.city_id =" . $yourcity_id . " AND ind.valitity IS NOT NULL AND ind.deleted_at IS NULL";
            $this->db->select('ind.*,ar.area_name')->where($where2);
            // $this->db->order_by('rand()');
            $this->db->join('areas as ar','ind.area_id=ar.id','left');
            $this->db->from('institute_details as ind');
            $school_spectrum = $this->db->get()->result_array();

            $where2 = "ind.is_active=1 AND ind.position_id=4 AND ind.status=1 AND ind.category_id=" . $affiliation . " AND ind.city_id =" . $yourcity_id . " AND ind.valitity IS NOT NULL AND ind.deleted_at IS NULL";
            $this->db->select('*')->where($where2);
            // $this->db->order_by('rand()');
            $this->db->from('institute_details as ind');
            $this->db->join('areas as ar','ind.area_id=ar.id','left');
            $school_trial = $this->db->get()->result_array();
            // print_r($school_spectrum);exit;
            ?>

        <?php if(!empty($topschool->result()) || !empty($school_premium) || !empty($school_spectrum) || !empty($school_trial) ){ ?>
            <?php if($topschool->num_rows() != 0 ){ ?>
                <div class="home-tsw top-school-widget top-school-sigle mab-20">    
                    <div class="custom-section-title mab-10">
                    <h3 class="mb-3">Top <?php echo $aff_name; ?> in <span><?php echo $yourcity; ?></span></h3>
                    </div><!-- /section-title -->
                    <div class="owl-carousel owl-carousel-1 owl-theme">
                        <?php
                        $delay = 4;
                        $topcount = 0;
                        if ($topschool->num_rows() > 0) {
                            foreach ($topschool->result() as $top) {
                                
                                if ($topcount < 5) {
                                    // $this->db->select('*')->where('id =', $top->area_id);
                                    // $this->db->from('areas');
                                    // $area = $this->db->get();
                                    // foreach ($area->result() as $areas) {
                                    //     //echo $areas->area_name;
                                    //     //exit();
                                    // }

                                    $school_name = str_replace(" ", "-", $top->institute_name);
                                    $affname_url = strtolower($aff_name);
                                    $affname_url = str_replace(" ", "-", $affname_url);
                                    // echo $affname_url;
                                    // print_r($affname_url);exit;
                                    // exit();
                                    ?>
                                    
                        <div class="mab-20">
                            <!-- <div class="owl-one owl-carousel owl-theme"> -->
                                <div class="item wow bounceIn platinum" style="animation-delay: .<?php echo $delay; ?>s;">
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $affname_url ?>-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" target="_blank" target="_blank">
                                        <figure>
                                            <div class="package-name">Platinum</div>
                                            <div class="object-fit">
                                                <?php if(isset($top->logo)){ ?>
                                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $top->logo ?>" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>" />
                                                    <?php } else { ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default-single.png" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>" />
                                                <?php } ?>
                                            </div>
                                            <figcaption class="item-footer">
                                                <h6><?php echo ucfirst($top->institute_name) ?></h6>
                                                <!-- <p><i class="fa fa-book"></i> Grades : KG To Class 10</p> -->
                                                <div class="row">
                                                    <div class="col-lg-9 item-left-section">
                                                        <p><i class="fa fa-map-marker"></i> Address : <b><?php echo ucwords($top->address) ?></b></p>
                                                        <p><i class="fa fa-book"></i> Type : <b><?php echo ucfirst($aff_name) ?></b></p>                                                        
                                                        <?php if(!empty($top->year_of_establish)){ ?><p><i class="fa fa-building-o"></i>  Establishment Year : <b><?php echo $top->year_of_establish ?></b></p><?php } ?>
                                                    </div>
                                                    <div class="col-lg-3 item-right-section">
                                                        <a href="tel:<?php echo $top->mobile ?>"><button class="btn btn-theme2 mb-2"><i class="fa fa-phone"></i> Call School</button></a><br>
                                                        <button class="btn btn-theme1-border"><img src="https://www.edugatein.com/images/new.gif" alt=""> Admission open</button>
                                                    </div>
                                                </div>
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
            <?php } ?>
            <?php if(!empty($school_premium)){ ?>
                <div class="top-school-widget mab-20">    
                    <div class="custom-section-title mab-10">
                    <h3 class="mb-3">Best <?php echo $aff_name; ?> in <span><?php echo $yourcity; ?></span></h3>
                    </div><!-- /section-title -->
                    <div class="owl-carousel owl-carousel-2 owl-theme">
                        <?php
                        $delay = 4;
                        $topcount = 0;
                            foreach ($school_premium as $top) {
                                
                                // if ($topcount < 5) {
                                    // $this->db->select('*')->where('id =', $top->area_id);
                                    // $this->db->from('areas');
                                    // $area = $this->db->get();
                                    // foreach ($area->result() as $areas) {
                                    //     //echo $areas->area_name;
                                    //     //exit();
                                    // }

                                    $school_name = str_replace(" ", "-", $top['institute_name']);
                                    $affname_url = strtolower($aff_name);
                                    $affname_url = str_replace(" ", "-", $affname_url);
                                    // echo $affname_url;
                                    // print_r($affname_url);exit;
                                    // exit();
                                    ?>
                                    
                        <div class="home-tsw top-school-widget mab-20">
                            <!-- <div class="owl-one owl-carousel owl-theme"> -->
                                <div class="item wow bounceIn premium" style="animation-delay: .<?php echo $delay; ?>s;">
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $affname_url ?>-in-<?php echo $yourcity; ?>/<?php echo $school_name; ?>" target="_blank" target="_blank">
                                        <figure>
                                            <div class="package-name">Premium</div>
                                            <div class="object-fit">
                                                <?php if(isset($top['logo'])){ ?>
                                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $top['logo'] ?>" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>" />
                                                    <?php } else { ?>
                                                <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>" />
                                                <?php } ?>
                                            </div>
                                            <figcaption class="item-footer">
                                                <h6><?php echo ucfirst($top['institute_name']) ?></h6>
                                                <?php if(!empty($top['year_of_establish'])){ ?><p><i class="fa fa-building-o"></i>  Establishment Year : <b><?php echo $top['year_of_establish'] ?></b></p><?php } ?>
                                                <p>Area: <b><?php echo $top['area_name'] ?></b></p>
                                                <!-- <p><i class="fa fa-book"></i> Grades : KG To Class 10</p> -->
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            <!-- </div> -->
                        </div>
                                    <?php
                                    

                                    $delay++;
                                    $topcount++;
                                // }
                            }

                        ?>						
                    </div><!-- /owl-carousel -->
                </div><!-- /top-school-widget -->
            <?php } ?>
            <?php if(!empty($school_trial) || !empty($school_spectrum)){ ?>
                <div class="third-cat mab-50 home-tsw top-school-widget mab-20">
                    <div class="custom-section-title mab-30">
                        <h3 class="mb-2"><?php echo ucfirst($aff_name); ?> in <span><?php echo $yourcity; ?></span></h3>
                    </div>
                    <div class="row equal">
                        <?php foreach($school_spectrum as $spectrum){ 
                            $class = strtolower($aff_name);
                            $class = str_replace(" ","-",$class);
                            ?>
                            <div class="col-md-3">
                                <div class="schoolist-inner spectrum">
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $class ?>-in-<?php echo $yourcity; ?>/<?php echo str_replace(" ","-",$spectrum['institute_name']); ?>" target="_blank">
                                        <figure>
                                            <div class="package-name">Spectrum</div>
                                            <div class="object-fit">
                                            <?php if(isset($spectrum['logo'])){ ?>
                                                <img src="<?php echo base_url("laravel/public/") ?><?php echo $spectrum['logo'] ?>" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url("assets/front/") ?>images/list-default.png" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>">
                                            <?php } ?>
                                            </div>
                                            <figcaption class="item-footer">
                                                <h6><?php echo ucfirst($spectrum['institute_name']) ?></h6>
                                                <?php if(!empty($spectrum['year_of_establish'])){ ?><p><i class="fa fa-building-o"></i>  Establishment Year : <b><?php echo $spectrum['year_of_establish'] ?></b></p><?php } ?>
                                                <p>Area : <?php echo $spectrum['area_name'] ?></p>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <!-- </div> -->
                        <?php } ?>
                        <?php foreach($school_trial as $trial){ 
                            $class = strtolower($aff_name);
                            $class = str_replace(" ","-",$class);
                            ?>
                            <div class="col-md-3">
                                <div class="schoolist-inner premium">
                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $class ?>-in-<?php echo $yourcity; ?>/<?php echo str_replace(" ","-",$trial['institute_name']); ?>" target="_blank">
                                        <figure>
                                            <div class="package-name">Trial</div>
                                            <div class="object-fit">
                                            <?php if(isset($trial['logo'])){ ?>
                                                <img src="<?php echo base_url("laravel/public/") ?><?php echo $trial['logo'] ?>" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>">
                                            <?php }else{ ?>
                                                <img src="<?php echo base_url("assets/front/") ?>images/list-default.png" class="w-100" alt="best <?php echo $aff_name ?> in <?php echo $yourcity ?>">
                                            <?php } ?>
                                            </div>
                                            <figcaption class="item-footer">
                                                <h6><?php echo ucfirst($trial['institute_name']) ?></h6>
                                                <?php if(!empty($trial['year_of_establish'])){ ?><p><i class="fa fa-building-o"></i>  Establishment Year : <b><?php echo $trial['year_of_establish'] ?></b></p><?php } ?>
                                                <p>Area : <?php echo $trial['area_name'] ?></p>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            </div>
                            <!-- </div> -->
                        <?php } ?>
                    <div>
                </div>
                <?php } ?>
                <?php }else{ ?>
                    <div class="no-data-list">
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data-single1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
                                                    <img src="<?php echo base_url() ?>assets/front/images/no-data1.png" class="w-100" alt="best kindergarten schools in <?php echo $city; ?>" />
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
        </div><!-- /main -->
    </div><!-- /container-fluid -->
</div><!-- /sidebar-section -->
</div><!-- /container -->

<div class="add-section" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mab-30">
                <div class="section-title">
                    <h1 class="mb-2 wow fadeInLeft" data-wow-delay="500ms">Let's Get Started with<br>Our Platform</h1>
                    <div class="line wow fadeInLeft" data-wow-delay="600ms"></div>	
                    <p class="mat-30 wow fadeInLeft" data-wow-delay="700ms">Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit. Let's Join with us to find your information like where your school located, what are the facilities and promotional offers in Edugate-india.</p>
                </div>
                <a href="<?php echo base_url() ?>contact-us" class="btn btn-primary1 mt-4 wow fadeInLeft" data-wow-delay="800ms">Contact Now</a>
            </div>
            <div class="col-lg-5 mab-30">
                <img src="<?php echo base_url("assets/front/images/");?>right1.png" class="w-100 wow flipInY" data-wow-delay="500ms" alt="add">
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

<!-- Footer templete -->
<?php $this->load->view('footer'); ?>

<?php
$trainer_url = str_replace(" ", "-", $aff_url);
if ($trainer_url != "school-kits" && $trainer_url != "event-managements" && $trainer_url != "transports") {
    ?>
    <!-- <div class="trainers">
        <a href="<?php echo base_url() ?>list-of-best-<?php echo $trainer_url; ?>-trainers-in-coimbatore">
            <img src="<?php echo base_url("assets/front/images/");?>trainers.png" class="w-100" alt="">
        </a>
    </div> -->
    <!-- /trainers -->
    <?php
}
?>
<style>
    .trainers {
        position: fixed;
        top: 60%;
        right: 0px;
        transform: translateY(-50%);
        /*transform: rotate(-90deg);*/
        z-index: 1002;
    }
    .feedback-form {
        top: 40%!important;
    }
</style>

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>    
</div><!-- /top-to-bottom -->

<!-- Feedback-form -->
<div class="feedback-form shadow-lg">
    <div class="feedback-img">
        <img src="<?php echo base_url("assets/front/images/");?>feed.png" class="toggle" alt="feedback">   
    </div>

    <div class="feedback-head">
        <div class="media mb-2">
            <div class="media-left">
                <img src="<?php echo base_url("assets/front/images/");?>support.png" width="45px" alt="feedback">
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
                <input type="number" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Mobile Number*" pattern="[6789][0-9]{9}" required>
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
//    $('.carousel').carousel({
//        interval: 3000,
//        pause: "false"
//    });
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
    // Smooth-scroll
    $(document).ready(function () {
        $("html").easeScroll(2000);
    })

    new WOW().init();
    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

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
    $(document).ready(function () {
        $(".owl-carousel-1").owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:3000,
            dots: false,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:false
                }
            }
        });
        $(".owl-carousel-2").owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:4000,
            dots: false,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:false
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:false
                }
            }
        });
    });
    $(document).ready(function(){
        $("#search_class").keyup(function(){
            $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>summercamp/search_activity_class",
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#search_class").css("background");
            },
            success: function(data){
                data = JSON.parse(data);
                var html = '';
                $.each(data, function(key,val) {
                    html += '<li onClick="selectSchool(`'+val['institute_name']+'`)">'+val['institute_name']+'</li>';
                });
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(html);
                $("#search_class").css("background","#FFF");
            }
            });
        });
    });
    function selectSchool(val) {
        $("#search_class").val(val);
        $("#suggesstion-box").hide();
    }

</script>
