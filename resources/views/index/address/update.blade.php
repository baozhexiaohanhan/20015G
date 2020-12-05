@section('title', '个人中心')
    @include('index.lay.tops')
    @section('tops2')
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
					<div class="title">账户信息-收货地址</div>
					<form action="/edit" class="user-addr__form form-horizontal" role="form">
						<p class="fz18 cr">修改收货地址<span class="c6" style="margin-left: 20px">电话号码、手机号码选填一项，其余均为必填项</span></p>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
							<div class="col-sm-6">
								<input class="form-control" id="name" name="consignee" value="{{$data['consignee']}}" placeholder="请输入姓名" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="details" class="col-sm-2 control-label">收货地址：</label>
							<div class="col-sm-10">
								<div class="addr-linkage">
								
									<select name="country" id="selCountries_0">
										<option value="0">请选择国家</option>
										@foreach($region as $v)
										<option value="{{$v['region_id']}}">{{$v['region_name']}}</option>
										@endforeach
									</select>
									<select name="province" id="selProvinces_0">
										<option value="0">请选择省</option>
									</select>
									<select name="city" id="selCities_0">
										<option value="0">请选择市</option>
									</select>
									<select name="district" id="selDistricts_0">
										<option value="0">请选择区/县</option>
									</select>
								</div>
								<input class="form-control" id="details" name="address" value="{{$data['address']}}" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
							<div class="col-sm-6">
								<input class="form-control" id="mobile" name="tel" value="{{$data['tel']}}" placeholder="请输入手机号码" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">邮箱：</label>
							<div class="col-sm-6">
								<input class="form-control" id="mobile" name="email" value="{{$data['email']}}" placeholder="请输入邮箱" type="text">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<button type="submit" class="but">修改</button>
							</div>
						</div>
						
						<script>
						$('select').change(function(){
							var _this = $(this);
							var region_id = _this.val();
							if(region_id<1){
								_this.nextAll().find('option:gt(0)').remove();
							}
							$.get('/address_add',{region_id:region_id},function(res){
								if(res.code=='0'){
									var address = res.data;
									// alert(address);
									var str = '<option value="0">--请选择--</option>';
									for (var i=0;i<address.length;i++) {
										str += '<option value="'+address[i].region_id+'">'+address[i].region_name+'</option>';
									}
									// alert(str);
									// console.log(str);return;
									_this.next().html(str);
								}
								return;
							},'json');
						});

						$(document).on("click",".btn",function (){
							// alert(123);die;
							//这个对象
							var _this = $(this);
							//判断用户是否确认删除
						var ifdel = confirm("您确定删除吗？");
						if(ifdel == true){
							var id = _this.attr('address_id');
							// console.log(id);
								$.ajax({
									url : '/destroy',
									dataType : 'json',
									type : 'get',
									data : {'id':id},
									success:function ( res ){
										if( res.code == 0 ){
											location.reload();
										}else{
											alert('操作繁忙，请稍后重试...');
											return false;
										}
									}
								});
						}
						return false;
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