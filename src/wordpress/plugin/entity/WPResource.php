<?php

namespace wordpress\plugin\entity;

class WPResource{

    public $src = '';
    public $deps = [];
    public $ver = FALSE;
    public $media = 'all';

    public function __construct($src = '',$deps = [],$ver = FALSE,$media = 'all')
    {
        $this->src = $src;
        $this->deps = $deps;
        $this->ver = $ver;
        $this->media = $media;
    }
}