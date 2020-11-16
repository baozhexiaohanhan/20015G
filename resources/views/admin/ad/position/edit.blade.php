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

<body>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
      <legend><span class="layui-breadcrumb">
      <a href="/">首页</a>
      <a href="/demo/">广告管理</a>
      <a><cite>修改广告位</cite></a>
      </span></legend>
    </fieldset>

     <div style="padding: 15px;">
      @if ($errors->any())
        <div class="alert alert-danger" style="padding-bottom: 20px;padding-left: 20px">
        <ul>
        @foreach ($errors->all() as $error)
        <li style="margin-top: 10px;color: #ff0000;">{{ $error }}</li>
        @endforeach
        </ul>
        </div>
      @endif
<a style="float:right;" href="{{url('ad/position')}}" class="layui-btn layui-btn-warm">广告位列表</a>
<div style="padding: 15px;">
        <form class="layui-form" action="{{url('ad/position/update/'.$position->position_id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="layui-form-item">
                <label class="layui-form-label">广告位名称</label>
                <div class="layui-input-block">
                    <input type="text" name="position_name" lay-verify="title" autocomplete="off" placeholder="广告名称" value="{{$position->position_name}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告位宽</label>
                <div class="layui-input-block">
                    <input type="text" name="ad_width" lay-verify="title" autocomplete="off" placeholder="广告宽" value="{{$position->position_name}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告位高</label>
                <div class="layui-input-block">
                    <input type="text" name="ad_height" lay-verify="title" autocomplete="off" placeholder="广告高" value="{{$position->ad_height}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告位描述</label>
                <div class="layui-input-block">
                    <input type="text" name="position_desc" lay-verify="title" autocomplete="off" placeholder="广告描述" value="{{$position->position_desc}}" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">广告位模板</label>
                <div class="layui-input-block">
                    <select name="template">
                        <option value="0">直接搜索选中</option>
                        <option value="1" selected>单图片</option>
                        <option value="2">多图片</option>
                        <option value="3">文字</option>
                        <option value="4">轮播图</option>

                    </select>
                </div>
            </div>
       <div class="layui-form-item" align="center">
        <button type="submit" class="layui-btn layui-btn-normal">修改</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
</form>
    </div>
    </div>
    </div>
