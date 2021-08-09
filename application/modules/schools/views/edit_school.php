<?php 
    $userid = base64_decode($_GET['id']);
    $this->db->select('*');
    $this->db->from('school_details');
    $this->db->where("id", $userid);
    $school = $this->db->get()->result_array();
    //to get selected area
    $this->db->select('*')->where('id =', $school[0]['area_id']);
    $this->db->from('areas');
    $area = $this->db->get()->result_array();
    //to get selected city
    $this->db->select('*')->where('id=',$school[0]['city_id']);
    $this->db->from('cities');
    $city1 = $this->db->get()->result_array();
    //to get selected affiliation
    $this->db->select('*')->where('id=',$school[0]['affiliation_id']);
    $this->db->from('affiliations');
    $affiliation = $this->db->get()->result_array();
    //to get selected school type
    $this->db->select('*')->where('id=',$school[0]['schooltype_id']);
    $this->db->from('school_types');
    $school_type = $this->db->get()->result_array();
?>       
<div class="col-12 mt-0 bg-white py-3">
    <div class="border py-3 pl-3 ">
    <h3><?php echo $school[0]["school_name"]; ?></h3> 
    </div>
    <table class="table table-bordered table-sm" id="example">    
    <div class="col-lg-3 col-sm-6" style="display:none">
                        <div class="form-group">
                            <label for="user_id">user id</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $userid; ?>" placeholder="e.g. Haunuz Matriculation" required>
                        </div>
                    </div>    
        <tr>
            <td>Mobile</td>
            <td><input type="text" name="mobile" value="<?php echo $school[0]['mobile'];?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $school[0]['email'];?>"></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type="text" name="address" value="<?php echo $school[0]['address'];?>"></td>
        </tr><tr>
            <td>City</td>
            <td><select class="form-control" name="city" id="exampleFormControlSelect1" required>
            <option value="">--Select City--</option>
            <?php
                $this->db->select('*');
                $this->db->from('cities');
                $city = $this->db->get();
                foreach ($city->result() as $citys) {
            ?>
            <option value="<?php echo $citys->city_name;?>" <?php if($citys->city_name == $city1[0]['city_name']){echo "selected";} ?> ><?php echo $citys->city_name; ?></option>
            <?php } ?>
        </select></td>
        </tr><tr>
            <td>Area</td>
            <td><input type="text" name="area" value="<?php echo $area[0]['area_name'];?>"></td>
        </tr><tr>
            <td>Pincode</td>
            <td><input type="text" name="pincode" value="<?php echo $school[0]['pincode'];?>"></td>
        </tr><tr>
            <td>School Type</td>
            <td><select class="form-control" name="schoolboard" id="exampleFormControlSelect1" required>
                <option value="" >e.g. Elementary School</option>
                <option value="Elementary School"<?php if($school_type[0]['school_type']=="Elementary School"){echo "selected";}?>>Elementary School</option>
                <option value="Preschools"<?php if($school_type[0]['school_type']=="Preschools"){echo "selected";}?>>Preschools</option>
                <option value="High School"<?php if($school_type[0]['school_type']=="High School"){echo "selected";}?>>High School</option>
                <option value="Higher Secondary School"<?php if($school_type[0]['school_type']=="Higher Secondary School"){echo "selected";}?>>Higher Secondary School</option>
                <option value="Special school"<?php if($school_type[0]['school_type']=="Special school"){echo "selected";}?>>Special school</option>
            </select></td>
        </tr><tr>
            <td>Affiliation</td>
        <td><select class="form-control" name="level" id="exampleFormControlSelect1" required>
            <option value="">e.g. Matriculation School</option>
            <option value="cbse"<?php if('cbse' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>CBSE School</option>
            <option value="international"<?php if('international' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>International School</option>
            <option value="matriculation"<?php if('matriculation' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Matriculation School</option>
            <option value="special"<?php if('special' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Special School</option>
            <option value="kindergarten"><?php if('kindergarten' == $affiliation[0]['affiliation_name']){echo "selected";} ?>Kindergarten</option>
            </select></td>
        </tr>
        <tr>
            <td>About</td>
            <td><input type="text" name="about" value="<?php echo $school[0]['about'];?>"></td>
        </tr><tr>
            <td>Website</td>
            <td><input type="text" name="website_url" value="<?php echo $school[0]['website_url'];?>"></td>
        </tr><tr>
            <td>Establishment	</td>
            <td><input type="text" name="year_of_establish" value="<?php echo $school[0]['year_of_establish'];?>"></td>
        </tr><tr>
            <td>Map</td>
            <td><input type="text" name="map_url" value="<?php echo $school[0]['map_url'];?>"></td>
        </tr><tr>
            <td>Mission</td>
            <td><input type="text" name="our_mission" value="<?php echo $school[0]['our_mission'];?>"></td>
        </tr><tr>
            <td>Vision</td>
            <td><input type="text" name="our_vision" value="<?php echo $school[0]['our_vision'];?>"></td>
        </tr><tr>
            <td>Motto</td>
            <td><input type="text" name="our_motto" value="<?php echo $school[0]['our_motto'];?>"></td>
        </tr><tr>
            <td>Ad</td>
            <td><input type="text" name="ad" value="<?php echo $school[0]['ad'];?>"></td>
        </tr><tr>
            <td>Type</td>
            <td><select class="form-control" id="exampleFormControlSelect1" name="schooltype" required>
                <option value="">School Type</option>
                <option value="Co-Ed"<?php if($school[0]['type']== "Co-Ed"){echo "selected";}?>>Co-Ed</option>
                <option value="Girls"<?php if($school[0]['type']== "Girls"){echo "selected";}?>>Girls</option>
                <option value="Boys"<?php if($school[0]['type']== "Boys"){echo "selected";}?>>Boys</option>
                <option value="Other"<?php if($school[0]['type']== "Other"){echo "selected";}?>>Other</option>
            </select></td>
        </tr><tr>
            <td>Hostel</td>
            <td><div class="form-row">
            &nbsp;&nbsp;<div class="custom-control custom-radio">
                &nbsp;<input type="radio" id="customRadio3" value="1" name="customRadio1" class="custom-control-input" >
                <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio4" value="0" name="customRadio1" class="custom-control-input" >
                <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">&nbsp;No</label>
            </div>
            </div></td>
        </tr><tr>
            <td>RTE Act.</td>
            <td><div class="form-row">
            &nbsp;&nbsp;<div class="custom-control custom-radio">
                &nbsp;<input type="radio" id="customRadio1" value="1" name="customRadio" class="custom-control-input" >
                <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label>
            </div>&nbsp;&nbsp;&nbsp;
            <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" value="0" name="customRadio" class="custom-control-input" >
                <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio2">&nbsp;No</label>
            </div>
        </div></td>
        </tr><tr>
            <td>No of Students	</td>
            <td><input type="text" name="students" value="<?php echo $school[0]['students'];?>"></td>
        </tr><tr>
            <td>Boys</td>
            <td><input type="text" name="boys" value="<?php echo $school[0]['boys'];?>"></td>
        </tr><tr>
            <td>Girls</td>
            <td><input type="text" name="girls" value="<?php echo $school[0]['girls'];?>"></td>
        </tr><tr>
            <td>Teachers</td>
            <td><input type="text" name="teachers" value="<?php echo $school[0]['teachers'];?>"></td>
        </tr><tr>
            <td>facebook</td>
            <td><input type="text" name="facebook" value="<?php echo $school[0]['facebook'];?>"></td>
        </tr><tr>
            <td>twitter</td>
            <td><input type="text" name="twitter" value="<?php echo $school[0]['twitter'];?>"></td>
        </tr><tr>
            <td>instagram</td>
            <td><input type="text" name="instagram" value="<?php echo $school[0]['instagram'];?>"></td>
        </tr><tr>
            <td>linkedin</td>
            <td><input type="text" name="linkedin" value="<?php echo $school[0]['linkedin'];?>"></td>
        </tr><tr>
            <td>pinterest</td>
            <td><input type="text" name="pinterest" value="<?php echo $school[0]['pinterest'];?>"></td>
        </tr><tr>
            <td>is_active</td>
            <td><input type="text" name="is_active" value="<?php echo $school[0]['is_active'];?>"></td>
        </tr>
    </table>
</div> 
<?php
    $this->db->select('*')->where('city_name =', $_POST['city']);
    $this->db->from('cities');
    $yourcityarray = $this->db->get();
    foreach ($yourcityarray->result() as $yourcitys) {
        $yourcity_id = $yourcitys->id;
    }

    $this->db->select('*')->where('area_name =', $_POST['area']);
        $this->db->from('areas');
        $area = $this->db->get();


        if ($area->num_rows() > 0) {
            foreach ($area->result() as $areas) {
                $area_id = $areas->id;
                //exit();
            }
        } else {
            $areainsert = array(
                'area_name' => $_POST['area'],
                'slug' => $_POST['area'],
                'city_id' => $yourcity_id,
                'is_active' => 1
            );
            $this->db->insert('areas', $areainsert);

            $this->db->select('*')->where('area_name =', $_POST['area']);
            $this->db->from('areas');
            $area = $this->db->get();
            foreach ($area->result() as $areas) {
                $area_id = $areas->id;
            }
        }
                $this->db->select('*')->where('affiliation_name =', $_POST['schoolboard']);
        $this->db->from('affiliations');
        $schoolboardarray = $this->db->get();

        foreach ($schoolboardarray->result() as $schoolboards) {
            $schoolboard_id = $schoolboards->id;
        }

        if (isset($_POST['level'])) {
            $school['level'] = $_POST['level'];

            $this->db->select('*')->where('school_type =', $_POST['level']);
            $this->db->from('school_types');
            $level = $this->db->get();
            foreach ($level->result() as $levels) {
                $level_id = $levels->id;
            }
        } else {
            $level_id = NULL;
        }

        if (isset($_POST['customRadio2'])) {
            $customRadio1 = $_POST['customRadio2'];
        } else {
            $customRadio1 = NULL;
        }

        if (isset($_POST['customRadio1'])) {
            $customRadio = $_POST['customRadio1'];
        } else {
            $customRadio = NULL;
        }

        $school_update=array(
            'school_name' => $_POST['schoolname'],
            'slug' => $_POST['schoolname'],
            'mobile' => $_POST['mobile'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'user_id' => $_POST['user_id'],
            'city_id' => $yourcity_id,
            'area_id' => $area_id,
            'affiliation_id' => $schoolboard_id,
            'schooltype_id' => $level_id,
            'school_category_id' => 1,
            'about' => $school['about'],
            'website_url' => $school['website'],
            'year_of_establish' => $school['founded'],
            'ad' => $_POST['ad'],
            'hostel' => $customRadio1,
            'rte' => $customRadio,
            'students' => $_POST['students'],
            'boys' => $_POST['boys'],
            'girls' => $_POST['girls'],
            'teachers' => $_POST['teachers'],
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'instagram' => $_POST['instagram'],
            'linkedin' => $_POST['linkedin'],
            'pinterest' => $_POST['pinterest'],
            'logo' => $banner1_name,
            'is_active' => 1,
        );
?>