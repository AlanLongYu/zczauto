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
              <form method="post" id="nav-add" action="{{ _route('admin:nav.store') }}" accept-charset="utf-8">
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
                        <label>页面编辑</label>
                        <textarea class="form-control" id="ckeditor" name="content">{{ old('content') }}</textarea>
                        @include('admin.scripts.endCKEditor'){{-- 引入CKEditor编辑器相关JS依赖 --}}
                      </div>
                      <div class="form-group">
                        <label>导航排序 <small class="text-red">*</small> <span class="text-green">000-999</span></label>
                        <input type="text" class="form-control" name="sort" placeholder="导航排序" value="{{ old('sort', 999) }}">
                      </div>
                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                      <ul id="treeDemo" class="ztree"></ul>
                    </div><!-- /.tab-pane -->

                    <button id="crateNav" type="submit" class="btn btn-primary">新增导航</button>

                  </div><!-- /.tab-content -->
                  
              </div>
              </form>
@stop


@section('extraPlugin')
<link href="{{ _asset('/assets/css/metroStyle/metroStyle.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.core.js') }}"></script>
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.excheck.js') }}"></script>
<script src="{{ _asset('/assets/js/ztree/jquery.ztree.exedit.js') }}"></script>
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
        $(".tab_2").show();
      }
   }
   //Ztree插件js
    <!--
    var setting = {
      async: {
        enable: true,
        url:"/admin/car/type",
        autoParam:["id", "name=n", "level=lv"],
        otherParam:{"otherParam":"zTreeAsyncTest"},
        dataFilter: filter
      },
      view: {expandSpeed:"",
        //addHoverDom: addHoverDom,
        //removeHoverDom: removeHoverDom,
        selectedMulti: true
      },
      check: {
        enable: true
      },
      edit: {
        enable: false
      },
      
      data: {
        simpleData: {
          enable: true
        }
      },
      callback: {
        beforeRemove: beforeRemove,
        beforeRename: beforeRename
      }
    };

    function filter(treeId, parentNode, childNodes) {
      if (!childNodes) return null;
      for (var i=0, l=childNodes.length; i<l; i++) {
        childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
      }
      return childNodes;
    }
    function beforeRemove(treeId, treeNode) {
      var zTree = $.fn.zTree.getZTreeObj("treeDemo");
      zTree.selectNode(treeNode);
      return confirm("确认删除 节点 -- " + treeNode.name + " 吗？");
    }   
    function beforeRename(treeId, treeNode, newName) {
      if (newName.length == 0) {
        setTimeout(function() {
          var zTree = $.fn.zTree.getZTreeObj("treeDemo");
          zTree.cancelEditName();
          alert("节点名称不能为空.");
        }, 0);
        return false;
      }
      return true;
    }

    var newCount = 1;
    function addHoverDom(treeId, treeNode) {
      var sObj = $("#" + treeNode.tId + "_span");
      if (treeNode.editNameFlag || $("#addBtn_"+treeNode.tId).length>0) return;
      var addStr = "<span class='button add' id='addBtn_" + treeNode.tId
        + "' title='add node' onfocus='this.blur();'></span>";
      sObj.after(addStr);
      var btn = $("#addBtn_"+treeNode.tId);
      if (btn) btn.bind("click", function(){
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.addNodes(treeNode, {id:(100 + newCount), pId:treeNode.id, name:"new node" + (newCount++)});
        return false;
      });
    };
    function removeHoverDom(treeId, treeNode) {
      $.ajax({
          url:"/admin/nav/ajaxDel",
          type:"post",
          data:{treeNode:treeNode},
          dataType:"json",
          success:function(data){
            console.log(data);
            if(data.code == 200){
              return true;
            }else{
              alert(data.msg);
              return false;
              
            }
          }

        });
      $("#addBtn_"+treeNode.tId).unbind().remove();
    };

    $(document).ready(function(){
      $.fn.zTree.init($("#treeDemo"), setting,{!! $tree !!});
    });
    //-->
    $("#crateNav").click(function(event){
      event.preventDefault();
      var params = $("#nav-add").serialize();
      var content=CKEDITOR.instances.ckeditor.getData(); 
      //console.log(content);
      console.log(params);
      var zTreeObj = $.fn.zTree.getZTreeObj("treeDemo");
      //选中的节点
      var checkedNodes = zTreeObj.getCheckedNodes();
      console.log(checkedNodes);
      //ajax添加导航
      $.ajax({
          url:"/admin/nav/ajaxStore",
          type:"post",
          data:{params:params,checkedNodes:checkedNodes,content:content},
          dataType:"json",
          success:function(data){
            console.log(data);
            if(data.code == 200){
                window.location.href='/'+data.redirectUrl;
            }else{
              alert(data.msg);
              return false;
            }
          }

        });
      

    });
</script>
@stop