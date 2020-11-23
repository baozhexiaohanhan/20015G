@section('title', 'U 袋网')
@include('index.lay.top')
@section('tops')

	<!-- 首页导航栏 -->
	<div class="top-nav bg3">
		<div class="nav-box inner">
			<div class="all-cat">
				
				<div class="cat-list__box">
						@foreach($catedata as $k=>$v)
					<div class="cat-box">
						<div class="title">
							<i class="iconfont icon-skirt ce"></i> {{$v->cate_name}}
						</div>
						<div class="cat-list__deploy">
							<div class="deploy-box">
						@foreach($v->child as $kk=>$vv)
								
								<div class="genre-box clearfix">
									<span class="title">{{$vv->cate_name}}</span>
										@foreach($vv->child as $kkk=>$vvv)
									
									<div class="genre-list">
										<a href="{{url('/goods/goods_list/'.$v->cate_id)}}">{{$vvv->cate_name}}</a>
									</div>
										@endforeach
								</div>
							@endforeach
							</div>
						</div>
					</div>
						@endforeach
				</div>
			</div>
		
			<div class="user-info__box">
				<div class="login-box">
					<div class="avt-port">
						<img src="/static/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
					</div>
					<!-- 已登录 -->
					<div class="name c6">Hi~ <span class="cr">18759808122</span></div>
					<div class="point c6">积分: 30</div>

					<!-- 未登录 -->
					<!-- <div class="name c6">Hi~ 你好</div>
					<div class="point c6"><a href="">点此登录</a>，发现更多精彩</div> -->
					<div class="report-box">
						<span class="badge">+30</span>
						<a class="btn btn-info btn-block disabled" href="#" role="button">已签到1天</a>
						<!-- <a class="btn btn-primary btn-block" href="#" role="button">签到领积分</a> -->
					</div>
				</div>
				<div class="agent-box">
					<a href="#" class="agent">
						<i class="iconfont icon-fushi"></i>
						<p>申请网店代销</p>
					</a>
					<a href="javascript:;" class="agent">
						<i class="iconfont icon-agent"></i>
						<p><span class="cr">9527</span>位代销商</p>
					</a>
				</div>
				<div class="verify-qq">
					<div class="title">
						<i class="fake"></i>
						<span class="fz12">真假QQ客服验证-远离骗子</span>
					</div>
					<form class="input-group">
						<input class="form-control" placeholder="输入客服QQ号码" type="text">
						<span class="input-group-btn">
							<button class="btn btn-primary submit" id="verifyqq" type="button">验证</button>
						</span>
					</form>
					<script>
						$(function() {
							$('#verifyqq').click(function() {
								DJMask.open({
								　　width:"400px",
								　　height:"150px",
								　　title:"U袋网提示您：",
								　　content:"<b>该QQ不是客服-谨防受骗！</b>"
							　　});
							});
						});
					</script>
				</div>
				<div class="tags">
					<div class="tag"><i class="iconfont icon-real fz16"></i> 品牌正品</div>
					<div class="tag"><i class="iconfont icon-credit fz16"></i> 信誉认证</div>
					<div class="tag"><i class="iconfont icon-speed fz16"></i> 当天发货</div>
					<div class="tag"><i class="iconfont icon-tick fz16"></i> 人工质检</div>
				</div>
			</div>
		</div>
	</div>
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        	<script src="/ads/7.js"></script>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 首页楼层导航 -->
	<nav class="floor-nav visible-lg-block">
		<span class="scroll-nav active">爆款推荐</span>
		<span class="scroll-nav">女装</span>
		<span class="scroll-nav">男装</span>
		<span class="scroll-nav">活力童装</span>
		<span class="scroll-nav">时尚包包</span>
		<span class="scroll-nav">鞋靴</span>
	</nav>
	<!-- 楼层内容 -->
	<div class="content inner" style="margin-bottom: 40px;">
		<section class="scroll-floor floor-1 clearfix">
			<div class="pull-left">
				<div class="floor-title">
					<i class="iconfont icon-tuijian fz16"></i> 爆款推荐
					<a href="" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<a class="left-img hot-img" href="">
						<script src="/ads/1.js"></script>
						<!-- <img src="/static/images/floor_1.jpg" alt="" class="cover"> -->
					</a>
					<div class="right-box hot-box">
					@foreach($goods->goods as $k=>$v)
						<a href="/details/?goods_id={{$v->goods_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
					
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="floor-title">
					<i class="iconfont icon-horn fz16"></i> 平台公告
					<a href="udai_notice.html" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<div class="notice-box bgf5">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								@foreach($notice as $k=>$v)
								<a class="swiper-slide ep" href="udai_notice.html">【公告】{{$v->notice_name}}</a>
								@endforeach
							</div>
						</div>
					</div>
					<div class="buts-box bgf5">
						<div class="but-div">
							<a href="">
								<i class="but-icon"></i>
								<p>物流查询</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>热卖专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>满减专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>折扣专区</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-2">
			<div class="floor-title">
				<i class="iconfont icon-skirt fz16"></i> 女装
				<div class="case-list fz0 pull-right">
					<a href="item_category.html">高端女装</a>
					<a href="item_category.html">时尚女装</a>
					<a href="item_category.html">上装</a>
					<a href="item_category.html">下装</a>
					<a href="item_category.html">裙装</a>
					<a href="item_category.html">内衣</a>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<script src="/ads/2.js"></script>
					<!-- <img src="/static/images/floor_2.jpg" alt="" class="cover"> -->
				</a>
				<div class="right-box">
				@foreach($goods->goods1 as $k=>$v)
						<a href="/details/?goods_id={{$v->goods_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
			
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-3">
			<div class="floor-title">
				<i class="iconfont icon-fushi fz16"></i> 男装
				<div class="case-list fz0 pull-right">
					<a href="item_category.html">高端女装</a>
					<a href="item_category.html">时尚女装</a>
					<a href="item_category.html">上装</a>
					<a href="item_category.html">下装</a>
					<a href="item_category.html">裙装</a>
					<a href="item_category.html">内衣</a>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<script src="/ads/3.js"></script>
					<!-- <img src="/static/images/floor_3.jpg" alt="" class="cover"> -->
				</a>
				<div class="right-box">
				@foreach($goods->goods2 as $k=>$v)
						<a href="/details/?goods_id={{$v->goods_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
				
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-4">
			<div class="floor-title">
				<i class="iconfont icon-kid fz16"></i> 活力童装
				<div class="case-list fz0 pull-right">
					<a href="item_category.html">高端女装</a>
					<a href="item_category.html">时尚女装</a>
					<a href="item_category.html">上装</a>
					<a href="item_category.html">下装</a>
					<a href="item_category.html">裙装</a>
					<a href="item_category.html">内衣</a>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<script src="/ads/4.js"></script>
					<!-- <img src="/static/images/floor_4.jpg" alt="" class="cover"> -->
				</a>
				<div class="right-box">
				@foreach($goods->goods3 as $k=>$v)
						<a href="" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
		
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-5">
			<div class="floor-title">
				<i class="iconfont icon-bao fz16"></i> 时尚包包
				<div class="case-list fz0 pull-right">
					<a href="item_category.html">高端女装</a>
					<a href="item_category.html">时尚女装</a>
					<a href="item_category.html">上装</a>
					<a href="item_category.html">下装</a>
					<a href="item_category.html">裙装</a>
					<a href="item_category.html">内衣</a>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<script src="/ads/5.js"></script>
					<!-- <img src="/static/images/floor_5.jpg" alt="" class="cover"> -->
				</a>
				<div class="right-box">
				@foreach($goods->goods4 as $k=>$v)
						<a href="/details/?goods_id={{$v->goods_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
				
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-6">
			<div class="floor-title">
				<i class="iconfont icon-shoes fz16"></i> 鞋靴
				<div class="case-list fz0 pull-right">
					<a href="item_category.html">高端女装</a>
					<a href="item_category.html">时尚女装</a>
					<a href="item_category.html">上装</a>
					<a href="item_category.html">下装</a>
					<a href="item_category.html">裙装</a>
					<a href="item_category.html">内衣</a>
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<script src="/ads/6.js"></script>
					<!-- <img src="/static/images/floor_6.jpg" alt="" class="cover"> -->
				</a>
				<div class="right-box">
				@foreach($goods->goods5 as $k=>$v)
						<a href="/details/?goods_id={{$v->goods_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$v->goods_img}}" style="width: 205.01px;height: 210px;" />
								<!-- <img src="/static/images/temp/S-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover"> -->
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">￥{{$v->goods_price}}</span>
								<span class="pull-right c6">进货价</span>
							</div>
							<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">{{$v->goods_name}}</div>
						</a>
						@endforeach
					
				</div>
			</div>
		</section>
	</div>
<!-- 友情链接开始 -->
<!-- <div class="right-box">
  <div class="right-box"> 
    <div class="right-box" id="link"> 友情链接：
        <a href="http://www.baidu.com" target="_blank">百度 </a>
        <a href="http://www.qq.com" target="_blank">腾讯 </a>
        <a href="http://www.sina.com.cn" target="_blank">新浪 </a>
        <a href="http://www.taobao.com" target="_blank">淘宝 </a>
        <a href="http://www.weibo.com" target="_blank">微博 </a>
        </div>
    <div class="clear"></div>
  </div>
</div> -->
<!-- 友情链接结束 -->
	<script>
		$(document).ready(function(){ 
			// 顶部banner轮播
			var banner_swiper = new Swiper('.banner-box', {
				autoplayDisableOnInteraction : false,
				pagination: '.banner-box .swiper-pagination',
				paginationClickable: true,
				autoplay : 5000,
			});
			// 新闻列表滚动
			var notice_swiper = new Swiper('.notice-box .swiper-container', {
				paginationClickable: true,
				mousewheelControl : true,
				direction : 'vertical',
				slidesPerView : 10,
				autoplay : 2e3,
			});
			// 楼层导航自动 active
			$.scrollFloor();
			// 页面下拉固定楼层导航
			$('.floor-nav').smartFloat();
			$('.to-top').toTop({position:false});
		});
	</script>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udai_welcome.html" class="r-item-hd">
					<i class="iconfont icon-user"></i>
					<div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="udai_shopcart.html" class="r-item-hd">
					<i class="iconfont icon-cart" data-badge="10"></i>
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
	</div>
	<!-- 底部信息 -->
@include('index.lay.bottom')
@section('bottom')

