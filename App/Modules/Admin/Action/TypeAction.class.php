<?php

/**
* 类型控制器
*/
class TypeAction extends CommonAction
{

	/**
	 * 类型列表
	 * @return [type] [description]
	 */
	public function index(){
		
		$this->types = M('type')->select();
		$this->display();
	}


	/**
	 * 添加类型
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			if(D('Type')->create()){
				if(M('type')->add(I('post.'))){
					$this->success('添加成功',U('Admin/Type/index'));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error(D('Type')->getError());
			}
			return;
		}

		$this->display();
	}



	/**
	 * 修改类型
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			if(D('Type')->create(I('post.'))){
				if(D('Type')->relation('attribute')->save(I('post.'))){
					$this->success('更新成功',U('Admin/Type/index'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error(D('Type')->getError());
			}
			return;
		}
		//角色
		$this->type = M('type')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}




	/**
	 * 删除类型
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			if(D('Type')->relation('attribute')->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Type/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}




}