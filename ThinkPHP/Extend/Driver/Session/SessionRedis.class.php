<?php

/**
* 自定义Redis  session驱动
*/
class SessionRedis
{
	private $redis;//redis链接句柄

	private $expire;

	public function execute(){
		session_set_save_handler(
			array(&$this,'open'),
			array(&$this,'close'),
			array(&$this,'read'),
			array(&$this,'write'),
			array(&$this,'destroy'),
			array(&$this,'gc')
		);
	}


	/**
	 * 链接redis
	 * @param  [type] $path [description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public function open($path,$name){
		$this->expire = C('SESSION_EXPIRE')?C('SESSION_EXPIRE'):ini_get('session.gc_maxlifetime');
		$this->redis = new Redis();
		return $this->redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
	}



	/**
	 * 关闭
	 * @return [type] [description]
	 */
	public function close(){
		return $this->redis->close();
	}



	/**
	 * 读取
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function read($id){
		$id = C("SESSION_PREFIX").$id; 
		$data = $this->redis->get($id);
		return $data ? $data : '';
	}


	/**
	 * 写入
	 * @param  [type] $id   [description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function write($id,$data){
		$id = C("SESSION_PREFIX").$id;
		return $this->redis->set($id, $data, $this->expire);
	}



	/**
	 * 销毁
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id){
		$id = C("SESSION_PREFIX").$id;
		return $this->redis->delete($id);
	}



	/**
	 * 垃圾处理
	 * @param  [type] $maxLifeTime [description]
	 * @return [type]              [description]
	 */
	public function gc($maxLifeTime){
		return true;
	}




}