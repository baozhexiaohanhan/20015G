@section('title', 'U 袋网')
@include('index.lay.tops')
@section('tops2')

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
				<form action="/order" class="shopcart-form__box">
					<div class="addr-radio">
					
					@foreach($data['address'] as $k=>$v)
						<div  @if($v['mo']==2) class="radio-line radio-box active" @else  class="radio-line radio-box" @endif>
						
							<label class="radio-label ep">
								<input name="country" @if($v['mo']==2) checked @endif value="" autocomplete="off" type="radio"></a><i class="iconfont icon-radio" ></i>
								{{$v['consignee']}} &nbsp {{$v['tel']}} &nbsp {{$v['country']}}{{$v['province']}}{{$v['city']}}{{$v['district']}} &nbsp {{$v['address']}} 
							</label>
							<a href="javascript:;" address_id="{{$v['address_id']}}" class="default">默认地址</a>
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
							@foreach($data['cart'] as $k=>$v)
								<tr cart_id="{{$v['rec_id']}}">
									<th scope="row"><div class="img"><img src="{{$v['goods_img']}}" alt="" class="cover"></div></th>
									<td>
										<div class="name ep3">{{$v['goods_name']}}</div>
										<div class="type c9 cary" cary_id="{{$v['rec_id']}}" seller_id="{{$v['seller_id']}}">
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
							<div class="info-line"><span class="favour-value">已优惠 ¥2.0</span>合计：<b class="fz18 cr">￥{{$data['price']}}</b></div>							
						</div>
					</div> -->
					<div class="shop-title">确认订单</div>
					<div class="pay-mode__box">
						
						<div class="radio-line radio-box active">
							<label class="radio-label ep ">
								<input name="pay-mode" value="1" checked autocomplete="off" type="radio" class="pay"><i class="iconfont icon-radio "></i>
								<img src="static/images/icons/alipay.png" alt="支付宝支付">
							</label>
							<div class="pay-value">支付<b class="fz16 crpayType" pay_type="2"  selected>{{$data['price']}}</b>元</div>
						</div>
						
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="2" autocomplete="off" type="radio" class="pay"><i class="iconfont icon-radio"></i>
								<img src="static/images/icons/paywechat.png" alt="微信支付">
							</label>
							<div class="pay-value">支付<b class="fz16 cr">{{$data['price']}}</b>元</div>
						</div>
						<div class="radio-line radio-box">
							<label class="radio-label ep">
								<input name="pay-mode" value="3" autocomplete="off" type="radio" class="pay"><i class="iconfont icon-radio"></i>
								<span class="fz16">余额支付</span>
							</label>
							<div class="pay-value">支付<b class="fz16 cr">{{$data['price']}}</b>元</div>
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
					
						$(document).on("click",".default",function(){
							var address_id = $(this).attr('address_id');
							// console.log(address_id);return
							$.getJSON("http://www.2001api.com/shop/address_up?callback=?", {"address_id":address_id},function(obj){
								
								console.log(obj);
							});
						});
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
		var price = "{{$data['price']}}";
		var pay_type = "2";
		// 获取购物车id
		var cary_id = [];
		var seller_id = [];
		$(".cary").each(function(){
			seller_id.push($(this).attr("seller_id"))
		})
		$(".cary").each(function(){
			cary_id.push($(this).attr("cary_id"))
		})
		var data = {};
		data.price = price;
		data.pay_type = pay_type;
		data.rec_id = cary_id;
		data.seller_id = seller_id;
		// console.log(data);return;
		var url = "{{url('/order_add')}}";
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