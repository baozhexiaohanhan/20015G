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
      <a><cite>添加广告</cite></a>
      </span></legend>
    </fieldset>
    <a style="float:right;" href="{{url('ad')}}" class="layui-btn layui-btn-warm">广告列表</a>
<form class="layui-form" action="{{url('ad/store')}}" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
@csrf()
    <div class="layui-form-item">
            <label class="layui-form-label">广告名称</label>
            <div class="layui-input-block">
                <input type="text" name="ad_name" lay-verify="title" autocomplete="off"  class="layui-input">
                <br><span class="notice-span" style="display:block" id="NameNotic">广告名称只是作为辨别多个广告条目之用，并不显示在广告中</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">媒介类型</label>
            <div class="layui-input-block">
            <select name="media_type" onchange="showMedia(this.value)">
                <option value="1" selected>图片</option>
                <option value="2">文字</option>
                <option value="3">轮播图</option>
            </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">广告位置</label>
            <div class="layui-input-block">
                <select name="position_id">
                    <option value="0">站外广告</option>
                    @foreach($position as $k=>$v)
                    <option value="{{$v->position_id}}">{{$v->position_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
            <label class="layui-form-label">开始日期</label>
            <div class="layui-input-inline">
              <input type="text" name="start_time" class="layui-input" id="test5" placeholder="yyyy-MM-dd HH:mm:ss">
            </div>
          </div>
        </div>


        

        <div class="layui-form-item">
            <div class="layui-inline">
            <label class="layui-form-label">日期时间选择器</label>
            <div class="layui-input-inline">
              <input type="text" name="end_time" class="layui-input" id="test6" placeholder="yyyy-MM-dd HH:mm:ss">
            </div>
          </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">广告链接</label>
            <div class="layui-input-block">
                <input type="text" name="ad_link" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
      <div class="layui-form-item">
        <label class="layui-form-label">广告图片:</label>
        <div class="layui-input-block">
         <div class="layui-upload-drag" id="test10">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
              <hr>
              <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
          </div>
          <input type="hidden" name="ad_imgs">
        </div>
      </div>

        <div class="layui-form-item">
            <label class="layui-form-label">是否开启</label>
            <div class="layui-input-block">
                <input type="radio" name="enabled" value="1" title="开启" checked>        
                <input type="radio" name="enabled" value="0" title="关闭">      
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">广告联系人</label>
            <div class="layui-input-block">
                <input type="text" name="link_man" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系人Email</label>
            <div class="layui-input-block">
                <input type="text" name="link_email" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">联系电话</label>
            <div class="layui-input-block">
                <input type="text" name="link_phone" lay-verify="title" autocomplete="off"  class="layui-input">
            </div>
        </div>
       <div class="layui-form-item" align="center">
        <button type="submit" class="layui-btn layui-btn-normal">添加</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
</form>
<script>
//JavaScript代码区域
layui.use(['element','form','upload','layedit','laydate'], function(){  
  var element = layui.element;
  var element = layui.element,
            form = layui.form,
            upload = layui.upload,
            laydate=layui.laydate;
    var $ = layui.jquery
            ,upload = layui.upload;
            var layedit = layui.layedit;
           laydate.render({
              elem: '#test5',
              type:'datetime'
            });
            laydate.render({
            elem: '#test6',
            type:'datetime'
          });
});

layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //拖拽上传
  upload.render({
    elem: '#test10'
    ,url: 'http://www.20015G.com/ad/upload' //改成您自己的上传接口
    ,done: function(res){
      layer.msg(res.msg);
      layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
      //console.log(res)
      layui.$('input[name="ad_imgs"]').attr('value',res.data);
    }
  });
  });
</script>