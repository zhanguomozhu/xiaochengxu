<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {


	/**
	 * 首页视图
	 * @return [type] [description]
	 */
    public function index(){
    	say();
    	p($_GET);
		$this->display();
	}



}