function checkPhone(){
    //检查电话号码
    var reg=/^1[34578]\d{9}$/;
    
    if(!reg.test(phone)){			
        $('#msg_phone').html('请输入正确的电话号码');
        $('#msg_phone').css({'color':'red','fontSize':'14px'});
        return false;
    }
    var str;
    $.ajax({
        async: false,
        url: '/user/checkPhone',
        data:{'phone':phone},
        success: function(data){
             if (data == 1) {
                $('#msg_phone').html('电话号码输入错误');
                $('#msg_phone').css({'color':'red','fontSize':'14px'});
                str=false;
  
             }else{
                $('#msg_phone').html('电话号码输入正确');
                $('#msg_phone').css({'color':'green','fontSize':'14px'});
                str=true;
            }
        }
    }) 
    return str; 
} 
function checkPassword(){
    //鐎靛棛鐖滃锟?		var password=$('#password').val(); 

    //閺堫亣绶崗銉﹀絹缁€锟?		if(password==''){ 
        $('#msg_password').html('鐠囩柉绶崗銉ョ槕閻拷'); 
        $('#msg_password').css('color','red');
        return false;
    }
    //闂€鍨闂勬劕鍩?		if(password.length<6 || password.length>=16){
        $('#msg_password').html('鐎靛棛鐖滈梹鍨韫囧懘銆忛崷锟?-16娴ｅ秳绠ｉ梻锟?);
        $('#msg_password').css({'color':'red','fontSize':'14px'});
        return false;
    }else{
        $('#msg_password').html('鐎靛棛鐖滃锝団€?);
        $('#msg_password').css({'color':'green','fontSize':'14px'});
        return true;
    }
}
    
    //检查密码
function checkPassword2(){
    var password=$('#password').val();
    var password2=$('#password2').val();
    if(password2==''){ 
        $('#msg_password2').html('请再次输入密码');
        $('#msg_password2').css('color','red');
        return false;
    }
    if(password2.length<6 || password2.length>=16){				
        $('#msg_password2').html('请确认密码在6-16位字符');
        $('#msg_password2').css('color','red');
        return false;
    }else{
        if( password!=password2 ){
            $('#msg_password2').html('两次密码输入不正确');
            $('#msg_password2').css('color','red');
            return false;
        }else{
            $('#msg_password2').html('密码输入正确');
            $('#msg_password2').css({'color':'green','fontSize':'14px'});
            return true;
        }
    }
    
}
    
	function checkSmsVerify(){
		var sms_verify=$('#sms_verify').val(); 
		if(sms_verify==''){
			$('#msg_sms').html('请输入验证码');
			$('#msg_sms').css('color','red');
			return false; 
		}else{
			return true;
		}
	}




$(function(){
	$('#phone').blur(function(){ 
		checkPhone();		
	});
	$('#password').blur(function(){ 
		checkPassword(); 
	});
	$('#password2').blur(function(){ 
		checkPassword2(); 
	});
	$("#sms_btn").click(function(){
		
		if(checkPhone()===true){
			var phone=$('#phone').val();  
			$.post('sms',{'phone':phone,'sms_type':'register'},function(data){
				if(data){
					$('#msg_sms').html('验证码正确');
					$('#msg_sms').css('color','green');
				}else{
					$('#msg_sms').html('验证码错误');
					$('#msg_sms').css('color','red');
				}
			});
		}

	});

	$('#form_regist').submit(function(event){
		if(checkPhone()===false){return false;}
		if(checkPassword()===false){return false;}
		if(checkPassword2()===false){return false;}
		if(checkSmsVerify()===false){return false;}
		
		var phone=$('#phone').val();
		var sms_verify=$('#sms_verify').val(); 
		

$.post(
        '/user/register',
        {'phone':phone,'password':password,'sms_verify':sms_verify},
        function(data){
            if(data==1){
                $("#registerok").click();
                setTimeout(function () {
                    window.location.href='/user/login';
                }, 3000);
                
                return false;
            }else if(data==2){
                $('#msgs').html('登录失败，请联系管理员');
                $('#msgs').css('color','red');
                $('#msgs').show();
                return false;
            }else if(data==3){
                $('#msg_sms').html('验证码已过期');
                $('#msg_sms').css('color','red');
                return false;
            }else{
                $('#msg_sms').html(data);
                $('#msg_sms').css('color','red');
                return false;
            }
        }
    );
}); 
});




