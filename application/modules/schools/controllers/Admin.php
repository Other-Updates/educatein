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
        $act = $_POST['facility']; $activity_ids = $_POST['facilityid'];
        $facilityinsert = array();$facilityUpdate = array();

        $this->db->select('*')->where('id',$_POST['school_id']);
        $this->db->from('school_details');
        $school = $this->db->get()->result_array();
        if (is_array($act)) {
            foreach($act as $key=>$facility) {

                // if(!isset($facility) && isset($_POST['facilityid'][$key])){
                //     $this->db->where('id',$_POST['facilityid'][$key]);
                //     $this->db->delete('school_facilities');
                // }

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
                else{
                    $image = $_POST['facilityoldimage'][$key];
                }

                if(!empty($_POST['facilityid'][$key])){
                    $facilityUpdate[] = array(
                        'facility'=>$_POST['facility'][$key],
                        'content'=>$_POST['facilitydesc'][$key],
                        'image'=>$image,
                        'is_active'=>1,
                        'id'=>$_POST['facilityid'][$key],
                    );
                }else{
                    $facilityinsert[] = array(
                        'facility'=>$_POST['facility'][$key],
                        'content'=>$_POST['facilitydesc'][$key],
                        'image'=>$image,
                        'is_active'=>1,
                        'school_id'=>$_POST['school_id'],
                    );
                }
            }

        }
        if(!empty($facilityUpdate)){
            $this->db->update_batch('school_facilities',$facilityUpdate, 'id');
        }
        if(!empty($facilityinsert)){
            $this->db->insert_batch('school_facilities', $facilityinsert); 
            

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

        $this->db->select('id,activity_name');
        $old_school_activity = $this->db->get('school_activities')->result_array();
        $old_school_activity_array=array();
        foreach($old_school_activity as $old_school_act){
            $old_school_activity_array[$old_school_act['activity_name']] = $old_school_act['id'];
        }
        $act = $_POST['activity']; $activity_ids = $_POST['activityid'];
        $insertschoolactivityinsert = array();$schoolactivityUpdate = array();
        if (is_array($act)) {
            foreach($act as $key=>$activity) {
                if(!empty($old_school_activity_array[$_POST['activity'][$key]])){
                    $scID = $old_school_activity_array[$_POST['activity'][$key]];
                }else{
                    $this->db->insert('school_activities',array('activity_name'=>$_POST['activity'][$key]));
                    $scID = $this->db->insert_id();
                }
                if(!empty($activityimage = $_FILES['activityimage']['name'][$key])){
                    $activitytype = $_FILES['activityimage']['type'][$key];
                    $activitysize = $_FILES['activityimage']['size'][$key];
                    $activitytmp_name = $_FILES['activityimage']['tmp_name'][$key];

                    $activity1 = $activityimage;
                    $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                    $activity1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                    $activity1_type = $activitytype;
                    $activity1_size = $activitysize;
                    $activity1_tem_loc = $activitytmp_name;
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
                if(!empty($_POST['activityimage_id'][$key])){
                    $schoolactivityUpdate[] = array(
                        'id' => $_POST['activityimage_id'][$key],
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
        if (!empty($_FILES['banner1']['name'])) {
            $banner1 = $_FILES['banner1']['name'];
            $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);

            $banner1_name = $school[0]['school_name'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            $banner1_type = $_FILES['banner1']['type'];
            $banner1_size = $_FILES['banner1']['size'];
            $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
            $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;
            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner1_ext, $allowed)) {

                if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {

                    $banner1insert = array(
                        'images' => $banner1_name,
                        'is_active' => 1
                    );

                    $this->db->where('school_activity_id',2);
                    $this->db->update('school_images', $banner1insert,array('school_id'=>$_POST['school_id']));                }
            }
        }else{
            $banner1_name = $_POST['old_banner1'];
            $banner1insert = array(
                // 'school_id' => $school_id,
                'images' => $banner1_name,
                'is_active' => 1
            );
            $this->db->where('school_activity_id',2);
            $this->db->update('school_images', $banner1insert,array('school_id'=>$_POST['school_id']));

        }

        if (!empty($_FILES['banner2']['name'])) {
            $banner2 = $_FILES['banner2']['name'];
            $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

            $banner2_name = $school[0]['school_name'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
            $banner2_type = $_FILES['banner2']['type'];
            $banner2_size = $_FILES['banner2']['size'];
            $banner2_tem_loc = $_FILES['banner2']['tmp_name'];
            $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner2_ext, $allowed)) {
                if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                    $banner2insert = array(
                        // 'school_id' => $school_id,
                        'images' => $banner2_name,
                        'is_active' => 1
                    );
                    $this->db->where('school_activity_id',169);
                    $this->db->update('school_images', $banner2insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }else{
            $banner2_name = $_POST['old_banner2'];
            $banner2insert = array(
                // 'school_id' => $school_id,
                'images' => $banner2_name,
                'is_active' => 1
            );
            $this->db->where('school_activity_id',169);
            $this->db->update('school_images', $banner2insert,array('school_id'=>$_POST['school_id']));
        }

        // banner3 image save
        if (!empty($_FILES['banner3']['name'])) {
            $banner3 = $_FILES['banner3']['name'];
            $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

            $banner3_name = $school[0]['school_name'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
            $banner3_type = $_FILES['banner3']['type'];
            $banner3_size = $_FILES['banner3']['size'];
            $banner3_tem_loc = $_FILES['banner3']['tmp_name'];
            $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($banner3_ext, $allowed)) {
                if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                    $banner3insert = array(
                        // 'school_id' => $school_id,
                        'images' => $banner3_name,
                        'is_active' => 1
                    );
                    $this->db->where('school_activity_id',170);
                    $this->db->update('school_images', $banner3insert,array('school_id'=>$_POST['school_id']));
                }
            }
        }else{
            $banner3_name = $_POST['old_banner3'];
            $banner3insert = array(
                // 'school_id' => $school_id,
                'images' => $banner3_name,
                'is_active' => 1
            );
            $this->db->where('school_activity_id',170);
            $this->db->update('school_images', $banner3insert,array('school_id'=>$_POST['school_id']));
        }

        // aboutimg1 image save
        if (!empty($_FILES['aboutimg1']['name'])) {
            $aboutimg1 = $_FILES['aboutimg1']['name'];
            $aboutimg1_ext = pathinfo($aboutimg1, PATHINFO_EXTENSION);

            $aboutimg1_name = $school[0]['school_name'] . "-" . rand(10000, 10000000) . "." . $aboutimg1_ext;
            $aboutimg1_type = $_FILES['aboutimg1']['type'];
            $aboutimg1_size = $_FILES['aboutimg1']['size'];
            $aboutimg1_tem_loc = $_FILES['aboutimg1']['tmp_name'];
            $aboutimg1_store = FCPATH . "/laravel/public/" . $aboutimg1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg');

            if (in_array($aboutimg1_ext, $allowed)) {
                if (move_uploaded_file($aboutimg1_tem_loc, $aboutimg1_store)) {
                        $image = $aboutimg1_name;
                }
            }
            $this->db->select('*');
            $this->db->where('school_activity_id',1);
            $this->db->where('school_id',$school_id);
            $this->db->from('school_images');
            $about_img = $this->db->get();
            if($about_img->num_rows() == 0 ){
                $aboutimg1insert = array(
                    'school_id' => $school_id,
                    'school_activity_id' => 1,
                    'images' => $image,
                    'is_active' => 1
                );
                $this->db->insert('school_images',$aboutimg1insert);
            }else{
                $aboutimg1insert = array(
                    // 'school_id' => $school_id,
                    'images' => $image,
                    'is_active' => 1
                );
                $this->db->where('school_activity_id',1);
                $this->db->update('school_images', $aboutimg1insert,array('school_id'=>$_POST['school_id']));

            }

        }else{
            $aboutimg1_name = $_POST['old_aboutimg1'];
            $aboutimg1insert = array(
                // 'school_id' => $school_id,
                'images' => $aboutimg1_name,
                'is_active' => 1
            );
        }
        $this->db->where('school_activity_id',1);
        $this->db->update('school_images', $aboutimg1insert,array('school_id'=>$_POST['school_id']));


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

        //management activities

        if (isset($_POST['infrastructure'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','infrastructure');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'infrastructure',
                    'content' => 'The school lays a strong foundation for the languages and technical subjects through applied linguistic skills, hands on practical and project work throughout the curriculum.',
                    'icon' => 'fa fa-home',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','infrastructure');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['clubs'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','clubs');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'clubs',
                    'content' => 'The activities of these various clubs will take place on Saturdays (Whenever it is a working day) in the Regular School Time.',
                    'icon' => 'fa fa-child',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','clubs');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['opportunities'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','opportunities');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'opportunities',
                    'content' => 'Students are encouraged to work in groups. Collaborating allows students to talk to each other and listen to all view points of discussion or assignment.',
                    'icon' => 'fa fa-superpowers',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','opportunities');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['progressive'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','progressive');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                'schooldetails_id' => $school_id,
                'activity_name' => 'progressive',
                'content' => 'Progressive education is a response to traditional methods of teaching. It is defined as an educational movement which gives more value to experience than formal learning.',
                'icon' => 'fa fa-book',
                'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','progressive');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['specialactivity'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','special activity');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'special activity',
                    'content' => 'We also conduct several activities wherein the children get to shape their newly developing skills such as cooperating, understanding, compassion and care for them as well as for those that are around them. Join us today!',
                    'icon' => 'fa fa-female',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','special activity');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['fieldtrips'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','fieldtrips');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                'schooldetails_id' => $school_id,
                'activity_name' => 'fieldtrips',
                'content' => 'Experience is the best teacher and learning to take care of oneself , and one’s own belongings independently, without parental supervision , helps the children to become self sufficient.',
                'icon' => 'fa fa-bicycle',
                'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','fieldtrips');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['curriculam'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','curriculam');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'curriculam',
                    'content' => 'The school strives to equip students to think logically and act sensibly, to develop strong sensibility and responsibility towards Self and to the Society.',
                    'icon' => 'fa fa-bookmark',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','curriculam');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['transport'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','transport');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                'schooldetails_id' => $school_id,
                'activity_name' => 'transport',
                'content' => 'The school operates buses and vans and pick up children from various points in the city.',
                'icon' => 'fa fa-bus',
                'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','transport');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['kidsplay'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','kidsplay');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'kidsplay',
                    'content' => 'We have provisions for both indoor and outdoor play areas. There are anti-slip flooring, age-appropriate toys, portable naptime cots, and attractive wall graphics.',
                    'icon' => 'fa fa-puzzle-piece',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','kidsplay');
            $this->db->delete('schoolmanagement_activities');
        }

        if (isset($_POST['playground'])) {
            $this->db->select('*');
            $this->db->from('schoolmanagement_activities');
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','playground');
            $infrastructure = $this->db->get();
            if($infrastructure->num_rows() == 0){ 
                $infrastructureinsert = array(
                'schooldetails_id' => $school_id,
                'activity_name' => 'playground',
                'content' => 'The playgrounds must be spacious and outdoors, but they must also be secluded so that the children (and their parents) feel safe and do not have to consider the outside world.',
                'icon' => 'fa fa-soccer-ball-o',
                'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }
        }else{
            $this->db->where('schooldetails_id',$school_id);
            $this->db->where('activity_name','playground');
            $this->db->delete('schoolmanagement_activities');
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
        $institute_id = $data['institute'][0]['id'];
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
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Founded');
        $this->db->from('institute_platinum_datas');
        $data['founded'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Special');
        $this->db->from('institute_platinum_datas');
        $data['special'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Students');
        $this->db->from('institute_platinum_datas');
        $data['students'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Events');
        $this->db->from('institute_platinum_datas');
        $data['events'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Achievements');
        $this->db->from('institute_platinum_datas');
        $data['achievements'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Teachers');
        $this->db->from('institute_platinum_datas');
        $data['teachers'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Branches');
        $this->db->from('institute_platinum_datas');
        $data['branches'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Language');
        $this->db->from('institute_platinum_datas');
        $data['language'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Trainer');
        $this->db->from('institute_platinum_datas');
        $data['trainer'] = $this->db->get()->result_array();
        $this->db->select('*')->where('id=',$userid);
        $this->db->from('institute_details');
        $institute = $this->db->get()->result_array();
        //institute news
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('institute_news');
        $data['news'] = $this->db->get()->result_array();
        $this->db->select('pd.id,pd.program_id,ip.program_name,pd.image,pd.about');
        $this->db->where('pd.institute_id', $institute_id);
        $this->db->join('program_details as pd','pd.program_id = ip.id','left');
        $this->db->from('institute_programs as ip');
        $data['inst_category']=$this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('institute_images');
        $data['inst_img'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('program_details');
        $data['category_img'] = $this->db->get()->result_array();
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
        $institute_id = $data['institute'][0]['id'];
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
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Founded');
        $this->db->from('institute_platinum_datas');
        $data['founded'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Special');
        $this->db->from('institute_platinum_datas');
        $data['special'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Students');
        $this->db->from('institute_platinum_datas');
        $data['students'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Events');
        $this->db->from('institute_platinum_datas');
        $data['events'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Achievements');
        $this->db->from('institute_platinum_datas');
        $data['achievements'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Teachers');
        $this->db->from('institute_platinum_datas');
        $data['teachers'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Branches');
        $this->db->from('institute_platinum_datas');
        $data['branches'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Language');
        $this->db->from('institute_platinum_datas');
        $data['language'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('heading','Trainer');
        $this->db->from('institute_platinum_datas');
        $data['trainer'] = $this->db->get()->result_array();
        $this->db->select('*')->where('id=',$userid);
        $this->db->from('institute_details');
        $institute = $this->db->get()->result_array();
        //institute news
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('institute_news');
        $data['news'] = $this->db->get()->result_array();
        $this->db->select('pd.id,pd.program_id,ip.program_name,pd.image,pd.about');
        $this->db->where('pd.institute_id', $institute_id);
        $this->db->join('program_details as pd','pd.program_id = ip.id','left');
        $this->db->from('institute_programs as ip');
        $data['inst_category']=$this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('institute_images');
        $data['inst_img'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->from('program_details');
        $data['category_img'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('institute_id',$institute_id);
        $this->db->where('category_id',1);
        $this->db->from('institute_images');
        $data['aboutimg'] = $this->db->get()->result_array();
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

        $school_id = base64_decode($_POST['id']);
        // $this->db->where('schooldetails_id', $userid);
        // $this->db->delete('schoolmanagement_activities');
        // $this->db->where('school_id', $userid);
        // $this->db->delete('platinum_datas');
        // $this->db->where('school_id', $userid);
        // $this->db->delete('school_images');
        // $this->db->where('school_id', $userid);
        // $this->db->delete('school_facilities');
        // $this->db->where('id', $userid);
        // $this->db->delete('school_details');
        $delete = array(
            'deleted_at' => date('Y-m-d h:i:s'),
        );
        $this->db->update('school_details',$delete,array('id' => $school_id));
        redirect('admin/schools');

    } 

    function institute_delete(){
        
        $institute_id = base64_decode($_POST['id']);
        // $this->db->where('institute_id', $userid);
        // $this->db->delete('institute_images');
        // $this->db->where('institute_id', $userid);
        // $this->db->delete('institute_admissions');
        // $this->db->where('institute_id', $userid);
        // $this->db->delete('institute_platinum_datas');
        // $this->db->where('institute_id', $userid);
        // $this->db->delete('program_details');
        // $this->db->where('institute_id', $userid);
        // $this->db->delete('institute_news');
        // $this->db->where('id', $userid);
        // $this->db->delete('institute_details');
        $delete = array(
            'deleted_at' => date('Y-m-d h:i:s'),
        );
        $this->db->update('institute_details',$delete,array('id' => $institute_id));
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
                    'institute_id' => $school_id,
                    'icon' => 'founded.png',
                    'content' => $_POST['founded'],
                    'brief_content' => $_POST['founded'],
                    'is_active' => 1
                );
                $this->db->where('heading','Founded');
                $this->db->update('institute_platinum_datas', $foundedinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{

            $foundednewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'special.png',
                    // 'heading' => 'Special',
                    'content' => $_POST['special'],
                    'brief_content' => $_POST['special'],
                    'is_active' => 1
                );
                $this->db->where('heading','Special');
                $this->db->update('institute_platinum_datas', $specialinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $specialnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'students.png',
                    // 'heading' => 'Students',
                    'content' => $_POST['students'],
                    'brief_content' => $_POST['students'],
                    'is_active' => 1
                );
                $this->db->where('heading','Students');
                $this->db->update('institute_platinum_datas', $studentsinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $studentsnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'Events.png',
                    // 'heading' => 'Events',
                    'content' => $_POST['events'],
                    'brief_content' => $_POST['events'],
                    'is_active' => 1
                );
                $this->db->where('heading','Events');
                $this->db->update('institute_platinum_datas', $eventsinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $eventsnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'achievements.png',
                    // 'heading' => 'Achievements',
                    'content' => $_POST['achievements'],
                    'brief_content' => $_POST['achievements'],
                    'is_active' => 1
                );
                $this->db->where('heading','Achievements');
                $this->db->update('institute_platinum_datas', $achievementsinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $achievementsnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'teachers.png',
                    // 'heading' => 'Teachers',
                    'content' => $_POST['teachers'],
                    'brief_content' => $_POST['teachers'],
                    'is_active' => 1
                );
                $this->db->where('heading','Teachers');
                $this->db->update('institute_platinum_datas', $teachersinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $teachersnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'branch.png',
                    // 'heading' => 'Branches',
                    'content' => $_POST['branches'],
                    'brief_content' => $_POST['branches'],
                    'is_active' => 1
                );
                $this->db->where('heading','Branches');
                $this->db->update('institute_platinum_datas', $branchesinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $branchesnewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'language.png',
                    // 'heading' => 'Language',
                    'content' => $_POST['language'],
                    'brief_content' => $_POST['language'],
                    'is_active' => 1
                );
                $this->db->where('heading','Language');
                $this->db->update('institute_platinum_datas', $languageinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $languagenewinsert = array(
                'institute_id' => $school_id,
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
                    'institute_id' => $school_id,
                    'icon' => 'history.png',
                    // 'heading' => 'Academic',
                    'content' => $_POST['customRadioInline1'],
                    'brief_content' => $_POST['customRadioInline1'],
                    'is_active' => 1
                );
                $this->db->where('heading','Academic');
                $this->db->update('institute_platinum_datas', $academicinsert,array('institute_id'=>$_POST['school_id']));
            }
        }else{
            $academicnewinsert = array(
                'institute_id' => $school_id,
                'icon' => 'history.png',
                'heading' => 'Academic',
                'content' => $_POST['customRadioInline1'],
                'brief_content' => $_POST['customRadioInline1'],
                'is_active' => 1
            );
            $this->db->insert('institute_platinum_datas', $academicnewinsert);
        }

        if (!empty($_POST['customRadioInline1'])) {
            
            if ($_POST['customRadioInline1'] == "yes") {
                $activityinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'activity.png',
                    'heading' => 'Trainer',
                    'content' => 'Personal Trainer',
                    'brief_content' => 'Personal Trainer',
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $activityinsert);
            }
            else if($_POST['customRadioInline1'] == "no"){
                $this->db->where('heading','Trainer');
                $this->db->where('institute_id',$school_id);
                $this->db->delete('institute_platinum_datas');
            }
        }
        //institute categories
        $this->db->select('id,program_name');
        $old_school_activity = $this->db->get('institute_programs')->result_array();
        $old_school_activity_array=array();
        foreach($old_school_activity as $old_school_act){
            $old_school_activity_array[$old_school_act['program_name']] = $old_school_act['id'];
        }
        $act = $_POST['categoryname']; $activity_ids = $_POST['category_id'];
        $insertschoolactivityinsert = array();$schoolactivityUpdate = array();
        if (is_array($act)) {
            foreach($act as $key=>$activity) {
                if(!empty($old_school_activity_array[$_POST['categoryname'][$key]])){
                    $scID = $old_school_activity_array[$_POST['categoryname'][$key]];
                }else{
                    $this->db->insert('institute_programs',array('program_name'=>$_POST['categoryname'][$key]));
                    $scID = $this->db->insert_id();
                }
                if(!empty($activityimage = $_FILES['categoryimage']['name'][$key])){
                    $activitytype = $_FILES['categoryimage']['type'][$key];
                    $activitysize = $_FILES['categoryimage']['size'][$key];
                    $activitytmp_name = $_FILES['categoryimage']['tmp_name'][$key];

                    $activity1 = $activityimage;
                    $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                    $activity1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                    $activity1_type = $activitytype;
                    $activity1_size = $activitysize;
                    $activity1_tem_loc = $activitytmp_name;
                    $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
                    if (in_array($activity1_ext, $allowed)) {
                        if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {
                            $image = $activity1_name;
                        }
                    }
                }else{
                    $image = $_POST['category_old_image'][$key];
                }
                if(!empty($_POST['category_id'][$key])){
                    $schoolactivityUpdate[] = array(
                        'id' => $_POST['category_id'][$key],
                        'program_id' => $scID,
                        'about' => $_POST['categorydesc'][$key],
                        'image' => $image,
                        'is_active' => 1
                    );
                }else{
                    $insertschoolactivityinsert[] = array(
                        'institute_id' => $school_id,
                        'program_id' => $scID,
                        'about' => $_POST['categorydesc'][$key],
                        'image' => $image,
                        'is_active' => 1
                    );
                }
            }
        }

        if(!empty($schoolactivityUpdate)){
            $this->db->update_batch('program_details', $schoolactivityUpdate,'id');
        }
        if(!empty($insertschoolactivityinsert)){
            $this->db->insert_batch('program_details', $insertschoolactivityinsert);
        }
        //news heading
        // if(!empty($_POST['newsheading'])){
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
                if($news_heading->num_rows() > 0){
                    $newsupdate[] = array(
                        'institute_id' => $school_id,
                        'news' => $news[$key],
                        'news_brief' => $newsdesc[$key],
                        'is_active' => 1,
                        'id' => $newsid
                    );
                    
                } else {
                    $newsinsert[] = array(
                        'institute_id' => $school_id,
                        'news' => $news[$key],
                        'news_brief' => $newsdesc[$key],
                        'is_active' => 1
                    );
                }  
            } else {  
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
    // }else{
    //     $this->db->where('news','');
    //     $this->db->delete('institute_news');
    // }

        //about image
        $aboutimgupdate = array(); $aboutimginsert = array();
        // print_r($_FILES['aboutimage']);exit;
        if(!empty($_FILES['aboutimage'])){
            $aboutimage = $_FILES['aboutimage']['name'];
            $aboutimage_ext = pathinfo($aboutimage, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $aboutimage_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $aboutimage_ext;
            $aboutimage_type = $_FILES['aboutimage']['type'];
            $aboutimage_size = $_FILES['aboutimage']['size'];
            $aboutimage_tem_loc = $_FILES['aboutimage']['tmp_name'];
            $aboutimage_store = FCPATH . "/laravel/public/" . $aboutimage_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if(in_array($aboutimage_ext, $allowed)) {
                if(move_uploaded_file($aboutimage_tem_loc, $aboutimage_store)) {
                    $image = $aboutimage_name;
                }
            }
        } else {
            $image = $_POST['aboutoldimage'];
        }

        if(!empty($_POST['aboutoldimage_id'])){
            $aboutimgupdate[] = array(
                'id' => $_POST['aboutoldimage_id'],
                'category_id' => 1,
                'image' => $image,
                'is_active' => 1
            );
        }else{
            $aboutimginsert[] = array(
                'institute_id' => $school_id,
                'category_id' => 1,
                'image' => $image,
                'is_active' => 1
            );
        }
        // echo "<pre>";print_r($aboutimgupdate);print_r($aboutimginsert); exit;
        if(!empty($aboutimgupdate)){
            $this->db->update_batch('institute_images', $aboutimgupdate,'id');
        }
        if(!empty($aboutimginsert)){
            $this->db->insert_batch('institute_images', $aboutimginsert);
        }

        if(!empty($_FILES['newsbanner'])){
            $newsbanner1 = $_FILES['newsbanner']['name'];
            $newsbanner1_ext = pathinfo($newsbanner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $newsbanner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $newsbanner1_ext;
            $newsbanner1_type = $_FILES['newsbanner']['type'];
            $newsbanner1_size = $_FILES['newsbanner']['size'];
            $newsbanner1_tem_loc = $_FILES['newsbanner']['tmp_name'];
            $newsbanner1_store = FCPATH . "/laravel/public/" . $newsbanner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($newsbanner1_ext, $allowed)) {

                if (move_uploaded_file($newsbanner1_tem_loc, $newsbanner1_store)) {
                    $newsbanner1_name = $newsbanner1_name;
                }
            }
        } else {
            $newsbanner1_name = $_POST['newsoldbanner'];
        }
        
        // gallery image save
        if (isset($_FILES['mytext']['name'])) {
            $gallaryimage = $_FILES['mytext']['name'];
            $gallarytype = $_FILES['mytext']['type'];
            $gallarysize = $_FILES['mytext']['size'];
            $gallarytmp_name = $_FILES['mytext']['tmp_name'];



            if (is_array($gallaryimage)) {
                for ($i = 0; $i < count($gallaryimage); $i++) {
                    $gallary1image = $gallaryimage[$i];
                    $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

                    $gallary1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                    $gallary1_type = $gallarytype[$i];
                    $gallary1_size = $gallarysize[$i];
                    $gallary1_tem_loc = $gallarytmp_name[$i];
                    $gallary1_store = FCPATH . "/laravel/public/" . $gallary1_name;

                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                    if (in_array($gallary1_ext, $allowed)) {
                        if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                            $schoolgallaryinsert1 = array(
                                'institute_id' => $school_id,
                                'category_id' => 2,
                                'image' => $gallary1_name,
                                'is_active' => 1
                            );

                            $this->db->insert('institute_images', $schoolgallaryinsert1);
                        }
                    }
                }
            }
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
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'instagram' => $_POST['instagram'],
            'linkedin' => $_POST['linkedin'],
            'pinterest' => $_POST['pinterest'],
            'map_url' => $_POST['map_url'],
            // 'activated_at' => date('Y-m-d H:i:s'),/
            'is_active' => 1,
            // 'valitity'=>100
        );
        $this->db->update('institute_details',$schoolupdate,array('id'=>$school_id));
        redirect('admin/schools/institute');
    }

    function approve_school($school_id){

        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('school_details');
        $data['school'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('id',$data['school'][0]['user_id']);
        $this->db->from('user_register');
        $data['user'] = $this->db->get()->result_array();

        if($data['school'][0]['school_category_id'] == 1){
            $amount=65000;
        }else if($data['school'][0]['school_category_id'] == 2){
            $amount=30000;
        }else if($data['school'][0]['school_category_id'] == 3){
            $amount=12500;
        }else if($data['school'][0]['school_category_id'] == 4){
            $amount=0;
        }
        $data = array(
            'status' => 1,
            'paid' => $amount,
            'activated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('school_details',$data);

        $msg = $this->load->view('school_invoice',$data,true);
        $sub = 'Edugatein - Your School - '.$data['school'][0]['school_name'].' has been approved';


        $to = "sundarabui2k21@gmail.com";
        // $subject = "This is subject";
        
        // $message = "<b>This is HTML message.</b>";
        // $message .= "<h1>This is headline.</h1>";
        
        $header = "From:ftwoftesting@gmail.com \r\n";
        // $header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        
        $send = mail($to,$sub,$msg,$header);
        
        if( $send == true ) 
        {
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        }
        else
        {
            show_error($this->email->print_debugger());
        }



            
        // use wordwrap() if lines are longer than 70 characters
        // $msg = wordwrap($msg, 70, "\r\n");

        // send email
        // mail("sundarabui2k21@gmail.com",$sub,$msg);



        // $this->load->library('email');
        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user']    = 'ftwoftesting@gmail.com';
        // $config['smtp_pass']    = 'MotivationS@1';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'html';
        // $config['validation'] = TRUE; // bool whether to validate email or not      
        
        // $this->email->initialize($config);
        
        // $this->email->from('ftwoftesting@gmail.com');
        // $this->email->to('sundarabui2k21@gmail.com'); 
        // $this->email->subject($sub);
        // $this->email->message($msg);  
        //     if($this->email->send())
        //     {
        //         $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        //     }
        //     else
        //     {
        //     show_error($this->email->print_debugger());
        //     }

            // Authorisation details.
        $username = "manikandan@haunuzinfosystems.com";
        $hash = "cbbb512a1a514916c35b040283ac6dc7df975411a4c6669f738aeab42bfeb128";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = "8667579048"; // A single number or a comma-seperated list of numbers
        $message = "Hello ".$user_name." your school ".$school_name." has validated and displayed on site,Thank you";
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

        redirect('admin/schools/view_school?id='.$school_id);
    }

    function reject_school($school_id){
        $data = array(
            'status' => 2
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('school_details',$data);
        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('school_details');
        $data['school'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('id',$data['school'][0]['user_id']);
        $this->db->from('user_register');
        $data['user'] = $this->db->get()->result_array();
        // $msg = $this->load->view('school_invoice',$data,true);
        // $sub = 'Edugatein - Your School - '.$data['school'][0]['school_name'].' is rejected';

        // $this->load->library('email');

        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user']    = 'ftwoftesting@gmail.com';
        // $config['smtp_pass']    = 'MotivationS@1';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'html';
        // $config['validation'] = TRUE; // bool whether to validate email or not      
        
        // $this->email->initialize($config);
        
        // $this->email->from('ftwoftesting@gmail.com');
        // $this->email->to('sundarabui2k21@gmail.com'); 
        // $this->email->subject($sub);
        // $this->email->message($msg);  
        // if($this->email->send())
        // {
        //     $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        // }
        // else
        // {
        // show_error($this->email->print_debugger());
        // }
        redirect('admin/schools/view_school?id='.$school_id);
    }

    function hold_school($school_id){
        $data = array(
            'status' => NULL
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('school_details',$data);
        redirect('admin/schools/view_school?id='.$school_id);
    }

    function approve_class($school_id){
        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('institute_details');
        $data['institute'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('id',$data['institute'][0]['user_id']);
        $this->db->from('user_register');
        $data['user'] = $this->db->get()->result_array();

        if($data['institute'][0]['position_id'] == 1){
            $amount=65000;
        }else if($data['institute'][0]['position_id'] == 2){
            $amount=30000;
        }else if($data['institute'][0]['position_id'] == 3){
            $amount=12500;
        }else if($data['institute'][0]['position_id'] == 4){
            $amount=0;
        }
        $data = array(
            'status' => 1,
            'paid' => $amount,
            'activated_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('institute_details',$data);

        // $msg = $this->load->view('activity_invoice',$data,true);
        // $sub = 'Edugatein - Your Activity class - '.$data['institute'][0]['institute_name'].' has been approved';

        // $this->load->library('email');

        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user']    = 'ftwoftesting@gmail.com';
        // $config['smtp_pass']    = 'MotivationS@1';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'html'; 
        // $config['validation'] = TRUE; // bool whether to validate email or not      
        
        // $this->email->initialize($config);
        
        // $this->email->from('ftwoftesting@gmail.com');
        // $this->email->to('sundarabui2k21@gmail.com'); 
        // $this->email->subject($sub);
        // $this->email->message($msg);  
        //     if($this->email->send())
        //     {
        //         $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        //     }
        //     else
        //     {
        //     show_error($this->email->print_debugger());
        //     }

// <script>
//     function myFunction() {
//   setTimeout(function(){ location.reload(); });
// }
    
//     </script>

        redirect('admin/schools/view_activityclass?id='.$school_id);
    }

    function reject_class($school_id){
        $data = array(
            'status' => 2
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('institute_details',$data);

        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('institute_details');
        $data['institute'] = $this->db->get()->result_array();
        $this->db->select('*');
        $this->db->where('id',$data['institute'][0]['user_id']);
        $this->db->from('user_register');
        $data['user'] = $this->db->get()->result_array();

        // $msg = $this->load->view('activity_invoice',$data,true);
        // $sub = 'Edugatein - Your Activity class - '.$data['institute'][0]['institute_name'].' is rejected';

        // $this->load->library('email');

        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user']    = 'ftwoftesting@gmail.com';
        // $config['smtp_pass']    = 'MotivationS@1';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'html'; 
        // $config['validation'] = TRUE; // bool whether to validate email or not      
        
        // $this->email->initialize($config);
        
        // $this->email->from('ftwoftesting@gmail.com');
        // $this->email->to('sundarabui2k21@gmail.com'); 
        // $this->email->subject($sub);
        // $this->email->message($msg);  
        // if($this->email->send())
        // {
        //     $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        // }
        // else
        // {
        // show_error($this->email->print_debugger());
        // }

        redirect('admin/schools/view_activityclass?id='.$school_id);
    }

    function hold_class($school_id){
        $data = array(
            'status' => NULL
        );
        $this->db->where('id',base64_decode($school_id));
        $this->db->update('institute_details',$data);
        redirect('admin/schools/view_activityclass?id='.$school_id);
    }

    function add_school(){
        $this->load->view('add_school');
    }
    
    public function admin_insert() {
        $data = array(
            'name' => $this->input->post('name') . " " . $this->input->post('lastname'),
            'email' => $this->input->post('useremail'),
            'phone' => $this->input->post('adminphone'),
            'password' => base64_encode($this->input->post('password')),
            'category' => $this->input->post('category'),
            'ip' => $this->input->post('ip'),
        );
        // print_r($data);exit;
        $this->db->select('*')->where('email =', $data['email']);
        $this->db->from('user_register');
        $email = $this->db->get()->result();
        if (count($email) == 0) {
            $this->db->insert('account_tracker', $data);
            $this->db->insert('user_register', $data);
            $user_id = $this->db->insert_id();
                $ip = $_SERVER['REMOTE_ADDR'];
                // $mobile = substr($this->input->post('phone'), -4);
                // echo json_encode(array('status' => 'success', 'data' => array("mobile" => $mobile,"contact_email" => $data['email'],"user_id" => $user_id)));
                // die;
            // } else {
            //     echo json_encode(array('status' => 'error', "message" => array("text" => "Try using another contact info !!!", "title" => "User Already Exist")));
            //     die;
            //     $this->load->view('sign-up-school', $data);
            // }
        }
        //insert school
        if($_POST['category'] == 'school'){

            $school['schoolname'] = $_POST['schoolname'];
            $school['schoolboard'] = $_POST['schoolboard'];
            $school['city'] = $_POST['school_city'];

            $this->db->select('*')->where('affiliation_name =', $school['schoolboard']);
            $this->db->from('affiliations');
            $schoolboardarray = $this->db->get();

            foreach ($schoolboardarray->result() as $schoolboards) {
                $schoolboard_id = $schoolboards->id;
            }

            $this->db->select('*')->where('city_name =', $school['city']);
            $this->db->from('cities');
            $yourcityarray = $this->db->get();


            if ($yourcityarray->num_rows() > 0) {
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            } else {
                $cityinsert = array(
                    'city_name' => $school['city'],
                    'slug' => $school['city'],
                    'state_id' => 2,
                    'is_active' => 1
                );
                $this->db->insert('cities', $cityinsert);

                $this->db->select('*')->where('city_name =', $school['city']);
                $this->db->from('cities');
                $yourcityarray = $this->db->get();
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            }

            $school['area'] = $_POST['school_area'];

            $this->db->select('*')->where('area_name =', $school['area']);
            $this->db->from('areas');
            $area = $this->db->get();


            if ($area->num_rows() > 0) {
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
            } else {
                $areainsert = array(
                    'area_name' => $school['area'],
                    'slug' => $school['area'],
                    'city_id' => $yourcity_id,
                    'is_active' => 1
                );
                $this->db->insert('areas', $areainsert);

                $this->db->select('*')->where('area_name =', $school['area']);
                $this->db->from('areas');
                $area = $this->db->get();
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
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

            $school['ad'] = $_POST['ad'];
            // $school['customRadio1'] = $_POST['customRadio1'];
            // $school['customRadio2'] = $_POST['customRadio2'];


            $school['founded'] = $_POST['school_founded'];
            $school['students'] = $_POST['school_students'];
            $school['teachers'] = $_POST['school_teachers'];

            $school['about'] = $_POST['about'];
            $school['activity1'] = $_POST['activity1'];
            $school['activity2'] = $_POST['activity2'];
            $school['activity3'] = $_POST['activity3'];
            $school['activity4'] = $_POST['activity4'];
            $school['facility1'] = $_POST['facility1'];
            $school['facility2'] = $_POST['facility2'];
            $school['facility3'] = $_POST['facility3'];
            $school['facility4'] = $_POST['facility4'];
            $school['facilitydes1'] = $_POST['facilitydes1'];
            $school['facilitydes2'] = $_POST['facilitydes2'];
            $school['facilitydes3'] = $_POST['facilitydes3'];
            $school['facilitydes4'] = $_POST['facilitydes4'];
            $school['phone'] = $_POST['school_phone'];
            $school['email'] = $_POST['school_email'];
            $school['website'] = $_POST['school_website'];
            $school['address'] = $_POST['school_address'];
            $school['facebook'] = $_POST['facebook'];
            $school['twitter'] = $_POST['twitter'];
            $school['instagram'] = $_POST['instagram'];
            $school['linkedin'] = $_POST['linkedin'];
            $school['pinterest'] = $_POST['pinterest'];
            // echo $school['students'];
            // echo "<br>";
            // echo $school['teachers'];
            // exit(); 

            // $banner1 = $_FILES['school_banner1']['name'];
            // $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // // echo $banner1_ext;
            // // exit();
            // $banner1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            // $banner1_type = $_FILES['school_banner1']['type'];
            // $banner1_size = $_FILES['school_banner1']['size'];
            // $banner1_tem_loc = $_FILES['school_banner1']['tmp_name'];
            // $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;
            // $allowed = array('gif', 'png', 'jpg', 'jpeg');

            // if (in_array($banner1_ext, $allowed)) {

            //     if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                    
            //     }
            // }

            if($_POST['school_category'] = 1){
                $paid = 65000;
            }else if($_POST['school_category'] = 2){
                $paid = 30000;
            }else if($_POST['school_category'] = 1){
                $paid = 12000;
            }else if($_POST['school_category'] = 1){
                $paid = 0;
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
            if(isset($_POST['school_status']) == 1){
                $status = 1;
                $act_date = date('Y-m-d H:i:s');
            }else{
                $status = null;
                $act_date = null;
            }
            if($_POST['school_category'] = 4){
                $validity = 30;
            }else{
                $validity = 100;
            }
            $schoolinsert = array(
                'school_name' => $school['schoolname'],
                'slug' => $school['schoolname'],
                'mobile' => $school['phone'],
                'email' => $school['email'],
                'address' => $school['address'],
                'user_id' => $user_id,
                'city_id' => $yourcity_id,
                'area_id' => $area_id,
                'pincode' => $_POST['pincode'],
                'affiliation_id' => $schoolboard_id,
                'schooltype_id' => $level_id,
                'school_category_id' => $_POST['school_category'],
                'status' => $_POST['school_status'],
                'about' => $school['about'],
                'acadamic' => $_POST['school_academic'],
                'website_url' => $_POST['school_website'],
                'our_mission' => $_POST['our_mission'],
                'our_vision' => $_POST['our_vision'],
                'our_motto' => $_POST['our_motto'],
                'boys' => $_POST['boys'],
                'girls' => $_POST['girls'],
                'map_url' => $_POST['school_map_url'],
                'year_of_establish' => $_POST['school_founded'],
                'ad' => $school['ad'],
                // 'type'=>$school['address'],
                'hostel' => $customRadio1,
                'rte' => $customRadio,
                'paid' => $paid,
                'students' => $school['school_students'],
                'teachers' => $school['school_teachers'],
                'facebook' => $school['facebook'],
                'twitter' => $school['twitter'],
                'instagram' => $school['instagram'],
                'linkedin' => $school['linkedin'],
                'pinterest' => $school['pinterest'],
                'logo' => $banner1_name,
                'activated_at' => $act_date,
                'is_active' => 1,
                'valitity' => $validity,
            );
            $this->db->insert('school_details', $schoolinsert);

            $this->db->select('*')->where('slug =', $school['schoolname']);
            $this->db->from('school_details');
            $schooldetail = $this->db->get();
            foreach ($schooldetail->result() as $schooldetails) {
                $school_id = $schooldetails->id;
            }


            //platinum data save
            if (!empty($_POST['school_founded'])) {
                $foundedinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'founded.png',
                    'heading' => 'Founded',
                    'content' => $_POST['school_founded'],
                    'brief_content' => $_POST['school_founded'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $foundedinsert);
            }

            if (!empty($_POST['school_special'])) {
                $specialinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'special.png',
                    'heading' => 'Special',
                    'content' => $_POST['school_special'],
                    'brief_content' => $_POST['school_special'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $specialinsert);
            }

            if (!empty($_POST['school_students'])) {
                $studentsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'students.png',
                    'heading' => 'Students',
                    'content' => $_POST['school_students'],
                    'brief_content' => $_POST['school_students'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $studentsinsert);
            }

            if (!empty($_POST['school_events'])) {
                $eventsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'Events.png',
                    'heading' => 'Events',
                    'content' => $_POST['school_events'],
                    'brief_content' => $_POST['school_events'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $eventsinsert);
            }

            if (!empty($_POST['school_achievements'])) {
                $achievementsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'achievements.png',
                    'heading' => 'Achievements',
                    'content' => $_POST['school_achievements'],
                    'brief_content' => $_POST['school_achievements'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $achievementsinsert);
            }

            if (!empty($_POST['school_teachers'])) {
                $teachersinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'teachers.png',
                    'heading' => 'Teachers',
                    'content' => $_POST['school_teachers'],
                    'brief_content' => $_POST['school_teachers'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $teachersinsert);
            }

            if (!empty($_POST['school_branches'])) {
                $branchesinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'branch.png',
                    'heading' => 'Branches',
                    'content' => $_POST['school_branches'],
                    'brief_content' => $_POST['school_branches'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $branchesinsert);
            }

            if (!empty($_POST['school_academic'])) {
                $academicinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'history.png',
                    'heading' => 'Academic',
                    'content' => $_POST['school_academic'],
                    'brief_content' => $_POST['school_academic'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $academicinsert);
            }

            if (!empty($_POST['school_language'])) {
                $languageinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'language.png',
                    'heading' => 'Language',
                    'content' => $_POST['school_language'],
                    'brief_content' => $_POST['school_language'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $languageinsert);
            }

            if (!empty($_POST['activity_school'])) {
                $activityinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'activity.png',
                    'heading' => 'activity',
                    'content' => $_POST['activity_school'],
                    'brief_content' => $_POST['activity_school'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $activityinsert);
            }


            // schoolmanagement activities 

            if (isset($_POST['playground'])) {
                $playgroundinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'playground',
                    'content' => 'The playgrounds must be spacious and outdoors, but they must also be secluded so that the children (and their parents) feel safe and do not have to consider the outside world.',
                    'icon' => 'fa fa-soccer-ball-o',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $playgroundinsert);
            }

            if (isset($_POST['kidsplay'])) {
                $kidsplayinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'kidsplay',
                    'content' => 'We have provisions for both indoor and outdoor play areas. There are anti-slip flooring, age-appropriate toys, portable naptime cots, and attractive wall graphics.',
                    'icon' => 'fa fa-puzzle-piece',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $kidsplayinsert);
            }

            if (isset($_POST['transport'])) {
                $transportinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'transport',
                    'content' => 'The school operates buses and vans and pick up children from various points in the city.',
                    'icon' => 'fa fa-bus',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $transportinsert);
            }

            if (isset($_POST['curriculam'])) {
                $curriculaminsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'curriculam',
                    'content' => 'The school strives to equip students to think logically and act sensibly, to develop strong sensibility and responsibility towards Self and to the Society.',
                    'icon' => 'fa fa-bookmark',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $curriculaminsert);
            }

            if (isset($_POST['fieldtrips'])) {
                $fieldtripsinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'fieldtrips',
                    'content' => 'Experience is the best teacher and learning to take care of oneself , and one’s own belongings independently, without parental supervision , helps the children to become self sufficient.',
                    'icon' => 'fa fa-bicycle',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $fieldtripsinsert);
            }

            if (isset($_POST['specialactivity'])) {
                $specialinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'special activity',
                    'content' => 'We also conduct several activities wherein the children get to shape their newly developing skills such as cooperating, understanding, compassion and care for them as well as for those that are around them. Join us today!',
                    'icon' => 'fa fa-female',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $specialinsert);
            }

            if (isset($_POST['progressive'])) {
                $progressiveinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'progressive',
                    'content' => 'Progressive education is a response to traditional methods of teaching. It is defined as an educational movement which gives more value to experience than formal learning.',
                    'icon' => 'fa fa-book',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $progressiveinsert);
            }

            if (isset($_POST['opportunities'])) {
                $opportunitiesinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'opportunities',
                    'content' => 'Students are encouraged to work in groups. Collaborating allows students to talk to each other and listen to all view points of discussion or assignment.',
                    'icon' => 'fa fa-superpowers',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $opportunitiesinsert);
            }

            if (isset($_POST['clubs'])) {
                $clubsinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'clubs',
                    'content' => 'The activities of these various clubs will take place on Saturdays (Whenever it is a working day) in the Regular School Time.',
                    'icon' => 'fa fa-child',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $clubsinsert);
            }

            if (isset($_POST['infrastructure'])) {
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'infrastructure',
                    'content' => 'The school lays a strong foundation for the languages and technical subjects through applied linguistic skills, hands on practical and project work throughout the curriculum.',
                    'icon' => 'fa fa-home',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }






            // banner1 image save
            if (isset($_FILES['school_banner1']['name'])) {
                $banner1 = $_FILES['banner1']['name'];
                $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
                $banner1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
                $banner1_type = $_FILES['school_banner1']['type'];
                $banner1_size = $_FILES['school_banner1']['size'];
                $banner1_tem_loc = $_FILES['school_banner1']['tmp_name'];
                $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');

                if (in_array($banner1_ext, $allowed)) {

                    if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {

                        $banner1insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 2,
                            'images' => $banner1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner1insert);
                    }
                }
            }
            $logo = array(
                'logo' => $banner1_name,
            );
            $this->db->update('school_details',$logo,array('id' => $school_id));

            if (isset($_FILES['school_banner2']['name'])) {
                $banner2 = $_FILES['banner2']['name'];
                $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

                $banner2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
                $banner2_type = $_FILES['school_banner2']['type'];
                $banner2_size = $_FILES['school_banner2']['size'];
                $banner2_tem_loc = $_FILES['school_banner2']['tmp_name'];
                $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($banner2_ext, $allowed)) {
                    if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                        $banner2insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 169,
                            'images' => $banner2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner2insert);
                    }
                }
            }

            // banner3 image save
            if (isset($_FILES['school_banner3']['name'])) {
                $banner3 = $_FILES['banner3']['name'];
                $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

                $banner3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
                $banner3_type = $_FILES['school_banner3']['type'];
                $banner3_size = $_FILES['school_banner3']['size'];
                $banner3_tem_loc = $_FILES['school_banner3']['tmp_name'];
                $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($banner3_ext, $allowed)) {
                    if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                        $banner3insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 170,
                            'images' => $banner3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner3insert);
                    }
                }
            }

            // aboutimg1 image save
            if (!empty($_FILES['aboutimg1']['name'])) {
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
                            'school_id' => $school_id,
                            'school_activity_id' => 1,
                            'images' => $aboutimg1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $aboutimg1insert);
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
                            'school_id' => $school_id,
                            'school_activity_id' => 1,
                            'images' => $aboutimg2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $aboutimg2insert);
                    }
                }
            }

            // activityimage1 image save
            if (isset($_FILES['activityimage1']['name'])) {
                $activity1 = $_FILES['activityimage1']['name'];
                $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                $activity1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                $activity1_type = $_FILES['activityimage1']['type'];
                $activity1_size = $_FILES['activityimage1']['size'];
                $activity1_tem_loc = $_FILES['activityimage1']['tmp_name'];
                $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');

                if (in_array($activity1_ext, $allowed)) {
                    if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {

                        $this->db->select('*')->where('activity_name =', $_POST['activity1']);
                        $this->db->from('school_activities');
                        $schoolactivity1 = $this->db->get();

                        if ($schoolactivity1->num_rows() > 0) {
                            foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                $schoolactivity_id1 = $schoolactivitys1->id;
                            }
                        } else {
                            $schoolactivityinsert1 = array(
                                'activity_name' => $_POST['activity1']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert1);

                            $this->db->select('*')->where('activity_name =', $_POST['activity1']);
                            $this->db->from('school_activities');
                            $schoolactivity1 = $this->db->get();

                            foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                $schoolactivity_id1 = $schoolactivitys1->id;
                            }
                        }

                        $schoolactivityinsert1 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id1,
                            'images' => $activity1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert1);
                    }
                }
            }

            // activity2 image save
            if (isset($_FILES['activityimage2']['name'])) {
                $activity2 = $_FILES['activityimage2']['name'];
                $activity2_ext = pathinfo($activity2, PATHINFO_EXTENSION);

                $activity2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity2_ext;
                $activity2_type = $_FILES['activityimage2']['type'];
                $activity2_size = $_FILES['activityimage2']['size'];
                $activity2_tem_loc = $_FILES['activityimage2']['tmp_name'];
                $activity2_store = FCPATH . "/laravel/public/" . $activity2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity2_ext, $allowed)) {
                    if (move_uploaded_file($activity2_tem_loc, $activity2_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity2']);
                        $this->db->from('school_activities');
                        $schoolactivity2 = $this->db->get();

                        if ($schoolactivity2->num_rows() > 0) {
                            foreach ($schoolactivity2->result() as $schoolactivitys2) {
                                $schoolactivity_id2 = $schoolactivitys2->id;
                            }
                        } else {
                            $schoolactivityinsert2 = array(
                                'activity_name' => $_POST['activity2']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert2);

                            $this->db->select('*')->where('activity_name =', $_POST['activity2']);
                            $this->db->from('school_activities');
                            $schoolactivity2 = $this->db->get();

                            foreach ($schoolactivity2->result() as $schoolactivitys2) {
                                $schoolactivity_id2 = $schoolactivitys2->id;
                            }
                        }

                        $schoolactivityinsert2 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id2,
                            'images' => $activity2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert2);
                    }
                }
            }

            // activity3 image save
            if (isset($_FILES['activityimage3']['name'])) {
                $activity3 = $_FILES['activityimage3']['name'];
                $activity3_ext = pathinfo($activity3, PATHINFO_EXTENSION);

                $activity3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity3_ext;
                $activity3_type = $_FILES['activityimage3']['type'];
                $activity3_size = $_FILES['activityimage3']['size'];
                $activity3_tem_loc = $_FILES['activityimage3']['tmp_name'];
                $activity3_store = FCPATH . "/laravel/public/" . $activity3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity3_ext, $allowed)) {
                    if (move_uploaded_file($activity3_tem_loc, $activity3_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity3']);
                        $this->db->from('school_activities');
                        $schoolactivity3 = $this->db->get();

                        if ($schoolactivity3->num_rows() > 0) {
                            foreach ($schoolactivity3->result() as $schoolactivitys3) {
                                $schoolactivity_id3 = $schoolactivitys3->id;
                            }
                        } else {
                            $schoolactivityinsert3 = array(
                                'activity_name' => $school['activity3']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert3);

                            $this->db->select('*')->where('activity_name =', $_POST['activity3']);
                            $this->db->from('school_activities');
                            $schoolactivity3 = $this->db->get();

                            foreach ($schoolactivity3->result() as $schoolactivitys3) {
                                $schoolactivity_id3 = $schoolactivitys3->id;
                            }
                        }

                        $schoolactivityinsert3 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id3,
                            'images' => $activity3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert3);
                    }
                }
            }

            // activity4 image save
            if (isset($_FILES['activityimage4']['name'])) {
                $activity4 = $_FILES['activityimage4']['name'];
                $activity4_ext = pathinfo($activity4, PATHINFO_EXTENSION);

                $activity4_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity4_ext;
                $activity4_type = $_FILES['activityimage4']['type'];
                $activity4_size = $_FILES['activityimage4']['size'];
                $activity4_tem_loc = $_FILES['activityimage4']['tmp_name'];
                $activity4_store = FCPATH . "/laravel/public/" . $activity4_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity4_ext, $allowed)) {
                    if (move_uploaded_file($activity4_tem_loc, $activity4_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity4']);
                        $this->db->from('school_activities');
                        $schoolactivity4 = $this->db->get();

                        if ($schoolactivity4->num_rows() > 0) {
                            foreach ($schoolactivity4->result() as $schoolactivitys4) {
                                $schoolactivity_id4 = $schoolactivitys4->id;
                            }
                        } else {
                            $schoolactivityinsert4 = array(
                                'activity_name' => $school['activity4']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert4);

                            $this->db->select('*')->where('activity_name =', $_POST['activity4']);
                            $this->db->from('school_activities');
                            $schoolactivity4 = $this->db->get();

                            foreach ($schoolactivity4->result() as $schoolactivitys4) {
                                $schoolactivity_id4 = $schoolactivitys4->id;
                            }
                        }

                        $schoolactivityinsert4 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id4,
                            'images' => $activity4_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert4);
                    }
                }
            }

            // facility1 image save
            if (isset($_FILES['facilityimage1']['name'])) {
                $facility1 = $_FILES['facilityimage1']['name'];
                $facility1_ext = pathinfo($facility1, PATHINFO_EXTENSION);

                $facility1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility1_ext;
                $facility1_type = $_FILES['facilityimage1']['type'];
                $facility1_size = $_FILES['facilityimage1']['size'];
                $facility1_tem_loc = $_FILES['facilityimage1']['tmp_name'];
                $facility1_store = FCPATH . "/laravel/public/" . $facility1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
                if (in_array($facility1_ext, $allowed)) {
                    if (move_uploaded_file($facility1_tem_loc, $facility1_store)) {
                        $schoolfaciltyinsert1 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility1'],
                            'content' => $school['facilitydes1'],
                            'image' => $facility1_name,
                            'is_active' => 1
                        );
                        $this->db->insert('school_facilities', $schoolfaciltyinsert1);
                    }
                }
            }

            // facility2 image save
            if (isset($_FILES['facilityimage2']['name'])) {
                $facility2 = $_FILES['facilityimage2']['name'];
                $facility2_ext = pathinfo($facility2, PATHINFO_EXTENSION);

                $facility2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility2_ext;
                $facility2_type = $_FILES['facilityimage2']['type'];
                $facility2_size = $_FILES['facilityimage2']['size'];
                $facility2_tem_loc = $_FILES['facilityimage2']['tmp_name'];
                $facility2_store = FCPATH . "/laravel/public/" . $facility2_name;
                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility2_ext, $allowed)) {
                    if (move_uploaded_file($facility2_tem_loc, $facility2_store)) {
                        $schoolfaciltyinsert2 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility2'],
                            'content' => $school['facilitydes2'],
                            'image' => $facility2_name,
                            'is_active' => 1
                        );
                        
                        $this->db->insert('school_facilities', $schoolfaciltyinsert2);
                    }
                }
            }

            // facility3 image save
            if (isset($_FILES['facilityimage3']['name'])) {
                $facility3 = $_FILES['facilityimage3']['name'];
                $facility3_ext = pathinfo($facility3, PATHINFO_EXTENSION);

                $facility3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility3_ext;
                $facility3_type = $_FILES['facilityimage3']['type'];
                $facility3_size = $_FILES['facilityimage3']['size'];
                $facility3_tem_loc = $_FILES['facilityimage3']['tmp_name'];
                $facility3_store = FCPATH . "/laravel/public/" . $facility3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility3_ext, $allowed)) {
                    if (move_uploaded_file($facility3_tem_loc, $facility3_store)) {
                        $schoolfaciltyinsert3 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility3'],
                            'content' => $school['facilitydes3'],
                            'image' => $facility3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_facilities', $schoolfaciltyinsert3);
                    }
                }
            }

            // facility4 image save
            if (isset($_FILES['facilityimage4']['name'])) {
                $facility4 = $_FILES['facilityimage4']['name'];
                $facility4_ext = pathinfo($facility4, PATHINFO_EXTENSION);

                $facility4_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility4_ext;
                $facility4_type = $_FILES['facilityimage4']['type'];
                $facility4_size = $_FILES['facilityimage4']['size'];
                $facility4_tem_loc = $_FILES['facilityimage4']['tmp_name'];
                $facility4_store = FCPATH . "/laravel/public/" . $facility4_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility4_ext, $allowed)) {
                    if (move_uploaded_file($facility4_tem_loc, $facility4_store)) {
                        $schoolfaciltyinsert4 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility4'],
                            'content' => $school['facilitydes4'],
                            'image' => $facility4_name,
                            'is_active' => 1
                        );
                        $this->db->insert('school_facilities', $schoolfaciltyinsert1);
                    }
                }
            }
            // gallery image save
            if (isset($_FILES['mytext']['name'])) {
                $gallaryimage = $_FILES['mytext']['name'];
                $gallarytype = $_FILES['mytext']['type'];
                $gallarysize = $_FILES['mytext']['size'];
                $gallarytmp_name = $_FILES['mytext']['tmp_name'];



                if (is_array($gallaryimage)) {
                    for ($i = 0; $i < count($gallaryimage); $i++) {
                        $gallary1image = $gallaryimage[$i];
                        $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

                        $gallary1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                        $gallary1_type = $gallarytype[$i];
                        $gallary1_size = $gallarysize[$i];
                        $gallary1_tem_loc = $gallarytmp_name[$i];
                        $gallary1_store = FCPATH . "/laravel/public/" . $gallary1_name;

                        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                        if (in_array($gallary1_ext, $allowed)) {
                            if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                                $schoolgallaryinsert1 = array(
                                    'school_id' => $school_id,
                                    'school_activity_id' => 71,
                                    'images' => $gallary1_name,
                                    'is_active' => 1
                                );

                                $this->db->insert('school_images', $schoolgallaryinsert1);
                            }
                        }
                    }
                }
            }

            $user = $this->db->get_where('user_register', array('id' => $_POST['user_id']));
            foreach ($user->result() as $users) {
                $user_name = $users->name;
                $user_email = $users->email;
                $user_phone = $users->phone;
            }
            redirect('admin/schools');
        }


        // insert activity clasees
        if($_POST['category'] == 'summer_class'){

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

            $banner1 = $_FILES['banner1']['name'];
            $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $banner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            $banner1_type = $_FILES['banner1']['type'];
            $banner1_size = $_FILES['banner1']['size'];
            $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
            $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($banner1_ext, $allowed)) {

                if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                    
                }
            }


            $newsbanner1 = $_FILES['newsbanner']['name'];
            $newsbanner1_ext = pathinfo($newsbanner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $newsbanner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $newsbanner1_ext;
            $newsbanner1_type = $_FILES['newsbanner']['type'];
            $newsbanner1_size = $_FILES['newsbanner']['size'];
            $newsbanner1_tem_loc = $_FILES['newsbanner']['tmp_name'];
            $newsbanner1_store = FCPATH . "/laravel/public/" . $newsbanner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($newsbanner1_ext, $allowed)) {

                if (move_uploaded_file($newsbanner1_tem_loc, $newsbanner1_store)) {
                    $newsbanner1_name = $newsbanner1_name;
                }
            }

            if($_POST['position_id'] = 1){
                $paid = 65000;
            }else if($_POST['position_id'] = 2){
                $paid = 30000;
            }else if($_POST['position_id'] = 1){
                $paid = 12000;
            }else if($_POST['position_id'] = 1){
                $paid = 0;
            }

           
            if(isset($_POST['status']) == 1){
                $status = 1;
                $act_date = date('Y-m-d H:i:s');
            }else{
                $status = null;
                $act_date = null;
            }

            if($_POST['position_id'] == 4){
                $validity = 30;
            }else{
                $validity = 100;
            }
            $schoolinsert = array(
                'category_id' => $category_id,
                'position_id' => $_POST['position_id'],
                'status' => $status,
                'institute_name' => $_POST['institutename'],
                'slug' => $_POST['institutename'],
                'mobile' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'user_id' => $user_id,
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
                'paid' => $paid,
                'news_image' => $newsbanner1_name,
                'activated_at' => $act_date,
                'is_active' => 1,
                'valitity'=> $validity,
            );

            $this->db->insert('institute_details', $schoolinsert);

            $this->db->select('*')->where('slug =', $_POST['institutename']);
            $this->db->from('institute_details');
            $schooldetail = $this->db->get();
            foreach ($schooldetail->result() as $schooldetails) {
                $school_id = $schooldetails->id;
            }


            //aboutimage
            $aboutimage = $_FILES['aboutimage']['name'];
            $aboutimage_ext = pathinfo($aboutimage, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $aboutimage_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $aboutimage_ext;
            $aboutimage_type = $_FILES['aboutimage']['type'];
            $aboutimage_size = $_FILES['aboutimage']['size'];
            $aboutimage_tem_loc = $_FILES['aboutimage']['tmp_name'];
            $aboutimage_store = FCPATH . "/laravel/public/" . $aboutimage_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($aboutimage_ext, $allowed)) {

                if (move_uploaded_file($aboutimage_tem_loc, $aboutimage_store)) {
                    $banner2insert = array(
                        'institute_id' => $school_id,
                        'category_id' => 1,
                        'image' => $aboutimage_name,
                        'is_active' => 1
                    );

                    $this->db->insert('institute_images', $banner2insert);
                }
            }
            // banner1 image save
            if (isset($_FILES['banner1']['name'])) {
                $banner1 = $_FILES['banner1']['name'];
                $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
                $banner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
                $banner1_type = $_FILES['banner1']['type'];
                $banner1_size = $_FILES['banner1']['size'];
                $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
                $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');

                if (in_array($banner1_ext, $allowed)) {

                    if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {


                        $banner1insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner1insert);

                        $admission = array(
                            'institute_id' => $school_id,
                            'image' => $banner1_name,
                            'content' => 'Admissions for the Academic year 2019-20 commences.',
                            'is_active' => 1
                        );

                        $this->db->insert('institute_admissions', $admission);
                    }
                }
            }


            // exit();
            // banner2 image save
            if (isset($_FILES['banner2']['name'])) {
                $banner2 = $_FILES['banner2']['name'];
                $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

                $banner2_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
                $banner2_type = $_FILES['banner2']['type'];
                $banner2_size = $_FILES['banner2']['size'];
                $banner2_tem_loc = $_FILES['banner2']['tmp_name'];
                $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
            // echo $file_type;
            // exit();
                if (in_array($banner2_ext, $allowed)) {
                    if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                        $banner2insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner2insert);
                    }
                }
            }

            // banner3 image save
            if (isset($_FILES['banner3']['name'])) {
                $banner3 = $_FILES['banner3']['name'];
                $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

                $banner3_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
                $banner3_type = $_FILES['banner3']['type'];
                $banner3_size = $_FILES['banner3']['size'];
                $banner3_tem_loc = $_FILES['banner3']['tmp_name'];
                $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
            // echo $file_type;
            // exit();
                if (in_array($banner3_ext, $allowed)) {
                    if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                        $banner3insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner3insert);
                    }
                }
            }


            if (!empty($_POST['founded'])) {
                $foundedinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'founded.png',
                    'heading' => 'Founded',
                    'content' => $_POST['founded'],
                    'brief_content' => $_POST['founded'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $foundedinsert);
            }



            if (!empty($_POST['special'])) {
                $specialinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'special.png',
                    'heading' => 'Special',
                    'content' => $_POST['special'],
                    'brief_content' => $_POST['special'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $specialinsert);
            }

            if (!empty($_POST['students'])) {
                $studentsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'students.png',
                    'heading' => 'Students',
                    'content' => $_POST['students'],
                    'brief_content' => $_POST['students'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $studentsinsert);
            }

            if (!empty($_POST['events'])) {
                $eventsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'Events.png',
                    'heading' => 'Events',
                    'content' => $_POST['events'],
                    'brief_content' => $_POST['events'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $eventsinsert);
            }

            if (!empty($_POST['achievements'])) {
                $achievementsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'achievements.png',
                    'heading' => 'Achievements',
                    'content' => $_POST['achievements'],
                    'brief_content' => $_POST['achievements'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $achievementsinsert);
            }

            if (!empty($_POST['teachers'])) {
                $teachersinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'teachers.png',
                    'heading' => 'Teachers',
                    'content' => $_POST['teachers'],
                    'brief_content' => $_POST['teachers'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $teachersinsert);
            }

            if (!empty($_POST['branches'])) {
                $branchesinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'branch.png',
                    'heading' => 'Branches',
                    'content' => $_POST['branches'],
                    'brief_content' => $_POST['branches'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $branchesinsert);
            }

            if (!empty($_POST['languages'])) {
                $languageinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'language.png',
                    'heading' => 'Language',
                    'content' => $_POST['languages'],
                    'brief_content' => $_POST['languages'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $languageinsert);
            }

            if (!empty($_POST['customRadioInline1'])) {
                
                if ($_POST['customRadioInline1'] == "yes") {
                    $activityinsert = array(
                        'institute_id' => $school_id,
                        'icon' => 'activity.png',
                        'heading' => 'Trainer',
                        'content' => 'Personal Trainer',
                        'brief_content' => 'Personal Trainer',
                        'is_active' => 1
                    );
                    $this->db->insert('institute_platinum_datas', $activityinsert);
                }
            }

            // activity image save
            $activity = $_POST['categoryname'];
            $activitydesc = $_POST['categorydesc'];
            $activityimage = $_FILES['categoryimage']['name'];
            $activitytype = $_FILES['categoryimage']['type'];
            $activitysize = $_FILES['categoryimage']['size'];
            $activitytmp_name = $_FILES['categoryimage']['tmp_name'];

            if (is_array($activity)) {
                for ($i = 0; $i < count($activity); $i++) {
                    // print ($activity[$i]);
                    // if(isset($_FILES['activityimage1']['name']))
                    // {
                    $activity1 = $activityimage[$i];
                    $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                    $activity1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                    $activity1_type = $activitytype[$i];
                    $activity1_size = $activitysize[$i];
                    $activity1_tem_loc = $activitytmp_name[$i];
                    $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                    if (in_array($activity1_ext, $allowed)) {
                        if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {

                            $this->db->select('*')->where('program_name =', $activity[$i]);
                            $this->db->from('institute_programs');
                            $schoolactivity1 = $this->db->get();

                            if ($schoolactivity1->num_rows() > 0) {
                                foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                    $schoolactivity_id1 = $schoolactivitys1->id;
                                }
                            } else {
                                $schoolactivityinsert1 = array(
                                    'program_name' => $activity[$i]
                                );

                                $this->db->insert('institute_programs', $schoolactivityinsert1);

                                $this->db->select('*')->where('program_name =', $activity[$i]);
                                $this->db->from('institute_programs');
                                $schoolactivity1 = $this->db->get();

                                foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                    $schoolactivity_id1 = $schoolactivitys1->id;
                                }
                            }

                            $schoolactivityinsert1 = array(
                                'institute_id' => $school_id,
                                'program_id' => $schoolactivity_id1,
                                'image' => $activity1_name,
                                'about' => $activitydesc[$i],
                                'is_active' => 1
                            );

                            $this->db->insert('program_details', $schoolactivityinsert1);
                        }
                    }
                    // }
                }
            }


            // gallery image save
            if (isset($_FILES['mytext']['name'])) {
                $gallaryimage = $_FILES['mytext']['name'];
                $gallarytype = $_FILES['mytext']['type'];
                $gallarysize = $_FILES['mytext']['size'];
                $gallarytmp_name = $_FILES['mytext']['tmp_name'];



                if (is_array($gallaryimage)) {
                    for ($i = 0; $i < count($gallaryimage); $i++) {
                        $gallary1image = $gallaryimage[$i];
                        $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

                        $gallary1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                        $gallary1_type = $gallarytype[$i];
                        $gallary1_size = $gallarysize[$i];
                        $gallary1_tem_loc = $gallarytmp_name[$i];
                        $gallary1_store = FCPATH . "/laravel/public/" . $gallary1_name;

                        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                        if (in_array($gallary1_ext, $allowed)) {
                            if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                                $schoolgallaryinsert1 = array(
                                    'institute_id' => $school_id,
                                    'category_id' => 2,
                                    'image' => $gallary1_name,
                                    'is_active' => 1
                                );

                                $this->db->insert('institute_images', $schoolgallaryinsert1);
                            }
                        }
                    }
                }
            }

            // news & events save
            $news = $_POST['newsheading'];
            $newsdesc = $_POST['newsdesc'];


            if (is_array($news)) {
                for ($i = 0; $i < count($news); $i++) {

                    $newsinsert = array(
                        'institute_id' => $school_id,
                        'news' => $news[$i],
                        'news_brief' => $newsdesc[$i],
                        'is_active' => 1
                    );

                    $this->db->insert('institute_news', $newsinsert);
                }
            }

            // $user = $this->db->get_where('user_register', array('id' => $_POST['user_id']));
            // foreach ($user->result() as $users) {
            //     $user_name = $users->name;
            //     $user_email = $users->email;
            //     $user_phone = $users->phone;
            // }
            redirect("schools/admin/institute");
        }

    }

    function email_exist(){
        $this->db->select('*')->where('email =', $_POST['email']);
        $this->db->from('user_register');
        $email = $this->db->get()->result();
        if (count($email) > 0) {
                // echo json_encode(array('status' => 'success', 'data' => array("mobile" => $mobile,"contact_email" => $data['email'],"user_id" => $user_id)));
                // die;
            // } else {
                echo json_encode(array('status' => 'error', "message" => array("text" => "Try using another contact info !!!", "title" => "User Already Exist")));
            //     die;
            //     $this->load->view('sign-up-school', $data);
            // }
        }
    }

    function school_datatable($is_total_count = 0, $is_count = 0){
        $data = $input_arr = array();
		$input_data = $this->input->post();
        

		if(isset($_POST["length"])){

            $column = array('','ur.name','sd.school_name','ci.city_name','sd.school_category_id','sd.paid','sd.created_at','sd.status');
            $input_arr['search_val'] = $input_data['search']['value'];
            $input_arr['order_column'] = $column[$input_data['order'][0]['column']];
            $input_arr['order_by'] = $input_data['order'][0]['dir'];
            $input_arr['start'] = $input_data['start'];
            $input_arr['length'] = $input_data['length'];

            $where ='';
            $searchVal = trim($input_arr['search_val']);
            $searchCol= array('ur.name','sd.school_name','sd.paid','sd.created_at');
            if($searchVal != null && $searchVal != ''){
                $where .='(';
                $i=0;
                foreach($searchCol as $s){
                    if($i != 0){
                        $where .=' OR ';
                    }
                    $where .='(';
                    $where .= $s.' = "'.$searchVal.'" or '.$s.' LIKE "%'.$searchVal.'%"';
                    $i++;
                    $where .=')';
                }
                $where .=')';
            }


            $this->db->select('sd.id,sd.school_name,ci.city_name,sd.created_at,ur.name as user,sd.status,sd.paid,sd.school_category_id,sd.activated_at');
            $this->db->where('sd.deleted_at',NULL);
            $this->db->from('school_details as sd');
            if($input_data['type'] == 'approved'){
                $this->db->where('sd.status',1);
            }
            if($input_data['type'] == 'hold'){
                $this->db->where('sd.status',NULL);
            }
            if($input_data['type'] == 'reject'){
                $this->db->where('sd.status',2);
            }
            $this->db->join('user_register as ur', 'sd.user_id = ur.id', 'left');
            $this->db->join('cities as ci','sd.city_id=ci.id','left');
            if($searchVal != null && $searchVal != ''){
                $this->db->where($where);
            }
            $this->db->order_by($input_arr['order_column'],$input_arr['order_by']);
            if($input_arr['length'] != -1)
                $this->db->limit($input_arr['length'],$input_arr['start']);
            $school_data = $this->db->get()->result_array();

            $sno = $input_data['start'] + 1;
            foreach($school_data as $school){
                $row = array();

                $edit =  "<div class='btn-wid'><a title='Edit' href='". base_url("schools/admin/school_edit?id=". base64_encode($school["id"]))."' class='btn btn-outline-info btn-sm'><i class='bi bi-pencil'></i></a>";
                $delete = "<a title='Delete' href='' delete_id='".base64_encode($school["id"])."' class='delete btn btn-outline-danger delete btn-sm' id='del_btn'><i class='bi bi-trash'></i></a>";
                $view = "<a title='View' href='". base_url("admin/schools/view_school?id=". base64_encode($school["id"]))."'  class='btn btn-outline-dark btn-sm'><i class='bi bi-eye'></i></a></div>";

                $row[] = $sno;
                $row[] = ucfirst($school['user']);
                $row[] = ucfirst($school['school_name']);
                $row[] = ucfirst($school['city_name']);
                
                if($school['school_category_id'] == 1){$row[] = "PLATINUM";}
                else if($school['school_category_id'] == 2){$row[] = "PREMIUM";}
                else if($school['school_category_id'] == 3){$row[] = "SPECTRUM";}
                else{ $row[] = "TRIAL";}

                $row[] = $school['paid'];
                $row[] = date('d-m-Y',strtotime($school['created_at']));
                
                // if($school['status'] == 1){$row[] = "Approved";}
                // else if($school['status'] == 2){$row[] = "Rejected";}
                // else { $row[] = "Waiting for validation";}

                if($school['status'] == 1){
                    if($school['school_category_id'] == 4){
                    $date = strtotime($school['activated_at']);
                    $date = strtotime("+30 day", $date);
                    $row[] = date('d-m-Y', $date);
                    }else{
                        $date = strtotime($school['activated_at']);
                        $date = strtotime("+100 day", $date);
                        $row[] = date('d-m-Y', $date);
                    }
                }else{
                    $row[] = "-";
                }
                $row[] = $edit . '&nbsp;&nbsp;' . $delete . '&nbsp;&nbsp;' . $view;

                $data[] = $row;
                $sno++;
            }
        }   
        $this->db->select('sd.id,sd.school_name,ci.city_name,sd.created_at,ur.name as user,sd.status,sd.paid,sd.school_category_id');
        $this->db->from('school_details sd');
        $this->db->join('user_register ur', 'sd.user_id = ur.id', 'left');
        $this->db->join('cities as ci','sd.city_id=ci.id','left');
        if($searchVal != null && $searchVal != ''){
			$this->db->where($where);
		}
        if($is_total_count == 1)
			return $this->db->count_all_results();
		
		if($is_count == 1)
			return $this->db->get()->num_rows();
		
		$this->db->order_by($input_arr['order_column'],$input_arr['order_by']);
        // if($input_arr['length'] != -1)
		//     $this->db->limit($input_arr['length'],$input_arr['start']);
		$query = $this->db->get();

        // $school_data = $this->db->get()->result_array();
        $output = array(
            "draw" => $input_data['draw'],
            "recordsTotal" => count($school_data),
            "recordsFiltered" => count($school_data),
            "data" => $data,
        );
        echo json_encode($output);exit;
    }

    function class_datatable($is_total_count = 0, $is_count = 0){

        $data = $input_arr = array();
		$input_data = $this->input->post();

		if(isset($_POST["length"])){

            $column = array('','ur.name','in.institute_name','ci.city_name','in.position_id','in.paid','in.created_at','in.status');
            $input_arr['search_val'] = $input_data['search']['value'];
            $input_arr['order_column'] = $column[$input_data['order'][0]['column']];
            $input_arr['order_by'] = $input_data['order'][0]['dir'];
            $input_arr['start'] = $input_data['start'];
            $input_arr['length'] = $input_data['length'];
			
            $where ='';
            $searchVal = trim($input_arr['search_val']);
		    $searchCol= array('ur.name','in.institute_name','in.paid','in.created_at');
            if($searchVal != null && $searchVal != ''){
                $where ='';
                $where .='(';
                $i=0;
                foreach($searchCol as $s){
                    if($i != 0){
                        $where .='OR';
                    }
                    $where .='(';
                    $where .= $s.' = "'.$searchVal.'" or '.$s.' LIKE "%'.$searchVal.'%"';
                    $i++;
                    $where .=')';
                }
                $where .=')';
            }

            $this->db->select('in.id,in.institute_name,ci.city_name,in.created_at,ur.name as user,in.status,in.paid,in.position_id,in.activated_at');
            $this->db->where('in.deleted_at',NULL);
            $this->db->from('institute_details as in');
            if($input_data['type'] == 'approved'){
                $this->db->where('in.status',1);
            }
            if($input_data['type'] == 'hold'){
                $this->db->where('in.status',NULL);
            }
            if($input_data['type'] == 'reject'){
                $this->db->where('in.status',2);
            }
            $this->db->join('user_register as ur', 'in.user_id = ur.id', 'left');
            $this->db->join('cities as ci','in.city_id=ci.id','left');
            if($searchVal != null && $searchVal != ''){
                $this->db->where($where);
            }
            $this->db->order_by($input_arr['order_column'],$input_arr['order_by']);
            if($input_arr['length'] != -1)
            $this->db->limit($input_arr['length'],$input_arr['start']);
            $institute_data = $this->db->get()->result_array();

            $sno = $input_data['start'] + 1;
            foreach($institute_data as $institute){
                $row = array();

                $edit = "<div class='btn-wid'><a title='Edit' href='". base_url("admin/schools/institute_edit?id=". base64_encode($institute["id"]))."' class='btn btn-outline-info btn-sm'><i class='bi bi-pencil'></i></a>";
                $delete = "<a title='Delete' href='' delete_id='".base64_encode($institute["id"])."' class=' btn btn-outline-danger btn-sm delete'><i class='bi bi-trash'></i></a>";
                $view = "<a title='View' href='". base_url("admin/schools/view_activityclass?id=". base64_encode($institute["id"]))."'   class='btn btn-outline-dark btn-sm'><i class='bi bi-eye'></i></a></div>";

                $row[] = $sno;
                $row[] = ucfirst($institute['user']);
                $row[] = ucfirst($institute['institute_name']);
                $row[] = ucfirst($institute['city_name']);

                
                if($institute['position_id'] == 1){$row[] = "PLATINUM";}
                else if($institute['position_id'] == 2){$row[] = "PREMIUM";}
                else if($institute['position_id'] == 3){$row[] = "SPECTRUM";}
                else{ $row[] = "TRIAL";}

                $row[] = $institute['paid'];
                $row[] = date('d-m-Y',strtotime($institute['created_at']));
                
                // if($institute['status'] == 1){$row[] = "Approved";}
                // else if($institute['status'] == 2){$row[] = "Rejected";}
                // else { $row[] = "Waiting for validation";}

                if($institute['status'] == 1){
                    if($institute['position_id'] == 4){
                    $date = strtotime($institute['activated_at']);
                    $date = strtotime("+30 day", $date);
                    $row[] = date('d-m-Y', $date);
                    }else{
                        $date = strtotime($institute['activated_at']);
                        $date = strtotime("+100 day", $date);
                        $row[] = date('d-m-Y', $date);
                    }
                }else{
                    $row[] = "-";
                }
                $row[] = $edit . '&nbsp;&nbsp;' . $delete . '&nbsp;&nbsp;' . $view;

                $data[] = $row;
                $sno++;
            }
        }

        $this->db->select('in.id,in.institute_name,ci.city_name,in.created_at,ur.name as user,in.status,in.paid,in.position_id');
        $this->db->from('institute_details in');
        $this->db->join('user_register ur', 'in.user_id = ur.id', 'left');
        $this->db->join('cities as ci','in.city_id=ci.id','left');
        if($searchVal != null && $searchVal != ''){
			$this->db->where($where);
		}
        if($is_total_count == 1)
			return $this->db->count_all_results();
		
		if($is_count == 1)
			return $this->db->get()->num_rows();
		
		$this->db->order_by($input_arr['order_column'],$input_arr['order_by']);
		// $this->db->limit($input_arr['length'],$input_arr['start']);
		$query = $this->db->get();

        // $school_data = $this->db->get()->result_array();
        $output = array(
            "draw" => $input_data['draw'],
            "recordsTotal" => count($institute_data),
            "recordsFiltered" => count($institute_data),
            "data" => $data,
        );
        echo json_encode($output);exit;
        
        
    }   
    
}
?>