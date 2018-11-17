<?php

namespace Addons\WeixinArticle;
use Common\Controller\Addon;

/**
 * 微信文章管理插件
 * @author weishaobo
 */

    class WeixinArticleAddon extends Addon{

        public $info = array(
            'name'=>'WeixinArticle',
            'title'=>'微信文章管理',
            'description'=>'微信文章管理',
            'status'=>1,
            'author'=>'weishaobo',
            'version'=>'0.1',
            'has_adminlist'=>1
        );

	public function install() {
		$install_sql = './Addons/WeixinArticle/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/WeixinArticle/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }