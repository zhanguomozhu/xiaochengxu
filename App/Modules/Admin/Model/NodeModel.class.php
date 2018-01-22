<?php
/**
* 节点模型
*/
class NodeModel extends RelationModel
{
	//定义关联关系
	protected $_link = array(
		//权限一对多关系模型
		'access' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			//'class_name'	=>'role_user',//关联表名
            'foreign_key'	=>'node_id',//主表关联表主键
            'mapping_name'	=>'access',//返回结果下标名
		),
	);
}