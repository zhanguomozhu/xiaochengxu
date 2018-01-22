<?php
/**
* 角色关联模型
*/
class RoleModel extends RelationModel
{
	//定义关联关系
	protected $_link = array(
		//用户与角色表一对多关系模型
		'role_user' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			//'class_name'	=>'role_user',//关联表名
            'foreign_key'	=>'role_id',//主表关联表主键
            'mapping_name'	=>'role_user',//下标名
		),
		//权限一对多关系模型
		'access' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			//'class_name'	=>'role_user',//关联表名
            'foreign_key'	=>'role_id',//主表关联表主键
            'mapping_name'	=>'access',//返回结果下标名
		),
	);
}