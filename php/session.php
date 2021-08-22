<?php
session_start();

$login = $_SESSION["login"];
$password = $_SESSION["password"];

$stmt = $connect->prepare("SELECT * FROM `users` WHERE `login` LIKE ? AND  `password` LIKE ?");
$stmt->bind_Param('ss', $login, $password);
$stmt->execute();
$result = $stmt->get_result();

$row = mysqli_fetch_assoc($result);
$user_auth = false;
if($row > 0){
    $user_auth = true;
    $user_login = $row['login'];
    $user_avatar = $row['avatar'];
    $user_id = $row['id'];
    $user_status = $row['status'];
}

?>