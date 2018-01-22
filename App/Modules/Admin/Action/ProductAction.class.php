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

		//类型数据
		$this->types = M('type')->select();
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
		$this->product  = D('Product')->relation(true)->where(array('id'=>I('get.id','','intval')))->find();
		
		//类型数据
		$this->types = D('Type')->relation(true)->select();
		//p($this->product);die;
		$this->display();
	}

	/**
	 * 删除商品
	 * @return [type] [description]
	 */
	public function del(){
		if(IS_GET){
			//关联删除商品
			if(D('Product')->relation(true)->where(array('id'=>I('get.id','','intval')))->delete()){
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
	 * 库存量
	 * @return [type] [description]
	 */
	public function num(){
		$productId = I('get.id','','intval');
		$gn = M('product_number');
		//提交属性
		if(IS_POST){
			//添加之前先删除库存
			$gn->where(array('product_id'=>$productId))->delete();

			$goods_attr = I('post.goods_attr');//属性
			$goods_num = I('post.goods_num');//库存
			$bilv = count($goods_attr)/count($goods_num);//比率，步长
			foreach ($goods_num as $k => $v) {
				$start = ($k-1)*$bilv;//起始下标
				$arr = array_slice($goods_attr,$start,$bilv);
				sort($arr,SORT_NUMERIC);//以数字升序排列
				$attr_id = implode(',',$arr);
				$gn->add(array(
					'product_id'=>$productId,//商品id
					'product_number'=>$v,//库存
					'product_attr_id'=>$attr_id,//属性id组合
				));
			}
			$this->success('设置库存成功',U('Admin/Product/num',array('id'=>$productId)));
			return;
		}
		
		//获取商品属性信息
		$attrs = M('product_attr')->alias('p')
				->field('p.*,a.attr_name')
				->join('tp_attribute a on p.attr_id=a.id')
				->where(array('p.product_id'=>$productId,'a.attr_type'=>'可选'))
				->select();
		
		//处理数据
		$goods = array();
		foreach ($attrs as $v) {
			$goods[$v['attr_name']][]=$v;
		}

		//取出商品库存量
		$this->gnData = $gn->where(array('product_id'=>$productId))->select();


		//p($goods);die;
		$this->goods = $goods;
		$this->display();
	}



	/**
	 * 修改商品状态
	 * @return [type] [description]
	 */
	public function editStatus(){
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


	/**
	 * 根据类型id获取属性
	 * @return [type] [description]
	 */
	public function ajaxGetAttr(){
		if(IS_AJAX){
			//获取类型id
			$typeid = I('post.type_id');
			$attrDate = M('attribute')->where(array('type_id'=>$typeid))->select();
			echo json_encode($attrDate);
		}
	}
}