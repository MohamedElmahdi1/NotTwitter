<!DOCTYPE html> 
<html> 
<head><title>Login Page</title></head> 
<body>
<h1 align = "center";>NOTtwitter</h1>
<h2> Login </h2>
<?php  
  
    echo form_open('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/user/doLogin');  
  
    echo validation_errors();  
  
    echo "<p>Username: ";  
    echo form_input('username');  
    echo "</p>";  
  
    echo "<p>Password: ";  
    echo form_password('password');  
    echo "</p>";  
  
    echo "</p>";  
    echo form_submit('login_submit', 'Login');  
    echo "</p>";  
  
    echo form_close();  
  
    ?>  
</body> 
</html>