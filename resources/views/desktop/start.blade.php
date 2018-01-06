@extends('desktop.layout._main')


@section('mainContent')
<link rel="stylesheet" type="text/css" href="{{ _asset('assets/css/help.css')}}">
<div class="w-1000 clearfix">
    <nav class="aside left">
		<ul>
			<li><a href="about">关于我们</a></li>
			<li><a href="start"  class="active">网站帮助</a></li>
			<!--<li><a href="softdown">维修软件库</a></li>-->
			<li><a href="disclaimer">免责申明</a></li>
			<li><a href="joinus">加入我们</a></li>
			<li><a href="contact">联系我们</a></li>			
		</ul>
	</nav>
    <div class="main right">
		<h2>网站帮助-使用教程</h2>
		<section>
			<h3>第1步：选择车型</h3>
			<p>方式1> 分类导航选择：鼠标放在国别分类上时，会自动显示出生产厂家和车型，点击车型名称即可进入车型列表</p>
			<!--<p><img src="/assets/images/start_01.png" width="90%"/></p><br/>
			<p>方式2> 搜索选择：在车型搜索框中直接输入车型搜索即可</p>
			<p><img src="/assets/images/start_02.png" /></p><br/>-->
		</section>
		<section>
			<h3>第2步：确定年款</h3>
			<p>在选择车型后，会列出该车型的所有年款，此时对照图片、年款、配置和说明选择相应年款</p>
			<p><img src="/assets/images/start_03.png"  width="90%"/></p><br/>
		</section>
		<section>
			<h3>第3步：查看资料</h3>
			<p style="color:#ff9900">注意：如果您使用IE浏览器，请确保为IE9.0以上</p>
			<p>点击左侧目录，右侧即会显示资料，在顶部工具栏中，有放大、缩小、翻页、旋转、下载等操作按钮</p>
			<p><img src="/assets/images/start_04.png"  width="90%"/></p><br/>
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