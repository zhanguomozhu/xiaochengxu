<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>编辑商品</title>

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
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <style type="text/css">
        li{list-style-type:none;}
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
                        <a href="<?php echo U('Index/Index/index');?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo U('Admin/Product/index');?>">商品列表</a>
                    </li>
                    <li class="active">编辑商品</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="widget">
                            <div class="widget-header bordered-bottom bordered-blue">
                                <span class="widget-caption">编辑商品</span>
                            </div>
                            <div class="widget-body">
                                <div id="horizontal-form">
                                    <form class="form-horizontal" role="form" action="<?php echo U('Admin/Product/edit');?>" method="post">
                                        <input type="hidden" name="id" value="<?php echo ($product["id"]); ?>">
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">所属分类</label>
                                            <div class="col-sm-2">
                                                <select name='cate_id'>
                                                    <option value="0">顶级分类</option>
                                                    <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo["id"] == $product['cate_id']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">商品名称</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" placeholder="最多120个字符" name="name" required="" type="text" value="<?php echo ($product['name']); ?>">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">商品类型</label>
                                            <div class="col-sm-6">
                                                <select name='type_id'>
                                                    <option>请选择</option>
                                                    <?php if(is_array($types)): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($product['type_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select>
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>

                                        <div class="form-group" id='attr_list' <?php if(count($product['attr']) == 0): ?>style="display: none;"<?php endif; ?>>
                                            <label for="username" class="col-sm-2 control-label no-padding-right">属性选择</label>
                                            <div class="col-sm-6">

                                                <ul style="border: 1px solid #e6e6e6;padding: 3px 0px;">

                                                </ul>
                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">原价</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" placeholder="格式0.00" name="yuan_price" required="" type="text" value="<?php echo ($product['yuan_price']); ?>">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>


                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">回馈价</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" placeholder="格式0.00" name="xian_price" required="" type="text" value="<?php echo ($product['xian_price']); ?>">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>


                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">是否上架</label>
                                            <div class="col-sm-2">
                                                <select name='is_on'>
                                                    <option value="1" <?php if($product['is_on'] == 1): ?>selected<?php endif; ?>>上架</option>
                                                    <option value="0" <?php if($product['is_on'] == 0): ?>selected<?php endif; ?>>下架</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">预览图片</label>
                                            <div class="col-sm-6">
                                               <div style="width:100%;height:125px;border: 3px dashed #e6e6e6;padding: 5px 5px;">
                                                   <?php if(is_array($product["image"])): $i = 0; $__LIST__ = $product["image"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><img src="<?php echo ($vo["url"]); ?>" width="110" height="110"><?php endforeach; endif; else: echo "" ;endif; ?>
                                               </div>
                                           </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">商品图片</label>
                                            <div class="col-sm-6">
                                               <!--引入样式jq-->
<link rel="stylesheet" href="__PUBLIC__/Other/webuploader-0.1.5/xb-webuploader.css">
<style type="text/css">
    .xb-uploader{border: 3px dashed #e6e6e6;padding-top: 10px;}
    .filelist li{margin-left: 2px;}
</style>

<!-- 引入html -->
<div id="upload-5a4094e3904bd" class="xb-uploader">
    <div class="queueList">
        <div class="placeholder">
            <div class="filePicker"></div>
            <p>或将照片拖到这里，最多可选5张,默认第一张为封面图</p>
        </div>
    </div>
    <div class="statusBar" style="display:none;">
        <div class="progress">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
        <div class="btns">
            <div class="webuploader-container filePicker2">
                <div class="webuploader-pick">继续添加</div>
                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                </div>
            </div>
            <div class="uploadBtn">开始上传</div>
        </div>
    </div>
</div>

<!-- 引入webupload.js主文件 -->
<script>
    var BASE_URL = "__PUBLIC__/Other/webuploader-0.1.5";
</script>
<script src="__PUBLIC__/Other/webuploader-0.1.5/webuploader.min.js"></script>

<!-- 引入webupload.js配置 -->
<script>
jQuery(function() {
    var $ = jQuery,    // just in case. Make sure it's not an other libaray.

        $wrap = $("#upload-5a4094e3904bd"),

        // 图片容器
        $queue = $('<ul class="filelist"></ul>')
            .appendTo( $wrap.find('.queueList') ),

        // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find('.statusBar'),

        // 文件总体选择信息。
        $info = $statusBar.find('.info'),

        // 上传按钮
        $upload = $wrap.find('.uploadBtn'),

        // 没选择文件之前的内容。
        $placeHolder = $wrap.find('.placeholder'),

        // 总体进度条
        $progress = $statusBar.find('.progress').hide(),

        // 添加的文件数量
        fileCount = 0,

        // 添加的文件总大小
        fileSize = 0,

        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,

        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        // 所有文件的进度信息，key为file id
        percentages = {},

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                      'WebkitTransition' in s ||
                      'MozTransition' in s ||
                      'msTransition' in s ||
                      'OTransition' in s;
            s = null;
            return r;
        })(),
        thisSuccess,
        // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: "#upload-5a4094e3904bd .filePicker",
            label: '点击选择文件',
            multiple : true
        },
        dnd: "#upload-5a4094e3904bd .queueList",
        paste: document.body,
        // accept: {
        //     title: 'Images',
        //     extensions: 'gif,jpg,jpeg,bmp,png',
        //     mimeTypes: 'image/*'
        // },

        // swf文件路径
        swf: BASE_URL + '/Uploader.swf',

        disableGlobalDnd: true,

        chunked: true,//是否要分片处理大文件上传。
        server: "<?php echo U('Admin/Product/ajax_upload');?>",//服务器地址
        fileNumLimit: 5,//文件上传个数
        fileSizeLimit: 200 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 添加“添加文件”的按钮，
    uploader.addButton({
       id: "#upload-5a4094e3904bd .filePicker2",
       label: '继续添加'
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var $li = $( '<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '<input class="bjy-filename" type="hidden" name="image[]">'+
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            $wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $wrap.text( '不能预览' );
                    return;
                }

                var img = $('<img src="'+src+'">');
                $wrap.empty().append( img );
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                $prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                $li.off( 'mouseenter mouseleave' );
                $btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                $info.remove();
                $prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                $li.append( '<span class="success"></span>' );
            }

            $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
        });

        $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
        });

        $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // $({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        $li.appendTo( $queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var $li = $('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = $progress.children(),
            percent;

        $.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;

        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if ( state === 'ready' ) {
            text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '个文件，'+
                    stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '个';
            }
            if (fileCount==stats.successNum && stats.successNum!=0) {
                $('#upload-5a4094e3904bd .webuploader-element-invisible').remove();
            }
        }

        $info.html( text );
    }

    uploader.onUploadAccept=function(object ,ret){
        if(ret.error_info){
            fileError=ret.error_info;
            return false;
        }
    }

    uploader.onUploadSuccess=function(file ,response){
        $('#'+file.id +' .bjy-filename').val(response.name)
    }
    uploader.onUploadError=function(file){
        alert(fileError);
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        $upload.removeClass( 'state-' + state );
        $upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':
                $placeHolder.removeClass( 'element-invisible' );
                $queue.parent().removeClass('filled');
                $queue.hide();
                $statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass( 'element-invisible' );
                $( "#upload-5a4094e3904bd .filePicker2" ).removeClass( 'element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                $( "#upload-5a4094e3904bd .filePicker2" ).addClass( 'element-invisible' );
                $progress.show();
                $upload.text( '暂停上传' );
                break;

            case 'paused':
                $progress.show();
                $upload.text( '继续上传' );
                break;

            case 'confirm':
                $progress.hide();
                $upload.text( '开始上传' ).addClass( 'disabled' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function( file, percentage ) {
        var $li = $('#'+file.id),
            $percent = $li.find('.progress span');

        $percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
        }

        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;

        }
    });

    uploader.onError = function( code ) {
    	if(code === 'F_DUPLICATE'){
			alert('不能重复上传同一张图片');
    	}else{
			alert( 'Eroor: ' + code );
    	}
    		
        
    };

    $upload.on('click', function() {
        if ( $(this).hasClass( 'disabled' ) ) {
            return false;
        }

        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    $info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    $info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    $upload.addClass( 'state-' + state );
    updateTotalProgress();
});
</script>
                                            </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="username" class="col-sm-2 control-label no-padding-right">商品描述</label>
                                            <div class="col-sm-6">
                                               <!-- 加载编辑器的js -->
<script src="__PUBLIC__/Other/ueditor/ueditor.config.js"></script>
<script src="__PUBLIC__/Other/ueditor/ueditor.all.js"></script>
<script src="__PUBLIC__/Other/ueditor/lang/zh-cn/zh-cn.js"></script>

<!-- 加载编辑器的容器 -->
<script id="container" name="description" type="text/plain"><?php echo ($product['description']); ?></script>

<!-- 实例化编辑器代码 -->
<script>
    var um = UE.getEditor('container',{
        initialFrameWidth:"100%",
        initialFrameHeight:300,
        toolbars: [[
            'fullscreen',  'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
            'horizontal', 'date', 'time', 'spechars', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
             'searchreplace', 'drafts'
        ]],
        autoHeightEnabled:false,
        catchRemoteImageEnable:true
    });
</script>
                                           </div>
                                            <p class="help-block col-sm-4 red">* 必填</p>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success">保存信息</button>
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

    <script src="__PUBLIC__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script src="__PUBLIC__/style/beyond.js"></script>
     <script type="text/javascript">
        $(function(){
            //默认商品类型id
            var typeId = "<?php echo ($product['type_id']); ?>";
            //商品属性数据
            attrDate = <?php echo json_encode($product['attr']);?>;
            console.log(typeId);
            console.log(attrDate);
            //请求类型数据
            ajaxPost(typeId);


        })

        //选择器change事件
        $('select[name=type_id]').change(function(){
            //获取选择的类型id
            var typeId1 = "<?php echo ($product['type_id']); ?>";
            var typeId2 = $(this).val();
            if(typeId1 == typeId2){
                ajaxPost(typeId2);
            }else{
                ajaxPost1(typeId2);
            }
            
        })


        //change事件
        function ajaxPost1(typeId){
            //ajax请求类型属性数据
            $.ajax({
                type:'post',
                url:"<?php echo U('Admin/Product/ajaxGetAttr');?>",
                data:{'type_id':typeId},
                dataType:'json',
                success:function(res){
                    console.log(res)
                    //循环属性
                    var li = '';
                    $(res).each(function(k,v){

                        li += '<li class="tab-purple" style="margin:3px 0px;">';
                        //如果是可选,
                        if(v.attr_type == '可选'){
                            console.log(v.attr_option_values)
                            li += '<a href="javascript:void(0);" onClick="addNewAttr(this)">（<i type="+" class="fa fa-plus-circle"></i>）</a>'+v.attr_name + '：';
                        }else{
                            li += '<a href="javascript:void(0);">（<i type="+" class="fa fa-edit"></i>）</a>'+v.attr_name + '：';
                        }
                        //属性可选值，有下拉框，无文本框
                        if(!v.attr_option_values || v.attr_option_values==''){
                            li += '<input style="height:34px;" type="text" name="attr_value['+v.id+'][]" />';
                        }else{
                            li += '<select name="attr_value['+v.id+'][]"><option value="">请选择</option>';
                            //把可选值转换成数组
                            var _attr = v.attr_option_values.split(',');
                            //循环
                            for(var i=0;i<_attr.length;i++){
                                li += '<option value="'+_attr[i]+'">';
                                li += _attr[i];
                                li += '</option>';
                            }
                            li += '</select>';
                        }
                        
                        li += '</li>';
                    });
                    //插入节点
                    $("#attr_list").css('display','block');
                    $("#attr_list ul").html(li);
                }
            })
        }


        //默认商品属性ajax函数
        function ajaxPost(typeId){
            arr = [];
             //ajax请求类型属性数据
            $.ajax({
                type:'post',
                url:"<?php echo U('Admin/Product/ajaxGetAttr');?>",
                data:{'type_id':typeId},
                dataType:'json',
                success:function(res){
                    console.log(res)
                    //循环属性
                    var li = '';
                    var attIds = [];//此商品属性类型id组合
                    for(var j=0;j<attrDate.length;j++){
                        if($.inArray(attrDate[j].attr_id, attIds) == -1){
                            attIds.push(attrDate[j].attr_id);//插入类型id
                        }
                    };
                    for(var i=0;i<res.length;i++){
                        if($.inArray(res[i].id, attIds) == -1){
                            res[i].arr = res[i];
                            attrDate.push(res[i]);//插入最新类型数据
                        }
                    };
                    //console.log(attrDate);
                    $(attrDate).each(function(k,v){
                        for(var j=0;j<res.length;j++){
                            //如果属性的attr_id等于类型Id
                            if(v.attr_id == res[j].id){
                                //把属性插入类型数组
                                res[j].arr = v;
                                //翻转
                                v=res[j];
                            }
                        }
                         //console.log(attrDate);
                         console.log(v);
                        li += '<li class="tab-purple" style="margin:3px 0px;">';
                        //如果是可选,
                        if(v.attr_type == '可选'){
                            var type = '';
                            var css = '';
                            //若果v.id在arr数组里，证明已经插入过节点
                            if($.inArray(v.id, arr) == -1){
                                css = 'fa-plus-circle';
                                type = '+';
                                arr.push(v.id);
                            }else{
                                css = 'fa-minus-circle';
                                type = '-';
                            }

                            console.log(v.attr_option_values)
                            li += '<a href="javascript:void(0);" onClick="addNewAttr(this)">（<i type="'+type+'" class="fa '+css+'"></i>）</a>'+v.attr_name + '：';
                        }else{
                            li += '<a href="javascript:void(0);">（<i type="'+type+'" class="fa fa-edit"></i>）</a>'+v.attr_name + '：';
                        }
                        //属性可选值，有下拉框，无文本框
                        if(!v.attr_option_values || v.attr_option_values==''){
                            li += '<input style="height:34px;" type="text" name="attr_value['+v.id+'_'+v.arr.id+'_'+v.arr.attr_value+'][]" value="'+v.arr.attr_value+'" />';
                        }else{
                            
                            li += '<select name="attr_value['+v.id+'_'+v.arr.id+'_'+v.arr.attr_value+'][]"><option value="">请选择</option>';
                            //把可选值转换成数组
                            var _attr = v.attr_option_values.split(',');
                            //循环
                            for(var i=0;i<_attr.length;i++){
                                if(_attr[i] == v.arr.attr_value){
                                    li += '<option value="'+_attr[i]+'" selected>'+_attr[i]+'</option>';
                                }else{
                                    li += '<option value="'+_attr[i]+'">'+_attr[i]+'</option>';
                                }
                            }
                            li += '</select>';
                        }
                        
                        li += '</li>';
                    });
                    // console.log(attrDate);
                    //插入节点
                    $("#attr_list").css('display','block');
                    $("#attr_list ul").html(li);
                }
            })
        }


        //获取两个数组的差集

        function arr_diff(arr1, arr2) {
            var len = arr1.length;
            var arr = [];
            while (len--) {
                if (arr2.indexOf(arr1[len]) < 0) {
                    arr.push(arr1[len]);
                }
            }
            return arr;
        };


        //点击添加节点
        function addNewAttr(a){
            var li = $(a).parent();
            var newLi = li.clone();
            if(li.find('i').attr('type') == '+'){
                //加号变减号
                newLi.find('i').removeClass('fa-plus-circle').addClass('fa-minus-circle').attr('type','-');
                //var newName = newLi.find('select').attr('name').substring(0,14);
                //console.log(newName);
                //newLi.find('select').attr('name',newName+'[0]');

                li.after(newLi);
            }else{
                li.remove();
            }
            
        }
    </script>

</body></html>