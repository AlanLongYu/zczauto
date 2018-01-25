$(function(){
	//查询车型信息
	$("#search_btn").click(function(){
		var search_inp=$("#search_inp").val();
		var nav_id=$("#navId").val();

		if(search_inp != ''){
			$(".main").load(
				'/data/search',
				{'keyword':search_inp,'cat_id':nav_id}
			);
			return false;
		}else{
			alert("请输入您要搜索的车型名称");
			return false;
		}
	});
	
	$(document).keyup(function(event) {
		if(event.keyCode ==13){
			event.preventDefault();
			$("#search_btn").trigger("click");
			if (window.event.keyCode==13) window.event.keyCode=0;
		}
		return false;
	});
});	