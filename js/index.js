	var App;
	var jqCanvas;
	var imageObj = new Image();
	var w = 400;
	var h = 400;
	var leftSideBar = null;
	var rightSideBar = null;
	var canvasHolder = null;
	var topTextSize = 68;
	var bottomTextSize = 68;
	var byPageNo = 0;
	var sortBy = "byMostUsed";
	App = {};
	
	$(window).load(function() {
		clearCanvas();
		App.ctx.drawImage(imageObj, 0, 0);
		watermarkMeme();
		var t_topText = $("#topTextBox").val();
		var t_bottomText = $("#bottomTextBox").val();
		writeTopText(t_topText);
		writeBottomText(t_bottomText);
	});

	App.init = function() {
		App.canvas = document.createElement('canvas');
		App.canvas.height = h;
		$("canvasHolder").height(h+20);
		App.canvas.width = w;
		$("canvasHolder").width(w+20);
		document.getElementsByTagName('article')[0].appendChild(App.canvas);
		App.ctx = App.canvas.getContext("2d");
		App.ctx.fillStyle = "solid";
		jqCanvas = $("canvas");
	};

	function bubbleElementById(elementId){
		var bubble = $("#bubble");
		var bubbletext = $("#bubbleText");
		var element = $("#"+elementId);
		var elementPos = element.position();
		if(element){
			bubble.css({
				"position":"absolute", 
				"top": elementPos.top + "px",
				"left": elementPos.left + "px",
				"display": "block"
			});
			bubble.width(element.width());
			bubble.height(element.height());
			bubbletext.css({
				"margin-top": (element.height()/1.8)+"px"
			});
		}
		else{
			alert(elementId+" not found !");
		}
	}
	
	function popBubble(){
		var bubble = $("#bubble");
		var bubbletext = $("#bubbleText");
		bubble.width(0);
		bubble.height(0);
		bubble.css({
				"display": "none"
			});
	}
		
	function clearCanvas(){
		var h = App.canvas.height;
		var w = App.canvas.width;
		App.ctx.clearRect(0,0,w,h);
	}

	function changeImage(url){
		imageObj.src = url;
	}
	
	function checkForFile(file, filename){
		var status = true;
		$.ajax({
			url: file,
			async: false,
			success: function(response){
				//File exists, do nothing
				status = true;
			},
			error: function(response){
				$("#memeName").html("Fetching meme...");
				$.ajax({
					url: "ajax/getMeme.php?id="+filename,
					cache: false,
					async: false,
					success: function(response){
						status = true;
					},
					error: function(response){
						status = false;
					}
				});
			}
		});
		return status;
	}
	
	function getByList(options){
		$.post("ajax/genList.php", { requestType: options} , function(data) {
			if(data === false){
				//Error
			}
			else{
				$("#byWhatResults").html(data);
				popBubble();
				//Add event handlers
				$(".byResult").click(function(){
					$("#memeLoad").css({"display": "block"});
					$("#memeName").html("Loading meme...");
					var dest = $(this).attr("destination");
					var memeName = $(this).attr("mName");
					if(sortBy === "byMostUsed"){
						dest = "img/cached/" + dest;
					}
					else{
						dest = "img/memes/" + dest;
						if(!checkForFile(dest, $(this).attr("destination"))){
							$("#memeName").html("Something went wrong...");
							return false;
						}
					}
					clearCanvas();
					changeImage(dest);
					$("#memeName").html(memeName);
					var t_topText = $("#topTextBox").val();
					var t_bottomText = $("#bottomTextBox").val();
					writeTopText(t_topText);
					writeBottomText(t_bottomText);
				});
			}
		});		
	}
	
		function getSearchList(options){
		$.post("ajax/genList.php", { requestType: options} , function(data) {
			if(data === false){
				//Error
			}
			else{
				$("#bySearchResults").html(data);
				popBubble();
				//Add event handlers
				$(".byResult").click(function(){
					$("#memeLoad").css({"display": "block"});
					$("#memeName").html("Loading meme...");
					var dest = $(this).attr("destination");
					var memeName = $(this).attr("mName");
					dest = "img/memes/" + dest;
					if(!checkForFile(dest, $(this).attr("destination"))){
						$("#memeName").html("Something went wrong...");
						return false;
					}
					clearCanvas();
					changeImage(dest);
					$("#memeName").html(memeName);
					var t_topText = $("#topTextBox").val();
					var t_bottomText = $("#bottomTextBox").val();
					writeTopText(t_topText);
					writeBottomText(t_bottomText);
				});
			}
		});		
	}
	
	function writeTopText(text) {
		if(text.length == 0){
			text = "Top text";
		}
		var x = w*(0.5);
		var y = 0;
        var words = text.split(' ');
		var context = App.ctx;
		var maxWidth = w*(0.95);
		var maxHeight = h*(0.25);
		var lineHeight = topTextSize + (topTextSize*(0.20));
		var lines = new Array();
		var lineNo = 0;
		var flag = true;
		
		context.fillStyle = 'white';
		context.strokeStyle = "black";
		context.textAlign = 'center';
		context.shadowColor = 'black';
		context.shadowBlur = 2;
		context.shadowOffsetX = 0;
		context.shadowOffsetY = 0;
		
		do{
			context.font = topTextSize+'px Customeme';
			context.lineWidth = Math.round(topTextSize*0.10);
			lineHeight = topTextSize + (topTextSize*(0.20));
			flag = true;
			lines = new Array();
			lines[0] = '';
			lineNo = 0;
			
			for(var n = 0; n < words.length; n++){
				var testLine = lines[lineNo] + words[n] + ' ';
				var metrics = context.measureText(testLine);
				var testWidth = metrics.width;
				
				if(((lineNo+1)*lineHeight)>maxHeight){
					flag = false;
					topTextSize = Math.round(topTextSize*(0.90));
					break;
				}
				
				if (testWidth > maxWidth && n > 0){
					lineNo++;
					lines[lineNo] = words[n] + ' ';
				}
				else{
					lines[lineNo] = testLine;
				}
			}

		}while(flag != true);
		
		var length = lines.length;
		for (var i = 0; i < length; i++) {
			context.strokeText(lines[i], x, lineHeight+y+(i*lineHeight));
			context.fillText(lines[i], x, lineHeight+y+(i*lineHeight));
		}
		
    }
	
	function writeBottomText(text) {
		if(text.length == 0){
			text = "Bottom text";
		}
		var x = w*(0.5);
		var y = h*(0.98);
        var words = text.split(' ');
		var context = App.ctx;
		var maxWidth = w*(0.95);
		var maxHeight = h*(0.25);
		var lineHeight = bottomTextSize + (bottomTextSize*(0.20));
		var lines = new Array();
		var lineNo = 0;
		var flag = true;
		
		context.fillStyle = 'white';
		context.strokeStyle = "black";
		context.textAlign = 'center';
		context.shadowColor = 'black';
		context.shadowBlur = 2;
		context.shadowOffsetX = 0;
		context.shadowOffsetY = 0;
		
		do{
			context.font = bottomTextSize+'px Customeme';
			context.lineWidth = Math.round(bottomTextSize*0.10);
			lineHeight = bottomTextSize + (bottomTextSize*(0.20));
			flag = true;
			lines = new Array();
			lines[0] = '';
			lineNo = 0;
			
			for(var n = 0; n < words.length; n++){
				var testLine = lines[lineNo] + words[n] + ' ';
				var metrics = context.measureText(testLine);
				var testWidth = metrics.width;
				
				if(((lineNo+1)*lineHeight)>maxHeight){
					flag = false;
					bottomTextSize = Math.round(bottomTextSize*(0.90));
					break;
				}
				
				if (testWidth > maxWidth && n > 0){
					lineNo++;
					lines[lineNo] = words[n] + ' ';
				}
				else{
					lines[lineNo] = testLine;
				}
			}

		}while(flag != true);
		
		var length = lines.length;
		for (var i = length-1; i >= 0; i--) {
			context.strokeText(lines[i], x, y-(((length-1)-i)*lineHeight));
			context.fillText(lines[i], x, y-(((length-1)-i)*lineHeight));
		}	
    }
	
	function dataURItoBlob(dataURI) {
		var byteString = atob(dataURI.split(',')[1]);

		var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

		var ab = new ArrayBuffer(byteString.length);
		var ia = new Uint8Array(ab);
		for (var i = 0; i < byteString.length; i++) {
			ia[i] = byteString.charCodeAt(i);
		}
		
		var dataView = new DataView(ab);
		var blob = new Blob([dataView], { type: mimeString });
		return blob;
	}
	
	function watermarkMeme(){
		App.ctx.fillStyle = 'white';
		App.ctx.strokeStyle = "black";
		App.ctx.lineWidth = 1;
		App.ctx.textAlign = 'right';
		App.ctx.font = 'normal 9pt Calibri';
		App.ctx.fillText("memegur.com", w-2, h-2);
		//App.ctx.strokeText("memegur.com", w-2, h-1);
	}

	$(function() {		
		
		$("#canvasHolder").ready(function(){
			canvasHolder = $("#canvasHolder");
		});
		/*On Page Loaded, init stuff*/		
		imageObj.onload = function() {
			w = imageObj.width;
			h = imageObj.height;
			App.canvas.height = h;
			App.canvas.width = w;
			App.ctx.drawImage(imageObj, 0, 0);
			watermarkMeme();
			canvasHolder.width(w);
			var t_topText = $("#topTextBox").val();
			var t_bottomText = $("#bottomTextBox").val();
			writeTopText(t_topText);
			writeBottomText(t_bottomText);
			$("#memeLoad").css({"display": "none"});
		};
		
		/*Setters for initial stuffs*/
		imageObj.src = 'img/memes/1031.jpg';
		getByList("Generators_Select_ByMostUsed?pageIndex="+byPageNo+"&pageSize=24");
		
		$("canvas").ready(function(){
			$("#listBy").ready(function(){
				$("#listBy").change(function(){
					if(sortBy != $(this).val()){
						sortBy = $(this).val();
						bubbleElementById("byWhatResults");
						byPageNo = 0;
						$("#prevByResults").prop("disabled",true);
						if(sortBy === "byMostUsed"){
							getByList("Generators_Select_ByMostUsed?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byPopular"){
							getByList("Generators_Select_ByPopular?pageIndex="+byPageNo+"&pageSize=24&days=7");
						}
						else if(sortBy === "byNew"){
							getByList("Generators_Select_ByNew?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byTrending"){
							getByList("Generators_Select_ByTrending?pageIndex="+byPageNo+"&pageSize=24");
						}
					}
				});
				
				});
				
				$("#prevByResults").ready(function(){
					$("#prevByResults").prop("disabled",true);
					$("#prevByResults").click(function(){
						$("#nextByResults").prop("disabled",false);
						bubbleElementById("byWhatResults");
						byPageNo = byPageNo - 1;
						if(byPageNo==0){
							$("#prevByResults").prop("disabled",true);
						}
						if(sortBy === "byMostUsed"){
							getByList("Generators_Select_ByMostUsed?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byPopular"){
							getByList("Generators_Select_ByPopular?pageIndex="+byPageNo+"&pageSize=24&days=7");
						}
						else if(sortBy === "byNew"){
							getByList("Generators_Select_ByNew?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byTrending"){
							getByList("Generators_Select_ByTrending?pageIndex="+byPageNo+"&pageSize=24");
						}
					});
				});
				
				$("#nextByResults").ready(function(){
					$("#nextByResults").click(function(){
					bubbleElementById("byWhatResults");
					$("#prevByResults").prop("disabled",false);
						byPageNo = byPageNo + 1;
						if(byPageNo==7){
							$("#nextByResults").prop("disabled",true);
						}
						if(sortBy === "byMostUsed"){
							getByList("Generators_Select_ByMostUsed?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byPopular"){
							getByList("Generators_Select_ByPopular?pageIndex="+byPageNo+"&pageSize=24&days=7");
						}
						else if(sortBy === "byNew"){
							getByList("Generators_Select_ByNew?pageIndex="+byPageNo+"&pageSize=24");
						}
						else if(sortBy === "byTrending"){
							getByList("Generators_Select_ByTrending?pageIndex="+byPageNo+"&pageSize=24");
						}
					});
				});
				
				
			$(".memeInput").keyup(function(e) {
				if (e.keyCode != 13) {
					clearCanvas();
					App.ctx.drawImage(imageObj, 0, 0);
					watermarkMeme();
					var t_topText = $("#topTextBox").val();
					var t_bottomText = $("#bottomTextBox").val();
					writeTopText(t_topText);
					writeBottomText(t_bottomText);
				}
			});
			
			$("#searchBy").ready(function(){
				$("#searchBy").keydown(function(e) {
					if (e.keyCode == 13) {
						$("#bySearchResults").html('<img src="img/loading.gif" /><h5>Searching...</h5>');
						var q = $(this).val();
						q = escape(q);
						getSearchList("Generators_Search?q="+q+"&pageIndex=0&pageSize=8");
					}
				});
			});
			
			
			$(".memeInput").blur(function() {
				clearCanvas();
				App.ctx.drawImage(imageObj, 0, 0);
				watermarkMeme();
				var t_topText = $("#topTextBox").val();
				var t_bottomText = $("#bottomTextBox").val();
				writeTopText(t_topText);
				writeBottomText(t_bottomText);
			});
			
		});
		
		$("#publishMeme").ready(function(){
			$("#publishMeme").submit(function(){
				if($("#topTextBox").val().length == 0){
					alert("No top text? Why ?");
					$("#topTextBox").focus();
					return false;
				}
				if($("#bottomTextBox").val().length == 0){
					alert("No bottom text? Why ?");
					$("#bottomTextBox").focus();
					return false;
				}
			
				if(($("#imgId").val()) != "null"){
					return true;
				}
				$("#publishInfo").html("Publishing meme, please wait...");
				$("#publishLoading").css({"display": "inline"});
				var image = new Image();
				var UData = App.canvas.toDataURL('image/jpeg');//.toDataURL('image/png');
				var blob = dataURItoBlob(UData);

				var fd = new FormData(); 
				fd.append("image", blob); 
				var xhr = new XMLHttpRequest();
				xhr.open("POST", "https://api.imgur.com/3/image.json"); 
				xhr.onload = function() {   
					var json = JSON.parse(xhr.responseText);
					var status = json.success;
					if(!status){
						$("#publishInfo").html("An error occured. Please try again.");
						return false;
					}
					else{
						var link = json.data.id;
						$("#imgId").val(link);
						$("#publishMeme").submit();
						return true;
					}
				}
				xhr.setRequestHeader('Authorization', 'Client-ID a451d9a61322195');
				xhr.send(fd);				
				return false;
			});
		});
		return App.init();
	});