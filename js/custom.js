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
		App.ctx.drawImage(imageObj, 0, 0, 400, h/(w/400));
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
		
	function clearCanvas(){
		var h = App.canvas.height;
		var w = App.canvas.width;
		App.ctx.clearRect(0,0,w,h);
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
		context.shadowBlur = 10;
		
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
		context.shadowBlur = 10;
		
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
			w = 400;
			h = imageObj.height/(imageObj.width/400);
			App.canvas.height = h;
			App.canvas.width = w;
			App.ctx.drawImage(imageObj, 0, 0, w, h);
			watermarkMeme();
			canvasHolder.width(w);
			var t_topText = $("#topTextBox").val();
			var t_bottomText = $("#bottomTextBox").val();
			writeTopText(t_topText);
			writeBottomText(t_bottomText);
			$("#memeLoad").css({"display": "none"});
		};
		
		/*Setters for initial stuffs*/
		imageObj.src = imgPath;
		
		$("canvas").ready(function(){				
			$(".memeInput").keyup(function(e) {
				if (e.keyCode != 13) {
					clearCanvas();
					App.ctx.drawImage(imageObj, 0, 0, 400, h/(w/400));
					watermarkMeme();
					var t_topText = $("#topTextBox").val();
					var t_bottomText = $("#bottomTextBox").val();
					writeTopText(t_topText);
					writeBottomText(t_bottomText);
				}
			});			
			
			$(".memeInput").blur(function() {
				clearCanvas();
				App.ctx.drawImage(imageObj, 0, 0, 400, h/(w/400));
				watermarkMeme();
				var t_topText = $("#topTextBox").val();
				var t_bottomText = $("#bottomTextBox").val();
				writeTopText(t_topText);
				writeBottomText(t_bottomText);
			});
			
		});
		
		$("#customBuilder").ready(function(){
			$("#customBuilder").submit(function(){
				if($("#imageURL").val().length == 0){
					return false;
				}
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
				$("#publishInfo").html("Publishing meme, please wait...");
				var UData = App.canvas.toDataURL('image/png');
				UData = UData.substr(UData.indexOf(',')+1).toString();
				$("#uData").val(UData);
				$("#localLoc").val(imgPath);
				$("#imgId").val(imgId);
				return true;
			});
		});
		return App.init();
	});