<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Search extends CI_Controller {
  public function __construct() {

    parent::__construct();
  }
  public function index(){
    $this->load->view('ViewSearch');// loads the ViewSearch view
  }
  public function dosearch(){
    $this->load->model('message_model');// loads the message_model model
    $search = $this->input->get('search');// gets the search input and places it in the $search variable
    $data = $this->message_model->searchMessages($search);// places the value of search as a parameter in searchMessages and the value od them all is put into $data
    if(count($data) == 0) { //checks if there is values in data
      echo "No rows found"; //if its true the code will echo no rows found
    return; 
  }
    $viewData = array("results" => $data);// places $data into an array easy to layout in a table
    $this->load->view('ViewMessages',$viewData);// loads ViewMessages and the value of viewData into ViewMessage
  }



}