<?php
/**
 * WeixinCategory数据模型
 */
class WeixinCategoryTable {
	// 数据表模型配置
	public $config = [
			'name' => 'weixin_category',
			'title' => '微信栏目',
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
			'category_name' => [
					'title' => '栏目名称',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'category_name',
					'function' => '',
					'href' => [ ]
			],
			'urls' => [
					'title' => '栏目名称',
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
									'url' => 'preview?id=[\'id\']'
							]
					],
					'name' => 'urls',
					'function' => ''
			]
	];
	
	// 字段定义
	public $fields = [
			'category_name' => [
					'title' => '栏目名称',
					'type' => 'string',
					'field' => 'varchar(255) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'create_time' => [
					'title' => '创建时间',
					'type' => 'datetime',
					'field' => 'int(10) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'time',
					'auto_time' => 1,
					'placeholder' => '请输入内容'
			],
			'create_user' => [
					'title' => '创建人',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'get_mid',
					'auto_time' => 1,
					'placeholder' => '请输入内容'
			],
			'modify_time' => [
					'title' => '更新时间',
					'type' => 'datetime',
					'field' => 'int(10) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'time',
					'auto_time' => 2,
					'placeholder' => '请输入内容'
			],
			'modify_user' => [
					'title' => '更新人',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 0,
					'is_must' => 0,
					'auto_type' => 'function',
					'auto_rule' => 'get_mid',
					'auto_time' => 2
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