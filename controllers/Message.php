<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Message extends CI_Controller {
    public function __construct(){
        parent::__construct();
      $this->load->database();
      //loads the database
      $this->load->library('form_validation');
      //loads the form_validation library
      }
    public function index(){
        if($this->session->userdata('username') != ''){//checks if the username of the session isnt nothing
            $this->load->view('ViewPost');// displays the post view
        }
        else{
            redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/login/');
            //redirects to the login if the session doesnt have a username
        }
    }
    public function doPost(){
        if($this->session->userdata('username') != ''){//checks if the username of the session isnt nothing
            $this->load->model('message_model');//loads the model message model 
            $username = $this->session->userdata('username');//Stores the username of the session
            $post = $this->input->post('post');// stores the value places in the form in input post
            $data = $this->message_model->insertMessage($username, $post);// places both username and post inside insertmessage function and stores the return in data
            $this->session->set_userdata($session_data);// sets the userdata of the session with session_data
          redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/view/'.$username);// redirects to user/view with the username 
        }
    }
}