@section('title', 'U 袋网 列表')
@include('index.lay.tops')
@section('tops2')
@include('index.lay.top')
@section('tops')
	<div class="content inner">
		<section class="panel__div clearfix">
			<div class="filter-value">
				<div class="filter-title">视频专区</div>
				<div class="auto-play pull-right">自动播放</div>
			</div>
			<div class="video-list_div">
				@foreach($goods as $k=>$v)
				<div class="video-box">
					<div class="img" data-toggle="modal" data-target="#video-modal" data-id="8" data-video="/static/images/1.mp4" ><img src="{{$v->goods_img}}" alt="U袋学堂第8课" class="cover"></div>
					<div class="buttom">
						<div class="title ep">{{$v->goods_name}}</div>
						<div class="price">免费学习</div>
					</div>
				</div>
				@endforeach
			</div>
			<script>
				$(function() {
					$('#video-modal').on('show.bs.modal', function (e) {
						if ($('#video').data('id') != $(e.relatedTarget).data('id')) {
							 $('#video').data('id',$(e.relatedTarget).data('id'));
							$('#video').attr({
								'src': $(e.relatedTarget).data('video'),
								'poster': $(e.relatedTarget).find('img').attr('src')
							});
						};
						if ($('.auto-play').hasClass('active')) {
							$('#video').get(0).play()
						};
					});
					$('.auto-play').click(function() {
						$(this).toggleClass('active')
					});
					$('#video-modal').on('hide.bs.modal', function (e) {
						$('#video').get(0).pause();
					});
				});
			</script>
		</section>
	</div>
	<div class="modal fade bs-example-modal-lg" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div>
				<div class="modal-body">
					<video id="video" width="500"  controls preload="metadata" data-id=""></video>
				</div>
			</div>
		</div>
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