<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
      <legend><span class="layui-breadcrumb">
      <a href="/">首页</a>
      <a href="/demo/">广告管理</a>
      <a><cite>广告位列表</cite></a>
      </span></legend>
    </fieldset>
<!-- class="layui-form" -->
<div class="layui-form" style="padding: 15px;"><div style="padding: 15px;">
    <a style="float:right;" href="{{url('ad/position/create')}}" class="layui-btn layui-btn-warm">添加广告位</a>
    <table class="layui-table">
        <colgroup>
        <col width="150">
        <col width="150">
        <col width="200">
        <col>
        </colgroup>
        <thead>
           <tr>
            <th>广告位ID</th>
            <th>广告位名称</th>
            <th>位置宽度</th>
            <th>位置高度</th>
            <th>广告位描述</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        @foreach($position as $v)
            <tr>
                <td>{{$v->position_id}}</td>
                <td>{{$v->position_name}}</td>
                <td>{{$v->ad_width}}</td>
                <td>{{$v->ad_height}}</td>
                <td>{{$v->position_desc}}</td>
                <td> 
                     <a href="{{url('ad/position/createhtml/'.$v->position_id)}}" class="layui-btn layui-btn-warm">生成广告</a>
                    <a href="{{url('ad/position/'.$v->position_id)}}" class="layui-btn layui-btn-danger">查看广告</a>
                    <a href="{{url('ad/position/edit/'.$v->position_id)}}" class="layui-btn layui-btn-warm">修改</a>
                    <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除此记录吗')){ location.href='{{url('/admin/ad_position/destroy/'.$v->position_id)}}" class="layui-btn layui-btn-danger">删除</a> -->
                    <a href="javascript:void(0)" onclick="deleteById({{$v->position_id}})" class="layui-btn layui-btn-danger moredel">删除</a>
                </td>
        @endforeach
        <center> <tr>

            <td colspan="5">
                {{$position->links('vendor.pagination.adminshop')}}
            </td>
        </tr></center>
       
        </tbody>
        
    </table>
</div>
<script src="/admin/js/jquery.min.js"></script>
<script>
    //ajax删除
    function deleteById(position_id){
        if(!position_id){
            return;
        }
        $.get('/ad/position/destroy/'+position_id,function(res){
            alert(res.msg);
            location.reload();
        },'json')
    };
    // ajax无刷新分页
    $(document).on('click','.layui-laypage a',function(){
        var url=$(this).attr('href');
        $.get(url,function(res){
            $('tbody').html(res);
            layui.use(['element','form'], function(){
                var element = layui.element;
                var form=layui.form;
                form.render();
            });
        })
        return false;
    });
</script>
