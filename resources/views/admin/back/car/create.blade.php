@extends('admin.layout._back')

@section('content-header')
@parent
          <h1>
            车型管理
            <small>新增车系</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ site_url('dashboard', 'admin') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
            <li><a href="{{ _route('admin:nav.index') }}">车型管理 - 新增车系</a></li>
            <li class="active">新增车系</li>
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

              <h2 class="page-header">新增车系</h2>
              <form method="post" action="{{ _route('admin:car.store') }}" accept-charset="utf-8">
              {!! csrf_field() !!}
              <div class="nav-tabs-custom">
                  
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">主要内容</a></li>
                  </ul>

                  <div class="tab-content">
                    
                    <div class="tab-pane active" id="tab_1">
                    <div class="form-group">
                        <label>父级车系 <small class="text-red">*</small></label>
                        <div class="input-group">
                          <select data-placeholder="选择父级车型..." class="chosen-select" style="min-width:280px;" name="p_id"">
                          <option value="0" selected="selected">顶级车系</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>车系名称 <small class="text-red">*</small></label>
                        <input type="text" class="form-control" name="name" autocomplete="off" value="{{ old('name') }}" placeholder="车系名称" maxlength="20">
                      </div>
                      <div class="form-group">
                        <label>车系排序 <small class="text-red">*</small> <span class="text-green">000-999</span></label>
                        <input type="text" class="form-control" name="sort" placeholder="车型排序" value="{{ old('sort', 999) }}">
                      </div>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                      <ul id="treeDemo" class="ztree"></ul>
                    </div><!-- /.tab-pane -->

                    <button type="submit" class="btn btn-primary">新增车系</button>

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
   
</script>
@stop