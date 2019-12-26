<?php

namespace wordpress\plugin\entity;

class WPMenuPage
{

    public $page_title;
    public $menu_title;
    public $capability;
    public $menu_slug;
    public $callback = '';
    public $icon_url = '';
    public $position = null;
    public $controller = '';
    public $sub_title ='';

    public function __construct($page_title, $menu_title, $capability, $menu_slug,  $sub_title= '',$callback = '', $icon_url = '', $position = null )
    {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->sub_title = $sub_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;
        $this->callback = $callback;
        $this->icon_url = $icon_url;
        $this->position = $position;
    }

    public $subMenuPages = [];

    public function addSubMenuPage(WPSubMenuPage $subMenuPage){
        array_push($this->subMenuPages,$subMenuPage);
        return $this;
    }
}