<?php

class CommonAction extends Action{

	/**
	 * 初始检测
	 * @return [type] [description]
	 */
	public function _initialize(){
		//是否登录
		if(!isset($_SESSION[C('USER_AUTH_KEY')])){
			$this->redirect('Admin/Login/index');
		}

		//不需要验证的模块和方法
		$notAuth = in_array(MODULE_NAME,explode(',',C('NOT_AUTH_MODULE'))) || in_array(ACTION_NAME,explode(',',C('NOT_AUTH_ACTION')));

		if(C('USER_AUTH_ON') && !$notAuth){
			import('ORG.Util.RBAC');
			RBAC::AccessDecision(GROUP_NAME) || $this->error('没有权限');

		}



		//网站配置信息
		$this->getConf();
	}


	/**
	 * 获取配置信息
	 * @return [type] [description]
	 */
	public function getConf(){
		$conf = M('conf')->select();
		$data = array();
		foreach ($conf as $key => $value) {
			$data[$value['enname']] = $value['value'];
		}
		$this->conf = $data;
	}


}