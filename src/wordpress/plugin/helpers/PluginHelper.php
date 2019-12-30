<?php
namespace wordpress\plugin\helpers;

class PluginHelper{
    public static function get_plugin_dir_path($file)
    {
        return plugin_dir_path($file);
    }

    public static function get_plugin_dir_url($file)
    {
        return plugin_dir_url($file);
    }

    public static function get_plugin_basename($file)
    {
        return plugin_basename($file);
    }

    public static function get_plugin_name($file)
    {
        return basename(self::get_plugin_dir_path($file));
    }
}