<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="img/favicon.png" >
	<link href='http://fonts.googleapis.com/css?family=Coda:800' rel='stylesheet' type='text/css'>
	<title>Memegur | The simple meme creator</title>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=0.5, minimum-scale=0.5, maximum-scale=0.5" />
</head>
	<body>
	<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Memegur</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Make a meme</a></li>
        <li><a href="?mode=custom">Custom meme</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="?mode=terms">Terms of Service</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		<?php
	
		$pagesPath = "pages/";
		$jsPath = "js/";
	
		if(isset($_GET['mode'])){
			$mode = $_GET['mode'];
		}
		else{
			$mode = 'index';
		}
		
		if(file_exists($pagesPath.$mode.".php")){
			include($pagesPath.$mode.".php");
		}
		else{
			die("You fuckin' chuut face...!");
		}
		
	?>
		<!-- Java script -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<?php 
			if(file_exists($jsPath.$mode.".js")){
				echo "<script type='text/javascript' src='".$jsPath.$mode.".js"."'></script>";
			}
		?>
	</body>
</html>
