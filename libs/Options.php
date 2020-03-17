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
          echo '<div class="miracles-backup-alert">备份已更新，即将自动刷新。如过您的浏览器没有自动跳转请点击';
?><a href="<?php Helper::options()->adminUrl('options-theme.php'); ?>">这里</a></div><script language="JavaScript">window.setTimeout("location=\'<?php Helper::options()->adminUrl('options-theme.php'); ?>\'", 2500);</script>
<?php }else{
    if($ysj){
      $insert = $db->insert('table.options')
      ->rows(array('name' => 'theme:MiraclesBackup','user' => '0','value' => $ysj));
      $insertId = $db->query($insert);
      echo '<div class="miracles-backup-alert">备份完成，即将自动刷新。如过您的浏览器没有自动跳转请点击';
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
    echo '<div class="miracles-backup-alert">检测到模板备份数据，恢复完成，即将自动刷新。如过您的浏览器没有自动跳转请点击';
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
      echo '<div class="miracles-backup-alert">备份不存在！</div>';
    }
  }
}

    /**
	 *  设置样式+面板
	 */
    $ver = themeVersion();
    $themeDir = "/usr/themes/Miracles/";
	 
	echo '<link rel="stylesheet" href="'.$themeDir.'assets/css/setting.miracles.css"><link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC:300|Noto+Serif+SC:300&display=swap" rel="stylesheet">';
	echo '<div class="miracles-pannel">
	<h1>Miracles 主题设置面板</h1>
	<p>欢迎使用 Miracles 主题，目前版本是：'. $ver .'<br>
	作者博客：<a href="https://guhub.cn">Eltrac\'s</a> | 帮助文档：<a href="https://mira.guhub.cn">WIKI</a> | 问题反馈：<a href="https://github.com/BigCoke233/miracles/issues">issues</a>
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
	//Info
	$bannerTitle = new Typecho_Widget_Helper_Form_Element_Text('bannerTitle', NULL, NULL, _t('<h2>站点信息 Information</h2>站点名称'), _t('输入你站点的名称，会显示在首页大图上'));
    $form->addInput($bannerTitle);
	$bannerIntro = new Typecho_Widget_Helper_Form_Element_Text('bannerIntro', NULL, NULL, _t('站点介绍'), _t('用一句话介绍你的站点，会显示在首页大图上'));
    $form->addInput($bannerIntro);
	$avatar = new Typecho_Widget_Helper_Form_Element_Text('avatar', NULL, NULL, _t('站长头像'), _t('输入一个图片 url 作为头像，若为空则调用 gravatar<hr>'));
    $form->addInput($avatar);
	 
    //nav
	$navStyle = new Typecho_Widget_Helper_Form_Element_Select('navStyle',array('0'=>'顶部导航栏','1'=>'左侧抽屉栏'),'0','<h2>导航栏 Nav</h2>类型','选择导航栏的类型（若选择左侧抽屉蓝，则下一条设置失效）');
    $form->addInput($navStyle);
	$navAero = new Typecho_Widget_Helper_Form_Element_Select('navAero',array('0'=>'是','1'=>'否'),'0','顶部透明','视口处于最顶部时，顶部导航栏是否变为透明<hr>');
    $form->addInput($navAero);
	
	//index-banner
	$bannerUrl = new Typecho_Widget_Helper_Form_Element_Text('bannerUrl', NULL, NULL, _t('<h2>首页大图 Banner</h2>图片 Url'), _t('首页大图的图片地址'));
    $form->addInput($bannerUrl);
    $bannerFont = new Typecho_Widget_Helper_Form_Element_Select('bannerFont',array('0'=>'白色','1'=>'黑色'),'0','字体颜色','为了兼容不同的底色和背景色');
    $form->addInput($bannerFont);
	$bannerHeight = new Typecho_Widget_Helper_Form_Element_Text('bannerHeight', NULL, '60', _t('高度'), _t('首页大图所占屏幕的高度，100为最大，填入纯数字，如"35"<hr>'));
    $form->addInput($bannerHeight);

	//pjax
	$pjax = new Typecho_Widget_Helper_Form_Element_Select('pjax',array('0'=>'关闭','1'=>'开启'),'1','<h2>Pjax 预加载</h2>是否开启','Pjax 预加载功能的开关');
    $form->addInput($pjax);
	$pjax_complete = new Typecho_Widget_Helper_Form_Element_Textarea('pjax_complete', NULL, NULL, _t('完成后执行事件'), _t('Pjax 跳转页面后执行的事件，写入 js 代码，一般将 Pjax 重载(回调)函数写在这里。<hr>'));
    $form->addInput($pjax_complete);
	
	//improve
	$CDN = new Typecho_Widget_Helper_Form_Element_Select('CDN',array('0'=>'关闭','1'=>'开启'),'0','<h2>优化</h2>CDN 加速加载静态资源（Beta）','开启后静态资源文件调用 JSdelivr 的 CDN 公用库，加快网页加载速度。本身有 CDN 的就不用了，不然反而可能会拖慢速度。');
    $form->addInput($CDN);
	$ifShowRTA = new Typecho_Widget_Helper_Form_Element_Select('ifShowRTA',array('0'=>'不显示','1'=>'显示'),'0','阅读时长提示 RTA','在文章前加入阅读时长提示，增进用户体验<hr>');
    $form->addInput($ifShowRTA);
	
	//custom style
	$grayTheme = new Typecho_Widget_Helper_Form_Element_Select('grayTheme',array('0'=>'关闭','1'=>'开启'),'0','<h2>个性化</h2>哀悼模式','打开后网站变为黑白');
    $form->addInput($grayTheme);
	$bodyFonts = new Typecho_Widget_Helper_Form_Element_Select('bodyFonts',array('0'=>'无衬线字体','1'=>'衬线字体'),'0','网站字体','选择网站的字体，无衬线字体即“思源黑体”，衬线字体即“思源宋体”');
    $form->addInput($bodyFonts);
        
    //LoadingImage
    $LoadingOptions = [
        'block' => "交错方块",
        'octopus' => "旋转章鱼",
        'bilibili' => "哔哩哔哩",
        'shojo' => "少女祈祷"
    ];
    $LoadingImage = new Typecho_Widget_Helper_Form_Element_Radio('loading_image', $LoadingOptions, 'block', _t('图片懒加载动画'),_t(""));
    $form->addInput($LoadingImage);

    //SiteBuildTime
    $buildTime = new Typecho_Widget_Helper_Form_Element_Text('build_time', NULL, NULL, _t('在页脚输出建站至今时间'), _t('填写格式如 2020-01-01 的时间，将输出在站点信息之前，不想开启请留空。'));
    $form->addInput($buildTime);
    //AnimeFace
    $AnimeFace = new Typecho_Widget_Helper_Form_Element_Text('anime_face', NULL, NULL, _t('在其之后输出一个蹦跶的颜文字'), _t('如果开启了建站时间将会输出在其之后，反之会输出在站点信息之后。在此写上你想展示的颜文字，多个颜文字用"&&"分割，每次刷新更换。如不想开启请留空。<hr>'));
    $form->addInput($AnimeFace);

	//developer
	$headerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('headerEcho', NULL, NULL, _t('<h2>开发者设置</h2>自定义头部信息'), _t('填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码'));
    $form->addInput($headerEcho);
	$footerEcho = new Typecho_Widget_Helper_Form_Element_Textarea('footerEcho', NULL, NULL, _t('自定义页脚部信息'), _t('填写 html 代码，将输出在页脚的版权信息之前'));
    $form->addInput($footerEcho);
	$cssEcho = new Typecho_Widget_Helper_Form_Element_Textarea('cssEcho', NULL, NULL, _t('自定义 CSS'), _t('填写 CSS 代码，输出在 head 标签结束之前的 style 标签内'));
    $form->addInput($cssEcho);
	$jsEcho = new Typecho_Widget_Helper_Form_Element_Textarea('jsEcho', NULL, NULL, _t('自定义 JavaScript'), _t('填写 JavaScript代码，输出在 body 标签结束之前'));
    $form->addInput($jsEcho);
}