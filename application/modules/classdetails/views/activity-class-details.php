<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$city=$this->session->userdata("search_city");
 
$school_strength = array();
$aff_url = end($this->uri->segments);
$aff_url = str_replace("-", " ", $aff_url);
$this->db->select('*')->where('institute_name =', $aff_url);
$this->db->from('institute_details');
$institute_det = $this->db->get();
foreach ($institute_det->result() as $institute_dets) {
    $category = $institute_dets->position_id;
    $institute_id = $institute_dets->id;
}

$this->db->select('*')->where('id =', $institute_dets->city_id);
$this->db->from('cities');
$city = $this->db->get();
foreach ($city->result() as $cities) {
    $city = $cities->city_name;
    //exit();
}

$this->db->select('*')->where('id =', $institute_dets->area_id);
$this->db->from('areas');
$area = $this->db->get();
foreach ($area->result() as $areas) {
    $area = $areas->area_name;
    //exit();
}
?>
<?php
$this->db->select('*')->where('id =', $institute_dets->category_id);
$this->db->from('institute_categories');
$categoryname = $this->db->get();
foreach ($categoryname->result() as $categorynames) {
    
}

$category_name = str_replace(" ", "-", $categorynames->category_name);


$this->db->select('*')->where('id =', $institute_id);
$this->db->from('institute_details');
$institute_detail = $this->db->get();
foreach ($institute_detail->result() as $institute_details) {
    $view_count = $institute_details->view_count;
}

$this->db->set('view_count', $view_count + 1)->where('id', $institute_details->id)->update('institute_details');
?>

<?php
if ($category_name == "dance-class") {
    ?>
    <meta name="description" content="Best Western Dance Trainer in Coimbatore  - Best Dance Training, Classes Near me, Trainers, Master, get phone numbers, address, reviews are available in edugatein">
    <meta name="keywords" content="Best Dance training in coimbatore, school  dance classes kids near me in coimbatore, best dance trainers in coimbatore, best western dance classes in coimbatore, western dance trainer in coimbatore, best dance master in coimbatore, western dance master in Coimbatore">   
    <title>Best Western Dance Trainer in Coimbatore,  India  –  Edugatein</title>
    <?php
} elseif ($category_name == "music-class") {
    ?>
    <meta name="description" content="Best Music Training in Coimbatore - Classes Near me, Trainers, Music  Schools , get phone numbers, address, reviews are available in edugatein">
    <meta name="keywords" content="Best Music training in coimbatore, Music classes near me in coimbatore, school Music classes in coimbatore, Music classes for kids near me in coimbatore, Music schools near me in coimbatore">       
    <title>School Music Classes | Training in Coimbatore –  Edugatein</title>    
    <?php
} elseif ($category_name == "Coaching-centres") {
    ?>
    <meta name="description" content="To provide exceptional Quality Coaching Classes in Coimbatore. List of Bank Exam, Need Reviews, Map, Address, Phone Number, Contact Number in Coimbatore. Follows  on Edugatein">
    <meta name="keywords" content="List of coaching classes tutorials,List of coaching classes tutorials , local, popular Bank Exam Tutorials, Coaching classes, schools, academy, best training Classes, competitive exam,bank exam, RRB exam, TNPSC Coaching  centers, Maths , CBSE, Nearby tuition center , need training Institute, spoken English, hindi classes in Coimbatore
          ">
    <title>Training Classes | Coaching Institute, Schools, Academy in Coimbatore | Edugatein</title>
    <?php
} elseif ($category_name == "School-kits") {
    ?>
    <meta name="description" content="Get phone numbers, address, best deals for list of stationery – printers, scanner,books, note, pen,pencil, Uniform, bag, water bottle and shoes are available in Coimbatore at edugatein.">
    <meta name="keywords" content="best School stationery shops, top 10 wholesalers, kids uniform shops, uniform stitching tailors, tailoring work orders, stitching work, wireless printers, scanner, printer dealers in coimbatore,India.">
    <title>Kids Shop  | Stationery  Items  in Coimbatore | Edugatein</title>
    <?php
} elseif ($category_name == "Fitness-centre") {
    ?>
    <meta name="description" content="Contact us to know about the best fitness centre in coimbatore - Yoga, Gymnastic, Fitness at edugatein">
    <meta name="keywords" content="personal Fitness trainer in coimbatore, best fitness trainer in coimbatore, gymnastic trainer classes in coimbatore, best gymnastic coaching in coimbatore, best yoga classes nearme in Coimbatore">
    <title>Fitness | Gymnastic  | yoga Classes Near me in Coimbatore | Edugatein</title>
    <?php
} elseif ($category_name == "Sports") {
    ?>
    <meta name="description" content="Find out the best sport coach in coimbatore - sports, training, classes, coaching, supplier, shoes, balls, bat, glaves, academy, cricket, tennis, badminton, tennis, Squash and Football in coimbatore at edugatein">

    <meta name="keywords" content="best sports training in coimbatore, athletics coaching in coimbatore, best shuttle classes in coimbatore, badminton coaching classes in coimbatore, Cricket classes nearme in coimbatore, cricket bats in coimbatore, sports ball in coimbatore, cricket glaves in coimbatore, tennis academy in coimbatore, Football coaching classes in Coimbatore">       
    <title>Sports - Badminton, Cricket, Tennis, Football in Coimbatore | Edugatein</title>    
    <?php
} elseif ($category_name == "Martial-arts") {
    ?>  
    <?php
} elseif ($category_name == "Event-managements") {
    ?>
    <meta name="description" content="Check the Event Management  in Coimbatore – best game organization, entertainment centres , summer classes , craft for kids, cultural academy , camp for school children, cycling rider , skating event in Coimbatore at edugatein">
    <meta name="keywords" content="best summer classes for kids in coimbatore, craft for kids in coimbatore, summer cultural academy in coimbatore, summer camp for school children in coimbatore, summer fitness camp kids in coimbatore, summer camp tutor in coimbatore, cycling rider in coimbatore, cycling event in coimbatore, skating rider in coimbatore, skating event in Coimbatore">       
    <title>Best Event Management in Coimbatore,  India – Edugatein</title>    
    <?php
} elseif ($category_name == "Costume-designers") {
    ?>
    <meta name="description" content="Best Costume Designers in Coimbatore - kids school uniform shops, uniform stitching tailors, stitching work in Coimbatore at edugatein">
    <meta name="keywords" content="school uniform shops in coimbatore, kids school uniform shops in coimbatore, girls school uniform shops in coimbatore, best school uniform shops in coimbatore, uniform stitching tailors in coimbatore, tailoring work orders in coimbatore, stitching work in Coimbatore, list of fancy dresses available in coimbatore, fancy dress designer in coimbatore, fancy dress botique in coimbatore">       
    <title>Best Costume Designers | Fancy Dress Botique  in Coimbatore,  India – Edugatein</title>    
    <?php
} elseif ($category_name == "Arts") {
    ?>
    <meta name="description" content="Searching for Best Drawing Training in Coimbatore - Drawing, Swimming classes, Training near me, Coaches, Institute, Schools in Coimbatore at edugatein">
    <meta name="keywords" content="Best Drawing training in coimbatore, Drawing classes kids near me in coimbatore, school Drawing classes in coimbatore, Best swimming training in coimbatore, school Swimming classes in coimbatore, Swimming classes for kids near me in coimbatore">       
    <title>Best Drawing Training in Coimbatore,  India  – Edugatein</title>    
    <?php
} elseif ($category_name == "Transports") {
    ?>
    <meta name="description" content="Best Transport Services in Coimbatore – School Bus, Auto, Cab Driver , get phone numbers, address, reviews are available in edugatein">
    <meta name="keywords" content="School bus services in Coimbatore, best School bus services in coimbatore, best school transport facility in Coimbatore">       
    <title>Best Transport Services in Coimbatore,  India  –  Edugatein</title>    
    <?php
}
?>







<style>
    .marquee-section a {
        font-size: 16px;
        font-weight: bold;
        color: red;
    }
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
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>">Home</a	></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-<?php echo lcfirst($category_name); ?>-in-<?php echo strtolower($city);?>"><?php echo ucwords($categorynames->category_name); ?></a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <?php
                    $slug = strtolower($institute_dets->slug);
                    $slug = ucwords($slug);
                    ?>
                    <li class="list-inline-item"><?php echo $slug; ?></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div>
    </div><!-- /container -->
</div><!-- /bread-crumb -->

<?php
if ($category == 1) {

    $institute_banner = "is_active=1 AND  category_id=3 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($institute_banner);
    $this->db->from('institute_images');
    $institute_banner = $this->db->get();
    ?>
    <div class="firstcat-details-group activity-first-slider" style="overflow: hidden;margin-top: -50px;">
        <div class="container-fluid p-0">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner activity-first-slide wow bounceIn" data-wow-delay="300ms">
                    <?php
                    $banner_count = 0;
                    foreach ($institute_banner->result() as $institute_banners) {


                        if ($banner_count < 3) {
                            if ($banner_count == 0) {
                                ?> 

                                <div class="carousel-item item active">
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_banners->image ?>" class="" alt="">
                                </div>
                                <?php
                            } else {

                                if (isset($institute_banners->image)) {
                                    ?>                   

                                    <div class="carousel-item item">
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_banners->image ?>" class="" alt="">
                                    </div>
                                    <?php
                                }
                            }
                        }




                        $banner_count++;
                    }
                    ?>

                    <div class="activity-first-slide-info">
                        <div class="activity-first-slide-content">
                            <h1 class="text-white wow slideInLeft display-4" data-wow-delay="400ms"><?php echo $institute_dets->slug; ?></h1>
                            <small class="wow slideInLeft" data-wow-delay="500ms"><i class="fa fa-map-marker"></i> <?php echo $area; ?>,<?php echo $city; ?></small>
                            <ul class="list-inline">
                                <?php
                                $institute_program = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                                $this->db->select('*')->where($institute_program);
                                $this->db->from('program_details');
                                $this->db->distinct();
                                $institute_program = $this->db->get();

                                foreach ($institute_program->result() as $institute_programs) {

                                    $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                                    $this->db->select('*')->where($program_name);
                                    $this->db->from('institute_programs');
                                    $program_name = $this->db->get();
                                    foreach ($program_name->result() as $program_names) {
                                        ?>        
                                        <li class="list-inline-item"><?php echo $program_names->program_name; ?></li>
                                        <li class="list-inline-item">|</li>

                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div><!-- /activity-first-slide-content -->
                    </div><!-- /firstcat-slide-info -->
                </div><!-- /firstcat-sliding-section -->
            </div><!-- /carousel -->
        </div><!-- /container-fluid -->
    </div><!-- /firstcat-details-group -->

    <div class="activity-first-info-widgets-group pb-0">
        <div class="container-fluid" style="padding: 0 80px;">
            <div class="row">
                <?php
                $special_data = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($special_data);
                $this->db->from('institute_platinum_datas');
                $special_data = $this->db->get();

                $special_data_count = 0;
                $second = 300;
                foreach ($special_data->result() as $special_datas) {
                    if ($special_data_count < 6) {
                        ?>

                        <div class="col-lg-2 col-sm-6 mab-30">
                            <div class="activity-first-info-widgets wow slideInDown" data-toggle="tooltip" data-placement="bottom" title="<?php echo $special_datas->brief_content ?>" data-wow-delay="<?php echo $second; ?>ms">
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $special_datas->icon ?>" width="50" class="mb-2" alt="">
                                <small><?php echo $special_datas->heading ?></small>
                                <p class="lead"><?php echo $special_datas->content ?></p>
                            </div><!-- /activity-first-info-widgets -->
                        </div>

                        <style>
                            .activity-first-info-widgets {
                                height: 180px;
                            }
                        </style>

                        <?php
                        $second = $second + 200;
                    }
                    $special_data_count++;
                }
                ?>
            </div><!-- /row -->
        </div><!-- /container-fluid -->
    </div><!-- /activity-first-info-widgets-group -->

    <div class="activity-first-about" style="overflow: hidden;padding: 40px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8  mab-30">
                    <div class="section-title mab-30">
                        <h2 class="wow slideInLeft" data-wow-delay="300ms">About <?php echo $institute_dets->slug; ?></h2>
                        <div class="line wow slideInLeft" data-wow-delay="300ms"></div>
                    </div><!-- /section-title -->

                    <p class="wow slideInLeft" data-wow-delay="600ms"><?php echo $institute_dets->about; ?></p>
                </div>

                <div class="col-lg-4 mab-30">
                    <div class="second-owner-imgbox" style="">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_dets->proprietor_image ?>" class="rounded" alt="">
                        <div class="author-name">
                            <h5 class="text-white"><?php echo $institute_dets->proprietor_name; ?></h5>
                            <small><?php echo $institute_dets->proprietor_position; ?></small>
                        </div><!-- /author-name -->
                    </div><!-- /second-owner-imgbox -->
                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-first-about -->

    <style>
        .second-owner-imgbox {
            width: 100%;
            height: 300px;
            /*overflow: hidden;*/
            position: relative;
        }
        .second-owner-imgbox img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .author-name {
            position: absolute;
            bottom: -35px;
            left: 50%;
            border-radius: 3px;
            transform: translateX(-50%);
            background-color: #d12881;
            padding: 15px 10px;
            text-align: center;
            width: 250px;
            color: #fff;
        }
    </style>

    <div class="activity-first-dance-section" style="padding: 50px 0;background: url(<?php echo base_url("assets/front/"); ?>images/pattern.gif);overflow: hidden;">
        <div class="container">
            <div class="section-title text-center mab-50">
                <h2 class="mb-2 text-white"><?php echo ucfirst($categorynames->category_name); ?> Categories</h2>
                <div class="line1"></div>
            </div><!-- /section-title -->

            <div class="row">
                <?php
                $institute_program = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($institute_program);
                $this->db->from('program_details');
                $this->db->distinct();
                $institute_program = $this->db->get();
                $speed = 300;
                foreach ($institute_program->result() as $institute_programs) {

                    $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($program_name);
                    $this->db->from('institute_programs');
                    $program_name = $this->db->get();
                    foreach ($program_name->result() as $program_names) {
                        ?>        
                        <div class="col-lg-4 col-sm-6 mab-30">
                            <div class="activity-first-dancebox wow bounceIn" data-wow-delay="<?php echo $speed; ?>ms">
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_programs->image ?>" alt="">
                                <div class="activity-first-dancebox-hoverbox">
                                    <h3 class="mb-3"><?php echo $program_names->program_name; ?></h3>
                                    <p><?php echo $institute_programs->about; ?></p>
                                </div><!-- /activity-first-dancebox-hoverbox -->
                            </div><!-- /activity-first-dancebox -->
                        </div>

                        <?php
                    }

                    $speed = $speed + 100;
                }
                ?>

            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-first-dance-section -->

    <div class="activity-first-gallery-section section-pad" style="overflow: hidden;">
        <div class="container p-0">
            <div class="section-title text-center mab-50">
                <h2 class="mb-2">Gallery</h2>
                <div class="line1"></div>
                <p class="mt-3">See pictures of our Dance class with all the styles and activities. <br>Click on the image to see larger resolution</p>
            </div>

            <div class="row mab-30">
                <?php
                $photo_gallery = "is_active=1 AND category_id=2 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($photo_gallery);
                $this->db->from('institute_images');
                $photo_gallery = $this->db->get();

                foreach ($photo_gallery->result() as $photo_galleries) {
                    ?>

                    <div class="col-lg-3 col-sm-6 p-0">
                        <div class="activity-first-gallerybox wow fadeInUp" data-wow-delay="100ms">
                            <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $photo_galleries->image ?>">
                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $photo_galleries->image ?>" alt="">
                                <div class="activity-first-gallerybox-hover">
                                    <span class="lnr lnr-camera"></span>
                                </div><!-- /activity-first-gallerybox-hover -->
                            </a>
                        </div><!-- /activity-first-gallerybox -->
                    </div>
                    <?php
                }
                ?>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-first-gallery-section -->
    <?php
    $admission = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($admission);
    $this->db->from('institute_admissions');
    $admission = $this->db->get();
    foreach ($admission->result() as $admissions) {
        
    }
    ?>
    <!-- <div class="first-quote-section" style="background: url('<?php echo base_url() ?>laravel/public/<?php echo $admissions->images ?>')center no-repeat;background-attachment:fixed;background-size:cover;">
            <div class="container text-center">
                    <p class="lead"><?php echo $admissions->content; ?></p>
            </div>
    </div> -->

    <div class="activity-news-video-section" style="padding: 80px 0 50px 0;overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mab-30">
                    <div class="img-video" style="width: 100%;height: 350px;overflow: hidden;">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_dets->news_image; ?>" style="width: 100%;height: 350px;object-fit: cover;" alt="">
                    </div>
                    <div style="display: none;" class="youtube-video embed-responsive embed-responsive-16by9 wow slideInLeft" data-wow-delay="300ms">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                    </div><!-- /youtube-video -->
                </div>

                <div class="col-lg-4 mab-30">
                    <div class="section-title mab-30">
                        <h3 class="mb-2 wow slideInRight" data-wow-delay="300ms">News & Events</h3>
                        <div class="line wow slideInRight" data-wow-delay="400ms"></div>
                    </div>
                    <?php
                    $news = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($news);
                    $this->db->from('institute_news');
                    $this->db->order_by('created_at', 'DESC');
                    $this->db->limit('3');
                    $news = $this->db->get();
                    foreach ($news->result() as $institute_news) {
                        ?>
                        <div class="news pb-3 mb-3 border-bottom wow slideInRight" data-toggle="tooltip" data-placement="bottom" title="<?php echo $institute_news->news_brief; ?>" data-wow-delay="500ms">
                            <p><?php echo $institute_news->news; ?></p>
                        </div><!-- /news-events -->
                        <?php
                    }
                    ?>

                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-news-video-section -->

    <div class="activity-first-contact-section" style="overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 border-right">
                    <div class="activity-contact-box text-center wow fadeInUp" data-wow-delay="300ms">
                        <i class="lnr lnr-map-marker"></i>
                        <h4 class="mb-2 mt-3">Our Office Address</h4>
                        <p><?php echo $institute_dets->address; ?></p>
                    </div><!-- /activity-contact-box -->
                </div>

                <div class="col-lg-3 col-md-6 border-right">
                    <div class="activity-contact-box text-center wow fadeInUp" data-wow-delay="500ms">
                        <i class="lnr lnr-envelope"></i>
                        <h4 class="mb-2 mt-3">General Enquiries</h4>
                        <p><?php echo $institute_dets->email; ?></p>
                    </div><!-- /activity-contact-box -->
                </div>

                <div class="col-lg-3 col-md-6 border-right">
                    <div class="activity-contact-box text-center wow fadeInUp" data-wow-delay="700ms">
                        <i class="lnr lnr-phone-handset"></i>
                        <h4 class="mb-2 mt-3">Call Us</h4>
                        <p>+91-<?php echo $institute_dets->mobile; ?></p>

                                <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter5" class="btn btn-primary"><b>View Phone Number</b></a></p> -->
                    </div><!-- /activity-contact-box -->
                </div>

                <!-- Modal -->
                <div class="modal fade view-phone-no" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                            </button>

                            <div class="modal-head">
                                <h5>YUVABHARATHI SCHOOL</h5>
                                <p style="color: #7d7d7d;">Mobile: +91 98XXXXXX45</p>
                            </div>

                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Soma Sundharam">
                                    </div>
                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Country Code</label>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option selected="">IND +91</option>
                                                    <option value="51">USA +1</option>
                                                    <option value="53">ARE +971</option>
                                                    <option value="227">SGP +65</option>
                                                    <option value="57">SAU +966</option>
                                                    <option value="54">CAN +1</option>
                                                    <option value="55">AUS +61</option>
                                                    <option value="215">QAT +974</option>
                                                    <option value="205">OMN +968</option>
                                                    <option value="144">HKG +852</option>
                                                    <option value="60">AFG +93</option>
                                                    <option value="65">AGO +244</option>
                                                    <option value="66">AIA +264</option>
                                                    <option value="61">ALB +355</option>
                                                    <option value="64">AND +376</option>
                                                    <option value="194">ANT +599</option>
                                                    <option value="68">ARG +54</option>
                                                    <option value="69">ARM +374</option>
                                                    <option value="63">ASM +684</option>
                                                    <option value="67">ATG +268</option>
                                                    <option value="71">AZE +994</option>
                                                    <option value="88">BDI +257</option>
                                                    <option value="87">BFA +226</option>
                                                    <option value="74">BGD +880</option>
                                                    <option value="73">BHR +973</option>
                                                    <option value="72">BHS +1242</option>
                                                    <option value="82">BIH +387</option>
                                                    <option value="76">BLR +375</option>
                                                    <option value="78">BLZ +501</option>
                                                    <option value="79">BMU +1441</option>
                                                    <option value="81">BOL +591</option>
                                                    <option value="84">BRA +55</option>
                                                    <option value="75">BRB +1246</option>
                                                    <option value="85">BRN +673</option>
                                                    <option value="80">BTN +975</option>
                                                    <option value="83">BWA +267</option>
                                                    <option value="93">CAF +236</option>
                                                    <option value="243">CHE +41</option>
                                                    <option value="95">CHL +56</option>
                                                    <option value="103">CIV +225</option>
                                                    <option value="90">CMR +237</option>
                                                    <option value="99">COD +243</option>
                                                    <option value="100">COG +242</option>
                                                    <option value="101">COK +682</option>
                                                    <option value="97">COL +57</option>
                                                    <option value="98">COM +269</option>
                                                    <option value="91">CPV +238</option>
                                                    <option value="102">CRI +506</option>
                                                    <option value="105">CUB +53</option>
                                                    <option value="92">CYM +345</option>
                                                    <option value="109">DJI +253</option>
                                                    <option value="110">DMA +767</option>
                                                    <option value="111">DOM +1</option>
                                                    <option value="62">DZA +213</option>
                                                    <option value="113">ECU +593</option>
                                                    <option value="114">EGY +20</option>
                                                    <option value="117">ERI +291</option>
                                                    <option value="119">ETH +251</option>
                                                    <option value="122">FJI +679</option>
                                                    <option value="120">FLK +500</option>
                                                    <option value="121">FRO +298</option>
                                                    <option value="183">FSM +691</option>
                                                    <option value="127">GAB +241</option>
                                                    <option value="129">GEO +995</option>
                                                    <option value="131">GHA +233</option>
                                                    <option value="132">GIB +350</option>
                                                    <option value="139">GIN +224</option>
                                                    <option value="136">GLP +590</option>
                                                    <option value="128">GMB +220</option>
                                                    <option value="140">GNB +245</option>
                                                    <option value="116">GNQ +240</option>
                                                    <option value="135">GRD +473</option>
                                                    <option value="134">GRL +299</option>
                                                    <option value="138">GTM +502</option>
                                                    <option value="125">GUF +594</option>
                                                    <option value="137">GUM +671</option>
                                                    <option value="141">GUY +592</option>
                                                    <option value="143">HND +504</option>
                                                    <option value="142">HTI +509</option>
                                                    <option value="147">IDN +62</option>
                                                    <option value="148">IRN +98</option>
                                                    <option value="149">IRQ +964</option>
                                                    <option value="146">ISL +354</option>
                                                    <option value="151">ISR +972</option>
                                                    <option value="153">JAM +1</option>
                                                    <option value="155">JOR +962</option>
                                                    <option value="154">JPN +81</option>
                                                    <option value="156">KAZ +7</option>
                                                    <option value="157">KEN +254</option>
                                                    <option value="160">KGZ +996</option>
                                                    <option value="89">KHM +855</option>
                                                    <option value="158">KIR +686</option>
                                                    <option value="235">KNA +869</option>
                                                    <option value="184">KOR +373</option>
                                                    <option value="58">KWT +965</option>
                                                    <option value="161">LAO +856</option>
                                                    <option value="163">LBN +961</option>
                                                    <option value="165">LBR +231</option>
                                                    <option value="166">LBY +218</option>
                                                    <option value="236">LCA +758</option>
                                                    <option value="167">LIE +423</option>
                                                    <option value="233">LKA +94</option>
                                                    <option value="164">LSO +266</option>
                                                    <option value="169">LUX +352</option>
                                                    <option value="170">MAC +853</option>
                                                    <option value="188">MAR +212</option>
                                                    <option value="185">MCO +377</option>
                                                    <option value="159">MDA +82</option>
                                                    <option value="172">MDG +261</option>
                                                    <option value="175">MDV +960</option>
                                                    <option value="182">MEX +52</option>
                                                    <option value="171">MKD +389</option>
                                                    <option value="176">MLI +223</option>
                                                    <option value="190">MMR +95</option>
                                                    <option value="186">MNG +976</option>
                                                    <option value="189">MOZ +258</option>
                                                    <option value="179">MRT +222</option>
                                                    <option value="187">MSR +664</option>
                                                    <option value="178">MTQ +596</option>
                                                    <option value="180">MUS +230</option>
                                                    <option value="173">MWI +265</option>
                                                    <option value="174">MYS +60</option>
                                                    <option value="181">MYT +269</option>
                                                    <option value="191">NAM +264</option>
                                                    <option value="196">NCL +687</option>
                                                    <option value="199">NER +227</option>
                                                    <option value="202">NFK +672</option>
                                                    <option value="200">NGA +234</option>
                                                    <option value="198">NIC +505</option>
                                                    <option value="201">NIU +683</option>
                                                    <option value="204">NOR +47</option>
                                                    <option value="193">NPL +977</option>
                                                    <option value="192">NRU +674</option>
                                                    <option value="197">NZL +64</option>
                                                    <option value="56">PAK +92</option>
                                                    <option value="206">PAN +507</option>
                                                    <option value="211">PCN +649</option>
                                                    <option value="209">PER +51</option>
                                                    <option value="210">PHL +63</option>
                                                    <option value="207">PNG +675</option>
                                                    <option value="214">PRI +939</option>
                                                    <option value="203">PRK +850</option>
                                                    <option value="208">PRY +595</option>
                                                    <option value="126">PYF +689</option>
                                                    <option value="216">REU +262</option>
                                                    <option value="270">RNR +260</option>
                                                    <option value="218">RUS +7</option>
                                                    <option value="219">RWA +250</option>
                                                    <option value="224">SCG +381</option>
                                                    <option value="239">SDN +249</option>
                                                    <option value="223">SEN +221</option>
                                                    <option value="234">SHN +290</option>
                                                    <option value="230">SLB +677</option>
                                                    <option value="226">SLE +232</option>
                                                    <option value="115">SLV +503</option>
                                                    <option value="221">SMR +378</option>
                                                    <option value="231">SOM +252</option>
                                                    <option value="237">SPM +508</option>
                                                    <option value="222">STP +239</option>
                                                    <option value="240">SUR +597</option>
                                                    <option value="241">SWZ +268</option>
                                                    <option value="225">SYC +248</option>
                                                    <option value="244">SYR +963</option>
                                                    <option value="256">TCA +649</option>
                                                    <option value="94">TCD +235</option>
                                                    <option value="249">TGO +228</option>
                                                    <option value="248">THA +66</option>
                                                    <option value="246">TJK +992</option>
                                                    <option value="250">TKL +690</option>
                                                    <option value="255">TKM +993</option>
                                                    <option value="112">TLS +670</option>
                                                    <option value="251">TON +676</option>
                                                    <option value="252">TTO +868</option>
                                                    <option value="253">TUN +216</option>
                                                    <option value="254">TUR +90</option>
                                                    <option value="257">TUV +688</option>
                                                    <option value="245">TWN +886</option>
                                                    <option value="247">TZA +255</option>
                                                    <option value="258">UGA +256</option>
                                                    <option value="259">UKR +380</option>
                                                    <option value="260">URY +598</option>
                                                    <option value="261">UZB +998</option>
                                                    <option value="238">VCT +784</option>
                                                    <option value="263">VEN +58</option>
                                                    <option value="265">VGB +284</option>
                                                    <option value="266">VIR +340</option>
                                                    <option value="264">VNM +84</option>
                                                    <option value="262">VUT +678</option>
                                                    <option value="267">WLF +681</option>
                                                    <option value="220">WSM +685</option>
                                                    <option value="268">YEM +967</option>
                                                    <option value="269">YUG +381</option>
                                                    <option value="59">ZAF +27</option>
                                                    <option value="271">ZWE +263</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-8">
                                            <div class="form-group mb-2">
                                                <label for="exampleInputEmail1">Mobile Number</label>
                                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="9963201547">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn-block btn btn-primary">View Phone Number</button>
                                </form>
                            </div>
                        </div><!-- /modal-content -->
                    </div><!-- /modal-dialog -->
                </div><!-- /modal -->

                <div class="col-lg-3 col-md-6">
                    <div class="activity-contact-box text-center wow fadeInUp" data-wow-delay="900ms">
                        <i class="lnr lnr-clock"></i>
                        <h4 class="mb-2 mt-3">Our Timings</h4>
                        <p><?php echo $institute_dets->timings; ?></p>
                    </div><!-- /activity-contact-box -->
                </div>
            </div>
        </div><!-- /container -->
    </div><!-- /activity-first-contact-section -->

    <div class="firstcat-contact-section" style="overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mat-30 wow bounceIn" data-wow-delay="600ms">
                    <iframe src="<?php echo $institute_dets->map_url; ?>" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /firstcat-contact-section -->



    <?php
} else if ($category == 2) {
    $institute_banner = "is_active=1 AND  category_id=3 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($institute_banner);
    $this->db->from('institute_images');
    $this->db->limit('1');
    $institute_banner = $this->db->get();
    foreach ($institute_banner->result() as $institute_banners) {
        
    }
    ?>
    <div class="activity-second-details mab-20" style="overflow: hidden;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mab-30">
                    <div class="activity-second-imagebox wow slideInLeft" data-wow-delay="400ms">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_banners->image ?>" class="w-100" alt="">	
                    </div>
                </div>

                <div class="col-lg-4 mab-30">
                    <div class="name-board wow slideInRight" data-wow-delay="200ms" style="height: 350px;">
                        <div class="title mab-20">
                            <h2 class="wow slideInRight text-white" data-wow-delay="300ms"><?php echo $institute_dets->slug; ?></h2>
                            <p class="wow slideInRight" data-wow-delay="400ms"><i class="fa fa-map-marker"></i> <?php echo $area; ?>,<?php echo $city; ?></p>	
                        </div><!-- /title -->

                                                        <!-- <p class="wow slideInRight" data-wow-delay="500ms">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius aliquam praesentium a non alias error nostrum voluptate similique accusamus sapiente.</p> -->

                        <ul class="list-inline">
                            <?php
                            $institute_program = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                            $this->db->select('*')->where($institute_program);
                            $this->db->from('program_details');
                            $this->db->distinct();
                            $institute_program = $this->db->get();

                            foreach ($institute_program->result() as $institute_programs) {

                                $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                                $this->db->select('*')->where($program_name);
                                $this->db->from('institute_programs');
                                $program_name = $this->db->get();
                                foreach ($program_name->result() as $program_names) {
                                    ?>        
                                    <li class="list-inline-item"><i class="fa fa-angle-right"></i> <?php echo $program_names->program_name; ?></li>

                                <?php }
                            }
                            ?>                            

                        </ul>

                        <a href="#contact" class="btn btn-primary mt-4 wow slideInRight" data-wow-delay="600ms">Contact Us</a>
                    </div><!-- /name-board -->
                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-second-details -->

    <div class="activity-second-about-section" style="padding: 20px 0 60px 0;">
        <div class="container text-center">
            <div class="section-title mab-30">
                <h2 class="display-4 wow fadeInUp" data-wow-delay="300ms">About <?php echo $institute_dets->slug; ?></h2>
                <div class="line1 wow fadeInUp" data-wow-delay="400ms"></div>
            </div><!-- /section-title -->

            <div class="row">
                <div class="col-lg-1"></div>

                <div class="col-lg-10">
                    <p class="wow fadeInUp" data-wow-delay="500ms"><?php echo $institute_dets->about; ?></p>
                </div>

                <div class="col-lg-1"></div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-second-about-section -->

    <div class="activity-second-dance-section section-pad" style="background-color: #031738;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mab-30">
                    <div class="activity-second-dance-imgbox wow slideInLeft" data-wow-delay="300ms">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_dets->logo ?>" class="w-100" alt="">
                    </div><!-- /activity-second-dance-imgbox -->
                </div>

                <div class="col-lg-8 mab-30">
                    <div class="section-title mab-30">
                        <h2 class="text-white wow fadeInUp" data-wow-delay="400ms"><?php echo ucwords($categorynames->category_name); ?></h2>
                        <div class="line wow fadeInUp" data-wow-delay="500ms"></div>
                    </div><!-- /section-title -->

                    <div class="row">
                        <?php
                        $institute_program = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                        $this->db->select('*')->where($institute_program);
                        $this->db->from('program_details');
                        $this->db->distinct();
                        $institute_program = $this->db->get();
                        $speed = 600;
                        foreach ($institute_program->result() as $institute_programs) {

                            $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                            $this->db->select('*')->where($program_name);
                            $this->db->from('institute_programs');
                            $program_name = $this->db->get();
                            foreach ($program_name->result() as $program_names) {
                                ?>        
                                <div class="col-lg-4 col-sm-6 mab-20">
                                    <div class="activity-second-dancebox wow bounceIn" data-wow-delay="<?php echo $speed; ?>ms">
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_programs->image ?>" class="mb-2" alt="">	
                                        <h4 class="mb-2"><?php echo $program_names->program_name; ?></h4>
                                        <p><?php echo $institute_programs->about; ?></p>	
                                    </div><!-- /activity-second-dancebox -->
                                </div>

                            <?php } $speed = $speed + 100;
                        }
                        ?>                        
                    </div><!-- /row -->
                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /activity-second-dance-section -->

    <div class="activity-second-gallery-section section-pad">
        <div class="container">
            <div class="section-title text-center mab-30">
                <h2 class="mb-2">Gallery</h2>
                <div class="line1"></div>
            </div><!-- /section-title -->

            <div class="owl-carousel owl-theme mab-30">

                <?php
                $photo_gallery = "is_active=1 AND category_id=2 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($photo_gallery);
                $this->db->from('institute_images');
                $photo_gallery = $this->db->get();

                foreach ($photo_gallery->result() as $photo_galleries) {
                    ?>

                    <div class="item wow fadeInUp" data-wow-delay="300ms">
                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $photo_galleries->image ?>">
                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $photo_galleries->image ?>" alt="" class="w-100">
                        </a>
                    </div><!-- /item -->

    <?php } ?>
            </div><!-- /owl-carousel -->
        </div><!-- /container -->
    </div><!-- /activity-second-gallery-section -->

    <style>
        .activity-second-gallery-section .owl-nav {
            display: none;
        }
    </style>

    <hr>

    <div class="triple-section" style="margin-top: 60px;" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mab-30 wow bounceIn" data-wow-delay="300ms">
                    <div class="section-title mab-30">
                        <h2>Find Our Location</h2>
                        <div class="line"></div>
                    </div><!-- /section-title -->

                    <iframe src="<?php echo $institute_dets->map_url; ?>" width="100%" height="350" frameborder="0" allowfullscreen></iframe>
                </div>

                <div class="col-lg-4 mab-30">
                    <div class="section-title mab-30">
                        <h2>Location</h2>
                        <div class="line"></div>
                    </div><!-- /section-title -->

                    <div class="address-widget p-5 wow bounceIn"  data-wow-delay="400ms" style="background-color: #7b95ab;border-radius: 6px; height:350px;">
                        <p class="mb-2"><b>Address:</b> <?php echo $institute_dets->address; ?></p>

                        <p class="mb-2"><b>E-mail:</b> <a href="mailto:<?php echo $institute_dets->email; ?>" style="color: #fff;"><?php echo $institute_dets->email; ?></a></p>

                                <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter6" class="text-white"><b>View Phone Number</b></a></p> -->

                        <!-- Modal -->
                        <div class="modal fade view-phone-no" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                    </button>

                                    <div class="modal-head">
                                        <h5>YUVABHARATHI SCHOOL</h5>
                                        <p style="color: #7d7d7d;">Mobile: +91 98XXXXXX45</p>
                                    </div>

                                    <div class="modal-body">
                                        <form action="">
                                            <div class="form-group mb-2">
                                                <label for="exampleInputEmail1">Name</label>
                                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Soma Sundharam">
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Country Code</label>
                                                        <select class="form-control" id="exampleFormControlSelect1">
                                                            <option selected="">IND +91</option>
                                                            <option value="51">USA +1</option>
                                                            <option value="53">ARE +971</option>
                                                            <option value="227">SGP +65</option>
                                                            <option value="57">SAU +966</option>
                                                            <option value="54">CAN +1</option>
                                                            <option value="55">AUS +61</option>
                                                            <option value="215">QAT +974</option>
                                                            <option value="205">OMN +968</option>
                                                            <option value="144">HKG +852</option>
                                                            <option value="60">AFG +93</option>
                                                            <option value="65">AGO +244</option>
                                                            <option value="66">AIA +264</option>
                                                            <option value="61">ALB +355</option>
                                                            <option value="64">AND +376</option>
                                                            <option value="194">ANT +599</option>
                                                            <option value="68">ARG +54</option>
                                                            <option value="69">ARM +374</option>
                                                            <option value="63">ASM +684</option>
                                                            <option value="67">ATG +268</option>
                                                            <option value="71">AZE +994</option>
                                                            <option value="88">BDI +257</option>
                                                            <option value="87">BFA +226</option>
                                                            <option value="74">BGD +880</option>
                                                            <option value="73">BHR +973</option>
                                                            <option value="72">BHS +1242</option>
                                                            <option value="82">BIH +387</option>
                                                            <option value="76">BLR +375</option>
                                                            <option value="78">BLZ +501</option>
                                                            <option value="79">BMU +1441</option>
                                                            <option value="81">BOL +591</option>
                                                            <option value="84">BRA +55</option>
                                                            <option value="75">BRB +1246</option>
                                                            <option value="85">BRN +673</option>
                                                            <option value="80">BTN +975</option>
                                                            <option value="83">BWA +267</option>
                                                            <option value="93">CAF +236</option>
                                                            <option value="243">CHE +41</option>
                                                            <option value="95">CHL +56</option>
                                                            <option value="103">CIV +225</option>
                                                            <option value="90">CMR +237</option>
                                                            <option value="99">COD +243</option>
                                                            <option value="100">COG +242</option>
                                                            <option value="101">COK +682</option>
                                                            <option value="97">COL +57</option>
                                                            <option value="98">COM +269</option>
                                                            <option value="91">CPV +238</option>
                                                            <option value="102">CRI +506</option>
                                                            <option value="105">CUB +53</option>
                                                            <option value="92">CYM +345</option>
                                                            <option value="109">DJI +253</option>
                                                            <option value="110">DMA +767</option>
                                                            <option value="111">DOM +1</option>
                                                            <option value="62">DZA +213</option>
                                                            <option value="113">ECU +593</option>
                                                            <option value="114">EGY +20</option>
                                                            <option value="117">ERI +291</option>
                                                            <option value="119">ETH +251</option>
                                                            <option value="122">FJI +679</option>
                                                            <option value="120">FLK +500</option>
                                                            <option value="121">FRO +298</option>
                                                            <option value="183">FSM +691</option>
                                                            <option value="127">GAB +241</option>
                                                            <option value="129">GEO +995</option>
                                                            <option value="131">GHA +233</option>
                                                            <option value="132">GIB +350</option>
                                                            <option value="139">GIN +224</option>
                                                            <option value="136">GLP +590</option>
                                                            <option value="128">GMB +220</option>
                                                            <option value="140">GNB +245</option>
                                                            <option value="116">GNQ +240</option>
                                                            <option value="135">GRD +473</option>
                                                            <option value="134">GRL +299</option>
                                                            <option value="138">GTM +502</option>
                                                            <option value="125">GUF +594</option>
                                                            <option value="137">GUM +671</option>
                                                            <option value="141">GUY +592</option>
                                                            <option value="143">HND +504</option>
                                                            <option value="142">HTI +509</option>
                                                            <option value="147">IDN +62</option>
                                                            <option value="148">IRN +98</option>
                                                            <option value="149">IRQ +964</option>
                                                            <option value="146">ISL +354</option>
                                                            <option value="151">ISR +972</option>
                                                            <option value="153">JAM +1</option>
                                                            <option value="155">JOR +962</option>
                                                            <option value="154">JPN +81</option>
                                                            <option value="156">KAZ +7</option>
                                                            <option value="157">KEN +254</option>
                                                            <option value="160">KGZ +996</option>
                                                            <option value="89">KHM +855</option>
                                                            <option value="158">KIR +686</option>
                                                            <option value="235">KNA +869</option>
                                                            <option value="184">KOR +373</option>
                                                            <option value="58">KWT +965</option>
                                                            <option value="161">LAO +856</option>
                                                            <option value="163">LBN +961</option>
                                                            <option value="165">LBR +231</option>
                                                            <option value="166">LBY +218</option>
                                                            <option value="236">LCA +758</option>
                                                            <option value="167">LIE +423</option>
                                                            <option value="233">LKA +94</option>
                                                            <option value="164">LSO +266</option>
                                                            <option value="169">LUX +352</option>
                                                            <option value="170">MAC +853</option>
                                                            <option value="188">MAR +212</option>
                                                            <option value="185">MCO +377</option>
                                                            <option value="159">MDA +82</option>
                                                            <option value="172">MDG +261</option>
                                                            <option value="175">MDV +960</option>
                                                            <option value="182">MEX +52</option>
                                                            <option value="171">MKD +389</option>
                                                            <option value="176">MLI +223</option>
                                                            <option value="190">MMR +95</option>
                                                            <option value="186">MNG +976</option>
                                                            <option value="189">MOZ +258</option>
                                                            <option value="179">MRT +222</option>
                                                            <option value="187">MSR +664</option>
                                                            <option value="178">MTQ +596</option>
                                                            <option value="180">MUS +230</option>
                                                            <option value="173">MWI +265</option>
                                                            <option value="174">MYS +60</option>
                                                            <option value="181">MYT +269</option>
                                                            <option value="191">NAM +264</option>
                                                            <option value="196">NCL +687</option>
                                                            <option value="199">NER +227</option>
                                                            <option value="202">NFK +672</option>
                                                            <option value="200">NGA +234</option>
                                                            <option value="198">NIC +505</option>
                                                            <option value="201">NIU +683</option>
                                                            <option value="204">NOR +47</option>
                                                            <option value="193">NPL +977</option>
                                                            <option value="192">NRU +674</option>
                                                            <option value="197">NZL +64</option>
                                                            <option value="56">PAK +92</option>
                                                            <option value="206">PAN +507</option>
                                                            <option value="211">PCN +649</option>
                                                            <option value="209">PER +51</option>
                                                            <option value="210">PHL +63</option>
                                                            <option value="207">PNG +675</option>
                                                            <option value="214">PRI +939</option>
                                                            <option value="203">PRK +850</option>
                                                            <option value="208">PRY +595</option>
                                                            <option value="126">PYF +689</option>
                                                            <option value="216">REU +262</option>
                                                            <option value="270">RNR +260</option>
                                                            <option value="218">RUS +7</option>
                                                            <option value="219">RWA +250</option>
                                                            <option value="224">SCG +381</option>
                                                            <option value="239">SDN +249</option>
                                                            <option value="223">SEN +221</option>
                                                            <option value="234">SHN +290</option>
                                                            <option value="230">SLB +677</option>
                                                            <option value="226">SLE +232</option>
                                                            <option value="115">SLV +503</option>
                                                            <option value="221">SMR +378</option>
                                                            <option value="231">SOM +252</option>
                                                            <option value="237">SPM +508</option>
                                                            <option value="222">STP +239</option>
                                                            <option value="240">SUR +597</option>
                                                            <option value="241">SWZ +268</option>
                                                            <option value="225">SYC +248</option>
                                                            <option value="244">SYR +963</option>
                                                            <option value="256">TCA +649</option>
                                                            <option value="94">TCD +235</option>
                                                            <option value="249">TGO +228</option>
                                                            <option value="248">THA +66</option>
                                                            <option value="246">TJK +992</option>
                                                            <option value="250">TKL +690</option>
                                                            <option value="255">TKM +993</option>
                                                            <option value="112">TLS +670</option>
                                                            <option value="251">TON +676</option>
                                                            <option value="252">TTO +868</option>
                                                            <option value="253">TUN +216</option>
                                                            <option value="254">TUR +90</option>
                                                            <option value="257">TUV +688</option>
                                                            <option value="245">TWN +886</option>
                                                            <option value="247">TZA +255</option>
                                                            <option value="258">UGA +256</option>
                                                            <option value="259">UKR +380</option>
                                                            <option value="260">URY +598</option>
                                                            <option value="261">UZB +998</option>
                                                            <option value="238">VCT +784</option>
                                                            <option value="263">VEN +58</option>
                                                            <option value="265">VGB +284</option>
                                                            <option value="266">VIR +340</option>
                                                            <option value="264">VNM +84</option>
                                                            <option value="262">VUT +678</option>
                                                            <option value="267">WLF +681</option>
                                                            <option value="220">WSM +685</option>
                                                            <option value="268">YEM +967</option>
                                                            <option value="269">YUG +381</option>
                                                            <option value="59">ZAF +27</option>
                                                            <option value="271">ZWE +263</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <div class="form-group mb-2">
                                                        <label for="exampleInputEmail1">Mobile Number</label>
                                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="9963201547">
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn-block btn btn-primary">View Phone Number</button>
                                        </form>
                                    </div>
                                </div><!-- /modal-content -->
                            </div><!-- /modal-dialog -->
                        </div><!-- /modal -->

                        <p><b>Phone:</b> <a href="tel:<?php echo $institute_dets->mobile; ?>" style="color:#fff;">+91 <?php echo $institute_dets->mobile; ?></a></p>


                        <h4 class="mt-4 text-white"><u>Social Links</u></h4>
                        <ul class="list-inline mt-2">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div><!-- /address-widget -->
                </div>

                <div class="col-lg-4 mab-30">
                    <div class="section-title mab-30">
                        <h3 class="mb-2">News & Events</h3>
                        <div class="line"></div>
                    </div><!-- /section-title -->
                    <?php
                    $news = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($news);
                    $this->db->from('institute_news');
                    $this->db->order_by('created_at', 'DESC');
                    $this->db->limit('3');
                    $news = $this->db->get();
                    foreach ($news->result() as $institute_news) {
                        ?>

                        <div class="news wow fadeInLeft pb-3 mb-3 border-bottom" data-toggle="tooltip" data-placement="bottom" title="<?php echo $institute_news->news_brief; ?>" data-wow-delay="600ms">
                            <p class="lead"><?php echo $institute_news->news; ?></p>
                        </div><!-- /news-events -->                    

                        <?php
                    }
                    ?>

                </div>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /triple-section -->

    <?php
    $popular = "is_active=1 AND position_id=1 AND deleted_at IS NULL";
    $this->db->select('*')->where($popular);
    $this->db->from('institute_details');
    $popular = $this->db->get();

    if ($popular->num_rows() > 0) {
        ?>

        <div class="popular-schools mat-50">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Similar Summer Camps in Coimbatore</h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->


                <div class="owl-carousel owl-theme">
                    <?php
                    foreach ($popular->result() as $populars) {

                        $cat_name = "id=$populars->category_id AND deleted_at IS NULL";
                        $this->db->select('*')->where($cat_name);
                        $this->db->from('institute_categories');
                        $cat_name = $this->db->get();

                        foreach ($cat_name->result() as $cat_names) {
                            $category_name = $cat_names->category_name;
                            $category_name = str_replace(" ", "-", $category_name);
                        }


                        $area_name = "is_active=1 AND id=$populars->area_id AND deleted_at IS NULL";
                        $this->db->select('*')->where($area_name);
                        $this->db->from('areas');
                        $area_name = $this->db->get();

                        foreach ($area_name->result() as $area_names) {
                            $area_name = $area_names->area_name;
                            //$area_name = str_replace(" ","-",$area_name);
                        }

                        $institute_name = str_replace(" ", "-", $populars->institute_name);
                        ?>          

                        <div class="item">
                            <figure class="snip1208">
                                <div class="object-cover" style="width: 100%;height: 150px;overflow: hidden;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 150px;object-fit: cover;">
                                </div>
                                <figcaption class="">
                                    <h4><?php echo $populars->institute_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo lcfirst($category_name); ?>-in-coimbatore/<?php echo $institute_name; ?>" target="_blank"></a>
                            </figure>
                        </div><!-- /item -->
                        <?php
                    }
                    ?>


                </div><!-- /owl-carousel -->
            </div><!-- /container -->
        </div><!-- /popular-schools -->    

        <?php
    }
} else if ($category == 3) {
    $institute_banner = "is_active=1 AND  category_id=3 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($institute_banner);
    $this->db->from('institute_images');
    $this->db->limit('1');
    $institute_banner = $this->db->get();
    foreach ($institute_banner->result() as $institute_banners) {
        
    }
    ?>
    <div class="thirdcat-details section-pad" style="padding-top: 0;">
        <div class="container">
            <div class="row mab-20">
                <div class="col-lg-5 mab-30">
                    <div class="third-cat-image wow flipInY" data-wow-delay="300ms">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_banners->image ?>" class="" alt="">
                    </div><!-- /3rd-cat-image -->
                </div>

                <div class="col-lg-7 mab-30">
                    <div class="schoolheading mab-20">
                        <h1 style="text-transform: none;" class="wow fadeInUp" data-wow-delay="300ms"><?php echo $institute_dets->slug; ?></h1>
                        <span class="wow fadeInUp" data-wow-delay="400ms"><i class="fa fa-map-marker"></i> <?php echo $area; ?>,<?php echo $city; ?></a></span>
                    </div><!-- /schoolheading -->

                    <p class="wow fadeInUp" data-wow-delay="500ms"><?php echo $institute_dets->about; ?></p>
                </div>
            </div><!-- /row -->
            <?php
            $institute_program = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
            $this->db->select('*')->where($institute_program);
            $this->db->from('program_details');
            $this->db->distinct();
            $institute_program = $this->db->get();

            $pro_name = array();

            foreach ($institute_program->result() as $institute_programs) {

                $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                $this->db->select('*')->where($program_name);
                $this->db->from('institute_programs');
                $program_name = $this->db->get();
                foreach ($program_name->result() as $program_names) {
                    $pro_name[] = $program_names->program_name;
                }
            }
            if (isset($program_name)) {
                $program_name = implode(",", $pro_name);
            } else {
                $program_name = "-";
            }
            ?>
            <div class="thircat-infosection">
                <div class="row">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="500ms">
                        <div class="section-title mab-30">
                            <h3 class="mb-2">Information about the institute</h3>
                            <!-- <hr> -->
                            <div class="line"></div>
                        </div><!-- /schoolheading -->

                        <div class="third-info-group">
                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Institute Name</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->slug; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Type</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $program_name; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->

                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Founded</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->year_of_establish; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Branches</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->branches; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->

                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>proprietor name</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->proprietor_name; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Specials In</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->specials; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->



                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Address</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->address; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Email</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->email; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->

                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Phone Number</b></p></div>
                                    <div class="col-lg-8">
                                        <p>+91 <?php echo $institute_dets->mobile; ?></p>

                                                <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter5" class="pink"><b>View Phone Number</b></a></p> -->

                                        <!-- Modal -->
                                        <div class="modal fade view-phone-no" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                                    </button>

                                                    <div class="modal-head">
                                                        <h5>YUVABHARATHI SCHOOL</h5>
                                                        <p style="color: #7d7d7d;">Mobile: +91 98XXXXXX45</p>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="">
                                                            <div class="form-group mb-2">
                                                                <label for="exampleInputEmail1">Name</label>
                                                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Soma Sundharam">
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlSelect1">Country Code</label>
                                                                        <select class="form-control" id="exampleFormControlSelect1">
                                                                            <option selected="">IND +91</option>
                                                                            <option value="51">USA +1</option>
                                                                            <option value="53">ARE +971</option>
                                                                            <option value="227">SGP +65</option>
                                                                            <option value="57">SAU +966</option>
                                                                            <option value="54">CAN +1</option>
                                                                            <option value="55">AUS +61</option>
                                                                            <option value="215">QAT +974</option>
                                                                            <option value="205">OMN +968</option>
                                                                            <option value="144">HKG +852</option>
                                                                            <option value="60">AFG +93</option>
                                                                            <option value="65">AGO +244</option>
                                                                            <option value="66">AIA +264</option>
                                                                            <option value="61">ALB +355</option>
                                                                            <option value="64">AND +376</option>
                                                                            <option value="194">ANT +599</option>
                                                                            <option value="68">ARG +54</option>
                                                                            <option value="69">ARM +374</option>
                                                                            <option value="63">ASM +684</option>
                                                                            <option value="67">ATG +268</option>
                                                                            <option value="71">AZE +994</option>
                                                                            <option value="88">BDI +257</option>
                                                                            <option value="87">BFA +226</option>
                                                                            <option value="74">BGD +880</option>
                                                                            <option value="73">BHR +973</option>
                                                                            <option value="72">BHS +1242</option>
                                                                            <option value="82">BIH +387</option>
                                                                            <option value="76">BLR +375</option>
                                                                            <option value="78">BLZ +501</option>
                                                                            <option value="79">BMU +1441</option>
                                                                            <option value="81">BOL +591</option>
                                                                            <option value="84">BRA +55</option>
                                                                            <option value="75">BRB +1246</option>
                                                                            <option value="85">BRN +673</option>
                                                                            <option value="80">BTN +975</option>
                                                                            <option value="83">BWA +267</option>
                                                                            <option value="93">CAF +236</option>
                                                                            <option value="243">CHE +41</option>
                                                                            <option value="95">CHL +56</option>
                                                                            <option value="103">CIV +225</option>
                                                                            <option value="90">CMR +237</option>
                                                                            <option value="99">COD +243</option>
                                                                            <option value="100">COG +242</option>
                                                                            <option value="101">COK +682</option>
                                                                            <option value="97">COL +57</option>
                                                                            <option value="98">COM +269</option>
                                                                            <option value="91">CPV +238</option>
                                                                            <option value="102">CRI +506</option>
                                                                            <option value="105">CUB +53</option>
                                                                            <option value="92">CYM +345</option>
                                                                            <option value="109">DJI +253</option>
                                                                            <option value="110">DMA +767</option>
                                                                            <option value="111">DOM +1</option>
                                                                            <option value="62">DZA +213</option>
                                                                            <option value="113">ECU +593</option>
                                                                            <option value="114">EGY +20</option>
                                                                            <option value="117">ERI +291</option>
                                                                            <option value="119">ETH +251</option>
                                                                            <option value="122">FJI +679</option>
                                                                            <option value="120">FLK +500</option>
                                                                            <option value="121">FRO +298</option>
                                                                            <option value="183">FSM +691</option>
                                                                            <option value="127">GAB +241</option>
                                                                            <option value="129">GEO +995</option>
                                                                            <option value="131">GHA +233</option>
                                                                            <option value="132">GIB +350</option>
                                                                            <option value="139">GIN +224</option>
                                                                            <option value="136">GLP +590</option>
                                                                            <option value="128">GMB +220</option>
                                                                            <option value="140">GNB +245</option>
                                                                            <option value="116">GNQ +240</option>
                                                                            <option value="135">GRD +473</option>
                                                                            <option value="134">GRL +299</option>
                                                                            <option value="138">GTM +502</option>
                                                                            <option value="125">GUF +594</option>
                                                                            <option value="137">GUM +671</option>
                                                                            <option value="141">GUY +592</option>
                                                                            <option value="143">HND +504</option>
                                                                            <option value="142">HTI +509</option>
                                                                            <option value="147">IDN +62</option>
                                                                            <option value="148">IRN +98</option>
                                                                            <option value="149">IRQ +964</option>
                                                                            <option value="146">ISL +354</option>
                                                                            <option value="151">ISR +972</option>
                                                                            <option value="153">JAM +1</option>
                                                                            <option value="155">JOR +962</option>
                                                                            <option value="154">JPN +81</option>
                                                                            <option value="156">KAZ +7</option>
                                                                            <option value="157">KEN +254</option>
                                                                            <option value="160">KGZ +996</option>
                                                                            <option value="89">KHM +855</option>
                                                                            <option value="158">KIR +686</option>
                                                                            <option value="235">KNA +869</option>
                                                                            <option value="184">KOR +373</option>
                                                                            <option value="58">KWT +965</option>
                                                                            <option value="161">LAO +856</option>
                                                                            <option value="163">LBN +961</option>
                                                                            <option value="165">LBR +231</option>
                                                                            <option value="166">LBY +218</option>
                                                                            <option value="236">LCA +758</option>
                                                                            <option value="167">LIE +423</option>
                                                                            <option value="233">LKA +94</option>
                                                                            <option value="164">LSO +266</option>
                                                                            <option value="169">LUX +352</option>
                                                                            <option value="170">MAC +853</option>
                                                                            <option value="188">MAR +212</option>
                                                                            <option value="185">MCO +377</option>
                                                                            <option value="159">MDA +82</option>
                                                                            <option value="172">MDG +261</option>
                                                                            <option value="175">MDV +960</option>
                                                                            <option value="182">MEX +52</option>
                                                                            <option value="171">MKD +389</option>
                                                                            <option value="176">MLI +223</option>
                                                                            <option value="190">MMR +95</option>
                                                                            <option value="186">MNG +976</option>
                                                                            <option value="189">MOZ +258</option>
                                                                            <option value="179">MRT +222</option>
                                                                            <option value="187">MSR +664</option>
                                                                            <option value="178">MTQ +596</option>
                                                                            <option value="180">MUS +230</option>
                                                                            <option value="173">MWI +265</option>
                                                                            <option value="174">MYS +60</option>
                                                                            <option value="181">MYT +269</option>
                                                                            <option value="191">NAM +264</option>
                                                                            <option value="196">NCL +687</option>
                                                                            <option value="199">NER +227</option>
                                                                            <option value="202">NFK +672</option>
                                                                            <option value="200">NGA +234</option>
                                                                            <option value="198">NIC +505</option>
                                                                            <option value="201">NIU +683</option>
                                                                            <option value="204">NOR +47</option>
                                                                            <option value="193">NPL +977</option>
                                                                            <option value="192">NRU +674</option>
                                                                            <option value="197">NZL +64</option>
                                                                            <option value="56">PAK +92</option>
                                                                            <option value="206">PAN +507</option>
                                                                            <option value="211">PCN +649</option>
                                                                            <option value="209">PER +51</option>
                                                                            <option value="210">PHL +63</option>
                                                                            <option value="207">PNG +675</option>
                                                                            <option value="214">PRI +939</option>
                                                                            <option value="203">PRK +850</option>
                                                                            <option value="208">PRY +595</option>
                                                                            <option value="126">PYF +689</option>
                                                                            <option value="216">REU +262</option>
                                                                            <option value="270">RNR +260</option>
                                                                            <option value="218">RUS +7</option>
                                                                            <option value="219">RWA +250</option>
                                                                            <option value="224">SCG +381</option>
                                                                            <option value="239">SDN +249</option>
                                                                            <option value="223">SEN +221</option>
                                                                            <option value="234">SHN +290</option>
                                                                            <option value="230">SLB +677</option>
                                                                            <option value="226">SLE +232</option>
                                                                            <option value="115">SLV +503</option>
                                                                            <option value="221">SMR +378</option>
                                                                            <option value="231">SOM +252</option>
                                                                            <option value="237">SPM +508</option>
                                                                            <option value="222">STP +239</option>
                                                                            <option value="240">SUR +597</option>
                                                                            <option value="241">SWZ +268</option>
                                                                            <option value="225">SYC +248</option>
                                                                            <option value="244">SYR +963</option>
                                                                            <option value="256">TCA +649</option>
                                                                            <option value="94">TCD +235</option>
                                                                            <option value="249">TGO +228</option>
                                                                            <option value="248">THA +66</option>
                                                                            <option value="246">TJK +992</option>
                                                                            <option value="250">TKL +690</option>
                                                                            <option value="255">TKM +993</option>
                                                                            <option value="112">TLS +670</option>
                                                                            <option value="251">TON +676</option>
                                                                            <option value="252">TTO +868</option>
                                                                            <option value="253">TUN +216</option>
                                                                            <option value="254">TUR +90</option>
                                                                            <option value="257">TUV +688</option>
                                                                            <option value="245">TWN +886</option>
                                                                            <option value="247">TZA +255</option>
                                                                            <option value="258">UGA +256</option>
                                                                            <option value="259">UKR +380</option>
                                                                            <option value="260">URY +598</option>
                                                                            <option value="261">UZB +998</option>
                                                                            <option value="238">VCT +784</option>
                                                                            <option value="263">VEN +58</option>
                                                                            <option value="265">VGB +284</option>
                                                                            <option value="266">VIR +340</option>
                                                                            <option value="264">VNM +84</option>
                                                                            <option value="262">VUT +678</option>
                                                                            <option value="267">WLF +681</option>
                                                                            <option value="220">WSM +685</option>
                                                                            <option value="268">YEM +967</option>
                                                                            <option value="269">YUG +381</option>
                                                                            <option value="59">ZAF +27</option>
                                                                            <option value="271">ZWE +263</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-8">
                                                                    <div class="form-group mb-2">
                                                                        <label for="exampleInputEmail1">Mobile Number</label>
                                                                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="9963201547">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn-block btn btn-primary">View Phone Number</button>
                                                        </form>
                                                    </div>
                                                </div><!-- /modal-content -->
                                            </div><!-- /modal-dialog -->
                                        </div><!-- /modal -->
                                    </div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Website</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $institute_dets->website_url; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->
                        </div><!-- /info-table-group -->
                    </div>
                    <?php
                    $institute_activity = "is_active=1 AND  category_id=2 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($institute_activity);
                    $this->db->from('institute_images');
                    $total_image = $this->db->get();
                    $school_image = array();
                    foreach ($total_image->result() as $total_images) {
                        $school_image[] = $total_images->image;
                    }
                    $count = count($school_image);
                    // exit();
                    ?>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="800ms">
                        <div class="section-title mab-30">
                            <h3 class="mb-2">Gallery</h3>
                            <!-- <hr> -->
                            <div class="line"></div>
                        </div><!-- /schoolheading -->

                        <div class="gallery-group">
                            <?php
                            $ms = 100;
                            for ($img = 0; $img < $count; $img++) {

                                if ($img < 12) {
                                    ?>
                                    <div class="gallery-box border wow fadeInUp" data-wow-delay="<?php echo $ms; ?>ms">
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $school_image[$img]; ?>">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_image[$img]; ?>" alt="">   
                                            <?php
                                            if ($img == 11 && $count > 12) {
                                                $extra = $count - $img;
                                                //    echo $extra;
                                                //    exit();                               
                                                ?>
                                                <div class="gallery-box-last">
                                                    <p>+<?php echo $extra - 1; ?></p>
                                                </div>
            <?php } ?>                                                     
                                        </a>
                                    </div><!-- /gallery-box -->

        <?php } else { ?>

                                    <div class="gallery-box border wow fadeInUp" style="display:none;" data-wow-delay="<?php echo $ms; ?>ms">
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $school_image[$img]; ?>">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_image[$img]; ?>" alt="">   
                                        </a>
                                    </div><!-- /gallery-box -->                  
                                    <?php
                                }
                                $ms = $ms + 200;
                            }
                            ?>
                        </div><!-- /gallery-group -->
                    </div>
                </div>		
            </div><!-- /thircat-infosection -->
        </div><!-- /container -->
    </div><!-- /thirdcat-details -->

    <?php
    $popular = "is_active=1 AND position_id=1 AND deleted_at IS NULL";
    $this->db->select('*')->where($popular);
    $this->db->from('institute_details');
    $popular = $this->db->get();

    if ($popular->num_rows() > 0) {
        ?>

        <div class="popular-schools mat-50">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Similar Summer Camps in Coimbatore</h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->


                <div class="owl-carousel owl-theme">
                    <?php
                    foreach ($popular->result() as $populars) {

                        $cat_name = "id=$populars->category_id AND deleted_at IS NULL";
                        $this->db->select('*')->where($cat_name);
                        $this->db->from('institute_categories');
                        $cat_name = $this->db->get();

                        foreach ($cat_name->result() as $cat_names) {
                            $category_name = $cat_names->category_name;
                            $category_name = str_replace(" ", "-", $category_name);
                        }


                        $area_name = "is_active=1 AND id=$populars->area_id AND deleted_at IS NULL";
                        $this->db->select('*')->where($area_name);
                        $this->db->from('areas');
                        $area_name = $this->db->get();

                        foreach ($area_name->result() as $area_names) {
                            $area_name = $area_names->area_name;
                            //$area_name = str_replace(" ","-",$area_name);
                        }

                        $institute_name = str_replace(" ", "-", $populars->institute_name);
                        ?>          

                        <div class="item">
                            <figure class="snip1208">
                                <div class="object-cover" style="width: 100%;height: 150px;overflow: hidden;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore" style="width: 100%;height: 150px;object-fit: cover;">
                                </div>
                                <figcaption class="">
                                    <h4><?php echo $populars->institute_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo lcfirst($category_name); ?>-in-coimbatore/<?php echo $institute_name; ?>" target="_blank"></a>
                            </figure>
                        </div><!-- /item -->
        <?php } ?>

                </div><!-- /owl-carousel -->
            </div><!-- /container -->
        </div><!-- /popular-schools -->  
        <?php
    }
}
?>

<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #fff;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
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
        <img src="<?php echo base_url("assets/front/") ?>images/feed.png" class="toggle" alt="feedback">   
    </div>

    <div class="feedback-head">
        <div class="media mb-2">
            <div class="media-left">
                <img src="<?php echo base_url("assets/front/") ?>images/support.png" width="45px" alt="feedback">
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
//    $('.carousel').carousel({
//        interval: 3000,
//        pause: "false"
//    })
 $(window).on("load", function () {
        //Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
    new WOW().init();

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

    $(document).ready(function () {
        // Back-to-top
        var btt = $('.back-to-top');

        btt.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
        });

        $(window).on('scroll', function () {
            var self = $(this),
                    height = self.height(),
                    top = self.scrollTop();

            if (top > height) {
                if (!btt.is(':visible')) {
                    btt.show();
                }
            } else {
                btt.hide();
            }
        });
    });
</script>
 
 