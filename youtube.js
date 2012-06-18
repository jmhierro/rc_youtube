function showVideo(id){
	$('<div id="video" class="video"><div onClick="hideVideo()">Hide</div><br><object width="320" height=240><param name="movie" value="https://www.youtube.com/v/'+id+'"></param><param name="wmode" value="transparent"></param><embed src="https://www.youtube.com/v/'+id+'" type="application/x-shockwave-flash" wmod="transparent" width="320" height=240 scale="scale" controls="0"></embed></object></div>').appendTo('#view-youtube');
    $("#message-part-youtube").hide("slow");
}

function hideVideo(){
	$("#message-part-youtube").show("slow");
	$("#video").remove();
}