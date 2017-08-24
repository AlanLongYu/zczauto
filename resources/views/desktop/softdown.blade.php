@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about">关于我们</a></li>
			<li><a href="start" >维修手册库</a></li>
			<li><a href="softdown"   class="active">维修软件库</a></li>
			<li><a href="member">VIP购买</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>
		</ul>
	</nav>

    <div class="main right">
		<h2>维修软件下载教程</h2>
		<section>
			<h3>第1步：注册百度帐号并下载百度网盘客户端</h3>
			<p>登录网站<a href="http://pan.baidu.com">http://pan.baidu.com</a>,点击“立即注册百度帐号”按提示注册帐号！然后再点击“WINDOWS”(苹果电脑点MAC),下载客户端软件到电脑并安装！</p>
			<p><img src="/assets/images/softdown_01.jpg" width="90%"/></p><br/>
		</section>
		<section>
			<h3>第2步：找到下载地址</h3>
			<p>首先您已经是年费VIP会员，然后登录，并点击进入您需要下载的维修软件详情页面，可以看到下载地址，如果看不到，说明你没有登录或您不是年费VIP！</p>
			<p><img src="/assets/images/softdown_02.jpg"  width="90%"/></p><br/>
		</section>
		<section>
			<h3>第3步：下载维修软件</h3>
			<p>复制下载VIP到浏览器地址栏打开</p>
			<p><img src="/assets/images/softdown_03.jpg"  width="90%"/></p><br/>
			<p>复制密码到粘贴，点击“提取文件”即可进入下载页面</p>
			<p><img src="/assets/images/softdown_04.jpg"  width="90%"/></p><br/>
			<p>点击下载即可启动百度盘客户端直接下载，如果不能启动，说明浏览器不兼容，您点击转存到自己网盘，然后再用客户端下载！</p>
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