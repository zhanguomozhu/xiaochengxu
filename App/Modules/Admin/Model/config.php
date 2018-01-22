<?php
return array(
	//RBAC配置
	//指定超级管理员
	'RBAC_SUPERADMIN'     => 'admin',
	//超级管理员识别码
	'ADMIN_AUTH_KEY'	  => 'superadmin',
	//是否开启权限认证
	'USER_AUTH_ON'        => true,
	//验证类型（1：登录验证，2：时时验证）
	'USER_AUTH_TYPE'      => 1,
	//用户识别号
	'USER_AUTH_KEY'       => 'uid',
	//无需验证的模块
	'NOT_AUTH_MODULE'     => 'Index',
	//无需验证的方法
	'NOT_AUTH_ACTION'     => 'editStatus',
	//角色表名称
	'RBAC_ROLE_TABLE'     => 'tp_role',
	//角色与用户中间表
	'RBAC_USER_TABLE'     => 'tp_role_user',
	//权限表名称
	'RBAC_ACCESS_TABLE'   => 'tp_access',
	//节点表
	'RBAC_NODE_TABLE'     => 'tp_node',






	//指定错误页面模板路径
	//'TMPL_EXCEPTION_FILE' => 'Public/'.GROUP_NAME.'/error.html',
	// 默认I方法参数过滤方法
	'DEFAULT_FILTER'      => 'trim,htmlspecialchars', 

	// 模板配置
	'TMPL_PARSE_STRING'   =>array(
	         '__PUBLIC__' => __ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Public',
	),


	//引入标签库配置
	'APP_AUTOLOAD_PATH' => '@.TagLib',//引入本模块标签库,@标识本模块
	'TAGLIB_BUILD_IN'	=> 'Cx,My',//绑定标签库


	//菜单配置
	'NOT_MODEL' => array(),//菜单不显示的模块
	'NOT_CONTROLLER' => array('Rbac','Attribute'),//菜单不显示的控制器
	'NOT_ACTION' => array('edit','del','access'),//菜单不显示的方法



	//图片压缩配置
	'IMG_SIZE' => array(array('500','500'),array('375','375'),array('275','275')),
);