<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller
 *
 * @author JanThanh
 */
class Navi_Controller {
    //put your code here
    public $view;
    
    public function __construct() {
        $this->view = new Navi_View;
    }
    
    /**
     * chuyen huong
     * @param srting $url
     */
    public function redirect($url) {
        header('location:' .$url);
    }
}
