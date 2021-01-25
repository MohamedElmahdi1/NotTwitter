<?php 
class Message_model extends CI_Model {
  public function __construct() { 
     $this->load->database(); 
     //loads the database
  }

  public function getMessagesByPoster($name) {
    $sql = "SELECT user_username, text, posted_at FROM Messages WHERE user_username = '".$name."' ORDER BY posted_at;";
    //above is the query to retrieve all messages posted by the user with the specified username, most recent first 
    $query = $this->db->query($sql, array($name));
    // the line above puts the results of the query in an array easy to layout in a table.
    return $query->result_array();
    // returns the array of results back 
  }

  public function searchMessages($string) {
    $sql = "SELECT user_username, text, posted_at FROM Messages WHERE text LIKE '%".$string."%' ORDER BY posted_at;";
    //above is the query to retrieve  all messages containing the specified search string, most recent first.
    $query = $this->db->query($sql, array($string));
    //the line above puts the results of the query in an array easy to layout in a table.
    return $query->result_array();
    //returns the array of results back
  }
  
  public function insertMessage($poster, $string){
    $now = date('Y-m-d H:i:s');// gets the current date and time 
    $this->db->set('user_username', $poster);
    //sets username into the database
    $this->db->set('text', $string);
    //sets text into the database
    $this->db->set('posted_at', $now);
    //sets time into the database
    $this->db->insert('Messages');
    //inserts all the above in Messages table
  }
  public function getFollowedMessage($name){
    $sql = "SELECT user_username, text, posted_at FROM Messages INNER JOIN User_Follows ON Messages.user_username = User_Follows.followed_username
    WHERE follower_username = '".$name."'ORDER BY posted_at"; 
    // query to Returns all of the messages from all of those followed by the specified user, most recent first.
    $query = $this->db->query($sql, array($name));
    // puts the query into array
    return $query->result_array();
  }


}