<?php

namespace wordpress\plugin\entity;

class WPSubMenuPage{

    public $parent_slug;
    public $page_title;
    public $menu_title;
    public $capability;
    public $menu_slug;
    public $callback = '';
    public $position = null;

    public function __construct($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback = '', $position = null)
    {
        $this->parent_slug = $parent_slug;
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;
        $this->callback = $callback;
        $this->position = $position;
    }
}