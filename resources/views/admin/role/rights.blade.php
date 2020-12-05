@include('admin.lay.top')
     @section('tops')
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  @if(session('msg'))
  <div class="alert alert-success">
      <h5 style="color:red">{{session('msg')}}</h5>
</div>
  @endif
  <body>
    <div class="x-body">
        <form action="/role/rightdo"  method="post">
        <input type="hidden" name="role_id" value="{{$role_id}}"/>
        <div class="layui-form">

        <table class="layui-table">
        <colgroup>
            <col width="100">
            <col width="150">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>菜单名称</th>
            <td>
                <input type="checkbox" name="checkedall"  lay-skin="primary"  >
                <span id='flag'>全选</span>
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($reg as $v)
        <tr>
            <td>{{str_repeat('—',$v->level*3)}}{{$v->right_name}}</td>

            <td>
            
                <input type="checkbox" class="right_{{$v->right_id}}" name="rightCheck[]" parent_id="{{$v->parent_id}}" value="{{$v->right_id}}" lay-skin="primary"   @foreach($right_id as $val) {{$val==$v->right_id ? "checked" : ""}} @endforeach >
            
            </td>
        </tr>
            @endforeach
        </tbody>
        </table>
        </div>
        <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <button type="submit" class="layui-btn">添加权限</button>
                </div>
            </div>
        </form>
    </div>
  </body>
  <script src="/static/js/jquery.js"></script>
<script>
      //全选
      $(document).on('click','.layui-form-checkbox:first',function(){
            var checkedval = $('input[name="checkedall"]').prop('checked');
//            alert(checkedval);
            $('input[name="rightCheck[]"]').prop('checked',checkedval);
            if(checkedval){
                $('.layui-form-checkbox:gt(0)').addClass('layui-form-checked');
            }else{
                $('.layui-form-checkbox:gt(0)').removeClass('layui-form-checked');
            }
        })

        //父级控制子级
        $(document).on('click','.layui-form-checkbox',function(){
                 var val=$(this).prev().val();//获取当前复选框的值
                 var checkVal=$(this).prev().prop('checked');//复选框选中
                 $('input[parent_id="'+val+'"]').prop('checked',checkVal)
                 if(checkVal){
                   $('input[parent_id="'+val+'"]').next().addClass('layui-form-checked');
               }else{
                  $('input[parent_id="'+val+'"]').next().removeClass('layui-form-checked');
             }    

             //子级控制父级
             var parent_val=$(this).prev().attr('parent_id');
             //console.log(parent_val);
             $('input[class="'+parent_val+'"]').prop('checked',checkVal)
             if(checkVal){
                $('input[class="right_'+parent_val+'"]').next().addClass('layui-form-checked');
               }else{
                $('input[class="right_'+parent_val+'"]').next().removeClass('layui-form-checked');
             }   

        })
</script>
</html>