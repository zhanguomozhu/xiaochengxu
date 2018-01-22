<?php  

//公共函数库

/**
 * 更好的打印
 * @param  [type] $array [description]
 * @return [type]        [description]
 */
function p($array){
	dump($array,1,'<pre>',0);
}



/**
 * api返回数据
 * @param  [type] $status  [状态]
 * @param  [type] $message [提示]
 * @param  array  $data    [数据]
 * @return [type]          [json]
 */
function ajaxShow($code,$msg,$data=array())
{
    return json_encode(array(
        'code'   => $code,
        'msg'    => $msg,
        'data'   => $data,
    ));
}



/**
 * 返回数据
 * @param  [type] $status  [状态]
 * @param  [type] $message [提示]
 * @param  array  $data    [数据]
 * @return [type]          [json]
 */
function show($code,$msg,$data=array())
{
    return array(
        'code'   => $code,
        'msg'    => $msg,
        'data'   => $data,
    );
}





 /**
 * 获取无限分类树
 * @return [type] [默认0，带前缀；1，不带前缀；2，子排序]
 * @return [access] [array,权限判断]
 * @return [type] [description]
 */
function getTree($data,$type=0,$access=null)
{
    switch ($type) {
        case 0:
            return qsort($data);
            break;
        case 1:
            return nsort($data);
            break;
        case 2:
            return ssort($data,0,$access);
            break;
    }
}

/**
 * 排序带前缀
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @return [type]        []
 */
function qsort($data,$pid=0,$level=0)
{
    static $arr = array();
    $depth_html = '';
    foreach ($data as $k => $v) {
        if($v['pid'] == $pid){  
            for ($i=0; $i <$level; $i++) { 
                if($i == 0){
                    $depth_html = '|';
                }
                $depth_html .= '——';
            }
            $v['name'] = $depth_html.$v['name'];
            $arr[] = $v;
            qsort($data,$v['id'],$level+1);
        }
    }
    
    return $arr;
}


 /**
 * 排序不带前缀
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @return [type]        []
 */
function nsort($data,$pid=0)
{
    static $arr = array();
    foreach ($data as $k => $v) {
        if($v['pid'] == $pid){  
            $arr[] = $v;
            nsort($data,$v['id']);
            
        }
    }
    return $arr;
}



 /**
 * 子排序
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @param  array $access [节点字符串]判断是否有权限
 * @return [type]        []
 */
function ssort($data,$pid=0,$access=null)
{

    $arr = array();
    foreach ($data as $v) {
        if(is_array($access)){
            $v['access'] = in_array($v['id'],$access) ? 1 : 0;
        }
        if($v['pid'] == $pid){ 
        	$v['child'] =ssort($data,$v['id'],$access); 
            $arr[] = $v;
        }
    }
    return $arr;
}




/**
 * 根据子分类id获取所有父级分类
 * @param  [type] $data [description]
 * @param  [type] $id   [description]
 * @param  [type] $id   [需要取的字段]
 * @param  [type] $sort [排序，默认0从小到大]
 * @return [type]       [description]
 */
function getParents($data,$id,$filed=null,$sort=0){
    static $array = array();
    foreach ($data as $v) {
        if($v['id'] == $id){
            $array[] = $filed ? $v[$filed] : $v;//获取所有数据
            getParents($data,$v['pid'],$filed);
        }
    }
    //翻转数组
    if($sort){
        $array = array_reverse($array);
    }
    return $array;
}



/**
 * 根据子父级分类id获取所有子级分类
 * @param  [type] $data [description]
 * @param  [type] $id   [description]
 * @param  [type] $id   [需要取的字段]
 * @param  [type] $sort [排序，默认0从小到大]
 * @return [type]       [description]
 */
function getSons($data,$pid,$filed=null,$sort=0){
    static $array = array();
    foreach ($data as $v) {
        if($v['pid'] == $pid){
            $array[] = $filed ? $v[$filed] : $v;//获取所有数据
            getSons($data,$v['id'],$filed);
        }
    }
    //翻转数组
    if($sort){
        $array = array_reverse($array);
    }
    return $array;
}



/**
 * 上传文件类型控制   此方法仅限ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler       返回ajax的json格式数据
 */
function upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Uploads/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,               //上传文件最大为50M
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveRule'  =>  'uniqid',               //上传文件的保存规则
                'subType'   =>  'date',                 // 子目录创建方式 可以使用hash date custom
                'dateFormat'=>  'Ymd',                  // 子目录命名规则
                'autoSub'   =>  true,                   //自动使用子目录保存上传文件 默认为true
                'allowExts' =>  isset($ext_arr[$format])?$ext_arr[$format]:'',// 允许上传的文件后缀 留空不作后缀检查
            );
        // 实例化上传
        import('ORG.Net.UploadFile');
        $upload = new UploadFile($config);

        $data=array();
        // 调用上传方法
        if(!$upload->upload()) {// 上传错误提示错误信息
            $error = $upload->getErrorMsg();
            $data['error'] = $error;
            echo ajaxShow(2000,'上传失败',$data);
        }else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
            //返回成功信息 
            foreach($info as $file){
                $data['path']=$file['savepath'].$file['savename'];
                echo ajaxShow(1000,'上传成功',$data);
            }
        }
    }else{
        echo ajaxShow(2001,'没有图片上传');
    }
}



/**
 * 上传文件类型控制 此方法仅限webuploader插件  ajax上传使用
 * @param  string   $path    字符串 保存文件路径示例： /Upload/image/
 * @param  string   $format  文件格式限制
 * @param  integer  $maxSize 允许的上传文件最大值 52428800
 * @return booler   返回ajax的json格式数据
 */
function ajax_upload($path='file',$format='empty',$maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path,'/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0,6))==='upload' ? ucfirst($path) : 'Uploads/'.$path;
    // 上传文件类型控制
    $ext_arr= array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'photo' => array('jpg', 'jpeg', 'png'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2','pdf')
        );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
                'maxSize'   =>  $maxSize,               //上传文件最大为50M
                'savePath'  =>  './'.$path.'/',         //文件上传的保存路径（相对于根路径）
                'saveRule'  =>  'uniqid',               //上传文件的保存规则
                'subType'   =>  'date',                 // 子目录创建方式 可以使用hash date custom
                'dateFormat'=>  'Ymd',                  // 子目录命名规则
                'autoSub'   =>  true,                   //自动使用子目录保存上传文件 默认为true
                'allowExts' =>  isset($ext_arr[$format])?$ext_arr[$format]:'',// 允许上传的文件后缀 留空不作后缀检查
            );
        // 实例化上传
        import('ORG.Net.UploadFile');
        $upload = new UploadFile($config);

        $data=array();
        // 调用上传方法
        if(!$upload->upload()) {// 上传错误提示错误信息
            $error = $upload->getErrorMsg();
            $data['error_info'] = $error;
            echo json_encode($data);
        }else{// 上传成功 获取上传文件信息
            $info =  $upload->getUploadFileInfo();
            //返回成功信息 
            foreach($info as $file){
                $data['name']=$file['savepath'].$file['savename'];
                echo json_encode($data);
            }
        }
    }else{
        $data['error_info'] = '没有图片上传';
        echo json_encode($data);
    }
}
 


/**
 * 创建缩略图
 * @param  [type] $path [图片路径]
 * @return [type]       [description]
 */
function makeThumb($path){
    $base = explode('/',$path);
    $filename = $base[count($base)-1];//获取图片名
    unset($base[count($base)-1]);
    $filepath = implode('/',$base);//获取图片路径
    //压缩图片1080,500,375,275 thumb($image, $thumbname, $type='', $maxWidth=200, $maxHeight=50, $interlace=true)
    import('ORG.Util.Image');//引入图片类
    $imgSize = C('IMG_SIZE');
    $thumImg = array();
    foreach ($imgSize as $v) {
        $thumImg[] = Image::thumb($path,$filepath.'/'.$v[0].'_'.$filename,'',$v[0],$v[1]);
    }
    return $thumImg;
}
