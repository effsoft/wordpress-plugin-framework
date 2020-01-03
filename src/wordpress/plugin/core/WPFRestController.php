<?php

namespace wordpress\plugin\core;

class WPFRestController extends WPFBase {

    public $plugin_file;
    public $model;

    public function __construct($file)
    {
        parent::__construct();
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;
        $this->model = WPFModel::getInstance();
    }
}