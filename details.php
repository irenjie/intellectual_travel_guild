<?php 
    session_start();
    require 'admin/header.php';
    require 'admin/sql.php';

	if(empty($_SESSION['user']) || empty($_SESSION['mail'])||empty($_GET["place"]))
	{
		$conn->close();
		header('location:index.php');
		exit();
	}   
	else
	{
			$sql="select * from `placetable` where `plcaeName`='".$_GET["place"]."'";
			$result=$conn->query($sql);
			$allData=$result->fetch_assoc();
	} 


    $place=strtolower(mysqli_real_escape_string($conn,test_input($_GET["place"])));
$conn->close();
?>
<body>
	<div class="container">
	<a href="index.php"><button class="btn btn-danger btn-lg"> &#8592 主页</button></a>
	<h2 class="text-center center-block">地方简介</h2>
	 <div class="table-responsive "> 
	 	 <table class="table table-bordered">
	 	 	    <thead>
			      <tr>
			        <th>地名</th>
			        <th>简介</th>
			        <th>类别</th>
			        <th>酒店</th>
			        <th>人数</th>
			        <th>花费</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php
				    echo "<td>".$allData["plcaeName"]."</td>";
					echo "<td>".$allData["details"]."</td>";
					echo "<td>".$allData["category"]."</td>";
					echo "<td>".$allData["hotel"]."</td>";
					echo "<td>".$allData["capacity"]."</td>";
					echo "<td>".$allData["count"]."</td>";
				?>
			    </tbody>

	 	 </table>
	</div>
	<div class="text-center center-block">
	<?php 
	if ($place=='杭州') 
	{
		echo '<iframe src="places/hangzhou.html" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>';
	
	 }
	 else if ($place=='上海') 
	 {
	 	echo '<iframe src="places/shanghai.html" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>';
	 }
	 else
	 {
	 	echo '<h1>抱歉！加载地图失败</h1>';
	 }
	 ?>
	</div><br>
	<?php echo '<a href="bookNow.php?place1='.$place.'"'. 'class="btn btn-success btn-lg text-center">加入计划</a>'; ?>
	</div>
</body>
</html>