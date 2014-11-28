<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of view
 *
 * @author JanThanh
 */
class Navi_View {

    //put your code here
    private $title;
    private $image;
    private $keywords;
    private $description;
    private $published;
    private $modified;
    private $layout;
    private $placeholder;
    private $breadcrumb;

    public function __construct() {
        $this->setLayout(Navi::$config['defaultTemplate']);
        $this->setTitle(isset(Navi::$config['name']) ? Navi::$config['name'] : '');
    }

    public function render($name) {
        $this->placeholder = $name;
        require 'application/' . strtolower(Navi::$module) . '/view/layout/' . $this->layout . '.php';
    }

    public function renderPartial($name) {
        $names = explode('/', $name);
        if (count($names) == 1) {
            $name = strtolower(Navi::$controller) . '/' . $name;
        }
        require 'application/' . strtolower(Navi::$module) . '/view/' . $name . '.php';
    }
    
    public function placeholder(){
        $names = explode('/', $this->placeholder);
        if(count($names) == 1){
            $this->placeholder = strtolower(Navi::$controller) .'/'. $this->placeholder;
        }
        require 'application/'.strtolower(Navi::$module).'/view/'.$this->placeholder.'.php';
    }
    
    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getKeywords() {
        return $this->keywords;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    public function setModified($modified) {
        $this->modified = $modified;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getTitle() {
        return $this->title;
    }

}
