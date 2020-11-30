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
					<div class="addr-radio">
					@foreach($address as $k=>$v)
						<div class="radio-line radio-box active" >
						
							<label class="radio-label ep">
								<input name="addr" checked="" value="0" autocomplete="off" type="radio"></a><i class="iconfont icon-radio"></i>
								{{$v['consignee']}} &nbsp {{$v['tel']}} &nbsp {{$v['country']}}{{$v['province']}}{{$v['city']}}{{$v['district']}} &nbsp {{$v['address']}} 
							</label>
							<a href="javascript:;" class="default">默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						
						</div>
						@endforeach
					</div> 
					<div class="add_addr"><a href="/address">添加新地址</a></div>
					
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
								<tr>
									<th scope="row"><div class="img"><img src="{{$goods['goods_img']}}" alt="" class="cover"></div></th>
									<td>
										<div class="name ep3">{{$goods['goods_name']}}</div>
										<div class="type c9 cary" seckill_id="{{$goods['id']}}">
										</div>
									</td>
									<td>¥{{$goods['price']}}</td>
									<td>X{{$goods['numbers']}}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- <div class="shop-cart__info clearfix">
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
							<div class="info-line"><span class="favour-value">已优惠 ¥2.0</span>合计：<b class="fz18 cr">￥{{$attr_goods}}</b></div>							
						</div>
					</div> -->
					<div class="shop-title">确认订单</div>
					<div class="pay-mode__box">
						
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="1" autocomplete="off" type="radio" class="selected pay"><i class="iconfont icon-radio"></i>
								<img src="static/images/icons/alipay.png" alt="支付宝支付">
							</label>
							<div class="pay-value">支付<b class="fz16 crpayType" pay_type="2">{{$attr_goods}}</b>元</div>
						</div>
						
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="2" autocomplete="off" type="radio" class="pay"><i class="iconfont icon-radio"></i>
								<img src="static/images/icons/paywechat.png" alt="微信支付">
							</label>
							<div class="pay-value">支付<b class="fz16 cr">{{$attr_goods}}</b>元</div>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="3" autocomplete="off" type="radio" class="pay"><i class="iconfont icon-radio"></i>
								<span class="fz16">余额支付</span>
							</label>
							<div class="pay-value">支付<b class="fz16 cr">{{$attr_goods}}</b>元</div>
						</div>
					</div>
					<div class="user-form-group shopcart-submit">
						<a class="btn" id="tijiao">继续支付</a>
					</div>
					<script>
						$(document).ready(function(){
							$(this).on('change','input',function() {
								$(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
							})
						});
						//  //点击提交订单
		    			// $(document).on('click','.btn',function(){
	    				//     var data={};
	    				// 	data.address_id=$('input[name="address_id"]').val();
	    				// 	data.payname=$("input[name='payname']").val();
	    				// 	data.cart_id=$("input[name='cart_id']").val();
	    				// 	$.ajax({
	    				// 	    url:'/index/order',
	    				// 	    data:data,
	    				// 	    type:'post',
	    				// 		dataType:'json',
	    				// 		success:function(reg){
								
            			//             if(reg.code=='0000'){
            			//                 location.href='/index/pay/'+reg.data;
	    				// 			}
	    				// 		}
	    				// 	})
		    			// })
					</script>
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
	<script>
			// 提交订单
	$(document).on("click","#tijiao",function(){
		// 获取地址的ID
		// var address_id = $(".selected").find("#id").attr("address");
		// 支付方式
		var price = "{{$attr_goods}}";
		var pay_type = "2";
		// 获取购物车id
		var cary_id = [];
		var id = "{{$goods['id']}}";
		var seller_id = "{{$goods['seller_id']}}";
		// $(".cary").each(function(){
		// 	cary_id.push($(this).attr("cary_id"))
		// })
		var data = {};
		data.price = price;
		data.pay_type = pay_type;
		data.id = id;
		data.seller_id = seller_id;
		// console.log(data);return;
		var url = "{{url('/seckill_order')}}";
		$.ajax({
			type:"post",
			url:url,
			data:data,
			dataType:"json",
			success:function(res){
				if(res.code==0002){
					location.href="/pay/?order_id="+res.order_id;
					// console.log(res);
				}
				
			}

		})
		// console.log(cary_id);
	})
	
	
	</script>
	<!-- 底部信息 -->
	@include('index.lay.bottom')
	@section('bottom')