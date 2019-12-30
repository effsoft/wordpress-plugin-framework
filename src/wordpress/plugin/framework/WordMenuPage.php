<?php

namespace wordpress\plugin\framework;

use wordpress\plugin\entity\WPAction;
use wordpress\plugin\entity\WPMenuPage;
use wordpress\plugin\entity\WPSubMenuPage;

class WordMenuPage{

    public $plugin_file = null;

    public $pages = [];

    public function __construct($file)
    {
        if (empty($file)) {
            echo 'Please specify the entry file of the plugin!';
            exit;
        }
        $this->plugin_file = $file;

    }

    public function addPages(array $pages){
        $this->pages = $pages;
        return $this;
    }

    public function register(){
        (new WordAction($this->plugin_file))->add(WPAction::get(WPAction::ADMIN_MENU),[
            $this,
            '_register'
        ]);
    }

    public function _register(){
        if (empty($this->pages)){
            return $this;
        }
        foreach ($this->pages as $page){
            $this->addPage($page);
        }
        return $this;
    }

    public function addPage(WPMenuPage $page){

        $_controller = $page->callback['controller'];
        $_action = 'action'.$page->callback['action'];
        $_controller = new $_controller($this->plugin_file);

        $page_callback = function()use ($_controller,$_action){
            call_user_func(array($_controller,$_action));
        };

        add_menu_page(
            $page->page_title,
            $page->menu_title,
            $page->capability,
            $page->menu_slug,
            $page_callback,
            $page->icon_url,
            $page->position
        );

        if(!empty($page->sub_title)){
            add_submenu_page(
                $page->menu_slug,
                $page->sub_title,
                $page->sub_title,
                $page->capability,
                $page->menu_slug,
                $page_callback,
                $page->position
            );
        }

        if(empty($page->subMenuPages)){
           return $this;
        }

        foreach ($page->subMenuPages as $subMenuPage){
            $this->addSubPage($subMenuPage);
        }

        return $this;
    }

    public function addSubPage(WPSubMenuPage $subPage){

        $_controller = $subPage->callback['controller'];
        $_action = 'action'.$subPage->callback['action'];
        $_controller = new $_controller($this->plugin_file);

        add_submenu_page(
            $subPage->parent_slug,
            $subPage->page_title,
            $subPage->menu_title,
            $subPage->capability,
            $subPage->menu_slug,
            function()use ($_controller,$_action){
                call_user_func(array($_controller,$_action));
            },
            $subPage->position
        );
        return $this;
    }
}