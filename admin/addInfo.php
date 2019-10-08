<?php 
	session_start();
	require 'header.php';
	require 'sql.php';


	if($_SESSION['name']!=false && $_SESSION['email']!=false)
	{
		if(empty($_POST["name"]) || empty($_POST["details"]) || empty($_POST["category"]))
		{
			echo'<h1 class="text-center center-block redColor"> 填写完整信息</h1>';
		}
		else
		{
			$name=strtolower(mysqli_real_escape_string($conn,test_input($_POST["name"])));
			$details=mysqli_real_escape_string($conn,test_input($_POST["details"]));
			$category=mysqli_real_escape_string($conn,test_input($_POST["category"]));
			$capacity=mysqli_real_escape_string($conn,test_input($_POST["capacity"]));
			$hotel=mysqli_real_escape_string($conn,test_input($_POST["hotel"]));
			$checkSql="SELECT `id` FROM `placetable` WHERE `plcaeName`='".$name."'";

			$result=$conn->query($checkSql);
			$row = $result->fetch_assoc();
			if(empty($row["id"]))
			{
				$sql="INSERT INTO `placetable`(`plcaeName`, `details`, `lastEdit`, `category` ,`capacity`, `hotel`) VALUES ('" .$name."','".$details."','".$_SESSION['email']."','".$category."','".$capacity."','".$hotel."')";
				if ($conn->query($sql) === TRUE) //insert data sent to DB
					{
					  echo'<h1 class="text-center center-block greenColor">添加成功</h1>';
					} 
					else 
					{
					    //echo "Error: " . $sql . "<br>" . $conn->error;
					    echo '<h1  class="text-center center-block redColor">读写数据失败</h1>';
					}
			}
			else
			{
			  echo'<h1  class="text-center center-block redColor">景点已存在</h1>';
			}
		}
			$_POST["name"]="";
			$_POST["details"]="";
			$conn->close();
		}
	else
	{
		header('location:adminLogin.php');
	}
?>
<body>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <div class="header text-center center-block">
  <h2>添加新景点信息</h2>
  </div>
  <form action="addInfo.php" method="post">
    <div class="form-group">
      <label for="name">地名</label>
      <input type="text" class="form-control" name="name" maxlength="90" required> 
      <br/>
      
       <label for="details">简介</label>
      <textarea class="form-control" rows="5" name="details" maxlength="220" required></textarea>
      <br/>

        <label for="hotel">酒店（默认）</label>
      <textarea class="form-control" rows="3" name="hotel" maxlength="200" required></textarea>
      <br/>

       <label for="capacity">容量</label>
      <input type="number" class="form-control" name="capacity" required> 
      <br/>

   <label for="category">类别</label><br>
   <select name="category" class="dropdown" required>
    <option disabled selected value> -- 选择一个类别 -- </option>
    <option value="beach">沙滩</option>
    <option value="forest">山林</option>
    <option value="hill">高原</option>
    <option value="fountain">经济</option>
    <option value="cultural">文化</option>
    <option value="historic ">历史</option>
  </select>
    </div>
    <div class="footer text-center center-block">
    <button type="submit" class="btn btn-danger btn-lg">提交</button>
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