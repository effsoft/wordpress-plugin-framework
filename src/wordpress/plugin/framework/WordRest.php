<?php

namespace wordpress\plugin\framework;

use wordpress\plugin\entity\WPAction;



class WordRest{

    public $plugin_file = null;

    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;
    }

    public $rests = [];

    public function addRests($rests){
        $this->rests = $rests;
        return $this;
    }

    public function register(){
        add_action(WPAction::REST_API_INIT,[
            $this,
            '_register',
        ]);
    }

    public function _register(){
        foreach ($this->rests as $rest){
            register_rest_route( $rest['namespace'], $rest['route'], array(
                'methods' => $rest['params']['method'],
                'callback' => [
                    new $rest['params']['callback']['class']($this->plugin_file),
                    'action'.$rest['params']['callback']['function'],
                ],
                'permission_callback' => $rest['params']['permission_callback'],
                'args' => $rest['params']['args'],
            ));
        }
    }


}