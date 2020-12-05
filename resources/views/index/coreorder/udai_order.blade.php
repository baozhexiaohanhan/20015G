	<!-- 顶部tab -->
	@section('title', '个人中心')
    @include('index.lay.tops')
    @section('tops2')
	<!-- 顶部标题 -->
     
	<!-- 顶部标题 -->
	<div class="bgf5 clearfix">
		<div class="top-user">
			<div class="inner">
				<a class="logo" href="index.html"><img src="/static/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
				<div class="title">个人中心</div>
			</div>
		</div>
	</div>
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
        @include('index.lay.left')
    @section('left')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-我的订单</div>
					<div class="order-list__box bgf">
						<div class="order-panel">
							<ul class="nav user-nav__title" role="tablist">
								<li role="presentation" class="nav-item active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">所有订单</a></li>
								<li role="presentation" class="nav-item "><a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">待付款 <span class="cr"></span></a></li>
								<li role="presentation" class="nav-item "><a href="#take" aria-controls="take" role="tab" data-toggle="tab">待收货 <span class="cr"></span></a></li>
								<li role="presentation" class="nav-item "><a href="#eval" aria-controls="eval" role="tab" data-toggle="tab">待评价 <span class="cr"></span></a></li>
							</ul>

							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all">
									<table class="table text-center border-collapse: collapse;">
										<tr>
											<th width="380">商品信息</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@if($data==[])
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif

										@foreach($data as $k=>$v)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
													{{date('Y-m-d',$v['addtime'])}} 订单号: {{$v['order_sn']}}
													</a>
													@foreach($v['goods_data'] as $kk=>$vv)
													<div class="card" style="border:2px solid #ddd;border-top:none;margin-top:10px;border-right:none;">
													
														<div class="img"><img src="{{$vv['goods_img']}}" alt="" class="cover"></div>
														<div class="name ep2">{{$vv['goods_name']}}   X{{$vv['buy_number']}}</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour"></div>
													</div>
													@endforeach
												</label>
											</td>
											<td>￥{{$v['order_price']}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">
													@if($v['pay_status']==0)
														等待付款
													@endif
													@if($v['pay_status']==1)
														@if($v['is_send']==0)
															待发货
														@endif
													@endif
													

													@if($v['is_send']==1)
														已发货
													@endif
													@if($v['is_send']==2)
														已收货
													@endif
													@if($v['is_send']==3)
														已退款
													@endif
													@if($v['order_status']==2)
														已取消
													@endif
												</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($v['order_status']==2)
														已取消订单
												@else
													@if($v['pay_status']==0)
														<a href="/pay/?order_id={{$v['order_id']}}" class="but but-primary " order_id="{{$v['order_id']}}">立即付款</a>
														<a href="JavaScript:;" class="but c3 kuan" order_id="{{$v['order_id']}}">取消订单</a>
													@endif
											
												@endif
											</td>
										</tr>
										@endforeach
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="pay">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										
										@if($data==[])
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif
										
										@foreach($data as $k=>$v)
										@if($v['pay_status']==0)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
													{{date('Y-m-d',$v['addtime'])}} 订单号: {{$v['order_sn']}}
													</a>
													@foreach($v['goods_data'] as $kk=>$vv)
													<div class="card" style="border:2px solid #ddd;border-top:none;margin-top:10px;border-right:none;">
													
														<div class="img"><img src="{{$vv['goods_img']}}" alt="" class="cover"></div>
														<div class="name ep2">{{$vv['goods_name']}}   X{{$vv['buy_number']}}</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
													@endforeach
												</label>
											</td>
											<td>￥{{$v['order_price']}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">
													@if($v['pay_status']==0)
														等待付款
													@endif
													@if($v['is_send']==0)
														待发货
													@endif

													@if($v['is_send']==1)
														已发货
													@endif
													@if($v['is_send']==2)
														已收货
													@endif
													
													@if($v['is_send']==3)
														已退款
													@endif
													@if($v['order_status']==2)
														已取消
													@endif
													

													
												</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												
												<a href="/pay/?order_id={{$v['order_id']}}" class="but but-primary " order_id="{{$v['order_id']}}">立即付款</a>
												<a href="JavaScript:;" class="but c3 kuan" order_id="{{$v['order_id']}}">取消订单</a>
												
												
												<!-- <a href="" class="but but-link">评价</a> -->
											</td>
										</tr>
										@endif
										@endforeach
									</table>
								</div>
								
								<div role="tabpanel" class="tab-pane fade" id="take">
									<table class="table text-center">
									<tr>
											<th width="380">商品信息</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@if($data==[])
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif

										@foreach($data as $k=>$v)
										@if($v['is_send']==1)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
													{{date('Y-m-d',$v['addtime'])}} 订单号: {{$v['order_sn']}}
													</a>
													@foreach($v['goods_data'] as $kk=>$vv)
													<div class="card" style="border:2px solid #ddd;border-top:none;margin-top:10px;border-right:none;">
													
														<div class="img"><img src="{{$vv['goods_img']}}" alt="" class="cover"></div>
														<div class="name ep2">{{$vv['goods_name']}}   X{{$vv['buy_number']}}</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
													@endforeach
												</label>
											</td>
											<td>￥{{$v['order_price']}}<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">
													@if($v['pay_status']==0)
														等待付款
													@endif
													@if($v['is_send']==0)
														待发货
													@endif

													@if($v['is_send']==1)
														已发货
													@endif
													@if($v['is_send']==2)
														已收货
													@endif
													@if($v['is_send']==3)
														已退款
													@endif
													@if($v['order_status']==2)
														已取消
													@endif
													

													
												</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="/pay/?order_id={{$v['order_id']}}" class="but but-primary" >立即付款</a>
												<!-- <a href="" class="but but-link">评价</a> -->
												<!-- <a href="JavaScript:;" class="but c3 kuan">取消订单</a> -->
											</td>
										</tr>
										@endif
										@endforeach
									</table>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="eval">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/static/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/static/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/static/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a class="disabled">下一页</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
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
	
		$(document).on("click",".kuan",function(){
			var order_id = $(this).attr("order_id");
			// console.log(order_id);
			$.getJSON("{{env('UPLOADS_URL')}}/udai_shopcart_pay?callback=?", {"order_id":order_id},function(res){
				// console.log(res);
				if(res.code==1001){
					// console.log(res.code);
					history.go(0)
				}
			},'json');
		})
	</script>
	<!-- 底部信息 -->
    @include('index.lay.bottom')
@section('bottom')