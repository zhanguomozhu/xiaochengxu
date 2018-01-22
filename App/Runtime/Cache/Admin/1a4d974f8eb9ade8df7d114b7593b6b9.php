<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title><?php echo ($conf["sitename"]); ?></title>

    <meta name="description" content="<?php echo ($conf["description"]); ?>" >
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
			<!-- Page Sidebar左侧 -->
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

        <?php if(is_array($nodeList)): foreach($nodeList as $key=>$vo): if(in_array($vo['id'],$roleList) && !in_array($vo['name'],$notModel)): if(is_array($vo["child"])): foreach($vo["child"] as $key=>$vo1): if(in_array($vo1['id'],$roleList) && !in_array($vo1['name'],$notController)): $controllerUrl = $vo['name'].'/'.$vo1['name'].'/index'; ?>
                <li>
                    <a href='<?php echo U("$controllerUrl");?>' class="menu-dropdown">
                        <i class="menu-icon fa fa-arrows"></i>
                        <span class="menu-text"><?php echo ($vo1["title"]); ?></span>
                        <i class="menu-expand"></i>
                    </a>
                    <ul class="submenu">
                        <?php if(is_array($vo1["child"])): foreach($vo1["child"] as $key=>$vo2): if(in_array($vo2['id'],$roleList) && !in_array($vo2['name'],$notAction)): $actionUrl = $vo['name'].'/'.$vo1['name'].'/'.$vo2['name']; ?>
                            <li>
                                <a href='<?php echo U("$actionUrl");?>'>
                                    <span class="menu-text"><?php echo ($vo2["title"]); ?></span>
                                    <i class="menu-expand"></i>
                                </a>
                            </li><?php endif; endforeach; endif; ?>
                    </ul>
                </li><?php endif; endforeach; endif; endif; endforeach; endif; ?>
    </ul>
    <!-- /Sidebar Menu -->
</div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">

                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">控制面板</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Body -->
                <div class="page-body">
                    
                    <!-- <?php
 $_nav_cate = M('cate')->order("id")->limit(10)->select(); import('Class.Category',APP_PATH); $_nav_cate = Category::getTree($_nav_cate); foreach($_nav_cate as $_nav_cate_v): extract($_nav_cate_v); $url = U('\c_'.$id); ?><span><?php echo ($name); ?></span>
                        <h1><?php echo ($url); ?></h1><?php endforeach;?>
                                        <?php echo W('Hot',array('id'=>$id));?> -->



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
     
</body>
</html>