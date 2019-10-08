<?php

$servername = "localhost";//数据库信息
$username = "root";
$password = "ma1091387083";
$dbname = "travelguide";

function test_input($data) {

	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
}

		$conn = mysqli_connect($servername, $username, $password, $dbname);
		//检查数据库连接（connection）
		if (mysqli_connect_errno()) 
		{
		    die("连接数据库失败！");
		}

?>