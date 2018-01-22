<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>配置角色权限</title>

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
                                        <li>
                        <a href="<?php echo U('Index/Index/index');?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo U('Admin/Node/index');?>">权限管理</a>
                    </li>
                    <li class="active">配置角色权限</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                
                <!-- Page Body -->
                <div class="page-body">
                <button type="button" tooltip="返回" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo U('Admin/Role/index');?>'"> <i class="fa fa-reply"></i> 返回
                </button>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-header bordered-bottom bordered-blue">
                                <span class="widget-caption">配置角色权限</span>
                            </div>
                            <div class="widget-body">
                                <div id="horizontal-form">
                                    <form action="<?php echo U('Admin/Rbac/access');?>" method="post">

                                        <div class="well">
                                            <div class="dd dd-draghandle bordered">
                                                <ol class="dd-list">
                                                    <!-- 模块 -->
                                                    <?php if(isset($node)): if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="dd-item dd2-item level1">
                                                        <div class="dd-handle dd2-handle">
                                                            <input type="checkbox" class="inverted" style="opacity:1;position: absolute;left: 9px;top: 6px;" name='access[]' value="<?php echo ($vo["id"]); ?>_<?php echo ($vo["level"]); ?>" level='<?php echo ($vo["level"]); ?>' <?php if($vo["access"] == 1): ?>checked<?php endif; ?>>
                                                        </div>
                                                        <div class="dd2-content blue"><?php echo ($vo["title"]); ?></div>

                                                        <ol class="dd-list" style="">
                                                            <!-- 控制器 -->
                                                            <?php if(isset($vo['child'])): if(is_array($vo['child'])): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><li class="dd-item dd2-item level2">
                                                                <div class="dd-handle dd2-handle">
                                                                    <input type="checkbox" class="inverted" style="opacity:1;position: absolute;left: 9px;top: 6px;" name='access[]' value="<?php echo ($v1["id"]); ?>_<?php echo ($v1["level"]); ?>" level='<?php echo ($v1["level"]); ?>' <?php if($v1["access"] == 1): ?>checked<?php endif; ?>>
                                                                </div>
                                                                <div class="dd2-content darkpink"><?php echo ($v1["title"]); ?></div>

                                                                <ol class="dd-list">
                                                                    <!-- 方法 -->
                                                                    <?php if(isset($v1['child'])): if(is_array($v1['child'])): $i = 0; $__LIST__ = $v1['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?><li class="dd-item dd2-item level3">
                                                                        <div class="dd-handle dd2-handle">
                                                                            <input type="checkbox" class="inverted" style="opacity:1;position: absolute;left: 9px;top: 6px;" name='access[]' value="<?php echo ($v2["id"]); ?>_<?php echo ($v2["level"]); ?>" level='<?php echo ($v2["level"]); ?>' <?php if($v2["access"] == 1): ?>checked<?php endif; ?>>
                                                                        </div>
                                                                        <div class="dd2-content"><?php echo ($v2["title"]); ?></div>
                                                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                                </ol>

                                                            </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                        </ol>

                                                    </li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                                </ol>
                                            </div>
                                        </div>
                                        <input type="hidden" name="rid" value="<?php echo ($rid); ?>">
                                        <button type="submit" class="btn btn-success">保存信息</button>
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

    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>
    <!-- 拖拽 -->
  

      <script type="text/javascript">
       $(function(){
            //一级点击
            $('input[level=1]').click(function(){
                var inputs = $(this).parents('li').find('input');
                $(this).prop('checked') ? inputs.prop('checked','checked') : inputs.removeAttr('checked');
            })

            //二级点击
            $('input[level=2]').click(function(){
                var inputs = $(this).parents('li .level2').find('input');
                var inputs1 = $(this).parents('li').find('input[level=1]');//一级
                console.log(inputs1);
                $(this).prop('checked') ? (inputs.prop('checked','checked') && inputs1.prop('checked','checked')) : (inputs.removeAttr('checked'));
            })

            //三级点击
            $('input[level=3]').click(function(){
                var inputs1 = $(this).parents('li .level3').parents('li .level2').find('input[level=2]');//二级
                var inputs2 = $(this).parents('li .level3').parents('li .level2').parents('li').find('input[level=1]');//一级
                $(this).prop('checked') ? (inputs1.prop('checked','checked') && inputs2.prop('checked','checked')) : '';
            })
       })
   </script>
</body>
</html>