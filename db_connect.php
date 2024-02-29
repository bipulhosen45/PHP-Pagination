<?php
 $conn = mysqli_connect('localhost','root','','php_pagination');

 if (!$conn){
     die("Db connect failed").mysqli_connect_error();
 }
// echo 'success';
?>