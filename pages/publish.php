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

<div class="container">
	<div id="builder" class="col-sm-12 box_it">
		<h2>Successfully uploaded to imgur...!</h2>
		<div class="centered_content" >
			
			<div id="memeHolder">
				<?php echo "<img src='http://i.imgur.com/".$_POST["imgId"].".jpg' id='yayMeme' />"; ?>
			</div>
			
			<hr>
			<h6>Give us a little visibility...?</h6>
			<div class="container-fluid">
				<div class="col-sm-offset-3 col-sm-6 col-xs-12">
					<div class="input-prepend">
						<span class="add-on" >Memegur link</span>
						<input type="text" id="memegurLink" style="width: 70%;"></input>
					</div>
				</div>
				<button class="btn btn-primary col-sm-3 push_up_3px" id="cpMemegur" onclick="window.location='<?php echo $postMemegur; ?>'">Post to reddit</button>
			</div>
			<h6>...Or not...</h6>
			<div class="row-fluid">
				<div class="col-sm-offset-3 col-sm-6 col-xs-12">
					<div class="input-prepend">
						<span class="add-on" >Imgur link</span>
						<input type="text" id="imgurLink" style="width: 70%;"></input>
					</div>
				</div>
					<button class="btn btn-primary col-sm-3 push_up_3px" id="cpImgur" onclick="window.location='<?php echo $postImgur; ?>'">Post to reddit</button>
			</div>
			
			<div class="row-fluid">
				<div class="col-sm-offset-3 col-sm-6 col-xs-12">
					<div class="input-prepend">
						<span class="add-on" >Direct link</span>
						<input type="text" id="directLink" style="width: 70%;"></input>
					</div>
				</div>
				<button class="btn btn-primary col-sm-3 push_up_3px" id="cpLink" onclick="window.location='<?php echo $postLink; ?>'">Post to reddit</button>
			</div>
				
		</div>
	</div>
</div>
<script type="text/javascript" src="ZeroClipboard.js"></script>
