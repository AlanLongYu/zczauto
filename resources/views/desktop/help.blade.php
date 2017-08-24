@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about"  class="active">关于我们</a></li>
			<li><a href="start">维修手册库</a></li>
			<li><a href="softdown">维修软件库</a></li>
			<li><a href="member">VIP购买</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>			
		</ul>
	</nav>

    <div class="main right">
		<h2>关于我们</h2>
		<section>
			<h3>琅环网是做什么的</h3>
			<p>琅环汽车网专注为中国汽车维修技师提供维修资料、技术培训和技术交流。我们的许多资料和课程都是免费的，我们只做有用的，立足维修实战，绝不夸夸其谈！</p>
		</section>
		<section>
			<h3>我能在本站获得什么</h3>
			<p>在这里，您可以获得大量原厂权威维修资料，包括上千款车型的原厂维修手册、电路图、自学手册等，这些资料可以用电脑或手机在线浏览、打印和下载，而且您无需下载和安装任何软件。后期我们将提供技术交流社区、汽车维修视频、以及开设网上汽修学院！</p>
		</section>
		<section>
			<h3>可以用手机访问吗</h3>
			<p>目前已是zcz汽车网第五次改版，采用最新的H5技术，可在电脑、平板、手机等各种设备上使用，并且兼容苹果、安卓、windows操作系统，目前提供网页版，后续我们将推出苹果和安卓客户端</p>
			<p><img src="/assets/images/heade-rwm.png" title="手机扫描二维码访问本站" width="150px"/></p>
		</section>
		<section>
			<h3>你们是哪里的</h3>
			<p>我们在魅力之都深圳，公司全称为zcz汽车股份有限公司，以下为营执照副本：</p><br/>
			<p><img src="/assets/images/yyzz.jpg" width="200px"/></p>
		</section>

    </div>
	<!-- /popup -->
</div>
<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".help").addClass("current");
});
</script>
@endsection