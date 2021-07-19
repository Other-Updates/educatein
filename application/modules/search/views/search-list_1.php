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
if (count($aff_search) > 0 && count($city_search) > 0 || count($aff_search) > 0 && count($area_search) > 0 || count($area_search) > 0 || count($city_search) > 0 || count($aff_search) > 0 || count($list_search) > 0 || count($school_search) == 0) {
    
    ?>
    <!------------------- Schools-Listing-Start ------------------->
    <div class="">
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
        <div class="site-content container-fluid" style="padding-left: 60px;padding-right: 60px;">
            <div class="">
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
                                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore" id="<?php echo $row->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $affiliation_name1; ?> Schools</a>
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
                                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $category_name; ?>-in-coimbatore" id="<?php echo $row1->id; ?>"><i class="fa fa-angle-right"></i> <?php echo $category_name1; ?></a>
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

                    <?php
                    if (count($aff_search) > 0) {
                        foreach ($aff_search as $affiliations) {
                            $aff_url = $affiliations['affiliation_name'];
                            $affiliation = $affiliations['id'];
                        }
                    }

                    if (count($city_search) > 0) {
                        foreach ($city_search as $city_searchs) {
                            $city_name = $city_searchs['city_name'];
                            $city_id = $city_searchs['id'];
                        }
                    }
                    
                    if (count($area_search) > 0) {
                        foreach ($area_search as $area_searchs) {
                            $area_name = $area_searchs['area_name'];
                            $area_id = $area_searchs['id'];
                        }
                    }
                    //  echo $area_id;
                    //  exit(); 

                    if (count($list_search) > 0) {
                        foreach ($list_search as $list_searchs) {
                            $list_name = $list_searchs['slug'];
                            $list_id = $list_searchs['id'];
                        }
                    }




                    if (count($aff_search) > 0 && count($city_search) > 0) {

                        $nearby = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND affiliation_id=" . $affiliation . " AND city_id = " . $city_id . " ";
                    } else if (count($aff_search) > 0 && count($area_search) > 0) {

                        $nearby = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND affiliation_id=" . $affiliation . " AND area_id = " . $area_id . " ";
                    } else if (count($aff_search) > 0 && count($list_search) == 0) {

                        $nearby = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND affiliation_id=" . $affiliation . " ";
                    } else if (count($list_search) > 0) {

                        $nearby = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND id = " . $list_id . " ";
                    } else if (count($city_search) > 0 && count($area_search) == 0) {

                        $nearby = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND city_id = " . $city_id . " ";
                    } else if (count($area_search) > 0) {

                        $nearby = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND area_id = " . $area_id . " ";
                    }

                    //   echo count($city_search); 
//       echo $nearby;
// exit();
                    $hostel_search = str_replace(",", " ", $search);
                    $hostel_search_array = explode(" ", $hostel_search);
                    foreach ($hostel_search_array as $hostel_value) {
                        $hostel_search = ucfirst($hostel_value);
                        if ($hostel_search == "Hostel" || $hostel_search == "Hostels" || $hostel_search == "Boarding" || $hostel_search == "Boardings") {
                            $is_hostel = 1;
                        }
                    }

                    if (isset($is_hostel) && $hostel_count == 0) {


                        $hostel_count++;
                        foreach ($hostel_search_array as $hostel_value) {
                            $restriction = ucfirst($hostel_value);
//  echo $restriction;     
//  exit();
                            if ($restriction != "School" && $restriction != "Schools" && $restriction != "In" && $restriction != "With") {
                                $this->db->select('*');
                                $this->db->from('affiliations');
                                $test = $this->db->like('affiliation_name', $hostel_value);
                                $hostel_aff_search1 = $this->db->get()->result_array();

                                if (count($hostel_aff_search1) > 0) {
                                    $hostel_aff_search = $hostel_aff_search1;
                                }

                                $this->db->select('*');
                                $this->db->from('cities');
                                $test = $this->db->like('city_name', $hostel_value);
                                $hostel_city_search1 = $this->db->get()->result_array();
                                // echo "<br>";
                                if (count($hostel_city_search1) > 0) {
                                    $hostel_city_search = $hostel_city_search1;
                                }

                                $this->db->select('*');
                                $this->db->from('areas');
                                $test = $this->db->like('area_name', $hostel_value);
                                $hostel_area_search1 = $this->db->get()->result_array();

                                if (count($hostel_area_search1) > 0) {
                                    $hostel_area_search = $hostel_area_search1;
                                }

                                if (isset($hostel_area_search)) {

                                    $this->db->select('*');
                                    $this->db->from('area_nearbys');
                                    $test = $this->db->like('name', $search);
                                    $hostel_area_search1 = $this->db->get()->result_array();

                                    if (isset($hostel_area_search)) {


                                        $this->db->select('*');
                                        $this->db->from('area_nearbys');
                                        $test = $this->db->like('name', $hostel_value);
                                        $hostel_area_search1 = $this->db->get()->result_array();
                                        // echo "<br>";
                                        if (count($hostel_area_search1) > 0) {
                                            $hostel_near_area_search = $hostel_area_search1;
                                        }
                                    }

                                    if (isset($hostel_near_area_search)) {


                                        foreach ($hostel_near_area_search as $hostel_area_searchs) {
                                            if (isset($hostel_area_searchs)) {
                                                $hostel_area_id = $hostel_area_searchs['nearby_name'];
                                            }
                                        }


                                        $this->db->select('*');
                                        $this->db->from('areas');
                                        $test = $this->db->where('id', $hostel_area_id);
                                        $hostel_area_search1 = $this->db->get()->result_array();
                                        // echo "<br>";
                                        if (count($hostel_area_search1) > 0) {
                                            $hostel_area_search = $hostel_area_search1;
                                        }
                                    }
                                }

                                if ($hostel_value != "coimbatore" || $hostel_value != "Coimbatore") {

                                    $this->db->select('*');
                                    $this->db->from('school_details');
                                    $test = $this->db->like('school_name', $hostel_value);
                                    $test = $this->db->where('hostel', 1);
                                    $this->db->where('is_active', 1);
                                    $this->db->where('activated_at !=', NULL);
                                    $this->db->where('valitity !=', NULL);
                                    $this->db->where('deleted_at', NULL);
                                    $hostel_list_search1 = $this->db->get()->result_array();
                                    // echo "<br>";
                                    if (count($hostel_list_search1) > 0) {

                                        $hostel_list_search = $hostel_list_search1;
                                    }

                                    if (isset($hostel_list_search)) {


                                        $this->db->select('*');
                                        $this->db->from('school_details');
                                        $test = $this->db->like('slug', $hostel_value);
                                        $this->db->where('city_id', $city_id);
                                        $test = $this->db->where('hostel', 1);
                                        $this->db->where('is_active', 1);
                                        $this->db->where('activated_at !=', NULL);
                                        $this->db->where('valitity !=', NULL);
                                        $this->db->where('deleted_at', NULL);
                                        $hostel_list_search1 = $this->db->get()->result_array();

                                        if (count($hostel_list_search1) > 0) {
                                            $hostel_list_search = $hostel_list_search1;
                                        }
                                    }
                                }

                                $this->db->select('*');
                                $this->db->from('school_types');
                                $test = $this->db->like('school_type', $hostel_value);
                                $this->db->limit(1);
                                $hostel_category_search1 = $this->db->get()->result_array();

                                if (count($hostel_category_search1) > 0) {
                                    $hostel_category_search = $hostel_category_search1;
                                }
                            }
                        }

                        if (isset($hostel_aff_search) && isset($hostel_city_search) && isset($hostel_category_search)) {
                            foreach ($hostel_aff_search as $hostel_aff_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_aff_id = $hostel_aff_searchs['id'];
                                $hostel_aff_name = str_replace(" ", "-", $hostel_aff_searchs['affiliation_name']);
                                $hostel_aff_name = strtolower($hostel_aff_name);
                            }
                            foreach ($hostel_city_search as $hostel_city_searchs) {
                                $hostel_city_id = $hostel_city_searchs['id'];
                                $hostel_city_name = $hostel_city_searchs['city_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }
                            foreach ($hostel_category_search as $hostel_category_searchs) {
                                $hostel_category_id = $hostel_category_searchs['id'];

                                // echo $hostel_category_id;        
                                // print_r($hostel_category_searchs);
                            }

                            $hostel = "is_active=1 AND city_id=" . $city_id . " AND affiliation_id=" . $hostel_aff_id . " AND schooltype_id=" . $hostel_category_id . " AND city_id=" . $hostel_city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);

                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_aff_search) && isset($hostel_city_search)) {
                            foreach ($hostel_aff_search as $hostel_aff_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_aff_id = $hostel_aff_searchs['id'];
                                $hostel_aff_name = str_replace(" ", "-", $hostel_aff_searchs['affiliation_name']);
                                $hostel_aff_name = strtolower($hostel_aff_name);
                            }
                            foreach ($hostel_city_search as $hostel_city_searchs) {
                                $hostel_city_id = $hostel_city_searchs['id'];
                                $hostel_city_name = $hostel_city_searchs['city_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }

                            $hostel = "is_active=1 AND affiliation_id=" . $hostel_aff_id . " AND city_id=" . $hostel_city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_aff_search) && isset($hostel_area_search) && isset($hostel_category_search)) {
                            foreach ($hostel_aff_search as $hostel_aff_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_aff_id = $hostel_aff_searchs['id'];
                                $hostel_aff_name = str_replace(" ", "-", $hostel_aff_searchs['affiliation_name']);
                                $hostel_aff_name = strtolower($hostel_aff_name);
                            }
                            foreach ($hostel_area_search as $hostel_area_searchs) {
                                $hostel_area_id = $hostel_area_searchs['id'];
                                $hostel_area_name = $hostel_area_searchs['area_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }
                            foreach ($hostel_category_search as $hostel_category_searchs) {
                                $hostel_category_id = $hostel_category_searchs['id'];

                                // echo $hostel_category_id;        
                                // print_r($hostel_category_searchs);
                            }

                            $hostel = "is_active=1 AND affiliation_id=" . $hostel_aff_id . " AND schooltype_id=" . $hostel_category_id . " AND area_id=" . $hostel_area_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_aff_search) && isset($hostel_area_search)) {
                            foreach ($hostel_aff_search as $hostel_aff_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_aff_id = $hostel_aff_searchs['id'];
                                $hostel_aff_name = str_replace(" ", "-", $hostel_aff_searchs['affiliation_name']);
                                $hostel_aff_name = strtolower($hostel_aff_name);
                            }
                            foreach ($hostel_area_search as $hostel_area_searchs) {
                                $hostel_area_id = $hostel_area_searchs['id'];
                                $hostel_area_name = $hostel_area_searchs['area_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }


                            $hostel = "is_active=1 AND affiliation_id=" . $hostel_aff_id . " AND area_id=" . $hostel_area_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_city_search) && isset($hostel_category_search)) {
                            foreach ($hostel_city_search as $hostel_city_searchs) {
                                $hostel_city_id = $hostel_city_searchs['id'];
                                $hostel_city_name = $hostel_city_searchs['city_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }
                            foreach ($hostel_category_search as $hostel_category_searchs) {
                                $hostel_category_id = $hostel_category_searchs['id'];

                                // echo $hostel_category_id;        
                                // print_r($hostel_category_searchs);
                            }

                            $hostel = "is_active=1 AND schooltype_id=" . $hostel_category_id . " AND city_id=" . $hostel_city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_area_search) && isset($hostel_category_search)) {

                            foreach ($hostel_area_search as $hostel_area_searchs) {
                                $hostel_area_id = $hostel_area_searchs['id'];
                                $hostel_area_name = $hostel_area_searchs['area_name'];
                                // echo $hostel_city_id;
                                // print_r($hostel_city_searchs);
                            }
                            foreach ($hostel_category_search as $hostel_category_searchs) {
                                $hostel_category_id = $hostel_category_searchs['id'];

                                // echo $hostel_category_id;        
                                // print_r($hostel_category_searchs);
                            }

                            $hostel = "is_active=1 AND schooltype_id=" . $hostel_category_id . " AND area_id=" . $hostel_area_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_aff_search)) {
                            foreach ($hostel_aff_search as $hostel_aff_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_aff_id = $hostel_aff_searchs['id'];
                                $hostel_aff_name = str_replace(" ", "-", $hostel_aff_searchs['affiliation_name']);
                                $hostel_aff_name = strtolower($hostel_aff_name);
                            }

                            $hostel = "is_active=1 AND city_id=" . $city_id . " AND affiliation_id=" . $hostel_aff_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_city_search)) {
                            foreach ($hostel_city_search as $hostel_city_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_city_id = $hostel_city_searchs['id'];
                            }

                            $hostel = "is_active=1 AND city_id=" . $hostel_city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_area_search)) {

                            foreach ($hostel_area_search as $hostel_area_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_area_id = $hostel_area_searchs['id'];
                            }

                            $hostel = "is_active=1 AND area_id=" . $hostel_area_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_category_search)) {
                            foreach ($hostel_category_search as $hostel_category_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_category_id = $hostel_category_searchs['id'];
                            }

                            $hostel = "is_active=1 AND city_id=" . $city_id . " AND schooltype_id=" . $hostel_category_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif (isset($hostel_list_search)) {
                            foreach ($hostel_list_search as $hostel_list_searchs) {
                                // print_r($hostel_aff_searchs);
                                $hostel_list_id = $hostel_list_searchs['id'];
                            }

                            $hostel = "is_active=1 AND id=" . $hostel_list_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } elseif ($restriction == "Hostel" || $restriction == "Hostels" || $restriction == "Boarding" || $restriction == "Boardings" || $search == "boarding school" || $search == "Boarding school" || $search == "Boarding School" || $search == "boarding schools" || $search == "Boarding schools" || $search == "Boarding Schools") {

                            $hostel = "is_active=1 AND city_id=" . $city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        } else {

                            $hostel = "is_active=1 AND city_id=" . $city_id . " AND hostel = 1";
                            $this->db->select('*')->where($hostel);
                            $this->db->from('school_details');
                            $hostel = $this->db->get();
                            ?>
                            <div class="row">
                                <?php
                                foreach ($hostel->result() as $hostels) {
                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->where('id', $hostels->area_id);
                                    $hostel_area = $this->db->get();

                                    foreach ($hostel_area->result() as $hostel_areas) {
                                        
                                    }

                                    $this->db->select('*');
                                    $this->db->from('affiliations');
                                    $test = $this->db->where('id', $hostels->affiliation_id);
                                    $hostel_aff = $this->db->get();

                                    foreach ($hostel_aff->result() as $hostel_affs) {
                                        $hostel_aff_id = $hostel_affs->id;
                                        $hostel_aff_name = str_replace(" ", "-", $hostel_affs->affiliation_name);
                                        $hostel_aff_name = strtolower($hostel_aff_name);
                                    }
                                    ?>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="nearby-widget mab-30 wow fadeInUp">
                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" target="_blank">
                                                <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                    <img src="https://edugatein.com/laravel/public/<?php echo $hostels->logo ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                </div>
                                            </a>
                                            <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                <h6 class="mb-2"><?php echo $hostels->slug; ?></h6>
                                                <ul class="list-unstyled mb-2">
                                                    <li class="mb-1"><b>Type:</b> <?php echo $hostel_aff_name; ?> School</li>
                                                    <li class="mb-1"><b>Location:</b> <?php echo $hostel_areas->area_name; ?></li>
                                                </ul>
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $hostel_aff_name; ?>-schools-in-coimbatore/<?php echo $hostels->school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                            </div><!-- /nearby-widget-body -->
                                        </div><!-- /nearby-widget -->
                                    </div>
                                    <?php
                                }
                                ?>
                            </div><!-- /row -->
                            <?php
                        }
                    } elseif (count($aff_search) > 0 && count($city_search) > 0 || count($aff_search) > 0 && count($area_search) > 0 || count($aff_search) > 0 && count($list_search) > 0 || count($aff_search) > 0 || count($area_search) > 0 || count($list_search) > 0 || count($city_search) > 0) {

                        $school_nearby = array();

                        $length = trim($search, " ");
// echo $nearby;
// exit();


                        $i = 0;
                        if (count($aff_search) == 0 && count($list_search) > 0 && count($school_search) == 0 || count($aff_search) == 0 && count($area_search) > 0 && count($school_search) == 0 || str_word_count($search) > 1 && count($aff_search) > 0 || strlen($length) == 1) {


                            if (count($list_search) > 0 && count($area_search) > 0 || strlen($length) == 1) {

                                if (strlen($length) == 1) {

                                    $this->db->select('*');
                                    $this->db->from('school_details');
                                    $test = $this->db->like('school_name', $length, 'after');
                                    $this->db->where('is_active', 1);
                                    $this->db->where('activated_at !=', NULL);
                                    $this->db->where('valitity !=', NULL);
                                    $this->db->where('deleted_at', NULL);
                                    $this->db->order_by("slug", "asc");
                                    $list_search1 = $this->db->get();
                                } else {

                                    $this->db->select('*');
                                    $this->db->from('school_details');
                                    $this->db->like('slug', $search);
                                    $this->db->where('is_active', 1);
                                    $this->db->where('activated_at !=', NULL);
                                    $this->db->where('valitity !=', NULL);
                                    $this->db->where('deleted_at', NULL);
                                    $this->db->order_by("slug", "asc");
                                    $list_search1 = $this->db->get();
                                }


                                if ($list_search1->num_rows() == 0) {



                                    $this->db->select('*');
                                    $this->db->from('school_details');
                                    $this->db->like('school_name', $search);
                                    $this->db->where('is_active', 1);
                                    $this->db->where('activated_at !=', NULL);
                                    $this->db->where('valitity !=', NULL);
                                    $this->db->where('deleted_at', NULL);
                                    $this->db->order_by("slug", "asc");
                                    $list_search1 = $this->db->get();
                                }



                                if ($list_search1->num_rows() == 0) {


                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->like('area_name', $search);
                                    $area_search1 = $this->db->get();


                                    if ($area_search1->num_rows() == 0) {


                                        $search = str_replace(",", " ", $search);
                                        $search_array = explode(" ", $search);
                                        foreach ($search_array as $value) {
                                            if ($area_search1->num_rows() == 0) {
                                                $test_state = ucfirst($value);
                                                if ($test_state == "special") {
                                                    $value = "special";
                                                }
                                                if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL" && $value != "schools" && $value != "Schools" && $value != "SCHOOLS") {

                                                    $this->db->select('*');
                                                    $this->db->from('areas');
                                                    $test = $this->db->like('area_name', $value);
                                                    $area_search1 = $this->db->get();
                                                    // print_r($area_search1);
                                                    // exit();                           

                                                    if ($area_search1->num_rows() == 0) {


                                                        $this->db->select('*');
                                                        $this->db->from('area_nearbys');
                                                        $this->db->like('name', $search);
                                                        $area_search1 = $this->db->get();


                                                        if ($area_search1->num_rows() > 0) {

                                                            $this->db->select('*');
                                                            $this->db->from('area_nearbys');
                                                            $test = $this->db->like('name', $value);
                                                            $area_search1 = $this->db->get();

                                                            if ($area_search1->num_rows() > 0) {
                                                                $area_search = $area_search1;
                                                            }
                                                        }

                                                        if ($area_search1->num_rows() > 0) {
                                                            foreach ($area_search->result() as $area_searchs) {
// echo $area_searchs->nearby_name;
// exit();

                                                                $area_id = $area_searchs->nearby_name;
                                                            }
                                                            $this->db->select('*');
                                                            $this->db->from('areas');
                                                            $test = $this->db->where('id', $area_id);
                                                            $area_search1 = $this->db->get();
                                                            // echo "<br>";
                                                            if ($area_search1->num_rows() > 0) {
                                                                $area_search = $area_search1;
                                                            }
                                                            // print_r($area_search);
                                                            // exit();
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }


                                    if ($area_search1->num_rows() > 0) {

                                        foreach ($area_search1->result() as $areas) {
                                            
                                        }



                                        $this->db->select('*');
                                        $this->db->from('school_details');
                                        $this->db->where('area_id', $areas->id);
                                        $this->db->where('is_active', 1);
                                        $this->db->where('activated_at !=', NULL);
                                        $this->db->where('valitity !=', NULL);
                                        $this->db->where('deleted_at', NULL);
                                        $this->db->order_by("slug", "asc");
                                        $list_search1 = $this->db->get();
                                    }


                                    if ($area_search1->num_rows() == 0) {

                                        foreach ($area_search1->result() as $areas) {
                                            
                                        }



                                        $this->db->select('*');
                                        $this->db->from('school_details');
                                        $this->db->where('area_id', $areas->id);
                                        $this->db->where('is_active', 1);
                                        $this->db->where('activated_at !=', NULL);
                                        $this->db->where('valitity !=', NULL);
                                        $this->db->where('deleted_at', NULL);
                                        $this->db->order_by("slug", "asc");
                                        $list_search1 = $this->db->get();
                                    }
                                }
                            } else if (count($area_search) > 0) {



                                $this->db->select('*')->where($nearby);
                                $this->db->from('school_details');
                                $this->db->where('is_active', 1);
                                $this->db->where('activated_at !=', NULL);
                                $this->db->where('valitity !=', NULL);
                                $this->db->where('deleted_at', NULL);
                                $this->db->order_by("slug", "asc");
                                $list_search1 = $this->db->get();



                                if (count($area_search1) == 0) {


                                    $this->db->select('*');
                                    $this->db->from('areas');
                                    $test = $this->db->like('area_name', $search);
                                    $list_search1 = $this->db->get();
                                }
// echo count( $list_search1);
// exit();
                                if (count($list_search1) == 0) {

                                    $search = str_replace(",", " ", $search);
                                    $search_array = explode(" ", $search);
                                    foreach ($search_array as $value) {

                                        $test_state = ucfirst($value);
                                        if ($test_state == "Stateboard") {
                                            $value = "state";
                                        }

                                        if ($list_search1->num_rows() == 0) {

                                            if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL" && $loop < 5) {

                                                $this->db->select('*');
                                                $this->db->from('areas');
                                                $test = $this->db->like('area_name', $value);
                                                $list_search1 = $this->db->get();
                                            }
                                        }
                                    }
                                }
                            } else if (count($aff_search) > 0) {



                                $this->db->select('*')->where($nearby);
                                $this->db->from('school_details');
                                $this->db->order_by("school_name", "asc");
                                $list_search1 = $this->db->get();


                                if (count($list_search1) == 0) {

                                    $search = str_replace(",", " ", $search);
                                    $search_array = explode(" ", $search);
                                    foreach ($search_array as $value) {
                                        $test_state = ucfirst($value);
                                        if ($test_state == "special") {
                                            $value = "special";
                                        }
                                        if ($list_search1->num_rows() == 0) {
                                            if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL" && $loop < 5) {

                                                $this->db->select('*');
                                                $this->db->from('affiliations');
                                                $test = $this->db->like('affiliation_name', $value);
                                                $list_search1 = $this->db->get();
                                            }
                                        }
                                    }
                                }
                            } else {




                                $this->db->select('*');
                                $this->db->from('school_details');
                                $this->db->like('slug', $search);
                                $this->db->where('is_active', 1);
                                $this->db->where('activated_at !=', NULL);
                                $this->db->where('valitity !=', NULL);
                                $this->db->where('deleted_at', NULL);
                                $this->db->order_by("slug", "asc");
                                $list_search1 = $this->db->get();


                                if ($list_search1->num_rows() == 0) {

                                    if (str_word_count($search) > 1 && count($aff_search) > 0) {



                                        foreach ($search_array as $value) {

                                            $test_state = ucfirst($value);
                                            if ($test_state == "Stateboard") {
                                                $value = "state";
                                            }

                                            if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL") {

                                                $this->db->select('*');
                                                $this->db->from('affiliations');
                                                $test = $this->db->like('affiliation_name', $value);
                                                $aff_search = $this->db->get();

                                                foreach ($aff_search->result() as $aff_searchs) {
                                                    
                                                }

                                                if ($aff_search->num_rows() > 0) {


                                                    $this->db->select('*');
                                                    $this->db->from('school_details');
                                                    $this->db->where('affiliation_id', $aff_searchs->id);
                                                    $this->db->where('city_id', $city_id);
                                                    $this->db->where('is_active', 1);
                                                    $this->db->where('activated_at !=', NULL);
                                                    $this->db->where('valitity !=', NULL);
                                                    $this->db->where('deleted_at', NULL);
                                                    $this->db->order_by("slug", "asc");
                                                    $list_search1 = $this->db->get();
                                                }
                                            }
                                        }
                                    }
                                }


                                if ($list_search1->num_rows() == 0) {

                                    $this->db->select('*');
                                    $this->db->from('school_details');
                                    $this->db->like('school_name', $search);
                                    $this->db->where('is_active', 1);
                                    $this->db->where('activated_at !=', NULL);
                                    $this->db->where('valitity !=', NULL);
                                    $this->db->where('deleted_at', NULL);
                                    $this->db->order_by("slug", "asc");
                                    $list_search1 = $this->db->get();
                                }
                            }

                            foreach ($list_search1->result() as $nearbys) {



                                $this->db->select('*')->where('id =', $nearbys->affiliation_id);
                                $this->db->from('affiliations');
                                $affiliationname = $this->db->get();
                                foreach ($affiliationname->result() as $affiliationnames) {
                                    
                                }


                                $this->db->select('*')->where('id =', $nearbys->area_id);
                                $this->db->from('areas');
                                $areaname = $this->db->get();
                                foreach ($areaname->result() as $areanames) {
                                    
                                }

                                $banner = "is_active=1 AND school_id=" . $nearbys->id . " AND school_activity_id=2 ";
                                $this->db->select('*')->where($banner);
                                $this->db->from('school_images');
                                $banner = $this->db->get();
                                foreach ($banner->result() as $banners) {

                                    $school_nearby[$i]['logo'] = $banners->images;
                                    $school_nearby[$i]['school_name'] = $nearbys->school_name;
                                    $school_nearby[$i]['slug'] = $nearbys->slug;
                                    $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                    $school_nearby[$i]['address'] = $nearbys->address;
                                    $school_nearby[$i]['about'] = $nearbys->about;
                                    $school_nearby[$i]['area'] = $areanames->area_name;

                                    $i++;
                                }
                            }
                        } else {



                            if (count($aff_search) > 0) {


                                $this->db->select('*');
                                $this->db->from('affiliations');
                                $test = $this->db->like('affiliation_name', $search);
                                $aff_search1 = $this->db->get();

                                if ($aff_search1->num_rows() > 0) {


                                    foreach ($aff_search1->result() as $aff_searchs) {
                                        
                                    }
                                }


                                if ($aff_search1->num_rows() == 0) {

                                    foreach ($search_array as $value) {

                                        $test_state = ucfirst($value);
                                        if ($test_state == "Stateboard") {
                                            $value = "state";
                                        }

                                        if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL") {

                                            $this->db->select('*');
                                            $this->db->from('affiliations');
                                            $test = $this->db->like('affiliation_name', $value);
                                            $aff_search1 = $this->db->get();

                                            foreach ($aff_search1->result() as $aff_searchs) {
                                                
                                            }
                                        }
                                    }
                                }





                                $this->db->select('*')->where('affiliation_id', $aff_searchs->id);
                                $this->db->where('is_active', 1);
                                $this->db->where('activated_at !=', NULL);
                                $this->db->where('valitity !=', NULL);
                                $this->db->where('deleted_at', NULL);
                                $this->db->where('city_id', $city_id);
                                $this->db->from('school_details');
                                $this->db->order_by("slug", "asc");
                                $nearby = $this->db->get();
                            } else {

                                $this->db->select('*')->where($nearby);
                                $this->db->from('school_details');
                                $this->db->order_by("slug", "asc");
                                $nearby = $this->db->get();



                                $i = 0;
                                if ($nearby->num_rows() == 0) {

                                    if (!empty($affiliation)) {
                                        $nearby = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND affiliation_id=" . $affiliation . " AND deleted_at is NULL ";
                                        $this->db->select('*')->where($nearby);
                                        $this->db->from('school_details');
                                        $this->db->order_by("slug", "asc");
                                        $nearby = $this->db->get();
                                    } else {
                                        $nearby = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1 AND deleted_at is NULL ";
                                        $this->db->select('*')->where($nearby);
                                        $this->db->from('school_details');
                                        $this->db->order_by("slug", "asc");
                                        $nearby = $this->db->get();
                                    }
                                }
                            }

                            foreach ($nearby->result() as $nearbys) {


                                $this->db->select('*')->where('id =', $nearbys->affiliation_id);
                                $this->db->from('affiliations');
                                $affiliationname = $this->db->get();
                                foreach ($affiliationname->result() as $affiliationnames) {
                                    
                                }


                                $this->db->select('*')->where('id =', $nearbys->area_id);
                                $this->db->from('areas');
                                $areaname = $this->db->get();
                                foreach ($areaname->result() as $areanames) {
                                    
                                }

                                $banner = "is_active=1 AND school_id=" . $nearbys->id . " AND school_activity_id=2 ";
                                $this->db->select('*')->where($banner);
                                $this->db->from('school_images');
                                $banner = $this->db->get();
                                foreach ($banner->result() as $banners) {
                                    
                                }

                                $school_nearby[$i]['logo'] = $banners->images;
                                $school_nearby[$i]['school_name'] = $nearbys->school_name;
                                $school_nearby[$i]['slug'] = $nearbys->slug;
                                $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                $school_nearby[$i]['address'] = $nearbys->address;
                                $school_nearby[$i]['about'] = $nearbys->about;
                                $school_nearby[$i]['area'] = $areanames->area_name;

                                $i++;
                            }
                        }

                        if (count($school_nearby) > 0) {
                            $count = count($school_nearby);

                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <div class="row">
                                    <?php
                                    for ($i = $i; $i < $count; $i++) {
                                        $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);


                                        $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name'])
                                        ?>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="nearby-widget mab-30 wow fadeInUp">
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">
                                                    <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                        <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                    </div>
                                                </a>
                                                <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                    <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                    <ul class="list-unstyled mb-2">
                                                        <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                        <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                    </ul>
                                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                </div><!-- /nearby-widget-body -->
                                            </div><!-- /nearby-widget -->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div><!-- /row -->
                                <?php
                            }
                        } else {



                            $nearby = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1 AND deleted_at is NULL ";
                            $this->db->select('*')->where($nearby);
                            $this->db->from('school_details');
                            $this->db->order_by("slug", "asc");
                            $nearby = $this->db->get();


                            foreach ($nearby->result() as $nearbys) {


                                $this->db->select('*')->where('id =', $nearbys->affiliation_id);
                                $this->db->from('affiliations');
                                $affiliationname = $this->db->get();
                                foreach ($affiliationname->result() as $affiliationnames) {
                                    
                                }


                                $this->db->select('*')->where('id =', $nearbys->area_id);
                                $this->db->from('areas');
                                $areaname = $this->db->get();
                                foreach ($areaname->result() as $areanames) {
                                    
                                }

                                $banner = "is_active=1 AND school_id=" . $nearbys->id . " AND school_activity_id=2 ";
                                $this->db->select('*')->where($banner);
                                $this->db->from('school_images');
                                $banner = $this->db->get();
                                foreach ($banner->result() as $banners) {
                                    
                                }

                                $school_nearby[$i]['logo'] = $banners->images;
                                $school_nearby[$i]['school_name'] = $nearbys->school_name;
                                $school_nearby[$i]['slug'] = $nearbys->slug;
                                $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                $school_nearby[$i]['address'] = $nearbys->address;
                                $school_nearby[$i]['about'] = $nearbys->about;
                                $school_nearby[$i]['area'] = $areanames->area_name;

                                $i++;
                            }


                            $count = count($school_nearby);

                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <div class="row">
                                    <?php
                                    for ($i = $i; $i < $count; $i++) {
                                        $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);


                                        $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name'])
                                        ?>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="nearby-widget mab-30 wow fadeInUp">
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">
                                                    <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                        <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">	
                                                    </div>
                                                </a>
                                                <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                    <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                    <ul class="list-unstyled mb-2">
                                                        <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                        <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                    </ul>
                                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                </div><!-- /nearby-widget-body -->
                                            </div><!-- /nearby-widget -->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div><!-- /row -->
                                <?php
                            }
                        }
                    } else {



                        $i = 0;

                        if ($search == "school" || $search == "School" || $search == "SCHOOL" || $search == "schools" || $search == "Schools" || $search == "SCHOOLS") {

                            $this->db->select('*');
                            $this->db->from('school_details');
                            $this->db->where('city_id', $city_id);
                            $this->db->where('is_active', 1);
                            $this->db->where('activated_at !=', NULL);
                            $this->db->where('valitity !=', NULL);
                            $this->db->where('deleted_at', NULL);
                            $this->db->order_by("slug", "asc");

                            $nearby = $this->db->get()->result_array();
                            // echo "<br>";
                            foreach ($nearby as $nearbys) {


                                $this->db->select('*')->where('id =', $nearbys['affiliation_id']);
                                $this->db->from('affiliations');
                                $affiliationname = $this->db->get();
                                foreach ($affiliationname->result() as $affiliationnames) {
                                    
                                }


                                $this->db->select('*')->where('id =', $nearbys['area_id']);
                                $this->db->from('areas');
                                $areaname = $this->db->get();
                                foreach ($areaname->result() as $areanames) {
                                    
                                }

                                $banner = "is_active=1 AND school_id=" . $nearbys['id'] . " AND school_activity_id=2 ";
                                $this->db->select('*')->where($banner);
                                $this->db->from('school_images');
                                $banner = $this->db->get();


                                foreach ($banner->result() as $banners) {
                                    
                                }

                                $school_nearby[$i]['logo'] = $banners->images;
                                $school_nearby[$i]['school_name'] = $nearbys['school_name'];
                                $school_nearby[$i]['slug'] = $nearbys['slug'];
                                $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                $school_nearby[$i]['address'] = $nearbys['address'];
                                $school_nearby[$i]['about'] = $nearbys['about'];
                                $school_nearby[$i]['area'] = $areanames->area_name;

                                $i++;
                            }


                            $count = count($school_nearby);

                            for ($i = 0; $i < $count; $i++) {
                                ?>
                                <div class="row">
                                    <?php
                                    for ($i = $i; $i < $count; $i++) {
                                        $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);


                                        $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name'])
                                        ?>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="nearby-widget mab-30 wow fadeInUp">
                                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">
                                                    <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                        <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                    </div>
                                                </a>
                                                <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                    <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                    <ul class="list-unstyled mb-2">
                                                        <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                        <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                    </ul>
                                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                </div><!-- /nearby-widget-body -->
                                            </div><!-- /nearby-widget -->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div><!-- /row -->
                                <?php
                            }
                        } else {
                            $this->db->select('*');
                            $this->db->from('school_details');
                            $test = $this->db->like('school_name', $search_array[0]);
                            $this->db->where('is_active', 1);
//                            $this->db->where('activated_at !=', NULL);
//                            $this->db->where('valitity !=', NULL);
//                            $this->db->where('deleted_at', NULL);
                            $this->db->order_by("slug", "asc");
                            $nearby = $this->db->get()->result_array();
                            if (count($nearby) > 0) {
                                foreach ($nearby as $nearbys) {
                                    $this->db->select('*')->where('id =', $nearbys['affiliation_id']);
                                    $this->db->from('affiliations');
                                    $affiliationname = $this->db->get();
                                    foreach ($affiliationname->result() as $affiliationnames) {
                                        
                                    }
                                    $this->db->select('*')->where('id =', $nearbys['area_id']);
                                    $this->db->from('areas');
                                    $areaname = $this->db->get();
                                    foreach ($areaname->result() as $areanames) {
                                        
                                    }
                                    $banner = "is_active=1 AND school_id=" . $nearbys['id'] . " AND school_activity_id=2 ";
                                    $this->db->select('*')->where($banner);
                                    $this->db->from('school_images');
                                    $banner = $this->db->get();
                                    foreach ($banner->result() as $banners) {
                                        
                                    }
                                    $school_nearby[$i]['logo'] = $banners->images;
                                    $school_nearby[$i]['school_name'] = $nearbys['school_name'];
                                    $school_nearby[$i]['slug'] = $nearbys['slug'];
                                    $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                    $school_nearby[$i]['address'] = $nearbys['address'];
                                    $school_nearby[$i]['about'] = $nearbys['about'];
                                    $school_nearby[$i]['area'] = $areanames->area_name;
                                    $i++;
                                }
                                $count = count($school_nearby);
                                for ($i = 0; $i < $count; $i++) {
                                    ?>
                                    <div class="row">
                                        <?php
                                        for ($i = $i; $i < $count; $i++) {
                                            $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);


                                            $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name'])
                                            ?>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="nearby-widget mab-30 wow fadeInUp">
                                                    <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">
                                                        <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                            <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                        </div>
                                                    </a>
                                                    <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                        <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                        <ul class="list-unstyled mb-2">
                                                            <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                            <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                        </ul>
                                                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                    </div><!-- /nearby-widget-body -->
                                                </div><!-- /nearby-widget -->
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div><!-- /row -->
                                    <?php
                                }
                            } else {


                                $this->db->select('*');
                                $this->db->from('school_details');
                                $test = $this->db->like('school_name', $search_array[0][0], 'after');
                                $this->db->where('is_active', 1);
//                                $this->db->where('activated_at !=', NULL);
//                                $this->db->where('valitity !=', NULL);
//                                $this->db->where('deleted_at', NULL);
                                $this->db->order_by("slug", "asc");
                                $nearby = $this->db->get();
                                if ($nearby->num_rows() > 0) {
                                    foreach ($nearby->result() as $nearbys) {
                                        $this->db->select('*')->where('id =', $nearbys->affiliation_id);
                                        $this->db->from('affiliations');
                                        $affiliationname = $this->db->get();
                                        foreach ($affiliationname->result() as $affiliationnames) {
                                            
                                        }
                                        $this->db->select('*')->where('id =', $nearbys->area_id);
                                        $this->db->from('areas');
                                        $areaname = $this->db->get();
                                        foreach ($areaname->result() as $areanames) {
                                            
                                        }

                                        $banner = "is_active=1 AND school_id=" . $nearbys->id . " AND school_activity_id=2 ";
                                        $this->db->select('*')->where($banner);
                                        $this->db->from('school_images');
                                        $banner = $this->db->get();
                                        foreach ($banner->result() as $banners) {
                                            
                                        }
                                        $school_nearby[$i]['logo'] = $banners->images;
                                        $school_nearby[$i]['school_name'] = $nearbys->school_name;
                                        $school_nearby[$i]['slug'] = $nearbys->slug;
                                        $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                        $school_nearby[$i]['address'] = $nearbys->address;
                                        $school_nearby[$i]['about'] = $nearbys->about;
                                        $school_nearby[$i]['area'] = $areanames->area_name;
                                        $i++;
                                    }


                                    $count = count($school_nearby);

                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <div class="row">
                                            <?php
                                            for ($i = $i; $i < $count; $i++) {
                                                $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);


                                                $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name']);
                                                ?>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="nearby-widget mab-30 wow fadeInUp">
                                                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">
                                                            <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                                <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                            </div>
                                                        </a>
                                                        <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                            <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                            <ul class="list-unstyled mb-2">
                                                                <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                                <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                            </ul>
                                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                        </div><!-- /nearby-widget-body -->
                                                    </div><!-- /nearby-widget -->
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- /row -->
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h6>Search Not Found..........</h6><br><br>
                                    <div class="section-title  mab-50">
                                        <h2 class="mb-3">Popular Schools in Coimbatore</h2>
                                        <div class="line"></div>
                                    </div><!-- /section-title -->
                                    <?php
                                    $nearby = "is_active=1 AND city_id=" . $city_id;
//                                            $nearby .= " AND activated_at != 'NULL' AND valitity != 'NULL' ";
                                    $nearby .= " AND school_category_id=1 ";
//                                                  $nearby .= "AND deleted_at is NULL ";
                                    $this->db->select('*')->where($nearby);
                                    $this->db->from('school_details');
                                    $this->db->order_by("slug", "asc");
                                    $nearby = $this->db->get();
                                    echo $this->db->last_query();
                                    foreach ($nearby->result() as $nearbys) {
                                        $this->db->select('*')->where('id =', $nearbys->affiliation_id);
                                        $this->db->from('affiliations');
                                        $affiliationname = $this->db->get();
                                        foreach ($affiliationname->result() as $affiliationnames) {
                                            
                                        }
                                        $this->db->select('*')->where('id =', $nearbys->area_id);
                                        $this->db->from('areas');
                                        $areaname = $this->db->get();
                                        foreach ($areaname->result() as $areanames) {
                                            
                                        }
                                        $banner = "is_active=1 AND school_id=" . $nearbys->id . " AND school_activity_id=2 ";
                                        $this->db->select('*')->where($banner);
                                        $this->db->from('school_images');
                                        $banner = $this->db->get();
                                        foreach ($banner->result() as $banners) {
                                            
                                        }
                                        $school_nearby[$i]['logo'] = $banners->images;
                                        $school_nearby[$i]['school_name'] = $nearbys->school_name;
                                        $school_nearby[$i]['slug'] = $nearbys->slug;
                                        $school_nearby[$i]['affiliation_name'] = $affiliationnames->affiliation_name;
                                        $school_nearby[$i]['address'] = $nearbys->address;
                                        $school_nearby[$i]['about'] = $nearbys->about;
                                        $school_nearby[$i]['area'] = $areanames->area_name;
                                        $i++;
                                    }

                                    $count = count($school_nearby);

                                    for ($i = 0; $i < $count; $i++) {
                                        ?>
                                        <div class="row">
                                            <?php
                                            for ($i = $i; $i < $count; $i++) {
                                                $school_name = str_replace(" ", "-", $school_nearby[$i]['school_name']);
                                                //echo $school_name;

                                                $aff_nearby = str_replace(" ", "-", $school_nearby[$i]['affiliation_name'])
                                                ?>
                                                <div class="col-lg-4 col-sm-6">
                                                    <div class="nearby-widget mab-30 wow fadeInUp">
                                                        <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank">

                                                            <div class="object-fit" style="width: 100%;height: 200px;overflow: hidden;">
                                                                <img src="https://edugatein.com/laravel/public/<?php echo $school_nearby[$i]['logo']; ?>" style="width: 100%;height: 200px;object-fit: cover;" alt="schools nearby">
                                                            </div>
                                                        </a>
                                                        <div class="nearby-widget-body py-4 px-4" style="background-color: #f4f4f4;">
                                                            <h6 class="mb-2"><?php echo $school_nearby[$i]['slug']; ?></h6>
                                                            <ul class="list-unstyled mb-2">
                                                                <li class="mb-1"><b>Type:</b> <?php echo $school_nearby[$i]['affiliation_name']; ?> School</li>
                                                                <li class="mb-1"><b>Location:</b> <?php echo $school_nearby[$i]['area']; ?></li>
                                                            </ul>
                                                            <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_nearby; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" class="btn btn-primary mt-2" target="_blank">View Details</a> 
                                                        </div><!-- /nearby-widget-body -->
                                                    </div><!-- /nearby-widget -->
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div><!-- /row -->
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                    ?>
                </div><!-- col-lg-9 -->
            </div><!-- /row -->
        </div>
    </div><!-- /hide --> 
    <?php
}

if (count($school_search) > 0) {
    $school_strength = array();
    $aff_url = $search;
    $aff_url = str_replace("-", " ", $aff_url);
    $this->db->select('*')->where('slug =', $aff_url);
    $this->db->where('is_active', 1);
//    $this->db->where('activated_at !=', NULL);
//    $this->db->where('valitity !=', NULL);
//    $this->db->where('deleted_at', NULL);
    $this->db->from('school_details');
    $schooldet = $this->db->get();
    foreach ($schooldet->result() as $schooldets) {
        $category = $schooldets->school_category_id;
        $school_id = $schooldets->id;
    }
    $this->db->select('*')->where('id =', $school_id);
    $this->db->where('is_active', 1);
//    $this->db->where('activated_at !=', NULL);
//    $this->db->where('valitity !=', NULL);
//    $this->db->where('deleted_at', NULL);
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
    ?>
    <div class="breadrumb-new ">
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
                        <li class="list-inline-item"><a href="<?php echo base_url() ?>list-of-best-<?php echo $affiliation_name; ?>-schools-in-coimbatore"><?php echo ucwords($affiliationnames->affiliation_name); ?> Schools</a></li>
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


    <?php
    if ($category == 1) {
        $school_img = "is_active=1 AND  school_activity_id=2 AND school_id=" . $school_details->id . " AND deleted_at is NULL";
        $this->db->select('*')->where($school_img);
        $this->db->from('school_images');
        $school_image = $this->db->get();
        ?>
        <div class="firstcat-details-group">
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
                        }
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
                                <div class="first-detail-infowidgets-imgbox text-center wow slideInDown" data-toggle="tooltip" data-placement="bottom" title="<?php echo $special_datas->brief_content ?>" data-wow-delay="<?php echo $second; ?>ms" style="height: 180px;">
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
                                    <div class="modal-body p-5">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                        </button>
                                        <h3 class="text-center mb-3" style="color: #303030;">Admission Enquiry</h3>

                                        <form action="<?php echo base_url() ?>search/admission" class="form-row" method="post">
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
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- /modal -->
                        </div>
                    </div>

                    <style>
                        .firstcat-about-section ::placeholder {
                            font-size: 12px;
                        }
                        .firstcat-about-section textarea {
                            border-radius: 0px;
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

                    $management = "is_active=1 AND schooldetails_id=" . $school_details->id . " AND deleted_at is NULL";
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
            <?php
        }
        ?>

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
                                <?php
                            }
                            ?>

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
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div><!-- /swiper-container -->
                        </div>


                        <?php
                        $ms = $ms + 200;
                    }
                    ?>
                </div><!-- /row -->

                <!-- <ul class="nav nav-tabs mab-20" id="myTab" role="tablist">
                    <li class="nav-item wow fadeInUp" data-wow-delay="300ms">
                        <a class="nav-link active" id="Karate-tab" data-toggle="tab" href="#Karate" role="tab" aria-controls="Karate" aria-selected="true">Karate</a>
                      </li> 
                    <li class="nav-item wow fadeInUp" data-wow-delay="400ms">
                        <a class="nav-link" id="Yoga-tab" data-toggle="tab" href="#Yoga" role="tab" aria-controls="Yoga" aria-selected="true">Yoga</a>
                      </li>
                      <li class="nav-item wow fadeInUp" data-wow-delay="500ms">
                        <a class="nav-link" id="Dance-tab" data-toggle="tab" href="#Dance" role="tab" aria-controls="Dance" aria-selected="true">Dance</a>
                      </li>
                      <li class="nav-item wow fadeInUp" data-wow-delay="600ms">
                        <a class="nav-link" id="Swimming-tab" data-toggle="tab" href="#Swimming" role="tab" aria-controls="Swimming" aria-selected="true">Swimming</a>
                      </li> 
                </ul> -->

                <!-- <div class="tab-content mab-30" id="myTabContent">
                    <div class="tab-pane fade show active" id="Karate" role="tabpanel" aria-labelledby="Karate-tab">
                        <div class="slider-rotate" id="slider">
                              <div class="slider-rotate__container">
                                <div class="slider-rotate__item ">
                                    <span class="position">1</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">2</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">3</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">4</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">5</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>

                                <span class="slider-rotate__arrow slider-rotate__arrow--right js-slider-rotate-arrow" data-action="next"><i class="fa fa-angle-right fa-3x"></i></span>
                                <span class="slider-rotate__arrow slider-rotate__arrow--left js-slider-rotate-arrow" data-action="prev"><i class="fa fa-angle-left fa-3x"></i></span>
                              </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="Yoga" role="tabpanel" aria-labelledby="Yoga-tab">
                        <div class="slider-rotate" id="slider">
                              <div class="slider-rotate__container">
                                <div class="slider-rotate__item ">
                                    <span class="position">1</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">2</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">3</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">4</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>
                                <div class="slider-rotate__item">
                                    <span class="position">5</span>
                                    <span class="slider-rotate-imgbox">
                                        <a data-fancybox="gallery" href="https://via.placeholder.com/300x400">
                                            <img src="https://via.placeholder.com/300x400">
                                        </a>	
                                    </span>
                                </div>

                                <span class="slider-rotate__arrow slider-rotate__arrow--right js-slider-rotate-arrow" data-action="next"><i class="fa fa-angle-right fa-3x"></i></span>
                                <span class="slider-rotate__arrow slider-rotate__arrow--left js-slider-rotate-arrow" data-action="prev"><i class="fa fa-angle-left fa-3x"></i></span>
                              </div>
                        </div>
                    </div>
                </div> -->
            </div><!-- /container -->
        </div><!-- /firstcat-activity-section -->

        <?php
        $graph_data = "is_active=1 AND id=" . $schooldets->id . " AND deleted_at is NULL";
        $this->db->select('boys,girls,teachers')->where($graph_data);
        $this->db->where('activated_at !=', NULL);
        $this->db->where('valitity !=', NULL);
        $this->db->from('school_details');
        $graph_data = $this->db->get();
        $data = array();
        foreach ($graph_data->result() as $graph_datas) {
            if (isset($graph_datas->boys)) {
                $data[] = $graph_datas->boys;
            }
            if (isset($graph_datas->girls)) {
                $data[] = $graph_datas->girls;
            }
            if (isset($graph_datas->teachers)) {
                $data[] = $graph_datas->teachers;
            }
        }

        if (isset($data)) {
            $pie_graph = implode(",", $data);
        }


        $bargraph_data = "is_active=1 AND school_id=" . $schooldets->id . " AND deleted_at is NULL";
        $this->db->select('year,pass_percent')->where($bargraph_data);
        $this->db->from('pass_percents');
        $bargraph_data = $this->db->get();

        foreach ($bargraph_data->result() as $bargraph_datas) {
            $bar_year[] = $bargraph_datas->year;
            $bar_pass[] = $bargraph_datas->pass_percent;
        }

        if (isset($bar_pass)) {
            $bar_pass = implode(",", $bar_pass);
        }
        if (isset($bar_year)) {
            $bar_year = implode(",", $bar_year);
        }
        //$pie_graph = json_encode($data);
        //echo $pie_graph;
        //exit();
        // if(isset($bar_pass) && isset($bar_year) || isset($pie_graph))
        // {
        ?>
        <div class="first-gallery-section section-pad">
            <div class="container">
                <div class="row">
                    <?php
                    if (strlen($pie_graph) > 0) {
                        ?>
                        <div class="col-lg-6 mab-30">
                            <div class="section-title mab-30 wow fadeInUp" data-wow-delay="300ms">
                                <h2 class="mb-2">Students vs Teachers </h2>
                                <div class="line"></div>
                            </div>
                            <canvas id="myChart" width="400" height="300"></canvas>
                        </div>
                        <?php
                    }
                    if (isset($bar_year) && isset($bar_pass)) {
                        ?>
                        <div class="col-lg-6 mab-30">
                            <div class="section-title mab-30 wow fadeInUp" data-wow-delay="500ms">
                                <h2 class="mb-2">Pass Percentage</h2>
                                <div class="line"></div>
                            </div>

                            <canvas id="myChart1" width="400" height="300"></canvas>
                        </div>
                    <?php } ?>            
                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /first-gallery-section --> 
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
                            <p class="mb-2"><span class="exo"><b>Phone:</b></span> 
                                <a href="tel:8220059603" style="color:#fff;">+91 <?php echo $school_details->mobile; ?></a>
                            </p>
                            <p><span class="exo"><b>E-mail:</b></span> 
                                <a href="mailto:info@yuvabharathi.in" style="color: #fff;"><?php echo $school_details->email; ?></a>
                            </p>

                            <h4 class="mt-4 text-white"><u>Social Links</u></h4>
                            <ul class="list-inline mt-2">
                                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                               <!--  <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
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
                        <div class="col-lg-9 col-md-7 mab-30">
                            <div class="second-img-box wow fadeInUp" data-wow-delay="600ms">
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
                        <div class="col-lg-3 col-md-5 mab-30">
                            <div class="second-info-widget h-100 wow fadeInUp" data-wow-delay="700ms">
                                <ul class="list-unstyled">
                                    <?php
                                    $special_count = 0;
                                    foreach ($special_data->result() as $special_datas) {
                                        if ($special_count < 6) {
                                            ?>
                                            <li><b><i class="<?php echo $special_datas->icon_class; ?>"></i> <?php echo $special_datas->heading; ?>:</b> <span class="float-right">&nbsp;<?php echo $special_datas->content; ?></span></li>

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

            <div class="second-about-info mab-50">
                <div class="container">
                    <div class="section-title mab-20">
                        <h4 class="mb-2 wow fadeInUp" data-wow-delay="300ms">About <?php echo $school_details->slug; ?></h4>
                        <div class="line wow fadeInUp" data-wow-delay="400ms"></div>
                    </div><!-- /schoolheading -->

                    <p class="wow fadeInUp" data-wow-delay="500ms"><?php echo $school_details->about; ?></p>
                </div><!-- /container -->
            </div><!-- /second-about-info -->

            <div class="second-activity-group mab-80">
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
                                $this->db->limit(1);
                                $activity_image = $this->db->get();

                                foreach ($activity_image->result() as $activity_images) {
                                    ?>
                                    <div class="col-lg-2 col-md-3 col-sm-6 text-center mab-30 wow fadeInUp" data-wow-delay="300ms">
                                        <div class="second-activity-imgbox">
                                            <img src="<?php echo base_url() ?>laravel/public/<?php echo $activity_images->images ?>" class="w-100 rounded-circle" alt="">
                                        </div>
                                        <p class="lead mt-2"><?php echo $activitynames->activity_name; ?></p>
                                    </div>

                                    <?php
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
                        <div class="col-lg-9 mab-30">
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

                        <div class="col-lg-3 mab-30">
                            <div class="section-title mab-30">
                                <h4 class="mb-2 wow fadeInUp" data-wow-delay="500ms">Location</h4>
                                <div class="line wow fadeInUp" data-wow-delay="600ms"></div>
                            </div><!-- /schoolheading -->

                            <div class="address-widget bg-white wow fadeInUp p-4" data-wow-delay="700ms" style="border-radius: 10px;">
                                <!-- <h4 class="mb-3">Location</h4> -->
                                <p class="mb-2"><span class="exo"><b>Address:</b></span><?php echo $school_details->address; ?></p>
                                <p class="mb-2"><span class="exo"><b>Phone:</b></span> <a href="tel:<?php echo $school_details->mobile; ?>" style="color:#7d7d7d;">+91 <?php echo $school_details->mobile; ?></a></p>
                                <p><span class="exo"><b>E-mail:</b></span> <a href="mailto:info@yuvabharathi.in" style="color: #7d7d7d;"><?php echo $school_details->email; ?></a></p>

                                <h4 class="mt-4 pink">Social Links</h4>
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

        <!-- <hr> -->

        <div class="popular-schools" style="padding-top: 30px;">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Popular Schools in Coimbatore</h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->
                <?php
                $popular = "is_active=1 AND city_id=" . $city_id;
                $popular .= " AND activated_at != 'NULL' AND valitity != 'NULL' ";
                $popular .= "AND school_category_id=1";
                $this->db->select('*')->where($popular);
                $this->db->from('school_details');
                $popular = $this->db->get();
                ?>
                <div class="owl-carousel owl-theme">
                    <?php
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
                            //$area_name = str_replace(" ","-",$area_name);
                        }

                        $school_name = str_replace(" ", "-", $populars->school_name);
                        ?>
                        <div class="item">
                            <figure class="snip1208">
                                <div class="object-fit" style="width: 100%;height: 160px;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 160px;object-fit: cover;">
                                </div>

                                <figcaption class="">
                                    <h4><?php echo $populars->school_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank"></a>
                            </figure>
                        </div><!-- /item -->
                        <?php
                    }
                    ?>

                </div><!-- /owl-carousel -->
            </div><!-- /container -->
        </div> 
        <!-- /popular-schools -->
        <?php
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
                                        $act_name[] = $activitynames->activity_name;
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
                                        <div class="col-lg-8"><p>+91 <?php echo $school_details->mobile; ?></p></div>
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

        <div class="popular-schools" style="padding-top: 30px;">
            <div class="container">
                <div class="section-title text-center mab-50">
                    <h1 class="mb-3">Popular Schools in Coimbatore</h1>
                    <div class="line1"></div>
                </div><!-- /section-title -->

                <?php
                $popular = "is_active=1 AND city_id=" . $city_id . " AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=1";
                $this->db->select('*')->where($popular);
                $this->db->from('school_details');
                $popular = $this->db->get();
                ?>
                <div class="owl-carousel owl-theme">
                    <?php
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
                            //$area_name = str_replace(" ","-",$area_name);
                        }

                        $school_name = str_replace(" ", "-", $populars->school_name);
                        ?>
                        <div class="item">
                            <figure class="snip1208">
                                <div class="object-fit" style="width: 100%;height: 160px;">
                                    <img src="https://edugatein.com/laravel/public/<?php echo $populars->logo ?>" class="w-100" alt="popular schools in coimbatore"/ style="width: 100%;height: 160px;object-fit: cover;">
                                </div>
                                <figcaption class="">
                                    <h4><?php echo $populars->school_name; ?></h4>
                                    <p class="lead" style="color: #909090;"><i class="fa fa-map-marker"></i> <b><?php echo $area_name ?></b></p>
                                    <button type="button" class="btn btn-primary1">Read More</button>
                                </figcaption>
                                <a href="<?php echo base_url() ?>list-of-best-<?php echo $aff_name; ?>-schools-in-coimbatore/<?php echo $school_name; ?>" target="_blank"></a>
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
}
?>


</div><!-- /.container -->
</div>


<div id="footer">
    <svg id="deco-clouds" xmlns="https://www.w3.org/2000/svg" version="1.1" style="background-color: #fff;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
    <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
    </path>
    </svg>
</div><!-- /footer -->

<!-- Footer templete -->
<?php $this->load->view('footer'); ?>

<!-- ============ Back-to-top ============ -->
<div class="top-to-bottom">
    <a id="button">
        <i class="fa fa-chevron-up"></i>
    </a>    
</div><!-- /top-to-bottom -->
<?php
if (isset($category)) {
    if ($category == 1) {
        if (isset($pie_graph)) {
            ?>
            <script>
                var data = [<?php echo $pie_graph; ?>];
                // console.log(data);
                // alert(data);
                var ctx = document.getElementById("myChart");
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Boys", "Girls", "Teachers"],
                        datasets: [{
                                label: '# of Votes',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                    },
                    options: {
                        scales: {
                            // yAxes: [{
                            //     ticks: {
                            //         // beginAtZero:true
                            //         // mirror: true
                            //     }
                            // }]
                        }
                    }
                });
            </script> 
            <?php
        }
        if (isset($bar_year) && isset($bar_pass)) {
            ?>
            <script>
                var bar_year = [<?php echo $bar_year; ?>];
                var bar_pass = [<?php echo $bar_pass; ?>];
                var ctx = document.getElementById("myChart1");
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: bar_year,
                        datasets: [{
                                label: 'Pass Percentage',
                                data: bar_pass,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                        }
                    }
                });
            </script>
            <?php
        }
    }
}
?>
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