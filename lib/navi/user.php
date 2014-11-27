<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author JanThanh
 */
class Navi_User extends Navi_Session{
    public static $info;
    public static function setId($id){
        self::set('Navi_User_id', $id);
    }
     
    public static function getId(){
        return self::get('Navi_User_id');
    }
     
    public static function setInfo($info){
        self::set('Navi_User_info', $info);
    }
     
    public static function getInfo(){
        return self::get('Navi_User_info');
    }
     
    public static function logged(){
        if (self::get('Navi_User_id') !== null) {
            return true;
        }
        return false;
    }
     
    public static function logout(){
        self::delete('Navi_User_id');
        if (self::get('Navi_User_id') !== null) {
            return false;
        }
        return true;
    }
}
