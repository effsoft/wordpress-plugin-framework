<?php

namespace wordpress\plugin\core;

class WPFBase{

    public function __construct()
    {
        defined('ABSPATH') or die;
    }
}