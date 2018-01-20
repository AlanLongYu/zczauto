@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            系统管理
            <small>新闻公告</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li class="active">系统管理 - 新闻公告</li>
          </ol>
@stop

@section('content')

          @if(session()->has('fail'))
            <div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>  <i class="icon icon fa fa-warning"></i> 提示！</h4>
              {{ session('fail') }}
            </div>
          @endif

          @if(session()->has('message'))
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4>  <i class="icon fa fa-check"></i> 提示！</h4>
              {{ session('message') }}
            </div>
          @endif

              <h2 class="page-header">修改新闻公告</h2>

              <form method="post" action="{{ _route('admin:news') }}" accept-charset="utf-8">
              {!! method_field('put') !!}
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>新闻标题 <small class="text-green">[title]</small></label>
                        <input type="text" class="form-control" name="title" required="" autocomplete="off" value="{{ isset($data['title']) ? $data['title'] : '' }}" placeholder="新闻标题">
                      </div>
                      <div class="form-group">
                        <label>新闻内容 <small class="text-green">[content]</small></label>
                        <textarea class="form-control" name="content" required="" rows="6" cols="200" autocomplete="off" placeholder="请输入内容">{{$data['content']}}</textarea>
                      </div>
                    <button type="submit" class="btn btn-primary">更新新闻公告</button>
                  </div><!-- /.tab-content -->
              </div>
              </form>
          <div id="layerPreviewPic" class="fn-hide">
            
          </div>

@stop

@section('extraPlugin')

  <!--引入Layer组件-->
  <script src="{{ _asset(ref('layer.js')) }}"></script>
  <!--引入iCheck组件-->
  <script src="{{ _asset(ref('icheck.js')) }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('admin.scripts.endChosen')

@stop


@section('filledScript')

        <!--启用iCheck响应checkbox与radio表单控件-->
        $('input[type="radio"]').iCheck({
          radioClass: 'iradio_flat-blue',
          increaseArea: '20%' // optional
        });

        @include('admin.scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop
