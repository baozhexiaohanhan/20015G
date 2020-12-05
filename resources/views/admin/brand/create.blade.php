@include('admin.lay.top')
     @section('tops')
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>

</head>

<body>
  
    <!-- 内容主体区域 -->
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
      <legend><span class="layui-breadcrumb">
      <a href="/">首页</a>
      <a href="/demo/">商品品牌</a>
      <a><cite>添加品牌</cite></a>
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
      <form class="layui-form" action="{{url('brand/store')}}" method="post">
      @csrf
      <div class="layui-form-item">
        <label class="layui-form-label">品牌名称:</label>
        <div class="layui-input-block">
          <input type="text" name="brand_name" lay-verify="title" autocomplete="off" placeholder="请输入品牌名称" class="layui-input">
          <b style="color:red">{{$errors->first('brand_name')}}</b>
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌网址:</label>
        <div class="layui-input-block">
          <input type="text" name="brand_url" lay-verify="title" autocomplete="off" placeholder="请输入品牌网址" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌logo:</label>
        <div class="layui-input-block">
         <div class="layui-upload-drag" id="test10">
            <i class="layui-icon"></i>
            <p>点击上传，或将文件拖拽到此处</p>
            <div class="layui-hide" id="uploadDemoView">
              <hr>
              <img src="" alt="上传成功后渲染" style="max-width: 196px">
            </div>
          </div>
          <input type="hidden" name="brand_logo">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">品牌简介:</label>
        <div class="layui-input-block">
          <textarea name="brand_desc" placeholder="请输入品牌简介" class="layui-textarea"></textarea>
        </div>
      </div>
      <div class="layui-form-item" align="center">
        <button type="submit" class="layui-btn layui-btn-normal">添加</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
      </div>
    </form>
  </div>
    </div>
  </div>
  
<script src="/static/admin/layui/layui.js"></script>
<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
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
      layui.$('input[name="brand_logo"]').attr('value',res.data);
    }
  });
  });


  $('input[name="brand_name"]').blur(function(){
    // alert(123);
    $(this).next().empty();
    var brand_name=$(this).val();
    var reg=/^[\u4e00-\u9fa5\w-.]{2,50}$/;
    if(!reg.test(brand_name)){
      $(this).next().text('品牌名称需由中文、字母、下划线、或者.组成长度为2-50位！');
      return;
    }
    var obj=$(this);
    //唯一性验证
    $.ajax({
      url:"/brand/checkOnly",
      data:{brand_name:brand_name},
      //async:true,
      dataType:'json',
      success:function(result){
        if(result.count>0){
          //alert(123);
          obj.next().text('品牌名称已经存在！');
        }
      }
    });
  });

  $('button').click(function(){
    var nameflag=true;
    var brand_name=$('input[name="brand_name"]').val();
    var reg=/^[\u4e00-\u9fa5\w-.]{2,50}$/;
    if(!reg.test(brand_name)){
      $('input[name="brand_name"]').next().text('品牌名称需由中文、字母、下划线、-或者.组成长度为2-50位！');
      return;
    }
    //唯一性验证
    $.ajax({
      url:"/brand/checkOnly",
      data:{brand_name:brand_name},
      async:false,
      dataType:'json',
      success:function(result){
        if(result.count>0){
          $('input[name="brand_name"]').next().text('品牌名称已经存在！');
          nameflag=false;
        }
      }
    });
    if(! nameflag){
      return;
    }
    $('form').submit();
  });
</script>
