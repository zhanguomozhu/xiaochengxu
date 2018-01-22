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


		//获取用户权限
		$this->getAccess();
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


	/**
	 * 获取用户权限
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	public function getAccess(){
		//所有节点
		$nodeList = M('node')->field('id,name,title,pid')->order('sort')->select();
		$nodeList = getTree($nodeList,2);
	
		//所属角色权限
		$roleList = M('role_user')->alias('r')
					->join('tp_access a on a.role_id=r.role_id')
					->where(array('user_id'=>session('uid')))->getField('node_id',true);

		$this->nodeList = $nodeList;
		$this->roleList = $roleList;

		$this->notModel = C('NOT_MODEL');//菜单不显示的模块
		$this->notController = C('NOT_CONTROLLER');//菜单不显示的控制器
		$this->notAction = C('NOT_ACTION');//菜单不显示的方法
	}
}