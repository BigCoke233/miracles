<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
/**
 * Miracles 核心文件
 */

require_once("themeConfig.php");
require_once("libs/Utils.php");
require_once("libs/Contents.php");
require_once("libs/Comments.php");
require_once("libs/Options.php");
require_once("libs/Language.php");
require_once('libs/TableContents.php');
//引入语言文件
require_once("libs/lang/".$GLOBALS['miraclesLang'].".php");

/**
 * 注册文章解析 hook
 * From AlanDecode(https://imalan.cn)
 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Contents','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Contents','parseContent');
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Utils', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Utils', 'addButton');

/**
 * 主题启用时执行的方法
 */
function themeInit($archive) {
    if ($archive->hidden) header('HTTP/1.1 200 OK');//暴力解决访问加密文章会被 pjax 刷新页面的问题
    //Helper::options()->commentsAntiSpam = false; 关闭反垃圾
	Helper::options()->commentsHTMLTagAllowed = '<a href=""> <img src=""> <img src="" class=""> <code> <del>';
    Helper::options()->commentsMaxNestingLevels = '9999';//最大嵌套层数
    Helper::options()->commentsPageDisplay = 'first';//强制评论第一页
    Helper::options()->commentsOrder = 'DESC';//将最新的评论展示在前
    Helper::options()->commentsCheckReferer = false;//关闭检查评论来源URL与文章链接是否一致判断(否则会无法评论)
    //将设置储存到全局变量以便使用
    $GLOBALS['miraclesOptions_randomBanner'] = Helper::options()->randomBanner;
    $GLOBALS['miraclesOptions_CDN'] = Helper::options()->CDN;
    $GLOBALS['miraclesOptions_loading_image'] = Helper::options()->loading_image;
}

/**
 * 文章与独立页自定义字段
 */
function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, NULL,_t('文章头图'), _t('输入一个图片 url，作为缩略图显示在文章列表，没有则不显示'));
    $layout->addItem($banner);
	$excerpt = new Typecho_Widget_Helper_Form_Element_Text('excerpt', NULL, NULL,_t('文章摘要'), _t('输入一段文本来自定义摘要，如果为空则自动提取文章前 130 字。'));
    $layout->addItem($excerpt);
	$meta = new Typecho_Widget_Helper_Form_Element_Text('meta', NULL, NULL,_t('元信息'), _t('页面/文章内页会显示该页面的评论数和创建日期（元信息），如果你不需要，可以写一段文字来代替这些内容。'));
    $layout->addItem($meta);
	$commentShow = new Typecho_Widget_Helper_Form_Element_Select('commentShow',array('0'=>'显示','1'=>'隐藏'),'0','是否显示评论列表');
    $layout->addItem($commentShow);
}

/**
 * 获取主题版本号
 */
function themeVersion() {
    $info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');
    return $info['version'];
}