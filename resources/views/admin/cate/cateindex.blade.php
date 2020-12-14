@include('admin.lay.top')
     @section('tops')
    <link rel="stylesheet" href="{{asset('/cate/css/font.css')}}">
    <link rel="stylesheet" href="{{asset('/cate/css/xadmin.css')}}">
    <script src="{{asset('/cate/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/cate/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('/cate/js/xadmin.js')}}"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
<form class="layui-form" action="">
    <div class="layui-form-item">
    <div class="layui-inline">
      <div class="layui-input-inline" style="padding-left: 40px;">
        <input type="text" name="cate_name" value="{{$cate_name}}" placeholder="请输入分类名称" autocomplete="off" class="layui-input">
      </div>
    </div>
       <div class="layui-inline">
      <div class="layui-input-inline">
       <button class="layui-btn layui-btn-warm">搜索</button>
      </div>
    </div>
  </div>
</form>
</div>
<div class="x-body">
    <!-- <blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote> -->
    <table class="layui-table layui-form">
        <thead>
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>是否显示</th>
            <th>是否显示在导航栏</th>
            <th>操作</th>
        </tr>
        </thead>
        @foreach($res as $v)
        <thead>
        <tr style="display: none" cate_id = {{$v->cate_id}} pid = {{$v->pid}}>
            <td>
                <a href="javascript:;" class="showHide">+</a>
                {{$v->cate_id}}
            </td>
            <td  id="{{$v->cate_id}}" oldval="{{$v->cate_name}}">
                {{str_repeat('--',$v->level*3)}}
                <span class="cate_name">{{$v->cate_name}}</span>
            </td>
            <td>
                @if($v->cate_show==1)是 @elseif($v->cate_show==2)否@endif
            </td>
            <td>
                @if($v->cate_new_show==1)是 @elseif($v->cate_new_show==2)否@endif
            </td>
            <td class="td-manage">
                <a href="{{url('cate/edit/'.$v->cate_id)}}"><i class="layui-icon">&#xe642;</i>编辑</a>
                <a href="{{url('cate/destroy/'.$v->cate_id)}}"><i class="layui-icon">&#xe640;</i>删除</a>
            </td>
        </tr>
        </thead>
        @endforeach
    </table>
</div>
</body>
</html>
<script>
//顶级
$(document).ready(function(){
    $("tr[pid='0']").show();
})

//子级
$(document).on("click",'.showHide',function(){
//        alert(21212);
    var _this=$(this);
    var _sign=_this.text();
//        alert(_sign);
    var cate_id=_this.parents("tr").attr("cate_id");
    if(_sign=="+"){
        var child=$("tr[pid='"+cate_id+"']");
        if(child.length>0){
            child.show();
            _this.text("-");
        }
    }else{
        $("tr[pid='"+cate_id+"']").hide();
        _this.text("+");
    }
})
    //即点即改
    $(document).on('click','.cate_name',function(){
        // alert(123);
        var cate_name=$(this).text();
        var id=$(this).parent().attr('id');
        // alert(id);
        $(this).parent().html('<input type=text class="changename input_name_'+id+'" value='+cate_name+'>');
        $('.input_name').val('').focus().val(cate_name);
    });
   $(document).on('blur','.changename',function(){
        var newname=$(this).val();
         if(!newname){
            alert('内容不能空');return;
          }
        var oldval=$(this).parent().attr('oldval');
        // alert(oldval);
        if(newname==oldval){
            $(this).parent().html('<span class="cate_name">'+newname+'</span>');
            return;
        }
        var id=$(this).parent().attr('id');
        var obj=$(this);
        $.get('/cate/change',{id:id,cate_name:newname},function(res){
        //alert(res.msg);
        if(res.code==0){
          obj.parent().html('<span class="cate_name">'+newname+'</span>');
        }
  },'json')
    });
</script>
