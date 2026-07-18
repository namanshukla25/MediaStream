<?php
$conn = mysqli_connect("localhost", "root", "root", "video_system");

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>