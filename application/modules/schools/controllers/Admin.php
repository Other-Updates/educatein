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
                . 'st.school_type as "School Type",sc.category_name as Catergory, sd.grade as Grade, sd.about as About, sd.website_url as Website,sd.map_url as Map, sd.year_of_establish as Establishment,'
                . 'sd.our_mission as Mission, sd.our_vision as Vision, sd.our_motto as Motto,  sd.ad as AD, sd.type as Type, (CASE WHEN sd.hostel=1 THEN "YES" WHEN sd.hostel=0 THEN "No"   ELSE "" END ) AS Hostel, '
                . 'sd.rte as "RTE Act.",sd.students as "No of Students", sd.boys as Boys, sd.girls as Girls, sd.teachers as Teachers, sd.facebook, sd.twitter, sd.instagram, sd.linkedin, sd.pinterest, '
                . '(CASE WHEN sd.is_active=1 THEN "YES" WHEN sd.is_active=0 THEN "No"   ELSE "" END ) AS Status , sd.view_count as Views,date_format( sd.activated_at, "%d-%m-%Y") as "Activated On", '
                . ' date_format( sd.valitity, "%d-%m-%Y") as Validity,  date_format( sd.created_at, "%d-%m-%Y") as "Created On"  '; 
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

}
