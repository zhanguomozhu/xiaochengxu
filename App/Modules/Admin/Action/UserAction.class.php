<?php

/**
* 用户控制器
*/
class UserAction extends CommonAction
{

	/**
	 * 用户列表
	 * @return [type] [description]
	 */
	public function index(){
		//用户列表关联查询
		$this->users = D('User')->field('password',true)->relation('role')->select();
		$this->display();
	}


	/**
	 * 添加用户
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			//用户数据
			$user = array(
				'username' => I('username'),
				'password' => I('password','','md5'),
				'logintime'=> time(),
				'loginip'  => get_client_ip(),
			);
			//循环角色id
			foreach (I('post.role_id') as $v) {
					$user['role'][] = array(
						'id' => $v,
					);
				}
			//关联插入用户表
			if(D('User')->relation('role')->add($user)){
				$this->success('添加成功',U('Admin/User/index'));
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//角色列表
		$this->role = M('role')->select();
		$this->display();
	}


	/**
	 * 修改用户
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$id = I('post.id','','intval');
			//用户数据
			$user = array(
				'password' => I('password','','md5'),
			);
			//拼接角色信息
			foreach (I('post.role_id') as $v) {
				$user['role'][] =  array(
					'id'=>$v,
				);
			}
			//关联修改
			if(D('User')->relation('role')->where(array('id'=>$id))->save($user)){
				$this->success('更新成功',U('Admin/User/index'));
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//用户详情关联查询
		$this->user = D('User')->where(array('id'=>I('get.id','','intval')))->relation('role')->find();
		//用户列表
		$this->role = M('role')->select();
		
		$this->display();
	}



	/**
	 * 删除用户
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			
			//关联删除用户
			if(D('User')->relation('role')->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/User/index'));
			}else{
				$this->error('删除失败');
			}
			
		}else{
			$this->error('请求方式错误');
		}
	}


	/**
	 * 修改用户状态
	 * @return [type] [description]
	 */
	public function editStatus(){
		if(IS_GET){
			if(M('user')->save(I('get.'))){
				$this->redirect(GROUP_NAME.'/User/index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


	/**
	 * 检测密码
	 * @return [type] [description]
	 */
	public function checkPs(){
		if(IS_AJAX){
			$ps = md5(I('post.ps'));
			$password = M('user')->where(array('id'=>I('post.id','','intval')))->getField('password');
			if($ps == $password){
				echo ajaxShow(1000,'密码正确');
			}else{
				echo ajaxShow(2000,'密码错误');
			}
		}else{
			echo ajaxShow(2000,'请求错误');
		}
	}

}