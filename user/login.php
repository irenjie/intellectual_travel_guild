<?php
    session_start();
    ob_start();
    require '../admin/header.php';
    require '../admin/sql.php';

    if(empty($_SESSION['user']) && empty($_SESSION['mail']))
    {
      $_SESSION['user']=false;
      $_SESSION['mail']=false;
    }
    else
    {
      header('location: ../index.php');
      exit();
    }

    if(empty($_POST["email"]) || empty($_POST["pass"]))
    {
      if($_SESSION['user']===false || $_SESSION['mail']===false)
      {
       echo '<h1 class="text-center center-block redColor">输入账号和密码</h1>';
      }
    }
  else
  {

    $mail = mysqli_real_escape_string($conn,test_input($_POST["email"]));
    $password= mysqli_real_escape_string($conn,test_input($_POST["pass"]));

     $sql ="SELECT `name`, `password`, `email`, `mobile` FROM `usertable` WHERE `email` ='".$mail."'";
     $result = $conn->query($sql);
     $row = $result->fetch_assoc();

		//password_verify(...)用散列值检查密码
      if($row["email"]==$mail && password_verify($password,$row["password"]))
      {
        $_SESSION['user']=$row["name"];
        $_SESSION['mail']=$row["email"];
        $_SESSION['mobile']=$row["mobile"];
        header('location: ../index.php');
        exit();
      }
      else
      {
        echo'<h1 class="text-center center-block redColor"> 账号或密码出错 </h1>';
        
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
    <h2>登录智能旅游指导</h2>
  </div>

  <form action="login.php" method="post">
    <a href="reg.php"><button type="button" class="btn btn-warning">< 创建一个 </button></a>
    <a href="../admin/adminLogin.php"><button type="button" class="btn btn-info pull-right"> 管理员登录 ></button></a>
    <p class="text-center">*登录你的账户或者点击 <b> 创建一个 <b>*</p>
    <div class="form-group">
      <label for="email">邮箱</label>
      <input type="email" class="form-control" name="email" required> <!--必填字段-->
      <br/>
      
      <label for="pass">密码</label>
      <input type="password" class="form-control" name="pass" required></input>
    </div>
    <div class="footer text-center center-block">
    <button type="submit" class="btn btn-danger btn-lg">登 录</button>
    </div>
  </form>
  </div>
  <div class="col-md-2"></div>
  </div>
</div>

</body>
</html>
