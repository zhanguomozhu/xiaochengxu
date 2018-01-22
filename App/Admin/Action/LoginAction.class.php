<?php


class LoginAction extends Action {

	/**
	 * 登录视图
	 * @return [type] [description]
	 */
    public function index(){
    	$this->display();
	}


	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login(){
		if(!IS_POST) halt('页面不存在');
		//验证验证码
		if(md5(strtolower(I('code'))) != session('verify')){
			$this->error('验证码错误');
		}
		//验证用户
		$username = I('post.username');
		$pwd      = I('password','','md5');
		$user = M('user')->where(array('username'=>$username))->find();
		if(!$user || $user['password'] != $pwd){
			$this->error('账户或者密码错误');
		}
		//是否锁定
		if(!$user['status']) $this->error('用户被锁定');

		//跟新登录时间和ip
		$data = array(
			'id'		=> $user['id'],
			'logintime' => time(),
			'loginip'   => get_client_ip(),
		);
		//插入数据库
		if(M('user')->save($data)){
			//写入session
			session(C('USER_AUTH_KEY'),$user['id']);
			session('username',$user['username']);
			session('logintime',date('Y-m-d H:i:s',$data['logintime']));
			session('loginip',$data['loginip']);

			//判断是否是超级管理员
			if($user['username'] == C('RBAC_SUPERADMIN')){
				session(C('ADMIN_AUTH_KEY'),true);
			}

			//引入rbac类
			import('ORG.Util.RBAC');
			RBAC::saveAccessList();
			//跳转首页
			$this->redirect('Admin/Index/index');
		}else{
			//跳转登录
			$this->redirect('Admin/Login/index');
		}
		


		
	}



	/**
	 * 验证码
	 * @return [type] [description]
	 */
	public function verify(){
		//引入图片类
		import('ORG.Util.Image');
		Image::buildImageVerify1(1,0,'png',100,30,'verify',16);
	}
}