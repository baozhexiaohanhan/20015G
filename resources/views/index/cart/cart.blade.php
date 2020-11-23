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
	<title>U袋网</title>
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
				<a href="udai_welcome.html">我的U袋</a>
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
				<div class="title">购物车</div>
				<form action="udai_shopcart_pay.html" class="shopcart-form__box">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th width="150">
									<label class="checked-label"><input type="checkbox" class="check-all"><i></i> 全选</label>
								</th>
								<th width="300">商品信息</th>
								<th width="150">单价</th>
								<th width="200">数量</th>
								<th width="200">现价</th>
								<th width="80">操作</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cart as $k=>$v)
							<tr>
								<th scope="row">
									<!-- <input type="checkbox" name="checkbox" class="cartid" id="" value="{{$v->rec_id}}" /> -->
									<label class="checked-label">
										@if($v->is_up==2)
										@endif
										@if($v->is_up==1)
										<input type="checkbox" name="checkbox" class="cartid" value="{{$v->rec_id}}">
										@endif
										<i></i>
										<div class="img"><img src="{{$v->goods_img}}" alt="" style="width: 173.2px;height: 240px;" class="cover"></div>
									</label>
								</th>
								<td>
									@if($v->is_up==2)
									<div class="name ep3" style="color:#888;">{{$v->goods_name}}
									</div>
									<div style="color:#888;">商品已下架</div>
									@endif
									@if($v->is_up==1)
									<div class="name ep3">{{$v->goods_name}}</div>
									@endif
									<div class="type c9">
										@if(isset($v['goods_attr']))
										@foreach($v['goods_attr'] as $attr)
										{{$attr['attr_name']}}:{{$attr['attr_value']}}
										@endforeach
										@endif
									</div>
								</td>
								<td>¥{{$v->shop_price}}</td>
								<td>
									<div class="cart-num__box">
										<!-- <input type="button" class="sub" goods_id="{{$v->goods_id}}" cart="{{$v->cart_id}}" value="-">
										<input type="text" class="val" cart="{{$v->rec_id}}" goods_id="{{$v->goods_id}}" goods_attr_id="{{$v->goods_attr_id}}" value="1" maxlength="2">
										<input type="button" class="add" value="+"> -->

									<input type="button" id="sub" class="increment mins" cart="{{$v->rec_id}}" goods_id="{{$v->goods_id}}" goods_attr_id="{{$v->goods_attr_id}}" value="-">
									<input type="text" class="val" cart="{{$v->rec_id}}" goods_id="{{$v->goods_id}}" goods_attr_id="{{$v->goods_attr_id}}" value="{{$v->buy_number}}" maxlength="2">
									<input type="button" id="add" class="increment plus" cart="{{$v->rec_id}}" goods_id="{{$v->goods_id}}" goods_attr_id="{{$v->goods_attr_id}}" value="+">
									</div>
									<span style="color: red;" id="sadd"></span>
								</td>
								<td><span class="sum">￥{{$v->buy_number*$v->shop_price}}</span></td>
								<td><a href="">删除</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="user-form-group tags-box shopcart-submit pull-right">
						<button type="submit" class="btn">提交订单</button>
					</div>
					<div class="checkbox shopcart-total">
						<label><input type="checkbox" class="check-all"><i></i> 全选</label>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">删除</a>
						<div class="pull-right">
							已选商品 <span>2</span> 件
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
							<b class="cr">¥<span class="fz24">0.00</span></b>
						</div>
					</div>
					<script>
						$(document).ready(function(){
							var $item_checkboxs = $('.shopcart-form__box tbody input[type="checkbox"]'),
								$check_all = $('.check-all');
							// 全选
							$check_all.on('change', function() {
								$check_all.prop('checked', $(this).prop('checked'));
								$item_checkboxs.prop('checked', $(this).prop('checked'));
								var cart_id = new Array();
								$("input[name='checkbox']:checked").each(function(){
									cart_id.push($(this).val());
								})
								$.get("/getcartprice",{cart_id:cart_id},function(res){
									if(res.code=='0'){
										$('.fz24').text(res.data.total);
									}
								})
							});
							// 点击选择
							$item_checkboxs.on('change', function() {
								var flag = true;
								$item_checkboxs.each(function() {
									if (!$(this).prop('checked')) { flag = false }
								});
								$check_all.prop('checked', flag);
							});
							// // 个数限制输入数字
							// $('input.val').onlyReg({reg: /[^0-9.]/g});
							// // 加减个数
							// $('.cart-num__box').on('click', '.sub,.add', function() {
							// 	var value = parseInt($(this).siblings('.val').val());
							// 	if ($(this).hasClass('add')) {
							// 		$(this).siblings('.val').val(Math.min((value += 1),99));
							// 	} else {
							// 		$(this).siblings('.val').val(Math.max((value -= 1),1));
							// 	}
							// });
							$(function(){
								// 文本框的失去焦点事件
								$(document).on("blur",".val",function(){
									var _this=$(this);
									// alert(_this);
									//获取商品数量
									var buy_number=_this.val();
									// alert(buy_number);
									//获取购物车id
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get('/cartplus',{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){										
										 	if(res.code==0000){
													_this.parents("tr").find(".sum").text('￥'+res.data);
													var cart_id = new Array();
													$("input[name='checkbox']:checked").each(function(){
														cart_id.push($(this).val());
													})
													$.get("/getcartprice",{cart_id:cart_id},function(res){
														if(res.code=='0'){
																$('.fz24').text(res.data.total);
															}
													})
												}
												if(res.code==0001){
													_this.val(res.data);
												}
												if(res.code==0001){
													_this.parent().next().html("最多只能购买"+res.data+"件");
												}

									},'json')
								})
								//给+绑定一个点击事件
								$(document).on('click','#add',function(){
									var _this=$(this);
									var buy_number=parseInt(_this.prev('input').val());
									buy_number=buy_number+1;
									_this.prev('input').val(buy_number);
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get("/cartplus",{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){
										if(res.code==0000){
											_this.parents("tr").find(".sum").text('￥'+res.data);
											var cart_id = new Array();
											$("input[name='checkbox']:checked").each(function(){
												cart_id.push($(this).val());
											})
											$.get("/getcartprice",{cart_id:cart_id},function(res){
												if(res.code=='0'){
														$('.fz24').text(res.data.total);
													}
											})
										}
										if(res.code==0001){
											console.log(res);
											_this.prev().val(res.data);
										}
										if(res.code==0001){
											_this.parent().next().html();
										}

									},'json')
								})
								//给-绑定一个点击事件
								$(document).on('click','#sub',function(){
									var _this=$(this);
									var buy_number=parseInt(_this.next('input').val());
									if(buy_number<=1){
						                _this.next('input').val(1);
						            }else{
						                buy_number=buy_number-1;
						                _this.next('input').val(buy_number);
									}
									//获取购物车id
									var rec_id=$(this).attr("cart");
									// alert(rec_id);
									var goods_attr_id=$(this).attr("goods_attr_id");
									// alert(goods_attr_id);
									var goods_id=$(this).attr("goods_id");
									// alert(goods_id);
									$.get("/cartplus",{buy_number:buy_number,rec_id:rec_id,goods_attr_id:goods_attr_id,goods_id:goods_id},function(res){
										_this.parents("tr").find(".sum").text('￥'+res.data);
										var cart_id = new Array();
										$("input[name='checkbox']:checked").each(function(){
											cart_id.push($(this).val());
										})
										$.get("/getcartprice",{cart_id:cart_id},function(res){
											if(res.code=='0'){
													$('.fz24').text(res.data.total);
												}
										})
									},'json')
								})
								
							});
						});


			
						$(document).on("click",".cartid",function(){
							var cart_id = new Array();
							$("input[name='checkbox']:checked").each(function(){
								cart_id.push($(this).val());
							})
							$.get("/getcartprice",{cart_id:cart_id},function(res){
								if(res.code=='0'){
										$('.fz24').text(res.data.total);
									}
							},'json')
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
@include('index.lay.bottom')
@section('bottom')