<?php
// 配置表操作
class ConfAction extends CommonAction {

	

	/**
	 * 网站配置
	 * @return [type] [description]
	 */
	public function index(){
		if(IS_POST){
			//文件上传
			if(IS_AJAX && !empty($_FILES)){
				//upload（'上传路径'，‘上传类型’，‘上传大小’）；
				upload('logos','image',1024*1024*5);
			}else{
				$data = I('post.');//获取数据
				//checkbox特殊处理,I函数获取不到多选框的值
				if(I('post.code')){
					$data['code'] = implode(',',I('post.code'));
				}
				//循环修改数据
				if($data){
					foreach ($data as $key => $value) {//修改数据库
						if($path = M('conf')->where(array('enname'=>$key,'type'=>6))->getField('value')){
							M('conf')->where(array('enname'=>$key))->save(array('value' => trim($value)));
							if($data['logo'] != $path){
		                		@unlink(trim($path,'/'));//删除原图片
							}
						}else{
							M('conf')->where(array('enname'=>$key))->save(array('value' => trim($value)));
						}
						
					}
				}
				$this->success('配置成功');
			}
			return;
		}else{
			//配置信息
			$res = M('conf')->order('sort')->select();
			foreach ($res as $key => $value) {//去除空格
				$res[$key]['values'] = trim($res[$key]['values']);
			}
			$this->data = $res;

			$this->display();
		}

		
		
	}

    /**
	 * 配置列表
	 * @return [type] [description]
	 */
	public function conf(){
		//更新排序
		if(IS_POST){
			$data = I('post.');
			foreach ($data as $key => $value) {
				M('conf')->save(array('id' => $key, 'sort' => $value));
			}
			$this->redirect(GROUP_NAME.'/Conf/confList');
			return;
		}
		$this->confs = M('conf')->order('sort')->select();
		$this->display();
	}


	/**
	 * 添加配置
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			$data = I('post.');
			//转换中文逗号
			if($data['values']){
				$data['values'] = str_replace('，',',',$data['values']);
			}
			if(M('conf')->add($data)){
				$this->success('添加成功',U('Admin/Conf/confList'));
			}else{
				$this->error('添加失败');
			}
			return;
		}
		$this->display();
	}


	/**
	 * 修改配置
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$data = I('post.');
			//转换中文逗号
			if($data['values']){
				$data['values'] = str_replace('，',',',$data['values']);
			}
			if(M('conf')->save($data)){
				$this->success('更新成功',U('Admin/Conf/confList'));
			}else{
				$this->error('更新失败');
			}
			return;
		}
		$this->conf = M('conf')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}

	/**
	 * 删除配置
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			if(M('conf')->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Conf/confList'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}

}