//0 means disabled; 1 means enabled;  
var popupStatus = 0;  

function showPicturePopup() {
	//centering with css
    centerPicturePopup();  
    //load popup  
    loadPicturePopup();
}

function showPopup() {
	//centering with css
    centerPopup();  
    //load popup  
    loadPopup();
}

//loading popup with jQuery magic!  
function loadPopup(){  
//loads popup only if it is disabled  
	if(popupStatus==0){  
		$("#backgroundPopup").css({  
		"opacity": "0.7"  
		});  
		$("#backgroundPopup").fadeIn("slow");  
		$("#popupContact").fadeIn("slow");  
		popupStatus = 1;  
		}  
}

function loadPicturePopup(){  
//loads popup only if it is disabled  
	if(popupStatus==0){  
		$("#backgroundPicturePopup").css({  
		"opacity": "0.7"  
		});  
		$("#backgroundPicturePopup").fadeIn("slow");  
		$("#popupPicture").fadeIn("slow");  
		popupStatus = 1;  
		}  
}

//disabling popup with jQuery magic!  
function disablePopup(){  
//disables popup only if it is enabled  
if(popupStatus==1){  
$("#backgroundPopup").fadeOut("slow");  
$("#popupContact").fadeOut("slow");  
popupStatus = 0;  
}  
}

function disablePicturePopup(){  
//disables popup only if it is enabled  
if(popupStatus==1){  
$("#backgroundPicturePopup").fadeOut("slow");  
$("#popupPicture").fadeOut("slow");  
popupStatus = 0;  
}  
} 

//centering popup  
function centerPopup(){  
//request data for centering  
var windowWidth = document.documentElement.clientWidth;  
var windowHeight = document.documentElement.clientHeight;  
var popupHeight = $("#popupContact").height();  
var popupWidth = $("#popupContact").width();  
//centering  
$("#popupContact").css({  
"position": "absolute",  
"top": popupHeight/2,  
"left": popupWidth*2  
});  
//only need force for IE6  
  
$("#backgroundPopup").css({  
"height": windowHeight  
});  
  
}  

//centering popup  
function centerPicturePopup(){  
//request data for centering  
var windowWidth = document.documentElement.clientWidth;  
var windowHeight = document.documentElement.clientHeight;  
var popupHeight = $("#popupPicture").height();  
var popupWidth = $("#popupPicture").width();  
//centering  
$("#popupPicture").css({  
"position": "absolute",  
"top": popupHeight/2,  
"left": popupWidth*2  
});  
//only need force for IE6  
  
$("#backgroundPicturePopup").css({  
"height": windowHeight  
});  
  
}  

