<?php

	session_start();
	
	function getIPFromEnv() {
		 $ipaddress = '';
		 if (getenv('HTTP_CLIENT_IP'))
			 $ipaddress = getenv('HTTP_CLIENT_IP');
		 else if(getenv('HTTP_X_FORWARDED_FOR'))
			 $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		 else if(getenv('HTTP_X_FORWARDED'))
			 $ipaddress = getenv('HTTP_X_FORWARDED');
		 else if(getenv('HTTP_FORWARDED_FOR'))
			 $ipaddress = getenv('HTTP_FORWARDED_FOR');
		 else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		 else if(getenv('REMOTE_ADDR'))
			 $ipaddress = getenv('REMOTE_ADDR');
		 else
			 $ipaddress = false;

		 return $ipaddress; 
	}
	
	function getIPFromServer() {
		 $ipaddress = '';
		 if (isset($_SERVER['HTTP_CLIENT_IP']))
			 $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		 else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			 $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		 else if(isset($_SERVER['HTTP_X_FORWARDED']))
			 $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		 else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			 $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		 else if(isset($_SERVER['HTTP_FORWARDED']))
			 $ipaddress = $_SERVER['HTTP_FORWARDED'];
		 else if(isset($_SERVER['REMOTE_ADDR']))
			 $ipaddress = $_SERVER['REMOTE_ADDR'];
		 else
			 $ipaddress = false;

		 return $ipaddress; 
	}		
	
	if(!isset($_POST["uData"])){
		echo '<h1>Aye ! Stop trying to fuck shit up, you twat !</h1>';
		echo '<a href="http://www.memegur.com">Click here to go to the homepage...</a>';
		die();
	}
	
	if(isset($_SESSION['published'])){
		unset($_SESSION['published']);
		header("Location: http://www.memegur.com?mode=custom");
	}
	
	$IP = getIPFromServer();
	if($IP == false){
		$IP = getIPFromEnv();
	}
	
	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$time = $date->format('d-m-Y H:i:s');

	$query =$_POST['imgId'].", ".$time.", ".$IP."\n";
	
	file_put_contents("pages/log", $query, FILE_APPEND | LOCK_EX);
	
	$data = $_POST['uData'];
	$encodedData = str_replace(' ','+',$data);
	$decocedData = base64_decode($encodedData);
	file_put_contents($_POST["localLoc"], $decocedData);
	
	$_SESSION['published'] = true;
	
	$imgSrc = "img/custom/".$_POST['imgId'];
	$linkMemegur = "http://www.memegur.com?mode=view&custom=".$_POST['imgId'];
	$postMemegur = "http://www.reddit.com/r/adviceanimals/submit?url=http%3A%2F%2Fwww.memegur.com?mode=view%26custom=".$_POST['imgId'];
	
?>

<div class="row-fluid">
		<div id="leftSideBar" class="offset1 span3">
			<div id="logoHolder" class="box_it centered_content">
				<a href="http://www.memegur.com"><img src="img/logo.png" /></a>
			</div>
		</div>
	<div id="builder" class="span5 box_it">
		<h2>Successfully created meme...!</h2>
		<div class="centered_content" >
			<div id="memeHolder">
				<?php echo "<img src='".$imgSrc."' id='yayMeme' />"; ?>
			</div>
			
			<hr>

			<div class="row-fluid">
				<div class="span9">
					<div class="input-prepend" style="width: 80%;">
						<span class="add-on" >Memegur link</span>
						<input type="text" id="memegurLink" value="<?php echo $linkMemegur; ?>"></input>
					</div>
				</div>
				<button class="btn span3 push_up_3px" id="cpMemegur" onclick="window.location='<?php echo $postMemegur; ?>'">Post to reddit</button>
			</div>
				
		</div>
	</div>
</div>