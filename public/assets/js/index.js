/*******************������ҳ��JS*****************/
/*************���༭ʱ�䣺2016��2��5��*************/

//��ҳͼƬ�ֲ�Ч��
$(function ($) {
	//���picbox�е�li����������0
    if ($(".picbox").length > 0) {
		//Ĭ�ϲ��������ʱ��/����ʱ��/����ʱ�䣨������ʽ��
        var defaultOpts = { interval: 3500, fadeInTime: 500, fadeOutTime: 500 };
		//����
        var _titles = $("ul.switch li");
		//����
        var _bodies = $("ul.picbox li");
		//li�ֲ�����4
        var _count = _titles.length;
		//��ǰ�±�
        var _current = 0;
		//��ʼ������±�
        var _intervalID = null;
		//ֹͣ������IDֵΪgo�������ص�_intervalID

        var stop = function () { window.clearInterval(_intervalID); };
		
		//�ֲ�����
        var slide = function (opts) {
			//����в�����������ʱ�Żᴫ�������
            if (opts) {
				//��������3������_current=3
                _current = opts.current || 0;
            } else {
				//Ĭ�����Ϊ _current= (0>=(4-1) ? 0 : ++0)�����_current=1
                _current = (_current >= (_count - 1)) ? 0 : (++_current);
            };
			//ѡ��״̬Ϊ��ʾ��liԪ�ص�����ʱ��Ϊ500����
            _bodies.filter(":visible").fadeOut(defaultOpts.fadeOutTime, function () {
				//��ʱ��ʾ�ĵ�����ѡ���1��liԪ�ص��룬ʱ��500����
                _bodies.eq(_current).fadeIn(defaultOpts.fadeInTime);
				//��class=current��liԪ��ȥ��class,�����ڵ�ǰ��liԪ����
                _bodies.removeClass("current").eq(_current).addClass("current");
            });
			//������ҲҪִ����ͬ�����Ա�ͬ��
            _titles.removeClass("current").eq(_current).addClass("current");
        };

		//��ʱ�����ֲ�����
        var go = function () {
			//��1������ȡ��
            stop();
			//��2����ִ���ֲ�������������IDֵ
            _intervalID = window.setInterval(function(){slide();},defaultOpts.interval);
        };

        var itemMouseOver = function (value, array) {
            //���뵱ǰ����li,��li���飬�õ���ǰli�±�
            var i = $.inArray(value, array);
			//�ӵ�ǰ�±꿪ʼ�ֲ�
            slide({ current: i });
        };

		//���������ʱ�л�Ч��
        _titles.hover(function () { 
			//���������ı��ⲻ�ǵ�ǰ
			if ($(this).attr('class') != 'current') {
				//�õ���ǰ����������������ִ���ֲ�
				itemMouseOver(this, _titles); 
			} else { 
				//��������ǵ�ǰ���⣬��ֹͣ�ֲ�
				stop(); 
			}
		}, go);//������뿪ʱ������ִ��go(��ʱ�����ֲ�����)
		
		//��������ͼƬʱִ��stop,������뿪ʱִ��go
        _bodies.hover(stop, go);
		
		//���κβ���ʱ��ִ�ж�ʱ�����ֲ�����
        go();
    }
});

/*
�õ������֪ʶ��

1.��ʱ��
setInterval() �����ɰ���ָ�������ڣ��Ժ���ƣ������ú����������ʽ��
setInterval() �����᲻ͣ�ص��ú�����ֱ�� clearInterval() �����û򴰿ڱ��رա�
�� setInterval() ���ص� ID ֵ������ clearInterval() �����Ĳ�����
�﷨��
setInterval(���������,���������)

2.���뵭������Ч��
fadeOut(speed,callback)���ص������ڵ�����ִ��
fadeIn(speed,callback): ͬ��

3.Ԫ���Ƿ��������е��ж�
var int=$.inarray(value,array):�ж�value�Ƿ���array��
���򷵻ظ�ֵ�������е�����
���ڷ���-1

4.�¼��л�����
$('#id').hover(over,out):
��������ʱִ��over����,������뿪ʱִ��out����
*/


