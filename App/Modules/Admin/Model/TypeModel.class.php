<?php
/**
* 类型模型
*/
class TypeModel extends RelationModel
{

	//定义关联关系
	protected $_link = array(
		//类型与属性表一对多关联
		'attribute' => array(
			'mapping_type' 	=>HAS_MANY,//一对多
			'class_name'	=>'attribute',//关联表名
            'foreign_key'	=>'type_id',//主表关联表主键
            'mapping_name'	=>'attribute',//下标名
		),
	);

	//validate验证
	protected $_validate = array(
	    array('type_name','require','类别名称必须',0,''),
	    array('type_name','','类别名称不能重复',0,'unique',1)
	);
}
