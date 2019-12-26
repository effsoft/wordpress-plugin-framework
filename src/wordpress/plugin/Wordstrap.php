<?php

namespace wordpress\plugin;

use wordpress\plugin\framework\Bootstrap;

class Wordstrap extends Bootstrap {

    public function __construct($file = null)
    {
        parent::__construct($file);

    }

    public function run(){
        $this->_configuration();
    }





}