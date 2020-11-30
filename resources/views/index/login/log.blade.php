<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="/static/css/iconfont.css">
	<link rel="stylesheet" href="/static/css/global.css">
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">
	<link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/static/css/login.css">
	<script src="/static/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/static/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/static/js/jquery.form.js" charset="UTF-8"></script>
	<script src="/static/js/global.js" charset="UTF-8"></script>
	<script src="/static/js/login.js" charset="UTF-8"></script>
	<title>U袋网 - 登录 / 注册</title>
</head>
<body>
	<div class="public-head-layout container">
		<a class="logo" href="index.html"><img src="/static/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
	</div>
	<div style="background:url(/static/images/login_bg.jpg) no-repeat center center; ">
		<div class="login-layout container">
			<div class="form-box login">
				<div class="tabs-nav">
					<h2>欢迎登录U袋网平台</h2>
				</div>
				<div class="tabs_container">
					<form class="tabs_form" action="" method="get" id="login_form">
						<input type="hidden" name="refer" value="{{request()->refer??''}}">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
								</div>
								<input class="form-control phone" name="user_name" id="login_phone" required placeholder="手机号" maxlength="11" autocomplete="off" type="text">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
								</div>
								<input class="form-control password" name="user_pwd" id="login_pwd" placeholder="请输入密码" autocomplete="off" type="password">
								<div class="input-group-addon pwd-toggle" title="显示密码"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></div>
							</div>
						</div>
	                    <!-- 错误信息 -->
						<div class="form-group">
							<div class="error_msg" id="login_error">
								<!-- 错误信息 范例html
								<div class="alert alert-warning alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>密码错误</strong> 请重新输入密码
								</div>
								 -->
							</div>
						</div>
	                    <button class="btn  btn-primary btn-lg btn-block submit" id="login_submit" type="button">登录</button><br>
	                    <p class="text-center">没有账号？<a href="/reg" id="register">免费注册</a></p>
                    </form>
                </div>
			</div>
	</div>
</body>
</html>
<script type="text/javascript">
	
      $(document).on('click','.btn-primary ',function (){
       var user_pwd = $('input[name="user_pwd"]').val();
        var user_name = $('input[name="user_name"]').val();
        var refer = $('input[name="refer"]').val();
        // alert(refer);return;
       $.get('/logindo',{user_pwd:user_pwd,user_name:user_name},function (res) {
            if(res.code=='0002'){
              alert(res.msg);
         	 }
         	   if(res.code=='0003'){
              alert(res.msg);
         	 }
              if(res.code=='0000'){
              
               if(refer){
               		alert(res.msg);
               		location.href=refer;
               }else{
               		alert(res.msg);
               		location.href="/";
               }
          	}
            
        },'json')


      })
</script>
