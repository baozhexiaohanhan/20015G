<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="/static/css/iconfont.css">
	<link rel="stylesheet" href="/static/css/global.css">
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">
	<link rel="stylesheet" href="/static/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/static/css/swiper.min.css">
	<link rel="stylesheet" href="/static/css/styles.css">
	<script src="/static/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/static/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/static/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/static/js/global.js" charset="UTF-8"></script>
	<script src="/static/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
	<title>@yield('title')</title>
</head>
<body>
	<!-- 顶部tab -->
	<div class="tab-header">
		<div class="inner">
			<div class="pull-left">
				<div class="pull-left">嗨，欢迎 来到<span class="cr">U袋网</span></div>
				<a href="agent_level.html">网店代销</a>
				<a href="temp_article/udai_article4.html">帮助中心</a>
			</div>
		

			<div class="pull-right">
			@if(session()->get("name")=='')
			<a href="/log"><span class="cr">登录</span></a>
				<a href="/reg">注册</a>
			@else
			<a><span class="cr">欢迎：@php echo session()->get("name") @endphp 登录</span></a>
				<a  href="/tucu">退出</a>
			@endif 
				<a href="{{url('index/center')}}">我的U袋</a>
				<a href="/welcome">我的订单</a>
				<a href="udai_integral.html"></a>
			</div>
		</div>
	</div>
