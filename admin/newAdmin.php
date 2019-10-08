<?php
	session_start();
	require 'header.php';
	require 'sql.php';
	
	if($_SESSION['name']!=false && $_SESSION['email']!=false)
	{
		if(empty($_POST["email"]) || empty($_POST["name"])|| empty($_POST["pass1"])|| empty($_POST["pass2"]))
			{
				echo'<h1 class="text-center center-block redColor"> 填写管理员信息</h1>';
			}
		else
		{
			$name=ucwords(mysqli_real_escape_string($conn,test_input($_POST["name"])));
			$email=strtolower(mysqli_real_escape_string($conn,test_input($_POST["email"])));
			$pass1=strtolower(mysqli_real_escape_string($conn,test_input($_POST["pass1"])));
			$pass2=strtolower(mysqli_real_escape_string($conn,test_input($_POST["pass2"])));
			
			$checkSql="SELECT `name` FROM `admin` WHERE `email`='".$email."'";
			$result=$conn->query($checkSql);
			$row = $result->fetch_assoc();

			if(empty($row["name"]))
			{
			if($pass1===$pass2)
			{
				$sql="INSERT INTO `admin`(`name`, `password`, `email`, `addedBy`) VALUES ('" .$name."','".$pass1."','".$email."','".$_SESSION['email']."')";
				if ($conn->query($sql) === TRUE)
				  {
					  echo'<h1 class="text-center center-block greenColor">添加新管理员成功</h1>';
					} 
					else 
					{
					    echo '<h1  class="text-center center-block redColor">读取数据失败，请重试</h1>';
					}
				  }
				else
				{
					echo'<h1 class="text-center center-block redColor">密码不匹配</h1>';
				}
		  }
		  else
			{
			  echo'<h1  class="text-center center-block redColor">邮箱已被注册</h1>';
			}
		}
	}
	else
	{
		header('location:adminLogin.php');
	}

$conn->close();
?>
<body>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <div class="header text-center center-block">
  <h2>管理员注册</h2>
  </div>
  <form action="newAdmin.php" method="post">
    <div class="form-group">
	  <label for="name">账户名称</label>
      <input type="text" class="form-control" name="name" required>
      <br/>
	  
      <label for="email">邮箱</label>
      <input type="email" class="form-control" name="email" required> 
      <br/>
      
      <label for="pass1">密码</label>
      <input type="password" class="form-control" name="pass1" required></input>
	  <br>
	  <label for="pass2">确认密码</label>
      <input type="password" class="form-control" name="pass2" required></input>
    </div>
    <div class="footer text-center center-block">
    <button type="submit" class="btn btn-danger btn-lg">注册</button>
    </div>
  </form>
  </div>
  <div class="col-md-2"></div>
  </div>
</div>
<div class=" text-center center-block">
	<?php echo '<a href="logout.php"><button type="button" class="btn btn-basic btn-lg adminButton">退出</button></a><br>'; ?>
</div>
</body>
</html>