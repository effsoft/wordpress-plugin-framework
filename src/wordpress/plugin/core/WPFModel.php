<?php

namespace wordpress\plugin\core;

class WPFModel{

    private static $instance = null;
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new WPFModel();
        }

        return self::$instance;
    }

    public $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function beginTransaction(){
        $this->db->query('START TRANSACTION');
    }

    public function rollback(){
        $this->db->query('ROLLBACK');
    }

    public function commit(){
        $this->db->query('COMMIT');
    }
}