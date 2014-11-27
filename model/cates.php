<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cates
 *
 * @author JanThanh
 */
class Cates extends Navi_Model {
    public function __construct($scenario = null) {
        $this->scenario = $scenario;
        parent::__construct('cates');
    }
     
    public function maps(){
        return array(
            'id' => array('id'),// , 'label' => 'Id', 'match' => true, 'operator' => 'AND'
            'title' => array('title', 'match' => false),
            'alias' => array('alias', 'match' => false),
            'seo_title' => array('seo_title', 'match' => false),
            'seo_keywords' => array('seo_keywords', 'match' => false),
            'seo_description' => array('seo_description', 'match' => false),
            'status' => array('status'),
            'inserted' => array('inserted'),
            'updated' => array('updated'),
            'inserter' => array('inserter'),
            'updater' => array('updater'),
        );
    }
     
    public function rules(){
        return array(
            array('title, alias, seo_keywords, seo_description', 'required'),
            array(' status', 'integerOnly' => true)
           // array('image', 'file', 'ext' => array('jpg', 'png', 'gif'), 'minWidth' => 500),
           // array('image', 'file', 'ext' => array('jpg', 'png', 'gif'), 'minWidth' => 500, 'allowEmpty' => true, 'on' => 'update')
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
