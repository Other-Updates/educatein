<?php
$aff_url = end($this->uri->segments);
$aff_url = str_replace("-", " ", $aff_url);
$this->db->select('in.*,ic.category_name as type')->where('in.institute_name =', $aff_url);
$this->db->from('institute_details as in');
$this->db->join('institute_categories as ic','in.category_id = ic.id','left');
$institute_det = $this->db->get();
// print_r($this->db->last_query());exit;
foreach ($institute_det->result() as $institute_dets) {
    $category = $institute_dets->position_id;
    $institute_id = $institute_dets->id;
}
$this->db->select('*');
$this->db->where('institute_id',$institute_id);
$this->db->where('category_id',1);
$this->db->from('institute_images');
$about_img_ = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Founded' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$founded = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Special' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$special = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='students' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$students = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Events' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$events = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Achievements' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$achievements = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Teachers' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$teachers = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Branches' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$branches = $this->db->get()->result_array();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND heading='Language' AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_platinum_datas');
$language = $this->db->get()->result_array();

$where = "is_active=1 AND category_id=2 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_images');
$gallery = $this->db->get()->result();

$where = "pd.is_active=1 AND pd.institute_id=" . $institute_dets->id . " AND pd.deleted_at is NULL";
$this->db->select('pd.*,ip.program_name');
$this->db->where($where);
$this->db->join('institute_programs as ip','pd.program_id=ip.id','left');
$this->db->from('program_details as pd');
$inst_categories = $this->db->get()->result();

$where = "is_active=1 AND institute_id=" . $institute_dets->id . " AND deleted_at is NULL";
$this->db->select('*')->where($where);
$this->db->from('institute_news');
$news_heading = $this->db->get()->result();
?>
<div class="breadrumb-new mnone">
    <div class="container-fluid" style="padding: 0 60px;">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <?php
                    $this->db->select('*')->where('id =', $school_details->affiliation_id);
                    $this->db->from('affiliations');
                    $affiliationname = $this->db->get();
                    foreach ($affiliationname->result() as $affiliationnames) {
                        
                    }
                    $affiliation_name = str_replace(" ", "-", $affiliationnames->affiliation_name);
                    ?>
                    <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-<?php echo $yourcity; ?>"><?php echo ucwords($affiliationnames->affiliation_name); ?> Schools</a></li>
                    <li class="list-inline-item"><i class="fa fa-angle-right"></i></li>
                    <?php
                    $slug = strtolower($school_details->slug);
                    $slug = ucwords($slug);
                    ?>
                    <li class="list-inline-item"><?php echo $slug; ?></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-12 text-right">
                <p>Find the Right School with us!</p>
            </div>
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /breadrumb-new -->
<div class="educatein-school-detail">
    <div class="esd-banner">
        <div class="esd-banner-bg"></div>
        <div class="container">
            <div class="esd-banner-details wow fadeIn infinite">
                <div class="row">
                    <?php if(!empty($institute_det->logo)){ ?>
                        <div class="col-md-3 esd-banner-left"><div class="esd-banner-details-img"><img src="<?php echo base_url() ?>laravel/public/<?php echo $institute_det->logo ?>" alt=""></div></div>
                    <?php }else{ ?>
                        <div class="col-md-3 esd-banner-left"><div class="esd-banner-details-img"><img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" alt=""></div></div>
                    <?php } ?>
                    <div class="col-md-9 esd-banner-right">
                        <div class="esd-banner-details-right">
                            <div class="esd-banner-details-tit wow fadeIn" data-wow-delay="300ms"><?php echo ucfirst($institute_dets->slug) ?></div>
                            <div class="esd-banner-details-address"><i class="fa fa-map-marker"></i> <?php echo $institute_dets->address ?></div>
                            <div class="clearfix"></div>
                            <div class="row esd-banner-details-hightlight">
                                <div class="col-md-2">
                                    <div class="esd-banner-details-hightlight-tit"><i class="fa fa-star text-yellow"></i> 4.0</div>
                                    <div class="esd-banner-details-hightlight-suntit">Parent Ratings</div>
                                </div>
                                <div class="col-md-3">
                                    <div class="esd-banner-details-hightlight-tit"><i class="fa fa-star text-theme"></i> 4.0</div>
                                    <div class="esd-banner-details-hightlight-suntit">Educatein Ratings</div>
                                </div>
                                <div class="col-md-2">
                                    <div class="esd-banner-details-hightlight-tit"><?php echo ucfirst($institute_dets->type) ?></div>
                                    <div class="esd-banner-details-hightlight-suntit">Type</div>
                                </div>
                                <!-- <div class="col-md-5">
                                    <div class="esd-banner-details-hightlight-tit"><?php echo ucfirst($school_types->school_type) ?></div>
                                    <div class="esd-banner-details-hightlight-suntit">Grade Level</div>
                                </div> -->
                            </div>
                            <div class="clearfix"></div>
                            <div class="esd-banner-details-btn">
                                <button class="btn btn-theme1 wow flipInY" data-wow-delay="500ms"><i class="fa fa-map-marker"></i> Show School On Map</button>
                                <button class="btn btn-theme2 wow flipInY" data-wow-delay="700ms"><i class="fa fa-phone"></i> Call School</button>
                                <button class="btn btn-theme1-border wow flipInY" data-wow-delay="900ms"><img src="https://www.edugatein.com/images/new.gif" alt=""> Admission open now</button>
                                <button type="button" class="btn btn-theme2-border wow flipInY" data-toggle="modal" data-target="#exampleModalCenter" data-wow-delay="1000ms">
                                    Admission Enquiry
                                </button>
                                <!-- <button class="btn btn-theme2-border"><i class="fa fa-eye"></i> Page Views : 135</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <ul id="sd-menu" class="sd-menu-list wow bounce">
            <li class="sd-menu-item"><a href="#about-info">About Info</a></li>
            <li class="sd-menu-item"><a href="#addit-info">Additional Info</a></li>
            <li class="sd-menu-item"><a href="#special-info">Special Info</a></li>
            <li class="sd-menu-item"><a href="#sd-gallery">Gallery</a></li>
            <li class="sd-menu-item"><a href="#school-activ">Activities</a></li>
            <li class="sd-menu-item"><a href="#school-facilities">Facilities</a></li>
            <li class="sd-menu-item"><a href="#contact-info">Contact</a></li>
            <li class="sd-menu-item"><a href="#social-links">Social Links</a></li>
        </ul>
        <div class="row" >
            <div class="col-md-9">           
                <div id="about-info" class="sd-inner-main about-info section wow slideInLeft">
                    <div class="sd-ection-tit">About Info</div>
                    <div class="sd-ection-inner">
                        <div class="row">
                            <div class="col-md-3 about-info-img">
                                <a data-fancybox="gallery" data-caption="" href="<?php echo base_url() ?>laravel/public/<?php echo $about_img_[0]['image'] ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $about_img_[0]['image'] ?>" class="sd-about-img" alt=""></a>
                            </div>
                            <div class="col-md-9">
                                <p><?php echo ucfirst($institute_dets->about); ?></p><br>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="addit-info" class="sd-inner-main addit-info section wow slideInLeft">
                    <div class="sd-ection-tit">Additional Info</div>
                    <div class="sd-ection-inner">
                        <div class="row">
                            <?php if(!empty($founded)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/1.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Founded</h6>
                                            <h3><?php echo $founded[0]['content'] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($special)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/2.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Special</h6>
                                            <h3><?php echo ucfirst($special[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($events)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/3.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Events</h6>
                                            <h3><?php echo ucfirst($events[0]['content']) ?> </h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($achievements)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/4.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Achievements</h6>
                                            <h3><?php echo ucfirst($achievements[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            <?php if(!empty($branches)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/5.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Branches</h6>
                                            <h3><?php echo ucfirst($branches[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($academic)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/6.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Academic History</h6>
                                            <h3><?php echo ucfirst($academic[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($activity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/7.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Activity</h6>
                                            <h3><?php echo ucfirst($activity[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>    
                            <?php if(!empty($students)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/11.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No.of Students</h6>
                                            <h3><?php echo $students[0]['content'] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($teachers)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/12.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No.of Teachers</h6>
                                            <h3><?php echo $teachers[0]['content'] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($language)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/13.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Languages</h6>
                                            <h3><?php echo ucfirst($language[0]['content']) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if(!empty($gallery)){ ?>
                    <div id="sd-gallery" class="sd-inner-main gallery wow slideInLeft">
                        <div class="sd-ection-tit">Gallery</div>
                        <div class="sd-ection-inner">
                            <div class="row">
                                <?php foreach($gallery as $gallery_data){ ?>
                                    <div class="col-md-4">
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $gallery_data->image ?>">   
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $gallery_data->image ?>" alt="">
                                        </a>
                                    </div>
                                <?php } ?>
                                <!-- <div class="col-md-4">
                                    <a data-fancybox="gallery" href="<?php echo base_url() ?>assets/front/images/kinder_1.jpg">   
                                        <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a data-fancybox="gallery" href="<?php echo base_url() ?>assets/front/images/kinder_1.jpg">   
                                        <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" alt="">
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(isset($school_activity)){ ?>
                    <div id="school-activ" class="sd-inner-main school-activ wow slideInLeft">
                        <div class="sd-ection-tit">School Activities</div>
                        <div class="sd-ection-inner">
                            <div class="row">
                                <?php 
                                foreach($school_activity->result() as $activity){ ?>
                                    <div class="col-md-3 school-activ-list">
                                        <div class="school-activ-list-img"><a data-fancybox="gallery" data-caption="<?php echo ucfirst($activity->name) ?>" href="<?php echo base_url() ?>laravel/public/<?php echo $activity->image ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $activity->image ?>" alt=""></a></div>
                                        <h6><?php echo ucfirst($activity->name) ?> </h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(isset($inst_categories)){ ?>
                    <div id="school-facilities" class="sd-inner-main school-facilities wow slideInLeft">
                        <div class="sd-ection-tit">Institute Categories</div>
                        <div class="sd-ection-inner">
                            <?php foreach($inst_categories as $category ){ ?>
                                <div class="row school-facilities-list">
                                    <div class="col-md-3 sd-faci-img">
                                        <a data-fancybox="gallery" data-caption="<?php echo ucfirst($category->program_name) ?>" href="<?php echo base_url() ?>laravel/public/<?php echo $category->image ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $category->image ?>" class="sd-faci-img" alt=""></a>
                                    </div>
                                    <div class="col-md-9 sd-faci-detail">
                                        <h6><?php echo ucfirst($category->program_name) ?></h6>
                                        <p><?php echo ucfirst($category->about) ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(isset($news_heading)){ ?>
                    <div id="school-facilities" class="sd-inner-main school-facilities wow slideInLeft">
                        <div class="sd-ection-tit">News Heading</div>
                        <div class="sd-ection-inner">
                            <?php foreach($news_heading as $news ){ ?>
                                <div class="row school-facilities-list">
                                    <!-- <div class="col-md-3 sd-faci-img">
                                        <a data-fancybox="gallery" data-caption="<?php echo ucfirst($category->program_name) ?>" href="<?php echo base_url() ?>laravel/public/<?php echo $category->image ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $category->image ?>" class="sd-faci-img" alt=""></a>
                                    </div> -->
                                    <div class="col-md-9 sd-faci-detail">
                                        <h6><?php echo ucfirst($news->news) ?></h6>
                                        <p><?php echo ucfirst($news->news_brief) ?></p>
                                    </div>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3 pl-0-web">
                <div class="sd-inner-main sd-sidebar wow fadeInUp">
                    <div class="sd-ection-tit">Similar Schools</div>
                    <?php foreach($similar_school as $similar){ ?>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <?php if(!empty($similar->logo)){ ?>
                            <img src="<?php echo base_url() ?>public/laravel/<?php echo $similar->logo ?>" class="sd-sidebar-img" alt="">
                            <?php } else { ?>
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                            <?php } ?>
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="<?php echo base_url() ?>list-of-best-<?php echo $similar->aff ?>-schools-in-<?php echo $yourcity; ?>/<?php echo str_replace(" ","-",$similar->school_name); ?>" target="_blank"> <?php echo $similar->school_name ?></a></h3>
                            <h6><?php echo $similar->address ?></h6>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="ads-school-widget mb-3 wow fadeInUp">
                    <div class="ads-inner"><p>Ads Here</p></div>
                </div>
                <div class="sd-inner-main sd-sidebar wow fadeInUp">
                    <div class="sd-ection-tit">Recent News</div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                    <div class="row sd-sidebar-list">
                        <div class="col-md-4 sd-sidebar-list-left">
                            <img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" class="sd-sidebar-img" alt="">
                        </div>
                        <div class="col-md-8 sd-sidebar-list-right">
                            <h3><a href="#"> St Joseph's Matriculation Higher Secondary School</a></h3>
                            <h6>1591, Trichy Road, Coimbatore – 641018. Tamilnadu. INDIA</h6>
                        </div>
                    </div>
                </div>
                <div class="ads-school-widget mb-3 wow fadeInUp">
                    <div class="ads-inner"><p>Ads Here</p></div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div id="contact-info" class="col-md-12">
                <div class="sd-inner-main contact-info wow fadeInUp">
                    <div class="sd-ection-tit">Contact Information</div>
                    <div class="sd-ection-inner">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/24.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Address</h6>
                                        <h3><?php echo $institute_dets->address; ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/25.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Phone Number</h6>
                                        <h3><?php echo $institute_dets->mobile ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/26.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Email</h6>
                                        <h3><?php echo $institute_dets->email ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/27.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Website</h6>
                                        <a href="<?php echo $institute_dets->website_url ?>"><h3><?php echo $institute_dets->website_url ?></h3></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">Map
                            <?php echo $institute_dets->map_url; ?>
                            </div>
                            <!-- <div class="col-lg-8 mab-30 wow bounceIn" data-wow-delay="600ms">
                    <iframe src="<?php echo $school_details->map_url; ?>" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div> -->
                        </div>
                    </div>
                </div> 
            </div>
            <div class="clearfix"></div>
            <div id="social-links" class="col-md-12">
                <div class="sd-inner-main social-links wow fadeInUp">
                    <div class="sd-ection-tit">Social Links</div>
                    <div class="sd-ection-inner">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?php echo $school_details->facebook ?>">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/28.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Facebook</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo $school_details->twitter ?>">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/29.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Twitter</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo $school_details->instagram ?>">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/30.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Instagram</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo $school_details->linkedin ?>">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/31.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Linked in</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="<?php echo $school_details->pinterest ?>">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/32.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Pinterest</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="ads-school-widget mab-50">
            <div class="row">
                <div class="col-md-4"><div class="ads-inner"><p>Ads Here</p></div></div>
                <div class="col-md-4"><div class="ads-inner"><p>Ads Here</p></div></div>
                <div class="col-md-4"><div class="ads-inner"><p>Ads Here</p></div></div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#sd-menu a').click(function(e) {
        $('#sd-menu a').removeClass('active');
        $(this).addClass('active');
    });
</script>
<script>
    $(function() {
        $('a[href*=\\#]:not([href=\\#])').on('click', function() {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
            if (target.length) {
                $('html,body').animate({
                scrollTop: (target.offset().top - 60)
                }, 1000);
                return false;
            }
        });
    });
</script>
<script>
    let distance = $('#sd-menu').offset().top,
        $window = $(window);
        $window.scroll(function() {
            if($window.scrollTop() >= distance){
                $('#sd-menu').addClass("sticky");
            } else {
                $('#sd-menu').removeClass("sticky");
            }
        });
</script>

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
 
 