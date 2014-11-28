<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of email
 *
 * @author JanThanh
 */
class Navi_Validator_Email extends Navi_Validator_String {

    private $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';

    public function validate() {
        parent::validate();
        $pattern = isset($this->config['pattern']) ? $this->config['pattern'] : $this->pattern;
        if (!is_string($this->value) || !preg_match($pattern, $this->value))
            $this->setError('Field "' . $this->config['label'] . '" must be an email.');
    }

}
