@extends('admin.lay.js')
     @section('js')
     @include('admin.lay.top')
     @section('tops')
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="JavaScript:;">后台管理</a>
        <a>
          <cite>商户管理</cite></a>
      </span>
    
    </div>
    <div class="x-body">
      <div class="layui-row">
      </div>
      <xblock>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
           
            <th>登录用户名</th>
            <th>店铺名字</th>
            <th>移动电话</th>
            <th>状态</th>
            <th>注册日期</th>
            <th>操作</th>
        </thead>
        <tbody>
         
        </tbody>
      @foreach($data as $k=>$v)
          <tr id="seller" >
            
            <td >{{$v->seller_name}}</td>
            <td >{{$v->true_name}}</td>
            <td >{{$v->mobile}}</td>
            <td >
                <select name="" id="" seller_id="{{$v->seller_id}}">
                    @if($v->is_lock==0)
                    <option value="0">正常</option>
                    <option value="1">待审核</option>

                    @endif
                    @if($v->is_lock==1)
                    <option value="1">待审核</option>
                    <option value="0">正常</option>
                    @endif
                </select>
            </td>
            <td >{{$v->create_time}}</td>
            <td>
                <!-- <a href="" class="layui-btn"></a> -->
                
                <a href="JavaScript:;" seller_id="{{$v->seller_id}}" class="layui-btn layui-btn-danger san">删除</a>
            </td>
          </tr>
        @endforeach
      <div class="page">
        <div>
        </div>
      </div>

    </div>
   
  </body>

</html>
<script type="text/javascript" src="/admin/login/javascript/jquery.min.js"></script>
<script>
    $("select").change(function(){
		
		var is_lock = $(this).val();
        var seller_id = $(this).attr("seller_id");
        // console.log(seller_id);return;
		$.get("{{url('/user/user_index_up')}}",{is_lock:is_lock,seller_id:seller_id},function(res){
			if(res.code==0004){
                location.href="";
            }
			// console.log(res)
		},'json')
	})

    $(document).on("click",".san",function(){
    var seller_id = $(this).attr("seller_id");
    
  if(window.confirm("是否删除")){
    var data = {};
    data.seller_id = seller_id;
    var url = "{{url('/user/user_index_del')}}";
    $.ajax({
      type:"get",
      url:url,
      data:data,
      datetype:"json",
      success:function(res){
        // console.log(res);
        history.go(0);
      }
    })
  }
})

</script>