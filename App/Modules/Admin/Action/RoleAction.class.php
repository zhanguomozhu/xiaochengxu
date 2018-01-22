<?php

/**
* 角色控制器
*/
class RoleAction extends CommonAction
{

	/**
	 * 角色列表
	 * @return [type] [description]
	 */
	public function index(){
		
		$this->roles = M('role')->select();
		$this->display();
	}


	/**
	 * 添加角色
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			if(M('role')->add(I('post.'))){
				$this->success('添加成功',U('Admin/Role/index'));
			}else{
				$this->error('添加失败');
			}
			return;
		}

		$this->display();
	}



	/**
	 * 修改角色
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			if(M('role')->save(I('post.'))){
				$this->success('更新成功',U('Admin/Role/index'));
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//角色
		$this->role = M('role')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}




	/**
	 * 删除角色
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			if(D('Role')->relation(true)->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Role/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}

	/**
	 * 修改角色状态
	 * @return [type] [description]
	 */
	public function editStatus(){
		if(IS_GET){
			if(M('role')->save(I('get.'))){
				$this->redirect(GROUP_NAME.'/Role/index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}



}