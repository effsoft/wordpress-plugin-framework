<?php

namespace wordpress\plugin\core;

class NSController extends NSBase {

    public $plugin_file;
    public $view;

    public function __construct($file)
    {
        parent::__construct();
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->view = new NSView($file);
        $this->plugin_file = $file;
    }

    public function render($tpl,$data = []){
        return $this->view->render($tpl,$data);
    }
}