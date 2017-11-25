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
												<a href="/data/cardetail/{{$ccc['id']}}" class="car">{{$ccc['name']}}</a>
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
    <h2 class="factory">
        <strong>当前车型：</strong>
        <span>{{$breadcrumb}}</span>
    </h2> 
    @if($ziliao)
	    @foreach($ziliao AS $k => $v)
	    <div class="car_list relative">
	        <img src="{{$v->thumb}}" alt="{{$v->name}}" />			
	        <form action="/data/detail" method="post">
	            <input type="hidden" name="data_id" value="{{$v->id}}"/>
	            <input type="hidden" name="breadcrumb" value="{{$breadcrumb}}"/>
	            <ul>
	                <h4>{{$v->name}}</h4>
	                <li>{{explode('|',$v->content)[0]}}</li>
	                @if(isset(explode('|',$v->content)[1]))
	                <li>{{explode('|',$v->content)[1]}}</li>
	                @endif
	                @if(isset(explode('|',$v->content)[2]))
	                <li class="desc"><p>{{explode('|',$v->content)[2]}}</p></li>
	                @endif
	                <li class="desc"><input type="submit" value="维修手册 | 线路图" class="car_btn"/></li>
	                                    
	            </ul>
	        </form>	
	        <div class="clearfix"></div>
	    </div>	
	    <div class="clearfix"></div>
	    @endforeach
    @endif
</div>
	
</div>
<!--内容结束-->	

@endsection