<div id="bubble" class="dont_show overlay_blocker" >
	<div id="bubbleText" class="centered_content">
		<img src="img/loading.gif" /><br>
		<h5 style="color: #EEE;">Loading...</h5>
	</div>
</div>

	<div class="container-fluid">
		<div id="leftSideBar" class="col-sm-3 col-xs-4">
			<div class="box_it">
				<div id="byWhatResults" class="resultList centered_content"><!-- Sorted list results come here --><img src="img/loading2.gif" /><h5>Fetching memes...</h5></div>
				<hr>
				<div id="controls" class="container-fluid">
					<div>
					<button id="prevByResults" class="col-sm-offset-1 col-sm-4 col-xs-6 btn btn-primary"><i class="glyphicon glyphicon-backward"></i></button>
					<button id="nextByResults" class="col-sm-offset-2 col-sm-4 col-xs-6 btn btn-primary"><i class="glyphicon glyphicon-forward"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div id="builder" class="col-sm-6 col-xs-8">
			
			<div id="canvasHolder" class="box_it" style="margin: 0.5em auto;">
				<div class="row">
					<div id="memeLoad" class="col-sm-2"><img src="img/loading2.gif" /></div>
				</div>
				<div class="control-group centered_content">
					<textarea id="topTextBox" class="memeInput" placeholder="TOP TEXT"></textarea>
				</div>
				<hr>
				<article>
					<!-- canvas loads here-->
				</article>
				<hr>
				<div class="control-group centered_content">
					<textarea id="bottomTextBox" class="memeInput" placeholder="BOTTOM TEXT"></textarea>
				</div>
			</div>

		</div>
		<div id="rightSideBar" class="col-sm-3 col-xs-12 text_right hidden-xs" style="padding-top: 5em;">
			<div class="box_it">
				<form id="publishMeme" method="post" action="?mode=publish">
					<input type="hidden" value="null" name="imgId" id="imgId"/>
					<button id="pubMeme" type="submit" class="btn btn-success btn-block">Publish this meme<img id="publishLoading" src="img/loading3.gif" class="dont_show"/></button>
				</form>
				<h6 id="publishInfo"></h6>
			</div>
			<hr>
			<div class="box_it">
				<button class="btn btn-warning btn-block" onclick='window.location="?mode=custom"'>Create a custom meme</button>
			</div>
		</div>
	</div>