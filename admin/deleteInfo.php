<?php

	session_start();
	require 'header.php';
	require 'sql.php';
	if(empty($_GET["start"]) || empty($_GET["end"]) || empty($_GET["button"]))
	{
		$_GET["start"]=0;
		$_GET["end"]=5;
		$_GET["button"]="next";
	}
	if($_SESSION['name']!=false && $_SESSION['email']!=false)
		{
			$end=$_GET["end"];
			$start=$_GET["start"];
			$sql="select * from `placetable` ORDER BY `plcaeName` ASC limit $start,$end";
			$result=$conn->query($sql);
		}
	else
		{
			header('location:adminLogin.php');
		}
if(!empty($_GET["id"]))
{
	$query="DELETE FROM `placetable` WHERE `id`=".$_GET["id"];
	if ($conn->query($query) === TRUE)

	    {
		  echo'<h1 class="text-center center-block greenColor">One data deleted</h1>';
		  $link='deleteInfo.php?start='.$_GET["start"].'&end='.$_GET["end"].'&button=next"';
		  header('location:'.$link);
		} 
	else 
	{
	    echo '<h1  class="text-center center-block redColor">出错了！</h1>';
	}
}
if($_GET["button"]=="next"&&$_GET["end"]<=$result->num_rows && empty($_GET["id"]))
{
	$_GET["start"]=$_GET["end"];
	$_GET["end"]=$_GET["end"]+5;
}
if($_GET["button"]=="pre"&&$_GET["start"]>=0 && empty($_GET["id"]))
{
	$_GET["end"]=$_GET["start"];
	$_GET["start"]=$_GET["start"]-5;
}

?>

<h2 class="text-center center-block">所有旅游地区</h2>
<div class="table-responsive"> 
 <table class="table table-bordered">
    <thead>
      <tr>
        <th>地方</th>
        <th>简介</th>
        <th>类别</th>
        <th>默认酒店</th>
        <th>容量</th>
        <th>花费</th>
        <th>移除景点</th>
        <th>修改景点</th>
      </tr>
    </thead>

    <tbody>
    <?php
    if($result->num_rows > 0)
    {
      while($allData=$result->fetch_assoc())
		  {
			echo "<tr>";
				echo "<td>".$allData["plcaeName"]."</td>";
				echo "<td>".$allData["details"]."</td>";
				echo "<td>".$allData["category"]."</td>";
				echo "<td>".$allData["hotel"]."</td>";
				echo "<td>".$allData["capacity"]."</td>";
				echo "<td>".$allData["count"]."</td>";
				echo '<td><button><a href="deleteInfo.php?start='.$_GET["start"].'&end='.$_GET["end"].'&id='.$allData["id"].'">移除</a></button></td>';
				echo '<td><button><a target="_blank" href="editInfo.php?id='.$allData["id"].'">修改</a></button></td>';
			echo "</tr>";
		  }
	}
	else
	{
		echo "<h3>No results</h3>";
	}
	$conn->close();
    ?>
    </tbody>
 </table>
 </div>
<?php
echo '<a href="deleteInfo.php?start='.$_GET["start"].'&end='.$_GET["end"].'&button=next"><button type="button" class="text-center center-block btn btn-primary adminButton">下一页 &#8594</button></a>';
echo '<a href="deleteInfo.php?start='.$_GET["start"].'&end='.$_GET["end"].'&button=pre"><button type="button" class="text-center center-block btn btn-warning adminButton">&#8592 上一页</button></a>';
?>
<div class=" text-center center-block">
	<?php echo '<a href="logout.php"><button type="button" class="btn btn-basic btn-lg adminButton">退出</button></a><br>'; ?>
</div>
</body>
</html>