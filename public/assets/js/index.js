/*******************用于首页的JS*****************/
/*************最后编辑时间：2016年2月5日*************/

//首页图片轮播效果
$(function ($) {
	//如果picbox中的li的数量大于0
    if ($(".picbox").length > 0) {
		//默认参数：间隔时间/淡入时间/淡出时间（对象形式）
        var defaultOpts = { interval: 3500, fadeInTime: 500, fadeOutTime: 500 };
		//标题
        var _titles = $("ul.switch li");
		//容器
        var _bodies = $("ul.picbox li");
		//li轮播数量4
        var _count = _titles.length;
		//当前下标
        var _current = 0;
		//初始化间隔下标
        var _intervalID = null;
		//停止函数，ID值为go函数返回的_intervalID

        var stop = function () { window.clearInterval(_intervalID); };
		
		//轮播函数
        var slide = function (opts) {
			//如果有参数（鼠标放入时才会传入参数）
            if (opts) {
				//如果放入第3个，则_current=3
                _current = opts.current || 0;
            } else {
				//默认情况为 _current= (0>=(4-1) ? 0 : ++0)；结果_current=1
                _current = (_current >= (_count - 1)) ? 0 : (++_current);
            };
			//选择状态为显示的li元素淡出，时间为500毫秒
            _bodies.filter(":visible").fadeOut(defaultOpts.fadeOutTime, function () {
				//正时显示的淡出后，选择第1个li元素淡入，时间500毫秒
                _bodies.eq(_current).fadeIn(defaultOpts.fadeInTime);
				//把class=current的li元素去掉class,并加在当前的li元素上
                _bodies.removeClass("current").eq(_current).addClass("current");
            });
			//标题上也要执行相同操作以便同步
            _titles.removeClass("current").eq(_current).addClass("current");
        };

		//定时运行轮播函数
        var go = function () {
			//第1步：先取消
            stop();
			//第2步：执行轮播函数，并返回ID值
            _intervalID = window.setInterval(function(){slide();},defaultOpts.interval);
        };

        var itemMouseOver = function (value, array) {
            //传入当前标题li,及li数组，得到当前li下标
            var i = $.inArray(value, array);
			//从当前下标开始轮播
            slide({ current: i });
        };

		//鼠标放入标题时切换效果
        _titles.hover(function () { 
			//如果鼠标放入的标题不是当前
			if ($(this).attr('class') != 'current') {
				//得到当前标题索引，并重新执行轮播
				itemMouseOver(this, _titles); 
			} else { 
				//鼠标放入的是当前标题，则停止轮播
				stop(); 
			}
		}, go);//当鼠标离开时，重新执行go(定时运行轮播函数)
		
		//当鼠标放入图片时执行stop,当鼠标离开时执行go
        _bodies.hover(stop, go);
		
		//无任何操作时，执行定时运行轮播函数
        go();
    }
});

/*
用到的相关知识：

1.定时器
setInterval() 方法可按照指定的周期（以毫秒计）来调用函数或计算表达式。
setInterval() 方法会不停地调用函数，直到 clearInterval() 被调用或窗口被关闭。
由 setInterval() 返回的 ID 值可用作 clearInterval() 方法的参数。
语法：
setInterval(函数或代码,间隔毫秒数)

2.淡入淡出动画效果
fadeOut(speed,callback)：回调函数在淡出后执行
fadeIn(speed,callback): 同上

3.元素是否在数组中的判断
var int=$.inarray(value,array):判断value是否在array中
在则返回该值在数组中的索引
不在返回-1

4.事件切换函数
$('#id').hover(over,out):
当鼠标放入时执行over函数,当鼠标离开时执行out函数
*/


