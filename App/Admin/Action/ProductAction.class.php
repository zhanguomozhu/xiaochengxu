<?php
// 商品操作
class ProductAction extends CommonAction {

	/**
	 * 商品列表
	 * @return [type] [description]
	 */
	public function index(){
		//获取数据
		$where = array('is_del'=>0);
		$data = D('Product')->getProducts($where);
		$this->show = $data['show'];//分页
		$this->products = $data['products'];//商品数据
		//分类数据
		$cate = M('cate')->order('sort')->select();
		$this->cate = getTree($cate);
		$this->display();
	}




	/**
	 * 回收站
	 * @return [type] [description]
	 */
	public function dellist(){
		//获取数据
		$where = array('is_del'=>1);
		$data = D('Product')->getProducts($where);
		$this->show = $data['show'];//分页
		$this->products = $data['products'];//商品数据
		//分类数据
		$cate = M('cate')->order('sort')->select();
		$this->cate = getTree($cate);
		$this->display();
	}



	/**
	 * 添加商品
	 * @return [type] [description]
	 */
	public function add(){
		if(IS_POST){
			$data = $_POST;
			//插入数据
			$res = D('Product')->addProduct($data);
			if($res['code']){
				$this->success($res['msg'],U(GROUP_NAME.'/Product/index'));
			}else{
				$this->error($res['msg']);
			}
			return;
		}
		//分类数据
		$cate = M('cate')->order('sort')->select();
		$this->cate = getTree($cate);
		$this->display();
	}


	/**
     * webuploader 上传demo
     */
    public function ajax_upload(){
        // 如果是post提交则显示上传的文件 否则显示上传页面
        if(IS_POST){
           if(!empty($_FILES)){
				//ajax_upload（'上传路径'，‘上传类型’，‘上传大小’）；
				ajax_upload('products','image',1024*1024*5);
				//压缩图片
			}else{
				$data['error_info'] = '没有图片上传';
        		echo json_encode($data);
			}
        }else{
        	$data['error_info'] = '请求方法有误';
        	echo json_encode($data);
        }
    }

	/**
	 * 修改商品
	 * @return [type] [description]
	 */
	public function edit(){
		if(IS_POST){
			$data = $_POST;
			//插入数据
			$res = D('Product')->editProduct($data);
			if($res['code']){
				$this->success($res['msg'],U(GROUP_NAME.'/Product/index'));
			}else{
				$this->error($res['msg']);
			}
			return;
		}
		//分类数据
		$cate = M('cate')->order('sort')->select();
		$this->cate = getTree($cate);
		//商品数据
		$this->product  = D('Product')->relation('image')->where(array('id'=>I('get.id','','intval')))->find();
		$this->display();
	}

	/**
	 * 删除商品
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			//关联删除商品
			if(D('Product')->relation('image')->where(array('id'=>I('get.id','','intval')))->delete()){
				if(stripos($_SERVER['HTTP_REFERER'],'dellist')){
					$this->success('删除成功',U('Admin/Product/dellist'));
				}else{
					$this->success('删除成功',U('Admin/Product/index'));
				}
			}else{
				$this->error('删除失败');
			}
			
		}else{
			$this->error('请求方式错误');
		}
		
	}



	/**
	 * 修改商品状态
	 * @return [type] [description]
	 */
	public function editProductStatus(){
		if(IS_GET){
			if(M('product')->save(I('get.'))){
				if(stripos($_SERVER['HTTP_REFERER'],'dellist')){
					$this->redirect('Admin/Product/dellist');
				}else{
					$this->redirect('Admin/Product/index');
				}
				
			}else{
				$this->error('修改失败');
			}
		}else{
			$this->error('请求方式错误');
		}
	}


}