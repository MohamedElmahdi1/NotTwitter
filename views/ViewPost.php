<!DOCTYPE html> 
<html> 
<head><title>post Page</title></head> 
<body>
<h1 align = "center";>NOTtwitter</h1>
<h2> Post a Message </h2>
<?php  
  
    echo form_open('http://raptor.kent.ac.uk/proj/co539m/microblog/me368/index.php/message/doPost');  
  
    echo validation_errors();  
  
    echo "<p>Post: ";  
    echo form_input('post');  
    echo "</p>";    
  
    echo "</p>";  
    echo form_submit('post_submit', 'post');  
    echo "</p>";  
  
    echo form_close();  
  
    ?>  
</body> 
</html>