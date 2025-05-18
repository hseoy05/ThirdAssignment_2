<?php
session_start();
$conn = new mysqli("localhost","root","","testdb");

if($conn->connect_error) {
    die("DB connect fail: " . $conn->connect_error);
}

if(isset($_POST["id"])) {
    $ss = $conn->prepare("SELECT * FROM createdocument");
}
?>