    $(document).ready(function() {
	
	$('#listelement').click(function() {
	
	//positionPopup();
	
	//$("#popupContact").show("slow");
	
    alert("Hello world!");
	});
	
	
	$('#button').click(function(){  
    //centering with css

    centerPopup();  
    //load popup  
    loadPopup();  
    }); 
	
	
	
	//LOADING POPUP  
    //Click the button event!  
    $('#button').click(function(){  
    //centering with css

    centerPopup();  
    //load popup  
    loadPopup();  
    });  
	
	
	//CLOSING POPUP  
    //Click the x event!  
    $("#popupContactClose").click(function(){  
    disablePopup();  
    });  
    //Click out event!  
    $("#backgroundPopup").click(function(){  
    disablePopup();  
    });  
	
	//CLOSING POPUP  
    //Click the x event!  
    $("#popupPictureClose").click(function(){  
    disablePicturePopup();  
    });  
    //Click out event!  
    $("#backgroundPicturePopup").click(function(){  
    disablePicturePopup();  
    }); 
	
	/*
	// Funkar inte :(
	//Press Escape event!  
    $(document).keypress(function(e){  
    if(e.keyCode==27 &amp;amp;amp;amp;amp;amp;&amp;amp;amp;amp;amp;amp; popupStatus==1){  
    disablePopup();  
    }  
    });  
	*/
	
});

