<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
require_once("libs/Utils.php");
require_once("libs/Contents.php");
require_once("libs/Options.php");

//指定时区
date_default_timezone_set("Asia/Shanghai");

/**
 * 注册文章解析 hook
 * 具体的解析代码需要在 Contents::parseContent() 方法中实现
 * 解析不会改变数据库中的内容，体现在文章前台输出、RSS 输出时
 * From AlanDecode(https://imalan.cn)
 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Contents','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Contents','parseContent');

/**
 * 主题启用时执行的方法
 */
function themeInit() {
    $db = Typecho_Db::get();
    
    $query = $db->update('table.options')->rows(array('value'=>'0'))->where('name=?', 'commentsAntiSpam');
    $db->query($query);
    $query = $db->update('table.options')->rows(array('value'=>'0'))->where('name=?', 'commentsCheckReferer');
    $db->query($query);

    /* 设置评论最大嵌套层数 */
    $query = $db->update('table.options')->rows(array('value'=>'999'))->where('name=?', 'commentsMaxNestingLevels');
    $db->query($query);

    /* 强制新评论在前 */
    $query = $db->update('table.options')->rows(array('value'=>'DESC'))->where('name=?', 'commentsOrder');
    $db->query($query);

    /* 默认显示第一页评论 */
    $query = $db->update('table.options')->rows(array('value'=>'first'))->where('name=?', 'commentsPageDisplay');
    $db->query($query);
}

/**
 * 文章与独立页自定义字段
 */
function themeFields(Typecho_Widget_Helper_Layout $layout) {
    $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, NULL,_t('文章头图'), _t('输入一个图片 url，作为缩略图显示在文章列表，没有则不显示'));
    $layout->addItem($banner);
	
	$excerpt = new Typecho_Widget_Helper_Form_Element_Text('excerpt', NULL, NULL,_t('文章摘要'), _t('输入一段文本来自定义摘要，如果为空则自动提取文章前 130 字。'));
    $layout->addItem($excerpt);
}

/**
 * 获取主题版本号
 */
function themeVersion() {
 $info = Typecho_Plugin::parseInfo(__DIR__ . '/index.php');
 return $info['version'];
}
