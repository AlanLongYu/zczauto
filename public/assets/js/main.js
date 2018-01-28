$(document).ready(function(){
	function IsPC() {
		var userAgentInfo = navigator.userAgent;
		var Agents = ["Android", "iPhone",
					"SymbianOS", "Windows Phone",
					"iPad", "iPod"];
		var flag = true;
		for (var v = 0; v < Agents.length; v++) {
			if (userAgentInfo.indexOf(Agents[v]) > 0) {
				flag = false;
				break;
			}
		}
		return flag;
	}
	
	if(!IsPC()){
		$(".header-nav li,#login-icon").click(function(){
			$(this).children(".submenu").toggle();
		});
	}

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