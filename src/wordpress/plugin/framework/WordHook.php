<?php

namespace wordpress\plugin\framework;

class WordHook
{
    public $plugin_file = null;
    public $hooks = null;
    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;
    }

    public function hook($hooks = [])
    {
        $this->hooks = $hooks;
        foreach ($this->hooks as $key => $hook_class) {
            if ($key === 'activation') {
                $hook_instance = new $hook_class();
                register_activation_hook(
                    $this->plugin_file,
                    [
                        $hook_instance,
                        'hook',
                    ]
                );
            } else if ($key === 'deactivation') {
                $hook_instance = new $hook_class();
                register_deactivation_hook(
                    $this->plugin_file,
                    [
                        $hook_instance,
                        'hook',
                    ]
                );
            }
        }
    }
}