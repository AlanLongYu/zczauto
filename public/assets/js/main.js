$(document).ready(function(){
	$(".hoverwx").hover(
			function(){
				$(".wximg").show();	
			}
		,function(){
			$(".wximg").hide();	
		}	
	);

	var $mq = $(".marquee").marquee({speed:100});
	$(".marquee").hover(function(){
		$mq.marquee('pause');
	},function(){
		$mq.marquee('resume');
	});
});