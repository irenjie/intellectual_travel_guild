<?php
	//启动会话
    session_start();
    require 'admin/header.php';
    require 'admin/sql.php';

	//创建并存储user，mail变量
    if(empty($_SESSION['user']) || empty($_SESSION['mail']))
    {
    	echo '<body class="backPic"><div class="container"><div class="row space"><div class="col-md-2"></div><div class="col-md-8 text-center">';
    	echo'<h1 class="text-center center-block intelligent">智能旅游协会</h1>';
        echo'<h2 class="travelGuideHeader" style="color: white">你的 <span class="travelGuide">专属</span> 导游.</h2>';
    	echo '<a href="user/login.php"><button type="button" class="btn btn-success btn-lg adminButton">登 录</button></a><br>';
	   	echo '<a href="user/reg.php"><button type="button" class="btn btn-warning btn-lg adminButton2">还没有账号？创建一个</button></a><br>';
	   	echo '</div><div class="col-md-2"></div></div></div></body></html>';
	   	exit();
    }

?>
<body class="backPic">
<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-8">
		<div class="btn-group text-center center-block adminButton">
		<a href="autoSuggest.php"><button type="button" class="btn btn-primary">智能推荐</button></a>
		<a href="user/booking.php"><button type="button" class="btn btn-success">我的计划</button></a>
    	<a href="user/pass.php"><button type="button" class="btn btn-warning">更改密码</button></a>
    	<a href="user/logout.php"><button type="button" class="btn btn-primary">退出登录</button></a>
		</div>
      <form style="border : none;" action="details.php" method="get">
	    <h3 class="text-center center-block intelligent space">Welcome!!</h3><br />  
	    <label class="redColor text-center center-block">输入你的目的地</label>  
	    <input type="text" name="place" id="country" class="form-control" placeholder="输入你的目的地" />  
	    <div id="countryList"></div><br>

      <div class="text-center center-block">
      <button type="submit" class="btn btn-danger btn-lg">搜索</button>
      </div>

      </form>
	</div>
  <div class="col-md-2"></div>
  </div>
</div>
</body>
</html>
 <script>  
 $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }
           else
           {
            $('#countryList').fadeOut(); 
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#country').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });  
 </script>  