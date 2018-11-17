<?php

namespace Addons\WeiSite\Controller;

use Addons\WeiSite\Controller\BaseController;

class CategoryController extends BaseController {
	var $model;
	function _initialize() {
		$this->model = $this->getModel ( 'weisite_category' );
		parent::_initialize ();
	}
	// 通用插件的列表模型
	public function lists() {
		// 使用提示
		$normal_tips = '外链为空时默认跳转到该分类的文章列表页面';
		$this->assign ( 'normal_tips', $normal_tips );
		
		$map ['token'] = get_token ();
// 		session ( 'common_condition', $map );
// 		$list_data = $this->_get_model_list ( $this->model );
// 		$list_data = $this->_list_grid ( $this->model );
// 		$fields = $list_data ['fields'];
// 		$map = $this->_search_map ( $this->model, $fields );
		$key = $this->model ['search_key'] ? $this->model ['search_key'] : 'title';
		$keyArr = explode ( ':', $key );
		$key = $keyArr [0];
		$placeholder = isset ( $keyArr [1] ) ? $keyArr [1] : '请输入关键字';
		$this->assign ( 'placeholder', $placeholder );
		$this->assign ( 'search_key', $key );
		$this->assign('search_url',U('lists'));
		if (isset ( $_REQUEST [$key] ) && ! isset ( $map [$key] )) {
			$map [$key] = array (
					'like',
					'%' . htmlspecialchars ( $_REQUEST [$key] ) . '%'
			);
			unset ( $_REQUEST [$key] );
		}
		session ( 'common_condition', $map );
		
		$list_data = $this->_get_model_list ( $this->model );
//  		$list_data['list_data']=M('weisite_category')->where($map)->order('id desc')->select();
		$list_data ['list_data'] = $this->get_data ( $list_data ['list_data'] );

		$fields = $list_data ['fields'];
		
		foreach ($list_data['list_data'] as $v){
		    $fcate[$v['id']]=$v['title'];
		}
		foreach ($list_data['list_data'] as $key =>&$data){

			if ($data['pid']){
			    $data['pid']=$fcate[$data['pid']];
			}else{
			    $data['pid']='';
			}
		}
		unset($list_data ['_page']);
		//dump($list_data);
		$this->assign ( $list_data );
		
		$this->display ();
	}
	function get_data($list) {
		
		// 取一级菜单
		foreach ( $list as $k => $vo ) {
			// dump($vo);
			if ($vo ['pid'] != 0)
				continue;
			
			$one_arr [$vo ['id']] = $vo;
			unset ( $list [$k] );
		}
		//dump($one_arr);
		foreach ( $one_arr as $p ) {
			$data [] = $p;
			
			$two_arr = array ();
			foreach ( $list as $key => $l ) {
				if ($l ['pid'] != $p ['id'])
					continue;
				
				$l ['title'] = '├──' . $l ['title'];
				$two_arr [] = $l;
				unset ( $list [$key] );
			}
			//dump($two_arr);
			$data = array_merge ( $data, $two_arr );
		}
		// dump($data);exit;
		return $data;
	}
	public function edit() {
		is_array ( $model ) || $model = $this->model;
		$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
		$id = I ( 'id' );
		
		if (IS_POST) {
		    if ($_POST['pid']==$id){
		        $_POST['pid']=0;
		    }
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			$res = false;
			$Model->create () && $res=$Model->save ();
			if ($res !== false) {
				$this->success ( '保存' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'], $this->get_param ) );
			} else {
				$this->error( '400478:'. $Model->getError () );
			}
		} else {
			// 获取一级菜单
			$map ['token'] = get_token ();
			$map ['pid'] = 0;
			$map ['id'] = array (
					'not in',
					$id 
			);
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			
			$fields = get_model_attribute ( $model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			// 获取数据
			$data = M ( get_table_name ( $model ['id'] ) )->find ( $id );
			$data || $this->error( '400479:数据不存在！' );
			
			$token = get_token ();
			if (isset ( $data ['token'] ) && $token != $data ['token'] && defined ( 'ADDON_PUBLIC_PATH' )) {
				$this->error( '400480:非法访问！' );
			}
			
			$this->assign ( 'fields', $fields );
			$this->assign ( 'data', $data );
			$tmpImg=ONETHINK_ADDON_PATH.'WeiSite/View/TemplateSubcate/'.$data['template'].'/icon.png';
			if (file_exists($tmpImg)){
			    $this->assign('tmp_img',$tmpImg);
			}
			//dump($fields);
			$this->meta_title = '编辑' . $model ['title'];
			
			$this->display ();
		}
	}
	public function add() {
		$model = $this->model;
		$Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
		
		if (IS_POST) {
			// 获取模型的字段信息
			$Model = $this->checkAttr ( $Model, $model ['id'] );
			if ($Model->create () && $id = $Model->add ()) {
				$this->success ( '添加' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'], $this->get_param ) );
			} else {
				$this->error( '400481:'. $Model->getError () );
			}
		} else {
			// 要先填写appid
			$map ['token'] = get_token ();
			
			// 获取一级菜单
			$map ['pid'] = 0;
			$list = $Model->where ( $map )->select ();
			foreach ( $list as $v ) {
				$extra .= $v ['id'] . ':' . $v ['title'] . "\r\n";
			}
			
			$fields = get_model_attribute ( $model ['id'] );
			if (! empty ( $extra )) {
				foreach ( $fields as &$vo ) {
					if ($vo ['name'] == 'pid') {
						$vo ['extra'] .= "\r\n" . $extra;
					}
				}
			}
			
			$this->assign ( 'fields', $fields );
			$this->meta_title = '新增' . $model ['title'];
			
			$this->display ();
		}
	}
	
	// 通用插件的删除模型
	public function del() {
		parent::common_del ( $this->model );
	}
	// 首页
	function index() {
		$this->display ();
	}
	// 分类列表
	function category() {
		$this->display ();
	}
	// 相册模式
	function picList() {
		$this->display ();
	}
	// 详情
	function detail() {
		$this->display ();
	}
	
}
