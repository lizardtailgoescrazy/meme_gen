<?php	
	if(!isset($_POST["imgId"])){
		echo '<h1>Aye ! Stop trying to fuck shit up, you twat !</h1>';
		echo '<a href="http://www.memegur.com">Click here to go to the homepage...</a>';
		die();
	}
	
	$imgId = $_POST["imgId"];
	
	$postLink = "http://www.reddit.com/r/adviceanimals/submit?url=http%3A%2F%2Fi.imgur.com%2F".$imgId.".jpg";
	$postImgur = "http://www.reddit.com/r/adviceanimals/submit?url=http%3A%2F%2Fimgur.com%2F".$imgId;
	$postMemegur = "http://www.reddit.com/r/adviceanimals/submit?url=http%3A%2F%2Fwww.memegur.com?mode=view%26link=".$imgId;
?>

<script type="text/javascript">
	var imgId = '<?php echo $_POST["imgId"]; ?>';
	var link = "http://i.imgur.com/"+imgId+".jpg";
	var imgur = "http://imgur.com/"+imgId;
	var memegur = "http://www.memegur.com?mode=view&link="+imgId;
</script>

<div class="row-fluid">
		<div id="leftSideBar" class="offset1 span3">
			<div id="logoHolder" class="box_it centered_content">
				<a href="http://www.memegur.com"><img src="img/logo.png" /></a>
			</div>
		</div>
	<div id="builder" class="span5 box_it">
		<h2>Successfully uploaded to imgur...!</h2>
		<div class="centered_content" >
			
			<div id="memeHolder">
				<?php echo "<img src='http://i.imgur.com/".$_POST["imgId"].".jpg' id='yayMeme' />"; ?>
			</div>
			
			<hr>
			<h6>Give us a little visibility...?</h6>
			<div class="row-fluid">
				<div class="span9">
					<div class="input-prepend" style="width: 80%;">
						<span class="add-on" >Memegur link</span>
						<input type="text" id="memegurLink"></input>
					</div>
				</div>
				<button class="btn span3 push_up_3px" id="cpMemegur" onclick="window.location='<?php echo $postMemegur; ?>'">Post to reddit</button>
			</div>
			<h6>...Or not...</h6>
			<div class="row-fluid">
				<div class="span9">
					<div class="input-prepend" style="width: 80%;">
						<span class="add-on" >Imgur link</span>
						<input type="text" id="imgurLink"></input>
					</div>
				</div>
					<button class="btn span3 push_up_3px" id="cpImgur" onclick="window.location='<?php echo $postImgur; ?>'">Post to reddit</button>
			</div>
			
			<div class="row-fluid">
				<div class="span9">
					<div class="input-prepend" style="width: 80%;">
						<span class="add-on" >Direct link</span>
						<input type="text" id="directLink"></input>
					</div>
				</div>
				<button class="btn span3 push_up_3px" id="cpLink" onclick="window.location='<?php echo $postLink; ?>'">Post to reddit</button>
			</div>
				
		</div>
	</div>
</div>
<script type="text/javascript" src="ZeroClipboard.js"></script>
