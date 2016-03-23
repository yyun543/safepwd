<?php
// 简易安全密码生成器 by: lyx site:www.vipcloud.cc
// 根据密码和区分代号生成唯一的16位密码
function my_encode($pwd,$code,$token_off=true){
	if(!$token_off){
		// 默认不开启此设置，若为了提高安全性开启，请配置此处
		$token = 'UFg72jhtDHq0EwsYmRc18bNKGA8yRezU';
	}else{
		$token = '';
	}
	
	$stra = $pwd.$code.$token;
	$stra = crypt(md5(md5(~$stra)),hash("sha512",$code.$stra));
	$strb = crypt(sha1($stra.$token)^md5(hash("sha512",$code.$stra)),$stra^$token);
	$strb = preg_replace('/[^a-zA-z0-9]/','',base64_encode($stra.$strb));
	return substr($strb,2,17);
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>使用密码生成器 - 杜绝安全隐患</title>

    <!-- Bootstrap core CSS -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<style>
		body {
		  min-height: 1000px;
		}

		.navbar-static-top {
		  margin-bottom: 19px;
		}
	</style>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://v3.bootcss.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">密码生成器</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">密码生成器</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">首页</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>温馨提示：</h2>
        <p>您还在为所有的帐号分配同一个密码么？这样很不安全哦！</p>
        <p>使用密码生成器，填写记忆密码+区分代号，立刻得到不一样的专有安全密码哦！</p>
        <p>例如：<br>记忆密码：123456 + 区分代号：qq.mail = lqT3d2bAtzOU1WdzF</p>
        <p>
		<form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		  <div class="form-group">
		    <label for="mpasswd1">记忆密码</label>
		    <input name="mpwd" type="text" class="form-control" id="mpasswd1" placeholder="请输入您的密码">
		  </div>
		  <div class="form-group">
		    <label for="mpasswd2">区分代号</label>
		    <input name="mcode" type="text" class="form-control" id="mpasswd2" placeholder="请输入区分代号">
		  </div>
		  <button type="submit" class="btn btn-primary">立刻生成</button>
		</form>
        </p>
        <p>
        <?php
		  	if(isset($_POST['mpwd']) && isset($_POST['mcode'])){
		  		//最后一个参数默认关闭，出于安全考虑建议开启后配置自己的token
		  		echo '您的专有安全密码为：'.my_encode(trim($_POST['mpwd']),trim($_POST['mcode']),false);
		  	}
		?>
        </p>
      </div>

    </div> <!-- /container -->



    <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://v3.bootcss.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
