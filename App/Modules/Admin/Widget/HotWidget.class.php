<?php

/**
* 组件助手
*/
class HotWidget extends Widget
{
	public function render($data){
		//测试
		$data['cate'] = M('cate')->field('id,name')->order('id desc')->select();
		return $this->renderFile('',$data);
	}
}