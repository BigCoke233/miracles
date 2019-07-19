<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
require_once("libs/Utils.php");
require_once("libs/Contents.php");

/**
 * 注册文章解析 hook
 * 具体的解析代码需要在 Contents::parseContent() 方法中实现
 * 解析不会改变数据库中的内容，体现在文章前台输出、RSS 输出时
 */
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Contents','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Contents','parseContent');

/**
 * 主题启用时执行的方法
 */
function themeInit() {
    /**
     * 重置某些设置项，采用数据库查询方式完成
     */
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
 * 主题后台设置
 */
function themeConfig($form) {
    //nav
	$nav_position = new Typecho_Widget_Helper_Form_Element_Select('nav_position',array('0'=>'不固定','1'=>'固定'),'0','导航栏-是否固定','固定后，导航栏不会随滚动条滚动而移动在屏幕上的位置');
    $form->addInput($nav_position);
	
	//index-banner
	$bannerUrl = new Typecho_Widget_Helper_Form_Element_Text('bannerUrl', NULL, 'https://s2.ax1x.com/2019/07/10/ZcRGX8.png', _t('首页大图-地址'), _t('首页大图的图片地址'));
    $form->addInput($bannerUrl);
	$bannerHeight = new Typecho_Widget_Helper_Form_Element_Text('bannerHeight', NULL, '60', _t('首页大图-高度'), _t('首页大图所占屏幕的高度，100为最大，填入纯数字，如"35"'));
    $form->addInput($bannerHeight);
	$bannerTitle = new Typecho_Widget_Helper_Form_Element_Text('bannerTitle', NULL, NULL, _t('首页大图-标题'), _t('这里是首页大图显示的的标题'));
    $form->addInput($bannerTitle);
	$bannerIntro = new Typecho_Widget_Helper_Form_Element_Text('bannerIntro', NULL, NULL, _t('首页大图-介绍'), _t('这里是首页大图标题下的简介'));
    $form->addInput($bannerIntro);
	
	//custom
	$headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中'));
    $form->addInput($headerEcho);
	$footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义页脚部信息'), _t('填写 html 代码，将输出在页脚的版权信息后'));
    $form->addInput($footerEcho);
	$cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $form->addInput($cssEcho);
	$jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $form->addInput($jsEcho);
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