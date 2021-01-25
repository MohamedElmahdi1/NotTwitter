<!DOCTYPE html> 
<html> 
<head><title>Messages Page</title></head> 
<body>
<h1 align = "center";> NOTtwitter </h1>
<style>
#messages {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#messages th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #33CEFF;
  color: white;
}
#messages td, #messages th {
  border: 1px solid #ddd;
  padding: 8px;
}
</style>
<table id= "messages" align = "center">
<tr>
    <th>Poster</th>
    <th>Time</th>
    <th>Message</th>
</tr>
<?php foreach ($results as $row): ?>
    <tr>
      <td><?php echo $row['user_username']?></td>
      <td><?php echo $row['posted_at']?></td>
      <td><?php echo $row['text']?></td>
    </tr>
<?php endforeach; ?>
</table>
</body> 
</html>