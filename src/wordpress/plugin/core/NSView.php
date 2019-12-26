<?php

namespace wordpress\plugin\core;

use Symfony\Component\Filesystem\Filesystem;
use wordpress\plugin\framework\WordPlugin;

class NSView extends NSBase
{

    public $plugin_file = null;
    public $smarty = null;

    public function __construct($file)
    {
        parent::__construct();
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        parent::__construct();

        $this->plugin_file = $file;

        $this->smarty = new \Smarty();
        $this->smarty->caching = \Smarty::CACHING_LIFETIME_CURRENT;
        $this->smarty->left_delimiter = '<!--{';
        $this->smarty->right_delimiter = '}-->';


        $plugin_path = WordPlugin::get_plugin_dir_path($this->plugin_file);

        $file_system = new Filesystem();

        $template_dir = $plugin_path . 'src/views';
        $this->smarty->setTemplateDir($template_dir);

        $compile_dir = $plugin_path . 'runtime/smarty/compile';
        if (!file_exists($compile_dir)){
            try{
                $file_system->mkdir($compile_dir);
            }catch (\Exception $e){
                echo $e->getMessage();
            }
        }
        $this->smarty->setCompileDir($compile_dir);

        $cache_dir = $plugin_path . 'runtime/smarty/cache';
        if (!file_exists($cache_dir)){
            try{
                $file_system->mkdir($cache_dir);
            }catch (\Exception $e){
                echo $e->getMessage();
            }
        }
        $this->smarty->setCacheDir($cache_dir);
    }

    public function render($tpl, $data = [])
    {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $this->smarty->assign($key, $val);
            }
        }
        try{
            $this->smarty->display($tpl);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}