<?php

namespace wordpress\plugin\framework;

use wordpress\plugin\entity\WPAction;

class WordAction{

    public $plugin_file = null;

    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;
    }

    public function add(WPAction $action, $function_to_add){
        add_action($action->getValue(),$function_to_add);
    }
}