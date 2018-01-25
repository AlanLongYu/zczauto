<!--内容开始-->								
<h2 class="factory">
<strong>您搜索的车型是：</strong>
<span>{{isset($keyword) ? $keyword : ''}}</span>
<a>以下为搜索结果，共有{{$count}}款车型符合搜索条件>>></a>
</h2> 

@if($ziliao)
	@foreach($ziliao AS $k => $v)
	<div class="car_list relative">
	    <img src="{{$v->thumb}}" alt="{{$v->name}}" />			
	    <form action="/data/detail" method="post">
	        <input type="hidden" name="data_id" value="{{$v->id}}"/>
	        <input type="hidden" name="breadcrumb" value="{{isset($breadcrumb) ? $breadcrumb : ''}}"/>
	        <ul>
	            <h4>{{$v->name}}</h4>
	            <li>{{explode('|',$v->content)[0]}}</li>
	            @if(isset(explode('|',$v->content)[1]))
	            <li>{{explode('|',$v->content)[1]}}</li>
	            @endif
	            @if(isset(explode('|',$v->content)[2]))
	            <li class="desc"><p>{{explode('|',$v->content)[2]}}</p></li>
	            @endif
	            <li class="desc">
	            	@if($v->way == 0)
	            	<input type="submit" value="{!! nl2br($v->way_contents) == '' ? '维修手册 | 线路图' : nl2br($v->way_contents)  !!}" class="car_btn"/>
	            	@else
	            	<div class="blue-bg">
	            		@if(Auth::guard('member')->user()->role == 2)
	            		账号未激活，请联系微信zczauto
	            		@else
	            		{!! nl2br($v->way_contents) !!}
	            		@endif
	            	</div>
	            	@endif
	            </li>
	                                
	        </ul>
	    </form>	
	    <div class="clearfix"></div>
	</div>	
	<div class="clearfix"></div>
	@endforeach
@endif<!--内容结束-->