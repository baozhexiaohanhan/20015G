<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-L-admin1.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/admin/favicon.ico" type="image/x-icon" />
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
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-primary layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:38px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
          
          <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
          <button clas(s="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','/role/create')"><i class="layui-icon"></i>添加</button>
      </xblock>
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
                <td align='center' >id</td>
                <td align='center'>权限</td>
                <td align='center'>url</td>
                <td align='center'>路由别名</td>
                <td align='center'>添加时间</td>
                <td align='center'>操作</td>
            </tr>
            </thead>
            <tbody>
            @foreach($reg as $k=>$v)
                <tr>
                    <td align='center'>{{$v->right_id}}</td>
                    <td align='center'>
                        {{str_repeat("-",$v->level*3)}}{{$v->right_name}}
                    </td>
                    <td align='center'>{{$v->right_url}}</td>
                    <td align='center'>{{$v->right_as}}</td>
                    <td align='center'>{{date('Y-m-d h:i:s',$v->add_time)}}</td>
                    <td align='center'>
                        <div class="layui-btn-group">
                            <a href="{{url('/right/rigedit/'.$v->right_id)}}" class="layui-btn layui-btn-sm"><i class="layui-icon"></i></a>
                            <a href="javascript:;" right_id="{{$v->right_id}}"  class="layui-btn layui-btn-sm del"><i class="layui-icon"></i></a>
                          

                        </div>
                    </td>
                </tr>
            @endforeach
           
            </tbody>

        </table>
    </div>
    <script src="/static/js/jquery.js"></script>
<script>
       $(document).on('click','.del',function(){
        $al=confirm('确定要删除吗！')
               if($al==true){
                var right_id=$(this).attr('right_id')
                $.ajax({
                        data:{'right_id':right_id},
                        url:'/right/rigdel',
                        type:'get',
                        dataType:'json',
                        success:function(reg){
                            if(reg.code=='000001'){
                                 alert(reg.msg)
                                 location.href=reg.url
                            }
                            if(reg.code=='000000'){
                                 alert(reg.msg)
                                 location.href=reg.url
                            }
                            if(reg.code=='000002'){
                                 alert(reg.msg)
                                 location.href=reg.url
                            }
                        }
                   })
               }else{
                 console.log('qvxiao')
               }
      })
</script>
  </body>

</html>