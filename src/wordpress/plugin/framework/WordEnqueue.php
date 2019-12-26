<?php

namespace wordpress\plugin\framework;

class WordEnqueue{

    public $plugin_file = null;
    public $enqueues = null;
    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;
    }

    public function enqueue($enqueues = []){
        $this->enqueues = $enqueues;
        foreach ($this->enqueues as $key=>$eq){
            if ($key === 'admin'){
                add_action('admin_enqueue_scripts',array($this,'enqueueAdmin'));
            }else if ($key === 'login'){
                add_action('login_enqueue_scripts',array($this,'enqueueLogin'));
            }else if ($key === 'wp'){
                add_action('wp_enqueue_scripts',array($this,'enqueueWp'));
            }
        }

    }

    public function enqueueAdmin(){
        if (!empty($this->enqueue['admin'])){
            if (!empty($this->enqueue['admin']['css'])){
                $this->__enqueueCss($this->enqueue['admin']['css']);
            }
            if (!empty($this->enqueue['admin']['js'])){
                $this->__enqueueJs($this->enqueue['admin']['js']);
            }
        }
    }

    public function enqueueLogin(){
        if (!empty($this->enqueue['login'])){
            if (!empty($this->enqueue['login']['css'])){
                $this->__enqueueCss($this->enqueue['login']['css']);
            }
            if (!empty($this->enqueue['login']['js'])){
                $this->__enqueueJs($this->enqueue['login']['js']);
            }
        }
    }

    public function enqueueWp(){
        if (!empty($this->enqueue['wp'])){
            if (!empty($this->enqueue['wp']['css'])){
                $this->__enqueueCss($this->enqueue['wp']['css']);
            }
            if (!empty($this->enqueue['wp']['js'])){
                $this->__enqueueJs($this->enqueue['wp']['js']);
            }
        }
    }

    private function __enqueueCss($css){
        foreach ($css as $resource){
            wp_enqueue_style($this->plugin_file,plugins_url($resource->src,$this->plugin_file),$resource->deps,$resource->ver,$resource->media);
        }
    }

    private function __enqueueJs($js){
        foreach ($js as $resource){
            wp_enqueue_script($this->plugin_file,plugins_url($resource->src,$this->plugin_file),$resource->deps,$resource->ver,$resource->media);
        }
    }
}