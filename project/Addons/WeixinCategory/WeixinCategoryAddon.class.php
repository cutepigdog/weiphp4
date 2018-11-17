<?php

namespace Addons\WeixinCategory;
use Common\Controller\Addon;

/**
 * 微信文章栏目管理插件
 * @author weishaobo
 */

    class WeixinCategoryAddon extends Addon{

        public $info = array(
            'name'=>'WeixinCategory',
            'title'=>'微信文章栏目管理',
            'description'=>'微信文章栏目管理',
            'status'=>1,
            'author'=>'weishaobo',
            'version'=>'0.1',
            'has_adminlist'=>1
        );

	public function install() {
		$install_sql = './Addons/WeixinCategory/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/WeixinCategory/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }