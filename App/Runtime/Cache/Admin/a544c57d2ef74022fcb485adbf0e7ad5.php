<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>节点列表</title>

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
                            <a href="<?php echo U('Admin/Index/index');?>">系统</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo U('Admin/Node/index');?>">节点列表</a>
                        </li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<button type="button" tooltip="添加节点" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo U('Admin/Node/add');?>'"> <i class="fa fa-plus"></i> 添加节点
</button>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                    <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <thead class="ssss">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">节点排序</th>
                                <th class="text-center">中文title</th>
                                <th class="text-center">英文名称</th>
                                <th class="text-center">节点描述</th>
                                <th class="text-center">节点级别</th>
                                <th class="text-center">开启状态</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center" style="width: 5%;"><?php echo ($vo["id"]); ?></td>
                                <td align="center" style="width: 5%;">
                                    <input class="form-control" type="text" style="text-align: center;" name="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["sort"]); ?>">
                                </td>
                                <td align="center" style="width: 10%;"><?php echo ($vo["title"]); ?></td>
                                <td align="left" style="width: 20%;"><?php echo ($vo["name"]); ?></td>
                                
                                <td align="center" style="width: 25%;"><?php echo ($vo["remark"]); ?></td>
                                <td align="center" style="width: 10%;"><?php echo (levelstyle($vo["level"],array('模块','控制器','方法'))); ?></td>
                                <td align="center" style="width: 10%;">
                                    <?php echo (status($vo["status"],U('Admin/Node/editStatus',array('id'=>$vo['id'],'status'=>$vo["status"]?0:1),''))); ?>
                                </td>
                                <td align="center" style="width: 15%;">
                                    <a href="<?php echo U('Admin/Node/edit',array('id'=>$vo['id']));?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <!-- <a href="#" onClick="warning('确实要删除吗', '<?php echo U('delNode',array('id'=>$vo['id']));?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a> -->
                                    <a href="#" onClick="confirmJump('确实要删除吗', '<?php echo U('Admin/Node/del',array('id'=>$vo['id']));?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">
                                <input class="btn btn-success" type="submit" name="" value='排序'>
                            </td>
                            <td colspan="6"></td>
                        </tr>
                        </tbody>
                    </table>
                    </form>
                </div>
                <div style="padding-top:10px;text-align: center;">
                    
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
    <script src="__PUBLIC__/style/bootbox.js"></script>

    <script type="text/javascript">
        
    //confirm弹窗
    function confirmJump(info,url){
        bootbox.confirm(info, function (result) {
            if (result) {
                window.location.href = url;
            }
        });
    }
    </script>

</body></html>