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
class Navi_Validator_Base {

    //put your code here
    public $errors = array();
    public $attr = null;
    public $value = null;
    public $config = array();

    public function __construct($attr, $value, $config) {
        $this->attr = $attr;
        $this->value = $value;
        $this->config = $config;
    }

    public function beforeValidator() {
        if (isset($this->config['allowEmpty']) && $this->config['allowEmpty'] === true && trim($this->value) == '')
            return true;
        return false;
    }

    public function setError($error) {
        $this->errors[$this->attr] = isset($this->config['message']) ?
                str_replace('{attr}', $this->config['label'], $this->config['message']) : $error;
    }

}
