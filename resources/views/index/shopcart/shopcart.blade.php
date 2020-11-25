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
				<div class="pull-left">嗨，欢迎来到<span class="cr">U袋网</span></div>
				<a href="agent_level.html">网店代销</a>
				<a href="temp_article/udai_article4.html">帮助中心</a>
			</div>
			<div class="pull-right">
				<a href="login.html"><span class="cr">登录</span></a>
				<a href="login.html?p=register">注册</a>
				<a href="{{url('index/center')}}">我的U袋</a>
				<a href="udai_order.html">我的订单</a>
				<a href="udai_integral.html">积分平台</a>
			</div>
		</div>
	</div>
	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="index.html"><img src="/static/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
				<div class="title">购物车</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车-确认支付 </div>
				<div class="shop-title">收货地址</div>
				<form action="" class="shopcart-form__box">
					<div class="addr-radio">
						<div class="radio-line radio-box active">
							<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （喵喵喵 收） 153****9999">
								<input name="addr" checked="" value="0" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								福建省 福州市 鼓楼区 温泉街道
								五四路159号世界金龙大厦20层B北 福州rpg.blue网络
								（喵喵喵 收） 153****9999
							</label>
							<a href="javascript:;" class="default">默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （taroxd 收） 153****9999">
								<input name="addr" value="1" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								福建省 福州市 鼓楼区 温泉街道
								五四路159号世界金龙大厦20层B北 福州rpg.blue网络
								（taroxd 收） 153****9999
							</label>
							<a href="" class="default">设为默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （喵污喵⑤ 收） 153****9999">
								<input name="addr" value="2" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								福建省 福州市 鼓楼区 温泉街道
								五四路159号世界金龙大厦20层B北 福州rpg.blue网络
								（喵污喵⑤ 收） 153****9999
							</label>
							<a href="" class="default">设为默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （浴巾打码女 收） 153****9999">
								<input name="addr" value="2" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								福建省 福州市 鼓楼区 温泉街道
								五四路159号世界金龙大厦20层B北 福州rpg.blue网络
								（浴巾打码女 收） 153****9999
							</label>
							<a href="" class="default">设为默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						</div>
					</div>
					<div class="add_addr"><a href="udai_address.html">添加新地址</a></div>
					<div class="shop-title">确认订单</div>
					<div class="shop-order__detail">
						<table class="table">
							<thead>
								<tr>
									<th width="120"></th>
									<th width="300">商品信息</th>
									<th width="150">单价</th>
									<th width="200">数量</th>
								</tr>
							</thead>
							<tbody>
							@foreach($data['cart'] as $k=>$v)
								<tr>
									<th scope="row"><div class="img"><img src="{{$v['goods_img']}}" alt="" class="cover"></div></th>
									<td>
										<div class="name ep3">{{$v['goods_name']}}</div>
										<div class="type c9">
											@if(isset($v['goods_attr']))
												@foreach($v['goods_attr'] as $vv)
													{{$vv['attr_name']}}:{{$vv['attr_value']}}
												@endforeach
											@endif</div>
									</td>
									<td>¥{{$v['goods_price']}}</td>
									<td>{{$v['buy_number']}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="shop-cart__info clearfix">
						<div class="pull-right text-right">
							<div class="form-group">
								<label for="coupon" class="control-label">优惠券使用：</label>
								<select id="coupon" >
									<option value="-1" selected>- 请选择可使用的优惠券 -</option>
									<option value="1">【满￥20.0元减￥2.0】</option>
									<option value="2">【满￥30.0元减￥2.0】</option>
									<option value="3">【满￥25.0元减￥1.0】</option>
									<option value="4">【满￥10.0元减￥1.5】</option>
									<option value="5">【满￥15.0元减￥1.5】</option>
									<option value="6">【满￥20.0元减￥1.0】</option>
								</select>
							</div>
							<script>
								$('#coupon').bind('change',function() {
									console.log($(this).val());
								})
							</script>
							<div class="info-line">优惠活动：<span class="c6">无</span></div>
							<div class="info-line">运费：<span class="c6">¥0.00</span></div>
							<div class="info-line"><span class="favour-value">已优惠 ¥2.0</span>合计：<b class="fz18 cr">￥{{$data['price']}}</b></div>							
						</div>
					</div>
					<div class="shop-title">确认订单</div>
					<div class="pay-mode__box">
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="1" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								<span class="fz16">余额支付</span><span class="fz14">（可用余额：¥88.0）</span>
							</label>
							<div class="pay-value">支付<b class="fz16 cr">18.00</b>元</div>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="2" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								<img src="static/images/icons/alipay.png" alt="支付宝支付">
							</label>
							<div class="pay-value">支付<b class="fz16 cr">18.00</b>元</div>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="3" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								<img src="static/images/icons/paywechat.png" alt="微信支付">
							</label>
							<div class="pay-value">支付<b class="fz16 cr">18.00</b>元</div>
						</div>
					</div>
					<div class="user-form-group shopcart-submit">
						<button type="submit" class="btn">继续支付</button>
					</div>
					<script>
						$(document).ready(function(){
							$(this).on('change','input',function() {
								$(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
							})
						});
					</script>
				</form>
			</div>
		</section>
	</div>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udai_welcome.html" class="r-item-hd">
					<i class="iconfont icon-user" data-badge="0"></i>
					<div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="udai_shopcart.html" class="r-item-hd">
					<i class="iconfont icon-cart"></i>
					<div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="udai_collection.html" class="r-item-hd">
					<i class="iconfont icon-aixin"></i>
					<div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="" class="r-item-hd">
					<i class="iconfont icon-liaotian"></i>
					<div class="r-tip__box"><span class="r-tip-text">联系客服</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="issues.html" class="r-item-hd">
					<i class="iconfont icon-liuyan"></i>
					<div class="r-tip__box"><span class="r-tip-text">留言反馈</span></div>
				</a>
			</li>
			<li class="r-toolbar-item to-top">
				<i class="iconfont icon-top"></i>
				<div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
			</li>
		</ul>
		<script>
			$(document).ready(function(){ $('.to-top').toTop({position:false}) });
		</script>
	</div>
	<!-- 底部信息 -->
	@include('index.lay.bottom')
	@section('bottom')