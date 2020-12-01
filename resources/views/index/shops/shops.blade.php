@section('title', '店铺')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')
	<!-- 首页导航栏 -->
	
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        	@foreach($msg['slice'] as $k=>$v)
            <div class="swiper-slide"><a href="/details/?goods_id={{$v['goods_id']}}"><img src="{{$v['goods_img']}}" class="cover"></a></div>
            @endforeach
          
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- 首页楼层导航 -->

	<!-- 楼层内容 -->
	<div class="content inner" style="margin-bottom: 40px;">
		<section class="scroll-floor floor-2">
			<div class="floor-title">
				<i class="iconfont icon-skirt fz16"></i>{{$msg['seller']['true_name']}}
				<div class="case-list fz0 pull-right">
					
				</div>
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<!-- <img src="/static/images/floor_2.jpg" alt="" class="cover"> -->
					<script src="/ads/2.js"></script>
				</a>
				<div class="right-box">
					@foreach($msg['goods'] as $k=>$v)
					<a href="/details/?goods_id={{$v['goods_id']}}" class="floor-item">
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
			
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<!-- <img src="/static/images/floor_3.jpg" alt="" class="cover"> -->
					<script src="/ads/3.js"></script>
				</a>
			
			</div>
		</section>
		<section class="scroll-floor floor-4">
			
			<div class="con-box">
				<a class="left-img hot-img" href="">
					<!-- <img src="/static/images/floor_4.jpg" alt="" class="cover"> -->
					<!-- <script src="/ads/4.js"></script> -->
				</a>
			
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
