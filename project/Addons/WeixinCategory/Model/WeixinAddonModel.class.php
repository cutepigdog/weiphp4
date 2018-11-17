<?php
        	
namespace Addons\WeixinCategory\Model;
use Home\Model\WeixinModel;
        	
/**
 * WeixinCategory的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'WeixinCategory' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	