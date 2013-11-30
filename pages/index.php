<div id="bubble" class="dont_show overlay_blocker" >
	<div id="bubbleText" class="centered_content">
		<img src="img/loading.gif" /><br>
		<h5 style="color: #EEE;">Loading...</h5>
	</div>
</div>

	<div class="row-fluid">
		<div id="leftSideBar" class="span3">
			<div id="logoHolder" class="box_it centered_content">
				<a href="http://www.memegur.com"><img src="img/logo.png" /></a>
			</div>
			
			<div class="box_it">
				<h5>Can't find what you're looking for ? Search for meme</h5>
				<input type="text" class="input-medium search-query" placeholder="Search meme" id="searchBy" name="searchBy"/>
				<hr>
				<div id="bySearchResults" class="resultList centered_content"><!-- Search results --></div>
			</div>
			
			<div class="box_it">
				<h5>Top text</h5>
				<div class="control-group centered_content">
					<textarea id="topTextBox" class="memeInput" placeholder="Enter top text here..."></textarea>
				</div>
				
				<h5>Bottom text</h5>
				<div class="control-group centered_content">
					<textarea id="bottomTextBox" class="memeInput" placeholder="Enter bottom text here..."></textarea>
				</div>
			</div>
			
			<div class="box_it">
				<form id="publishMeme" method="post" action="?mode=publish">
				<input type="hidden" value="null" name="imgId" id="imgId"/>
				<button id="pubMeme" type="submit" class="btn btn-success btn-large">Publish   <img id="publishLoading" src="img/loading3.gif" class="dont_show"/></button>
				</form>
				<h6 id="publishInfo"></h6>
			</div>
			
			<div class="box_it centered_content">
				<a href="?mode=terms">Terms of service</a>
			</div>
			

		</div>
		<div id="builder" class="span6">
			<div id="canvasHolder" class="box_it" style="margin: 0.5em auto;">
				<div class="row-fluid">
					<div id="memeLoad" class="span2"><img src="img/loading2.gif" /></div>
					<div class="span10" ><h2 id="memeName">Success kid</h2></div>
				</div>
				<article>
					<!-- canvas loads here-->
				</article>
			</div>
		</div>
		<div id="rightSideBar" class="span3 text_right">
			<div class="box_it">
				<h6>Sort memes by</h6>
				<select id="listBy">
					<option value="byMostUsed">Most Used</option>
					<option value="byPopular">Popular</option>
					<option value="byNew">Newest</option>
					<option value="byTrending">Trending</option>
				</select>
				<hr>
				<div id="byWhatResults" class="resultList centered_content"><!-- Sorted list results come here --><img src="img/loading2.gif" /><h5>Fetching memes...</h5></div>
				<hr>
				<div id="controls" class="row-fluid">
					<button id="prevByResults" class="offset1 span4 btn btn-primary"><i class="icon-backward icon-white"></i></button>
					<button id="nextByResults" class="offset2 span4 btn btn-primary"><i class="icon-forward icon-white"></i></button>
				</div>
			</div>
			<div class="box_it">
			<h6>Create a custom meme</h6>
				<button class="btn btn-success btn-large" onclick='window.location="?mode=custom"'>Create a custom meme</button>
			</div>
		</div>
	</div>
>