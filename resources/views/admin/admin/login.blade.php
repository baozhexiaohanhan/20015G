
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>后台管理系统-登录</title>
    <link rel="stylesheet" type="text/css" href="/admin/login/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/admin/login/css/login.css" />
</head>
<body class="beg-login-bg">
    <div class="beg-login-box">
        <header>
            <h1>登录</h1>
        </header>
        <div class="beg-login-main">
            <form action="/logindo" class="layui-form" method="post">
              <div class="layui-form-item">
                  <label class="beg-login-icon">
                      <i class="layui-icon"></i>
                  </label>
                  @if (session('msg'))
                  <div class="alert alert-success">
                      <h5 style="color:red">{{ session('msg') }}</h5>
                  </div>
                  @endif
              </div>
                <div class="layui-form-item">
                    <label class="beg-login-icon">
                        <i class="layui-icon">&#xe612;</i>
                    </label>
                    <input type="text" lay-verify="required" name="admin_name" autocomplete="off" placeholder="这里输入管理员名称" class="layui-input" lay-verType="tips">
                </div> 
                <div class="layui-form-item">
                    <label class="beg-login-icon">
                        <i class="layui-icon">&#xe642;</i>
                    </label>
                    <input type="password" lay-verify="required" name="admin_pwd" autocomplete="off" placeholder="这里输入密码" class="layui-input" lay-verType="tips">
                </div>
                <div class="layui-form-item div-reg">
                    <input type="input" lay-verify="required" name="code" autocomplete="off" placeholder="验证码"  class="layui-input" lay-verType="tips">
                    <input type="hidden" value="" id="codename" name="codename" lay-verify="required" autocomplete="off" class="layui-input" lay-verType="tips">
                    <input type="button" id="code" class="form-control" onclick="createCode()" style="width:60%" value='点击更换验证码'>
                </div>
                <div class="layui-form-item">
                    <div class="beg-pull">
                        <button type="submit" class="layui-btn layui-btn-normal" style="width:100%;">
                            登　　录
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <footer>
            <p>power by dw © </p>
        </footer>
    </div>
    <script type="text/javascript" src="/admin/login/javascript/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/login/layui/layui.js"></script>
    <script type="text/javascript" src="/admin/login/javascript/login.js"></script>
</body>
</html>
<title>纯字验证码</title>
<meta http-equiv='content-type' content='text/html;charset=utf-8'/>
<script type='text/javascript'>
    var code ; //在全局定义验证码
    function createCode(){
        code = "";
        var codeLength = 4;//验证码的长度
        var checkCode = document.getElementById("code");
        var codename = document.getElementById("codename");
        var random = new Array(0,1,2,3,4,5,6,7,8,9,);//随机数
        for(var i = 0; i < codeLength; i++) {//循环操作
            var index = Math.floor(Math.random()*10);//取得随机数的索引（0~35）
            code += random[index];//根据索引取得随机数加到code上
        }
        checkCode.value = code;//把code值赋给验证码
        codename.value = code;//把code值赋给验证码
    }
</script>
<style type='text/css'>
    #code{
        font-family:Arial,宋体;
        font-style:normal;
        color:red;
        border:0;
        padding:2px 3px;
        letter-spacing:3px;
        font-weight:bolder;
    }
</style>
