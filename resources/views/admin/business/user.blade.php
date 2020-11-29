@extends('admin.lay.js')
     @section('js')
     @extends('admin.lay.js')
     @section('js')
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>注册</title>
<link rel="stylesheet" type="text/css" href="/admin/css/login.css">
</head>
<body>
<div id="wrapper" class="login-page">
<div id="login_form" class="form" style="width:5000px;">
<form class="register-form">
<input type="text" placeholder="用户名" value="admin" id="r_user_name" />
<input type="password" placeholder="密码" id="r_password" />
<input type="text" placeholder="电子邮件" id="r_emial" />
<button id="create">创建账户</button>
<p class="message">已经有了一个账户? <a href="#">立刻登录</a></p>
</form>

     <div class="layui-tab-item layui-show">
<form action="{{url('/business/user_add')}}" method="post" enctype="multipart/form-data" class="login-form">
   
        <div class="layui-form-item">
                <label class="layui-form-label">登陆用户名：</label>
            <div class="layui-input-block">
            <input class="input_text" name="seller_name" type="text" value=""  alt="用户名不能为空">
                        <span>* 用户名称（必填）</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
            <input class="input_text" name="password" type="password" bind="repassword" >
                        <span>* 登录密码</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
            <input class="input_text" name="repassword" type="password" bind="password" >
                        <span>* 重复确认密码</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">商户真实全称</label>
            <div class="layui-input-block">
            <input class="input_text" name="true_name" type="text" value="" >
                        <span>* 公司真实全称</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">商户资质材料</label>
            <div class="layui-input-block">
            <input type="file" name="paper_img">
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">手机号码</label>
            <div class="layui-input-block">
            <input type="text" class="input_text" name="mobile" >
                        <span>* 移动电话联系方式：如：13000000000</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
            <input type="text" class="input_text" name="email" >
                        <span>* 电子邮箱联系方式：如：aircheng@163.com</span>
            </div>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label">联动选择框</label>
                <div class="layui-input-block">
                <div class="layui-inline">
                    <select name="country">
                    <option value="">请选择国</option>
                    @foreach($region as $k=>$v)
                        <option value="{{$v->region_id}}">{{$v->region_name}}</option>
                    @endforeach
                    </select>
                    
                </div>
                <div class="layui-inline">
                    <select name="province">
                    <option value="">请选择市</option>
                    
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="city">
                    <option value="">请选择县/区</option>
                    
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="area">
                    <option value="">请选择县/区</option>
                    
                    </select>
                </div>
        </div> <div class="layui-form-item">
                <label class="layui-form-label">详细地址</label>
            <div class="layui-input-block">
            <input class="input_text" name="address" type="text" empty="" value="">
            </div>
        </div> 
        

        </div> 
    </div>
    <button type="submit" style="margin-left:35px; margin-top:20px;" class="layui-btn">申请加盟</button>
    </div>
</form>
</div>
</div>

<script type="text/javascript" src="/admin/login/javascript/jquery.min.js"></script>
<script type="text/javascript">
	function check_login()
	{
	 var name=$("#user_name").val();
	 var pass=$("#password").val();
	 if(name=="admin" && pass=="admin")
	 {
	  alert("登录成功！");
	  $("#user_name").val("");
	  $("#password").val("");
       $(location).attr('href', 'index.html');
	 }
	 else
	 {
	  $("#login_form").removeClass('shake_effect');  
	  setTimeout(function()
	  {
	   $("#login_form").addClass('shake_effect')
	  },1);  
	 }
	}
	function check_register(){
		var name = $("#r_user_name").val();
		var pass = $("#r_password").val();
		var email = $("r_email").val();
		if(name!="" && pass=="" && email != "")
		 {
		  alert("注册成功！");
		  $("#user_name").val("");
		  $("#password").val("");
		 }
		 else
		 {
		  $("#login_form").removeClass('shake_effect');  
		  setTimeout(function()
		  {
		   $("#login_form").addClass('shake_effect')
		  },1);  
		 }
	}
	$(function(){
		$("#create").click(function(){
			check_register();
			return false;
		})
		$("#login").click(function(){
			check_login();
			return false;
		})
		$('.message a').click(function () {
		    $('form').animate({
		        height: 'toggle',
		        opacity: 'toggle'
		    }, 'slow');
		});
	})
	</script>
</body>
</html>
<script type="text/javascript" src="/admin/login/javascript/jquery.min.js"></script>
<script>
    $("select").change(function(){
		
		var region_id = $(this).val();
		if(region_id<1){
			$(this).nextAll().find('option:gt(0)').remove();
			return;
		}
		// alert(region_id);return;
		var obj=$(this);
		$.get("{{url('/business/region')}}",{region_id:region_id},function(res){
			if(res.code==00){
				var address=res.data;
				var str='<option value="0">请选择</option>';
				for(var i=0;i<address.length;i++){
					str+='<option value="'+address[i].region_id+'">'+address[i].region_name+'</option>';
				}
				obj.parent().next().find("select").html(str);
			}
			// console.log(res)
		},'json')
	})


</script>
