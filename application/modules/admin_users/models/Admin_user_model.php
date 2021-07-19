<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_user_model extends Ion_auth_Model
{
    public function __construct()
    {
        parent::__construct();
        $tables = array(
            'users' => 'admin_users',
            'login_attempts' => 'login_attempts',
            'password_track' => 'user_password_track'
        );
        $this->table_intialize($tables);
        $identity_column = 'email';
        $this->identity_column_set($identity_column);
        $identity_column_mutiple = array(
            'email',
            'username',
            'phonenumber'
        );
        $this->mutiple_identity_column_set($identity_column_mutiple);
    }
}
