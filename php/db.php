<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connect = mysqli_connect("localhost", "root", "", "u0722964_image");

if (!$connect) {
	echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
	echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}
$connect->query( "SET CHARSET utf8" );
?>