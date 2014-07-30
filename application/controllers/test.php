<?php

class Test extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }
    
    public function index()
    {
        $this->load->view('Hello');
    }
    
    public function show()
    {
        
    }
    
}