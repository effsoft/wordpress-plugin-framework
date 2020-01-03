<?php

namespace wordpress\plugin\framework;

class WordMessage
{

    public $type;
    public $content;


    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function setMessage($content){
        $this->content = $content;
        return $this;
    }
}