@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/data.css')}}">
<!--内容开始-->	
<script src="{{ _asset('/assets/js/roll.js')}}"></script>
<script src="{{ _asset('/assets/js/data.js')}}"></script>

<!--内容开始-->	
<div class="w-1000 relative clearfix">
	<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/read.css')}}">
<link rel="stylesheet" href="{{ _asset('/assets/css/jquery.treeview.css')}}" />
<script src="{{ _asset('/assets/js/jquery.treeview.js')}}" ></script>

<script>		
$(function() {
	//树形目录样式
	$("#tree").treeview({
		collapsed: true,
		animated: "medium",
		control:"#sidetreecontrol",
		persist: "location"
	});

	//var isdown='1';
	//sessionStorage.setItem("isdown",isdown);	
	
	//目录阅读权限
	$('.file').click(function(){
		var file_name=$(this).text();
		var url="{!! $breadcrumb !!}";
		var folder=$(this).parents("ul").prev("span.folder").map(function(){
			return $(this).text();
		}).get();
		var true_folder = folder.reverse().join("/");
		var iframe_url=encodeURI("{!! $navId !!}/{!! $afterFix !!}/"+true_folder+'/'+file_name+'.pdf');
		var role="{{Auth::guard('member')->user()->role}}";
		if(role==1 || file_name =='default'){		
			$("#iframe").attr("src","/data/document/"+iframe_url+'&embedded=true');
			return;
		}else{
			alert('账号未激活，请联系微信zczauto');
		}
		
	});

})
//告知下载次数已到
function limited(){
	$("#limited").click();
}
</script>


<!--[if lte IE 8]>
	<script type="text/javascript">
		$(function(){
			$("#checkIe").click();
		});		
	</script>
<![endif]-->

<!--32px绿条背景-->
<div class="readshop" id="readshop"></div>


<!--内容开始-->	
<div class="w-1000 relative read_container">
	<div class="aside left">
		<div class="crumbs">
			<span>{{$breadcrumb}}</span>
		</div>
		<div id="sidetree">
			<div id="sidetreecontrol">
				<a href="?#">折叠目录</a> | <a href="?#">展开目录</a>
			</div>
			<div id="read_menu">
				<h4>{{$breadcrumb}}</h4>
				<ul id='tree' class='filetree'>
					{{arr_foreach($files)}}
				</ul>
				<!--
				<span class="file">表示文档
				<span class="folder">表示文件夹
				<li class="closed">表示默认关闭
				-->
			</div>
		</div>
	</div>

	<div class="main right">
	<iframe src="/data/file/default.pdf&embedded=true" frameborder="0" scrolling="no" width="100%" height="100%" id="iframe" name="iframe"></iframe>
	</div>	

</div>
<!--内容结束-->	


<!--弹出层-->
<script src="{{ _asset('/assets/js/jquery.reveal.js')}}"></script>
<link rel="stylesheet" href="{{ _asset('/assets/css/reveal.css')}}">	

<a href="#" id="checkIe" data-reveal-id="myModal3" style="display:none"></a>
<div id="myModal3" class="reveal-modal">
	<h6>您的IE浏览器太老了吧！升级新浏览器吧！</h6>
	<p>本站采用HTML5新技术，只支持IE9及其以上浏览器喔</p>
	<a href="http://browsehappy.com/">立即升级浏览器</a>
</div>

<a href="#" id="limited" data-reveal-id="myModal4" style="display:none"></a>
<div id="myModal4" class="reveal-modal">
	<h6>对不起！您今天的打印或下载次数已用完!</h6>
	<p>亲！今日就到这了，请明天再来喔！快去休息休息吧！</p>
	<a class="close-reveal-modal">&#215;</a>
</div>

	
</div>
<!--内容结束-->	

@endsection