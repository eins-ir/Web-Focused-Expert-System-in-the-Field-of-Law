	jQuery(function()
    {
        jQuery('textarea').autoResize();
		extraSpace : 0
    });
	
	var button51 = function(){
		document.getElementById('step501').style.display='none';
		document.getElementById('step502').style.display='block';
	}

	var button52 = function(){
		document.getElementById('step502').style.display='none';
		document.getElementById('step01').style.display='block';
	}
	
	var buttonNo51 = function(){
		document.getElementById('step501').style.display='none';
		document.getElementById('blockNo5').style.display='block';
	}

	var buttonNo52 = function(){
		document.getElementById('step502').style.display='none';
		document.getElementById('blockNo5').style.display='block';
	}