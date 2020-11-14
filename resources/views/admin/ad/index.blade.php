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
      <a><cite>广告列表</cite></a>
      </span></legend>
    </fieldset>
<!-- class="layui-form" -->
<div class="layui-form" style="padding: 15px;"><div style="padding: 15px;">
    <a style="float:right;" href="{{url('ad/create')}}" class="layui-btn layui-btn-warm">添加广告</a>
    <table class="layui-table">
        <colgroup>
        <col width="150">
        <col width="150">
        <col width="200">
        <col>
        </colgroup>
        <thead>
           <tr>
            <th>广告ID</th>
            <th>广告名称</th>
            <th>所属广告位</th>
            <th>类型</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
        @foreach($ad as $v)
            <tr>
                <td>{{$v->ad_id}}</td>
                <td id="{{$v->ad_id}}" oldval="{{$v->ad_name}}"><span class="ad_name">{{$v->ad_name}}</span></td>
                <td>{{$v->position_id}}</td>
                <td>{{$v->media_type}}</td>
                <td>{{date('Y-m-d H:i:s'),$v->start_time}}</td>
                <td>{{date('Y-m-d H:i:s'),$v->end_time}}</td>
                <td> 
                    <a href="{{url('/admin/ad/position/edit/'.$v->position_id)}}" class="layui-btn layui-btn-warm">修改</a>
                    <!-- <a href="javascript:void(0)" onclick="if(confirm('确定删除此记录吗')){ location.href='{{url('/admin/ad_position/destroy/'.$v->position_id)}}" class="layui-btn layui-btn-danger">删除</a> -->
                    <a href="javascript:void(0)" onclick="deleteById({{$v->ad_id}})" class="layui-btn layui-btn-danger moredel">删除</a>
                </td>
        @endforeach
        <tr>
            <td colspan="5">
                {{$ad->links('vendor.pagination.adminshop')}}
            </td>
        </tr>
        </tbody>
        
    </table>
</div>
<script src="/admin/js/jquery.min.js"></script>
<script>
    //即点即改
    $(document).on('click','.ad_name',function(){
        // alert(123);
        var ad_name=$(this).text();
        var id=$(this).parent().attr('id');
        // alert(id);
        $(this).parent().html('<input type=text class="changename input_name_'+id+'" value='+ad_name+'>');
        $('.input_name').val('').focus().val(ad_name);
    });
   $(document).on('blur','.changename',function(){
        var newname=$(this).val();
         if(!newname){
            alert('内容不能空');return;
          }
        var oldval=$(this).parent().attr('oldval');
        // alert(oldval);
        if(newname==oldval){
            $(this).parent().html('<span class="ad_name">'+newname+'</span>');
            return;
        }
        var id=$(this).parent().attr('id');
        var obj=$(this);
        $.get('/ad/change',{id:id,ad_name:newname},function(res){
        //alert(res.msg);
        if(res.code==0){
          obj.parent().html('<span class="ad_name">'+newname+'</span>');
        }
  },'json')
    });


    // ajax删除
   function deleteById(ad_id){
        if(!ad_id){
            return;
        }
        $.get('/ad/destroy/'+ad_id,function(res){
            alert(res.msg);
            location.reload();
        },'json')
    };
    //ajax无刷新分页
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
