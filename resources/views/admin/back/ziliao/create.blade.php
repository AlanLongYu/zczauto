@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            资料库管理
            <small>新增资料</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:category.index') }}">资料库管理 - 资料列表</a></li>
            <li class="active">新增资料</li>
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

              <h2 class="page-header">新增资料</h2>
              <form method="post" action="{{ _route('admin:ziliao.store') }}" accept-charset="utf-8">
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group">
                        <label>下拉单选项 - 分类 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择下拉项..." class="chosen-select" style="min-width:200px;" name="cat_id">
                          <dl>
                           @foreach ($categories as $k => $v)
                           <option value=""  disabled=""><dt>{{ $v['name'] }}111</dt></option>
                            @foreach($v['son'] as $kk => $vv)
                              <option value="{{ $kk }}"><dd>&nbsp;&nbsp;-{{$vv}}</dd></option>
                             @endforeach
                           @endforeach
                          </dl>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>标题 <small class="text-red">*</small> <span class="text-green">[a-z\-_]{3,20}</span> <a href="javascript:void(0);" class="auto-to-pinyin"><i class="fa fa-fw fa-hand-o-down" title="自动转换"></i></a></label>
                        <input type="text" class="form-control" name="name" placeholder="标题" maxlength="20" value="{{ old('name') }}">
                      </div>
                      <div class="form-group">
                        <label>描述信息 <small class="text-red">*</small></label>
                        <textarea class="form-control" name="content" rows="3" cols="200" autocomplete="off" placeholder="请输入文本">{{ old('content') }}</textarea>
                      </div>
                      <div class="form-group">
                        <label>缩略图  <a href="javascript:void(0);" class="uploadPic" data-id="thumb"><i class="fa fa-fw fa-picture-o" title="上传"></i></a>  <a href="javascript:void(0);" class="previewPic" data-id="thumb"><i class="fa fa-fw fa-eye" title="预览小图"></i></a></label>
                        <input type="text" class="form-control" id="thumb" name="thumb" value="{{ old('picture') }}" placeholder="图片地址：如{{ url('') }}/assets/img/yas_logo.png" readonly="readonly">
                      </div>
                      <div class="form-group">
                        <label>资料上传 <a href="javascript:void(0);" class="uploadFile" data-id="file"><i class="fa fa-fw fa-file-o" title="上传"></i></a></label>
                        <input type="text" class="form-control" id="file" name="detail_url" value="{{ old('detail_url') }}" placeholder="文件地址：如{{ url('') }}/assets/doc/yas_logo.pdf">
                      </div>
                      <div class="form-group">
                        <label>排序 <small class="text-red">*</small> <span class="text-green">000-999</span></label>
                        <input type="text" class="form-control" name="sort" placeholder="分类排序" value="{{ old('sort', 999) }}">
                      </div>

                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增资料</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
              <div id="layerPreviewPic" class="fn-hide">
            
              </div>
@stop


@section('extraPlugin')
<!--引入Layer组件-->
<script src="{{ _asset(ref('layer.js')) }}"></script>
<script type="text/javascript">
   $('.auto-to-pinyin').click(function () {
      var _name = $('input[name="name"]').val();
      var _url = "{{ _route('api:pinyin') }}";
      var _param = {
        'content' : _name
      };
      $.get(_url, _param, function (_data) {
        if (_data.status) {
          $('input[name="slug"]').val(_data.slug);
        }
      });
   });
@include('admin.scripts.endSinglePic') {{-- 引入单个图片上传与预览JS，依赖于Layer --}}
        //上传文件
        $('.uploadFile').click(function(){
            var ele = $(this).data('id');
            layer.open({
                type : 2,
                closeBtn : false,
                title: false,
                fix: false,
                area : ['600px' , '250px'],
                offset : ['', ''],
                content: ['{{ _route('admin:upload.document') }}?from=' + ele],
                success: function(layero){
                        console.log(layero);
                        $(layero['selector']).css('border-radius','6px');
                        $(layero['selector'] + ' .layui-layer-content').css('border-radius','6px');
                },
                cancel : function(index){
                    layer.closeAll();
                },
                end : function(index){
                    //location.reload();
                }
            });
        });
</script>
@stop