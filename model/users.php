<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author JanThanh
 */
class Users extends Navi_Model{
    public function __construct($scenario = null) {
        $this->scenario = $scenario;
        parent::__construct('users');
    }
    
    // Xu ly login
    public function login(){
        if(isset($this->username) && isset($this->password)){
            $model = $this->find('username = :username and status <> 0 and status is not null', array(':username' => $this->username));
            if($model && isset($model->username) && $model->password == $this->password){
                Navi_User::setId($model->id);
                Navi_User::setInfo($model);
                return true;
            }
        }
        return false;
    }
     
    public function maps(){
        return array(
            'id' => array('id'),
            'username' => array('username'),
            'password' => array('password'),
            'roles' => array('roles'),
            'fullname' => array('fullname'),
            'status' => array('status'),
            'inserted' => array('inserted'),
            'updated' => array('updated'),
            'inserter' => array('inserter'),
            'updater' => array('updater')
        );
    }
     
    public function rules(){
        return array(
            array('username, password, email', 'required'),
            array('email', 'email'),
            array('email', 'email', 'allowEmpty' => true, 'on' => 'login')
        );
    }
     
    public function labels(){
        return array(
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu'
        );
    }
     
    public function beforeInsert() {
        $this->inserted = date('Y-m-d H:i:s');
        $this->inserter = Navi_User::getId();
        $this->updated = date('Y-m-d H:i:s');
        $this->updater = Navi_User::getId();
    }
     
    public function beforeUpdate() {
        $this->updated = date('Y-m-d H:i:s');
        $this->updater = Navi_User::getId();
    }
}