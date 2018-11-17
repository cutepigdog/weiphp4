<?php
        	
namespace Addons\WeixinArticle\Model;
use Home\Model\WeixinModel;
        	
/**
 * WeixinArticle的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'WeixinArticle' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	