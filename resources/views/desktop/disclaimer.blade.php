@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about" >关于我们</a></li>
			<li><a href="start">网站帮助</a></li>
			<!--<li><a href="softdown">维修软件库</a></li>-->
			<li><a href="disclaimer"  class="active">免责申明</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>
		</ul>
	</nav>
    <div class="main right">
		<h2>免责申明</h2>
		<section>
			<h3>资料来源</h3>
			<p>本网站上的所有资料均为网上采集、复制、网友共享而来， </p>
			<p>仅供大众学习和研究及普及汽车知识。如有侵犯您版权的，</p>
			<p>请联系站长，我们将会在第一时间删除。</p>
		</section>
		<section>
			<h3>资料版权</h3>
			<p>访问本网站的用户必须明白，</p>
			<p>本网站对提供下载的资料等不拥有任何权利，</p>
			<p>其版权归该下载资源的合法拥有者所有。</p>
		</section>
		<section>
			<h3>资料内容</h3>
			<p>本网站不保证本站提供的下载资源的准确性、安全性和完整性；</p>
			<p>同时本网站也不承担用户因使用这些下载资源对自己和他人造成任何形式的损失或伤害。 </p>
		</section>
		<section>
			<h3>网站资源</h3>
			<p>未经本网站的明确许可，任何人不得大量链接本站下载资源；</p>
			<p>不得复制或仿造本网站。本网站对其自行开发的或和他人共同开发的所有内容、 </p>
			<p>技术手段和服务拥有全部知识产权，任何人不得侵害或破坏，也不得擅自使用。 </p>
		</section>
    </div>
</div>






<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".help").addClass("current");
});
</script>
@endsection