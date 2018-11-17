<?php
/**
 * WeixinArticle数据模型
 */
class WeixinArticleTable {
	// 数据表模型配置
	public $config = [
			'name' => 'weixin_article',
			'title' => '微信文章管理',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 10,
			'addon' => ''
	];
	
	// 列表定义
	public $list_grid = [
			'id' => [
					'title' => 'ID主键',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'id',
					'function' => '',
					'href' => [ ]
			],
			'article_title' => [
					'title' => '标题',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'article_title',
					'function' => '',
					'href' => [ ]
			],
			'type' => [
					'title' => '文章类别',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'type',
					'function' => '',
					'href' => [ ]
			],
			'create_user' => [
					'title' => '创建人',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'create_user',
					'function' => '',
					'href' => [ ]
			],
			'create_time' => [
					'title' => '创建时间',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'create_time',
					'function' => '',
					'href' => [ ]
			],
			'urls' => [
					'title' => '标题',
					'come_from' => 1,
					'width' => '',
					'is_sort' => 0,
					'href' => [
							'0' => [
									'title' => '编辑',
									'url' => '[EDIT]'
							],
							'1' => [
									'title' => '删除',
									'url' => '[DELETE]'
							],
							'2' => [
									'title' => '预览',
									'url' => 'preview?id=[id]'
							]
					],
					'name' => 'urls',
					'function' => ''
			]
	];
	
	// 字段定义
	public $fields = [
			'article_title' => [
					'title' => '标题',
					'type' => 'string',
					'field' => 'varchar(255) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '文章类别',
					'type' => 'dynamic_select',
					'field' => 'varchar(100) NULL',
					'extra' => 'table=weixin_category&value_field=id&title_field=category_name',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'article_content' => [
					'title' => '内容',
					'type' => 'editor',
					'field' => 'text NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'create_user' => [
					'title' => '创建人',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 0,
					'is_must' => 0,
					'auto_type' => 'function',
					'auto_rule' => 'get_mid',
					'auto_time' => 3
			],
			'create_time' => [
					'title' => '创建时间',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'modify_user' => [
					'title' => '更新人',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'modify_time' => [
					'title' => '更新时间',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'is_valid' => [
					'title' => '标记',
					'field' => 'varchar(1) NULL',
					'type' => 'string',
					'value' => 'T',
					'placeholder' => '请输入内容'
			]
	];
}	