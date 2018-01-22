<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>登录</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__PUBLIC__/style/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/style/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/style/beyond.css" rel="stylesheet">
    <link href="__PUBLIC__/style/animate.css" rel="stylesheet">
</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="<?php echo U('Admin/Login/login');?>" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">登录</div>
                <div class="loginbox-textbox">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text" id='username'>
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="密码" name="password" type="password" id='password'>
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" style="width: 110px;float: left;" placeholder="验证码" name="code" type="text" id='code'>
                    <img src="<?php echo U('Admin/Login/verify');?>" alt="captcha" style="float: left;margin-left: 10px;cursor: pointer;" onclick="this.src='<?php echo U('Admin/Login/verify',array('+Math.random()+'));?>';"/>
                </div>
                <div class="loginbox-submit" style="margin-top: 40px;">
                    <input class="btn btn-primary btn-block" value="登录" type="submit" id='submit'>

                </div>
            </div>

        </form>
    </div>
    <!--Basic Scripts-->
    <script src="__PUBLIC__/style/jquery-1.11.1.js"></script>
    <script src="__PUBLIC__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>

    <script type="text/javascript">
        //登录验证
        $("#submit").click(function(){
            var user = $("#username").val();
            var pass = $("#password").val();
            var code = $("#code").val();
            if(!user){
                $("#username").css('border','1px solid red');
            }

            if(!pass){
                $("#password").css('border','1px solid red');
            }

            if(!code){
                $("#code").css('border','1px solid red');
            }

            if(!user || !pass || !code){
                return false;
            }else{
                $("#submit").submit();
            }

        });
    </script>


</body>
<!--Body Ends-->
</html>