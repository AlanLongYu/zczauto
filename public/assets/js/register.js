$(document).ready(function(){
    $("#captcha_imgs").click(function(){
        var img_src = $(this).find("img").attr("src")+'&t='+Math.random();
        $(this).find("img").attr("src",img_src);
    });
})

function checkPhone(){
    //获取用户输入的手机号码
    var phone=$('#phone').val();   
    //手机号正则表达式
    var reg=/^1[34578]\d{9}$/;
    //验证手机号
    if(!reg.test(phone)){           
        $('#msg_phone').html('手机号码格式不正确');
        $('#msg_phone').css({'color':'red','fontSize':'14px'});
        return false;
    }
    var str;
    //检查手机号码是否已被注册
    $.ajax({
        type:'post',
        async: true,
        url: '/user/checkReg',
        dataType:"json",  //数据类型
        data:{'phone':phone},
        success: function(data){
             if (data.data == false) {
                $('#msg_phone').html('手机号码已注册');
                $('#msg_phone').css({'color':'red','fontSize':'14px'});
                $('#phone').focus();
                str=false;
  
             }else{
                $('#msg_phone').html('手机号码正确');
                $('#msg_phone').css({'color':'green','fontSize':'14px'});
                str=true;
            }
        }
    }) 
    return str; 
} 

    function checkPassword(){
        //密码框
        var password=$('#password').val(); 

        //未输入提示
        if(password==''){ 
            $('#msg_password').html('请输入密码'); 
            $('#msg_password').css('color','red');
            $('#password').focus();
            return false;
        }
        //长度限制
        if(password.length<6 || password.length>=16){
            $('#msg_password').html('密码长度必须在6-16位之间');
            $('#msg_password').css({'color':'red','fontSize':'14px'});
            return false;
        }else{
            $('#msg_password').html('密码正确');
            $('#msg_password').css({'color':'green','fontSize':'14px'});
            return true;
        }
    }

    function checkCaptcha(){
        var captcha=$('#captcha').val();
        if(captcha==''){ 
            $('#msg_captcha').html('请输入验证码'); 
            $('#msg_captcha').css('color','red');
            $('#captcha').focus();
            return false;
        }
    }
        
    //密码确认框
    function checkPassword2(){
        var password=$('#password').val();
        var password2=$('#password2').val();
        //未输入提示
        if(password2==''){ 
            $('#msg_password2').html('请输入确认密码');
            $('#msg_password2').css('color','red');
            $('#password2').focus();
            return false;
        }
        //长度限制
        if(password2.length<6 || password2.length>=16){             
            $('#msg_password2').html('密码长度必须在6-16位之间');
            $('#msg_password2').css('color','red');
            return false;
        }else{
            //验证两次输入是否一致
            if( password!=password2 ){
                $('#msg_password2').html('两次密码不一致');
                $('#msg_password2').css('color','red');
                return false;
            }else{
                $('#msg_password2').html('密码正确');
                $('#msg_password2').css({'color':'green','fontSize':'14px'});
                return true;
            }
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

    $('#captcha').blur(function(){ 
        $("#msg_sms").hide();
        checkCaptcha(); 
    });


    //注册提交时验证
    $('#form_regist').submit(function(event){

        //点击时重新验证一遍，如果一个不对则不提交
        if(checkPhone()===false){return false;}
        if(checkPassword()===false){return false;}
        if(checkPassword2()===false){return false;}
        if(checkCaptcha()===false){return false;}

        //全部通过时，再获取所有用户输入值
        var password=$('#password').val();
        var phone=$('#phone').val();
        var captcha = $("#captcha").val();
        $("#msg_sms").html('');
       
        $.post(
            '/user/registerajax',
            {'phone':phone,'password':password,"captcha":captcha},
            function(data){
                if(data.code==200200){
                    $("#registerok").click();
                    setTimeout(function () {
                        window.location.href='/user/login';
                    }, 3000);
                    return false;
                }else{
                    $('#msg_sms').html(data.msg);
                    $('#msg_sms').css('color','red');
                    $("#msg_sms").show();
                    if(data.code==100111){
                        var img_src = $("#captcha_imgs").find("img").attr("src")+'&t='+Math.random();
                        $("#captcha_imgs").find("img").attr("src",img_src);
                    }
                    return false;
                }
            }
        );
        return false;
    });

});
        