<?php
/**
* 商品视图模型
*/
class ProductViewModel extends ViewModel
{
	protected $viewFields = array(
		'product' => array(
			'id','name','yuan_price','xian_price','num','is_on','is_del','create_time','description',
			'_type'=>'',//默认inner join
		),
		'image' => array(
			'url'=>'image','is_feng',
			'_on'=>'image.product_id = product.id',
		),
		'cate' => array(
			'name'=>'cate',
			'_on'=>'product.cate_id = cate.id',
		),

	);


	/**
	 * 根据是否在回收站获取商品数据
	 * @param  [type] $del [description]
	 * @return [type]      [description]
	 */
	public function getProducts($where,$limit){
		return $this->where($where)->limit($limit)->select();
	}

}