//提交时验证
$(document).ready(function(){
    //登录提交时验证
    $('#captcha').keyup(function(){
        $('#msg_captcha').html('点击验证码图片可更换');
        $('#msgs').html('');
    });

    $('#loginSubmitButton').click(function(e){
        //获取所有用户输入值
        e.preventDefault();
        var username=$('#username').val();
        var password=$('#password').val();
        var captcha=$('#captcha').val();
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
        if(captcha==''){
            $('#msg_captcha').html('<span style="color:red;">请输入验证码<span>'); 
            $('#captcha').focus();
            return false; 
        }
        $.ajax({
            type:"post",
            url: '/user/loginAjax',
            dataType:"json",  //数据类型
            data:{'username':username,'password':password,'captcha':captcha},
            success:function(data){
                if(data.code == 20200){
                    window.location.href = '/';
                    return ;
                }else{
                    $("#msgs").html(data.msg);
                    $("#msgs").css('color','red');
                    $("#msgs").show();
                    if(data.code== 20110){
                        var img_src = $(".verify_box").find("img").attr("src")+'&t='+Math.random();
                        $(".verify_box").find("img").attr("src",img_src)
                    }
                    return false;
                }
            }
        });

    }); 


    //找回密码时验证手机号
    $("#findpwd").click(function(e){
        e.preventDefault();
        alert('请微信或致电：13922865250 联系管理员');
        return false;
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

    
