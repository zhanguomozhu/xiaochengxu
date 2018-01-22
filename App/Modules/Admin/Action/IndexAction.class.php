<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {


	/**
	 * 首页视图
	 * @return [type] [description]
	 */
    public function index(){
		$this->display();
	}


	/**
	 * 退出
	 * @return [type] [description]
	 */
	public function logout(){
		session_unset();
		session_destroy();
		$this->redirect('Admin/Login/index');
	}



	//空操作
	public function _empty(){
        halt('页面不存在');
    }

}