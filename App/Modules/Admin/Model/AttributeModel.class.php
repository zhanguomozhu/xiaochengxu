<?php
/**
* 属性模型
*/
class AttributeModel extends RelationModel
{
	//validate验证
	protected $_validate = array(
	    array('attr_name','require','属性名称必须',1,'regex',3),
	    array('attr_name','1,30','属性名称最长不超过30个字符',1,'length',3),
	    array('attr_type','require','属性类别必须',1,'regex',3),
	    array('attr_type',array('唯一','可选'),'属性类别范围不正确！',0,'in',3),
	    array('attr_option_values','1,300','属性可选值最长不超过300个字符',2,'length',1),
	    array('type_id','require','所属类型id不能为空',1,'regex',3),
	    array('type_id','number','所属类型id必须是整数',1,'regex',3),
	);


}
