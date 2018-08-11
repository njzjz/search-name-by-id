function search(id,did){
	$(did).html("查询中，请稍后……")
	$.post(phpurl,{id:id,ajax:1},function(data){   
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
