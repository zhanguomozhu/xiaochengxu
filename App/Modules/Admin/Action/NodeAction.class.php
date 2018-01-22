<?php

/**
* 节点控制器
*/
class NodeAction extends CommonAction
{

	/**
	 * 节点列表
	 * @return [type] [description]
	 */
	public function index(){
		//更新排序
		if(IS_POST){
			$data = I('post.');
			foreach ($data as $key => $value) {
				M('node')->save(array('id' => $key, 'sort' => $value));
			}
			$this->redirect(GROUP_NAME.'/Node/index');
			return;
		}

		$node = M('node')->order('sort')->select();
		$this->node = getTree($node);
		$this->display();
	}




	/**
	 * 添加节点
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			if(M('node')->add(I('post.'))){
				$this->success('添加成功',U('Admin/Node/index'));
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//节点列表
		$node = M('node')->order('sort')->select();
		$this->node = getTree($node);
		$this->display();
	}


	/**
	 * 修改节点
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			if(M('node')->save(I('post.'))){
				$this->success('更新成功',U('Admin/Node/index'));
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//节点列表
		$nodes = M('node')->order('sort')->select();
		$this->nodes = getTree($nodes);

		$this->node = M('node')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}

	/**
	 * 删除节点
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			if(D('Node')->relation(true)->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Node/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


	/**
	 * 修改节点状态
	 * @return [type] [description]
	 */
	public function editStatus(){
		if(IS_GET){
			if(M('node')->save(I('get.'))){
				$this->redirect(GROUP_NAME.'/Node/index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}

}