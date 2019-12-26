<?php

namespace wordpress\plugin;

use wordpress\plugin\framework\Bootstrap;

class Woostrap extends Bootstrap
{

    public function __construct($file)
    {
        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            throw new \Exception('You need to install WooCommerce before using this plugin!');
        }
        parent::__construct($file);
    }
}