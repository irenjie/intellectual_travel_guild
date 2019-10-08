<?php 

$servername = "";
$username = "";
$password = "";
$dbname = "travelguide";


		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if (mysqli_connect_errno()) {
		    die("连接数据库失败: " . mysqli_connect_errno());
		}
$sql="SELECT * FROM `placetable` limit 5,10";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
print_r($result);
		$conn->close();
?>