<?php

/**
* 属性控制器
*/
class AttributeAction extends CommonAction
{

	/**
	 * 属性列表
	 * @return [type] [description]
	 */
	public function index(){
		$this->attrs = M('attribute')->where(array('type_id'=>I('get.type_id','','intval')))->select();
		$this->display();
	}


	/**
	 * 添加属性
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			$data = I('post.');
			if(isset($data['attr_option_values'])){//转换中文逗号
				$data['attr_option_values'] = str_replace('，',',',$data['attr_option_values']);
			}
			if(D('Attribute')->create($data)){//验证
				if(M('attribute')->add($data)){
					$this->success('添加成功',U('Admin/Attribute/index',array('type_id'=>$data['type_id'])));
				}else{
					$this->error('添加失败');
				}
			}else{
				$this->error(D('Attribute')->getError());
			}
			return;
		}
		//类型
		$this->types = M('type')->select();
		$this->display();
	}



	/**
	 * 修改属性
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$data = I('post.');
			if(isset($data['attr_option_values'])){//转换中文逗号
				$data['attr_option_values'] = str_replace('，',',',$data['attr_option_values']);
			}
			if(D('Attribute')->create($data)){//验证
				if(M('attribute')->save($data)){
					$this->success('更新成功',U('Admin/Attribute/index',array('type_id'=>$data['type_id'])));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error(D('Attribute')->getError());
			}
			return;
		}
		//属性
		$this->attr = M('attribute')->where(array('id'=>I('get.id','','intval')))->find();
		$this->types = M('type')->select();
		$this->display();
	}




	/**
	 * 删除属性
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			if(M('attribute')->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Attribute/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}




}