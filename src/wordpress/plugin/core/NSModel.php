<?php

namespace wordpress\plugin\core;

class NSModel{

    public $db;
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
    }
}