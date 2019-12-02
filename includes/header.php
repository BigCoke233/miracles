<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
      <div class="mask" id="full-mask"></div>
	  <div class="alert ready"><p class="alert-content">错误！未定义的 alert 信息或 css 未正常载入</p><button id="alert-close" class="alert-close"><i class="iconfont icon-x"></i></button></div>
      <!-- 搜索 -->
      <div class="search ready">
	    <button class="search-close ready" id="search-close-button"><i class="iconfont icon-x"></i></button>
	    <form method="post" action="">
          <div class="search-form">
		    <input type="text" name="s" class="text" size="32" /> 
			<button type="submit" class="submit">搜索</button>
		  </div>
        </form>
	  </div>
	  <!-- 登录面板 -->
	  <div class="login ready">
	    <button class="login-close ready" id="login-close"><i class="iconfont icon-x"></i></button>
		<?php if($this->user->hasLogin()): ?>
		<h1>你已经登陆过了哦</h1>
		<p class="large-screen">&emsp;不过康纳很乐意再次见到<a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>呢~</p>
		<?php else: ?>
	    <form action="<?php $this->options->loginAction(); ?>" id="login-form" method="post" name="login" role="form" class="login-form">
		  <h1>登录后台</h1>
          <input type="text" name="name" autocomplete="username" placeholder="请输入用户名" required/>
          <input type="password" name="password" autocomplete="current-password" placeholder="请输入密码" required/>
          <input type="hidden" name="referer" value="<?php 
            if($this->is('index')) $this->options->siteUrl();
            else $this->permalink();
            ?>">
          <button class="btn btn-normal" type="submit">登录</button>                          
        </form>
		<?php endif; ?>
	  </div>
      <!-- 移动端导航面板 -->
	  <div class="mobile-menu ready">
	    <button class="mobile-menu-close ready" id="toggle-mobile-menu-close"><i class="iconfont icon-x"></i></button>
		<h2 class="mobile-menu-title">页面导航</h2>
		<div class="mobile-menu-pagelist"><div class="container-fluid"><div class="row">
		  <?php $this->widget('Widget_Contents_Page_List')
          ->parse('<div class="col-6"><a href="{permalink}">{title}</a></div>'); ?>
		</div></div></div>
		<div class="mobile-menu-footer">
		  <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a> | Theme <a href="https://github.com/BigCoke233/miracles">Miracles</a></p>
		</div>
	  </div>
	  <!-- 前台设置 -->
	  <div class="options ready<?php if($this->options->navStyle==1): ?> options-with-drawer<?php endif; ?>">
	    <!-- 字体设置 -->
	    <div class="options-content">
	      <div class="options-family container-fluid">
		    <div class="row">
			  <div class="col-6 options-family-serif">
			    <button onclick="ChangeToSerif()" class="<?php if($this->options->bodyFonts && $this->options->bodyFonts=1): ?>options-button-active <?php endif; ?>options-family-button options-serif-button body-serif">Serif</button>
			  </div>
			  <div class="col-6 options-family-sans">
			    <button onclick="ChangeToSansSerif()" class="<?php if($this->options->bodyFonts && $this->options->bodyFonts=1): ?><?php else: ?>options-button-active <?php endif; ?>options-family-button options-sans-button" style="font-family: 'Noto Sans SC',sans-serif">Sans Serif</button>
			  </div>
		    </div>
		  </div>
	    </div>
		<hr>
		<!-- 滤镜/模式设置 -->
		<div class="options-content">
		  <div class="options-themes container-fluid">
		    <div class="row">
			  <div class="col-4 options-theme-item">
			    <button class="options-theme-button options-theme-dark" onclick="Dark()"></button>
				<span class="options-theme-label">黑夜模式</span>
			  </div>
			  <div class="col-4 options-theme-item">
			    <button class="options-theme-button options-theme-sepia" onclick="Sepia()"></button>
				<span class="options-theme-label">日落滤镜</span>
			  </div>
		      <div class="col-4 options-theme-item">
			    <button class="options-theme-button options-theme-normal" onclick="Gray()"></button>
				<span class="options-theme-label">黑白滤镜</span>
			  </div>
			</div>
		  </div>
		</div>
		<hr>
		<div class="options-content">
		  <div class="options-contentsize container-fluid">
		    <div class="row">
			  <div class="col-3 options-contentsize-small">
			    <button class="options-sizesmall options-contentsize-button options-button-active" onclick="SizeSmall()">100%</button>
			  </div>
			  <div class="col-3 options-contentsize-normal">
			    <button class="options-sizenormal options-contentsize-button" onclick="SizeNormal()">125%</button>
			  </div>
			  <div class="col-3 options-contentsize-big">
			    <button class="options-sizebig options-contentsize-button" onclick="SizeBig()">140%</button>
			  </div>
			  <div class="col-3 options-contentsize-large">
			    <button class="options-sizelarge options-contentsize-button" onclick="SizeLarge()">180%</button>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- -小屏幕导航 -->
	  <nav class="small-screen nav nav-mobile nav-fixed"<?php if($this->options->navStyle==1): ?> style="display:none!important"<?php endif; ?> id="navBarMobile">
        <div class="nav-mobile-content">
		  <a href="<?php $this->options->SiteUrl(); ?>" style="float:left"><i class="iconfont icon-xuanzhongshangcheng"></i></a>
		  <a id="search-open-mobile" style="float:left"><i class="iconfont icon-chaxun"></i></a>
		  <a id="login-open-mobile" style="float:left"><i class="iconfont icon-user"></i></a>
		  <a id="toggle-options-mobile" style="float:left"><i class="iconfont icon-settings"></i></a>
		  <a id="toggle-mobile-menu-button" style="float:right">MENU <i class="iconfont icon-list"></i></a>
		</div>
	  </nav>
	  <?php if($this->options->navStyle==0): ?>
	  <!-- 导航 -->
	  <!-- -大屏幕导航 -->
      <nav class="large-screen nav nav-fixed" id="navBar">
	    <div class="container">
		  <p class="nav-content">
		    <a href="<?php $this->options->SiteUrl(); ?>" class="nav-title"><?php $this->options->title(); ?></a>
			<span class="nav-content-item">
			<?php $this->widget('Widget_Contents_Page_List')
            ->parse('<a href="{permalink}">{title}</a>'); ?>
			</span>
		  </p>
		  <button class="nav-icon-button search-button" id="search-open-button"><i class="iconfont icon-chaxun"></i></button>
		  <button class="nav-icon-button login-button" id="login-open"><i class="iconfont icon-user"></i></button>
		  <button class="nav-icon-button setting-button" id="toggle-options-button"><i class="iconfont icon-settings"></i></button>
		</div>
	  </nav>
	  <?php elseif($this->options->navStyle==1): ?>
	  <!-- 抽屉栏 -->
	  <nav class="drawer"><div class="drawer-relative">
	    <div class="drawer-main">
	      <button class="drawer-button" onclick="toggleDrawer();$('.options').addClass('ready');"><i class="iconfont icon-list"></i></button>
          <div class="drawer-header">
	        <div class="drawer-avatar">
		      <?php echo $this->author->gravatar(500); ?>
		    </div>
	      </div>
		  <div class="drawer-content">
		    <a href="<?php $this->options->SiteUrl(); ?>" onclick="toggleDrawer()">首页</a>
		    <?php $this->widget('Widget_Contents_Page_List')
            ->parse('<a href="{permalink}" onclick="toggleDrawer()">{title}</a>'); ?>
		  </div>
		</div>
		<div class="drawer-footer">
		  <button class="drawer-icon" id="search-open-button" onclick="toggleDrawer"><i class="iconfont icon-chaxun"></i></button>
		  <button class="drawer-icon" id="login-open" onclick="toggleDrawer()"><i class="iconfont icon-user"></i></button>
          <button class="drawer-icon" id="toggle-options-button"><i class="iconfont icon-settings"></i></button>
		</div>
	  </div></nav>
	  <?php endif; ?>
	  <div id="pjax-container"><!-- 开始 pjax-container -->
	  <header>
	    <?php if($this->is('post') || $this->is('page')): ?>
		<div class="index-banner" style="background-position:center;<?php if($this->fields->banner && $this->fields->banner=!''): ?>background:url('<?php $this->fields->banner(); ?>') no-repeat;<?php else: ?>background-color:<?php $this->options->bannerColor(); ?>;<?php endif; ?>height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;">
		<?php else: ?>
	    <div class="index-banner" style="background-position:center;background:url('<?php $this->options->bannerUrl(); ?>') no-repeat;height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;background-color:<?php $this->options->bannerColor(); ?>">
		<?php endif; ?>
		  <div class="banner-mask"<?php if($this->is('post') || $this->is('page')):?><?php if($this->fields->banner==''):?> style="background:rgba(0,0,0,0)!important"<?php endif;?><?php endif; ?><?php if($this->is('index')):?><?php if($this->options->bannerUrl && $this->options->bannerUrl=!''): ?><?php else:?> style="background:rgba(0,0,0,0)!important"<?php endif;?><?php endif;?>>
		    <div class="main-container container">
			  <div class="banner-content<?php if($this->is('index') && $this->options->bannerFont==1): ?> banner-font-black<?php endif; ?><?php if($this->is('page') || $this->is('post')): if($this->fields->banner==''): ?> banner-font-black<?php endif; endif; ?>">
			    <?php if($this->is('index')): ?>
			    <h1><?php $this->options->bannerTitle(); ?></h1>
		        <p><?php $this->options->bannerIntro(); ?></p>
				<?php elseif($this->is('post') || $this->is('page')): ?>
				<h1><?php $this->title(); ?></h1>
		        <p class="header-meta"><?php if($this->fields->meta==''): ?>
				  <?php if($this->is('post')): ?>
					<i class="iconfont icon-block" title="文章分类"></i> <?php $this->category(','); ?>&emsp;<?php endif; ?><i class="iconfont icon-comments" title="共 <?php $this->commentsNum('None', '1', '%d'); ?> 条评论"></i> <?php $this->commentsNum('None', 'Only 1', '%d'); ?>&emsp;<i class="iconfont icon-clock" title="该文章发布于 <?php $this->date(); ?>"></i> <?php $this->date(); ?>&emsp;<i class="icon-view iconfont" title="该文章被浏览 <?php get_post_view($this) ?> 次"></i> <?php get_post_view($this) ?><?php else: echo $this->fields->meta; endif; ?>
				</p>
				<?php else: ?><?php endif; ?>
			  </div>
			</div>
		  </div>
		</div>
	  </header>
	  <br><br><br>
