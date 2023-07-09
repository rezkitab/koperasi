<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class MyConfig extends BaseConfig
{
    protected $session;
    protected $db, $general_settings;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/jakarta");
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->db = \Config\Database::connect();
        $get_general_settings = $this->db->query('SELECT * FROM users where id_user = ' . $this->session->get('id_user') . ' ');
        $this->general_settings = $get_general_settings->getRow();
        $d = ['getusers' => $this->general_settings];
        return view('layout/template',  $d);

        $this->db->close();
    }
}
