
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/admin/css/font.css">
	<link rel="stylesheet" href="/admin/css/xadmin.css">
	
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <form  action="/goods/store" method='post' style="margin-top:20px;">
        <div class="layui-card">
                <div class="layui-card-header"></div>
                <div class="layui-card-body">
                    <div class="layui-tab layui-tab-card">
                    <ul class="layui-tab-title">
                    <li class="layui-this">商品添加</li>
                    <li>商品相册</li>
                    <li>介绍图片</li>
                    <li>商品属性</li>
                    <li></li>
                    </ul>
                    <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">

                        @if ($errors->any())
                            <div class="alert alert-danger" style=' margin-top:20px;padding-left:20px;padding-top:10px;padding-bottom:10px; background-color:pink;'>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:#ff0000; margin-top:6px;">.{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <input type="hidden" name="goods_img" value="">
                            <div class="layui-form-item">
                                    <label class="layui-form-label">商品名称</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goods_name" lay-verify="title" style="width: 300px;" autocomplete="off"  class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">商品图片</label>
                                <div class="layui-input-block" style="width: 200px;">
                                    <div class="layui-upload-drag" id="test8">
                                        <i class="layui-icon"></i>
                                        <p>点击上传，或将文件拖拽到此处</p>
                                        <div class="layui-hide" id="uploadDemoView">
                                            <hr>
                                            <img src="" alt="" style="max-width: 196px">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">商品编号</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goods_sn" disabled="disabled" value="商品编号自动给予" lay-verify="title" style="width: 300px;" autocomplete="off"  class="layui-input">
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">商品分类</label>
                                <div class="layui-input-block">
                                    <select name="cate_id" lay-filter="aihao" style="width: 200px;">
                                        <option value=""selected=""></option>
                                    @foreach($data as $k=>$v)
                                        <option value="{{$v['cate_id']}}">{{str_repeat('—',$v['level']*3)}}{{$v['cate_name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <label class="layui-form-label">品牌</label>
                                <div class="layui-input-block">
                                    <select name="brand_id" lay-filter="aihao" style="width: 200px;">
                                        <option value=""selected=""></option>
                                        @foreach($brand_data as $k=>$v)
                                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">商品价格</label >
                                <div class="layui-input-block">
                                    <input type="text" name="goods_price" style="width: 300px;" lay-verify="title" autocomplete="off"  class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">商品数量</label>
                                <div class="layui-input-block">
                                    <input type="text" name="goods_store" style="width: 300px;" lay-verify="title" autocomplete="off"  class="layui-input">
                                </div>
                            </div>
                            
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否展示</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_show" value="1" title="是" checked="">
                                    <input type="radio" name="is_show" value="2" title="否">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否热门</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_hot" value="1" title="是" checked="">
                                    <input type="radio" name="is_hot" value="2" title="否">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否上架</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_up" value="1" title="是" checked="">
                                    <input type="radio" name="is_up" value="2" title="否">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">是否新品</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="is_new" value="1" title="是" checked="">
                                    <input type="radio" name="is_new" value="2" title="否">
                                </div>
                            </div>
                    </div>
                    <div class="layui-tab-item">
                        <label class="layui-form-label"style="margin-left: -10px;" >商品相册</label>
                        <div class="layui-upload" style="margin-left: 90px;">
                    
                            <button type="button" class="layui-btn" id="test2">多图片上传</button>
                            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                                <div class="layui-upload-list" id="demo2"></div>
                            </blockquote>

                        </div>
                        <button type="submit" style="margin-left:35px; margin-top:20px;" class="layui-btn">添加</button>
                    </div>

                    <div class="layui-tab-item">
                    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                            "http://www.w3.org/TR/html4/loose.dtd">
                    <html>
                    <head>
                       
                        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
                        <script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.config.js"></script>
                        <script type="text/javascript" charset="utf-8" src="/admin/ueditor/ueditor.all.min.js"> </script>
                        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                        <script type="text/javascript" charset="utf-8" src="/admin/ueditor/lang/zh-cn/zh-cn.js"></script>

                        <style type="text/css">
                            div{
                                width:100%;
                            }
                        </style>
                    </head>
                    <body>
                    <div>
                        <h1></h1>
                        <script id="editor" type="text/plain" style="width:1024px;height:500px;"></script>
                    </div>
                   
                    <div>
                        <button onclick="createEditor()">
                        </button>
                        <button onclick="deleteEditor()">
                        </button>
                    </div>

                 
                    </body>
                    </html>
                    </div>
                    <div class="layui-tab-item">
                    商品类型： <select id="cat_id" name="cat_id"  class="layui-input-block" style="width: 200px;">
                            <option value="">请选择商品类型</option>
                            @foreach($type as $k=>$v)
                            <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
                            @endforeach                  
                            </select>
                            <br>
                        <div class="add"></div>
                    </div>
                    <div class="layui-tab-item"></div>
                    <div class="layui-tab-item"> </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </form>
        <!-- <script src="/admin/layui.js"></script>
        <script src="/admin/jquery.js"></script> -->
        <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/admin/login/layui/lay/modules/jquery.js" charset="utf-8"></script>
        <script>
            $(document).on("change","select[name='cat_id']",function(){
                var cat_id = $(this).val();
                $.get("{{url('/goods/type_attr')}}",{"cat_id":cat_id},function(res){
                    // console.log(res);
                    $(".add").html(res);
                })
            })
            
     
            function addSpec(obj){
            var newobj = $(obj).parent().parent().clone();
            newobj.find('a').html('-');
            newobj.find('a').attr("onclick","descSpec(this)");
            $(obj).parent().parent().after(newobj);
            // console.log(newobj);
            }
            function descSpec(obj){
            $(obj).parent().parent().remove();
            }
        
        </script>
        
        <script>
                        layui.use('upload', function(){
                        var $ = layui.jquery
                        ,upload = layui.upload;
                            upload.render({
                                elem: '#test8'
                                ,url: '{{url("/goods/uploads")}}' //改成您自己的上传接口
                                ,headers: {
                                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                                }
                                ,done: function(res){
                                // layer.msg('上传成功');
                                layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.data);
                                // console.log(res)
                                layui.$('input[name="goods_img"]').attr("value",res.data);
                                }
                            });

                          //多图片上传
                            upload.render({
                                elem: '#test2'
                                ,url: '/goods/goods_imgdo' //改成您自己的上传接口
                                ,multiple: true
                                ,before: function(obj){
                                //预读本地文件示例，不支持ie8
                                obj.preview(function(index, file, result){
                                //   $('#demo2').append('<img src="'+ result +'" alt="'+ file.name +'" class="layui-upload-img">')
                                });
                                }
                                ,done: function(res){
                                //上传完毕
                                console.log(res);
                                layer.msg(res.msg);
                                $('#demo2').append('<img src="'+ res['result'] +'" alt="'+ res["result"] +'" class="layui-upload-img" width="50px">')
                                $("#demo2").append('<input type="hidden" name="goods_imgs[]" value="'+res["result"]+'">');
                                }
                            });
  
                        });
        </script>
           <script type="text/javascript">

        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');


        function isFocus(e){
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e)
        }
        function setblur(e){
            UE.getEditor('editor').blur();
            UE.dom.domUtils.preventDefault(e)
        }
        function insertHtml() {
            var value = prompt('插入html代码', '');
            UE.getEditor('editor').execCommand('insertHtml', value)
        }
        function createEditor() {
            enableBtn();
            UE.getEditor('editor');
        }
        function getAllHtml() {
            alert(UE.getEditor('editor').getAllHtml())
        }
        function getContent() {
            var arr = [];
            arr.push("使用editor.getContent()方法可以获得编辑器的内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getContent());
            alert(arr.join("\n"));
        }
        function getPlainTxt() {
            var arr = [];
            arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
            arr.push("内容为：");
            arr.push(UE.getEditor('editor').getPlainTxt());
            alert(arr.join('\n'))
        }
        function setContent(isAppendTo) {
            var arr = [];
            arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
            UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
            alert(arr.join("\n"));
        }
        function setDisabled() {
            UE.getEditor('editor').setDisabled('fullscreen');
            disableBtn("enable");
        }

        function setEnabled() {
            UE.getEditor('editor').setEnabled();
            enableBtn();
        }

        function getText() {
            //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
            var range = UE.getEditor('editor').selection.getRange();
            range.select();
            var txt = UE.getEditor('editor').selection.getText();
            alert(txt)
        }

        function getContentTxt() {
            var arr = [];
            arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
            arr.push("编辑器的纯文本内容为：");
            arr.push(UE.getEditor('editor').getContentTxt());
            alert(arr.join("\n"));
        }
        function hasContent() {
            var arr = [];
            arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
            arr.push("判断结果为：");
            arr.push(UE.getEditor('editor').hasContents());
            alert(arr.join("\n"));
        }
        function setFocus() {
            UE.getEditor('editor').focus();
        }
        function deleteEditor() {
            disableBtn();
            UE.getEditor('editor').destroy();
        }
        function disableBtn(str) {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                if (btn.id == str) {
                    UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
                } else {
                    btn.setAttribute("disabled", "true");
                }
            }
        }
        function enableBtn() {
            var div = document.getElementById('btns');
            var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
            for (var i = 0, btn; btn = btns[i++];) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            }
        }

        function getLocalData () {
            alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
        }

        function clearLocalData () {
            UE.getEditor('editor').execCommand( "clearlocaldata" );
            alert("已清空草稿箱")
        }
        </script>