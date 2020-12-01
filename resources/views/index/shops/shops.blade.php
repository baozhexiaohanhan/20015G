@section('title', 'U 袋网')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')
	<!-- 首页导航栏 -->
	
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        	@foreach($msg['slice'] as $k=>$v)
            <div class="swiper-slide"><a href="item_show.html"><img src="{{$v['goods_img']}}" class="cover"></a></div>
            @endforeach
           <!--  <div class="swiper-slide"><a href="item_show.html"><img src="/static/images/temp/banner_2.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_category.html"><img src="/static/images/temp/banner_3.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_show.html"><img src="/static/images/temp/banner_4.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_sale_page.html"><img src="/static/images/temp/banner_5.jpg" class="cover"></a></div> -->
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
					<!-- <img src="/static/images/floor_2.jpg" alt="" class="cover"> -->
					<script src="/ads/2.js"></script>
				</a>
				<div class="right-box">
					@foreach($msg['goods2'] as $k=>$v)
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="{{$v['goods_img']}}" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥{{$v['goods_price']}}.00</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="{{$v['goods_name']}}">{{$v['goods_name']}}</div>
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
					<!-- <img src="/static/images/floor_3.jpg" alt="" class="cover"> -->
					<script src="/ads/3.js"></script>
				</a>
				<div class="right-box">
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-001.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-002.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-003.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-004.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-005.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-006.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-007.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/M-008.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
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
					<!-- <img src="/static/images/floor_4.jpg" alt="" class="cover"> -->
					<script src="/ads/4.js"></script>
				</a>
				<div class="right-box">
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-011.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-012.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-013.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-014.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-015.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-016.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-017.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
					<a href="item_show.html" class="floor-item">
						<div class="item-img hot-img">
							<img src="/static/images/temp/S-018.jpg" alt="纯色圆领短袖T恤活a动衫弹" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">￥18.0</span>
							<span class="pull-right c6">进货价</span>
						</div>
						<div class="name ep" title="纯色圆领短袖T恤活a动衫弹力柔软">纯色圆领短袖T恤活a动衫弹力柔软</div>
					</a>
				</div>
			</div>
		</section>
	</div>
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
