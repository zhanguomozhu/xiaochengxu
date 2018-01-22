<?php

/**
* 轮播图片控制器
*/
class BannerAction extends CommonAction
{

	/**
	 * 图片列表
	 * @return [type] [description]
	 */
	public function index(){
		if(IS_POST){
			$data = I('post.');
			//搜素条件
			if(isset($data['type'])){
				$where = array('type'=>I('post.type','','intval'));//推荐位
			}else{//更新排序
				foreach ($data as $key => $value) {
					M('banner')->save(array('id' => $key, 'sort' => $value));
				}
				$this->redirect(GROUP_NAME.'/banner/index');
				return;
			}
		}

		//分页
		import('ORG.Util.PageOne');// 导入分页类有修改
		$count = M('banner')->where($where)->count();// 查询满足要求的总记录数
		$page  = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		$this->show  = $page->show();// 分页显示输出
		$this->banners = M('banner')->where($where)->order('sort')->limit($page->firstRow.','.$page->listRows)->select();
		$this->display();
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			//文件上传
			if(IS_AJAX && !empty($_FILES)){
				//upload（'上传路径'，‘上传类型’，‘上传大小’）；
				upload('banners','image',1024*1024*5);
				//压缩图片

			}else{
				$data = I('post.');//获取数据
				$data['create_time'] = time();
				if(M('banner')->add($data)){
					$this->success('添加成功',U('Admin/Banner/index'));
				}else{
					$this->error('添加失败');
				}
			}
			return;
		}
		$this->display();
	}


	/**
	 * 修改
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			//文件上传
			if(IS_AJAX && !empty($_FILES)){
				//upload（'上传路径'，‘上传类型’，‘上传大小’）；
				upload('banners','image',1024*1024*5);
				//压缩图片

			}else{
				$data = I('post.');
				$data['update_time'] = time();
				//获取原图片
				$path = M('banner')->where(array('id'=>$data['id']))->getField('path');
				if(M('banner')->save($data)){
					if($data['path'] != $path){
						@unlink(trim($path,'/'));//删除原图片
					}
					$this->success('更新成功',U('Admin/Banner/index'));
				}else{
					@unlink(trim($data['path'],'/'));//删除原图片
					$this->error('更新失败');
				}
			}
			return;
		}
		$this->banner = M('banner')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			//删除图片
			if($path = M('banner')->where(array('id'=>I('get.id','','intval')))->getField('path')){
        		@unlink(trim($path,'/'));//删除原图片
			}
			if(M('banner')->where(array('id'=>I('get.id','','intval')))->delete()){
				$this->success('删除成功',U('Admin/Banner/index'));
			}else{
				$this->error('删除失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


	/**
	 * 修改状态
	 * @return [type] [description]
	 */
	public function editStatus(){
		if(IS_GET){
			if(M('banner')->save(I('get.'))){
				$this->redirect(GROUP_NAME.'/Banner/index');
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


}

