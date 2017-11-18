@extends('desktop.layout._main')


@section('mainContent')

<link rel="stylesheet" type="text/css" href="{{ _asset('/assets/css/data.css')}}">
<!--内容开始-->	
<script src="{{ _asset('/assets/js/roll.js')}}"></script>
<script src="{{ _asset('/assets/js/data.js')}}"></script>

<!--内容开始-->	
<div class="w-1000 relative clearfix">
	<div class="aside left">

		<div class="aside-allCategory">

			<!--分类头-->
			<div class="hd">
				<h2><i class="icon-course-curr"></i><a href="/data/data">维修手册库</a></h2>
			</div>

			<!--分类体-->
			<div class="bd">
				<ul class="aside-cList">
					@foreach($categories AS $cat)
					<li> 
						<div>
							<a href="#" class="country">{{ $cat['name'] }}</a>
							<div class="list-show">
								<div>
									@if(isset($cat['son']))
									@foreach($cat['son'] AS $cc)
									<dl>
										<dt><a href="#" class="factory">{{ $cc['name'] }}</a></dt>
										<dd>
										@if(isset($cc['son']))
											@foreach($cc['son'] AS $ccc)
												<a href="cardetail/{{$ccc['id']}}" class="car">{{$ccc['name']}}</a>
											@endforeach
										@endif
										</dd>
									</dl>
									@endforeach
									@endif
									</div>
							</div><!-- list-show -->
						</div>
					</li>
					@endforeach
				</ul>
			</div> 
			<!-- /bd -->                    
		</div>
		<div class="aside-search">
			<div class="hd">
				<h2><i class="icon-search"></i>搜索车型</h2>
			</div>
			<div class="bd">
				<form class="bigsearch">
					<input type="text" placeholder="请输入车型" class="stext"  id="search_inp" >
					<input type="button" class="sbtn" value="" title="点击搜索" id="search_btn">
				</form>
			</div>
		</div>

	</div>
	
	<div class="main right">
		<div id="info">
			<h1>温馨提示</h1>
			<p>1、模块功能：本模块可在线浏览、打印、下载维修手册电路图！请在左侧菜单栏选择国家、厂家、车型！也可直接搜索车型！</p>
			<p>2、硬件要求：电脑浏览需要WIN7以上操作系统，IE浏览器要求9.0以上！推荐使用谷歌Chrome浏览器效果最佳！若是XP老电脑则使用360浏览器！手机浏览推荐UC浏览器！</p>			
			<p>3、权限说明：免费资料所有登录用户可以浏览、打印和下载，VIP资料仅VIP会员可以浏览、打印和下载！</p>
		</div>					
		<h2>最新车型</h2> 
		<div id="roll">
			<ul class="car">
			<li>
				<a href="/Home/Read/read_index?data_id=666">2014-2017宝马X5(F15)</a>
				<span>359浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=667">2014-2017宝马X6(F16)</a>
				<span>204浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=692">2014-2017上汽大众凌渡</a>
				<span>239浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=712">2017东风日产启辰T90</a>
				<span>215浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1043">2013-2017玛莎拉蒂总裁3.8</a>
				<span>152浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1225">2017一汽大众捷达</a>
				<span>143浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1226">2017一汽大众蔚领</a>
				<span>189浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1236">2017东风日产奇骏</a>
				<span>92浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1237">2017日产GT-R(R35)</a>
				<span>15浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=365">2012-2016一汽奥迪A3</a>
				<span>334浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=366">2008-2016一汽奥迪A4L</a>
				<span>475浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=368">2012-2016一汽奥迪新A6L</a>
				<span>472浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=457">2016东风日产新轩逸</a>
				<span>793浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=459">2016东风日产新逍客</a>
				<span>410浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=610">2016一汽大众高尔夫嘉旅</a>
				<span>231浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=639">2016北京奔驰GLC300</a>
				<span>257浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=647">2010-2016奔驰B200 B260</a>
				<span>234浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=648">2016东风日产新骐达TIIDA</a>
				<span>233浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=651">2016东风日产新天籁(公爵)</a>
				<span>279浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=656">2016东风日产西玛MAXIMA</a>
				<span>212浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=658">2016宝马1系F52</a>
				<span>206浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=660">2016宝马5系G30</a>
				<span>171浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=665">2010-2017宝马X3(F25)</a>
				<span>166浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=671">2010-2016奥迪A1</a>
				<span>181浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=678">2015-2017奥迪Q7</a>
				<span>218浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=681">2015-2017奥迪R8</a>
				<span>170浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=687">2011-2016大众UP!</a>
				<span>160浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=688">2010-2016大众夏朗sharan</a>
				<span>171浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=689">2014-2016上汽大众波罗</a>
				<span>214浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=690">2013-2016上汽大众朗逸</a>
				<span>195浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=725">2016日产途乐（进口）</a>
				<span>188浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=902">2016奇瑞艾瑞泽5</a>
				<span>190浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=926">2016风行菱智M3/V3</a>
				<span>133浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=927">2016东风风行CM7</a>
				<span>125浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=928">2016风行菱智M5</a>
				<span>146浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1042">2013-2017玛莎拉蒂总裁3.0</a>
				<span>139浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1227">2016一汽大众新宝来</a>
				<span>99浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1228">2016一汽大众迈腾</a>
				<span>72浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1229">2016一汽大众CC</a>
				<span>46浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=1235">2016大众迈特威（进口）</a>
				<span>70浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=373">2015-2017奥迪TT Coupe</a>
				<span>314浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=458">2015东风日产新逍客</a>
				<span>339浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=460">2015东风日产启辰T70</a>
				<span>313浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=461">2015东风日产启辰D50_R50_R5</a>
				<span>289浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=462">2015东风日产楼兰汽油版</a>
				<span>304浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=463">2015东风日产楼兰混合动力</a>
				<span>316浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=465">2015东风日产新蓝鸟LANNIA</a>
				<span>323浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=549">2015上汽通用五菱之光</a>
				<span>182浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=554">2015上汽通用五菱宝骏630</a>
				<span>286浏览</span>
				</li><li>
				<a href="/Home/Read/read_index?data_id=557">2015上汽通用五菱宝骏560</a>
				<span>366浏览</span>
				</li>			<div class="clearfix"></div>
			</ul>
		</div>

		<h2>我的浏览历史</h2> 				
		<ul class="car">
		<li><a href="/Home/Read/read_index?data_id=666">2014-2017宝马X5(F15)</a></li><li><a href="/Home/Read/read_index?data_id=447">2004广汽本田飞度FIT</a></li><li><a href="/Home/Read/read_index?data_id=681">2015-2017奥迪R8</a></li><li><a href="/Home/Read/read_index?data_id=368">2012-2016一汽奥迪新A6L</a></li>			<div class="clearfix"></div>
		</ul>

	</div>

	
</div>
<!--内容结束-->	
<script>
$(document).ready(function(){
	$(".current").removeClass("current");
	$(".ziliao-search").addClass("current");
});
</script>

@endsection