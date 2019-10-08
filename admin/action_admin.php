<?php 

session_start();
if(empty($_SESSION['name']) && empty($_SESSION['email']))
{
	$_SESSION['name']=false;
	$_SESSION['email']=false;
}

if(empty($_POST["email"]) || empty($_POST["pass"]))
	{
		if($_SESSION['name']===false || $_SESSION['email']===false)
		{
		 echo "<h1>请输入账号密码</h1>";
		}
	}
else
	{

		require 'sql.php';

		// 转义sql字符，防止sql注入攻击
		 $mail = mysqli_real_escape_string($conn,test_input($_POST["email"]));
		 $password= mysqli_real_escape_string($conn,test_input($_POST["pass"]));

		 $sql ="SELECT `name`, `password`, `email` FROM `admin` WHERE `email` ='".$mail."'";
		 $result = $conn->query($sql);
		 $row = $result->fetch_assoc();
		 
		 if($row["email"]==$mail && $row["password"]==$password)
		  {
				$_SESSION['name']=$row["name"];
				$_SESSION['email']=$row["email"];
				
		  }
		 else
		 {
			header('location:adminLogin.php');
		 }
		$conn->close();
	}
	if($_SESSION['name']!=false && $_SESSION['email']!=false)
	{
	   	require 'header.php';
	   	echo '<body><div class="container"><div class="row"><div class="col-md-2"></div><div class="col-md-8 text-center">';
	   	echo "<h1>管理员信息: </h1>";
	   	echo "<h2>".$_SESSION['name']."</h2>";
	   	echo "<h3>".$_SESSION['email']."</h3><hr>";
	   	echo "<h1>管理员功能: </h1>";
	   	echo '<a href="newAdmin.php"><button type="button" class="btn btn-success btn-lg adminButton">添加管理员</button></a><br>';
	   	echo '<a href="changePass.php"><button type="button" class="btn btn-primary btn-lg adminButton">更改密码</button></a><br>';
	   	echo '<a href="confirmBooking.php"><button type="button" class="btn btn-warning btn-lg adminButton">显示用户预约信息</button></a><br>';
	   	echo '<a href="addInfo.php"><button type="button" class="btn btn-info btn-lg adminButton">增加新景点信息</button></a><br>';
	   	echo '<a href="deleteInfo.php"><button type="button" class="btn btn-danger btn-lg adminButton">修改景点信息</button></a><br>';
	   	echo '<a href="logout.php"><button type="button" class="btn btn-basic btn-lg adminButton">退出登录</button></a><br>';
	   	echo '</div><div class="col-md-2"></div></div></div></body></html>';
   	}
?>