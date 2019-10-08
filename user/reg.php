<?php 

    require '../admin/header.php';
    require '../admin/sql.php';

	if(empty($_POST["email"]) || empty($_POST["name"])|| empty($_POST["pass1"])|| empty($_POST["pass2"])|| empty($_POST["phone"]))
	{
		echo'<h1 class="text-center center-block redColor"> 填写注册登录信息</h1>';
	}
	else
	{
			$name=ucwords(mysqli_real_escape_string($conn,test_input($_POST["name"])));
			$email=strtolower(mysqli_real_escape_string($conn,test_input($_POST["email"])));
			$pass1=strtolower(mysqli_real_escape_string($conn,test_input($_POST["pass1"])));
			$pass2=strtolower(mysqli_real_escape_string($conn,test_input($_POST["pass2"])));
			$phone=strtolower(mysqli_real_escape_string($conn,test_input($_POST["phone"])));
			
			$checkSql="SELECT `name` FROM `usertable` WHERE `email`='".$email."'";
			$result=$conn->query($checkSql);
			$row = $result->fetch_assoc();

			if(empty($row["name"]))
			{
				if($pass1===$pass2)
				{
					$sql="INSERT INTO `usertable`(`name`, `password`, `email`, `mobile`) VALUES ('" .$name."','".password_hash($pass1, PASSWORD_DEFAULT)."','".$email."','".$phone."')";
					if ($conn->query($sql) === TRUE) //insert data sent to DB
					  {
						  echo'<h1 class="text-center center-block greenColor">注册成功</h1>';
						} 
						else 
						{
						    //echo "Error: " . $sql . "<br>" . $conn->error;
						    echo '<h1  class="text-center center-block redColor">读写数据出错！</h1>';
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

  $conn->close();
?>

<body>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <div class="header text-center center-block">
    <h2>智能旅游协会</h2>
  </div>

  <form action="reg.php" method="post">
    <a href="login.php"><button type="button" class="btn btn-warning">< 去登录</button></a>
    <a href="../index.php"><button type="button" class="btn btn-info pull-right">回到主页 ></button></a>
    <div class="form-group">
      <label for="name">账户名称</label>
      <input type="text" class="form-control" name="name" required> 
      <br/>
       
       <label for="phone">手机号</label>
      <input type="text" class="form-control" name="phone" pattern="^1[34578]\d{9}$" placeholder="XXX-XXXX-XXXX"required> 
      <br/>

      <label for="email">邮箱</label>
      <input type="email" class="form-control" name="email" required> 
      <br/>
      
      <label for="pass1">密码</label>
      <input type="password" class="form-control" name="pass1" required></input>
      <br/>
      <label for="pass2">确认密码</label>
      <input type="password" class="form-control" name="pass2" required></input>
    </div>
    <div class="footer text-center center-block">
    <button type="submit" class="btn btn-danger btn-lg">创建账户</button>
    </div>
  </form>
  </div>
  <div class="col-md-2"></div>
  </div>
</div>

</body>
</html>