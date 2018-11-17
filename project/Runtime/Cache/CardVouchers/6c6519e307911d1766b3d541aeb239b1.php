<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<meta content="<?php echo C('WEB_SITE_KEYWORD');?>" name="keywords"/>
<meta content="<?php echo C('WEB_SITE_DESCRIPTION');?>" name="description"/>
<link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
<link href="/Public/static/font-awesome/css/font-awesome.min.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/base.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/weiphp.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/static/emoji.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/Public/static/bootstrap/js/html5shiv.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
<!--<![endif]-->
<script type="text/javascript" src="/Public/static/bootstrap/js/bootstrap.min.js"></script>
<!--引入JS-->
<script type="text/javascript" src="/Public/static/webuploader-0.1.5/webuploader.min.js"></script>

<script type="text/javascript" src="/Public/static/clipboard.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/Public/Home/js/admin_image.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/Public/static/masonry/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="/Public/static/jquery.dragsort-0.5.2.min.js"></script> 
<script type="text/javascript">
var  IMG_PATH = "/Public/Home/images";
var  STATIC = "/Public/static";
var  ROOT = "";
var  UPLOAD_PICTURE = "<?php echo U('Home/File/uploadPicture',array('session_id'=>session_id()));?>";
var  UPLOAD_FILE = "<?php echo U('Home/File/upload',array('session_id'=>session_id()));?>";
var  UPLOAD_DIALOG_URL = "<?php echo U('Home/File/uploadDialog',array('session_id'=>session_id()));?>";
</script>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

<!-- 提示 -->
<div id="top-alert" class="top-alert-tips alert-error" style="display:none">
  <?php if(!empty($code)): ?><a class="code" href="">解决方法 ></a><?php endif; ?>
  <div class="code_box"></div>
  <a class="close" href="javascript:;"><b class="fa fa-times-circle"></b></a>
  <div class="alert-content"></div>
</div>
</head>
<body>
	<div class="main_box">
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="wrap">
    
       <a class="brand" title="<?php echo C('WEB_SITE_TITLE');?>" href="<?php echo U('Home/index/index');?>">
       		<img height="52" src="/Public/Home/images/logo.png"/>
       </a>
        <?php if(is_login()): ?><div class="switch_mp">
            	<?php if(!empty($public_info["public_name"])): ?><a href="javascript:;"><?php echo ($public_info["public_name"]); ?>
                <?php if(isset($myPublics) && !empty($myPublics)) { ?> <b class="pl_5 fa fa-sort-down"></b> <?php } ?>
                </a><?php endif; ?>
                <ul>
                <?php if(isset($myPublics)) { ?>
                <?php if(is_array($myPublics)): $i = 0; $__LIST__ = $myPublics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('home/index/main', array('wpid'=>$vo['mp_id']));?>"><?php echo ($vo["public_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <?php } ?>
            </div><?php endif; ?>
      <?php $index_2 = strtolower ( MODULE_NAME . '/' . CONTROLLER_NAME . '/*' ); $index_3 = strtolower ( MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME ); ?>
       
            <div class="top_nav">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                    	<?php if($myinfo["is_init"] == 0 ): ?><li><p>该账号配置信息尚未完善，功能还不能使用</p></li>
                    		<?php elseif($myinfo["is_audit"] == 0 and !$reg_audit_switch): ?>
                    		<li><p>该账号配置信息已提交，请等待审核</p></li>
                            <?php elseif($index_2 == 'home/apps/*' or $index_3 == 'home/user/profile' or $index_2 == 'home/appslink/*' or $index_3 == 'home/user/bind_login'): ?>
                    		
                    		<?php else: ?> 
                    		<?php if(is_array($core_top_menu)): $i = 0; $__LIST__ = $core_top_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ca): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($ca["id"]); ?>" class="<?php echo ($ca["class"]); ?>"><a href="<?php echo ($ca["url"]); ?>"><?php echo ($ca["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; endif; ?>

                        <li class="dropdown admin_nav">
                            <a href="#" class="dropdown-toggle login-nav" data-toggle="dropdown" style="">
                                <?php if(!empty($myinfo['headimgurl'])): ?><img class="admin_head url" src="<?php echo ($myinfo["headimgurl"]); ?>"/>
                                <?php else: ?>
                                    <img class="admin_head default" src="/Public/Home/images/default.png"/><?php endif; ?>
                                <?php echo (getShort($myinfo["nickname"],4)); ?><b class="pl_5 fa fa-sort-down"></b>
                            </a>
                            <ul class="dropdown-menu" style="display:none">
                               <?php if($mid==C('USER_ADMINISTRATOR')): ?><li><a href="<?php echo U ('Admin/Index/Index');?>" target="_blank">后台管理</a></li><?php endif; ?>
                            	<li><a href="<?php echo U ('Home/Apps/lists');?>">应用列表</a></li>
                                <li><a href="<?php echo U ('Home/Apps/add');?>">账号配置</a></li>
                                <li><a href="<?php echo U('Home/User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('Home/User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                    	<li style="padding-right:20px">你好!欢迎来到<?php echo C('WEB_SITE_TITLE');?></li>
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>">注册</a>
                        </li>
                        <li>
                            <a href="<?php echo U('admin/index/index');?>" style="padding-right:0">后台入口</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
</div>
	<!-- /头部 -->
	
	<!-- 主体 -->
	
<?php  if(!is_login()){ Cookie ( '__forward__', $_SERVER ['REQUEST_URI'] ); redirect(U('home/user/login',array('from'=>4))); } ?>
<div id="main-container" class="admin_container">
  <?php if(!empty($core_side_menu)): ?><div class="sidebar">
      <ul class="sidenav">
        <li>
          <ul class="sidenav_sub">
            <?php if(is_array($core_side_menu)): $i = 0; $__LIST__ = $core_side_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($vo["class"]); ?>" data-id="<?php echo ($vo["id"]); ?>"> <a href="<?php echo ($vo["url"]); ?>" target="<?php echo ((isset($vo["target"]) && ($vo["target"] !== ""))?($vo["target"]):'_self'); ?>"> <?php echo ($vo["title"]); ?> </a><b class="active_arrow"></b></li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </li>
        <?php if(!empty($addonList)): ?><li> <a class="sidenav_parent" href="javascript:;"> <img src="/Public/Home/images/ico1.png"/> 其它功能</a>
            <ul class="sidenav_sub" style="display:none">
              <?php if(is_array($addonList)): $i = 0; $__LIST__ = $addonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="<?php echo ($navClass[$vo[name]]); ?>"> <a href="<?php echo ($vo[addons_url]); ?>" title="<?php echo ($vo["description"]); ?>"> <i class="icon-chevron-right">
                  <?php if(!empty($vo['icon'])) { ?>
                  <img src="<?php echo ($vo["icon"]); ?>" />
                  <?php } ?>
                  </i> <?php echo ($vo["title"]); ?> </a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
          </li><?php endif; ?>
      </ul>
    </div><?php endif; ?>
  <div class="main_body">
    
  <div class="span9 page_message">
  <section id="contents"> <?php if(!empty($nav)): ?><ul class="tab-nav nav">
  <?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; isset($vo['class']) || $vo['class'] = '';isset($vo['url']) || $vo['url'] = '#'; ?>
    <li class="<?php echo ($vo["class"]); ?>"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul><?php endif; ?>
<?php if(!empty($sub_nav)): ?><div class="sub-tab-nav">
       <ul class="sub_tab">
       <?php if(is_array($sub_nav)): $i = 0; $__LIST__ = $sub_nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; isset($vo['class']) || $vo['class'] = ''; ?>
          <li><a class="<?php echo ($vo["class"]); ?>" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
</div><?php endif; ?>
<?php if(!empty($normal_tips)): ?><p class="normal_tips"><b class="fa fa-info-circle"></b> <?php echo ($normal_tips); ?></p><?php endif; ?>
    <div class="tab-content"> 
      <!-- 表单 -->
      <?php $post_url || $post_url = U('add?model='.$model['id'], $get_param); ?>
      <form id="form" action="<?php echo ($post_url); ?>" method="post" class="form-horizontal" style="overflow:hidden">
      	 <div >
            <div class="controls">
                <label class="item-label">
                       卡劵标题
                </label>
                <input type="text" name="title" class="text input-large" />
            </div>
            
            <div class="controls">
                <label class="item-label"><span class="need_flag">*</span>
                       卡券ID<span class="check-tips">通过微信卡券后台获取</span>
                </label>
                <input type="text" name="card_id" class="text input-large" />
            </div>
            
<!--             <div class="controls"> -->
<!--                 <label class="item-label"> -->
<!--                      <span class="need_flag">*</span>卡劵密钥<span class="check-tips">通过微信卡券后台获取</span> -->
<!--                 </label> -->
<!--                 <input type="text" name="appsecre" class="text input-large" /> -->
<!--             </div> -->
            
           
            <div class="controls">
                <label class="item-label">
                       商家名称
                </label>
                <input type="text" name="shop_name" class="text input-large" />
            </div>
            <div class="controls">
                <label class="item-label">
                       商家LOGO
                </label>
                <div class="controls uploadrow2" data-max="1" title="点击修改图片" rel="shop_logo">
                  <input type="file" id="upload_picture_shop_logo">
                  <input type="hidden" name="shop_logo" id="cover_id_shop_logo"/>
                  <div class="upload-img-box" id="cover_id_shop_logo_img" style="display:none">
                  		 <img src=""  width="100" height="100"/>
                    	<em class="edit_img_icon">&nbsp;</em>
                  </div>
                </div>
                
            </div>
            <div class="controls">
                <label class="item-label">
                       卡券图片
                </label>
                <div class="controls uploadrow2" data-max="1" title="点击修改图片" rel="background">
                  <input type="file" id="upload_picture_background">
                  <input type="hidden" name="background" id="cover_id_background"/>
                   <div class="upload-img-box" id="cover_id_background_img" style="display:none">
                   	    <img src=""  width="100" height="100"/>
                    	<em class="edit_img_icon">&nbsp;</em>
                  </div>
                </div>
            </div>
            <div class="controls">
                <label class="item-label">
                       卡券头部背景颜色
                </label>
                <div class="colorPicker" style="width:100px; height:100px;background:#35a2dd" onClick="simpleColorPicker(this,bgColorChange)">
                		<input name="head_bg_color" value="#35a2dd" type="hidden" />
                </div>
            </div>
             <div class="controls">
                <label class="item-label">
                       按钮颜色
                </label>
                <div class="colorPicker" style="width:100px; height:100px;background:#0dbd02" onClick="simpleColorPicker(this,buttonColorChange)">
                		<input name="button_color" value="#0dbd02" type="hidden" />
                </div>
            </div>
            
            <div class="controls">
                <label class="item-label">
                       更多按钮
                       <span class="check-tips" >格式：按钮名称|按钮跳转地址，每行一个。如：查看官网|https://weiphp.cn</span>
                </label>
                <textarea name="more_button" style="width:405px; height:100px;"></textarea>
            </div>
            
            <div class="controls">
                <label class="item-label">
                       卡券介绍
                </label>
                <textarea name="content" style="width:405px; height:200px;"></textarea>
                <?php echo hook('adminArticleEdit', array('name'=>'content','value'=>''));?> 
            </div>
        
          </div> 
            
        	
    	  
      
        <!--   <div class="fl" style="width:400px; display:none">
                <div class="wx-header"><span>卡券</span></div>
                手机端页面
                <div id="container" class="wx-container">
                      <iframe name="wxIframe" frameborder="0" scrolling="no" width="320" height="560" src="<?php echo addons_url('CardVouchers://CardVouchers/package',array('is_edit'=>1));?>"></iframe>
                	  <div class="frame_layer"></div>
                </div>
                手机端上页面结束
          </div>
       -->
      
     
      <div class="form-item form_bh" style="text-align:center">
          <button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">提交</button>
      </div>
      </div>
      </div>
    </form>
    
    </div>
  </section>
  </div>

  </div>
</div>

	<!-- /主体 -->
	</div>

	<!-- 底部 -->
	<div class="wrap bottom" style="background:#fff; border-top:#ddd;">
    <p class="copyright">本系统由<a href="https://weiphp.cn" target="_blank">WeiPHP</a>强力驱动</p>
</div>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "/index.php?s=", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

	
    <link href="/Public/static/datetimepicker/css/datetimepicker.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
   <?php if(C('COLOR_STYLE')=='blue_color') echo '
   <link href="/Public/static/datetimepicker/css/datetimepicker_blue.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
    '; ?>
  <link href="/Public/static/datetimepicker/css/dropdown.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.js"></script> 
  <script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=<?php echo SITE_VERSION;?>" charset="UTF-8"></script> 
  <script type="text/javascript">
$('#submit').click(function(){
    $('#form').submit();
});
initUploadImg();
$(function(){
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:0,
        autoclose:true
    });
    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });	
	showTab();
	$('.toggle-data').each(function(){
		var data = $(this).attr('toggle-data');
		if(data=='') return true;		
		
	     if($(this).is(":selected") || $(this).is(":checked")){
			 change_event(this)
		 }
	});
	
	$('select').change(function(){
		$('.toggle-data').each(function(){
			var data = $(this).attr('toggle-data');
			if(data=='') return true;		
			
			 if($(this).is(":selected") || $(this).is(":checked")){
				 change_event(this)
			 }
		});
	});
	//编辑页面预览
	$('input[name="title"]').keyup(function(){
		var val = $(this).val();
		$(window.frames["wxIframe"].document).find("#title").text(val);
	})
	$('input[name="shop_name"]').keyup(function(){
		var val = $(this).val();
		$(window.frames["wxIframe"].document).find(".name").text(val);
	})
	$('input[name="use_start_time"]').on('changeDate', function(ev){
		$(window.frames["wxIframe"].document).find(".use_start_time").text($(this).val());
	});
	$('input[name="over_time"]').on('changeDate', function(ev){
		$(window.frames["wxIframe"].document).find(".over_time").text($(this).val());
	});
	var domUtils = UE.dom.domUtils;
	imageEditor.addListener('ready',function(){
  		domUtils.on(imageEditor.body,"keyup",function(){
			$(window.frames["wxIframe"].document).find("#content").html(UE.getEditor('editor_id_content').getContentTxt());	
        })
  	});
});
function buttonColorChange(color){
	//$(window.frames["wxIframe"].document).find(".start_btn").css('background-color',color);
}
function bgColorChange(color){
	//$(window.frames["wxIframe"].document).find(".head_hd").css('background-color',color);
	//$(window.frames["wxIframe"].document).find(".head_pic").hide();	
	$('input[name="background"]').val("");
}
</script> 
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div style='display:none'><?php echo ($tongji_code); ?></div>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>