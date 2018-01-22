<?php if (!defined('THINK_PATH')) exit();?><ul>
	<li>测试组件助手</li>
	<ul>
		<?php if(is_array($cate)): foreach($cate as $key=>$vo): ?><a href="<?php echo U('/cate/'.$vo['id']);?>"><li><?php echo ($vo["name"]); ?></li></a><?php endforeach; endif; ?>
		
	</ul>
</ul>