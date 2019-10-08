<?php 
	session_start();
	require 'header.php';
	require 'sql.php';
	if(empty($_SESSION["id"]))
	{
		$_SESSION["id"]=0;
	}

	if($_SESSION['name']!=false && $_SESSION['email']!=false)
	{
		if(empty($_POST["name"]) || empty($_POST["details"]) || empty($_POST["category"]))
		{
			echo'<h1 class="text-center center-block redColor"> 填写景区信息</h1>';
		}
		else
		{
			$name=strtolower(mysqli_real_escape_string($conn,test_input($_POST["name"])));
			$details=mysqli_real_escape_string($conn,test_input($_POST["details"]));
			$category=mysqli_real_escape_string($conn,test_input($_POST["category"]));
			$capacity=mysqli_real_escape_string($conn,test_input($_POST["capacity"]));
			$hotel=mysqli_real_escape_string($conn,test_input($_POST["hotel"]));

			$query="update `placetable` set plcaeName='".$name."',"."details='".$details."',"."category='".$category."',"."hotel='".$hotel."',"."capacity='".$capacity."',lastEdit='".$_SESSION['email']."' where id=".$_SESSION["id"];
			
			if ($conn->query($query) === TRUE)
			{
				echo'<h1 class="text-center center-block redColor"> 修改成功</h1>';
				$link='editInfo.php?id='.$_SESSION["id"];
				$_SESSION["id"]=0;
				header('location:'.$link);
			}
			else
			{
				echo '<h1  class="text-center center-block redColor">出错了！</h1>';
			}
		}

		if(!empty($_GET["id"]))
		{
			$sql="select * from `placetable` where `id`=".$_GET["id"];
			$_SESSION["id"]=$_GET["id"];
			$result=$conn->query($sql);
			$allData=$result->fetch_assoc();
		}
		else
		{
			echo '<h1 class="text-center center-block redColor">找不到地方</h1>';
		}
	}
	else
	{
		$conn->close();
		header('location:adminLogin.php');
		exit();
	}
	$conn->close();
?>
<body>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <div class="header text-center center-block">
  <h2>修改信息</h2>
  </div>
  <form action="editInfo.php" method="post">
    <div class="form-group">
      <label for="name">地名</label>
      <input type="text" class="form-control" name="name" maxlength="90"
      placeholder="<?php echo $allData["plcaeName"] ?>" required> 
      <br/>
      
       <label for="details">简介</label>
      <textarea class="form-control" rows="5" name="details" maxlength="220" placeholder="<?php echo $allData["details"] ?>" required></textarea>
      <br/>

        <label for="hotel">酒店（默认）</label>
      <textarea class="form-control" rows="3" name="hotel" maxlength="200" placeholder="<?php echo $allData["hotel"] ?>" required></textarea>
      <br/>

       <label for="capacity">容量</label>
      <input type="number" class="form-control" name="capacity" placeholder="<?php echo $allData["capacity"] ?>" required> 
      <br/>

   <label for="category">类别(当前是: <?php echo $allData["category"] ?>)</label><br>
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