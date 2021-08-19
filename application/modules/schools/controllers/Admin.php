<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

    protected $file_name_field = 'filename';
    protected $primary_key = 'id';
    protected $allowed_types = 'gif|jpeg|jpg|png';

    function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('admin');
        }

        $this->_init();
    }

    private function _init() {
      
        $this->output->set_template('default');
    }

    public function index() {
        $data['listUrl'] = base_url('admin/schools');
        $data['formName'] = 'Schools';
        $data['addLink'] = base_url('admin/schools/add');

//        $fields = "s.*,g.name as grade,(CASE WHEN gender_id=1 THEN 'Male' WHEN gender_id=0 THEN 'Female'   ELSE '' END ) as gender,date_format(dob, '%d-%m-%Y') as dob ";
//        $join_tables[] = array(
//            'table_name' => 'grades  g ',
//            'table_condition' => 'g.id = s.grade_id',
//            'table_type' => 'inner '
//        );
//
//        $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => '', 'value' => 0);
        $data['table_records'] = $this->Base_Model->getAdvanceList('school_details', "", "*", "", array('return' => 'result_array'), 'id');
        $this->load->view('view', $data);
    }

    public function institute(){
        $data['formName'] = 'Institutes';
        $data['activity_class']= $this->Base_Model->getAdvanceList('institute_details', "", "*", "", array('return' => 'result_array'), 'id');
        $this->load->view('activity_class',$data);
    }
    public function add() {
        $data = array('primary_key' => "", 'formType' => 'Add', 'buttonValue' => 'Save', 'student' => array('name' => '', 'gender_id' => '', 'is_active' => ''),
            'sibilings' => array(), 'favourite_value' => array('color' => '', 'food' => '', 'teacher' => '', 'toy' => '', 'snacks' => '', 'hobbies' => '', 'outfit' => '',
                'places' => '', 'sports' => '', 'vegetables' => '', 'subjects' => ''));
        $data['grades'] = $this->Base_Model->getSelectList('grades', array("is_active" => 0), array('' => 'Select Grade'), $fields = 'id,name');
        $data['academic_years'] = $this->Base_Model->getSelectList('academic_years', array("is_active" => 0, "student_add_year" => 0), "", $fields = 'id,name');
        $data['formName'] = 'Student <small>Add</small>';
        $unique = mt_rand();
        $box_script = '';
        $box_script .= "add_input_" . $unique . "(null,'','','academic_info');";
        $box_script .= "add_input_" . $unique . "(null,'','','non_academic_info');";
        $data['unique'] = $unique;
        $data['field_info'] = "academic_info";
        $data['box_script'] = $box_script;
        $data['fields'] = 'title';
        $data['primary_key'] = "";
        $this->load->view('add', $data);
    }

    function examinations($edit = false, $primary_key, $grade_id) {
        if ($edit) {
            $this->Base_Model->delete('marks', array("student_id" => $primary_key));
        }
        $examinations = $this->Base_Model->get_records('examinations', '*');
        foreach ($examinations as $exam) {
            $query = $this->db->query("CALL syllabus_in(" . $primary_key . "," . $exam["id"] . ")");
        }
    }

    public function create() {

        if ($this->valid_fields() == 1) {
            $multiple_fields = $post_array = $this->input->post();
            $student_sub = array();
            unset($post_array['dob']);
            unset($post_array['academic_info']);
            unset($post_array['non_academic_info']);
            unset($post_array['sibiling']);
            unset($post_array['birth_timing']);
            $student_infos = array('badge', 'humanity', 'native_place', 'zodiac', 'communication_language', 'caste', 'vision', 'health_condition', 'involvement', 'helping_tendency', 'communication_with_friends', 'nationality', 'languages_known');
            foreach ($student_infos as $student_info) {
                if (!empty($post_array[$student_info]))
                    $student_sub[$student_info] = $post_array[$student_info];
                unset($post_array[$student_info]);
            }
            $student_favourtie = $post_array["favourite"];
            unset($post_array["favourite"]);
            if (isset($post_array['joining_date']))
                unset($post_array['joining_date']);
            if (isset($post_array['primary_key'])) {
                unset($post_array['primary_key']);
                $primary_key = base64_decode($this->input->post('primary_key'));
                $exsisting = $this->Base_Model->get_record_by_id('students', array('grade_id'), array('id' => $primary_key));
                $update_data = array_merge($post_array, $this->common_data(true));
                $update_query = $this->db->update("students", $update_data, array("id" => $primary_key));
                if ($exsisting["grade_id"] != $post_array['grade_id']) {
                    $primary_key = base64_decode($this->input->post('primary_key'));
                    $this->examinations(true, $primary_key, $exsisting['grade_id']);
                }
                $student_info = array_merge($student_sub, array('student_id' => $primary_key, "created" => date('Y-m-d H:i:s'), "modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id'], 'birth_timing' => (!empty($this->input->post('birth_timing')) ? date('H:i', strtotime($this->input->post('birth_timing'))) : '')));
                $this->Base_Model->CheckExistAndUpdate("student_info", $student_info, array(array(true, "student_id", $primary_key)));
                $student_favourties = array_merge($student_favourtie, array('student_id' => $primary_key, "created" => date('Y-m-d H:i:s'), "modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id']));
                $this->Base_Model->CheckExistAndUpdate("student_favourites", $student_favourties, array(array(true, "student_id", $primary_key)));
                $student = $this->getStudentData($primary_key);
                $this->is_multiple_fields($multiple_fields, $primary_key, $student["academic_year_id"]);

                if (isset($_FILES) && !empty($_FILES)) {
                    $filePath = './appdata/students/' . $primary_key . '/';
                    $pictures = array("profile_picture", "cover_picture");
                    foreach ($pictures as $picture) {
                        if (!empty($_FILES[$picture]['name'])) {
                            $filedetails = $this->file_upload($picture, $filePath);
                            $this->db->update("students", array($picture => $filedetails['file_name']), array("id" => $primary_key));
                        }
                    }
                }

                if ($update_query) {
                    $this->session->set_flashdata('success_message', 'Successfully Updated!!!');
                    echo json_encode(array('status' => 'success', 'redirect_url' => site_url() . 'admin/students'));
                    die;
                }
            } else {
                $create_data = array_merge($post_array, $this->common_data());
                $id = $this->Base_Model->insert("students", $create_data);
                $this->examinations('', $id, $post_array['grade_id']);
                $student_info = array_merge($student_sub, array('student_id' => $id, "created" => date('Y-m-d H:i:s'), "modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id']));
                $this->Base_Model->insert("student_info", $student_info);
                $student_favourties = array_merge($student_favourtie, array('student_id' => $id, "created" => date('Y-m-d H:i:s'), "modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id']));
                $this->Base_Model->insert("student_favourites", $student_favourties);
                $student = $this->getStudentData($id);
                $this->is_multiple_fields($multiple_fields, $id, $student["academic_year_id"]);
                if (isset($_FILES) && !empty($_FILES)) {
                    $filePath = './appdata/students/' . $id . '/';
                    $pictures = array("profile_picture", "cover_picture");
                    foreach ($pictures as $picture) {
                        if (!empty($_FILES[$picture]['name'])) {
                            $filedetails = $this->file_upload($picture, $filePath);
                            $this->db->update("students", array($picture => $filedetails['file_name']), array("id" => $id));
                        }
                    }
                }
                if (!empty($id)) {
                    $this->session->set_flashdata('success_message', 'Successfully Saved !!!');
                    echo json_encode(array('status' => 'success', 'redirect_url' => site_url() . 'admin/students'));
                    die;
                } else {
                    $this->session->set_flashdata('error_message', 'Could\'nt Save !!!');
                    echo json_encode(array('status' => 'success', 'redirect_url' => site_url() . 'admin/students'));
                    die;
                }
            }
        } else {
            $error_fields = array('name' => form_error('Student Name'),
                'is_active' => form_error('is_active')
            );
            echo json_encode(
                    array('status' => 'error', 'error_fields' => $error_fields)
            );
            die;
        }
    }

    function edit($primary_key) {
        $data = array('primary_key' => $primary_key, 'formName' => 'Student <small>Edit</small>', 'formType' => 'Edit', 'buttonValue' => 'Update');
        $data['grades'] = $this->Base_Model->getSelectList('grades', array("is_active" => 0), array('' => 'Select Grade'), $fields = 'id,name');
        $data['academic_years'] = $this->Base_Model->getSelectList('academic_years', array("is_active" => 0), array('' => 'Select Academic Year'), $fields = 'id,name');
//        $data['student'] = $this->Base_Model->get_record_by_id('students', array('*', 'date_format(dob, "%d-%m-%Y") as dob', 'IF(joining_date,DATE_FORMAT(joining_date, "%d-%m-%Y"),NULL)  AS joining_date'), array('id' => base64_decode($primary_key)));
        $fields = "s.*,date_format(s.dob, '%d-%m-%Y') as dob,IF(s.joining_date,DATE_FORMAT(joining_date, '%d-%m-%Y'),NULL)  AS joining_date,"
                . "badge, humanity, native_place, zodiac, communication_language, caste, vision, health_condition, involvement, helping_tendency, communication_with_friends, nationality, languages_known, birth_timing ";
        $join_tables[] = array(
            'table_name' => 'student_info  si ',
            'table_condition' => 's.id = si.student_id',
            'table_type' => 'left'
        );

        $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 's.id', 'value' => base64_decode($primary_key));
        $data['student'] = $this->Base_Model->getAdvanceList('students s ', $join_tables, $fields, $sub_where, array('return' => 'row_array'), 's.id');
        $sibilings_where[] = array(TRUE, 'student_id', base64_decode($primary_key));
        $sibilings_fields = array('name', 'class', 'emis_no');
        $data['sibilings'] = $this->Base_Model->get_records('student_sibilings', $sibilings_fields, $sibilings_where, 'result_array', 'id', 'asc');
        $favourtie_where[] = array(TRUE, 'student_id', base64_decode($primary_key));
        $favourite_fields = array('*');
        $data['favourite_value'] = $this->Base_Model->get_records('student_favourites', $favourite_fields, $favourtie_where, 'row_array', 'id', 'asc');

        $unique = mt_rand();
        $box_script = '';
//        $where[] = array(TRUE, 'is_active', 1);
        $where[] = array(TRUE, 'student_id', base64_decode($primary_key));
        $fields = array('title', 'description');
        $academic_infos = $this->Base_Model->get_records('academic_info', $fields, $where, 'result_array', 'id', 'asc');
        $non_academic_infos = $this->Base_Model->get_records('non_academic_info', $fields, $where, 'result_array', 'id', 'asc');
        if ($academic_infos) {
            foreach ($academic_infos as $academic_info) {
                $box_script .= "add_input_" . $unique . "(null,'" . $academic_info['title'] . "','" . addslashes($academic_info['description']) . "', 'academic_info');";
            }
        } else
            $box_script .= "add_input_" . $unique . "(null,'','','academic_info');";
        if ($non_academic_infos) {
            foreach ($non_academic_infos as $non_academic_info) {
                $box_script .= "add_input_" . $unique . "(null,'" . $non_academic_info['title'] . "','" . addslashes($non_academic_info['description']) . "','non_academic_info');";
            }
        } else
            $box_script .= "add_input_" . $unique . "(null,'','','non_academic_info');";
        $data['unique'] = $unique;
//        $data['field_info'] = array("academic_info", "non_academic_info");
        $data['box_script'] = $box_script;
        $data['fields'] = 'title';
        $data['primary_key'] = $primary_key;
        $this->load->view('add', $data);
    }

    function delete($student_id) {
        $query = false;
        $student_id = base64_decode($student_id);
        if (!empty(trim($student_id))) {
            $filePath = './appdata/students/' . $student_id . '/';
            $deleteFiles = $this->Base_Model->deleteFiles($filePath);

            $this->Base_Model->delete('marks', array("student_id" => $student_id));
            $this->Base_Model->delete('student_sibilings', array("student_id" => $student_id));
            $this->Base_Model->delete('academic_info', array("student_id" => $student_id));
            $this->Base_Model->delete('non_academic_info', array("student_id" => $student_id));
            $this->Base_Model->delete('student_favourites', array("student_id" => $student_id));
            $this->Base_Model->delete('student_info', array("student_id" => $student_id));
            $query = $this->Base_Model->delete('students', array("id" => $student_id));
            if ($query) {
                $value = array("status" => "success");
                $this->session->set_flashdata('success_message', 'Successfully deleted !!!');
                echo json_encode($value);
                die;
            } else {
                $value = array("status" => "error");
                $this->session->set_flashdata('error_message', 'Something went wrong !!');
                echo json_encode($value);
                die;
            }
        }
        $value = array("status" => "error");
        $this->session->set_flashdata('error_message', 'Something went wrong !!');
        echo json_encode($value);
        die;
    }

    function valid_fields() {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Student Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'about',
                'label' => 'About',
                'rules' => 'trim'
            ),
            array(
                'field' => 'is_active',
                'label' => 'Status',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        return $this->form_validation->run();
    }

    function common_data($edit = false) {
        $common_data = array("modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id']);
        $student = $this->Base_Model->get_records('students', 'max(CONVERT(rollno,UNSIGNED INTEGER)) + 1 AS rollno', '', 'row_array');
        if (!$edit) {
            $common_data["created"] = date('Y-m-d H:i:s');
            $common_data["rollno"] = $student['rollno'];
        }
        $common_data = array_merge($common_data, $this->date_input());
        return $common_data;
    }

    function date_input() {
        $post_data = $this->input->post();
        $form_inputs = array('dob', 'joining_date');
        foreach ($form_inputs as $key => $value) {
            if (isset($post_data[$value]) && !empty($post_data[$value])) {
                $form_input[$value] = date('Y-m-d', strtotime($post_data[$value]));
            } else {
                $form_input[$value] = '';
            }
        }
        return $form_input;
    }

    function file_upload($field, $filePath) {
        $config = array();
        $this->load->helper('file');
        $this->_mkdir($filePath);
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = '*';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            return $this->upload->display_errors();
        } else {
            return $this->upload->data();
        }
    }

    function _mkdir($filePath) {
        // from php.net/mkdir user contributed notes
        if (file_exists($filePath)) {
            if (!@is_dir($filePath)) {
                return false;
            } else {
                return true;
            }
        }
        // Attempting to create the directory may clutter up our display.
        if (@mkdir($filePath)) {
            $stat = @stat(dirname($filePath));
            $dir_perms = $stat['mode'] & 0007777;  // Get the permission bits.
            @chmod($filePath, $dir_perms);
            return true;
        } else {
            if (is_dir(dirname($filePath))) {
                return false;
            }
        }
        // If the above failed, attempt to create the parent node, then try again.
        if ($this->_mkdir(dirname($filePath))) {
            return $this->_mkdir($filePath);
        }
        return false;
    }

    function deleteFile() {
        $primary_key = base64_decode($this->input->post('primary_key'));
        $imageName = $this->input->post('ImageName');
        $fieldName = $this->input->post('FieldName');
        $filePath = './appdata/students/' . $primary_key . '/' . $imageName;
        $deleteFiles = $this->Base_Model->deleteFiles($filePath);
        $update = $this->Base_Model->update("students", array($fieldName => ""), array("id" => $primary_key));
        if ($update) {
            $this->session->set_flashdata('success_message', 'file successfully deleted !!!');
        } else {
            $this->session->set_flashdata('error_message', 'file could not delete !!!');
        }
        die;
    }

    function is_multiple_fields($post_array, $primary_key = null,$academic_year_id) {
        $this->Base_Model->delete('student_sibilings', array('student_id' => $primary_key));
        if (!empty($post_array['sibiling']['name'])) {
            foreach ($post_array['sibiling']['name'] as $key => $value) {
                if (!empty($value)) {
                    $data = array("modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id'], "student_id" => $primary_key, "name" => $value, "class" => $post_array['sibiling']['class'][$key], "emis_no" => $post_array['sibiling']['emis_no'][$key]);
                    $this->Base_Model->insert('student_sibilings', $data);
                }
            }
        }
        $this->Base_Model->delete('academic_info', array('student_id' => $primary_key, 'academic_year_id' => $academic_year_id));
        if (!empty($post_array['academic_info']['title'])) {
            foreach ($post_array['academic_info']['title'] as $key => $value) {
                $data = array("modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id'], "student_id" => $primary_key, "title" => $value, "description" => $post_array['academic_info']['description'][$key], 'academic_year_id' => $academic_year_id, 'grade_id' => $post_array['grade_id']);
                $this->Base_Model->insert('academic_info', $data);
            }
        }
        $this->Base_Model->delete('non_academic_info', array('student_id' => $primary_key, 'academic_year_id' => $academic_year_id));
        if (!empty($post_array['non_academic_info']['title'])) {
            foreach ($post_array['non_academic_info']['title'] as $key => $value) {
                $data = array("modified" => date('Y-m-d H:i:s'), 'user_id' => $_SESSION['id'], "student_id" => $primary_key, "title" => $value, "description" => $post_array['non_academic_info']['description'][$key], 'academic_year_id' => $academic_year_id, 'grade_id' => $post_array['grade_id']);
                $this->Base_Model->insert('non_academic_info', $data);
            }
        }
    }

    function details($primary_key) {
//        $fields = 's.id, s.name as Name, (CASE WHEN s.gender_id=1 THEN "Male" WHEN gender_id=0 THEN "Female"   ELSE "" END ) AS Gender,  date_format(s.dob, "%d-%m-%Y") as "Date Of Birth",
//s.mobile AS "Primary Mobile",s.profile_picture,s.cover_picture,s.is_active,s.address_line1 as "Address Line 1", address_line2 as "Address Line 2", city as City, state as State,
//pincode as Pincode, 
//adhaar_no AS "Aadhaar No", blood_group AS "Blood Group", height AS Height, weight AS Weight, ambition AS Ambition, 
//birth_place AS "Birth place", joining_date AS "Joining Date", joining_year AS "Joining Year", 
// mother_tounge AS "Mother Tounge", about AS About, father_name AS "Father Name", father_occupation  AS "Father Occupation", father_mobile  AS "Father Mobile", mother_name AS "Mother Name",
// mother_occupation as "Mother Occupation", mother_mobile as "Mother Mobile", emis_no, rollno,
//  father_qualification as "Father Qualification", mother_qualification as "Mother Qualification", si.badge AS Badge, si.humanity AS Humanity, native_place AS "Native Place", zodiac AS Zodiac, communication_language AS "Communication Language", caste AS Caste, vision AS Vision, health_condition AS "Health Condition", involvement AS Involvement, helping_tendency AS "Helping Tendencey", communication_with_friends AS "Communication With Friends", nationality AS "Nationality", si.languages_known as "Languages Known", birth_timing AS "Birth Time", s.created as "Created date and time"
//,color as "Favourite Colour", food as "Favourite Food", teacher as "Favourite Teacher", toy as "Favourite Toy", snacks  as "Favourite Snacks", 
//hobbies  as "Favourite Hobbies", outfit as "Favourite Outfit", places   as "Favourite Places", sports   as "Favourite Sports",
//vegetables   as "Favourite Vegetables", subjects as "Favourite Subjects" ';
        $fields = 'sd.school_name,sd.mobile as Mobile, sd.email as Email, sd.address as Address, c.city_name as "City", a.area_name as "Area", pincode as Pincode, af.affiliation_name as Affiliation,'
                . 'st.school_type as "School Type",(CASE WHEN sd.school_category_id=1 THEN "PLATINUM" WHEN sd.school_category_id=2 THEN "PREMIUM" WHEN sd.school_category_id=3 THEN "SPECTRUM" WHEN sd.school_category_id=4 THEN "TRIAL" ELSE "" END ) AS Package, sd.grade as Grade, sd.about as About, sd.website_url as Website,sd.map_url as Map, sd.year_of_establish as Establishment,'
                . 'sd.our_mission as Mission, sd.our_vision as Vision, sd.our_motto as Motto,  sd.ad as AD, sd.type as Type, (CASE WHEN sd.hostel=1 THEN "YES" WHEN sd.hostel=0 THEN "No"   ELSE "" END ) AS Hostel, '
                . 'sd.rte as "RTE Act.",sd.students as "No of Students", sd.boys as Boys, sd.girls as Girls, sd.teachers as Teachers, sd.facebook, sd.twitter, sd.instagram, sd.linkedin, sd.pinterest, '
                . '(CASE WHEN sd.is_active=1 THEN "YES" WHEN sd.is_active=0 THEN "No"   ELSE "" END ) AS Status , sd.view_count as Views,date_format( sd.activated_at, "%d-%m-%Y") as "Activated On", '
                . ' sd.valitity as Validity,  date_format( sd.created_at, "%d-%m-%Y") as "Created On"  '; 
        $join_tables[] = array(
            'table_name' => 'cities  c',
            'table_condition' => 'c.id = sd.city_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'areas  a',
            'table_condition' => 'a.id = sd.area_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'affiliations  af',
            'table_condition' => 'af.id = sd.affiliation_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'school_types  st',
            'table_condition' => 'st.id = sd.schooltype_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'school_categories  sc',
            'table_condition' => 'sc.id = sd.school_category_id',
            'table_type' => 'left'
        );

        $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 'sd.id', 'value' => base64_decode($primary_key));
//        $data['student'] = $this->Base_Model->getAdvanceList('students s ', $join_tables, $fields, $sub_where, array('return' => 'row_array'), 's.id');
        $data['school'] = $this->Base_Model->getAdvanceList('school_details sd ', $join_tables, $fields, $sub_where, array('return' => 'row_array'), 'sd.id');
        $where[] = array(TRUE, 'school_id', base64_decode($primary_key));
        $fields = array('*');
        $data['facilities'] = $this->Base_Model->get_records('school_facilities', array('*,(CASE WHEN is_active=1 THEN "YES" WHEN is_active=0 THEN "No"   ELSE "" END ) AS is_active'), $where, 'result_array', 'id', 'asc');
//        $data['non_academic_infos'] = $this->Base_Model->get_records('non_academic_info', $fields, $where, 'result_array', 'id', 'asc');
//        $data['student_siblings'] = $this->Base_Model->get_records('student_sibilings', $fields, $where, 'result_array', 'id', 'asc');

        $this->load->view('details', $data);
    }

    function institute_details($primary_key){
        $fields = 'in.institute_name,in.mobile as Mobile, in.email as Email, in.address as Address, c.city_name as "City", a.area_name as "Area", pincode as Pincode,'
                . 'ic.category_name as Catergory,(CASE WHEN in.position_id=1 THEN "PLATINUM" WHEN in.position_id=2 THEN "PREMIUM" WHEN in.position_id=3 THEN "SPECTRUM" WHEN in.position_id=4 THEN "TRIAL" ELSE "" END ) AS Package,in.about as About, in.website_url as Website,in.map_url as Map, in.year_of_establish as Establishment,'
                . 'in.facebook, in.twitter, in.instagram, in.linkedin, in.pinterest, '
                . '(CASE WHEN in.is_active=1 THEN "YES" WHEN in.is_active=0 THEN "No"   ELSE "" END ) AS Status , in.view_count as Views,date_format( in.activated_at, "%d-%m-%Y") as "Activated On", '
                . ' in.valitity as Validity,  date_format( in.created_at, "%d-%m-%Y") as "Created On"  '; 
        $join_tables[] = array(
            'table_name' => 'cities  c',
            'table_condition' => 'c.id = in.city_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'areas  a',
            'table_condition' => 'a.id = in.area_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'institute_categories  ic',
            'table_condition' => 'ic.id = in.category_id',
            'table_type' => 'left'
        );
        $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 'in.id', 'value' => base64_decode($primary_key));
        $data['institute'] = $this->Base_Model->getAdvanceList('institute_details in ', $join_tables, $fields, $sub_where, array('return' => 'row_array'), 'in.id');
        $where[] = array(TRUE, 'institute_id', base64_decode($primary_key));
        // print_r($data);exit;
        $fields = array('*');
        // $data['add_info'] = $this->Base_Model->get_records('institute_platinum_datas', array('*,(CASE WHEN is_active=1 THEN "YES" WHEN is_active=0 THEN "No"   ELSE "" END ) AS is_active'), $where, 'result_array', 'id', 'asc');
        // print_r($data['add_info']);exit;
        $this->load->view('activity_list', $data);
    }

    function image_upload() {
        $where[] = array(TRUE, 'is_active', 0);
        $fields = array('*');
        $data['grades'] = $this->Base_Model->get_records('grades', $fields, $where, 'result_array', 'id', 'asc');
        $this->load->view('image_upload', $data);
    }

    function name_list($id) {

        $post_array = $this->input->post();
        $table_records = "";
        $ord_by = 'ASC';
        $fields = "s.*,g.name as grade,(CASE WHEN gender_id=1 THEN 'Male' WHEN gender_id=0 THEN 'Female'   ELSE '' END ) as gender,date_format(dob, '%d-%m-%Y') as dob ";
        $join_tables[] = array(
            'table_name' => 'grades  g ',
            'table_condition' => 'g.id = s.grade_id',
            'table_type' => 'inner '
        );
        $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 's.is_active', 'value' => 0);
        if (!empty($id))
            $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 's.grade_id', 'value' => $id);
        $data['table_records'] = $this->Base_Model->getAdvanceList('students s ', $join_tables, $fields, $sub_where, array('return' => 'result_array'), 's.name', $ord_by);
        $data['formName'] = 'Student Image <small>Upload</small>';

        $this->load->view('student_list', $data);
    }

    function upload($id) {
        $id = base64_decode($id);
        $json = NULL;
        $config['upload_path'] = "appdata/students/" . $id;
        create_directory($config['upload_path']);
        $config['allowed_types'] = $this->allowed_types;
        $config['file_name'] = trim($_FILES[$this->file_name_field . '_multi_aploade' . $id]['name']);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($this->file_name_field . '_multi_aploade' . $id)) {
            $json['error_message'] = $this->upload->display_errors();
            $json['success'] = 'false';
        } else {
            $upload_error = true;
            $upload_data = $this->upload->data();
            $data_to_update = array('modified' => date('Y-m-d H:i:s'), 'profile_picture' => $upload_data['file_name']);
            $update_query = $this->db->update("students", $data_to_update, array("id" => $id));
            $json['success'] = 'true';
            $json['success_message'] = 'Image uploaded successfully';
            $json['file_name'] = $upload_data['file_name'];
        }
        echo json_encode($json);
        exit;
    }

    function image_delete() {
        $post_array = $this->input->post();
        $id = $post_array['id'];
        $field = $post_array['field'];
        $file_name = $post_array['file_name'];
        if (file_exists("appdata/students/" . $id . "/" . $file_name))
            unlink("appdata/students/" . $id . "/" . $file_name);
        $data_to_update = array('modified' => date('Y-m-d H:i:s'), $field => "");
        if ($this->db->update("students", $data_to_update, array("id" => $id)))
            $json = array('success' => true, 'success_message' => 'Image deleted successfully');
        else
            $json = array('success' => false, 'error_message' => 'There was an error occur');
        echo json_encode($json);
        exit;
    }

    function cover_upload($id) {

        $id = base64_decode($id);
        $json = NULL;
        $config['upload_path'] = "appdata/students/" . $id;
        create_directory($config['upload_path']);
        $config['allowed_types'] = $this->allowed_types;
        $config['file_name'] = trim($_FILES['cover_picture_upload' . $id]['name']);
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('cover_picture_upload' . $id)) {
            $json['error_message'] = $this->upload->display_errors();
            $json['success'] = 'false';
        } else {
            $upload_error = true;
            $upload_data = $this->upload->data();
            $data_to_update = array('modified' => date('Y-m-d H:i:s'), 'cover_picture' => $upload_data['file_name']);
            $update_query = $this->db->update("students", $data_to_update, array("id" => $id));
            $json['success'] = 'true';
            $json['success_message'] = 'Image uploaded successfully';
            $json['file_name'] = $upload_data['file_name'];
        }
        echo json_encode($json);
        exit;
    }

    function getStudentData($student_id) {
        $student = $this->Base_Model->get_record_by_id('students', '*', array("id" => $student_id));
        return $student;
    }

    function update_school(){

        //school facilities
        $facilityBulkInsert = array();$facilityBulkUpdate = array();
        foreach($_POST['facility'] as $key=>$faci){
            $image = "";
            if(!empty($_POST['facilityoldimage'][$key])){
                $image = $_POST['facilityoldimage'][$key];
                if(!empty($_FILES['facilityimage']['name'][$key])){
                    $facility2 = $_FILES['facilityimage']['name'][$key];
                    $facility2_ext = pathinfo($facility2, PATHINFO_EXTENSION);
        
                    $facility2_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility2_ext;
                    $facility2_type = $_FILES['facilityimage']['type'][$key];
                    $facility2_size = $_FILES['facilityimage']['size'][$key];
                    $facility2_tem_loc = $_FILES['facilityimage']['tmp_name'][$key];
                    $facility2_store = FCPATH . "/laravel/public/" . $facility2_name;
                    $allowed = array('gif', 'png', 'jpg', 'jpeg');
                    if (in_array($facility2_ext, $allowed)) {
                        if (move_uploaded_file($facility2_tem_loc, $facility2_store)) {
                            $image = $facility2_name;
                        }
                    }               
                }
            }else if(!empty($_FILES['facilityimage']['name'][$key])){
                if(!empty($_FILES['facilityimage']['name'][$key])){
                    $facility2 = $_FILES['facilityimage']['name'][$key];
                    $facility2_ext = pathinfo($facility2, PATHINFO_EXTENSION);
        
                    $facility2_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility2_ext;
                    $facility2_type = $_FILES['facilityimage']['type'][$key];
                    $facility2_size = $_FILES['facilityimage']['size'][$key];
                    $facility2_tem_loc = $_FILES['facilityimage']['tmp_name'][$key];
                    $facility2_store = FCPATH . "/laravel/public/" . $facility2_name;
                    $allowed = array('gif', 'png', 'jpg', 'jpeg');
                    if (in_array($facility2_ext, $allowed)) {
                        if (move_uploaded_file($facility2_tem_loc, $facility2_store)) {
                            $image = $facility2_name;
                        }
                    }               
                }
            }

            if($_POST['facilityid'][$key]){
                $facilityBulkUpdate[] = array(
                    'facility'=>$_POST['facility'][$key],
                    'content'=>$_POST['facilitydesc'][$key],
                    'image'=>$image,
                    'is_active'=>1,
                    'id'=>$_POST['facilityid'][$key],
                );
            }else{
                $facilityBulkInsert[] = array(
                    'facility'=>$_POST['facility'][$key],
                    'content'=>$_POST['facilitydesc'][$key],
                    'image'=>$image,
                    'is_active'=>1,
                    'school_id'=>$_POST['school_id'],
                );
            }
            
        }
        if(!empty($facilityBulkUpdate)){
            $this->db->update_batch('school_facilities',$facilityBulkUpdate, 'id');
        }
        else if(!empty($facilityBulkInsert)){
            $this->db->insert_batch('school_facilities', $facilityBulkInsert); 
        }
       
        
        $school_id=$_POST['school_id'];
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

        if (isset($_POST['customRadio1'])) {
            $customRadio1 = $_POST['customRadio1'];
        } else {
            $customRadio1 = NULL;
        }

        if (isset($_POST['customRadio2'])) {
            $customRadio2 = $_POST['customRadio2'];
        } else {
            $customRadio2 = NULL;
        }

        // school activities
        $this->db->select('id,activity_name');
        $old_school_activity = $this->db->get('school_activities')->result_array();
        // print_r($old_school_activity);exit;
        $old_school_activity_array=array();
        foreach($old_school_activity as $old_school_act){
            $old_school_activity_array[$old_school_act['activity_name']] = $old_school_act['id'];
        }
        // print_r($old_school_activity_array);exit;
        $act = $_POST['activity']; $activity_ids = $_POST['activityid'];$image_id = $_POST['activityimage_id'];

        $insertschoolactivityinsert = array();$schoolactivityUpdate = array();
        
        if (is_array($act)) {
            foreach($act as $key=>$activity) {

                if(!empty($old_school_activity_array[$_POST['activity'][$key]])){
                    $scID = $old_school_activity_array[$_POST['activity'][$key]];
                }else{
                    $this->db->insert('school_activities',array('activity_name'=>$_POST['activity'][$key]));
                    $scID = $this->db->insert_id();;

                }

                
                if(!empty($activityimage = $_FILES['activityimage']['name'][$key])){
                    $activitytype = $_FILES['activityimage']['type'][$key];
                    $activitysize = $_FILES['activityimage']['size'][$key];
                    $activitytmp_name = $_FILES['activityimage']['tmp_name'][$key];

                    $activity1 = $activityimage[$key];
                    $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                    $activity1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                    $activity1_type = $activitytype[$key];
                    $activity1_size = $activitysize[$key];
                    $activity1_tem_loc = $activitytmp_name[$key];
                    $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');

                    if (in_array($activity1_ext, $allowed)) {
                        if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {
                            $image = $activity1_name;
                            
                        }
                    }
                }else{
                    $image = $_POST['activityoldimage'][$key];
                }

                if(!empty($_POST['activityid'][$key])){
                    $schoolactivityUpdate[] = array(
                        'id' => $image_id_data,
                        'school_activity_id' => $scID,
                        'images' => $image,
                        'is_active' => 1
                    );
                }else{
                    $insertschoolactivityinsert[] = array(
                        'school_id' => $school_id,
                        'school_activity_id' => $scID,
                        'images' => $image,
                        'is_active' => 1
                    );
                }

            }
        }
        if(!empty($schoolactivityUpdate)){
            $this->db->update_batch('school_images', $schoolactivityUpdate,'id');
        }
        if(!empty($insertschoolactivityinsert)){
            $this->db->insert_batch('school_images', $insertschoolactivityinsert);
        }
        //platinum data save

        $this->db->select('*');
        $this->db->where('heading','Founded');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $found = $this->db->get();
        if($found->num_rows() > 0){
            if (!empty($_POST['founded'])) {
                $foundedinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'founded.png',
                    'content' => $_POST['founded'],
                    'brief_content' => $_POST['founded'],
                    'is_active' => 1
                );
                $this->db->where('heading','Founded');
                $this->db->update('platinum_datas', $foundedinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{

            $foundednewinsert = array(
                'school_id' => $school_id,
                'icon' => 'founded.png',
                'heading' => 'Founded',
                'content' => $_POST['founded'],
                'brief_content' => $_POST['founded'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $foundednewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Special');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $special = $this->db->get();
        if($special->num_rows() > 0){
            if (!empty($_POST['special'])) {
                $specialinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'special.png',
                    // 'heading' => 'Special',
                    'content' => $_POST['special'],
                    'brief_content' => $_POST['special'],
                    'is_active' => 1
                );
                $this->db->where('heading','Special');
                $this->db->update('platinum_datas', $specialinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $specialnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'special.png',
                'heading' => 'Special',
                'content' => $_POST['special'],
                'brief_content' => $_POST['special'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $specialnewinsert);

        }

        $this->db->select('*');
        $this->db->where('heading','Students');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Students = $this->db->get();
        if($Students->num_rows() > 0){
            if (!empty($_POST['students'])) {
                $studentsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'students.png',
                    // 'heading' => 'Students',
                    'content' => $_POST['students'],
                    'brief_content' => $_POST['students'],
                    'is_active' => 1
                );
                $this->db->where('heading','Students');
                $this->db->update('platinum_datas', $studentsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $studentsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'students.png',
                'heading' => 'Students',
                'content' => $_POST['students'],
                'brief_content' => $_POST['students'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $studentsnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Events');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Events = $this->db->get();
        if($Students->num_rows() > 0){
            if (!empty($_POST['events'])) {
                $eventsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'Events.png',
                    // 'heading' => 'Events',
                    'content' => $_POST['events'],
                    'brief_content' => $_POST['events'],
                    'is_active' => 1
                );
                $this->db->where('heading','Events');
                $this->db->update('platinum_datas', $eventsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $eventsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'Events.png',
                'heading' => 'Events',
                'content' => $_POST['events'],
                'brief_content' => $_POST['events'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $eventsnewinsert);
        }
        $this->db->select('*');
        $this->db->where('heading','Achievements');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Achievements = $this->db->get();
        if($Achievements->num_rows() > 0){
            if (!empty($_POST['achievements'])) {
                $achievementsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'achievements.png',
                    // 'heading' => 'Achievements',
                    'content' => $_POST['achievements'],
                    'brief_content' => $_POST['achievements'],
                    'is_active' => 1
                );
                $this->db->where('heading','Achievements');
                $this->db->update('platinum_datas', $achievementsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $achievementsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'achievements.png',
                'heading' => 'Achievements',
                'content' => $_POST['achievements'],
                'brief_content' => $_POST['achievements'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $achievementsnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Teachers');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Teachers = $this->db->get();
        if($Teachers->num_rows() > 0){
            if (!empty($_POST['teachers'])) {
                $teachersinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'teachers.png',
                    // 'heading' => 'Teachers',
                    'content' => $_POST['teachers'],
                    'brief_content' => $_POST['teachers'],
                    'is_active' => 1
                );
                $this->db->where('heading','Teachers');
                $this->db->update('platinum_datas', $teachersinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $teachersnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'teachers.png',
                'heading' => 'Teachers',
                'content' => $_POST['teachers'],
                'brief_content' => $_POST['teachers'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $teachersnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Branches');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Branches = $this->db->get();
        if($Branches->num_rows() > 0){
            if (!empty($_POST['branches'])) {
                $branchesinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'branch.png',
                    // 'heading' => 'Branches',
                    'content' => $_POST['branches'],
                    'brief_content' => $_POST['branches'],
                    'is_active' => 1
                );
                $this->db->where('heading','Branches');
                $this->db->update('platinum_datas', $branchesinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $branchesnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'branch.png',
                'heading' => 'Branches',
                'content' => $_POST['branches'],
                'brief_content' => $_POST['branches'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $branchesnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Academic');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Academic = $this->db->get();
        if($Academic->num_rows() > 0){
            if (!empty($_POST['academic'])) {
                $academicinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'history.png',
                    // 'heading' => 'Academic',
                    'content' => $_POST['academic'],
                    'brief_content' => $_POST['academic'],
                    'is_active' => 1
                );
                $this->db->where('heading','Academic');
                $this->db->update('platinum_datas', $academicinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $academicnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'history.png',
                'heading' => 'Academic',
                'content' => $_POST['academic'],
                'brief_content' => $_POST['academic'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $academicnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Language');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $Language = $this->db->get();
        if($Language->num_rows() > 0){
            if (!empty($_POST['language'])) {
                $languageinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'language.png',
                    // 'heading' => 'Language',
                    'content' => $_POST['language'],
                    'brief_content' => $_POST['language'],
                    'is_active' => 1
                );
                $this->db->where('heading','Language');
                $this->db->update('platinum_datas', $languageinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $languagenewinsert = array(
                'school_id' => $school_id,
                'icon' => 'language.png',
                'heading' => 'Language',
                'content' => $_POST['language'],
                'brief_content' => $_POST['language'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $languagenewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','activity');
        $this->db->where('school_id',$school_id);
        $this->db->from('platinum_datas');
        $activity = $this->db->get();
        if($activity->num_rows() > 0){
            if (!empty($_POST['activity1'])) {
                $activityinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'activity.png',
                    // 'heading' => 'activity',
                    'content' => $_POST['activity1'],
                    'brief_content' => $_POST['activity1'],
                    'is_active' => 1
                );
                $this->db->where('heading','activity');
                $this->db->update('platinum_datas', $activityinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $activitynewinsert = array(
                'school_id' => $school_id,
                'icon' => 'activity.png',
                'heading' => 'activity',
                'content' => $_POST['activity1'],
                'brief_content' => $_POST['activity1'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $activitynewinsert);
        }

        // banner1 image save
        if (isset($_FILES['banner1']['name'])) {
            $banner1 = $_FILES['banner1']['name'];
            $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);

            $banner1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            $banner1_type = $_FILES['banner1']['type'];
            $banner1_size = $_FILES['banner1']['size'];
            $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
            $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner1_ext, $allowed)) {

                if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {

                    $banner1insert = array(
                        // 'school_id' => $school_id,
                        'school_activity_id' => 2,
                        'images' => $banner1_name,
                        'is_active' => 1
                    );

                    $this->db->update('school_images', $banner1insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }


        if (isset($_FILES['banner2']['name'])) {
            $banner2 = $_FILES['banner2']['name'];
            $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

            $banner2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
            $banner2_type = $_FILES['banner2']['type'];
            $banner2_size = $_FILES['banner2']['size'];
            $banner2_tem_loc = $_FILES['banner2']['tmp_name'];
            $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner2_ext, $allowed)) {
                if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                    $banner2insert = array(
                        // 'school_id' => $school_id,
                        'school_activity_id' => 2,
                        'images' => $banner2_name,
                        'is_active' => 1
                    );

                    $this->db->update('school_images', $banner2insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }

        // banner3 image save
        if (isset($_FILES['banner3']['name'])) {
            $banner3 = $_FILES['banner3']['name'];
            $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

            $banner3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
            $banner3_type = $_FILES['banner3']['type'];
            $banner3_size = $_FILES['banner3']['size'];
            $banner3_tem_loc = $_FILES['banner3']['tmp_name'];
            $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner3_ext, $allowed)) {
                if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                    $banner3insert = array(
                        // 'school_id' => $school_id,
                        'school_activity_id' => 2,
                        'images' => $banner3_name,
                        'is_active' => 1
                    );

                    $this->db->update('school_images', $banner3insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }

        // aboutimg1 image save
        if (isset($_FILES['aboutimg1']['name'])) {
            $aboutimg1 = $_FILES['aboutimg1']['name'];
            $aboutimg1_ext = pathinfo($aboutimg1, PATHINFO_EXTENSION);

            $aboutimg1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $aboutimg1_ext;
            $aboutimg1_type = $_FILES['aboutimg1']['type'];
            $aboutimg1_size = $_FILES['aboutimg1']['size'];
            $aboutimg1_tem_loc = $_FILES['aboutimg1']['tmp_name'];
            $aboutimg1_store = FCPATH . "/laravel/public/" . $aboutimg1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($aboutimg1_ext, $allowed)) {
                if (move_uploaded_file($aboutimg1_tem_loc, $aboutimg1_store)) {
                    $aboutimg1insert = array(
                        // 'school_id' => $school_id,
                        'school_activity_id' => 1,
                        'images' => $aboutimg1_name,
                        'is_active' => 1
                    );

                    $this->db->update('school_images', $aboutimg1insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }

        // aboutimg2 image save
        if (isset($_FILES['aboutimg2']['name'])) {
            $aboutimg2 = $_FILES['aboutimg2']['name'];
            $aboutimg2_ext = pathinfo($aboutimg2, PATHINFO_EXTENSION);

            $aboutimg2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $aboutimg2_ext;
            $aboutimg2_type = $_FILES['aboutimg2']['type'];
            $aboutimg2_size = $_FILES['aboutimg2']['size'];
            $aboutimg2_tem_loc = $_FILES['aboutimg2']['tmp_name'];
            $aboutimg2_store = FCPATH . "/laravel/public/" . $aboutimg2_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($aboutimg2_ext, $allowed)) {
                if (move_uploaded_file($aboutimg2_tem_loc, $aboutimg2_store)) {
                    $aboutimg2insert = array(
                        // 'school_id' => $school_id,
                        'school_activity_id' => 1,
                        'images' => $aboutimg2_name,
                        'is_active' => 1
                    );

                    $this->db->update('school_images', $aboutimg2insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }

        //school details update
         
        $school_update=array(
            'school_name' => $_POST['schoolname'],
            'slug' => $_POST['schoolname'],
            'mobile' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'city_id' => $yourcity_id,
            'area_id' => $area_id,
            'affiliation_id' => $schoolboard_id,
            'schooltype_id' => $level_id,
            'about' => $_POST['description'],
            'acadamic' => $_POST['academic'],
            'type' =>$_POST['schooltype'],
            'website_url' => $_POST['website'],
            'map_url' => $_POST['map_url'],
            'year_of_establish' => $_POST['founded'],
            'ad' => $_POST['ad'],
            'hostel' => $customRadio1,
            'rte' => $customRadio2,
            'students' => $_POST['students'],
            'boys' => $_POST['boys'],
            'girls' => $_POST['girls'],
            'our_mission' => $_POST['our_mission'],
            'our_vision' => $_POST['our_vision'],
            'our_motto' => $_POST['our_motto'],
            'teachers' => $_POST['teachers'],
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'instagram' => $_POST['instagram'],
            'linkedin' => $_POST['linkedin'],
            'pinterest' => $_POST['pinterest'],
            'logo' => $banner1_name,
            'is_active' => 1,
        );
        $this->db->update('school_details',$school_update,array('id'=>$_POST['school_id']));
        redirect('admin/schools');

    }

    function view_activityclass(){
        $data = array();
        $userid = base64_decode($_GET['id']);
        $this->db->select('*');
        $this->db->where('id',$userid);
        $this->db->from('institute_details');
        $data['institute'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('institute_categories');
        $this->db->where('id', $data['institute'][0]['category_id']);
        $data['categories'] = $this->db->get()->result_array();

        $this->db->select('*')->where('id',$data['institute'][0]['city_id']);
        $this->db->from('cities');
        $data['city1'] = $this->db->get()->result_array();

        $this->db->select('*')->where('id', $data['institute'][0]['area_id']);
        $this->db->from('areas');
        $data['area'] = $this->db->get()->result_array();
        //platinum datas
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Founded');
        $this->db->from('institute_platinum_datas');
        $data['founded'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Special');
        $this->db->from('institute_platinum_datas');
        $data['special'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Students');
        $this->db->from('institute_platinum_datas');
        $data['students'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Events');
        $this->db->from('institute_platinum_datas');
        $data['events'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Achievements');
        $this->db->from('institute_platinum_datas');
        $data['achievements'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Teachers');
        $this->db->from('institute_platinum_datas');
        $data['teachers'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Branches');
        $this->db->from('institute_platinum_datas');
        $data['branches'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Language');
        $this->db->from('institute_platinum_datas');
        $data['language'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Trainer');
        $this->db->from('institute_platinum_datas');
        $data['trainer'] = $this->db->get()->result_array();
        $this->db->select('*')->where('id=',$userid);
        $this->db->from('institute_details');
        $institute = $this->db->get()->result_array();
        //institute news
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->from('institute_news');
        $data['news'] = $this->db->get()->result_array();
        $this->db->select('pd.id,pd.program_id,ip.program_name,pd.image,pd.about');
        $this->db->where('pd.institute_id', $data['institute'][0]['id']);
        $this->db->join('program_details as pd','pd.program_id = ip.id','left');
        $this->db->from('institute_programs as ip');
        $data['inst_category']=$this->db->get()->result_array();
        $this->load->view('view_activity_platinum',$data);
    }

    function view_school(){
        $userid=base64_decode($_GET['id']);
        // print_r($userid);exit;
        $this->db->select('*')->where('id',$userid);
        $this->db->from('school_details');
        $school = $this->db->get()->result_array();
        // if($school[0]['school_category_id'] == 1){
            $this->load->view('view_school_platinum');
        // }else if($school[0]['school_category_id'] == 3 || $school[0]['school_category_id'] == 4){
            // $this->load->view('view_school_spectrum');
        // }
        // else if($school[0]['school_category_id'] == 2){
        //     $this->load->view('view_school_premium');
        // }
    }

    function institute_edit(){
        $data = array();
        $userid = base64_decode($_GET['id']);
        $this->db->select('*');
        $this->db->where('id',$userid);
        $this->db->from('institute_details');
        $data['institute'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('institute_categories');
        $this->db->where('id', $data['institute'][0]['category_id']);
        $data['categories'] = $this->db->get()->result_array();

        $this->db->select('*')->where('id',$data['institute'][0]['city_id']);
        $this->db->from('cities');
        $data['city1'] = $this->db->get()->result_array();

        $this->db->select('*')->where('id', $data['institute'][0]['area_id']);
        $this->db->from('areas');
        $data['area'] = $this->db->get()->result_array();
        //platinum datas
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Founded');
        $this->db->from('institute_platinum_datas');
        $data['founded'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Special');
        $this->db->from('institute_platinum_datas');
        $data['special'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Students');
        $this->db->from('institute_platinum_datas');
        $data['students'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Events');
        $this->db->from('institute_platinum_datas');
        $data['events'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Achievements');
        $this->db->from('institute_platinum_datas');
        $data['achievements'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Teachers');
        $this->db->from('institute_platinum_datas');
        $data['teachers'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Branches');
        $this->db->from('institute_platinum_datas');
        $data['branches'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Language');
        $this->db->from('institute_platinum_datas');
        $data['language'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->where('heading','Trainer');
        $this->db->from('institute_platinum_datas');
        $data['trainer'] = $this->db->get()->result_array();
        $this->db->select('*')->where('id=',$userid);
        $this->db->from('institute_details');
        $institute = $this->db->get()->result_array();
        //institute news
        $this->db->select('*');
        $this->db->where('institute_id',$data['institute'][0]['id']);
        $this->db->from('institute_news');
        $data['news'] = $this->db->get()->result_array();
        $this->db->select('pd.id,pd.program_id,ip.program_name,pd.image,pd.about');
        $this->db->where('pd.institute_id', $data['institute'][0]['id']);
        $this->db->join('program_details as pd','pd.program_id = ip.id','left');
        $this->db->from('institute_programs as ip');
        $data['inst_category']=$this->db->get()->result_array();
        // echo "<pre>";print_r($data['inst_category']);exit;
        // if($institute[0]['position_id'] == 1){
            $this->load->view('edit_activity_platinum',$data);
        // }else if($institute[0]['position_id'] == 3 || $institute[0]['position_id'] == 4){
        //     $this->load->view('edit_activity_spectrum',$data);
        // }
        // else if($institute[0]['position_id'] == 2){
        //     $this->load->view('edit_activity_premium',$data);
        // }
    }

    function school_edit(){
        
        $userid=base64_decode($_GET['id']);
        $this->db->select('*')->where('id=',$userid);
        $this->db->from('school_details');
        $school = $this->db->get()->result_array();
        // if($school[0]['school_category_id'] == 1){
            $this->load->view('edit_school_platinum');
        // }else if($school[0]['school_category_id'] == 3 || $school[0]['school_category_id'] == 4){
        //     $this->load->view('edit_school_spectrum');
        // }
        // else if($school[0]['school_category_id'] == 2){
        //     $this->load->view('edit_school_premium');
        // }
    }

    function school_delete(){

        $userid = base64_decode($_GET['id']);
        $this->db->where('schooldetails_id', $userid);
        $this->db->delete('schoolmanagement_activities');
        $this->db->where('school_id', $userid);
        $this->db->delete('platinum_datas');
        $this->db->where('school_id', $userid);
        $this->db->delete('school_images');
        $this->db->where('school_id', $userid);
        $this->db->delete('school_facilities');
        $this->db->where('id', $userid);
        $this->db->delete('school_details');
        redirect('admin/schools');

    } 

    function institute_delete(){
        
        $userid = base64_decode($_GET['id']);
        $this->db->where('institute_id', $userid);
        $this->db->delete('institute_images');
        $this->db->where('institute_id', $userid);
        $this->db->delete('institute_admissions');
        $this->db->where('institute_id', $userid);
        $this->db->delete('institute_platinum_datas');
        $this->db->where('institute_id', $userid);
        $this->db->delete('program_details');
        $this->db->where('institute_id', $userid);
        $this->db->delete('institute_news');
        $this->db->where('id', $userid);
        $this->db->delete('institute_details');
        redirect('admin/schools/institute');
    }

    function update_activity(){
        $school_id = $_POST['school_id'];
        $this->db->select('*')->where('city_name =', $_POST['city']);
        $this->db->from('cities');
        $yourcityarray = $this->db->get();


        if ($yourcityarray->num_rows() > 0) {
            foreach ($yourcityarray->result() as $yourcitys) {
                $yourcity_id = $yourcitys->id;
            }
        } else {
            $cityinsert = array(
                'city_name' => $_POST['city'],
                'slug' => $_POST['city'],
                'state_id' => 2,
                'is_active' => 1
            );
            $this->db->insert('cities', $cityinsert);

            $this->db->select('*')->where('city_name =', $_POST['city']);
            $this->db->from('cities');
            $yourcityarray = $this->db->get();
            foreach ($yourcityarray->result() as $yourcitys) {
                $yourcity_id = $yourcitys->id;
            }
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
                //exit();
            }
        }

        $this->db->select('*')->where('category_name =', $_POST['type']);
        $this->db->from('institute_categories');
        $level = $this->db->get();
        foreach ($level->result() as $levels) {
            $category_id = $levels->id;
        }

        //platinum data save
// print_r($_POST['founded']);exit;
        $this->db->select('*');
        $this->db->where('heading','Founded');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $found = $this->db->get();
        if($found->num_rows() > 0){
            if (!empty($_POST['founded'])) {
                $foundedinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'founded.png',
                    'content' => $_POST['founded'],
                    'brief_content' => $_POST['founded'],
                    'is_active' => 1
                );
                $this->db->where('heading','Founded');
                $this->db->update('institute_platinum_datas', $foundedinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{

            $foundednewinsert = array(
                'school_id' => $school_id,
                'icon' => 'founded.png',
                'heading' => 'Founded',
                'content' => $_POST['founded'],
                'brief_content' => $_POST['founded'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $foundednewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Special');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $special = $this->db->get();
        if($special->num_rows() > 0){
            if (!empty($_POST['special'])) {
                $specialinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'special.png',
                    // 'heading' => 'Special',
                    'content' => $_POST['special'],
                    'brief_content' => $_POST['special'],
                    'is_active' => 1
                );
                $this->db->where('heading','Special');
                $this->db->update('institute_platinum_datas', $specialinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $specialnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'special.png',
                'heading' => 'Special',
                'content' => $_POST['special'],
                'brief_content' => $_POST['special'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $specialnewinsert);

        }

        $this->db->select('*');
        $this->db->where('heading','Students');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Students = $this->db->get();
        if($Students->num_rows() > 0){
            if (!empty($_POST['students'])) {
                $studentsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'students.png',
                    // 'heading' => 'Students',
                    'content' => $_POST['students'],
                    'brief_content' => $_POST['students'],
                    'is_active' => 1
                );
                $this->db->where('heading','Students');
                $this->db->update('institute_platinum_datas', $studentsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $studentsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'students.png',
                'heading' => 'Students',
                'content' => $_POST['students'],
                'brief_content' => $_POST['students'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $studentsnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Events');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Events = $this->db->get();
        if($Students->num_rows() > 0){
            if (!empty($_POST['events'])) {
                $eventsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'Events.png',
                    // 'heading' => 'Events',
                    'content' => $_POST['events'],
                    'brief_content' => $_POST['events'],
                    'is_active' => 1
                );
                $this->db->where('heading','Events');
                $this->db->update('institute_platinum_datas', $eventsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $eventsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'Events.png',
                'heading' => 'Events',
                'content' => $_POST['events'],
                'brief_content' => $_POST['events'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $eventsnewinsert);
        }
        $this->db->select('*');
        $this->db->where('heading','Achievements');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Achievements = $this->db->get();
        if($Achievements->num_rows() > 0){
            if (!empty($_POST['achievements'])) {
                $achievementsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'achievements.png',
                    // 'heading' => 'Achievements',
                    'content' => $_POST['achievements'],
                    'brief_content' => $_POST['achievements'],
                    'is_active' => 1
                );
                $this->db->where('heading','Achievements');
                $this->db->update('institute_platinum_datas', $achievementsinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $achievementsnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'achievements.png',
                'heading' => 'Achievements',
                'content' => $_POST['achievements'],
                'brief_content' => $_POST['achievements'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $achievementsnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Teachers');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Teachers = $this->db->get();
        if($Teachers->num_rows() > 0){
            if (!empty($_POST['teachers'])) {
                $teachersinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'teachers.png',
                    // 'heading' => 'Teachers',
                    'content' => $_POST['teachers'],
                    'brief_content' => $_POST['teachers'],
                    'is_active' => 1
                );
                $this->db->where('heading','Teachers');
                $this->db->update('institute_platinum_datas', $teachersinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $teachersnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'teachers.png',
                'heading' => 'Teachers',
                'content' => $_POST['teachers'],
                'brief_content' => $_POST['teachers'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $teachersnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Branches');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Branches = $this->db->get();
        if($Branches->num_rows() > 0){
            if (!empty($_POST['branches'])) {
                $branchesinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'branch.png',
                    // 'heading' => 'Branches',
                    'content' => $_POST['branches'],
                    'brief_content' => $_POST['branches'],
                    'is_active' => 1
                );
                $this->db->where('heading','Branches');
                $this->db->update('institute_platinum_datas', $branchesinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $branchesnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'branch.png',
                'heading' => 'Branches',
                'content' => $_POST['branches'],
                'brief_content' => $_POST['branches'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $branchesnewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Language');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Language = $this->db->get();
        if($Language->num_rows() > 0){
            if (!empty($_POST['language'])) {
                $languageinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'language.png',
                    // 'heading' => 'Language',
                    'content' => $_POST['language'],
                    'brief_content' => $_POST['language'],
                    'is_active' => 1
                );
                $this->db->where('heading','Language');
                $this->db->update('institute_platinum_datas', $languageinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $languagenewinsert = array(
                'school_id' => $school_id,
                'icon' => 'language.png',
                'heading' => 'Language',
                'content' => $_POST['language'],
                'brief_content' => $_POST['language'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $languagenewinsert);
        }

        $this->db->select('*');
        $this->db->where('heading','Trainer');
        $this->db->where('institute_id',$school_id);
        $this->db->from('institute_platinum_datas');
        $Trainer = $this->db->get();
        if($Trainer->num_rows() > 0){
            if (!empty($_POST['customRadioInline1'])) {
                $academicinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'history.png',
                    // 'heading' => 'Academic',
                    'content' => $_POST['customRadioInline1'],
                    'brief_content' => $_POST['customRadioInline1'],
                    'is_active' => 1
                );
                $this->db->where('heading','Academic');
                $this->db->update('institute_platinum_datas', $academicinsert,array('school_id'=>$_POST['school_id']));
            }
        }else{
            $academicnewinsert = array(
                'school_id' => $school_id,
                'icon' => 'history.png',
                'heading' => 'Academic',
                'content' => $_POST['customRadioInline1'],
                'brief_content' => $_POST['customRadioInline1'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $academicnewinsert);
        }
// print_r($_POST['program_id']);exit;
        // $category = $_POST['categoryname'];
        // $categorydesc = $_POST['categorydesc'];
        // $categoryupdate = array();$categoryinsert = array();
        // foreach($_POST['categoryname'] as $key=>$category){
        //    $program_id= $_POST['program_id'][$key];
        // //    print_r($program_id);
        //     if(isset($program_id)){
        //         $this->db->select('*');
        //         $this->db->where('id',$program_id);
        //         $this->db->from('institute_news');
        //         $program = $this->db->get()->result_array();
        //         if($program->num_rows() > 0){


        //             $this->db->select('*')->where('program_name', $category]);
        //                 $this->db->from('institute_programs');
        //                 $schoolactivity1 = $this->db->get();

        //                 if ($schoolactivity1->num_rows() > 0) {
        //                     foreach ($schoolactivity1->result() as $schoolactivitys1) {
        //                         $schoolactivity_id1 = $schoolactivitys1->id;
        //                     }
        //                 } else {
        //                     $schoolactivityinsert1 = array(
        //                         'program_name' => $category
        //                     );

        //                     $this->db->insert('institute_programs', $schoolactivityinsert1);

        //                     $this->db->select('*')->where('program_name', $category);
        //                     $this->db->from('institute_programs');
        //                     $schoolactivity1 = $this->db->get();

        //                     foreach ($schoolactivity1->result() as $schoolactivitys1) {
        //                         $schoolactivity_id1 = $schoolactivitys1->id;
        //                     }
        //                 }


        //             $categoryupdate[] = array(
        //                 $schoolactivityinsert1 = array(
        //                     'institute_id' => $school_id,
        //                     'program_id' => $schoolactivity_id1,
        //                     'image' => $activity1_name,
        //                     'about' => $activitydesc[$i],
        //                     'is_active' => 1,
        //                     'id' => $program_id
        //                 );
        //             );
        //         } else{
        //             $schoolactivityinsert1 = array(
        //                 'institute_id' => $school_id,
        //                 'program_id' => $schoolactivity_id1,
        //                 'image' => $activity1_name,
        //                 'about' => $activitydesc[$i],
        //                 'is_active' => 1
        //             );
        //         }    
        //     }else{
        //         $schoolactivityinsert1 = array(
        //             'institute_id' => $school_id,
        //             'program_id' => $schoolactivity_id1,
        //             'image' => $activity1_name,
        //             'about' => $activitydesc[$i],
        //             'is_active' => 1
        //         );
        //     }    
        // }
        // if(!empty($newsinsert)){
        //     $this->db->insert_batch('institute_news', $newsinsert);
        // }
        // if(!empty($newsupdate)){
        //     $this->db->update_batch('institute_news',$newsupdate,'id');
        // }

        //news heading
        $news = $_POST['newsheading'];
        $newsdesc = $_POST['newsdesc'];
        $newsupdate = array();$newsinsert = array();
        foreach($_POST['newsheading'] as $key=>$newsid1){
           $newsid= $_POST['news_id'][$key];
            if(isset($newsid)){
                $this->db->select('*');
                $this->db->where('id',$newsid);
                $this->db->from('institute_news');
                $news_heading = $this->db->get();
                    $newsupdate[] = array(
                        'institute_id' => $school_id,
                        'news' => $news[$key],
                        'news_brief' => $newsdesc[$key],
                        'is_active' => 1,
                        'id' => $newsid
                    );
                 
            }else{
                $newsinsert[] = array(
                    'institute_id' => $school_id,
                    'news' => $news[$key],
                    'news_brief' => $newsdesc[$key],
                    'is_active' => 1
                );
            }    
        }
        if(!empty($newsinsert)){
            $this->db->insert_batch('institute_news', $newsinsert);
        }
        if(!empty($newsupdate)){
            $this->db->update_batch('institute_news',$newsupdate,'id');
        }

        $schoolupdate = array(
            'category_id' => $category_id,
            // 'position_id' => 1,
            'institute_name' => $_POST['institutename'],
            'slug' => $_POST['institutename'],
            'mobile' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'user_id' => $_POST['user_id'],
            'proprietor_image' => $aboutimage_name,
            'city_id' => $yourcity_id,
            'area_id' => $area_id,
            'about' => $_POST['aboutdesc'],
            'year_of_establish' => $_POST['founded'],
            'branches' => $_POST['branches'],
            // 'ad'=>$_POST['ad'],
            'specials' => $_POST['special'],
            'website_url' => $_POST['website'],
            'timings' => $_POST['timing'],
            'logo' => $banner1_name,
            'news_image' => $newsbanner1_name,
            'activated_at' => date('Y-m-d H:i:s'),
            'is_active' => 1,
            // 'valitity'=>100
        );
        $this->db->update('institute_details',$schoolupdate,array('id'=>$school_id));
        redirect('admin/schools/institute');
    }
}
?>