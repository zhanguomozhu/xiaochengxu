<?php

/**
* 分类
*/
class CateAction extends CommonAction
{
	
	/**
	 * 分类列表
	 * @return [type] [description]
	 */
	public function index(){
		//更新排序
		if(IS_POST){
			$data = I('post.');
			foreach ($data as $key => $value) {
				M('cate')->save(array('id' => $key, 'sort' => $value));
			}
			$this->redirect(GROUP_NAME.'/Cate/index');
			return;
		}
		//分页
		import('ORG.Util.PageOne');// 导入分页类有修改
		$count = M('cate')->where($where)->count();// 查询满足要求的总记录数
		$page  = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$this->show  = $page->show();// 分页显示输出
		$cates = M('cate')->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
		$this->cates = getTree($cates);
		$this->display();
	}


	/**
	 * 添加分类
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			//文件上传
			if(IS_AJAX && !empty($_FILES)){
				//upload（'上传路径'，‘上传类型’，‘上传大小’）；
				upload('cates','image',1024*1024*5);
				//压缩图片
			}else{
				$data = I('post.');//获取数据
				$data['create_time'] = time();
				if(M('cate')->add($data)){
					$this->success('添加成功',U('Admin/Cate/index'));
				}else{
					$this->error('添加失败');
				}
			}
			return;
		}
		//分类
		$cates = M('cate')->order('sort')->select();
		$this->cates = getTree($cates);
		$this->display();
	}


	/**
	 * 编辑分类
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			//文件上传
			if(IS_AJAX && !empty($_FILES)){
				//upload（'上传路径'，‘上传类型’，‘上传大小’）；
				upload('cates','image',1024*1024*5);
				//压缩图片
			}else{
				$data = I('post.');
				$data['update_time'] = time();
				//获取原图片
				$img = M('cate')->where(array('id'=>$data['id']))->getField('img');
				if(M('cate')->save($data)){
					if($data['img'] != $img){
						@unlink(trim($img,'/'));//如果更新成功，删除原图片
					}
					$this->success('更新成功',U('Admin/Cate/index'));
				}else{
					@unlink(trim($data['img'],'/'));//如果更新失败，删除图片
					$this->error('更新失败');
				}
			}
			return;
		}
		$id = I('get.id','','intval');
		//所有分类数据
		$cates = M('cate')->order('sort')->select();
		$this->cates = getTree($cates);
		//获取子分类
		$sons = getSons($cates,$id,'id');
		$sons[] = $id;
		$this->sons = $sons;
		//当前id信息
		$this->cate  = M('cate')->where(array('id'=>$id))->find();
		$this->display();
	}

	/**
	 * 删除分类
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			//查找分类的子分类
			$cate = M('cate')->select();
			$id = I('get.id','','intval');
			$ids = getSons($cate,$id,'id');
			$ids[] = $id;
			if(M('cate')->where(array('id'=>array('in',$ids)))->delete()){
				$this->success('删除成功',U('Admin/Cate/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


	/**
	 * 修改分類状态
	 * @return [type] [description]
	 */
	public function editStatus(){
		if(IS_GET){
			if(M('cate')->save(I('get.'))){
				$this->redirect(GROUP_NAME.'/Cate/index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}
}