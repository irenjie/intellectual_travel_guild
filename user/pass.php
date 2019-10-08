<?php 
	session_start();
    require '../admin/header.php';
    require '../admin/sql.php';

	if(empty($_SESSION['user']) || empty($_SESSION['mail']))
		{
			header('location:login.php');
		}
	else
		{
			
			if(empty($_POST["oldPass"]) || empty($_POST["newPass1"])|| empty($_POST["newPass2"]))
			{
				echo'<a href="../index.php"><button type="button" class="btn btn-primary"> &#8592 主页</button></a>';
				echo'<h1 class="text-center center-block redColor"> 请填写完整信息</h1>';
			}
			else
			{
				$oldPass=strtolower(mysqli_real_escape_string($conn,test_input($_POST["oldPass"])));
				$pass1=strtolower(mysqli_real_escape_string($conn,test_input($_POST["newPass1"])));
				$pass2=strtolower(mysqli_real_escape_string($conn,test_input($_POST["newPass2"])));

				$checkSql="SELECT `password` FROM `usertable` WHERE `email`='".$_SESSION['mail']."'";
				$result=$conn->query($checkSql);
				$passDB = $result->fetch_assoc();

				if(password_verify($oldPass,$passDB["password"]))
				{
					if($pass1===$pass2)
					{
						$sql="UPDATE `usertable` SET `password`='".password_hash($pass1, PASSWORD_DEFAULT)."' WHERE `email`='".$_SESSION['mail']."'";
						if ($conn->query($sql) === TRUE)

					    {
						  echo'<h1 class="text-center center-block greenColor">更换成功</h1>';
						} 
					else 
					{
					    echo '<h1  class="text-center center-block redColor">读取数据失败！</h1>';
					}
				}
					else
					{
						echo '<h1  class="text-center center-block redColor">新密码不匹配</h1>';
					}
				}
				else
				{
					echo '<h1  class="text-center center-block redColor">当前密码错误</h1>';
				}
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
  <h2>你正在更改密码</h2>
  </div>
  <form action="pass.php" method="post">
    <div class="form-group">
	  <label for="oldPass">当前密码</label>
      <input type="password" class="form-control" name="oldPass" required>
      <br/>
	        
      <label for="newPass1">新密码</label>
      <input type="password" class="form-control" name="newPass1" required></input>
	  <br>
	  <label for="newPass2">确认新密码</label>
      <input type="password" class="form-control" name="newPass2" required></input>
    </div>
    <div class="footer text-center center-block">
		<button type="submit" class="btn btn-danger btn-lg">确认</button>
    </div>
  </form>
  </div>
  <div class="col-md-2"></div>
  </div>
</div>
</body>
</html>