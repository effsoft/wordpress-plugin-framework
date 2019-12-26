<?php

namespace wordpress\plugin\core;

class NSBase{

    public function __construct()
    {
        defined('ABSPATH') or die;
    }
}