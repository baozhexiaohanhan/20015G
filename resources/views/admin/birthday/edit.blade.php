@include('admin.lay.top')
     @section('tops')
    <link rel="stylesheet" href="/admin/css/font.css">
  <link rel="stylesheet" href="/admin/css/xadmin.css">
  
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
</head>
        @if (session('mss'))
          <div class="alert alert-success">
           <h5 style="color:red">{{ session('mss') }}</h5>
            </div>
          @endif
    <div class="x-body">
        <form class="layui-form" action="{{url('birthday/update/'.$birthday['birthday_id'])}}" method="post">
          <div class="layui-form-item">
            <input type="hidden" name="birthday_id" value="{{$birthday['birthday_id']}}">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>姓名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="birthday_name" required="" lay-verify="required" autocomplete="off" class="layui-input" value="{{$birthday['birthday_name']}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>请填写您的姓名！
              </div>
          </div>
           <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>手机号
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="phone" name="birthday_tel" required="" lay-verify="phone" autocomplete="off" class="layui-input" value="{{$birthday['birthday_tel']}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>请填写您的手机号！
              </div>
          </div>
         <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>邮箱
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_email" name="birthday_email" required="" lay-verify="email" autocomplete="off" class="layui-input" value="{{$birthday['birthday_email']}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>请填写您的邮箱！
              </div>
          </div>
           <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>身份证号
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="username" name="birthday_shenfen" required="" lay-verify="required" autocomplete="off" class="layui-input" value="{{$birthday['birthday_shenfen']}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>请填写正确的身份证号！
              </div>
          </div>
               <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>