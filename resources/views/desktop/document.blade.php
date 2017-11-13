<html dir="ltr" mozdisallowselectionprint moznomarginboxes>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script src="{{ _asset('/assets/js/compatibility.js')}}"></script>
	<script src="{{ _asset('/assets/js/jquery.min.js')}}"></script>
	<script src="{{ _asset('/assets/js/l10n.js')}}"></script>
	<script src="{{ _asset('/assets/js/pdf.js')}}"></script>

	<script src="{{ _asset('/assets/js/viewer.js')}}"></script>
    <link rel="stylesheet" href="{{ _asset('/assets/css/viewer.css')}}"/>
</head>

<body  class="loadingInProgress">
    <div id="outerContainer">

	  <!---- 侧边栏开始 不显示 ---->
      <div id="sidebarContainer">
        <div id="toolbarSidebar">
          <div class="splitToolbarButton toggled">
            <button id="viewThumbnail" class="toolbarButton group toggled" title="Show Thumbnails"  >
               <span >Thumbnails</span>
            </button>
            <button id="viewOutline" class="toolbarButton group" title="Show Document Outline"  >
               <span >Document Outline</span>
            </button>
            <button id="viewAttachments" class="toolbarButton group" title="Show Attachments"  >
               <span >Attachments</span>
            </button>
          </div>
        </div>
        <div id="sidebarContent">
          <div id="thumbnailView">
          </div>
          <div id="outlineView" class="hidden">
          </div>
          <div id="attachmentsView" class="hidden">
          </div>
        </div>
      </div>  
	  <!---- 侧边栏结束 不显示 -->

	  <!--===== 主容器开始 ========-->
      <div id="mainContainer">

		<!-- 左侧查找按钮开始 不显示 -->
        <div id="findbar" style="display:none;">
          <input id="findInput" class="toolbarField" >
          <div class="splitToolbarButton">
            <button class="toolbarButton findPrevious" title="" id="findPrevious" >
              <span>Previous</span>
            </button>
            <div class="splitToolbarButtonSeparator"></div>
            <button class="toolbarButton findNext" title="" id="findNext" >
              <span>Next</span>
            </button>
          </div>
          <input type="checkbox" id="findHighlightAll" class="toolbarField" >
          <label for="findHighlightAll" class="toolbarLabel">Highlight all</label>
          <input type="checkbox" id="findMatchCase" class="toolbarField" >
        </div>  
		<!-- 左侧查找按钮结束 不显示 -->
		
		<!--- 次级折叠工具栏开始 不显示-->
        <div id="secondaryToolbar" class="secondaryToolbar hidden doorHangerRight">
          <div id="secondaryToolbarButtonContainer">
            <button id="secondaryPresentationMode"  style="display:none;">
              <span>演示模式</span>
            </button>

            <button id="secondaryOpenFile"  style="display:none;">
              <span>打开</span>
            </button>

            <button id="secondaryPrint" class="secondaryToolbarButton print visibleMediumView" title="打印" >
              <span>打印</span>
            </button>

            <button id="secondaryDownload" class="secondaryToolbarButton download visibleMediumView" title="下载" >
              <span>下载</span>
            </button>

            <a href="#" id="secondaryViewBookmark" style="display:none;">
              <span>当前视图</span>
            </a>

            <div class="horizontalToolbarSeparator visibleLargeView"></div>

            <button id="firstPage" class="secondaryToolbarButton firstPage" title="第一页" style="display:none">
              <span>第一页</span>
            </button>
            <button id="lastPage" class="secondaryToolbarButton lastPage" title="最后一页" style="display:none">
              <span>最后一页</span>
            </button>
			
            <button id="pageRotateCcw" class="secondaryToolbarButton rotateCcw" title="Rotate Counterclockwise"  style="display:none">
              <span >逆时针旋转</span>
            </button>

            <button id="documentProperties" class="secondaryToolbarButton documentProperties" title="Document Properties…" style="display:none;">
              <span >文档信息</span>
            </button>
          </div>
        </div>
		<!-- 次级折叠工具栏结束 -->
		
		<!-- 主工具栏开始-->
        <div class="toolbar">
          <div id="toolbarContainer">
            <div id="toolbarViewer">              
              <div id="toolbarViewerRight">
				<button id="presentationMode"></button>
                <button class="toolbarButton presentationMode" title="全屏切换" id="frscreen">
                  <span >全屏切换</span>
                </button>

                <button id="openFile" class="toolbarButton openFile hiddenLargeView" title="Open File"  style="display:none;">
                  <span >打开</span>
                </button>
               
				
				<button id="pageRotateCw" class="toolbarButton rotateCw" title="顺时针旋转"  >
					<span>顺时针旋转</span>
				</button>

				<button id="toggleHandTool" class="toolbarButton handTool" title="手形工具"  >  
					<span>手形工具</span>
				</button>

				<button id="print" style="display:none"></button>
				<button id="printcheck" class="toolbarButton print" title="打印"></button>

                <button id="download" style="display:none;"></button>
				<button id="downloadcheck" class="toolbarButton download" title="下载"></button>

                <a href="#" id="viewBookmark" class="toolbarButton bookmark hiddenSmallView" title="Current view (copy or open in new window)" style="display:none;">
                  <span >当前视图</span>
                </a>

                <div class="verticalToolbarSeparator hiddenSmallView"></div>

                <button id="secondaryToolbarToggle" class="toolbarButton" title="折叠菜单"  style="display:none;">
                  <span >折叠菜单</span>
                </button>
              </div>
              <div class="outerCenter">
                <div class="innerCenter" id="toolbarViewerMiddle">
                  <div class="splitToolbarButton">
                    <button id="zoomOut" class="toolbarButton zoomOut" title="放大"  >
                      <span >放大</span>
                    </button>
                    <div class="splitToolbarButtonSeparator"></div>
                    <button id="zoomIn" class="toolbarButton zoomIn" title="缩小"  >
                      <span >缩小</span>
                     </button>
                  </div>
                  <span id="scaleSelectContainer" class="dropdownToolbarButton">
                     <select id="scaleSelect" title="放大比例"  >
                      <!--<option id="pageAutoOption" title="" value="auto" selected="selected" >Automatic Zoom</option>
                      <option id="pageActualOption" title="" value="page-actual" >Actual Size</option>-->
                      <option id="pageFitOption" title="适合页面" value="page-fit" >适合页面</option>
                      <option id="pageWidthOption" title="适合宽度" value="page-width" >适合宽度</option>
                      <option id="customScaleOption" title="" value="custom"></option>
                      <!--<option title="" value="0.5" >50%</option>
                      <option title="" value="0.75" >75%</option>
                      <option title="" value="1" >100%</option>
                      <!--<option title="" value="1.25" >125%</option>
                      <option title="" value="1.5" >150%</option>
                      <option title="" value="2" >200%</option>
                      <!--<option title="" value="3" >300%</option>
                      <option title="" value="4" >400%</option>-->
                    </select>
                  </span>
                </div>
              </div>
			  <div id="toolbarViewerLeft" >
                <button id="sidebarToggle" style="display:none;"></button>
				<button class="toolbarButton sidebar" title="切换目录" id="sidebar" style="display:none;">
                  <span >切换目录</span>
                </button>

                <div class="toolbarButtonSpacer"></div>
                <button id="viewFind" class="toolbarButton group hiddenSmallView" title="Find in Document"  style="display:none;">
                   <span >搜索</span>
                </button>
                <div class="splitToolbarButton">
                  <button class="toolbarButton pageUp"  id="previous"  title="上一页">
                    <span>上一页</span>
                  </button>
                  <div class="splitToolbarButtonSeparator"></div>
                  <button class="toolbarButton pageDown" title="下一页" id="next"  >
                    <span >下一页</span>
                  </button>
                </div>
                <!--<label id="pageNumberLabel" class="toolbarLabel" for="pageNumber" ></label>-->
                <input type="number" id="pageNumber" class="toolbarField pageNumber" value="1" size="4" min="1" title="当前页数">
                <span id="numPages" class="toolbarLabel" title="总页数"></span>
              </div>
            </div>
            <div id="loadingBar">
              <div class="progress">
                <div class="glimmer">
                </div>
              </div>
            </div>
          </div>
        </div>
		<!-- 主工具栏结束-->




        <menu type="context" id="viewerContextMenu">
          <menuitem id="contextFirstPage" label="First Page"
                    ></menuitem>
          <menuitem id="contextLastPage" label="Last Page"
                    ></menuitem>
          <menuitem id="contextPageRotateCw" label="Rotate Clockwise"
                    ></menuitem>
          <menuitem id="contextPageRotateCcw" label="Rotate Counter-Clockwise"
                    ></menuitem>
        </menu>
		
		<!--文档容器开始-->
		<div id="viewerContainer">				
			<div id="viewer" class="pdfViewer"></div>
		</div>
		<!--文档容器结束-->
		
      </div> 
	  <!-- 主控制器结束 -->

      <div id="overlayContainer" class="hidden">
        <div id="passwordOverlay" class="container hidden">
          <div class="dialog">
            <div class="row">
              <p id="passwordText" >Enter the password to open this PDF file:</p>
            </div>
            <div class="row">
              <input id="password" class="toolbarField" />
            </div>
            <div class="buttonRow">
              <button id="passwordCancel" class="overlayButton"><span >Cancel</span></button>
              <button id="passwordSubmit" class="overlayButton"><span >OK</span></button>
            </div>
          </div>
        </div>
        <div id="documentPropertiesOverlay" class="container hidden">
          <div class="dialog">
            <div class="row">
              <span>File name:</span> <p id="fileNameField">-</p>
            </div>
            <div class="row">
              <span>File size:</span> <p id="fileSizeField">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
              <span >Title:</span> <p id="titleField">-</p>
            </div>
            <div class="row">
              <span>Author:</span> <p id="authorField">-</p>
            </div>
            <div class="row">
              <span>Subject:</span> <p id="subjectField">-</p>
            </div>
            <div class="row">
              <span>Keywords:</span> <p id="keywordsField">-</p>
            </div>
            <div class="row">
              <span>Creation Date:</span> <p id="creationDateField">-</p>
            </div>
            <div class="row">
              <span>Modification Date:</span> <p id="modificationDateField">-</p>
            </div>
            <div class="row">
              <span>Creator:</span> <p id="creatorField">-</p>
            </div>
            <div class="separator"></div>
            <div class="row">
              <span>PDF Producer:</span> <p id="producerField">-</p>
            </div>
            <div class="row">
              <span>PDF Version:</span> <p id="versionField">-</p>
            </div>
            <div class="row">
              <span>Page Count:</span> <p id="pageCountField">-</p>
            </div>
            <div class="buttonRow">
              <button id="documentPropertiesClose" class="overlayButton"><span data-l10n-id="document_properties_close">Close</span></button>
            </div>
          </div>
        </div>
      </div>  <!-- 覆盖控制器 -->

    </div>
	<!-- 外容器 -->

    <div id="printContainer"></div>



<div id="mozPrintCallback-shim" hidden>
<style>
	@media print {
	  #printContainer div {
		page-break-after: always;
		page-break-inside: avoid;
	  }
	}
</style>
<style scoped>
	#mozPrintCallback-shim {
	  position: fixed;
	  top: 0;
	  left: 0;
	  height: 100%;
	  width: 100%;
	  z-index: 9999999;

	  display: block;
	  text-align: center;
	  background-color: rgba(0, 0, 0, 0.5);
	}
	#mozPrintCallback-shim[hidden] {
	  display: none;
	}
	@media print {
	  #mozPrintCallback-shim {
		display: none;
	  }
	}

	#mozPrintCallback-shim .mozPrintCallback-dialog-box {
	  display: inline-block;
	  margin: -50px auto 0;
	  position: relative;
	  top: 45%;
	  left: 0;
	  min-width: 220px;
	  max-width: 400px;

	  padding: 9px;

	  border: 1px solid hsla(0, 0%, 0%, .5);
	  border-radius: 2px;
	  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);

	  background-color: #474747;

	  color: hsl(0, 0%, 85%);
	  font-size: 16px;
	  line-height: 20px;
	}
	#mozPrintCallback-shim .progress-row {
	  clear: both;
	  padding: 1em 0;
	}
	#mozPrintCallback-shim progress {
	  width: 100%;
	}
	#mozPrintCallback-shim .relative-progress {
	  clear: both;
	  float: right;
	}
	#mozPrintCallback-shim .progress-actions {
	  clear: both;
	}
</style>

<div class="mozPrintCallback-dialog-box">
    Preparing document for printing...
    <div class="progress-row">
      <progress value="0" max="100"></progress>
      <span class="relative-progress">0%</span>
    </div>
    <div class="progress-actions">
      <input type="button" value="Cancel" class="mozPrintCallback-cancel">
    </div>
  </div>
</div>


<!--实验脚本-->
<script type="text/javascript">
	//viewer.js所需参数
  
  DEFAULT_URL = "{{$file}}"; 
	function configure(PDFJS) {
	  PDFJS.imageResourcesPath = '/assets/img/read/';
	  PDFJS.workerSrc = "{{_asset('assets/js/pdf.worker.js')}}";
	  PDFJS.cMapPacked = true;
	}	
	

	//PDF阅读器工具
	$(function(){
		//全屏按钮
		$("#frscreen").click(function(){			
			$('.aside,#header', window.parent.document).toggle();
			$('.main', window.parent.document).toggleClass("full");
			$('.read_container', window.parent.document).toggleClass("full");
			$('#viewerContainer').toggleClass("viewerContainer_full");			
		});

		//手机目录伸缩
		$('#sidebar').click(function(){
			$('.aside', window.parent.document).toggle();
		});

		//打印与下载按钮
		var login_status=0;
				
		$("#downloadcheck").click(function(){
			if(login_status==0){
				alert("对不起！您还没有登录");
				return;
			}
			if(login_status==1 && group_id==1){
				alert("对不起！VIP会员才能下载喔！");
				return;
			}
			if(login_status==1 && group_id==2){
				$.post('checklimit',{action:'1'},function(data){
					if(data=='yes'){
						$("#download").click();	
					}else if(data=='no'){
						parent.limited();
					}
				});	
				return;
			}				
		});
		$("#printcheck").click(function(){
			if(login_status==0){
				alert("对不起！您还没有登录");
				return;
			}
			if(login_status==1 && group_id==1){
				alert("对不起！VIP会员才能打印喔！");
				return;
			}
			if(login_status==1 && group_id==2){
				$.post('checklimit',{action:'1'},function(data){
					if(data=='yes'){
						$("#print").click();	
					}else if(data=='no'){
						parent.limited();
					}
				});	
				return;
			}				
		});
	});


$(function(){
	
});
</script>
</body>
</html>