<?php 
class User_model extends CI_Model {
    public function __construct() { 
        $this->load->database();// loads the database
   }

   public function checkLogin($username, $pass){
    $password = sha1($pass);// hashes the password
    $this->db->where('username', $username);// compares the username
    $this->db->where('password', $password);//compares passsword
    $query = $this->db->get('Users');// gets the results from Users table
    
    //$query = $this->db->query("SELECT * FROM Users WHERE username = '".$username."' AND password = '".$pass."'"); 
    if($query->num_rows()>0){// checks if num of rows is larger than 0
            return True; //returns true
    }
    else{
        $this->form_validation->set_message('validation', 'Incorrect username/password.');// error message
        return False;// returns false
    }
    
   }
   public function isFollowing($follower, $followed){
    $this->db->where('follower_username', $follower);// compares follower_username with the database
    $this->db->where('followed_username', $followed);// compares followed_username with the database
    $query = $this->db->get('User_Follows');

    if($query->num_rows()>0){// checks if num of rows is larger than 0
        return True;
    }
    else{
    return False;
    }

   }
   public function follow($follower, $followed){
    $this->db->set('follower_username', $follower);// sets the $follower into the table
    $this->db->set('followed_username', $followed);// sets the $followed into the table
    $this->db->insert('User_Follows');// inserts into the User_Follows table in the database
   }


}