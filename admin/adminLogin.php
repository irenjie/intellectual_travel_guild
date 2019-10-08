<?php
    
    require 'header.php';
?>

<body>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <div class="header text-center center-block">
    <h2>智能旅游指导管理员登录</h2>
  </div>

  <form action="action_admin.php" method="post">
    <a href="../user/login.php"><button type="button" class="btn btn-warning">< 回到用户登录</button></a>
    <div class="form-group">
      <label for="email">邮箱</label>
      <input type="email" class="form-control" name="email" required> 
      <br/>
      
      <label for="pass">密码</label>
      <input type="password" class="form-control" name="pass" required></input>
    </div>
    <div class="footer text-center center-block">
    <button type="submit" class="btn btn-danger btn-lg">登录</button>
    </div>
  </form>
  </div>
  <div class="col-md-2"></div>
  </div>
</div>

</body>
</html>
