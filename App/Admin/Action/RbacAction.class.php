<?php

/**
* Rbac
*/
class RbacAction extends CommonAction
{

	/**
	 * 角色配置权限
	 * @return [type] [description]
	 */
	public function access(){
		if(IS_POST){
			$rid = I('rid',0,'intval');
			$access = I('post.access');
			$data = array();
			//切分组合插入数据
			foreach ($access as $v) {
				$tmp = explode('_',$v);
				$data[] = array(
					'role_id' => $rid,		//角色id
					'node_id' => $tmp[0],	//节点id
					'level'   => $tmp[1],	//节点级别
				);
			}
			//清空角色权限
			M('access')->where(array('role_id'=>$rid))->delete();
			//插入角色权限表
			if(M('access')->addAll($data)){
				$this->success('配置成功',U('Admin/Role/index'));
			}else{
				$this->error('配置失败');
			}
			return;
		}


		$rid = I('rid',0,'intval'); //角色id
		
		//原有权限
		$access = M('access')->where(array('role_id'=>$rid))->getField('node_id',true);

		//所有权限数据
		$node = M('node')->field(array('id','title','pid','level'))->order('sort')->select();
		$this->node = getTree($node,2,$access);
		
		$this->rid = $rid;
		$this->display();
	}

}