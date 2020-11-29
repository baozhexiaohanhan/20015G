<link rel="stylesheet" href="/admin/css/font.css">
	<link rel="stylesheet" href="/admin/css/xadmin.css">
	
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
     <span class="layui-breadcrumb" >
  <a href="/admin/index">首页</a>
  <a href="javascript:;">商品管理</a>
  <a><cite>商品展示</cite></a>
</span>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr >

                <td align='center' >商品id</td>
                <td align='center'>商品名称</td>
                <td align='center'>商品分类</td>
                <td align='center'>商品品牌</td>
                <td align='center'>商品图片</td>
                <td align='center'>商品号</td>
                <td align='center'>商品价格</td>
                <td align='center'>商品数量</td>
                
                <td align='center'>是否上架</td>
                <td align='center'>操作</td>

            </tr>
            </thead>
            <tbody>
            @foreach($data as $k=>$v)
                <tr>
                    <td>{{$v->goods_id}}</td>
                    <td><span class="updd">{{$v->goods_name}}</span></td>
                    <td>{{$v->cate_name}}</td>
                    <td>{{$v->brand_name}}</td>
                    <td>
                        <img src="{{$v->goods_img}}" width="50">
                    </td>
                    <td>{{$v->goods_sn}}</td>
                    <td>{{$v->goods_price}}</td>
                    <td>{{$v->goods_store}}</td>
                    <td>{{$v->is_hot==1?'是':'否'}}</td>
                    <td align='center'>
                        <div class="layui-btn-group">
                            <a  class="layui-btn layui-btn-sm "><i class="layui-icon del" goods_id="{{$v->goods_id}}"></i></a>
                            <a href='edit?id={{$v->goods_id}}' class="layui-btn layui-btn-sm"><i class="layui-icon"></i></a>
                            <a href="{{url('/goods/item_show/'.$v->goods_id)}}" class="layui-btn layui-btn-sm"><i class="layui-icon">预览</i></a>
                        </div>
                    </td>

                </tr>
                @endforeach
                </tbody>

        </table>


</script>


        <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
        <script>
            layui.use('form', function(){
                form = layui.form;
            });
        
        </script>
        <script>
        $(document).on('click','.del',function () {
            $al = confirm('确定要删除吗！')
            if ($al== true) {
                var goods_id = $(this).attr("goods_id");
              var url = "{{url('goods/del')}}";
                $.ajax({
                    data: {'goods_id': goods_id},
                    url: "{{url('skus/goods/del')}}",
                    type: 'get',
                    dataType: 'json',
                    success: function (res) {
                        // if (reg.code == '000000') {
                        //     location.href = reg['url'];
                        // } else {
                        //     alert('reg.message');
                        // }
                        console.log(res);
                    location.reload();

                    }
                })
            } else {
                console.log('qvxiao')
            }
        })


</script>
