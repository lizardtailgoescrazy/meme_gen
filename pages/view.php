<?php
	if(isset($_GET['link']))
		$link = "http://i.imgur.com/".$_GET['link'].".jpg";
	else if(isset($_GET['custom']))
		$link = "img/custom/".$_GET['custom'];
	else
		header("Location: http://www.memegur.com");
?>
<div class="row-fluid">
	<div id="leftSideBar" class="offset1 span3">
		<div id="logoHolder" class="box_it centered_content">
			<a href="http://www.memegur.com"><img src="img/logo.png" /></a>
		</div>
	</div>
	<div id="builder" class="span5 box_it centered_content">
		<img src="<?php echo $link;?>"; style="margin: auto;" alt="Image"/>
</div>