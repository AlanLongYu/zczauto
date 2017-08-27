$(function(){
	
	//搜索车型数据传递
	$("#search_btn").click(function(){
		var search_inp=$("#search_inp").val();

		if(search_inp != ''){
			$(".main").load(
				'search_car',
				{'search_inp':search_inp}
			);
		}else{
			alert("请输入您要搜索的车型名称");
		}
	});
});	