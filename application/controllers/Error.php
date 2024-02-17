<?php 
    if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Error extends CI_Controller 
{
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }
 
    public function index() 
    {
        $this->load->view('backend/errors/404');
    }
    
    public function _400(){
        
    }
    
    public function _401(){
        
    }
    
    public function _404(){
        
    }
    
    public function _500(){
        
    }
    
    public function _database(){
        
    }
    
}