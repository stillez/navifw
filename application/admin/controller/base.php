<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of base
 *
 * @author JanThanh
 */
class Admin_Controller_Base extends Navi_Controller{
    public $allowAccessAction = array();
    public function __construct() {
        parent::__construct();
    }
     
    public function init(){
        Navi_Session::start();
        if($this->authentication()){
            $this->setGlobal();
        }
    }
     
    private function setGlobal(){
        $this->defaultRecordPerPage = 10;
    }
     
    private function authentication(){
        if(in_array(Navi::$action, $this->allowAccessAction)){
            return true;
        }
        if(Navi_User::logged()){
            if($this->authorization()){
                return true;
            }else{
                $this->redirect(Navi::$baseUrl . '/../');
            }
        }else{
            $this->redirect(Navi::$baseUrl . '/login');
            return false;
        }
    }
     
    private function authorization(){
        $user = Users::model()->find('id = :id', array(':id' => Navi_User::getId()));
        if($user != false && $user->id != ''){
            if($user->roles == 1){
                return true;
            }
        }
        return false;
    }
}
