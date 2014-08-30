<?php
	session_start();
	function printError($msg){
		echo '<div class="box_it content_centered"><p><b>ERROR: </b>'.$msg.'</p></div>';
		exit();
	}
	
	$displayMode = "init";
	if(isset($_POST['imageURL']) && (trim($_POST['imageURL']) != "" )){
	
		if(isset($_SESSION['uploaded'])){
			unset($_SESSION['uploaded']);
			header("Location: http://www.memegur.com?mode=custom");
		}
		
		if(getimagesize($_POST['imageURL']) == false){
			printError("This is not an image. Please try again.");
		}
		$remote = $_POST['imageURL'];
		$image = file_get_contents($remote);
		if($image == false){
			printError('The file does not exist or is not accessible.');
		}
		else{
			$lengthOfID = 8;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randomString = '';
			for ($i = 0; $i < $lengthOfID; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
			}
			$ext = explode(".", $remote);
			$ext = $ext[count($ext) - 1];
			$local = "img/custom/".$randomString;
			$output = file_put_contents($local, $image);
			$displayMode = "submitted";
			$_SESSION['uploaded'] = true;
			echo '<script type="text/javascript">var imgPath = "'.$local.'"; var imgId = "'.$randomString.'"</script>';
		}
	}
	else{
		if(isset($_SESSION['uploaded'])){
			unset($_SESSION['uploaded']);
		}
		if(isset($_SESSION['published'])){
			unset($_SESSION['published']);
		}
	
	}
?>

<div class="container-fluid">
	<?php if($displayMode != "submitted"){ ?>
	<div id="builder" class="col-sm-5 box_it centered_content">
		<form id="customBuilder" method="post" action="">
			<label>If you want to use a custom image as a meme background enter the image URL below, you cannot upload from your hardrive, you can only provide internet URLs.</label>
			<input type="text" class="width_80" id="imageURL" name="imageURL" placeholder="Enter Image URL..."/></br>
			<input type="submit" class="btn btn-large btn-success" value="Use as meme background" name="customSubmit" />
		</form>
		<?php }if($displayMode == "submitted"){ ?>
		<!-- Custom image has been submitted -->
		<div id="builder">
			<div id="canvasHolder" class="box_it" style="margin: 0.5em auto;">
				<div class="box_it">
					<div class="control-group centered_content">
						<textarea id="topTextBox" class="memeInput" placeholder="TOP TEXT"></textarea>
					</div>
					
				</div>
				<article>
					<!-- canvas loads here-->
				</article>
				<div class="box_it">
					<div class="control-group centered_content">
						<textarea id="bottomTextBox" class="memeInput" placeholder="BOTTOM TEXT"></textarea>
					</div>
				</div>
				
				<div class="box_it">
					<form id="publishMeme" method="post" action="?mode=customPublish">
					<input type="hidden" value="null" name="uData" id="uData" />
					<input type="hidden" value="null" name="localLoc" id="localLoc"/>
					<input type="hidden" value="null" name="imgId" id="imgId"/>
					<button id="pubMeme" type="submit" class="btn btn-success btn-block">Publish this meme <img id="publishLoading" src="img/loading3.gif" class="dont_show"/></button>
					</form>
					<h6 id="publishInfo"></h6>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	
	<div id="rightSideBar" class="col-sm-12">
		<div class="box_it">
			<h2>Attention</h2>
			<p>
				By using memegur.com's custom meme creator you are agreeing that the image you are uploading is not NOT copy written material, 
				nor illegal in any way or form. In addition you give us consent to store all information sent to us by your computer. This data will NOT be shared with 
				any third party except in the case of legal requirement.
			</p>
			<p>
			Memegur is in no way responsible for the material you upload. You are solely responsible for the material uploaded. If your upload is deemed unacceptable 
			by the moderators, it will be deleted without your consent.
			</p>
			<p>
			For further information please visit our <br><a href="?mode=terms">Terms and services</a>
			</p>
		</div>
	</div>
</div>