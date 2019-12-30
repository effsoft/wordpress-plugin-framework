<?php

namespace wordpress\plugin\framework;

use wordpress\plugin\helpers\PluginHelper;

class Bootstrap{

    public $plugin_file = null;
    public $config = null;

    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;

        $this->__load_config();
    }

    public function __load_config()
    {
        $config_file_path = PluginHelper::get_plugin_dir_path($this->plugin_file) . "src/config/config.php";
        if (!file_exists($config_file_path)) {
            echo "Can not find config file: $config_file_path";
            exit;
        }
        $this->config = require($config_file_path);
    }

    public function _configuration()
    {
        if (empty($this->config)) {
            echo 'Config file is empty, please set the configuration file!';
            exit;
        }
        if (!empty($this->config['hooks'])) {
            (new WordHook($this->plugin_file))->hook($this->config['hooks']);
        }
        if (!empty($this->config['enqueues'])){
            (new WordEnqueue($this->plugin_file))->enqueue($this->config['enqueues']);
        }
        if(!empty($this->config['menu_pages'])){
            (new WordMenuPage($this->plugin_file))->addPages($this->config['menu_pages'])->register();
        }
        if(!empty($this->config['rests'])){
            (new WordRest($this->plugin_file))->addRests($this->config['rests'])->register();
        }
    }

    public function _init_models(){
        if (empty($this->config['models'])){
            return;
        }
        foreach ($this->config['models'] as $model){
            $model_instance = new $model;
            call_user_func([
                $model_instance,
                'init'
            ]);
        }
    }
}