<?php 
	session_start();
	require 'header.php';
	require 'sql.php';

	if($_SESSION['name']!=false && $_SESSION['email']!=false)
		{
			if(empty($_POST["oldPass"]) || empty($_POST["newPass1"])|| empty($_POST["newPass2"]))
			{
				echo'<h1 class="text-center center-block redColor"> 填写信息</h1>';
			}
			else
			{
				$oldPass=strtolower(mysqli_real_escape_string($conn,test_input($_POST["oldPass"])));
				$pass1=strtolower(mysqli_real_escape_string($conn,test_input($_POST["newPass1"])));
				$pass2=strtolower(mysqli_real_escape_string($conn,test_input($_POST["newPass2"])));

				$checkSql="SELECT `password` FROM `admin` WHERE `email`='".$_SESSION['email']."'";
				$result=$conn->query($checkSql);
				$passDB = $result->fetch_assoc();

				if($passDB["password"]==$oldPass)
				{
					if($pass1===$pass2)
					{
						$sql="UPDATE `admin` SET `password`='".$pass1."' WHERE `email`='".$_SESSION['email']."'";
						if ($conn->query($sql) === TRUE)

					    {
						  echo'<h1 class="text-center center-block greenColor">更换密码成功</h1>';
						} 
					else 
					{
					    //echo "Error: " . $sql . "<br>" . $conn->error;
					    echo '<h1  class="text-center center-block redColor">读取数据失败，请重试</h1>';
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
  <h2>你正在更换密码</h2>
  </div>
  <form action="changePass.php" method="post">
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
<div class=" text-center center-block">
	<?php echo '<a href="logout.php"><button type="button" class="btn btn-basic btn-lg adminButton">退出</button></a><br>'; ?>
</div>
</body>
</html>