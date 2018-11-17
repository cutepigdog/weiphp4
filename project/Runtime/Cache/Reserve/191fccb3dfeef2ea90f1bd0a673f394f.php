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
    
<style type="text/css">
.money {
	width: 50px;
}
.specTable .param {
	display: none;
}
.specTable p {
	display: block;
	line-height: 50px;
}
.text-center {
	text-align: center;
}
.check-tips {
	color: #aaa;
	margin-left:2px;
}
.cf{
	margin-left:20px;
}
</style>
<!-- 标签页导航 -->
<div class="span9 page_message">
  <section id="contents">
  <ul class="tab-nav nav">
    <li class=""><a href="<?php echo U('lists');?>">预约列表</a></li>
    <li class="current"><a href="javascript:;">编辑微预约<b class="arrow fa fa-sort"></b></a></li>
  </ul>
  <div class="tab-content">
  <!-- 微预约 -->
  <form id="form" action="<?php echo U('edit?model='.$model['id']);?>" method="post" class="form-horizontal">
      <div class="form-item cf">
        <label class="item-label"><span class="need_flag">*</span>标题</label>
        <div class="controls">
          <input type="text" class="text input-large" name="title" value="<?php echo ($data["title"]); ?>">
        </div>
      </div>  
        <div class="form-item cf toggle-start_time">
          <label class="item-label"> 报名时间 <span class="check-tips">为空时表示不限制 </span></label>
          <div class="controls">
            <input type="datetime" placeholder="请选择开始时间" value="<?php echo (time_format($data["start_time"])); ?>" class="text time" name="start_time">
            -
            <input type="datetime" placeholder="请选择结束时间" value="<?php echo (time_format($data["end_time"])); ?>" class="text time" name="end_time">
          </div>
        </div>  
        <div class="form-item cf">
          <label class="item-label"> <span class="need_flag">*</span> 在线支付 <span class="check-tips"> （开启的话需要先<a href="<?php echo U('Home/Apps/payment_set');?>" target="_blank">配置微信支付</a>） </span></label>
          <div class="controls">
            <div class="check-item">
              <input type="radio" name="pay_online" id="pay_online_0" value="0" class="regular-radio" <?php if(intval($data[pay_online])==0): ?>checked="checked"<?php endif; ?> >
              <label for="pay_online_0"></label>
              关闭 </div>
            <div class="check-item">
              <input type="radio" name="pay_online" id="pay_online_1" value="1" class="regular-radio" <?php if($data[pay_online]==1): ?>checked="checked"<?php endif; ?> >
              <label for="pay_online_1"></label>
              开启 </div>
          </div>
        </div>            
      <div class="form-item cf">
        <label class="item-label"><span class="need_flag">*</span>活动宣传图片<span class="check-tips">图片高度控制在200px-400px之间</span></label>
        <div class="controls uploadrow2" data-max="1" title="点击修改图片" rel="cover">
          <input type="file" id="upload_picture_cover">
          <input type="hidden" name="cover" id="cover_id_cover" value="<?php echo ($data["cover"]); ?>"/>
          <div class="upload-img-box" rel="img">
            <?php if(!empty($data[cover])): ?><div class="upload-pre-item2"><img width="100" height="100" src="<?php echo (get_cover_url($data["cover"])); ?>"/></div>
              <em class="edit_img_icon">&nbsp;</em><?php endif; ?>
          </div>
        </div>
      </div>  
      <div class="form-item cf">
        <label class="item-label"><span class="need_flag">*</span>描述</label>
        <div class="controls">
          <label class="textarea input-large">
            <textarea class="text input-large" name="intro" ><?php echo ($data["intro"]); ?></textarea>
          </label>
        </div>
      </div>  
      <div class="form-item cf toggle-prize_type" style="display:none">
        <label class="item-label"><span class="need_flag">*</span>是否允许编辑</label>
        <div class="controls">
          <select name="can_edit">
            <?php $_result=parse_field_attr($fields['type']['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" 
              
              <?php if(($data['type']) == $key): ?>selected="selected"<?php endif; ?>
              ><?php echo (clean_hide_attr($vo)); ?> 
              
              </option><?php endforeach; endif; else: echo "" ;endif; ?>
          </select>
        </div>
      </div>  
      <div class="form-item cf">
        <label class="item-label"><span class="need_flag">*</span>预约项管理</label>
        <div style="margin:15px 0;" class="specTable data-table">
          <table cellspacing="1" cellpadding="0">
            <thead>
              <tr>
                <th align="center">名称</th>
                <th align="center">报名费用(元)</th>
                <th align="center">最大预约数</th>
                <th align="center">初始化预约数</th>
                <th align="center">当前预约数</th>
                <th align="center">操作</th>
              </tr>
            </thead>
            <tbody id="list_data_tbody2">
              <?php if(is_array($option_list)): $i = 0; $__LIST__ = $option_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cd): $mod = ($i % 2 );++$i;?><tr class="list_tr2" rel="<?php echo ($key); ?>">
                    <td align="center"><input type="text" value="<?php echo ($cd["name"]); ?>" class="form-control" name="name[<?php echo ($key); ?>]" style="width:150px"></td>
                    <td align="center"><input type="text" value="<?php echo ($cd["money"]); ?>" class="form-control" name="money[<?php echo ($key); ?>]" style="width:120px" placeholder="为空时表示免费"></td>
                    <td align="center"><input type="number" value="<?php echo ($cd["max_limit"]); ?>" class="form-control" name="max_limit[<?php echo ($key); ?>]" style="width:130px" placeholder="为空时表示不限制"></td>
                    <td align="center"><input type="number" value="<?php echo ($cd["init_count"]); ?>" class="form-control" name="init_count[<?php echo ($key); ?>]" style="width:100px"></td>
                    <td align="center"><?php echo ((isset($cd["join_count"]) && ($cd["join_count"] !== ""))?($cd["join_count"]):0); ?>
                    <input type="hidden" value="<?php echo ($cd["id"]); ?>" name="option_id[<?php echo ($key); ?>]"></td>
                    <td><a href="javascript:void(0);" onclick="remove_tr(this)">删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              <tr class="more_tr">
                <td colspan="6"><a href="javascript:add_tr2()">+增加预约项</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
<div class="form-item cf">
        <label class="item-label"><span class="need_flag">*</span>字段管理<span class="check-tips"> （用户报名时需要填写的内容）</span></label>
        <div style="margin:15px 0;" class="specTable data-table">
          <table cellspacing="1" cellpadding="0">
            <thead>
              <tr>
                <th align="center">字段名称</th>
                <th align="center">字段类型</th>
                <th align="center">选项数据</th>
                <th align="center">是否必填</th>
                <th align="center">操作</th>
              </tr>
            </thead>
            <tbody id="list_data_tbody">
              <?php if(is_array($attr_list)): $i = 0; $__LIST__ = $attr_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cd): $mod = ($i % 2 );++$i;?><tr class="list_tr" rel="<?php echo ($cd["sort"]); ?>">
                <td align="center"><input type="text" value="<?php echo ($cd["title"]); ?>" class="form-control" name="attr_title[<?php echo ($cd["sort"]); ?>]" style="width:150px"></td>
                <td align="center"><select name="type[<?php echo ($cd["sort"]); ?>]" class="select_type" style="width:150px">
                    <option value="string" <?php if(($cd['type']) == "string"): ?>selected<?php endif; ?> >单行输入 </option>
                    <option value="textarea" <?php if(($cd['type']) == "textarea"): ?>selected<?php endif; ?> >多行输入 </option>
                    <option value="radio" <?php if(($cd['type']) == "radio"): ?>selected<?php endif; ?> >单选 </option>
                    <option value="checkbox" <?php if(($cd['type']) == "checkbox"): ?>selected<?php endif; ?> >多选 </option>
                    <option value="select" <?php if(($cd['type']) == "select"): ?>selected<?php endif; ?> >下拉选择 </option>
                    <option value="datetime" <?php if(($cd['type']) == "datetime"): ?>selected<?php endif; ?> >时间 </option>
                    <option value="picture" <?php if(($cd['type']) == "picture"): ?>selected<?php endif; ?> >上传图片 </option>
                  </select></td>
                <td align="center"><input type="text" value="<?php echo ($cd["extra"]); ?>" class="form-control" name="extra[<?php echo ($cd["sort"]); ?>]" placeholder=""></td>
                <td><input type="checkbox" name="is_must[<?php echo ($cd["sort"]); ?>]" value="1" 
                  <?php if($cd[is_must]==1): ?>checked="checked"<?php endif; ?>
                  > 必填</td>
                <td>
                <input type="hidden" value="<?php echo ($cd["id"]); ?>" name="attr_id[<?php echo ($cd["sort"]); ?>]">
                <input type="hidden" value="<?php echo ($cd["value"]); ?>" name="value[<?php echo ($cd["sort"]); ?>]" class="value">
                <input type="hidden" value="<?php echo ($cd["remark"]); ?>" name="remark[<?php echo ($cd["sort"]); ?>]" class="remark">
                <input type="hidden" value="<?php echo ($cd["validate_rule"]); ?>" name="validate_rule[<?php echo ($cd["sort"]); ?>]" class="validate_rule">
                <input type="hidden" value="<?php echo ($cd["error_info"]); ?>" name="error_info[<?php echo ($cd["sort"]); ?>]" class="error_info"> 
                <a href="javascript:void(0);" onclick="move_up(this)" class="move_up">↑</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="move_down(this)" class="move_down">↓</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="show_more(this)">高级设置</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_tr(this)">删除</a></td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>
              <tr class="more_tr">
                <td colspan="5"><a href="javascript:add_tr()">+增加新字段</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>      
      <div class="controls" style="display:none">
        <label class="item-label"> 详细介绍<span class="check-tips">为空默认只显示描述</span> </label>
        <textarea name="content" style="width:405px; height:100px;"><?php echo ($data["content"]); ?></textarea>
        <?php echo hook('adminArticleEdit', array('name'=>'content','value'=>$data[content]));?> </div>
    </div>
    <div class="form-item form_bh">
      <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
      <button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
    </div>
  </form>
  <table style="display:none">
      <tr id="default_tr1">
        <td align="center"><input type="text" value="" class="form-control" name="attr_title[sort_id]" style="width:150px"></td>
        <td align="center"><select name="type[sort_id]" class="select_type" style="width:150px">
            <option value="string" selected >单行输入 </option>
            <option value="textarea">多行输入 </option>
            <option value="radio">单选 </option>
            <option value="checkbox">多选 </option>
            <option value="select">下拉选择 </option>
            <option value="datetime">时间 </option>
            <option value="picture">上传图片 </option>
          </select></td>
        <td align="center"><input type="text" value="" class="form-control" name="extra[sort_id]"></td>
        <td><input type="checkbox" name="is_must[sort_id]" value="1"> 必填</td>
        <td>
        <input type="hidden" value="" name="value[sort_id]" class="value">
        <input type="hidden" value="" name="remark[sort_id]" class="remark">
        <input type="hidden" value="" name="validate_rule[sort_id]" class="validate_rule">
        <input type="hidden" value="" name="error_info[sort_id]" class="error_info">        
        <a href="javascript:void(0);" onclick="move_up(this)" class="move_up">↑</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="move_down(this)" class="move_down">向下</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="show_more(this)">高级设置</a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="remove_tr(this)">删除</a></td>
      </tr>
      <tr id="default_tr2">
        <td align="center"><input type="text" value="" class="form-control" name="name[sort_id]" style="width:150px"></td>
        <td align="center"><input type="number" value="" class="form-control" name="money[sort_id]" style="width:120px" placeholder="为空时表示免费"></td>
        <td align="center"><input type="number" value="" class="form-control" name="max_limit[sort_id]" style="width:130px" placeholder="为空时表示不限制"></td>
        <td align="center"><input type="number" value="" class="form-control" name="init_count[sort_id]" style="width:100px"></td>
        <td align="center">0</td>
        <td><a href="javascript:void(0);" onclick="remove_tr(this)">删除</a></td>
      </tr>      
  </table>
  
  <div id="default_more_html" style="display:none">
      <div class="form-item cf">
        <label class="item-label">默认值<span class="check-tips"> （字段的默认值） </span></label>
        <div class="controls">
          <input type="text" value="[value]" name="value" id="open_value" class="text input-large">
        </div>
      </div>
      <div class="form-item cf">
        <label class="item-label">字段备注<span class="check-tips"> （用于微预约中的提示） </span></label>
        <div class="controls">
          <input type="text" value="[remark]" name="remark" id="open_remark" class="text input-large">
        </div>
      </div>
      <div class="form-item cf">
        <label class="item-label">正则验证<span class="check-tips"> （为空表示不作验证） </span></label>
        <div class="controls">
          <input type="text" value="[validate_rule]" name="validate_rule" id="open_validate_rule" class="text input-large">
        </div>
      </div>
      <div class="form-item cf">
        <label class="item-label">出错提示<span class="check-tips"> （验证不通过时的提示语） </span></label>
        <div class="controls">
          <input type="text" value="[error_info]" name="error_info" id="open_error_info" class="text input-large">
        </div>
      </div>
      <div class="form-item form_bh">
      <div class="btn_bar"><a href="javascript:;" class="btn confirm_btn">确定</a>&nbsp;&nbsp;<a href="javascript:;" class="border-btn cancel_btn">取消</a></div>
    </div>
  </div>
</div>
</section>
</div>
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
  <script type="text/javascript" src="/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script> 
  <script type="text/javascript" src="/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=<?php echo SITE_VERSION;?>" charset="UTF-8"></script> 
  <script type="text/javascript">
$('#submit').click(function(){
    $('#form').submit();
});

$(function(){
	initUploadImg();
	
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:0,
        autoclose:true
    });
    showTab();
	hide_move();
	
	$('.select_type').each(function(){ select_type(this); });
	$('.select_type').change(function(){ select_type(this); });
});
//增加字段
var tr_sort_id = 0;
function add_tr(){
	var list_count = 0;
	$('.list_tr').each(function() {
		list_count += 1;
		var sort_id = $(this).attr('rel');
		if(sort_id>tr_sort_id) tr_sort_id = sort_id;
    });	
	
	tr_sort_id += 1;
	
	re = new RegExp("sort_id", "g");
	str  = $('#default_tr1').html().replace(re, tr_sort_id);
	//console.log(str);
	var html = '<tr class="list_tr" rel="'+tr_sort_id+'">'+ str +'</tr>';
	if(list_count==0)
	  $('#list_data_tbody tr').before(html);	
	else
	  $('.list_tr:last').after(html);
	  
	hide_move();
	$('.select_type').each(function(){ select_type(this); });
	$('.select_type').change(function(){ select_type(this); });
}
//增加预约
function add_tr2(){
	var list_count = 0;
	$('.list_tr2').each(function() {
		list_count += 1;
    });	
	
	list_count += 1;
	
	re = new RegExp("sort_id", "g");
	str  = $('#default_tr2').html().replace(re, list_count);
	//console.log(str);
	var html = '<tr class="list_tr2" rel="'+list_count+'">'+ str +'</tr>';
	if(list_count==1)
	  $('#list_data_tbody2 tr').before(html);	
	else
	  $('.list_tr2:last').after(html);	
}
//删除字段
function remove_tr(_this){	
	$(_this).parent().parent().remove();
	hide_move();
}
//排序--向上
function move_up(obj) { 
  var objParentTR = $(obj).parent().parent(); 
  var prevTR = objParentTR.prev(); 
  if (prevTR.length > 0) { 
	prevTR.insertAfter(objParentTR); 
  }
  hide_move();
} 
//排序--向下
function move_down(obj) { 
  var objParentTR = $(obj).parent().parent(); 
  var nextTR = objParentTR.next(); 
  if (nextTR.length > 0) { 
	nextTR.insertBefore(objParentTR); 
  } 
  hide_move();
} 
//第一行只显示向下，最后一行只显示向上
function hide_move(){
	$('.move_up').each(function() {
		$(this).show();
    });
	$('.move_down').each(function() {
		$(this).show();
    });	
	$('.list_tr:first').find('.move_up').hide();
	$('.list_tr:last').find('.move_down').hide();
}
//选择字段类型
function select_type(_this){
	var type = $(_this).val();
	var obj = $(_this).parent().next().find('input');
	
	switch(type){
		case 'textarea': obj.attr('placeholder','').attr('readonly', true); break;
		case 'radio': obj.attr('placeholder','多个选项用空格分开，如：男 女').attr('readonly', false); break;
		case 'checkbox': obj.attr('placeholder','多个选项用空格分开，如：男 女').attr('readonly', false); break;
		case 'select': obj.attr('placeholder','多个选项用空格分开，如：男 女').attr('readonly', false); break;
		case 'datetime': obj.attr('placeholder','').attr('readonly', true); break;
		case 'picture': obj.attr('placeholder','').attr('readonly', true); break;
	    default: obj.attr('placeholder','').attr('readonly', true); break;
	}
}
//高级设置
function show_more(_this){	
	var obj = $(_this).parent();
	
	var value = obj.find('.value').val();
	var remark = obj.find('.remark').val();
	var validate_rule = obj.find('.validate_rule').val();
	var error_info = obj.find('.error_info').val();
	
	var html = $('#default_more_html').html().replace("[value]", value).replace("[remark]", remark).replace("[validate_rule]", validate_rule).replace("[error_info]", error_info);
	$contentHtml = $(html);
	  
	
	$.Dialog.open("高级设置",{width:500,height:500},$contentHtml);
	
	$('.cancel_btn',$contentHtml).click(function(){
		$.Dialog.close();
	})
	$('.confirm_btn',$contentHtml).click(function(){
		obj.find('.value').val( $('#open_value',$contentHtml).val() );
		obj.find('.remark').val( $('#open_remark',$contentHtml).val() );
		obj.find('.validate_rule').val( $('#open_validate_rule',$contentHtml).val() );
		obj.find('.error_info').val( $('#open_error_info',$contentHtml).val() );
		
		$.Dialog.close();
	})
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