var browserName = navigator.appName;
if(browserName=="Microsoft Internet Explorer"){
	window.location.href="https://www.google.com/intl/en/chrome/browser/";
}
function readURL(input, img_id){
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#'+img_id).attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}
function show_image_uploader(type){
	var uploader = document.getElementById("image_uploader_type");
	switch(parseInt(type)){
		case 1:
			uploader.innerHTML="<img src=\"d\" width='550' id='banner_img' class=\"banner_size\" /><input type='file' id='banner_upload' onchange='readURL(this, \"banner_img\")' />";
			break;
		case 2:
			uploader.innerHTML="<img src=\"d\" width='550' id='featured_img' class=\"banner_size\" /><input type='file' id='featured_upload' id='featured_upload' onchange='readURL(this, \"featured_img\")' />";
			break;
		case 3:
			uploader.innerHTML="";
			break;
		default:
			alert("Please choose from the given options");
	}
}
var torInner = "<ul class=\"no_bullets forEmployment\" style=\"position:relative;left:20px;\">\
		<li>\
			<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"button\" onClick='forEmployment()' id=\"forEmployment\">For Employment</button><br /><br />\
			<div id=\"forEmploymentInner\"></div>\
		</li>\
		<li>\
			<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"button\" id=\"forFurtherStudies\">For further studies</button> (Transfer Credentials/Honorable Dismissal - <strong>Note: to be issued only ONCE</strong>)\
		</li>\
		<li>\
			<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"button\" onClick='torOthers()' id=\"torOthers\">Others</button>&nbsp;&nbsp;&nbsp;<span id='torOthersOutput'></span>\
		</li>\
	</ul>";
var forEmploymentInner = "<ul>\
				<li style=\"padding:10px;\"><strong>Level</strong>\
					<ul>\
						<li><div class=\"btn-group\" data-toggle=\"buttons-radio\">\
							  <button type=\"button\" class=\"btn btn-primary\">Graduate</button>\
							  <button type=\"button\" class=\"btn btn-primary\">Undergraduate</button>\
							 </div>\
						</li>\
					</ul>\
				</li>\
				<li style=\"padding:10px;\"><strong>Type of Application</strong>\
					<ul>\
						<li><div class=\"btn-group\" data-toggle=\"buttons-radio\">\
							  <button type=\"button\" class=\"btn btn-primary\">New</button>\
							  <button type=\"button\" class=\"btn btn-primary\">Renewal</button>\
							 </div>\
						</li>\
					</ul>\
				</li>\
			</ul>";
function torChoice(){
		$("#torInner").html(torInner).show();
		$("#torChoice").attr("onClick", "closetorInner()");
}
function closetorInner(){
	$(".forEmployment").remove();
	$("#torChoice").attr("onClick", "torChoice()");
}
function forEmployment(){
	$("#forEmploymentInner").html(forEmploymentInner).show();
	$("#forEmployment").attr("onClick", "closeForEmployment()");
}
function closeForEmployment(){
	$("#forEmploymentInner ul").remove();
	$("#forEmployment").attr("onClick", "forEmployment()");
}
function torOthers(){
	$("#torOthersOutput").html("<input type='text' placeholder='Specify' />").show();
	$("#torOthers").attr("onClick", "closetorOthers()");
}
function closetorOthers(){
	$("#torOthersOutput input").remove();
	$("#torOthers").attr("onClick", "torOthers()");
}
$(document).ready(function(){
	$('.carousel').carousel({
	  interval: 5000, pause: "hover"
	});
	$('#datepicker').datepicker({
					inline: true
				});
	$(".latest_news_content").hover(function(){
		$(this).css({"overflow-y":"scroll","padding-left":"15px","padding-right":"15px"});
		//$(".arrow_down").css({"visibility":"hidden"});
	}, function(){
			$(this).css({"overflow":"hidden","padding-left":"15px","padding-right":"34px"});
			//$(".arrow_down").css({"visibility":"visible"});
	});
});