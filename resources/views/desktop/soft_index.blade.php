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
					@foreach($categories AS $cat)
						<div><a href="/soft/index?s_cid={{$cat->id}}" class="{{$cat->id == $s_cid ? 'active' : ''}}">{{$cat->name}}</a></div>
					@endforeach
					</li>
				</ul>
			</div> 
			<!-- /bd -->                    
		</div>
	</div>
	
	<div class="main right">
		<h2><a href="/soft/index">维修软件库</a> > 
			{{isset($s_cid) ?  $catArr[$s_cid]: '所有'}}		
		</h2>
		<ul>
		@if($articles)
		@foreach($articles AS $key => $article)
			<li>
				<a href="/soft/detail/{{$article->id}}">
					<img src="{{$article->thumb}}" alt="{{$article->title}}">
					<div>
						<h3>{{$article->title}}</h3>
						<span>年费VIP专享</span>
						<p>{{$article->description}}</p>
						<div>大小：{{$article->size}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;语言：{{config('ecms.language')[$article->language]}}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;{{$article->downloadtimes}}人已下载</div>
					</div>
				</a>
			</li>
			@endforeach
			@endif
		</ul>
		<div class="page">
                  {!! $articles->appends([
                                          's_cid' => request('s_cid'),
                                          's_title' => request('s_title'),
                                        ])->render() !!}
       </div>
		<br>
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