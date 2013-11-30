$(function() {

	var clipImgur;
	var clipLink;
	var clipMemegur;
	

	$("#imgurLink").ready(function(){
		$("#imgurLink").val(imgur);
	});
	
	$("#directLink").ready(function(){
		$("#directLink").val(link);
	});
	
	$("#memegurLink").ready(function(){
		$("#memegurLink").val(memegur);
	});
	
	$("#memeHolder").ready(function(){
		$("#memeHolder").html('<img id="yayMeme" src="'+link+'"/>');
	});		
});