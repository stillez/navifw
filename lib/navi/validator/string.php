<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of string
 *
 * @author JanThanh
 */
class Navi_Validator_String extends Navi_Validator_Base {

    public function validate() {
        if (isset($this->config['pattern']) && !preg_match($this->config['pattern'], $this->value)) {
            $this->setError('Field "' . $this->config['label'] . '" is invalid.');
        }

        if (function_exists('mb_strlen') && isset($this->config['encoding'])) {
            $length = mb_strlen($this->value, $this->config['encoding']);
        } else {
            $length = strlen($this->value);
        }

        if (isset($this->config['minLength']) && $length < $this->config['minLength']) {
            $this->setError('Field "' . $this->config['label'] . '" is too short (minimum is ' . $this->config['minLength'] . ' characters).');
        }

        if (isset($this->config['maxLength']) && $length > $this->config['maxLength']) {
            $this->setError('Field "' . $this->config['label'] . '" is too long (maximum is ' . $this->config['maxLength'] . ' characters).');
        }

        if (isset($this->config['length']) && $length !== $this->config['length']) {
            $this->setError('Field "' . $this->config['label'] . '" is of the wrong length (should be ' . $this->config['length'] . ' characters).');
        }
    }

}
