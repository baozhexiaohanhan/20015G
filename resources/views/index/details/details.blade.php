@section('title', 'U 袋网')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')

	<!-- 搜索栏 -->

	<!-- 内页导航栏 -->
    <link rel="stylesheet" type="text/css" href="/static/index/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/pages-item.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/pages-zoom.css" />
    <link rel="stylesheet" type="text/css" href="/static/index/css/widget-cartPanelView.css" />
	<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
				<ol class="breadcrumb">
					<li><a href="index.html">首页</a></li>
					<li><a href="item_sale_page.html">爆款推荐</a></li>
					<li class="active">原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏</li>
				</ol>
				<div class="item-pic__box" id="magnifier">
					<div class="small-box">
						<img class="cover" src="{{$data['goods']['goods_img']}}" style="width: 360px;height: 360px;" alt="重回汉唐 旧忆 原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏">
						<span class="hover"></span>
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix">
                            @if(isset($data['goods_log']['goods_log']))
                                @php $go = explode("|",$data['goods_log']['goods_log']); @endphp
                              @foreach($go as $k=>$v)
								<li class="item active" data-src="{{$v}}"><img class="cover" src="{{$v}}" alt="商品预览图"></li>
							  @endforeach
                            @endif
							</ul>
						</div>
						<a href="javascript:;" class="btn btn-default btn-next"></a>
					</div>
                    <div>
                        <input type="button" value="收藏" class="collect item-action__basket">
                    </div>
					<div class="big-box"><img src="{{$data['goods']['goods_img']}}" alt="重回汉唐 旧忆 原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏"></div>
				</div>
				<script src="/static/js/jquery.magnifier.js"></script>
				<script>
					$(function () {
						$('#magnifier').magnifier();
					});
				</script>
				<div class="item-info__box">
					<div class="item-title">
						<div class="name ep2">{{$data['goods']['goods_name']}}</div>
						@foreach($data['coupon'] as $v)
						<div class="sale cr coupon item-action__basket" id="{{$v['coupon_id']}}">{{$v['name']}}</div>
						@endforeach
					</div>
					<div class="item-price bgf5">
						<div class="price-box clearfix">
							<div class="price-panel pull-left">
								售价：<span class="price" id="price">￥{{$data['goods']['goods_price']}} <s class="fz16 c9">￥24.00</s></span>
							</div>
							<div class=" pull-right">
								<h5></h5>
								
							</div>
							<script>
								// 会员价格折叠展开
								$(function () {
									$('.vip-price-panel').click(function() {
										if ($(this).hasClass('active')) {
											$('.all-price__box').stop().slideUp('normal',function() {
												$('.vip-price-panel').removeClass('active').find('.iconfont').removeClass('icon-up').addClass('icon-down');
											});
										} else {
											$(this).addClass('active').find('.iconfont').removeClass('icon-down').addClass('icon-up');
											$('.all-price__box').stop().slideDown('normal');
										}
									});
								});
							</script>
						</div>
					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<span class="ind-label c9">访问量</span>
							<span class="ind-count cr">{{$data['hits']}}</span>
						</li>
						<!-- <li class="item-ind-item">
							<span class="ind-label c9">累计销量</span>
							<span class="ind-count cr">1688</span>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr">1314</span></a>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">赠送积分</span>
							<span class="ind-count cg">666</span></a>
						</li> -->
					</ul>
                    <div class="clearfix choose">
						<div id="specification" class="summary-wrap clearfix">
						@if(isset($data['attrs_new_key']))
						@foreach($data['attrs_new_key'] as $k=>$v)

							<dl>
								<dt>
									<div class="fl title">
									<i>{{$v['attr_name']}}</i>
								</div>
								</dt>
								@php $i=0; @endphp
								@foreach($v['attr_value'] as $kk=>$vv)
								<dd >
									<a href="javascript:;" @if($i==0) class="selected" @endif class="goods_attr_id"  goods_attr_id="{{$kk}}">{{$vv}}<span title="点击取消选择">&nbsp;</span></a>
								</dd>
								@php $i++; @endphp
								@endforeach
							</dl>
							@endforeach									
						@endif	
						
						</div>
						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="fl title">
                                <div class="control-group">
                                    <div class="controls">
                                        <input autocomplete="off" id="buy_number" type="text" value="1" minnum="1" class="itxt" />
                                        <a href="javascript:void(0);" class="increment plus" id="add">+</a>
                                        <a href="javascript:void(0);" class="increment mins" id="lass">-</a>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="item-action clearfix bgf5">
							<!-- <a href="javascript:;" rel="nofollow" data-addfastbuy="true" title="点击此按钮，到下一步确认购买信息。" role="button" class="item-action__buy"></a> -->
							<a href="javascript:;" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket addshopcart">
								<i class="iconfont icon-shopcart"></i> 加入购物车
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-right picked-div">
				<div class="lace-title">
					<span class="c6">爆款推荐</span>
				</div>
				<div class="swiper-container picked-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							@foreach($data['hot_goods'] as $v)
							<a class="picked-item" href="/details/?goods_id={{$v['goods_id']}}">
								<img src="{{$v['goods_img']}}" alt="" class="cover">
								<div class="look_price">¥{{$v['goods_price']}}</div>
							</a>
							@endforeach
						</div>
					</div>
				</div>
				<div class="picked-button-prev"></div>
				<div class="picked-button-next"></div>
				<script>
					$(document).ready(function(){ 
						// 顶部banner轮播
						var picked_swiper = new Swiper('.picked-swiper', {
							loop : true,
							direction: 'vertical',
							prevButton:'.picked-button-prev',
							nextButton:'.picked-button-next',
						});
					});
				</script>
			</div>
		</section>
		<section class="item-show__div item-show__body posr clearfix">
			<div class="item-nav-tabs">
				<ul class="nav-tabs nav-pills clearfix" role="tablist" id="item-tabs">
					<li role="presentation" class="active"><a href="#detail" role="tab" data-toggle="tab" aria-controls="detail" aria-expanded="true">商品详情</a></li>
					<li role="presentation"><a href="#evaluate" role="tab" data-toggle="tab" aria-controls="evaluate">累计评价 <span class="badge">1314</span></a></li>
					<li role="presentation"><a href="#service" role="tab" data-toggle="tab" aria-controls="service">售后服务</a></li>
				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab">
						<div class="item-detail__info clearfix">
                        @foreach($data['newinfo'] as $k=>$v)
							<div class="record">{{$v['attr_name']}}：{{$v['attr_value']}}</div>
                        @endforeach
						</div>
						<div class="rich-text">
							<p style="text-align: center;">
								{!!$data['goods']['goods_desc']!!}
							</p>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">1314</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">1000</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">314</span></a></li>
								<li role="presentation"><a href="#bad" role="tab" data-toggle="tab" aria-controls="bad">差评 <span class="badge">0</span></a></li>
							</ul>
						</div>
						<div class="evaluate-content">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledby="all-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/60页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="good" aria-labelledby="good-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/20页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="normal" aria-labelledby="normal-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>


									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/5页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="bad" aria-labelledby="bad-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/static/images/temp/S-001-1_s.jpg" data-src="/static/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-2_s.jpg" data-src="/static/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-3_s.jpg" data-src="/static/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-4_s.jpg" data-src="/static/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/static/images/temp/S-001-5_s.jpg" data-src="/static/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									<!-- 分页 -->
									<div class="page text-center clearfix">
									</div>
								</div>
							</div>
							<script src="/static/js/jquery.zoom.js"></script>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service" aria-labelledby="service-tab">
						<!-- 富文本 -->
						<div class="service-content rich-text">
							<img title="" alt="" src="http://img.aocmonitor.com.cn/image/2014-06/86575417.gif" width="240" height="160" border="0" align="left"><p>承蒙惠购 AOC 产品，谨致谢意！为了让您更好地使用本产品，武汉艾德蒙科技股份有限公司通过该产品随机附带的保修证向您做出下述维修服务承诺，并按照该服务的承诺向您提供维修服务。</p><p>这些服务承诺仅适用于2016年6月1日（含）之后销售的AOC品牌显示器标准品。</p><p>如果您选择购买了 AOC 显示器扩展功能模块或其它厂家电脑主机，其保修承诺请参见相应产品的保修卡。</p><p>所有承诺内容以产品附件的保修卡为准。</p><p><br></p><h3>一、全国联保</h3><p style="text-indent:2em">AOC 显示器实施全国范围联保，国家标准三包服务。无论您是在中国大陆 ( 不含香港、澳门、台湾地区) 何处购买并在大陆地区使用的显示器，出现三包范围内的故障时，可凭显示器的保修证正本和购机发票到 AOC 显示器维修网点或授权网点进行维修同时，也欢迎您关注官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)进行查询。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/89154415.jpg" alt=""></div><p><br></p><p>三包服务如下：</p><ol><li>商品自售出之日起 7 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择退货、换货或修理。</li><li>商品自售出之日起 15 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择换货或修理。</li><li>商品自售出之日起 1 年内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择修理。</li></ol><p>以下情况不在三包范围内：</p><ol><li>超过三包有效期。</li><li>无有效的三包凭证及发票。</li><li>发票上内容与商品实物标识不符或者涂改的。</li><li>未按产品使用说明书要求使用、维护、保养而造成损坏的（人为损坏）。</li><li>非 AOC 授权的修理者拆动造成损坏的（私自拆修）。</li><li>非 AOC 在中国大陆（不含香港、澳门、台湾地区）销售的商品。</li></ol><h3>二、显示器专享服务</h3><p><strong>1、LUVIA视界头等舱，VIP专享服务</strong></p><p style="text-indent:2em">AOC针对各省市地区采取指定商品销售，消费者购买指定销往该区域的LUVIA卢瓦尔显示器标准品，从发票开具之日起1年内，注册成为官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)产品会员，即可在当地享“LUVIA视界头等舱，VIP专享服务”。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/25352146.jpg" alt=""></div><p><br></p><p style="text-indent:2em">* 如客户未在发票开具之日起1年内注册AOC微信会员，则只享受国家三包服务。</p><p style="text-indent:2em">注册会员方式：1、关注“AOC用户俱乐部”微信公众号。2、点击“会员”→“注册会员”。3、填写个人真实信息并注册产品信息，即可成为AOC产品会员。</p><p style="text-indent:2em"><strong>3年免费上门更换</strong>：从发票开具之日起3年内，产品若发生《微型计算机商品性能故障表》所列性能故障，可免费更换不低于同型号同规格产品。（服务网点无法覆盖区域，全国区域免费邮寄，双向运费由AOC负担）</p><p style="text-indent:2em"><strong>一键快捷掌上服务：</strong>从注册成为“AOC用户俱乐部”会员之日起，可享在线贴身技术顾问有问必答、售后服务在线预约、服务网点在线查询等一键快捷掌上服务。（人工客服咨询在线时间：8:00-22:00）</p><p style="text-indent:2em"><strong>增值豪礼尊享服务：</strong>可参加“AOC用户俱乐部”有奖互动赢取豪礼。</p><p>注：<br>(1)如不能及时提供购机发票或发票记载不清、涂改、商品实物标示和发票内容不符，将以您上传“AOC用户俱乐部”的发票信息为准计算保修时间；如果发票信息并未上传，将以该显示器制造日期(制造日期见显示器后壳条形码标签)加一个月为准计算保修时间。<br>(2)非“AOC用户俱乐部”产品会员，不享受“LUVIA视界头等舱，VIP专享服务”。</p>
						</div>
					</div>
			    </div>
				<div class="recommends">
					<div class="lace-title type-2">
						<span class="cr">爆款推荐</span>
					</div>
					<div class="swiper-container recommends-swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								@foreach($data['hot_goods'] as $v)
									<a class="picked-item" href="">
										<img src="{{$v['goods_img']}}" alt="" class="cover">
										<div class="look_price">¥{{$v['goods_price']}}</div>
									</a>
								@endforeach
							</div>
					</div>
					<script>
						$(document).ready(function(){
							var recommends = new Swiper('.recommends-swiper', {
								spaceBetween : 40,
								autoplay : 5000,
							});
						});
					</script>
				</div>
			</div>
		
			<script>
				$(document).ready(function(){
					$('#descCate').smartFloat(0);
					$('.dc-idsItem').click(function() {
						$(this).addClass('selected').siblings().removeClass('selected');
					});
					$('#item-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
						$('#descCate #' + $(e.target).attr('aria-controls') + '-tab')
						.addClass('in').addClass('active').siblings()
						.removeClass('in').removeClass('active');
					});
				});
			</script>
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
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
	<!-- <script src="/static/js/jquery.1.12.4.min.js" charset="UTF-8"></script> -->
    <script>
        $("dd a").click(function(){
            $(this).parent().siblings().find('a').removeClass('selected');
            $(this).addClass("selected");
            pricedata();
        })
        pricedata();
		function pricedata(){
			var goods_attr_id = new Array();
                $('.selected').each(function(i){
                    goods_attr_id.push($(this).attr('goods_attr_id'));
                })
				var goods_id = "{{$data['goods']['goods_id']}}";
		$.getJSON("http://www.2001api.com/attr_key?callback=?", {"goods_id":goods_id,"goods_attr_id":goods_attr_id},function(obj){
			$('#price').html(obj.data);
			// console.log(obj.data);
		});
	}

	//加入购物车
	$('.addshopcart').click(function(){
		var goods_id = "{{$data['goods']['goods_id']}}";
		// alert(goods_id);return;
		var seller_id = "{{$data['goods']['seller_id']}}";
		// alert(seller_id);return;
		var coupon_id = $(".coupon").attr('id');
        // alert(coupon_id);return;
		var buy_number=$('.itxt').val();
		// alert(buy_number);return;
		var goods_attr_id=new Array();
        $('.selected').each(function(i,k){
            goods_attr_id.push($(this).attr('goods_attr_id'));
        });
        // alert(goods_attr_id);return;
        $.get('/addcart',{goods_id:goods_id,buy_number:buy_number,goods_attr_id:goods_attr_id,seller_id:seller_id,coupon_id:coupon_id},function(res){
        	// alert(res);return;
        	if(res.code=='-1'){
                location.href="/log?refer="+location.href;
            }
        	if(res.code=='1003' || res.code=='1004' || res.code=='1005' || res.code=='1006'){
                alert(res.msg);
            }
            if(res.code=='0'){
                if(confirm('加入成功是否跳转到购物车列表？')){
                	location.href="/cart";
            	}
        	}
        },'json');
	})
//		领取优惠券
		$('.coupon').click(function(){
            var goods_id = "{{$data['goods']['goods_id']}}";
            // alert(goods_id);return;
            var coupon_id = $(this).attr('id');
            // alert(coupon_id);return;
            $.get('/coupon',{goods_id:goods_id,coupon_id:coupon_id},function(res){
                // alert(res);return;
                if(res.code=='-1'){
                    location.href="/log?refer="+location.href;
                }
                if(res.code=='1003' || res.code=='1004'){
                    alert(res.msg);
                }
                if(res.code=='0'){
                   alert(res.msg);
                }
            },'json');
        })
	$(document).on("click","#add",function(){
						    // alert(123);
						    var _this=$('this');
						    // alert(_this);
						    var buy_number=parseInt($("#buy_number").val());
						    var buy_number=buy_number+1;
						    //alert(buy_number);
						    $('#buy_number').val(buy_number);

						});
						$(document).on("click","#lass",function(){
						    // alert(123);
						    //var _this=$('this');
						    // alert(_this);
						    var buy_number=parseInt($("#buy_number").val());
						    if(buy_number<=1){
						        $('#buy_number').val(1);
						    } else{
						         var buy_number=buy_number-1;
						     //alert(buy_number);
						        $('#buy_number').val(buy_number);
						    }   
						       

						});

//		收藏
        $('.collect').click(function(){
            var goods_id = "{{$data['goods']['goods_id']}}";
            // alert(goods_id);return;
            $.get('/collect',{goods_id:goods_id},function(res){
                // alert(res);return;
                if(res.code=='-1'){
                    location.href="/log?refer="+location.href;
                }
                if(res.code=='1004'){
                    alert(res.msg);
                }
                if(res.code=='0'){
                    alert(res.msg);
                }
            },'json');
        })
    </script>
	<!-- 底部信息 -->
    @include('index.lay.bottom')
@section('bottom')