<?php

class Base_Model extends CI_Model {
    /*     * *	Function to get table rows with conditions and limit ** */

    public function get_records($table, $fields = array('*'), $conditions = array(), $return = 'result_array', $sort_field = null, $order_by = 'desc', $group_by = array(), $limit_start = null, $limit_end = null, $remove_apos = true) {
        $this->db->select($fields, $remove_apos);
        $this->db->from($table);
        if (!empty($conditions)) {
            foreach ($conditions as $key => $cond) {
                if (!isset($cond[3]))
                    $cond[3] = "where";
                if ($cond[0]) {
                    if (isset($cond[4])) {
                        $this->db->$cond[3]($cond[1], $cond[2], $cond[4]);
                    } else {
                        $cond1 = $cond[1];
                        $cond2 = $cond[2];
                        $cond3 = $cond[3];
                        $this->db->$cond3($cond1, $cond2);
                    }
                } else
                    $this->db->$cond[3]($cond[1]);
            }
        }
        if (!$sort_field)
            $this->db->order_by('id', $order_by);
        else
            $this->db->order_by($sort_field, $order_by);
        if ($group_by)
            $this->db->group_by($group_by);

        if ($limit_start != '' || $limit_end != '')
            $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
        $return = ($return) ? $return : 'result_array';
        return $query->$return();
    }

    public function get_record_by_id($table_name, $select, $where, $all_rec = false, $order_by = array()) {
        $this->db->select($select);
        if (is_array($where))
            $this->db->where($where);
        else
            $this->db->where('(' . $where . ')');
        if (!empty($order_by)) {
            if ($order_by['field'] && $order_by['sort'])
                $this->db->order_by($order_by['field'], $order_by['sort']);
        }
        $query = $this->db->get($table_name);
        if ($all_rec)
            return $query->result_array();
        else
            return $query->row_array();
    }

    public function update($table, $dataArray, $whereArray) {
        if (!empty($whereArray))
            $this->db->where($whereArray);
        $this->db->update($table, $dataArray);
        return $this->db->affected_rows();
    }

    /*     * *    Function to insert and get last insert id in return ** */

    public function insert($table, $insert_array) {
        $return_var = false;
        $this->db->trans_start();
        $insert_response = $this->db->insert($table, $insert_array);
        if ($insert_response) {
            $insert_id = $this->db->insert_id();
            $return_var = $insert_id;
        }
        $this->db->trans_complete();
        return $return_var;
    }

    /*     * * Function to get table rows with conditions and limit ** */

    public function getAdvanceList($table, $join_tables = array(), $fields = array('*'), $conditions = array(), $return = array('return' => 'result_array'), $sort_field = null, $order_by = 'desc', $group_by = array(), $limit_start = null, $limit_end = null, $remove_apos = true) {
        /*         * ** Paramenters *** */
        /*         * * 1 table = Main Table
          2 join_tables =    Join table name
          3 Fields = required fields
          4 conditions = Where Conditions
          5 return = return array
          6 sort_field
          7 order_by
          8 group_by
          9 limit_start=null
          10 limit_end=null
          11 apostrepe  *** */

        $this->db->select($fields, $remove_apos);
        $this->db->from($table);

        if (!empty($join_tables)) {
            foreach ($join_tables as $joins) {
                $this->db->join($joins['table_name'], $joins['table_condition'], $joins['table_type']);
            }
        }
        if (!empty($conditions)) {
            foreach ($conditions as $key => $cond) {

                if (!$cond['direct']) {
                    if (isset($cond['adv']))
                        $this->db->$cond['rule']($cond['field'], $cond['value'], $cond['adv']);
                    else
                        $this->db->$cond['rule']($cond['field'], $cond['value']);
                } else
                    $this->db->$cond['rule']($cond['value']);
            }
        }
        if ($group_by)
            $this->db->group_by($group_by);

        if ($return['return'] != 'num_rows') {
            if ($sort_field && $order_by)
                $this->db->order_by($sort_field, $order_by);
            if ($limit_start != '' || $limit_end != '')
                $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();
        $return_result = $return['return'];
        return $query->$return_result();
    }

    /*     * * Function to get table rows with conditions and limit ** */
    /*     * ** Paramenters *** */
    /*     * * 1 table = Main Table
      2 join_tables =    Join table name
      3 Fields = required fields
      4 conditions = Where Conditions
      5 return = return array
      6 sort_field
      7 order_by
      8 group_by
      9 limit_start=null
      10 limit_end=null
      11 apostrepe  *** */

    /*     * * Condition params 
      0. direct
      1. Field
      2. value
      3. rule
      4. advance rule
     * * */

    public function get_advance_list($table, $join_tables = array(), $fields = array('*'), $conditions = array(), $return = 'result_array', $sort_field = null, $order_by = 'desc', $group_by = array(), $limit_start = null, $limit_end = null, $remove_apos = true) {
        $this->db->select($fields, $remove_apos);
        $this->db->from($table);

        if (!empty($join_tables)) {
            foreach ($join_tables as $joins) {
                if (!isset($joins[2]))
                    $joins[2] = 'left';
                $this->db->join($joins[0], $joins[1], $joins[2]);
            }
        }
        if (!empty($conditions)) {
            foreach ($conditions as $key => $cond) {
                if (!isset($cond[3]))
                    $cond[3] = "where";

                if ($cond[0]) {
                    if (isset($cond[4])) {
                        $this->db->$cond[3]($cond[1], $cond[2], $cond[4]);
                    } else {
                        $cond1 = $cond[1];
                        $cond2 = $cond[2];
                        $cond3 = $cond[3];
                        $this->db->$cond3($cond1, $cond2);
                    }
                } else {
                    $cond1 = $cond[1];
                    $cond3 = $cond[3];
                    $this->db->$cond3($cond1);
                }
            }
        }
        if ($group_by)
            $this->db->group_by($group_by);

        if ($return != 'num_rows') {
            if ($sort_field && $order_by)
                $this->db->order_by($sort_field, $order_by);
            if ($limit_start != '' || $limit_end != '')
                $this->db->limit($limit_start, $limit_end);
        }

        $query = $this->db->get();
        $return = ($return) ? $return : 'result_array';
        return $query->$return();
    }

    /*     * *    Function to check exist record and insert and get last insert id in return ** */

    public function CheckExistAndInsert($table, $insert_array, $checkArray) {
        $count = $this->getCount($table, $checkArray);
        if (!$count) {
            $return_var = false;
            $this->db->trans_start();
            $insert_response = $this->db->insert($table, $insert_array);
            if ($insert_response) {
                $insert_id = $this->db->insert_id();
                $return_var = $insert_id;
            }
            $this->db->trans_complete();
            return $return_var;
        } else {
            return true;
        }
    }

    /*     * *    Function to get count  ** */

    public function getCount($table, $where) {
        if (is_array($where))
            $this->db->where($where);
        else
            $this->db->where('(' . $where . ')');
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    /*     * *    Function to check exist record and insert and get last insert id in return ** */

    public function CheckExistAndUpdate($table, $insert_array, $checkArray) {
        $count = $this->get_records($table, 'id', $checkArray, 'row_array');
        if (!empty($count) && $count['id']) {
            $return_var = false;
            $this->db->trans_start();
            if (isset($insert_array['created']))
                unset($insert_array['created']);
            $insert_response = $this->db->update($table, $insert_array, array('id' => $count['id']));
            if ($insert_response) {
                $insert_id = $this->db->insert_id();
                $return_var = $insert_id;
            }
            $this->db->trans_complete();
            return $return_var;
        } else {
            $this->db->trans_start();
            $this->db->insert($table, $insert_array);
            $this->db->trans_complete();
            return true;
        }
    }

    public function CheckExistAndInsertAndRerturnId($table, $insert_array, $checkArray) {
        $count = $this->getCount($table, $checkArray);

        if (!$count) {
            $return_var = false;
            $this->db->trans_start();
            $insert_response = $this->db->insert($table, $insert_array);
            if ($insert_response) {
                $insert_id = $this->db->insert_id();
                $return_var = $insert_id;
            }
            $this->db->trans_complete();
            return $return_var;
        } else {
            $count = $this->get_record_by_id($table, 'id', $checkArray);
            return $count['id'];
        }
    }

    /*     * *    Delete a record from table ** */

    public function delete($table, $where) {
        if (is_array($where)) {
            $this->db->where($where);
        } else {
            $this->db->where('(' . $where . ')');
        }
        $this->db->delete($table);
        return $this->db->affected_rows();
//        return TRUE;
//         $report            = array();
//          $report['error']   = $this->db->_error_number();
//          $report['message'] = $this->db->_error_message();
//          if ($report !== 0) {
//          return true;
//          } else {
//          return false;
//          } 
    }

    function slug($data, $primary_key = "") {
        if (!empty($primary_key)) {
            return $this->slug->create_uri($data, $primary_key);
        } else {
            return $this->slug->create_uri($data);
        }
    }

    function getSelectList($table, $where = array(), $default = array(), $fields = 'id,name') {
        $data = array();
        $field = explode(',', $fields);
        $this->db->select($fields);
        $this->db->from($table);
//        $this->db->where('is_active', '1');
        $this->db->order_by($field[1], 'asc');
        if (is_array($where))
            $this->db->where($where);
        $query = $this->db->get();
        if (!empty($default)) {
            $data = $default;
        }
        foreach ($query->result_array() as $row) {
            $data[$row[$field[0]]] = ucfirst($row[$field[1]]);
        }
        return $data;
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

    function file_upload($input_name, $filePath) {
        $_FILES[$input_name]['name'];
        $_FILES[$input_name]['type'];
        $_FILES[$input_name]['tmp_name'];
        $_FILES[$input_name]['error'];
//        $this->_mkdir($filePath);
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($input_name)) {
            $fileData = $this->upload->data();
            $imageData = array('filename' => $fileData['file_name'], 'is_image' => $fileData['is_image'], 'file_ext' => $fileData['file_ext']);
            return $imageData;
        }
    }

    function deleteFiles($path) {
        $files = glob($path . '*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }
    }

    function deleteFile($file) {
        unlink($file);
    }

}
