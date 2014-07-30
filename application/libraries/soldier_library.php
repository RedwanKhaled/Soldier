<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soldier_library {

    
        public function __construct() {
        $this->load->model('soldier_model');
        }
        
        
        public function __call($method, $arguments)
        {
            if (!method_exists($this->soldier_model, $method)) {
            throw new Exception('Undefined method Operators::' . $method . '() called');
        }

            return call_user_func_array(array($this->soldier_model, $method), $arguments);
        }


        public function __get($var) {
            return get_instance()->$var;
        }

}