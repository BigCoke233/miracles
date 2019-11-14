<?php
/**
 * 主题后台设置
 */
function themeConfig($form) {

	/**
	 *  主题设置备份 
	 *  From https://qqdie.com/archives/typecho-templates-backup-and-restore.html
	 */
	$db = Typecho_Db::get();
    $sjdq=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:Miracles'));
    $ysj = $sjdq['value'];
    if(isset($_POST['type'])){ 
      if($_POST["type"]=="备份模板数据"){
        if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:MiraclesBackup'))){
          $update = $db->update('table.options')->rows(array('value'=>$ysj))->where('name = ?', 'theme:MiraclesBackup');
          $updateRows= $db->query($update);
          echo '<div class="miracles-backup-alert">备份已更新，请等待自动刷新！如果等不到请点击';
?><a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php }else{
    if($ysj){
      $insert = $db->insert('table.options')
      ->rows(array('name' => 'theme:MiraclesBackup','user' => '0','value' => $ysj));
      $insertId = $db->query($insert);
      echo '<div class="miracles-backup-alert">备份完成，请等待自动刷新！如果等不到请点击';
?><a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
    }
    }
        }
    if($_POST["type"]=="还原模板数据"){
    if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:MiraclesBackup'))){
    $sjdub=$db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:MiraclesBackup'));
    $bsj = $sjdub['value'];
    $update = $db->update('table.options')->rows(array('value'=>$bsj))->where('name = ?', 'theme:Miracles');
    $updateRows= $db->query($update);
    echo '<div class="miracles-backup-alert">检测到模板备份数据，恢复完成，请等待自动刷新！如果等不到请点击';
?><a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2000);</script>
<?php
    }else{
    echo '<div class="miracles-backup-alert">没有模板备份数据，恢复不了哦！</div>';
    }
    }
    if($_POST["type"]=="删除备份数据"){
      if($db->fetchRow($db->select()->from ('table.options')->where ('name = ?', 'theme:MiraclesBackup'))){
        $delete = $db->delete('table.options')->where ('name = ?', 'theme:MiraclesBackup');
        $deletedRows = $db->query($delete);
        echo '<div class="miracles-backup-alert">删除成功，请等待自动刷新，如果等不到请点击';
?><a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php
    }else{
      echo '<div class="miracles-backup-alert">不用删了！备份不存在！！！</div>';
    }
  }
}

    /**
	 *  设置样式+面板
	 */
	$ver = themeVersion();
	 
	echo '<link rel="stylesheet" href="/usr/themes/Miracles/assets/css/setting.miracles.css"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:300|Noto+Serif+SC:300&display=swap" rel="stylesheet">';
	echo '<div class="miracles-pannel">
	<h1>Miracles 主题设置面板</h1>
	<p>欢迎使用 Miracles 主题，目前版本是：'. $ver .'<br>
	作者博客：<a href="https://guhub.cn">Eltrac\'s</a> | 帮助文档：<a href="https://github.com/BigCoke233/miracles/wiki">WIKI</a> | 问题反馈：<a href="https://github.com/BigCoke233/miracles/issues">issues</a>
	</p>
   	  <form class="protected" action="?MiraclesBackup" method="post">
        <input type="submit" name="type" class="miracles-backup-button backup" value="备份模板数据" />&nbsp;&nbsp;
	    <input type="submit" name="type" class="miracles-backup-button recover" value="还原模板数据" />&nbsp;&nbsp;
	    <input type="submit" name="type" class="miracles-backup-button delete" value="删除备份数据" />
	  </form>
	</div>';
	
	/**
	 *  设置项
	 */
	//首要设置项
	$news = new Typecho_Widget_Helper_Form_Element_Text('news', NULL, NULL, _t('<h2>首要设置 First</h2>全站公告'), _t('输入公告内容，用户进入站点时自动弹出'));
    $form->addInput($news);
	
    //nav
	$navStyle = new Typecho_Widget_Helper_Form_Element_Select('navStyle',array('0'=>'顶部导航栏','1'=>'左侧抽屉栏'),'0','<h2>导航栏 Nav</h2>类型','选择导航栏的类型（若选择左侧抽屉蓝，则下一条设置失效）');
    $form->addInput($navStyle);
	
	//index-banner
	$bannerUrl = new Typecho_Widget_Helper_Form_Element_Text('bannerUrl', NULL, 'https://s2.ax1x.com/2019/07/10/ZcRGX8.png', _t('<h2>首页大图 Banner</h2>图片 Url'), _t('首页大图的图片地址'));
    $form->addInput($bannerUrl);
	$bannerHeight = new Typecho_Widget_Helper_Form_Element_Text('bannerHeight', NULL, '60', _t('高度'), _t('首页大图所占屏幕的高度，100为最大，填入纯数字，如"35"'));
    $form->addInput($bannerHeight);
	$bannerTitle = new Typecho_Widget_Helper_Form_Element_Text('bannerTitle', NULL, NULL, _t('标题'), _t('这里是首页大图显示的的标题'));
    $form->addInput($bannerTitle);
	$bannerIntro = new Typecho_Widget_Helper_Form_Element_Text('bannerIntro', NULL, NULL, _t('介绍'), _t('这里是首页大图标题下的简介<hr>'));
    $form->addInput($bannerIntro);
    $bannerPosition = new Typecho_Widget_Helper_Form_Element_Select('bannerPosition', array(''=>'默认','background-position:center,center;'=>'垂直水平居中'), '0', '位置', '这里选择首页大图的显示位置，“默认”图片从左上角开始显示，“垂直水平居中”为图片垂直水品居中显示。');
    $form->addInput($bannerPosition);
	
	//pjax
	$pjax = new Typecho_Widget_Helper_Form_Element_Select('pjax',array('0'=>'关闭','1'=>'开启'),'1','<h2>Pjax 预加载</h2>是否开启','Pjax 预加载功能的开关');
    $form->addInput($pjax);
	$pjax_complete = new Typecho_Widget_Helper_Form_Element_Textarea('pjax_complete', NULL, NULL, _t('完成后执行事件'), _t('Pjax 跳转页面后执行的事件，写入 js 代码，一般将 Pjax 重载(回调)函数写在这里。<hr>'));
    $form->addInput($pjax_complete);
	
	//improve
	$CDN = new Typecho_Widget_Helper_Form_Element_Select('CDN',array('0'=>'关闭','1'=>'开启'),'0','<h2>优化</h2>CDN 加速加载静态资源（Beta）','开启后静态资源文件调用 JSdelivr 的 CDN 公用库，加快网页加载速度。本身有 CDN 的就不用了，不然反而可能会拖慢速度。<hr>');
    $form->addInput($CDN);
	
	//custom style
	$grayTheme = new Typecho_Widget_Helper_Form_Element_Select('grayTheme',array('0'=>'关闭','1'=>'开启'),'0','<h2>个性化</h2>哀悼模式','打开后网站变为黑白');
    $form->addInput($grayTheme);
	$bodyFonts = new Typecho_Widget_Helper_Form_Element_Select('bodyFonts',array('0'=>'无衬线字体','1'=>'衬线字体'),'0','网站字体','选择网站的字体，无衬线字体即“思源黑体”，衬线字体即“思源宋体”');
    $form->addInput($bodyFonts);
	$cat = new Typecho_Widget_Helper_Form_Element_Select('cat',array('0'=>'不要','1'=>'小黑','2'=>'小白'),'0','领养猫咪','领养一只猫咪，这样你就可以在前台看到它啦！');
    $form->addInput($cat);
	$ModelHeight = new Typecho_Widget_Helper_Form_Element_Text('ModelHeight', NULL, '320', _t('自定义模型高度'), _t('设置猫咪/自定义模型的高度'));
    $form->addInput($ModelHeight);
	$ModelWidth = new Typecho_Widget_Helper_Form_Element_Text('ModelWidth', NULL, '300', _t('自定义模型宽度'), _t('设置猫咪/自定义模型的宽度'));
    $form->addInput($ModelWidth);
	$customModel = new Typecho_Widget_Helper_Form_Element_Text('customModel', NULL, NULL, _t('自定义 Live2d 模型'), _t('填入 Live2d 模型的 json 地址，会代替猫咪显示在首页，填入后上一个设置项失效。<hr>'));
    $form->addInput($customModel);
	
	//developer
	$headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中'));
    $form->addInput($headerEcho);
	$footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义页脚部信息'), _t('填写 html 代码，将输出在页脚的版权信息后'));
    $form->addInput($footerEcho);
	$cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $form->addInput($cssEcho);
	$jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $form->addInput($jsEcho);
}