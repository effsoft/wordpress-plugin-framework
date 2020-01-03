<?php

namespace wordpress\plugin\core;

class WPFController extends WPFBase {

    public $plugin_file;
    public $view;
    public $model;

    public function __construct($file)
    {
        parent::__construct();
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->view = new WPFView($file);
        $this->plugin_file = $file;
        $this->model = WPFModel::getInstance();
    }

    public function render($tpl,$data = []){
        return $this->view->render($tpl,$data);
    }

}