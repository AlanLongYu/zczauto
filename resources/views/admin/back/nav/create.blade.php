@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            导航管理
            <small>新增</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:nav.index') }}">导航管理 - 新增</a></li>
            <li class="active">导航管理</li>
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

              <h2 class="page-header">新增导航</h2>
              <form method="post" action="{{ _route('admin:nav.store') }}" accept-charset="utf-8">
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                    <li style="display: none;" class="tab_2"><a href="#tab_2" data-toggle="tab" aria-expanded="true">车型配置</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>父级导航 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择父级导航..." class="chosen-select" style="min-width:280px;" name="p_id" onChange="displayCarModel(this);">
                          <option value="0">顶级导航</option>
                          @foreach ($Nav as $nav)
                            @if(in_array($nav->id,$topNav))
                            <option value="{{ $nav->id }}" {{ ($nav->id == old('p_id') ) ? 'selected':'' }}>{{ $nav->name }}</option>
                            @endif
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>导航名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ old('name') }}" placeholder="导航名称" maxlength="20">
                      </div>
                      <div class="form-group" style="display:none;">
                        <label>导航别名 <small class="text-red">*</small> <span class="text-green">[a-z\-_]{3,20}</span> <a href="javascript:void(0);" class="auto-to-pinyin"><i class="fa fa-fw fa-hand-o-down" title="自动转换"></i></a></label>
                        <input type="text" class="form-control" name="slug" placeholder="导航别名" maxlength="20" value="{{ old('slug') }}">
                      </div>
                      <div class="form-group" style="display:none;">
                        <label>导航Url <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="url" placeholder="导航Url" maxlength="255" value="{{ old('url') }}">
                      </div>
                      <div class="form-group">
                        <label>导航排序 <small class="text-red">*</small> <span class="text-green">000-999</span></label>
                        <input type="text" class="form-control" name="sort" placeholder="导航排序" value="{{ old('sort', 999) }}">
                      </div>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">

                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增导航</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
@stop


@section('extraPlugin')

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
   var displayCarModel = function(val){
      if(val.value != 0){
        $("#tab_2").html('放醋');
        $(".tab_2").show();
      }
   }
</script>
@stop