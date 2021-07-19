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