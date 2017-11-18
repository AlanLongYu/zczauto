@extends('desktop.layout._main')


@section('mainContent')

<script type="text/javascript">
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
</script>


 
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/css/index.css') }}">
<script type="text/javascript" src="{{ _asset('assets/js/index.js') }}"></script>
<script type="text/javascript" src="{{ _asset('assets/js/roll.js') }}"></script>



<!--flash开始-->
<div class="flash relative">
	<ul class="picbox">	
		<li class="fbg1 current" style="display:list-item;">
			<div class="w-1000">
				<img src="{{ _asset('assets/images/flash_a.png')}}"/>
				<div class="right">
					<h1>第3代汽车维修资料库震撼推出</h1>
					<p>ZCZ汽修网，致力于为中国汽车维修技师提供最专业的汽车技术资料平台！第3代汽修资料库，集在线浏览、打印、下载三位一体，超1500+车型原厂权威资料，适用于电脑、平板、电脑多终端，让你从此修车不求人!</p>
					<a href="/Data/data">立即免费体验</a>
				</div>
			</div>			
		</li>

		<li class="fbg2" style="display: none;">
			<div class="w-1000">
				<div class="left">
					<h1>全新VIP会员免费体验</h1>
					<p>免费体验：2007年以前的资料全部免费！只需注册即可浏览/打印/下载！</p>
					<p>更高性价比：1年VIP仅需260元,3年VIP仅需600元！即可浏览/打印/下载全部资料！</p>
					<a href="/Vip/vip_index">立即购买VIP</a>
				</div>
				<img src="{{ _asset('assets/images/flash_b.png')}}"/>
			</div>
		</li>


	</ul>
	<ul class="switch">
		<li class="current"><a href="javascript:void(0)"></a></li>
		<li class=""><a href="javascript:void(0)"></a></li>
		<!--<li class=""><a href="javascript:void(0)"></a></li>-->
	</ul>
</div>
<!--flash结束-->


<!--二维码开始-->
<div class="div-code w-1000 clearfix">
	<div class="code">
		<img src="{{ _asset('assets/images/index_phone.png')}}"/>
		<h4>扫描二维码访问手机网页版</h4>
		<p>请使用苹果和安卓手机浏览器扫描</p>
	</div>
	<div class="code">
		<img src="{{ _asset('assets/images/index_weixin.png')}}" />
		<h4>扫描二维码咨询本站管理员</h4>
		<p>请使用微信扫描添加新朋友</p>
	</div>
	<div class="code">
		<img src="{{ _asset('assets/images/index_gzh.jpg')}}" />
		<h4>扫描二维码关注官方公众号</h4>
		<p>请使用微信扫描关注我们，获取更多信息</p>
	</div>
</div>
<!--二维码结束-->



<!--卖点开始-->
<div class="card">
	<h2><span>核心特性</span></h2>
	<div class="div-card w-1000 clearfix">
		<img src="{{ _asset('assets/images/core1.png')}}" alt="" />
		<img src="{{ _asset('assets/images/core2.png')}}" alt="" />
		<img src="{{ _asset('assets/images/core3.png')}}" alt="" />
	</div>
</div>
<!--卖点结束-->


<!--公告开始-->
<div class="notice">
	<h2><span><a href="/Notice/index">最新公告</a></span></h2>

	<div class="div-notice w-1000 clearfix">

		<div class="notice_list">
					<div class="fl left hide">&nbsp;</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right">
						<a href="/Notice/sub?id=48" target="_blank">2017年第28周网站更新通知</a><br><span>2017-07-17 13:55:46</span>
					</div>
				</div>
				<div class="clearfix"></div>  
			 
				<div class="notice_list">
					<div class="fl left">
						<a href="/Notice/sub?id=47" target="_blank">2017年第27周网站更新通知</a><br><span>2017-07-10 20:06:05</span>
					</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right hide">&nbsp;</div>
				</div>
				<div class="clearfix"></div><div class="notice_list">
					<div class="fl left hide">&nbsp;</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right">
						<a href="/Notice/sub?id=46" target="_blank">2017年第26周网站更新通知</a><br><span>2017-07-03 13:39:28</span>
					</div>
				</div>
				<div class="clearfix"></div>  
			 
				<div class="notice_list">
					<div class="fl left">
						<a href="/Notice/sub?id=45" target="_blank">2017年第25周网站更新通知</a><br><span>2017-06-27 09:33:17</span>
					</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right hide">&nbsp;</div>
				</div>
				<div class="clearfix"></div><div class="notice_list">
					<div class="fl left hide">&nbsp;</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right">
						<a href="/Notice/sub?id=44" target="_blank">2017年第24周网站更新通知</a><br><span>2017-06-20 11:59:23</span>
					</div>
				</div>
				<div class="clearfix"></div>  
			 
				<div class="notice_list">
					<div class="fl left">
						<a href="/Notice/sub?id=43" target="_blank">2017年第23周网站更新通知</a><br><span>2017-06-12 10:12:36</span>
					</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right hide">&nbsp;</div>
				</div>
				<div class="clearfix"></div><div class="notice_list">
					<div class="fl left hide">&nbsp;</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right">
						<a href="/Notice/sub?id=42" target="_blank">2017年第22周网站更新通知</a><br><span>2017-06-05 16:26:53</span>
					</div>
				</div>
				<div class="clearfix"></div>  
			 
				<div class="notice_list">
					<div class="fl left">
						<a href="/Notice/sub?id=41" target="_blank">2017年第21周网站更新通知</a><br><span>2017-05-28 13:22:10</span>
					</div>
					<div class="img left">
						<img src="{{ _asset('assets/images/item.png')}}" style="height:50px">
					</div>
					<div class="fr right hide">&nbsp;</div>
				</div>
				<div class="clearfix"></div>
	</div>

</div>
<!--公告结束-->

@endsection