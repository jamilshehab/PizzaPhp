<?php 
$con=mysqli_connect('localhost','root','','pizza');
if(!$con){
    echo 'error not connected sorry' . mysqli_connect_error();
}
?>