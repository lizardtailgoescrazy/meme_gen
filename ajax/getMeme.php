<?php
	if(isset($_GET['id'])){
		$remote = "http://cdn.memegenerator.net/images/400x/".$_GET['id'];
		$local = "../img/memes/".$_GET['id'];
		if(!(file_exists($local))){
			//print("debug - Had to copy file: $dest.");
			$image = file_get_contents($remote);
			if($image == false){
				echo false;
				exit();
			}
			echo file_put_contents($local, $image);
		}
		echo true;
	}
	else{
		header("Location: http://www.memegur.com");
	}
?>