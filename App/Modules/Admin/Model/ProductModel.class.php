<?php
/**
* 商品模型
*/
class ProductModel extends RelationModel
{

	//定义关联关系
	protected $_link = array(
		//商品与图片表一对多关系模型
		'image' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			//'class_name'	=>'image',//关联表名
            'foreign_key'	=>'product_id',//主表关联表主键
            'mapping_name'	=>'image',//下标名
            'mapping_fields'=>'id,url,is_feng',//关联表字段
		),

		//商品与商品属性表一对多关系模型
		'attr' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			'class_name'	=>'product_attr',//关联表名
            'foreign_key'	=>'product_id',//主表关联表主键
            'mapping_name'	=>'attr',//下标名
            'mapping_fields'=>'id,attr_value,product_id,attr_id',//关联表显示字段
            'mapping_order' => 'attr_id,id',
		),

		//商品与属性表多对多关系模型
		// 'attribute' => array(
		// 	'mapping_type' 		=> MANY_TO_MANY,//多对多
		// 	'class_name'		=>'attribute',//关联表名
		// 	'mapping_name'		=>'attribute',//下标名
		// 	'foreign_key'		=>'product_id',//主表关联表主键
		// 	'relation_foreign_key'=>'attr_id',//关联表的外键名称
		// 	'relation_table'	=>'product_attr',//中间表
		// ),

		//商品与商品属性表一对多关系模型
		'num' => array(
			'mapping_type' 	=> HAS_MANY,//一对多
			'class_name'	=>'product_number',//关联表名
            'foreign_key'	=>'product_id',//主表关联表主键
            'mapping_name'	=>'num',//下标名
            //'mapping_fields'=>'',//关联表显示字段
            //'mapping_order' => 'attr_id,id',
		),


		//商品与栏目表一对一关系模型
		'cate' => array(
			'mapping_type' 	=> BELONGS_TO,//一对一
			'class_name'	=>'cate',//关联表名
            'foreign_key'	=>'cate_id',//主表关联表主键
            'mapping_name'	=>'cate',//下标名
            'mapping_fields'=>'name',//关联表字段
            'as_fields'		=>'name:cate',//字段：别名
		),
	);

	//validate验证
	protected $_validate = array(
	    array('cate_id','number','分类必须是数字',0,''),
	    array('name','require','商品名称必须',0,''),
	    array('name','','商品名称不能重复',0,'unique',1),
	    array('yuan_price','currency','原价必须是货币类型',0),
	    array('xian_price','currency','回馈价必须是货币类型',0),
	    array('is_on',array(0,1),'上架值的范围不正确！',0,'in'),
	);


	/**
	 * 根据是否在回收站获取商品数据
	 * @param  [type] $del [description]
	 * @return [type]      [description]
	 */
	public function getProducts($where=array()){
		if(IS_POST){
			//***********************************************搜索
			//商品名称
			$name = I('post.name');
			if(isset($name) && !empty($name)) $where['name'] = array('like','%'.$name.'%');
			//商品分类
			$cate_id = I('post.cate_id');
			if(isset($cate_id)  && !empty($cate_id)) 
			{
				//查找分类的子分类
				$cates = M('cate')->select();
				$cids = getSons($cates,$cate_id,'id');
				$cids[] = $cate_id;
				$where['cate_id'] = array('in',$cids);
			}
			
			//上架下架
			if(I('post.is_on') == 1){//上架
				$where['is_on'] = 1;
			}elseif(I('post.is_on') == 2){//下架
				$where['is_on'] = 0;
			}
			//*********************************************创建时间
			//开始时间
			$starttime = str_replace('+',' ',I('post.starttime'));
			if(isset($starttime) && !empty($starttime)) $where['create_time'] = array('egt',strtotime($starttime));
			//结束时间
			$endtime = str_replace('+',' ',I('post.endtime'));
			if(isset($endtime) && !empty($endtime)) $where['create_time'] = array('elt',strtotime($endtime));

			//都存在
			if( (isset($starttime) && !empty($starttime)) && (isset($endtime) && !empty($endtime)) ) $where['create_time']= array('between',array(strtotime($starttime),strtotime($endtime)));


			//************************************************价格
			//起始价格
			$startprice=I('post.startprice','','intval');
			if(isset($startprice) && !empty($startprice)) $where['xian_price'] = array('egt',$startprice);
			//结束价格
			$endprice =I('post.endprice','','intval');
			if(isset($endprice) && !empty($endprice)) $where['xian_price'] = array('elt',$endprice);

			//都存在
			if( (isset($startprice) && !empty($startprice)) && (isset($endprice) && !empty($endprice)) ) $where['xian_price']= array('between',array($startprice,$endprice));


			//************************************************排序
			$orderDate =array();
			//原价
			$yuan_price = I('post.yuan_price');
			if($yuan_price == 1) $orderDate[] = 'yuan_price asc';
			if($yuan_price == 2) $orderDate[] = 'yuan_price desc';
			//现价
			$xian_price = I('post.xian_price');
			if($xian_price == 1) $orderDate[] = 'xian_price asc';
			if($xian_price == 2) $orderDate[] = 'xian_price desc';
			//库存
			// $num = I('post.num');
			// if($num == 1) $orderDate[] = 'num asc';
			// if($num == 2) $orderDate[] = 'num desc';
			//创建时间
			$create_time = I('post.create_time');
			if($create_time == 1) $orderDate[] = 'create_time asc';
			if($create_time == 2) $orderDate[] = 'create_time desc';
			$order = implode(',',$orderDate);
		}
		
		if(!$order){
			$order = array('create_time desc');
		}

		//***********************************************分页
		import('ORG.Util.PageOne');// 导入分页类有修改
		$count = M('product')->where($where)->count();// 查询满足要求的总记录数
		$page  = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
		//$page->setConfig('theme', '<li><a>%totalRow% %header%</a></li> %first% %upPage% %linkPage% %downPage% %end%');
		$data['show']  = $page->show();// 分页显示输出
		$data['products'] = $this->relation(true)->where($where)->limit($page->firstRow.','.$page->listRows)->order($order)->select();
		//echo $this->getLastSql();
		return $data;
	}




	/**
	 * 添加商品数据
	 * @param [type] $data [description]
	 */
	public function addProduct($data){
		//删除file字段
		unset($data['file']);
		$array = array();
		//拼写关联模型字段图片表
		foreach ($data['image'] as $value) {
			$array[]= array(
				'url'=>$value,//图片路径
			);
		}


		//拼写关联模型字段商品属性表
		foreach ($data['attr_value'] as $k => $v) {
			//去除重复的属性值
			$v=array_unique($v);
			foreach ($v as $k1 => $v1) {
				$data['attr'][] = array(
					'attr_id'=>$k, //属性id
					'attr_value'=>$v1,//属性值
				); 
			}
		}
		//删除源数据
		unset($data['attr_value']);


		//如果图片不为空
		if(!empty($array)){
			$array[0]['is_feng'] = 1;//默认第一张为封面
			//压缩图片
			$thumbs = makeThumb($array[0]['url']);
			$thumb = implode(';',$thumbs);//数据库内压缩图片以;号分割
			$array[0]['thumb'] = $thumb;//压人数组
		}
		$data['image']=$array;
		$data['create_time']=time();
		//validate验证
		if($this->create($data)){
			//关联插入
			if($id = $this->relation(true)->add($data)){
				return show(1,'添加成功',array($id));
			}else{
				//若添加失败，删除上传的图片
				foreach ($data['image'] as $value) {
					@unlink(trim($value['url'],'/'));
				}
				return show(0,'添加失败');
			}
		}else{
			//若验证失败，删除上传的图片
			foreach ($data['image'] as $value) {
				@unlink(trim($value['url'],'/'));
			}
			return show(0,$this->getError());
		}
	}



	/**
	 * 修改商品
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function editProduct($data){
		//p($data);die;
		//删除file字段
		unset($data['file']);
		//获取图片信息
		$imgIds = M('image')->field('id,url,thumb')->where(array('product_id'=>$data['id']))->select();
		

		$array = array();
		//拼写关联模型字段
		foreach ($data['image'] as $key => $value) {
			$array[]= array(
				'id' =>$imgIds[$key]['id'],//原图片id,如有修改，没有添加
				'url'=>$value,//图片路径
			);
			//unset($imgIds[$key]['id']);//删除已分配图片id
		}

		//拼写关联模型字段商品属性表
		$ids = array();//更新后的商品id用于和元id集合对比
		foreach ($data['attr_value'] as $k => $v) {
			//去除重复的属性值
			$v=array_unique($v);
			foreach ($v as $k1 => $v1) {
				$keys = explode('_',$k);
				if($keys[2] == $v1){
					$ids[] = $keys[1];//插入id
					$data['attr'][] = array(
						'id'=> $keys[1],//属性表id
						'attr_id'=>$keys[0], //属性id
						'attr_value'=>$v1,//属性值
						'product_id'=>$data['id'],//商品id
					); 
				}else{
					$data['attr'][] = array(
						'attr_id'=>$keys[0], //属性id
						'attr_value'=>$v1,//属性值
						'product_id'=>$data['id'],//商品id
					); 
				}
				
			}
		}
		//删除源数据
		unset($data['attr_value']);

		//如果图片不为空
		if(!empty($array)){
			$array[0]['is_feng'] = 1;//默认第一张为封面
			//压缩图片
			$thumbs = makeThumb($array[0]['url']);
			$thumb = implode(';',$thumbs);//数据库内压缩图片以;号分割
			$array[0]['thumb'] = $thumb;//压人数组
		}
		$data['image']=$array;
		$data['update_time']=time();
		//validate验证
		if($this->create($data)){
			//原商品属性ids
			$attrIds = M('product_attr')->where(array('product_id'=>$data['id']))->getField('id',true);
				//关联更新
				if($this->relation(true)->where(array('id'=>$data['id']))->save($data)){
					//删除属性表删除的属性
					foreach ($attrIds as $v) {
						if(!in_array($v,$ids)){
							M('product_attr')->where(array('id'=>$v))->delete();
						}
					}
					//更新完成循环删除之前图片
					foreach ($imgIds as $k=>$v) {
						if(isset($v['thumb'])){
							$thumb = explode(';',$v['thumb']);
							//p($thumb);die;
							foreach ($thumb as $v1) {
								@unlink($v1);//删除缩略图
							}
						}
						@unlink($v['url']);//删除原图
						//如果修改成功，删除多余图片
						// if(!empty($v['id'])){
						// 	M('image')->where(array('id'=>$v['id']))->delete();
						// }
					}
					return show(1,'修改成功');
				}else{
					//若添加失败，删除上传的图片
					foreach ($data['image'] as $value) {
						@unlink(trim($value['url'],'/'));
					}
					return show(0,'修改失败');
				}
		}else{
			//若验证失败，删除上传的图片
			foreach ($data['image'] as $value) {
				@unlink(trim($value['url'],'/'));
			}
			return show(0,$this->getError());
		}
	}


}