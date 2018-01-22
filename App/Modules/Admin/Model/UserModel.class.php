<?php
/**
* 用户模型
*/
class UserModel extends RelationModel
{
	//定义关联关系
	protected $_link = array(
		//用户与角色关系模型
		'role' => array(
			'mapping_type' 		=> MANY_TO_MANY,//多对多
			'class_name'		=>'role',//关联表名
			//'mapping_name'		=>'roles',//下标名
			'foreign_key'		=>'user_id',//主表关联表主键
			'relation_foreign_key'=>'role_id',//关联表的外键名称
			'relation_table'	=>'role_user',//中间表
			'mapping_fields'	=>'id,name',//关联表显示字段
		),
		// //用户与角色表一对多关系模型
		'role_user' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			//'class_name'	=>'role_user',//关联表名
            'foreign_key'	=>'user_id',//主表关联表主键
            'mapping_name'	=>'role_user',//下标名
		),
	);
}