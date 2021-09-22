<?php
$school_strength = array();
$aff_url = end($this->uri->segments);
$aff_url = str_replace("-", " ", $aff_url);
$this->db->select('*')->where('school_name =', $aff_url);
$this->db->from('school_details');
$schooldet = $this->db->get();
foreach ($schooldet->result() as $schooldets) {
    $category = $schooldets->school_category_id;
    $school_id = $schooldets->id;
}
$this->db->select('*')->where('id =', $school_id);
$this->db->from('school_details');
$school_detail = $this->db->get();
foreach ($school_detail->result() as $school_details) {
    $view_count = $school_details->view_count;
}
$this->db->set('view_count', $view_count + 1)->where('id', $school_details->id)->update('school_details');
$this->db->select('*')->where('id =', $school_details->city_id);
$this->db->from('cities');
$city = $this->db->get();
foreach ($city->result() as $cities) {
    //echo $areas->area_name;
    //exit();
}
$this->db->select('*')->where('id =', $school_details->schooltype_id);
$this->db->from('school_types');
$school_type = $this->db->get();
foreach ($school_type->result() as $school_types) {
    //echo $areas->area_name;
    //exit();
}
$this->db->select('*')->where('id =', $school_details->area_id);
$this->db->from('areas');
$area = $this->db->get();
foreach ($area->result() as $areas) {
    //echo $areas->area_name;
    //exit();
}
$this->db->select('*')->where('id =', $school_details->city_id);
$this->db->from('cities');
$city = $this->db->get();
foreach ($city->result() as $cities) {
    //echo $areas->area_name;
    //exit();
}
$this->db->select('*')->where('id =', $school_details->affiliation_id);
$this->db->from('affiliations');
$affili = $this->db->get();
foreach ($affili->result() as $affilis) {
    //echo $areas->area_name;
    //exit();
}
$yourcity = array();
$aff_url = $this->uri->segment(1);
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
// echo $yourcity;
// exit();
    //platinum_datas
    $found_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Founded' AND deleted_at is NULL";
    $this->db->select('*')->where($found_data);
    $this->db->from('platinum_datas');
    $founded = $this->db->get()->result_array();

    $special_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Special' AND deleted_at is NULL";
    $this->db->select('*')->where($special_data);
    $this->db->from('platinum_datas');
    $special = $this->db->get()->result_array();

    $events_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Events' AND deleted_at is NULL";
    $this->db->select('*')->where($events_data);
    $this->db->from('platinum_datas');
    $events = $this->db->get()->result_array();

    $achievements_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Achievements' AND deleted_at is NULL";
    $this->db->select('*')->where($achievements_data);
    $this->db->from('platinum_datas');
    $achievements = $this->db->get()->result_array();

    $branch_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Branches' AND deleted_at is NULL";
    $this->db->select('*')->where($branch_data);
    $this->db->from('platinum_datas');
    $branches = $this->db->get()->result_array();

    $academic_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Academic' AND deleted_at is NULL";
    $this->db->select('*')->where($academic_data);
    $this->db->from('platinum_datas');
    $academic = $this->db->get()->result_array();

    $activity_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='activity' AND deleted_at is NULL";
    $this->db->select('*')->where($activity_data);
    $this->db->from('platinum_datas');
    $activity = $this->db->get()->result_array();

    $language_data = "is_active=1 AND school_id=" . $school_details->id . " AND heading='Language' AND deleted_at is NULL";
    $this->db->select('*')->where($language_data);
    $this->db->from('platinum_datas');
    $language = $this->db->get()->result_array();

    //schoolmanagement activities
    $management_data = "is_active=1 AND schooldetails_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('*');
    $this->db->where($management_data);
    $this->db->from('schoolmanagement_activities');
    $management= $this->db->get()->result_array();

    //school activities
    $this->db->select('si.images as image,sa.activity_name as name');
    $this->db->from('school_images as si');
    $this->db->where('si.school_id',$school_details->id);
    $this->db->where('si.school_activity_id>2');
    $this->db->where('si.school_activity_id!=',169);
    $this->db->where('si.school_activity_id!=',170);
    $this->db->where('si.school_activity_id!=',71);
    $this->db->join('school_activities as sa','si.school_activity_id=sa.id');
    $school_activity = $this->db->get();

    //school facilities
    $facility = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at IS NULL";
    $this->db->select('*')->where($facility);
    $this->db->from('school_facilities');
    $facility = $this->db->get();

    //about image
    $this->db->select('*');
    $this->db->where('school_activity_id',1);
    $this->db->where('school_id',$school_details->id);
    $this->db->from('school_images');
    $about_img = $this->db->get()->result_array();

    //school managementactivities
    $this->db->select('*')->where('schooldetails_id',$school_details->id);
    $this->db->from('schoolmanagement_activities');
    $management = $this->db->get()->result_array();

    $this->db->select('sd.*,ci.city_name,af.affiliation_name as aff');
    $this->db->where('sd.affiliation_id',$school_details->affiliation_id);
    $this->db->where('sd.city_id',$school_details->city_id);
    $this->db->where('sd.id!=',$school_details->id);
    $this->db->where('sd.deleted_at',NULL);
    $this->db->where('sd.status',1);
    $this->db->where('sd.school_category_id',$school_details->school_category_id);
    $this->db->from('school_details as sd');
    $this->db->join('affiliations as af','sd.affiliation_id=af.id','left');
    $this->db->join('cities as ci','sd.city_id=ci.id','left');
    $this->db->order_by("sd.id", "desc");
    $this->db->limit(6);
    $similar_school = $this->db->get()->result();

    $this->db->select('*');
    $this->db->where('school_id',$school_details->id);
    $this->db->where('school_activity_id',71);
    $this->db->from('school_images');
    $gallery = $this->db->get()->result();
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
                    <?php if(!empty($school_details->logo)){ ?>
                        <div class="col-md-3 esd-banner-left"><div class="esd-banner-details-img"><img src="<?php echo base_url() ?>laravel/public/<?php echo $school_details->logo ?>" alt=""></div></div>
                    <?php }else{ ?>
                        <div class="col-md-3 esd-banner-left"><div class="esd-banner-details-img"><img src="<?php echo base_url() ?>assets/front/images/kinder_1.jpg" alt=""></div></div>
                    <?php } ?>
                    <div class="col-md-9 esd-banner-right">
                        <div class="esd-banner-details-right">
                            <div class="esd-banner-details-tit wow fadeIn" data-wow-delay="300ms"><?php echo ucfirst($school_details->slug) ?></div>
                            <div class="esd-banner-details-address"><i class="fa fa-map-marker"></i> <?php echo $school_details->address ?></div>
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
                                    <div class="esd-banner-details-hightlight-tit"><?php echo ucfirst($affilis->affiliation_name) ?></div>
                                    <div class="esd-banner-details-hightlight-suntit">School Board</div>
                                </div>
                                <div class="col-md-5">
                                    <div class="esd-banner-details-hightlight-tit"><?php echo ucfirst($school_types->school_type) ?></div>
                                    <div class="esd-banner-details-hightlight-suntit">Grade Level</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="esd-banner-details-btn">
                                <button class="btn btn-theme1 wow flipInY" data-wow-delay="500ms"><i class="fa fa-map-marker"></i> Show School On Map</button>
                                <button class="btn btn-theme2 wow flipInY" data-wow-delay="700ms"><i class="fa fa-phone"></i> Call School</button>
                                <?php if(!empty($school_details->ad)){ ?>
                                    <button class="btn btn-theme1-border wow flipInY" data-wow-delay="900ms"><img src="https://www.edugatein.com/images/new.gif" alt=""> <?php echo $school_details->ad; ?></button>
                                <?php }else{ ?>
                                    <button class="btn btn-theme1-border wow flipInY" data-wow-delay="900ms"><img src="https://www.edugatein.com/images/new.gif" alt=""> Admission open now</button>
                                <?php } ?>
                                <button type="button" class="btn btn-theme2-border wow flipInY" data-toggle="" data-target="#exampleModalCenter" data-wow-delay="1000ms">
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
                                <a data-fancybox="gallery" data-caption="" href="<?php echo base_url() ?>laravel/public/<?php echo $about_img[0]['images'] ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $about_img[0]['images'] ?>" class="sd-about-img" alt=""></a>
                            </div>
                            <div class="col-md-9">
                                <p><?php echo ucfirst($school_details->about); ?></p><br>
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
                            <?php if(!empty($special)){ ?>
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
                            <?php if(!empty($school_details->boys)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/8.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No of Boys</h6>
                                            <h3><?php echo $school_details->boys ?></h3>
                                        </div>
                                    </div>
                                </div>       
                            <?php } ?>      
                            <?php if(!empty($school_details->students)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/11.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No.of Students</h6>
                                            <h3><?php echo $school_details->students ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($school_details->teachers)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/12.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No.of Teachers</h6>
                                            <h3><?php echo $school_details->teachers ?></h3>
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
                            <?php if(!empty($school_details->girls)){ ?>               
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/14.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>No of Girls</h6>
                                            <h3><?php echo $school_details->girls ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($school_details->our_vision)){ ?>               
                                <div class="col-md-12">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/9.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Vision</h6>
                                            <h3><?php echo ucfirst($school_details->our_vision) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($school_details->our_mission)){ ?>               
                                <div class="col-md-12">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/10.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Mission</h6>
                                            <h3><?php echo ucfirst($school_details->our_mission) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(!empty($school_details->our_motto)){ ?>               
                                <div class="col-md-12">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/15.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h6>Motto</h6>
                                            <h3><?php echo ucfirst($school_details->our_motto) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php $selectedActivity = array();
                     foreach($management as $key=>$management_data){ 
                        $selectedActivity[] = $management_data['activity_name'];
                      } ?>
                <div id="special-info" class="sd-inner-main special-info section wow slideInLeft">
                    <div class="sd-ection-tit">Special Info</div>
                    <div class="sd-ection-inner">
                        <div class="row">
                            <?php if( in_array('playground',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/16.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Playground</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('kidsplay',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/17.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Kids Playcorner</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('transport',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/33.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Transportation</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('curriculam',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/18.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Curriculam</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('fieldtrips',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/19.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Field Trips</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('special activity',$selectedActivity)){ ?>    
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/34.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Activity</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('opportunities',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/20.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Opportunities</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('clubs',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/21.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Clubs</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if( in_array('progressive',$selectedActivity)){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/22.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Progressive Learning</h3>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if($school_details->hostel == 1){ ?>
                                <div class="col-md-6">
                                    <div class="sd-addit-icon-value">
                                        <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/23.png" alt="Educatein"></div>
                                        <div class="sd-addit-value">
                                            <h3>Hostel Facility</h3>
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
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $gallery_data->images ?>">   
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $gallery_data->images ?>" alt="">
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
                <?php if(isset($facility)){ ?>
                    <div id="school-facilities" class="sd-inner-main school-facilities wow slideInLeft">
                        <div class="sd-ection-tit">School Facilities</div>
                        <div class="sd-ection-inner">
                            <?php foreach($facility->result() as $facility_data ){ ?>
                                <div class="row school-facilities-list">
                                    <div class="col-md-3 sd-faci-img">
                                        <a data-fancybox="gallery" data-caption="<?php echo ucfirst($facility_data->facility) ?>" href="<?php echo base_url() ?>laravel/public/<?php echo $facility_data->image ?>"><img src="<?php echo base_url() ?>laravel/public/<?php echo $facility_data->image ?>" class="sd-faci-img" alt=""></a>
                                    </div>
                                    <div class="col-md-9 sd-faci-detail">
                                        <h6><?php echo ucfirst($facility_data->facility) ?></h6>
                                        <p><?php echo ucfirst($facility_data->content) ?></p>
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
                            <h3><a href="<?php echo base_url() ?>list-of-best-<?php echo $similar->aff ?>-schools-in-<?php echo $yourcity; ?>/<?php echo str_replace(" ","-",$similar->school_name); ?>" target="_blank"> <?php echo ucfirst($similar->school_name) ?></a></h3>
                            <h6><?php echo $similar->address ?></h6>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="ads-school-widget mb-3 wow fadeInUp">
                    <div class="ads-inner"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/9-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
                </div>
                <!-- <div class="sd-inner-main sd-sidebar wow fadeInUp">
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
                </div> -->
                <div class="ads-school-widget mb-3 wow fadeInUp">
                    <div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/2-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div>
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
                                        <h3><?php echo $school_details->address ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/25.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Phone Number</h6>
                                        <h3><?php echo $school_details->mobile ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/26.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Email</h6>
                                        <h3><?php echo $school_details->email ?></h3>
                                    </div>
                                </div>
                                <div class="sd-addit-icon-value">
                                    <div class="sd-addit-icon"><img src="<?php echo base_url() ?>assets/front/images/icons/sd/27.png" alt="Educatein"></div>
                                    <div class="sd-addit-value">
                                        <h6>Website</h6>
                                        <h3><?php echo $school_details->website_url ?></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php echo $school_details->map_url; ?>
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
                <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/1-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
                <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/2-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
                <div class="col-md-4"><div class="ads-inner"><img src="<?php echo base_url() ?>assets/front/images/static-ads/9-ads.png" class="w-100" alt="Best Offer in <?php echo $city; ?>" /></div></div>
            </div>
        </div><br>
    </div>
    <div class="container">
        <div class="custom-section-title">
            <h3 class="mb-2">Similar Schools</h3>
        </div>
        <?php //foreach($similar_school as $similar) ?>
        <div class="home-tsw top-school-widget mab-50">
            <div class="owl-two owl-carousel owl-theme">
                <?php foreach($similar_school as $key=>$similar){ ?>
                    <div class="item wow bounceIn premium" style="animation-delay: .<?php echo $delay; ?>s;">
                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $similar->aff ?>-schools-in-<?php echo $yourcity; ?>/<?php echo str_replace(" ","-",$similar->school_name); ?>" target="_blank">
                            <figure>
                                <div class="package-name">Premium</div>
                                <div class="object-fit">
                                    <?php if(!empty($similar->logo)){ ?>
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $similar->logo ?>" class="w-100" alt="best <?php echo $similar->aff ?> schools in <?php echo $yourcity; ?>" />
                                            <?php } else { ?>
                                        <img src="<?php echo base_url() ?>assets/front/images/list-default.png" class="w-100" alt="best <?php echo $similar->aff ?> schools in <?php echo $city; ?>" />
                                        <?php } ?>
                                </div>
                                <figcaption class="item-footer">
                                    <h6><?php echo ucfirst($similar->school_name) ?></h6>
                                    <p><i class="fa fa-book"></i> Grades : KG To Class 10</p>
                                </figcaption>

                            </figure>
                        </a>
                    </div>
                <?php } ?>
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

<?php
if(0){
if ($category == 1) {
    $school_img = "is_active=1 AND  school_activity_id=2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($school_img);
    $this->db->from('school_images');
    $school_image = $this->db->get();
    ?>    <div class="firstcat-details-group">
        <div class="container-fluid px-0">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner firstcat-sliding-section">
                    <?php
                    $banner_count = 0;
                    foreach ($school_image->result() as $school_images) {
                        if ($banner_count < 3) {
                            if ($banner_count == 0) {
                                ?>                           
                                <div class="carousel-item item active">
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_images->images ?>" class="" alt="">
                                </div>
                                <?php
                            } else {

                                if (isset($school_images->images)) {
                                    ?>
                                    <div class="carousel-item item">
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_images->images ?>" class="" alt="">
                                    </div>

                                    <?php
                                }
                            }
                        }
                        $banner_count++;
                        //  echo $school_images->images;
                    }
// exit();
                    ?>
                    <div class="firstcat-slide-info">
                        <h1 class="text-white wow slideInLeft" data-wow-delay="300ms"><?php echo $school_details->slug; ?></h1>
                        <ul class="list-inline mab-20 wow slideInLeft" data-wow-delay="500ms">
                            <li class="list-inline-item"><i class="fa fa-map-marker"></i> <u><?php echo $areas->area_name; ?></u></li>
                            <li class="list-inline-item">|</li>
                            <li class="list-inline-item"><?php echo $affilis->affiliation_name; ?></li>
                        </ul>
                        <!-- <a href="" target="_blank" class="btn btn-apply wow slideInLeft" data-wow-delay="600ms">Apply Now &nbsp;<span class="lnr lnr-arrow-right"></span></a> -->
                    </div><!-- /firstcat-slide-info -->
                </div><!-- /firstcat-sliding-section -->
            </div>
        </div><!-- /container-fluid -->
    </div><!-- /firstcat-details-group -->
    <div class="marquee my-3">
        <marquee behavior="scroll" onMouseOver="this.stop()" onMouseOut="this.start()" scrollamount="10" direction="left">
            <img src="https://www.edugatein.com/images/new.gif" alt=""> <?php echo $school_details->ad; ?></marquee>
    </div><!-- /marquee -->
    <div class="first-detail-infowidgets mab-50">
        <div class="container-fluid" style="padding: 0 80px;">
            <div class="row">
                <?php
                $special_data = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($special_data);
                $this->db->from('platinum_datas');
                $special_data = $this->db->get();
                $special_data_count = 0;
                $second = 300;
                foreach ($special_data->result() as $special_datas) {
                    if ($special_data_count < 6) {
                        ?>
                        <style>
                            .first-detail-infowidgets-imgbox {
                                border: 1px solid #eee;
                                border-radius: 8px;
                                padding: 15px;
                                margin-bottom: 30px;
                                background-color: #fff;
                                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
                                transition: all 0.3s cubic-bezier(.25,.8,.25,1);
                            }
                            .first-detail-infowidgets-imgbox small {
                                display: block;
                            }
                            .first-detail-infowidgets-imgbox .lead {
                                font-weight: bold;
                            }
                            @media (min-width: 992px) and (max-width: 1200px) {
                                .first-detail-infowidgets .col-lg-2 {
                                    flex: 0 0 33.333333%;
                                    max-width: 33.333333%;
                                }
                            }
                            @media (min-width: 320px) and (max-width: 575px) {
                                .facility-widget .flying .butterfly {
                                    display: none;
                                }
                                .dotCircle, .round {
                                    display: none;
                                }
                                .contentCircle {
                                    top: 60px;
                                }
                                .holderCircle {
                                    width: 100%;
                                    left: 50%;
                                    transform: translateX(-50%);
                                    margin: 0;
                                }
                            }
                        </style>
                        <div class="col-lg-2 col-md-4 col-sm-6 mab-30">
                            <div class="first-detail-infowidgets-imgbox text-center h-100 wow slideInDown" data-toggle="tooltip" data-placement="bottom" title="<?php echo $special_datas->brief_content ?>" data-wow-delay="<?php echo $second; ?>ms">
                                <img class="mb-2" src="<?php echo base_url() ?>laravel/public/<?php echo $special_datas->icon ?>" width="50px" alt="">
                                <small class="pink"><?php echo $special_datas->heading ?></small>
                                <p class="lead blue"><?php echo $special_datas->content ?></p>
                            </div><!-- /first-detail-infowidgets-imgbox -->
                        </div>
                        <?php
                        $second = $second + 100;
                    }
                    $special_data_count++;
                }
                ?>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /first-detail-infowidgets -->

    <div class="firstcat-about-section section-pad pt-0">
        <div class="container">
            <div class="section-heading text-center mab-50">
                <h2 class="wow fadeInUp" data-wow-delay="300ms">About <?php echo $school_details->slug; ?></h2>
            </div><!-- /section-heading -->

            <div class="row mab-50">
                <div class="col-lg-6 mab-30">
                    <h2 class="mb-3 wow slideInLeft" style="color: #303030;" data-wow-delay="400ms">Welcome to <br><?php echo $school_details->slug; ?></h2>
                    <p class="wow slideInLeft" data-wow-delay="500ms"><?php echo $school_details->about; ?></p>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mt-4 wow slideInLeft" data-toggle="modal" data-target="#exampleModalCenter" data-wow-delay="500ms">
                        Admission Enquiry
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                    </button>
                                    <h3 class="text-center mb-3" style="color: #303030;">Admission Enquiry</h3>

                                    <form action="<?php echo base_url() ?>schooldetail/admission" class="row" method="post">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" placeholder="First Name*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your Email*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="number" step="any" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" placeholder="Phone Number*" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6" style="display:none">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="schoolid" name="schoolid" aria-describedby="emailHelp" value="<?php echo $school_details->id; ?>" >
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" id="enquiry" name="enquiry" placeholder="Enquiry" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!-- /modal -->
                </div>

                <style>
                    .firstcat-about-section ::placeholder {
                        font-size: 12px;
                    }
                </style>
                <?php
                $special_img = "is_active=1 AND  school_activity_id=1 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
                $this->db->select('*')->where($special_img);
                $this->db->from('school_images');
                $special_image = $this->db->get();

                $special_count = 0;
                foreach ($special_image->result() as $special_images) {
                    if ($special_count < 2) {
                        if ($special_count == 0) {
                            ?>                    
                            <div class="col-lg-6 mab-30">
                                <div class="firstcat-about-imgbox wow flipInY" data-wow-delay="500ms">
                                    <img src="<?php echo base_url() ?>laravel/public/<?php echo $special_images->images ?>" class="rounded" alt="">	
                                </div><!-- /firstcat-about-imgbox -->
                            </div>
                        </div><!-- /row -->
                        <?php
                    } else {

                        if (isset($special_images->images)) {
                            ?>
                            <div class="row">
                                <div class="col-lg-6 mab-30">
                                    <div class="firstcat-about-imgbox1 wow flipInY" data-wow-delay="600ms">
                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $special_images->images ?>" class="rounded" alt="">	
                                    </div><!-- /firstcat-about-imgbox -->
                                </div>
                                <?php
                            }
                        }
                    }
                    $special_count++;
                }
                $management = "is_active=1 AND schooldetails_id=" . $school_details->id . " AND deleted_at is NULL AND icon is not NULL";
                $this->db->select('*')->where($management);
                $this->db->from('schoolmanagement_activities');
                $management = $this->db->get();
                ?>
                <div class="col-lg-6 mab-30">
                    <section class="iq-features wow slideInRight" data-wow-delay="700ms">
                        <div class="holderCircle">
                            <div class="round"></div>
                            <div class="dotCircle">
                                <?php
                                $manage_count = 0;
                                foreach ($management->result() as $managements) {

                                    if ($manage_count < 6) {

                                        if ($manage_count == 0) {
                                            ?>                                
                                            <span class="itemDot active itemDot<?php echo $manage_count + 1; ?>" data-tab="<?php echo $manage_count + 1; ?>">
                                                <i class="fa fa-clock-o"></i>
                                                <span class="forActive"></span>
                                            </span>
                                            <?php
                                        } else {
                                            if (isset($managements->icon)) {
                                                ?>
                                                <span class="itemDot itemDot<?php echo $manage_count + 1; ?>" data-tab="<?php echo $manage_count + 1; ?>">
                                                    <i class="<?php echo $managements->icon; ?>"></i>
                                                    <span class="forActive"></span>
                                                </span>

                                                <?php
                                            }
                                        }
                                    }
                                    $manage_count++;
                                }
// echo $manage_count;
// echo "<br>"; 
                                ?>

                            </div>


                            <div class="contentCircle">
                                <?php
                                $content_count = 0;
                                foreach ($management->result() as $managements) {
                                    if ($content_count < 6) {

                                        if ($content_count == 0) {
                                            ?>                                
                                            <div class="CirItem title-box active CirItem<?php echo $content_count + 1; ?>">
                                                <h2 class="title"><span><?php echo $managements->activity_name; ?></span></h2>
                                                <p><?php echo $managements->content; ?></p>
                                                <i class="<?php echo $managements->icon; ?>"></i>
                                            </div>
                                            <?php
                                        } else {
                                            if (isset($managements->icon)) {
                                                // echo "1";
                                                ?>
                                                <div class="CirItem title-box CirItem<?php echo $content_count + 1; ?>">
                                                    <h2 class="title"><span><?php echo $managements->activity_name; ?></span></h2>
                                                    <p><?php echo $managements->content; ?></p>
                                                    <i class="<?php echo $managements->icon; ?>"></i>
                                                </div>

                                                <?php
                                            }
                                        }
                                    }
                                    $content_count++;
                                }
                                // exit();
                                ?>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div><!-- /container -->
    </div><!-- /firstcat-about-section -->
    <?php
    $admission = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($admission);
    $this->db->from('school_admissions');
    $admission = $this->db->get();

    foreach ($admission->result() as $admissions) {
        ?>
        <div class="first-quote-section" data-parallax="scroll" data-image-src="<?php echo base_url() ?>laravel/public/<?php echo $admissions->image; ?>">
            <div class="container text-center">
                <p class="lead"><?php echo $admissions->content; ?></p>
            </div><!-- /container -->
        </div><!-- /first-quote-section -->
    <?php } ?>

    <style>
        .swiper-slide {
            width: 100%;
            height: 300px;
            overflow: hidden;
        }
        .swiper-slide img {
            width: 100%;
            height: 300px;
            object-fit: cover;  
        }
    </style>

    <?php
    $school_activity = "is_active=1 AND  school_activity_id>2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('school_activity_id')->where($school_activity);
    $this->db->from('school_images');
    $this->db->distinct();
    $school_activity = $this->db->get();
    ?>

    <div class="firstcat-activity-section section-pad pb-0">
        <div class="container">
            <div class="section-title mab-30">
                <h2>School Activities</h2>
                <div class="line"></div>
            </div><!-- /section-heading -->

            <div class="row">
                <?php
                $ms = 300;
                foreach ($school_activity->result() as $school_activitys) {
                    ?>

                    <div class="col-lg-3 col-md-6 mb-3 col-sm-6 mab-30">
                        <?php
                        $actname = "id = " . $school_activitys->school_activity_id . " ";
                        $this->db->select('*')->where($actname);
                        $this->db->from('school_activities');
                        $activityname = $this->db->get();
                        foreach ($activityname->result() as $activitynames) {
                            ?>

                            <h4 class="mb-3 text-center"><?php echo $activitynames->activity_name; ?></h4>
                        <?php } ?>

                        <div class="swiper-container wow bounceIn" data-wow-delay="<?php echo $ms; ?>ms">
                            <div class="swiper-wrapper">
                                <?php
                                $image = "is_active=1  AND school_id=" . $school_details->id . " AND  school_activity_id = " . $activitynames->id . "";
                                $this->db->select('*')->where($image);
                                $this->db->from('school_images');
                                $image = $this->db->get();

                                foreach ($image->result() as $images) {
                                    ?>

                                    <div class="swiper-slide">
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $images->images ?>">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $images->images ?>" class="w-100">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div><!-- /swiper-container -->
                    </div>

                    <?php $ms = $ms + 200;
                }
                ?>
            </div><!-- /row -->
        </div><!-- /container -->
    </div><!-- /firstcat-activity-section -->

    <?php
// $graph_data = "is_active=1 AND id=".$schooldets->id." AND deleted_at is NULL";    
// $this->db->select('boys,girls,teachers')->where($graph_data);
// $this->db->from('school_details');
// $graph_data = $this->db->get();
// $data = array();
// foreach($graph_data->result() as $graph_datas)
// {
//     if(isset($graph_datas->boys))
//     { 
//         $data[]=$graph_datas->boys;
//     }
//     if(isset($graph_datas->girls))
//     { 
//         $data[]=$graph_datas->girls;
//     }
//     if(isset($graph_datas->teachers))
//     { 
//         $data[]=$graph_datas->teachers;
//     }
// }
// if(isset($data))
// {
// $pie_graph = implode(",",$data);
// }
// $bargraph_data = "is_active=1 AND school_id=".$schooldets->id." AND deleted_at is NULL";    
// $this->db->select('year,pass_percent')->where($bargraph_data);
// $this->db->from('pass_percents');
// $bargraph_data = $this->db->get();
// foreach($bargraph_data->result() as $bargraph_datas)
// {
//     $bar_year[]=$bargraph_datas->year;
//     $bar_pass[]=$bargraph_datas->pass_percent;
// }
// if(isset($bar_pass)){ 
//     $bar_pass = implode(",",$bar_pass);
// }
// if(isset($bar_year)){
//     $bar_year = implode(",",$bar_year);
// }
    ?>
    <!-- <div class="first-gallery-section section-pad">
        <div class="container">
            <div class="row"> -->
    <?php
// if(strlen($pie_graph) > 0)
// {
    ?>
    <!-- <div class="col-lg-6 mab-30">
        <div class="section-title mab-30 wow fadeInUp" data-wow-delay="300ms">
            <h2 class="mb-2">Students vs Teachers </h2>
            <div class="line"></div>
        </div>
        <canvas id="myChart" width="400" height="300"></canvas>
    </div> -->
    <?php
// }
// if(isset($bar_year) && isset($bar_pass)) { 
    ?>
    <!-- <div class="col-lg-6 mab-30">
        <div class="section-title mab-30 wow fadeInUp" data-wow-delay="500ms">
            <h2 class="mb-2">Pass Percentage</h2>
            <div class="line"></div>
        </div>

        <canvas id="myChart1" width="400" height="300"></canvas>
    </div> -->
    <?php // }  ?>            
    <!--        </div> /row -->
    <!--   </div> /container -->
    <!--</div> /first-gallery-section --> 
    <?php
//}
    ?>
    <div class="facility-widget section-pad">
        <div class="container">
            <div class="section-title mab-50">
                <h2 class=" wow slideInLeft" data-wow-delay="300ms">Our Facilities</h2>
                <div class="line wow slideInLeft" data-wow-delay="500ms"></div>
            </div><!-- /section-title -->

            <div id="carouselExampleControls" class="carousel slide mab-80" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $facility = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at IS NULL";

                    $this->db->select('*')->where($facility);
                    $this->db->from('school_facilities');

                    $facility = $this->db->get();
                    $loopcount = 0;
                    foreach ($facility->result() as $facilities) {
                        if ($loopcount == 0) {
                            ?>

                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-lg-3 wow bounceIn" data-wow-delay="500ms">
                                        <div class="facility-widget-imgbox">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $facilities->image ?>" class="rounded-circle" alt="">
                                        </div><!-- /facility-widget-imgbox -->
                                    </div>
                                    <div class="col-lg-9 wow bounceIn pl-4 pt-5" data-wow-delay="600ms">
                                        <h4 class="mb-3"><?php echo $facilities->facility ?></h4>
                                        <p class="mb-3"><?php echo $facilities->content ?></p>
                                    </div>
                                </div><!-- /row -->
                            </div><!-- /carousel-item -->
                            <?php
                        } else {
                            ?>                           
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="facility-widget-imgbox">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $facilities->image ?>" class="rounded-circle" alt="">
                                        </div><!-- /facility-widget-imgbox -->
                                    </div>
                                    <div class="col-lg-9 pl-4 pt-5">
                                        <h4 class="mb-3"><?php echo $facilities->facility ?></h4>
                                        <p class="mb-3"><?php echo $facilities->content ?></p>
                                    </div>
                                </div><!-- /row -->
                            </div><!-- /carousel-item -->
                            <?php
                        }
                        $loopcount++;
                    }
                    ?>


                </div><!-- /carousel-inner -->

                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- /carousel -->

            <div class="flying">
                <img class="butterfly wow bounceIn" data-wow-delay="300ms" src="https://www.edugatein.com/images/girl.png" alt="">
                <img class="flower wow bounceIn" data-wow-delay="400ms" src="https://www.edugatein.com/images/star.png" alt="">
                <img class="pencil wow bounceIn" data-wow-delay="500ms" src="https://www.edugatein.com/images/flower.png" alt="">
            </div>
        </div><!-- /container -->
    </div><!-- /firstcat-facility-section -->


    <div class="firstcat-contact-section section-pad pb-0">
        <div class="container">
            <div class="section-title mab-30">
                <h2 class="wow slideInLeft" data-wow-delay="300ms">Find Our Location</h2>
                <div class="line wow slideInLeft" data-wow-delay="400ms"></div>
            </div>

            <div class="row">
                <div class="col-lg-4 mab-30">
                    <div class="address-widget p-5 bg-dark wow bounceIn" data-wow-delay="500ms">
                        <h2 class="mb-3 text-white">Location</h2>
                        <p class="mb-2"><span class="exo"><b>Address:</b></span> <?php echo $school_details->address; ?></p>

                        <p class="mb-2"><span class="exo text-white"><b>E-mail:</b></span> 
                            <a href="mailto:info@yuvabharathi.in" class="text-white"><?php echo $school_details->email; ?></a>
                        </p>

                        <p class="mb-2"><span class="exo"><b>Phone:</b></span> 
                            <a href="tel:8220059603" style="color:#fff;">+91 <?php echo $school_details->mobile; ?></a>
                        </p>

                            <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter5" class="text-white"><b>View Phone Number</b></a></p> -->



                        <h4 class="mt-4 text-white"><u>Social Links</u></h4>
                        <ul class="list-inline mt-2">
                            <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <!-- <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                            <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div><!-- /address-widget -->
                </div>

                <div class="col-lg-8 mab-30 wow bounceIn" data-wow-delay="600ms">
                    <iframe src="<?php echo $school_details->map_url; ?>" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div><!-- /container -->
    </div><!-- /firstcat-contact-section -->

    <!-- Modal -->
    <div class="modal fade view-phone-no" id="exampleModalCenter5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                </button>

                <div class="modal-head">
                    <h5>YUVABHARATHI SCHOOL</h5>
                    <p>Mobile: +91 98XXXXXX45</p>
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


    <?php
} elseif ($category == 2) {
    $school_img = "is_active=1 AND  school_activity_id=2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($school_img);
    $this->db->from('school_images');
    $school_image = $this->db->get();
    foreach ($school_image->result() as $school_images) {
        
    }
    ?>
    <div class="second-cat-details-group mab-50 mat-50">
        <div class="container">
            <div class="schoolheading mab-30">
                <h1 class="mb-2 wow fadeInUp" data-wow-delay="300ms" style="text-transform: none;"><?php echo $school_details->slug; ?></h1>
                <ul class="list-inline wow fadeInUp" data-wow-delay="500ms">
                    <li class="list-inline-item"><span class="lnr lnr-map-marker"></span> <?php echo $areas->area_name; ?></li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item"><b><span class="lnr lnr-apartment"></span> <?php echo $affilis->affiliation_name; ?></b></li>
                </ul>
            </div><!-- /schoolheading -->

            <div class="second-img-group">
                <div class="row">
                    <div class="col-lg-8 col-md-7 mab-30">
                        <div class="second-img-box wow fadeInUp" data-wow-delay="600ms" style="height: 100%;">
                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_images->images ?>" alt="">
                        </div><!-- /second-img-box -->
                    </div>
                    <?php
                    $special_data = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($special_data);
                    $this->db->from('platinum_datas');
                    $special_data = $this->db->get();


                    foreach ($special_data->result() as $special_datas) {
                        
                    }
                    ?>            
                    <style>
                        .second-info-widget {
                            border: 0px;
                            border-radius: 0px;
                        }
                        .second-info-widget li {
                            border-bottom: 0px;
                            color: #303030;
                            background-color: #eaeaea;
                            margin-bottom: 3px;
                        }
                        .second-info-widget li:last-child {
                            margin-bottom: 0px;
                        }
                        .second-img-group .second-img-box img {
                            height: 362px;
                        }
                    </style>

                    <div class="col-lg-4 col-md-5 mab-30">
                        <div class="second-info-widget h-100 wow fadeInUp" data-wow-delay="700ms">
                            <ul class="list-unstyled">
                                <?php
                                $special_count = 0;
                                foreach ($special_data->result() as $special_datas) {
                                    if ($special_count < 6) {
                                        ?>
                                        <li>
                                            <b><i class="<?php echo $special_datas->icon_class; ?>"></i> <?php echo $special_datas->heading; ?>:</b> &nbsp;<?php echo $special_datas->content; ?>
                                        </li>

                                        <?php
                                    }
                                    $special_count++;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div><!-- /row -->
            </div><!-- /second-img-group -->
        </div><!-- /container -->

        <style>
            .second-about-info {
                background: url('../images/bg-stripe.png') repeat-x top left scroll transparent;
                padding: 80px 0;
            }
        </style>

        <div class="second-about-info">
            <div class="container">
                <div class="section-title mab-20">
                    <h2 class="mb-2 wow fadeInUp text-center" data-wow-delay="300ms">About <?php echo $school_details->slug; ?></h2>
                    <div class="line1 wow fadeInUp" data-wow-delay="400ms"></div>
                </div><!-- /schoolheading -->

                <p class="wow fadeInUp text-white text-center" data-wow-delay="500ms"><?php echo $school_details->about; ?></p>
            </div><!-- /container -->
        </div><!-- /second-about-info -->


        <div class="second-activity-group py-5">
            <div class="container">
                <div class="section-title mab-30">
                    <h4 class="mb-2 wow fadeInUp" data-wow-delay="100ms">School Activities</h4>
                    <div class="line wow fadeInUp" data-wow-delay="200ms"></div>
                </div><!-- /schoolheading -->

                <div class="row">

                    <?php
                    $act = "is_active=1 AND school_activity_id > 2 AND school_id=" . $school_details->id . " AND deleted_at IS NULL";

                    $this->db->select('school_activity_id')->where($act);
                    $this->db->from('school_images');
                    $this->db->distinct();
                    $activity = $this->db->get();

                    foreach ($activity->result() as $activitys) {

                        $actname = "id = " . $activitys->school_activity_id . " AND deleted_at IS NULL";
                        $this->db->select('*')->where($actname);
                        $this->db->from('school_activities');
                        $activityname = $this->db->get();
                        foreach ($activityname->result() as $activitynames) {



                            $activity_image = "is_active=1  AND school_id=" . $school_details->id . " AND  school_activity_id = " . $activitynames->id . " AND deleted_at IS NULL";
                            $this->db->select('*')->where($activity_image);
                            $this->db->from('school_images');
                            $activity_image = $this->db->get();


                            // foreach($all_activity_image->result() as $all_activity_images)
                            // { 
                            //     $all_school_image[] = $all_activity_images->images;
                            // }
                            $act_img_count = 0;
                            foreach ($activity_image->result() as $activity_images) {
                                ?>

                <?php if ($act_img_count == 0) { ?>

                                    <div class="col-lg-2 col-md-3 col-sm-6 text-center mab-30 wow fadeInUp" data-wow-delay="300ms">
                                        <a data-fancybox="gallery" href="<?php echo base_url() ?>laravel/public/<?php echo $activity_images->images ?>">  
                                            <div class="second-activity-imgbox gallery-box wow fadeInUp">                                
                                                <img src="<?php echo base_url() ?>laravel/public/<?php echo $activity_images->images ?>" class="w-100 rounded-circle" alt="">                               
                                            </div>
                                            <p class="lead mt-2"><?php echo $activitynames->activity_name; ?></p>
                                        </a>
                                    </div>

                <?php } ?>


                                <?php
                                $act_img_count++;
                            }
                        }
                    }
                    ?>

                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /second-activity-group -->

        <div class="facility-contact-section section-pad" style="background-color: #f4f4f4;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mab-30">
                        <div class="section-title mab-30">
                            <h4 class="mb-2 wow fadeInLeft" data-wow-delay="200ms">School Facilities</h4>
                            <div class="line wow fadeInLeft" data-wow-delay="300ms"></div>
                        </div><!-- /schoolheading -->

                        <div id="carouselExampleControls" class="carousel slide mab-80" data-ride="carousel">
                            <div class="carousel-inner">

                                <?php
                                $facility = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at IS NULL";

                                $this->db->select('*')->where($facility);
                                $this->db->from('school_facilities');

                                $facility = $this->db->get();
                                $loopcount = 0;
                                foreach ($facility->result() as $facilities) {
                                    if ($loopcount == 0) {
                                        ?>

                                        <div class="carousel-item active">
                                            <div class="row">
                                                <div class="col-lg-4 wow fadeInLeft" data-wow-delay="400ms">
                                                    <div class="second-facility-imgbox">
                                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $facilities->image ?>" class="rounded" alt="">	
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 pt-4 wow fadeInLeft" data-wow-delay="500ms">
                                                    <h4 class="mb-2"><?php echo $facilities->facility ?></h4>
                                                    <p><?php echo $facilities->content ?></p>
                                                </div>
                                            </div>
                                        </div><!-- /carousel-item -->

                                        <?php
                                    } else {
                                        ?>           
                                        <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="second-facility-imgbox">
                                                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $facilities->image ?>" class="rounded" alt="">	
                                                    </div>
                                                </div>

                                                <div class="col-lg-8 pt-4">
                                                    <h4 class="mb-2"><?php echo $facilities->facility ?></h4>
                                                    <p><?php echo $facilities->content ?></p>
                                                </div>
                                            </div>
                                        </div><!-- /carousel-item -->
                                        <?php
                                    }
                                    $loopcount++;
                                }
                                ?>

                            </div><!-- /carousel-inner -->

                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div><!-- carousel -->
                    </div>

                    <div class="col-lg-4 mab-30">
                        <div class="section-title mab-30">
                            <h4 class="mb-2 wow fadeInUp" data-wow-delay="500ms">Location</h4>
                            <div class="line wow fadeInUp" data-wow-delay="600ms"></div>
                        </div><!-- /schoolheading -->

                        <div class="address-widget bg-white wow fadeInUp p-4" data-wow-delay="700ms" style="border-radius: 10px;">
                            <p class="mb-2"><b>Address:</b> <?php echo $school_details->address; ?></p>

                            <p class="mb-2"><b>E-mail:</b> <a href="mailto:info@yuvabharathi.in" style="color: #7d7d7d;"><?php echo $school_details->email; ?></a></p>

                            <p class="mb-2"><b>Phone:</b> <a href="tel:<?php echo $school_details->mobile; ?>" style="color:#7d7d7d;">+91 <?php echo $school_details->mobile; ?></a></p>
    <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter6" class="pink"><b><u>View Phone Number</u></b></a></p> -->

                            <h4 class="mt-4">Social Links</h4>
                            <ul class="list-inline mt-2">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <!-- <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
                                <li class="list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div><!-- /address-widget -->
                    </div>
                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /facility-contact-section -->
    </div><!-- /second-cat-details-group -->

    <!-- Modal -->
    <div class="modal fade view-phone-no" id="exampleModalCenter6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                </button>

                <div class="modal-head">
                    <h5><?php echo $school_details->slug; ?></h5>
                    <p>Mobile: +91 ******<?php echo substr($school_details->mobile, -4) ?></p>
                </div>

                <div class="modal-body">
                    <form action="<?php echo base_url() ?>abouts/phoneotp" class="form-inline" method="post">
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="" name="otpname" aria-describedby="emailHelp" placeholder="Soma Sundharam">
                        </div>
                        <input type="hidden" class="form-control" id="" name="schoolmobile" value="<?php echo $school_details->mobile; ?>" aria-describedby="emailHelp"
                               <div class="form-row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Country Code</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="countrycode">
                                    <option value="+91" selected="">IND +91</option>
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
                                <input type="number" step="any" class="form-control" id="" name="otpmobile" aria-describedby="emailHelp" placeholder="9963201547">
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="" name="mobileip" value="<?php echo $ipaddress; ?>"  >

                        <input type="hidden" class="form-control" id="" name="mobileid" value="<?php echo $school_details->id; ?>" >

                        <input type="hidden" class="form-control" id="" name="mobilecity" value="<?php echo $school_details->city_id; ?>" >

                        </div>

                        <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn-block btn btn-primary">View Phone Number</button>
                    </form>
                </div>
            </div><!-- /modal-content -->
        </div><!-- /modal-dialog -->
    </div><!-- /modal -->

    <?php
    $popular = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1 AND city_id=" . $school_details->city_id . " ";
    $this->db->select('*')->where($popular);
    $this->db->from('school_details');
    $popular = $this->db->get();

    if ($popular->num_rows() > 0) {
        ?>
        <div class="popular-schools" style="padding-top: 80px;">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Popular Schools in <?php echo $cities->city_name; ?></h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->


                <div class="owl-carousel owl-theme">
                    <?php
                    $delay = 4;
                    foreach ($popular->result() as $populars) {

                        $aff_name = "is_active=1 AND id=$populars->affiliation_id";
                        $this->db->select('*')->where($aff_name);
                        $this->db->from('affiliations');
                        $aff_name = $this->db->get();

                        foreach ($aff_name->result() as $aff_names) {
                            $aff_name = $aff_names->affiliation_name;
                            $aff_name = str_replace(" ", "-", $aff_name);
                        }

                        $area_name = "is_active=1 AND id=$populars->area_id";
                        $this->db->select('*')->where($area_name);
                        $this->db->from('areas');
                        $area_name = $this->db->get();

                        foreach ($area_name->result() as $area_names) {
                            $area_name = $area_names->area_name;
                            // $area_names = str_replace(" ","-",$area_names);
                        }

                        $school_name = str_replace(" ", "-", $populars->school_name);
                        ?>
                        <div class="item wow fadeInUp" style="animation-delay: .<?php echo $delay; ?>s;">
                            <figure class="snip1208">
                                <div class="object-fit" style="width: 100%;height: 160px;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 160px;object-fit: cover;">  
                                </div>

                                <figcaption class="">
                                    <h4><?php echo $populars->school_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <!-- <p><?php //echo $populars->about;   ?></p> -->
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank"></a>
                            </figure>
                        </div><!-- /item -->
                        <?php
                        $delay++;
                    }
                    ?>

                </div><!-- /owl-carousel -->
            </div><!-- /container -->
        </div><!-- /popular-schools -->
        <?php
    }
} elseif ($category == 3) {

    $school_img = "is_active=1 AND  school_activity_id=2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
    $this->db->select('*')->where($school_img);
    $this->db->from('school_images');
    $school_image = $this->db->get();

    foreach ($school_image->result() as $school_images) {
        
    }
    ?>

    <div class="thirdcat-details section-pad">
        <div class="container">
            <div class="row mab-20">
                <div class="col-lg-5 mab-30">
                    <div class="third-cat-image wow flipInY" data-wow-delay="300ms">
                        <img src="<?php echo base_url() ?>laravel/public/<?php echo $school_images->images ?>" class="" alt="">
                    </div><!-- /3rd-cat-image -->
                </div>

                <div class="col-lg-7 mab-30">
                    <div class="schoolheading mab-20">
                        <h1 style="text-transform: none;" class="wow fadeInUp" data-wow-delay="300ms"><?php echo $school_details->slug; ?></h1>
                        <span class="wow fadeInUp" data-wow-delay="400ms"><i class="fa fa-map-marker"></i> <?php echo $areas->area_name; ?>, <?php echo $cities->city_name; ?></a></span>
                    </div><!-- /schoolheading -->

                    <p class="wow fadeInUp" data-wow-delay="500ms"><?php echo $school_details->about; ?></p>
                </div>
            </div><!-- /row -->

            <div class="thircat-infosection">
                <div class="row">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="500ms">
                        <div class="section-title mab-30">
                            <h3 class="mb-2">Information about the school</h3>
                            <!-- <hr> -->
                            <div class="line"></div>
                        </div><!-- /schoolheading -->

                        <div class="third-info-group">
                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>School Name</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->slug; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>School Type</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->type; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->



                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Grade Level</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_types->school_type; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->



                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Founded</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->year_of_establish; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->
                            <?php
                            $school_activity = "is_active=1 AND  school_activity_id>2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
                            $this->db->select('school_activity_id')->where($school_activity);
                            $this->db->from('school_images');
                            $this->db->distinct();
                            $school_activity = $this->db->get();

                            $act_name = array();
                            foreach ($school_activity->result() as $school_activitys) {
                                $actname = "id = " . $school_activitys->school_activity_id . " ";
                                $this->db->select('*')->where($actname);
                                $this->db->from('school_activities');
                                $activityname = $this->db->get();
                                foreach ($activityname->result() as $activitynames) {

                                    if ($activitynames->id != 71) {
                                        $act_name[] = $activitynames->activity_name;
                                    }
                                }
                            }

                            $facility = "is_active=1 AND school_id=" . $school_details->id . " AND deleted_at IS NULL";

                            $this->db->select('*')->where($facility);
                            $this->db->from('school_facilities');
                            $facility = $this->db->get();
                            $facility_name = array();
                            $school_image = array();
                            foreach ($facility->result() as $facilities) {
                                $facility_name[] = $facilities->facility;
                                $school_image[] = $facilities->image;
                            }

                            $act_names = implode(",", $act_name);
                            $facility_names = implode(",", $facility_name);
                            ?>
                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Activities</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $act_names; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Facilities</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $facility_names; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->

                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Address</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->address; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Email</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->email; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->

                            <div class="third-info-widget">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Phone Number</b></p></div>
                                    <div class="col-lg-8">
    <!-- <p><a href="" data-toggle="modal" data-target="#exampleModalCenter7" class="pink"><b>View Phone Number</b></a></p>  -->
                                        <p>+91 <?php echo $school_details->mobile; ?></p>
                                    </div>
                                </div>
                            </div><!-- /thir-info-widget -->

                            <div class="third-info-widget1">
                                <div class="row">
                                    <div class="col-lg-4"><p><b>Website</b></p></div>
                                    <div class="col-lg-8"><p><?php echo $school_details->website_url; ?></p></div>
                                </div>
                            </div><!-- /thir-info-widget1 -->
                        </div><!-- /info-table-group -->
                    </div>
                    <!-- Modal -->
                    <div class="modal fade view-phone-no" id="exampleModalCenter7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                </button>

                                <div class="modal-head">
                                    <h5>YUVABHARATHI SCHOOL</h5>
                                    <p>Mobile: +91 98XXXXXX45</p>
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



                    <?php
                    $school_activity = "is_active=1 AND  school_activity_id>2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
                    $this->db->select('*')->where($school_activity);
                    $this->db->from('school_images');
                    $total_image = $this->db->get();

                    foreach ($total_image->result() as $total_images) {
                        $school_image[] = $total_images->images;
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

                        <div class="gallery-group" >
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
                                                <?php
                                            }
                                            ?>                                                     
                                        </a>
                                    </div><!-- /gallery-box -->
                                    <?php
                                } else {
                                    ?>
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
    $popular = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1 AND city_id=" . $cities->id . " ";
    $this->db->select('*')->where($popular);
    $this->db->from('school_details');
    $popular = $this->db->get();

    // echo $popular->num_rows();
    // exit();
    if ($popular->num_rows() > 0) {
        ?>
        <div class="popular-schools" style="padding-top: 80px;">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Popular Schools in <?php echo $cities->city_name; ?></h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->

                <div class="owl-carousel owl-theme">
                    <?php
                    $delay = 4;
                    foreach ($popular->result() as $populars) {

                        $aff_name = "is_active=1 AND id=$populars->affiliation_id";
                        $this->db->select('*')->where($aff_name);
                        $this->db->from('affiliations');
                        $aff_name = $this->db->get();

                        foreach ($aff_name->result() as $aff_names) {
                            $aff_name = $aff_names->affiliation_name;
                            $aff_name = str_replace(" ", "-", $aff_name);
                        }

                        $area_name = "is_active=1 AND id=$populars->area_id";
                        $this->db->select('*')->where($area_name);
                        $this->db->from('areas');
                        $area_name = $this->db->get();

                        foreach ($area_name->result() as $area_names) {
                            $area_name = $area_names->area_name;
                            // $area_names = str_replace(" ","-",$area_names);
                        }

                        $school_name = str_replace(" ", "-", $populars->school_name);
                        ?>
                        <div class="item wow fadeInUp" style="animation-delay: .<?php echo $delay; ?>s;">
                            <figure class="snip1208">
                                <div class="object-fit" style="width: 100%;height: 160px;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 160px;object-fit: cover;">  
                                </div>

                                <figcaption class="">
                                    <h4><?php echo $populars->school_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <!-- <p><?php //echo $populars->about;  ?></p> -->
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank"></a>
                            </figure>
                        </div><!-- /item -->
                        <?php
                        $delay++;
                    }
                    ?>

                </div><!-- /owl-carousel -->
            </div><!-- /container -->
        </div><!-- /popular-schools -->
        <?php
    }
}
}
?>


<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #f5f5f5;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
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
        </div><!-- /media -->

        <ul class="list-unstyled">
            <li>Phone: 1800-321-1204</li>
            <li>Email: support@edugatein.com</li>
        </ul>
    </div><!-- /feedback-head -->

    <div class="feedback-body">
        <h5 class="mb-3">Submit A Enquiry Form</h5>
        <form  action="<?php echo base_url() ?>schools/enquiry" method="post">
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

                    <form action="<?php echo base_url() ?>schools/otp" method="post" class="mt-3">
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

    <?php
}
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



<?php
// if($category == 1)
// {
//     if(isset($pie_graph))
//     {
// 
?>

<script>
    $(window).on("load", function () {
        //Preloader
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });


// var data = [<?php // echo $pie_graph;   ?>];

// // console.log(data);
// // alert(data);
// 		var ctx = document.getElementById("myChart");
// 		var myChart = new Chart(ctx, {
// 		    type: 'pie',
// 		    data: {
// 		        labels: ["Boys","Girls", "Teachers"],
// 		        datasets: [{
// 		            label: '# of Votes',
// 		            data: data,
// 		            backgroundColor: [
// 		                'rgba(255, 99, 132, 0.2)',
// 		                'rgba(54, 162, 235, 0.2)',
// 		                'rgba(255, 206, 86, 0.2)',
// 		                'rgba(75, 192, 192, 0.2)',
// 		                'rgba(153, 102, 255, 0.2)',
// 		                'rgba(255, 159, 64, 0.2)'
// 		            ],
// 		            borderColor: [
// 		                'rgba(255,99,132,1)',
// 		                'rgba(54, 162, 235, 1)',
// 		                'rgba(255, 206, 86, 1)',
// 		                'rgba(75, 192, 192, 1)',
// 		                'rgba(153, 102, 255, 1)',
// 		                'rgba(255, 159, 64, 1)'
// 		            ],
// 		            borderWidth: 1
// 		        }]
// 		    },
// 		    options: {
// 		        scales: {
// 		            // yAxes: [{
// 		            //     ticks: {
// 		            //         // beginAtZero:true
//                     //         // mirror: true
// 		            //     }
// 		            // }]
// 		        }
// 		    }
// 		});
// </script> 
// <?php
//     }
//     if(isset($bar_year) && isset($bar_pass))
//     {
// 
?>
// <script>

// var bar_year = [<?php echo $bar_year; ?>];
// var bar_pass = [<?php echo $bar_pass; ?>];

// 		var ctx = document.getElementById("myChart1");
// 		var myChart = new Chart(ctx, {
// 		    type: 'bar',
// 		    data: {
// 		        labels: bar_year,
// 		        datasets: [{
// 		            label: 'Pass Percentage',
// 		            data: bar_pass,
// 		            backgroundColor: [
// 		                'rgba(255, 99, 132, 0.2)',
// 		                'rgba(54, 162, 235, 0.2)',
// 		                'rgba(255, 206, 86, 0.2)',
// 		                'rgba(75, 192, 192, 0.2)',
// 		                'rgba(153, 102, 255, 0.2)',
// 		                'rgba(255, 159, 64, 0.2)'
// 		            ],
// 		            borderColor: [
// 		                'rgba(255,99,132,1)',
// 		                'rgba(54, 162, 235, 1)',
// 		                'rgba(255, 206, 86, 1)',
// 		                'rgba(75, 192, 192, 1)',
// 		                'rgba(153, 102, 255, 1)',
// 		                'rgba(255, 159, 64, 1)'
// 		            ],
// 		            borderWidth: 1
// 		        }]
// 		    },
// 		    options: {
// 		        scales: {
// 		            yAxes: [{
// 		                ticks: {
// 		                    beginAtZero:true
// 		                }
// 		            }]
// 		        }
// 		    }
// 		});
// 	</script>
// <?php
//     }
// }
?>


<script>
    //$(document).ready(function(){
    //   	$(".owl-carousel").owlCarousel();
    // });

    new WOW().init();

    // Feedback-form
    $(document).ready(function () {
        $('.toggle').click(function () {
            $('.feedback-form').toggleClass('active')
        })
    })

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


</body>
</html>