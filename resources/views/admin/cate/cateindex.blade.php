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
    <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
</div>
<div class="x-body">
    {{--<blockquote class="layui-elem-quote">每个tr 上有两个属性 cate-id='1' 当前分类id fid='0' 父级id ,顶级分类为 0，有子分类的前面加收缩图标<i class="layui-icon x-show" status='true'>&#xe623;</i></blockquote>--}}
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
            <td>
                {{--<i class="layui-icon x-show showHide" status=@if($v->cate_show==1)是 @elseif($v->cate_show==2)否@endif'true' >&#xe623;</i>--}}
                {{@str_repeat($v->level*2)}}
                {{$v->cate_name}}
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
//    $(function(){
//        //页面一加载 只展示pid=0
//        $("tr[pid=0]").show();
////        隐藏pid不为0的数据
//        $("tr[pid!=0]").hide();
//        //点击+ -
//        $(document).on("click",".show",function(){
//            var sign=$(this).text();//获取自己当前点击的符号
//            var cate_id=$(this).parents("tr").attr('cate_id');
//            if(sign=='+'){
//                //判断是否有子类
//                if($("tr[pid='"+cate_id+"']").length>0){
//                    $("tr[pid='"+cate_id+"']").show();
//                    $(this).text('-');
//                }
//            }else{
//                $("tr[pid='"+cate_id+"']").hide();
//                $(this).text('+');
//            }
//        })
//
//    })
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
//        alert(cate_id);
//        if(_sign=="+"){
//            var child=$("tr[parent_id='"+cate_id+"']");
////            console.log(child);
//                alert(child);
//            if(child.length>0){
//                child.show();
//                _this.text("-");
//            }else if(child.length<0){
//                $("tr[parent_id='"+cate_id+"']").hide();
//                _this.text("+");
//            }
//        }
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
</script>
