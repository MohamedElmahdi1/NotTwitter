<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

class User extends CI_Controller {
  public function __construct(){
	  parent::__construct();
    $this->load->database();//loads the database
    $this->load->library('form_validation');//this loads the library form_validation
	}
  
  public function view ($name){
    if($this->session->userdata('username') != ''){//checks if the username of the session isnt nothing
    $this->load->model('user_model');// loads the model user_model
      if($this->session->userdata('username') != $name){//checks if the session username is equal to the username written in url 
      $currentUser = $this->session->userdata('username');// declares the currentUser and stores session username in that variable
      $result = $this->user_model->isFollowing($currentUser, $name);//this gets the reult from isfollowing
        if($result == FALSE){//if its false
        $this->load->model('message_model');//loads the model message_model
        $data = $this->message_model->getMessagesByPoster($name);// $data stores the messages by the poster
        $viewData = array("results" => $data);// $data is put into an array
        $this->load->view('ViewMessages',$viewData);// loads the viewMessages
        echo '<button><a href="'.base_url().'index.php/user/follow/'.$name.'">Follow</a></button>';// echoes a button which is called follow leads to the follow function
        echo '<button><a href="'.base_url().'index.php/user/login">Logout</a></button>';// echoes a button to logout and takes to the login page
        }
        else{
          $this->load->model('message_model');//loads the model message_model
          $data = $this->message_model->getMessagesByPoster($name);// $data stores the messages by the poster
          $viewData = array("results" => $data);// $data is put into an array
          $this->load->view('ViewMessages',$viewData);// loads the viewMessages
          echo '<button><a href="'.base_url().'index.php/user/login">Logout</a></button>';// echoes a button to logout and takes to the login page
        }
      }
    else{
      $this->load->model('message_model');//loads the model message_model
      $data = $this->message_model->getMessagesByPoster($name);// $data stores the messages by the poster
      $viewData = array("results" => $data);// $data is put into an array
      $this->load->view('ViewMessages',$viewData);// loads the viewMessages
      echo '<h2> Welcome '.$name.'</h2>';// echos welcome with the name
      echo '<button><a href="'.base_url().'index.php/user/login">Logout</a></button>';// echoes a button to logout and takes to the login page
    }
  }
  else{
    redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/login/');//redirects to the login page
}
  }
  public function login(){
    $this->load->view('ViewLogin');// loads the view ViewLogin
  }
  public function doLogin(){
      $this->form_validation->set_rules('username','Username:','required|trim');// set validation rules for username 
      $this->form_validation->set_rules('password','Password','required|trim');// sets validation rules for 
      if($this->form_validation->run()){// if the validation runs
        $username = $this->input->post('username');// post username from the form
        $password = $this->input->post('password');//post password from the form
        $this->load->model('user_model');// loads users_model model
        if($this->user_model->checkLogin($username, $password)){// checksLogin using password entered and username
          $session_data = array(//starts session with these session data
            'username' => $username
          );
          $this->session->set_userdata($session_data);//starts the session
          redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/view/'.$username);//redirects to user/view
        }
        else{
          $this->session->set_flashdata('error','Invalid Username and Password');//stops session and outputs error message
          redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/login/');//redirects to login page
        }
      }
      else{
        $this->login();// goes to login function
      }
      
  }
  public function Logout(){
    $this->session->unset_userdata('username');// stops the session
    redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/login/');// redirects to login page
  }
  public function follow($followed){
    $this->load->model('user_model'); // loads the usermodel
    $currentUser = $this->session->userdata('username');// gets the username from session data
    $this->user_model->follow($currentUser, $followed);//runs the follow function with the values
    redirect('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/view/'.$followed);// redirects to user/ view
  }
  public function feed($name){
    $this->load->model('message_model');//loads message_model
    $data = $this->message_model->getFollowedMessage($name);//runs the Get followed message witht the paramter name
    $viewData = array("results" => $data);//stores the data in array
    $this->load->view('ViewMessages',$viewData);//loads the view messages with the data
    echo '<h2> Welcome '.$name.'</h2>';// echos the name and welcome
    echo '<button><a href="'.base_url().'index.php/user/login">Logout</a></button>';// echos the logout button
  }



}
