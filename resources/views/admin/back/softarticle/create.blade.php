@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            软件库管理
            <small>添加软件</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:softarticle.index') }}">软件库管理 - 添加软件</a></li>
            <li class="active">添加新软件</li>
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

          @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-ban"></i> 警告！</h4>
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
            </div>
          @endif

              <h2 class="page-header">添加新软件</h2>
              <form method="post" action="{{ _route('admin:softarticle.store') }}" accept-charset="utf-8">
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>软件分类 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择软件分类..." class="chosen-select" style="min-width:200px;" name="cid">
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>软件标题 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="title" autocomplete="off" value="{{ old('title') }}" placeholder="标题" maxlength="80">
                      </div>
                        <div class="form-group">
                          <label>软件摘要 <small class="text-red">*</small><span class="text-green">min:10</span></label>
                          <textarea class="form-control" name="description" rows="3" cols="200" autocomplete="off" placeholder="软件摘要">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                          <label>大小 <small class="text-red">*</small></label>
                          <input type="text" class="form-control" name="size" autocomplete="off" value="{{ old('size') }}" placeholder="大小" maxlength="80">
                        </div>

                        <div class="form-group">
                          <label>语言 <small class="text-red">*</small></label>
                          <div class="input-group">
                            <select data-placeholder="选择软件语言..." class="chosen-select" style="min-width:200px;" name="language">
                            @foreach(config('ecms.language') as $k => $v)
                              <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>下载次数 <small class="text-red">*</small></label>
                          <input type="text" class="form-control" name="downloadtimes" autocomplete="off" value="{{ old('downloadtimes') }}" placeholder="下载次数" maxlength="80">
                        </div>
                        <div class="form-group">
                          <label>网址缩略名(slug) <small class="text-red">*</small> <span class="text-green">[a-z0-9\-_]{1,120}</span> <a href="javascript:void(0);" class="auto-to-pinyin"><i class="fa fa-fw fa-hand-o-down" title="自动转换"></i></a></label>
                          <div class="input-group mono url_slug">
                            <p>//example.org/{category}/<input type="text" id="slug" name="slug" autocomplete="off" value="{{ old('slug') }}" class="slug" maxlength="120" pattern="[a-z0-9_-]{1,120}">.html</p>
                          </div>
                        </div>
                        
                        </div>
                        
                        <div class="form-group">
                          <label>缩略图  <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                          <input type="text" class="form-control" id="thumb" name="thumb" value="{{ old('thumb') }}" placeholder="缩略图地址：如{{ url('') }}/assets/img/yas_logo.png" readonly="readonly">
                        </div>
                        <div class="form-group">
                          <label软件详情 <small class="text-red">*</small></label>
                          <textarea class="form-control" id="ckeditor" name="content">{{ old('content') }}</textarea>
                          @include('admin.scripts.endCKEditor'){{-- 引入CKEditor编辑器相关JS依赖 --}}
                        </div>

                        <div class="form-group">
                          <label>下载地址 <small class="text-red">(http://..)*</small></label>
                          <input type="text" class="form-control" name="url" autocomplete="off" value="{{ old('url') }}" placeholder="下载地址" maxlength="80">
                        </div>
                        <div class="form-group">
                          <label>下载密码 <small class="text-red">*</small></label>
                          <input type="text" class="form-control" name="secreat" autocomplete="off" value="{{ old('secreat') }}" placeholder="下载密码" maxlength="80">
                        </div>

                        <div class="form-group">
                          <label>单选项 - 会员专享 <small class="text-red">*</small></label>
                          <div class="input-group">
                            <input type="radio" name="is_locked" value="1" checked>
                            <label class="choice" for="radiogroup">是</label>
                            <input type="radio" name="is_locked" value="0" >
                            <label class="choice" for="radiogroup">否</label>
                          </div>
                        </div>

                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">添加软件</button>

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
  <!--引入My97DatePicker日期插件-->
  <script src="{{ _asset(ref('my97datepicker.js')) }}" type="text/javascript"></script>
  <!--引入Chosen组件-->
  @include('admin.scripts.endChosen')
@stop


@section('filledScript')
        <!--缩略名自适应宽度 部分代码来自typecho-->
        function input_auto_size(sw, ele) {
              var t = $(ele), l = t.val().length;
              if (l > 0) {
                var s = (l <= 120) ? l : 120;
                t.css('width', 'auto').attr('size', s);
              } else {
                t.css('width', sw).removeAttr('size');
              }
        }

        var slug = $('#slug');

        if (slug.length > 0) {
          var sw = slug.width();
          var sl = slug.val().length;
          if (sl > 0) {
            var size = (sl <= 120) ? sl : 120;
            slug.css('width', 'auto').attr('size', size);
          }
          slug.bind('input propertychange', function () {
              input_auto_size(sw, this);
          }).width();
        }

        $('.auto-to-pinyin').click(function () {
            var _name = $('input[name="title"]').val();
            var _url = "{{ _route('api:pinyin') }}";
            var _param = {
              'content' : _name
            };
            $.get(_url, _param, function (_data) {
              if (_data.status) {
                var len = _data.slug.length;
                if (len <= 120) {
                  $('input[name="slug"]').val(_data.slug);
                  input_auto_size(sw, 'input[name="slug"]');
                }
              }
            });
         });
        @include('admin.scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
@stop
