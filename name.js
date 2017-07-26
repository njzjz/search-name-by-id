function search(id,did){ 
	$.post("name.php",{id:id,ajax:1},function(data){   
		if(data==''){//0 
		}else{	
			$(did).html(data);
		}    
	});
}
$(function(){
	$("#form").submit(function(e) {
		search($("#input").val(),"#output");
		return false;
	});
});