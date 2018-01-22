<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>添加用户</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__PUBLIC__/style/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/style/font-awesome.css" rel="stylesheet">
    <link href="__PUBLIC__/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__PUBLIC__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__PUBLIC__/style/demo.css" rel="stylesheet">
    <link href="__PUBLIC__/style/typicons.css" rel="stylesheet">
    <link href="__PUBLIC__/style/animate.css" rel="stylesheet">
    

</head>
<body>
	<!-- 头部 -->
	<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                        <span style="line-height: 40px;padding-left: 15px;font-size: 24px;">后台管理系统</span>
                    </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="__PUBLIC__/images/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo (session('username')); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="dropdown-footer">
                                    <a href="<?php echo U('Admin/Index/logout');?>">退出登录</a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>
	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			<!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input class="searchinput" type="text">
        <i class="searchicon fa fa-search"></i>
        <div class="searchhelper">xxxx</div>
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
         <!-- <li>
                <a href="<?php echo U('Admin/Index/index');?>" class="menu-dropdown">
                    <i class="menu-icon fa fa-file-text"></i>
                    <span class="menu-text">后台首页</span>
                    <i class="menu-expand"></i>
                </a>
            </li> -->
        <?php if(is_array($nodeList)): foreach($nodeList as $key=>$vo): if(in_array($vo['id'],$roleList) && !in_array($vo['name'],$notModel)): if(is_array($vo["child"])): foreach($vo["child"] as $key=>$vo1): if(in_array($vo1['id'],$roleList) && !in_array($vo1['name'],$notController)): ?><li>
                    <a href="#" class="menu-dropdown">
                        <i class="menu-icon fa fa-user"></i>
                        <span class="menu-text"><?php echo ($vo1["title"]); ?></span>
                        <i class="menu-expand"></i>
                    </a>
                    <ul class="submenu">
                        <?php if(is_array($vo1["child"])): foreach($vo1["child"] as $key=>$vo2): if(in_array($vo2['id'],$roleList) && !in_array($vo2['name'],$notAction)): $Url = $vo['name'].'/'.$vo1['name'].'/'.$vo2['name']; ?>
                            <li>
                                <a href='<?php echo U("$Url");?>'>
                                    <span class="menu-text"><?php echo ($vo2["title"]); ?></span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li><?php endif; endforeach; endif; ?>
                    </ul>
                </li><?php endif; endforeach; endif; endif; endforeach; endif; ?>
    <!--Dashboard-->
       <!--  <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">权限管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/User/index');?>">
                        <span class="menu-text">用户列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Role/index');?>">
                        <span class="menu-text">角色列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Node/index');?>">
                        <span class="menu-text">节点列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa  fa-list-ul"></i>
                <span class="menu-text">栏目分类</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/Cate/index');?>">
                        <span class="menu-text">分类列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li> 

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-th-large"></i>
                <span class="menu-text">商品管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/Product/index');?>">
                        <span class="menu-text">商品列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Product/dellist');?>">
                        <span class="menu-text">回收站</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Type/index');?>">
                        <span class="menu-text">类型管理</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-exchange"></i>
                <span class="menu-text">banner管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/Banner/index');?>">
                        <span class="menu-text">banner列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa  fa-truck"></i>
                <span class="menu-text">订单管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/Order/index');?>">
                        <span class="menu-text">订单列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">网站配置</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo U('Admin/Conf/index');?>">
                        <span class="menu-text">网站配置</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Conf/conf');?>">
                        <span class="menu-text">配置列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li> -->
    </ul>
    <!-- /Sidebar Menu -->
</div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                                        <li>
                        <a href="<?php echo U('Index/Index/index');?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo U('Admin/User/index');?>">用户列表</a>
                    </li>
                    <li class="active">添加用户</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-header bordered-bottom bordered-blue">
                                <span class="widget-caption">添加用户</span>
                            </div>
                            <div class="widget-body">
                                <div id="horizontal-form">
                                    <form class="form-horizontal" role="form" action="<?php echo U('Admin/User/add');?>" method="post">
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">用户名称</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" placeholder="" name="username" required="" type="text">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">用户密码</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" placeholder="" name="password" required="" type="password">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>

                                        <div class="form-group roles">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">所属角色</label>
                                            <div class="col-sm-4">
                                                <select name='role_id[]'>
                                                    <?php if(is_array($role)): foreach($role as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                                                </select>
                                            </div>
                                            <!-- <div class="col-sm-4">
                                                <span class="btn btn-success" id='add_role'>添加一个角色</span>
                                            </div> -->
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>

                                        <div class="form-group last">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-default">保存信息</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	    <!--Basic Scripts-->
    <script src="__PUBLIC__/style/jquery_002.js"></script>
    <script src="__PUBLIC__/style/bootstrap.js"></script>
    <script src="__PUBLIC__/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>
    <script type="text/javascript">
        // $(function(){
        //     $('#add_role').click(function(){
        //         var obj = $(this).parents('div .roles').clone();
        //         obj.find('#add_role').remove();
        //         $('.last').before(obj);
        //     })
        // })

    </script>

</body></html>