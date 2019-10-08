<?php 
	session_start();
    require '../admin/header.php';
    require '../admin/sql.php';

    if(empty($_GET["start"]) || empty($_GET["end"]) || empty($_GET["button"]))
	{
		$_GET["start"]=0;
		$_GET["end"]=5;
		$_GET["button"]="next";
	}

	if(empty($_SESSION['user']) || empty($_SESSION['mail']))
		{
			header('location:login.php');
		}
	else
		{
			$start=$_GET["start"];
			$end=$_GET["end"];
			$checkSql="SELECT `bookingplace`, `hotel`, `time`, `status` , `price` FROM `bookingtable` WHERE `bookedby` ='".$_SESSION['mail']."' order by `time` DESC limit $start,$end";
			$result=$conn->query($checkSql);
			//print_r($result);
			if($_GET["button"]=="next"&&$_GET["end"]<=$result->num_rows)
				{
					$_GET["start"]=$_GET["end"];
					$_GET["end"]=$_GET["end"]+5;
				}
		}
		$conn->close();	
echo'<a href="../index.php"><button type="button" class="btn btn-primary"> &#8592 主页</button></a>';
?>
<h2 class="text-center center-block">我的旅游计划</h2>
<div class="table-responsive"> 
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>地方</th>
        <th>酒店</th>
        <th>日期</th>
        <th>花费</th>
        <th>申请状态</th>
      </tr>
    </thead>

    <tbody>
    <?php
    if($result->num_rows > 0)
    {
      while($allData=$result->fetch_assoc())
		  {
			echo "<tr>";
				echo "<td>".$allData["bookingplace"]."</td>";
				echo "<td>".$allData["hotel"]."</td>";
				echo "<td>".$allData["time"]."</td>";
				echo "<td>".$allData["price"]."</td>";
				echo "<td>".$allData["status"]."</td>";
			echo "</tr>";
		  }
	}
	else
	{
		echo "<h3>No results</h3>";
	}
    ?>
    </tbody>
 </table>
 </div>
<?php
echo '<a href="booking.php?start='.$_GET["start"].'&end='.$_GET["end"].'&button=next"><button type="button" class="text-center center-block btn btn-primary adminButton">下一页 &#8594</button></a>';

?>
</body>
</html>