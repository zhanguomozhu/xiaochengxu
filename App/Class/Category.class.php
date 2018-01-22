<?php

//使用方法import('Class.Cateroty',APP_PATH);
class Category {

	 /**
	 * 获取无限分类树
	 * @return [type] [默认0，带前缀；1，不带前缀；2，子排序]
	 * @return [access] [array,权限判断]
	 * @return [type] [description]
	 */
	static public function getTree($data,$type,$access)
	{
	    switch ($type) {
	        case 0:
	            return self::qsort($data);
	            break;
	        case 1:
	            return self::nsort($data);
	            break;
	        case 2:
	            return self::ssort($data,0,$access);
	            break;
	    }
	}

	/**
	 * 排序带前缀
	 * @param  [type]  $data [数据源]
	 * @param  integer $pid  [父id]
	 * @return [type]        []
	 */
	static private function qsort($data,$pid=0,$level=0)
	{
	    static $arr = array();
	    $depth_html = '';
	    foreach ($data as $k => $v) {
	        if($v['pid'] == $pid){  
	            for ($i=0; $i<$level; $i++) { 
	                if($i == 0){
	                    $depth_html = '|';
	                }
	                $depth_html .= '——';
	            }           
	            $v['name'] = $depth_html.$v['name'];
	            $arr[] = $v;
	           self::qsort($data,$v['id'],$level+1);
	        }
	    }
	    return $arr;
	}


	 /**
	 * 排序不带前缀
	 * @param  [type]  $data [数据源]
	 * @param  integer $pid  [父id]
	 * @return [type]        []
	 */
	static private function nsort($data,$pid=0)
	{
	    static $arr = array();
	    foreach ($data as $k => $v) {
	        if($v['pid'] == $pid){  
	            $arr[] = $v;
	            self::nsort($data,$v['id']);
	            
	        }
	    }
	    return $arr;
	}



	 /**
	 * 子排序
	 * @param  [type]  $data [数据源]
	 * @param  integer $pid  [父id]
	 * @param  array $access [节点字符串]判断是否有权限
	 * @return [type]        []
	 */
	static private function ssort($data,$pid=0,$access=null)
	{
	    $arr = array();
	    foreach ($data as $v) {
	        if(is_array($access)){
	            $v['access'] = in_array($v['id'],$access) ? 1 : 0;
	        }
	        if($v['pid'] == $pid){ 
	        	$v['child'] =self::ssort($data,$v['id'],$access); 
	            $arr[] = $v;
	        }
	    }
	    return $arr;
	}




	
	/**
	 * 根据子分类id获取所有父级分类
	 * @param  [type] $data [description]
	 * @param  [type] $id   [description]
	 * @param  [type] $id   [需要取的字段]
	 * @param  [type] $sort [排序，默认0从小到大]
	 * @return [type]       [description]
	 */
	static public function getParents($data,$id,$filed=null,$sort=0){
	    static $array = array();
	    foreach ($data as $v) {
	        if($v['id'] == $id){
	            $array[] = $filed ? $v[$filed] : $v;//获取所有数据
	            self::getParents($data,$v['pid'],$filed);
	        }
	    }
	    //翻转数组
	    if($sort){
	        $array = array_reverse($array);
	    }
	    return $array;
	}



	/**
	 * 根据子父级分类id获取所有子级分类
	 * @param  [type] $data [description]
	 * @param  [type] $id   [description]
	 * @param  [type] $id   [需要取的字段]
	 * @param  [type] $sort [排序，默认0从小到大]
	 * @return [type]       [description]
	 */
	static public function getSons($data,$pid,$filed=null,$sort=0){
	    static $array = array();
	    foreach ($data as $v) {
	        if($v['pid'] == $pid){
	            $array[] = $filed ? $v[$filed] : $v;//获取所有数据
	            self::getSons($data,$v['id'],$filed);
	        }
	    }
	    //翻转数组
	    if($sort){
	        $array = array_reverse($array);
	    }
	    return $array;
	}



}