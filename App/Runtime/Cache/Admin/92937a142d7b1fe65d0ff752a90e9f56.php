<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>商品列表</title>

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
    <link href="__PUBLIC__/Other/layui/css/layui.css" rel="stylesheet">
    <link href="__PUBLIC__/Other/layui/css/modules/laydate/default/laydate.css" rel="stylesheet">
    <style type="text/css">
        tr td{
            vertical-align: middle!important;
        }
    </style>
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
                            <a href="<?php echo U('Admin/Product/index');?>">商品列表</a>
                        </li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<button type="button" tooltip="添加商品" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo U('Admin/Product/add');?>'"> <i class="fa fa-plus"></i> 添加商品
</button>
<div class="row">

    <div class="col-lg-12 col-sm-12 col-xs-12">
    
        <div class="widget">
            <div class="widget-body">
            <!-- 搜索开始 -->
                <div class="widget-body bordered-left bordered-warning">
                    <form class="form-inline" role="form" action="__SELF__" method="post">
                        <div class="form-group">
                            <select name="cate_id">
                                <option value="">所有分类</option>
                                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(I('post.cate_id') == $vo['id']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="yuan_price">
                                <option value="">原价</option>
                                <option value="1" <?php if(I('post.yuan_price') == 1): ?>selected<?php endif; ?>>升序</option>
                                <option value="2" <?php if(I('post.yuan_price') == 2): ?>selected<?php endif; ?>>降序</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="xian_price">
                                <option value="">回馈价</option>
                                <option value="1" <?php if(I('post.xian_price') == 1): ?>selected<?php endif; ?>>升序</option>
                                <option value="2" <?php if(I('post.xian_price') == 2): ?>selected<?php endif; ?>>降序</option>
                            </select>
                        </div>
                       <!--  <div class="form-group">
                           <select name='num'>
                               <option value="">库存</option>
                               <option value="1" <?php if(I('post.num') == 1): ?>selected<?php endif; ?>>升序</option>
                               <option value="2" <?php if(I('post.num') == 2): ?>selected<?php endif; ?>>降序</option>
                           </select>
                       </div> -->

                        <div class="form-group">
                            <select name="create_time">
                                <option value="">创建时间</option>
                                <option value="1" <?php if(I('post.create_time') == 1): ?>selected<?php endif; ?>>升序</option>
                                <option value="2" <?php if(I('post.create_time') == 2): ?>selected<?php endif; ?>>降序</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="is_on">
                                <option value="">是否上架</option>
                                <option value="1" <?php if(I('post.is_on') == 1): ?>selected<?php endif; ?>>上架</option>
                                <option value="2" <?php if(I('post.is_on') == 2): ?>selected<?php endif; ?>>下架</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="开始时间" id="starttime" name="starttime" value="<?php if(I('post.starttime')): echo I('post.starttime'); endif; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="结束时间" id="endtime" name="endtime" value="<?php if(I('post.endtime')): echo I('post.endtime'); endif; ?>">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="起始价格,只能是数字" name="startprice" value="<?php if(I('post.startprice')): echo I('post.startprice'); endif; ?>">
                            <input type="text" class="form-control" placeholder="结束价格,只能是数字" name="endprice" value="<?php if(I('post.endprice')): echo I('post.endprice'); endif; ?>">
                        </div>
                        <br/>
                        <br/>
                        <div class="form-group">
                            <input type="text" class="form-control" size="50" placeholder="商品名称" name="name" value="<?php if(I('post.name')): echo I('post.name'); endif; ?>">
                        </div>
                        <button type="submit" class="btn btn-success">搜索</button>
                    </form>
                </div>
            <!-- 搜索结束 -->
                <div class="flip-scroll">
                    <form action="" method="post">
                    <table class="table table-bordered table-hover">
                        <thead class="ssss">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">所属栏目</th>
                                <th class="text-center">商品名称</th>
                                <th class="text-center">商品封面</th>
                                <th class="text-center">原价</th>
                                <th class="text-center">回馈价</th>
                                <!-- <th class="text-center">库存</th> -->
                                <th class="text-center">商品描述</th>
                                <th class="text-center">是否上架</th>
                                <th class="text-center">创建时间</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center" style="width: 5%;"><?php echo ($vo["id"]); ?></td>
                                <td align="center" style="width: 5%;"><?php echo ($vo["cate"]); ?></td>
                                <td align="left" style="width: 20%;"><?php echo (str_replace(I('post.name'),"<span style='color:red;'>".I('post.name')."</span>",$vo["name"])); ?></td>
                                <td align="center" style="width: 10%;">
                                    <?php if($vo["image"] != false): if(is_array($vo["image"])): $i = 0; $__LIST__ = $vo["image"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v["is_feng"] == 1): ?><img src="<?php echo ($v["url"]); ?>" width="50" height="50"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                        暂无图片<?php endif; ?>
                                </td>
                                <td align="center" style="width: 5%;"><?php echo ($vo["yuan_price"]); ?></td>
                                <td align="center" style="width: 5%;"><?php echo ($vo["xian_price"]); ?></td>
                                <!-- <td align="center" style="width: 5%;"><?php echo ($vo["num"]); ?></td> -->
                                <td align="left" style="width: 20%;"><?php echo (substr($vo["description"],0,30)); ?></td>
                                <td align="center" style="width: 5%;">
                                <?php echo (status($vo["is_on"],U('Admin/Product/editStatus',array('id'=>$vo['id'],'is_on'=>$vo["is_on"]?0:1),''),array('上架','下架'))); ?>
                                </td>
                                <td align="center" style="width: 10%;"><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></td>
                                <td align="center" style="width: 15%;">
                                    <a href="<?php echo U('Admin/Product/num',array('id'=>$vo['id']));?>" class="btn btn-info btn-sm shiny">
                                        <i class="fa fa-arrows"></i>库存量
                                    </a>
                                    <a href="<?php echo U('Admin/Product/edit',array('id'=>$vo['id']));?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <a href="#" onClick="confirmJump('确实要放入回收站吗', '<?php echo U('Admin/Product/editStatus',array('id'=>$vo['id'],'is_on'=>$vo['is_on']?0:0,'is_del'=>$vo['is_del']?0:1));?>')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i>回收站
                                    </a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    </form>
                </div>
                <div style="padding-top:10px;text-align: center;">
                    <div class="pagination">
                        <?php echo ($show); ?>
                    </div>
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
    

    <script src="__PUBLIC__/Other/layui/layui.js"></script>
    
    <script>
    layui.use('laydate', function(){
          var laydate = layui.laydate;
          
          //开始时间
          laydate.render({
            elem: '#starttime'
            ,type: 'datetime'
            ,theme: 'grid'
          });

          //结束时间
          laydate.render({
            elem: '#endtime'
            ,type: 'datetime'
            ,theme: 'grid'
          });
      });
    </script>
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