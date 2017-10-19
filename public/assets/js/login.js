//提交时验证
$(document).ready(function(){
    //登录提交时验证
    $('#loginSubmitButton').click(function(e){
        //获取所有用户输入值
        e.preventDefault();
        var username=$('#username').val();
        var password=$('#password').val();
        //未输入时提示
        if(username==''){
            $('#msg_username').html('<span style="color:red;">请输入您的手机号<span>');
            $('#username').focus();
            return false;
        }
        if(password==''){
            $('#msg_password').html('<span style="color:red;">请输入您的密码<span>'); 
            $('#password').focus();
            return false; 
        }

        $("#form_login").submit();

    }); 


    //找加密码时验证手机号
    $("#findPwdButton").click(function(){
        //alert(123);
        var findphone=$('#findphone').val();  
        //手机号正则表达式
        var reg=/^1[34578]\d{9}$/;
        //验证手机号
        if(!reg.test(findphone)){           
            $('#msg_phone').html('手机号码格式不正确');
            $('#msg_phone').css({'color':'red','fontSize':'14px'});
        }else{
            $.post(
                'checkPhone',   
                {'phone':findphone},
                function(data){
                    if (data == 1) {
                        $('#msg_phone').html('<span style="color:green">手机号码正确<span>');
                        //发送手机验证码
                        var findphone=$('#findphone').val();  
                        $.post('sms',{'phone':findphone,'sms_type':'findpwd'},function(data){
                            if(data){
                                $("#smsok").click();
                            }else{
                                $('#msgs').html('短信发送失败');
                                $('#msgs').css('color','red');
                            }
                        });
                     }else{
                        $('#msg_phone').html('<span style="color:red">手机号码不存在<span>');
                    }
                }
            );
        }
    });


    //填写手机验证码后
    $('#sms_verify_btn').click(function(){
        var inp=$('#inp').val();
        if(inp==''){
            $("#myModal p").html('<p style="color:red">请输入收到的手机验证码</p>');
            return false;
        }else{
            $.post('findpwd',{'code':inp},function(data){
                if(data==1){
                    var findphone=$('#findphone').val();
                    location.href="changepwd?phone="+findphone;
                }else{
                    $("#myModal p").html('<p style="color:red">验证码不正确</p>');
                    return false;
                }
            });
        }
    });
});

    
