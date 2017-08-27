@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/soft.css')}}">

<!--内容开始-->	
<div class="w-1000 relative clearfix">
	<div class="aside left">

		<div class="aside-allCategory">

			<!--分类头-->
			<div class="hd">
				<h2><i class="icon-course-curr"></i><a href="/soft/index">维修软件库</a></h2>
			</div>

			<!--分类体-->
			<div class="bd">
				<ul class="aside-cList">
					<li> 
						<div><a href="/soft/index?cate=1" >米切尔</a></div>
						<div><a href="/soft/index?cate=2" >奔驰</a></div>
						<div><a href="/soft/index?cate=3" >宝马</a></div>
						<div><a href="/soft/index?cate=4" >大众</a></div>
						<div><a href="/soft/index?cate=5" >保时捷</a></div>
						<div><a href="/soft/index?cate=6" >沃尔沃</a></div>
						<div><a href="/soft/index?cate=7" >标致</a></div>
						<div><a href="/soft/index?cate=8" >雪铁龙</a></div>
						<div><a href="/soft/index?cate=9" >福特</a></div>
					</li>
				</ul>
			</div> 
			<!-- /bd -->                    
		</div>
	</div>
	
	<div class="main right">
		<h2><a href="/soft/index">维修软件库</a> > 
			所有		
		</h2>
		<ul>
			<li>
				<a href="/soft/index_sub?id=16">
					<img src="/images/soft/assist/assist.jpg" alt="1998-2010宾利劳斯莱斯维修系统">
					<div>
						<h3>1998-2010宾利劳斯莱斯维修系</h3>
						<span>年费VIP专享</span>
						<p>包含1998至2010年宾利雅致arnage，宾利Azure，布鲁克兰brooklands，劳斯莱斯银天使silver seraph和帕克沃德park ward配件目录、车间手册、电路图。...</p>
						<div>大小：1G&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;语言：英文&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;172人已下载</div>
					</div>
				</a>
			</li><li>
				<a href="/soft/index_sub?id=15">
					<img src="/images/soft/mitchell/mitchell.jpg" alt="2015最新米切尔维修资料库OD5">
					<div>
						<h3>2015最新米切尔维修资料库OD5</h3>
						<span>年费VIP专享</span>
						<p>2015最新版米切尔维修软件，是美国米切尔公司推出的汽车维修信息软件，内容主要包括部件的拆装维修、线路图原理！有翻译软件可以部分翻译为中文！...</p>
						<div>大小：165G&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;语言：英文&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;571人已下载</div>
					</div>
				</a>
			</li><li>
				<a href="/soft/index_sub?id=14">
					<img src="/images/soft/ista/ista.jpg" alt="2016最新宝马ISTA4.02中文">
					<div>
						<h3>2016最新宝马ISTA4.02中文</h3>
						<span>年费VIP专享</span>
						<p>本软件为最新款宝马维修信息系统(瑞金ISTA4.02），可查询故障码，包含维修手册及电路图，并与诊断软件集成一体（诊断车辆需有硬件支持）...</p>
						<div>大小：21G&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;语言：中文&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;451人已下载</div>
					</div>
				</a>
			</li><li>
				<a href="/soft/index_sub?id=13">
					<img src="/images/soft/elsa/elsa.jpg" alt="2017最新大众奥迪维修系统ELSA6.0 ">
					<div>
						<h3>2017最新大众奥迪维修系统ELSA</h3>
						<span>年费VIP专享</span>
						<p>本资料为ELSA6.0最新版本，更新至2017款上海大众、一汽大众、进口大众、一汽奥迪、进口奥迪各车型的维修手册、电路图，包含2017大众和2016奥迪两套数据包...</p>
						<div>大小：50G&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;语言：中文&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;672人已下载</div>
					</div>
				</a>
			</li>		</ul>
		<div class="page"><div>  <span class="current">1</span><a class="num" href="/Soft/soft/p/2.html">2</a><a class="num" href="/Soft/soft/p/3.html">3</a><a class="num" href="/Soft/soft/p/4.html">4</a> <a class="next" href="/Soft/soft/p/2.html">  下一页  </a> </div></div>
		<br>
	</div>

	
</div>
<!--内容结束-->	


@endsection