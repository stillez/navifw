<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author JanThanh
 */
class Navi_Model extends Navi_Database{
     
    public $scenario;
    private $alias = '';
    public $errors = array();
    public $rules;
    public function __construct($table = null) {
        $this->rules = $this->rules();
        parent::__construct($table);
    }
     
    public static function model(){
        return new static;
    }
     
    public function rules()
    {
        return array();
    }
     
    public function setAlias($alias){
        $this->alias = $alias;
    }
     
    public function getAlias(){
        return $this->alias;
    }
     
    public function getLabel($attr){
        return isset($this->maps[$attr]['label']) ? $this->maps[$attr]['label'] : ucwords(str_replace('_', ' ', $attr));
    }
     
    public function getError($attr){
        return isset($this->errors[$attr]) ? $this->errors[$attr] : null;
    }
     
    public function __get($name){
        return isset($this->$name) ? $this->$name : null;
    }
    public function __set($name, $value){
        $this->$name = $value;
    }
     
    public function load($data){
        if($data != null){
            if(is_array($data)){
                foreach($data as $key => $value){
                    $this->$key = trim($value);
                }
            }else{
                $data = get_object_vars($data);
                foreach($data as $key => $value){
                    $this->$key = $value;
                }
            }
        }
    }
 
    public function validate(){
        $this->errors = array();
        if(count($this->rules) > 0){
            foreach($this->rules as $rule){
                $attrs = explode(',', array_shift($rule));
                $validators = explode(',', array_shift($rule));
                $skipError = isset($rule['allowEmpty']) ? true : false;
                if(isset($rule['on']))
                    if($this->scenario != $rule['on'])
                        continue;
                    else
                        $skipError = true;
                         
                foreach($validators as $validator){
                    $validator = 'Navi_Validator_' . ucfirst(trim($validator)); 
                    if(class_exists($validator, true)){
                        foreach($attrs as $attr){
                            $attr = trim($attr);
                            if($skipError)
                                unset($this->errors[$attr]);
                            $rule['label'] = $this->getLabel($attr);
                            $validator = new $validator($attr, $this->$attr, $rule);
                            if(!$validator->beforeValidator()){
                                $validator->validate();
                            }
                            $this->errors = array_merge($this->errors, $validator->errors);
                        }
                    }else{
                       // $this->errors['validator'][] = 'No exists validator type with name "'. $method .'"';
                    }
                }
            }
        }
        return count($this->errors) == 0 ? true : false;
    }
}