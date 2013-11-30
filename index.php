<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="img/favicon.png" >
	<link href='http://fonts.googleapis.com/css?family=Coda:800' rel='stylesheet' type='text/css'>
	<title>Memegur | The simple meme creator</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=0.5, minimum-scale=0.5, maximum-scale=0.5" />
</head>
	<body>
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
		<?php 
			if(file_exists($jsPath.$mode.".js")){
				echo "<script type='text/javascript' src='".$jsPath.$mode.".js"."'></script>";
			}
		?>
	</body>
</html>
