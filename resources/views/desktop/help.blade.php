@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about"  class="active">关于我们</a></li>
			<li><a href="start">网站帮助</a></li>
			<!--<li><a href="softdown">维修软件库</a></li>-->
			<li><a href="disclaimer">免责申明</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>			
		</ul>
	</nav>

    <div class="main right">
		<h2>关于我们</h2>
		<section>
			<h3>精准资料网是做什么的</h3>
			<p>精准资料网专注为汽车爱好者提供作者收集的维修资料、技术等进行交流。我们只做有用的，立足维修实战，绝不夸夸其谈！</p>
		</section>
		<section>
			<h3>您能在本站获得什么</h3>
			<p>在这里，您可以获得大量原厂权威维修资料，包括上千款车型的原厂维修手册、电路图、自学手册等，这些资料可以用电脑或手机在线浏览、打印和下载，而且您无需下载和安装任何软件。还可以与作者交流汽车方面的心得与体会</p>
		</section>
		<section>
			<h3>可以用手机访问吗</h3>
			<p>目前精准资料网采用最新的H5技术，可在电脑、平板、手机等各种设备上使用，并且兼容苹果、安卓、windows操作系统，目前提供网页版，后续我们将推出苹果和安卓客户端</p>
			<p><img src="/assets/images/heade-rwm.png" title="手机扫描二维码访问本站" width="150px"/></p>
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