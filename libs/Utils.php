<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Utils
{
	
    /**
     * 输出相对首页路由，本方法会自适应伪静态，用于动态文件
     */
    public static function index($path = '')
    {
        Helper::options()->index($path);
    }

    /**
     * 输出相对首页路径，本方法用于静态文件
     */
    public static function indexHome($path = '')
    {
        Helper::options()->siteUrl($path);
    }

    /**
     * 输出相对主题目录路径，用于静态文件
     */
    public static function indexTheme($path = '')
    {
        Helper::options()->themeUrl($path);
    }

    /**
     * 判断插件是否可用（存在且已激活）
     */
    public static function hasPlugin($name) 
    {
        $plugins = Typecho_Plugin::export();
        $plugins = $plugins['activated'];
        return is_array($plugins) && array_key_exists($name, $plugins);
    }

    /**
     * 判断移动端请求
     */
    public static function isMobile()
    { 
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
            return TRUE;
        }
        
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array ('mobile','nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap'
                ); 
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
                return TRUE;
            }
        }
        if (isset ($_SERVER['HTTP_ACCEPT'])){
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))){
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * 判定内容是否过时
     * 
     * @return array
     */
    public static function isOutdated($archive)
    {
        date_default_timezone_set("Asia/Shanghai");
        $created = round((time()- $archive->created) / 3600 / 24);
        $updated = round((time()- $archive->modified) / 3600 / 24);
        return array("is" => $created > 90,
                    "created" => $created,
                    "updated" => $updated);
    }
	
	/**
     * 编辑界面添加内容
     */
    public static function addButton(){
		echo '<link rel="stylesheet" href="/usr/themes/Miracles/assets/css/setting.miracles.css" />';
		echo '<link rel="stylesheet" href="/usr/themes/Miracles/assets/css/owo.min.css" />';
		echo '<script src="/usr/themes/Miracles/assets/js/OwO.min.js"></script>';
		echo '<script src="/usr/themes/Miracles/assets/js/editor.js"></script>';
		echo '<style>#custom-field textarea{width:100%}
        .OwO span{background:none!important;width:unset!important;height:unset!important}
        .OwO .OwO-logo{
            z-index: unset!important;
        }
        .OwO .OwO-body .OwO-items{
            -webkit-overflow-scrolling: touch;
            overflow-x: hidden;
        }
        .OwO .OwO-body .OwO-items-image .OwO-item{
            max-width:-moz-calc(20% - 10px);
            max-width:-webkit-calc(20% - 10px);
            max-width:calc(20% - 10px)
        }
		#wmd-owo-button:hover{
		background:transparent!important}
        @media screen and (max-width:760px){
            .OwO .OwO-body .OwO-items-image .OwO-item{
                max-width:-moz-calc(25% - 10px);
                max-width:-webkit-calc(25% - 10px);
                max-width:calc(25% - 10px)
            }
        }</style>';
    }

    /**
     * 自动生成引用
     */
    public static function addRequires($files,$type,$cdn,$custom) {
        if ($cdn=='1'){
            $path = 'https://cdn.jsdelivr.net/gh/BigCoke233/miracles@'.themeVersion()."/assets/";
	    }
	    elseif ($cdn=='2'){
	        $path = 'https://raw.githack.com/BigCoke233/miracles/master/assets/';
	    }
	    elseif ($cdn=='4'){
		    $path = 'https://rawcdn.githack.com/BigCoke233/miracles/master/assets/';
	    }
	    elseif ($cdn=='5'){
		    $path = 'https://cdn.9jojo.cn/Miracles/'.themeVersion().'/';
	    }
	    elseif ($cdn=='3'){
		    $path = $custom;
	    }else{
		    $path = Helper::options()->themeUrl("","Miracles/assets");
	    }
        foreach ($files as $file) {
            if ($type == "js"){
                echo "<script src=".$path. $type."/".$file.".".$type."></script>";
		    }
            elseif ($type == "css"){
                echo "<link rel=\"stylesheet\" href=".$path. $type."/".$file.".".$type." />";
		    }
        }
    }

    /**
     * 获取最早文章创建时间
     */
    public static function getOldestPostDate() {
        $db = Typecho_Db::get();
        $content = $db->fetchRow($db->select()->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.password IS NULL')
            ->order('table.contents.created', Typecho_Db::SORT_ASC)
            ->limit(1));
        echo '一切开始于 '.date('Y-m-d', $content['created']);
    }

    /**
     * 缩略图
     */
    public static function postBanner($post){
		if($post->fields->banner && $post->fields->banner=!''): 
			$banner = $post->fields->banner; 
		else: 
			if($post->options->randomBanner==''){
                $banner = '/usr/themes/Miracles/images/postbg/';
                $banner .= srand(mb_strlen($post->title));
                $banner .= rand(1,15).'.jpg';
		    }
		    else{
		        $banner_url = explode(',',$post->options->randomBanner);
                $banner = $banner_url[mt_rand(0,count($banner_url)-1)].'\"';
            }
        endif;
        //使用 TimThumb 剪裁
        if($GLOBALS['miraclesIfTimThumb']=='on') {
            if($GLOBALS['miraclesIfTimThumbSize']=='regular'){
                $banner_size = '&h=336&w=564';
            }
            elseif($GLOBALS['miraclesIfTimThumbSize']=='big'){
                $banner_size = '&h=420&w=705';
            }
            elseif($GLOBALS['miraclesIfTimThumbSize']=='large'){
                $banner_size = '&h=504&w=846';
            }
            elseif($GLOBALS['miraclesIfTimThumbSize']=='huge'){
                $banner_size = '&h=560&w=940';
            }
            else{
                //避免有憨憨打错单词，当成 big 来算
                $banner_size = '&h=420&w=705';
            }
            $banner_url = '/usr/themes/Miracles/libs/TimThumb.php';
            $banner = $banner_url.'?src='.$banner.$banner_size;
        }

        echo $banner;
    }
}