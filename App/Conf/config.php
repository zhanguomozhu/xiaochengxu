<?php
return array(

	// 分组配置
	'APP_GROUP_LIST' => 'Admin,Api', //项目分组设定
	'DEFAULT_GROUP'  => 'Admin', //默认分组
	
	//独立分组配置
	'APP_GROUP_MODE' =>  1, //分组模式：0普通分组；1独立分分
	'APP_GROUP_PATH' => 'Modules',//独立模块文件夹
	

	// URL配置
    'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             => 3,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持


	// 数据库配置
	'DB_TYPE'   => 'mysql', 	// 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'www_xjzxmryy_com_shop', 		// 数据库名
	'DB_USER'   => 'root', 		// 用户名
	'DB_PWD'    => 'root', 			// 密码
	'DB_PORT'   => 3306, 		// 端口
	'DB_PREFIX' => 'tp_', // 数据库表前缀
	//或者数据库类型://用户名:密码@数据库地址:数据库端口/数据库名
	//'DB_DSN' => 'mysql://root@localhost:3306/thinkphp'


	// 模板配置
	'TMPL_PARSE_STRING'  =>array(
	        '__UPLOAD__' => '/Uploads', //上传路径
	),


	//session配置
	'SESSION_TYPE'   => 'Db', //数据库存储session，默认文件存储
	'SESSION_EXPIRE' => 60*60,//session过期时间
	//'SESSION_PREFIX' => 'think_',//session前缀,默认为空
	//'SESSION_TYPE' => 'Redis', //自定义redis存储session



	//Redis配置
	'REDIS_HOST' => '127.0.0.1',//Redis服务器地址
	'REDIS_PORT' => 6379,	//端口

	//TRACE sql调试
	'SHOW_PAGE_TRACE' => true,
	'TRACE_EXCEPTION' => true,   // TRACE错误信息是否抛异常 针对trace方法 


	//定义路由规则
	'URL_ROUTER_ON' => true,//开启路由
	'URL_ROUTE_RULES' => array(//定义路由规则
		//'cate/:id' => 'Admin/Index/index',
		//'cate/:id\d' => 'Admin/Cate/index',
		//'/^c_(\d+)$/' => 'Admin/Index/index?id=:1',//正则路由
	),


	//加载其他配置文件
	'LOAD_EXT_CONFIG' => 'upload',


);

