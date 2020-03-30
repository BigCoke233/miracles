<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
      <?php if($this->options->navStyle==1): ?><div class="mask" id="full-mask"></div><?php endif; ?>
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
		<h1>你已经登陆了</h1>
		<p class="large-screen" style="margin-top:0">&emsp;不过康纳很乐意再次见到 <?php $this->user->screenName(); ?> 呢~</p>
		<p class="login-enter-admin"><a href="/admin" class="col-md-3">进入后台</a></p>
		<?php else: ?>
	    <form action="<?php $this->options->loginAction(); ?>" id="login-form" method="post" name="login" role="form" class="login-form">
		  <h1>登录后台</h1>
          <input type="text" name="name" autocomplete="username" placeholder="请输入用户名" required />
          <input type="password" name="password" autocomplete="current-password" placeholder="请输入密码" required />
          <input type="hidden" name="referer" value="<?php 
            if($this->is('index')) $this->options->siteUrl();
            else $this->permalink();
            ?>">
          <button class="btn btn-normal" type="submit">登录</button>                          
        </form>
		<?php endif; ?>
	  </div>
	  
	  <!-- Nav Starts -->
	  <?php if($this->options->navStyle==0): ?>
      <!-- 移动端导航面板 -->
	  <div class="mobile-menu ready">
	    <button class="mobile-menu-close ready" id="toggle-mobile-menu-close"><i class="iconfont icon-x"></i></button>
		<h2 class="mobile-menu-title">页面导航</h2>
		<div class="mobile-menu-pagelist"><div class="container-fluid"><div class="row">
		  <?php 
		  if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<div class="col-6"><a href="{permalink}">{title}</a></div>');
          }
          else {
			  echo Contents::paresNav($this->options->customNav,"mobile");
		  }?>
		</div></div></div>
		<div class="mobile-menu-footer">
		  <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a> | Theme <a href="https://github.com/BigCoke233/miracles">Miracles</a></p>
		</div>
	  </div>

	  <!-- -小屏幕导航 -->
	  <nav class="small-screen nav nav-mobile nav-fixed"<?php if($this->options->navStyle==1): ?> style="display:none!important"<?php endif; ?> id="navBarMobile">
        <div class="nav-mobile-content">
		  <a href="<?php $this->options->SiteUrl(); ?>" style="float:left"><i class="iconfont icon-xuanzhongshangcheng"></i></a>
		  <a id="search-open-mobile" style="float:left"><i class="iconfont icon-chaxun"></i></a>
		  <a id="login-open-mobile" style="float:left"><i class="iconfont icon-user"></i></a>
		  <a id="toggle-dark-mobile" style="float:left"><i class="iconfont icon-sun"></i></a>
		  <a id="toggle-mobile-menu-button" style="float:right">MENU <i class="iconfont icon-list"></i></a>
		</div>
	  </nav>
	  <?php endif; ?>
	  
	  <!-- 导航 -->
	  <?php if($this->options->navStyle==0): ?>
	  <!-- -大屏幕导航 -->
      <nav class="large-screen nav nav-fixed" id="navBar">
	    <div class="container">
		  <p class="nav-content">
		    <a href="<?php $this->options->SiteUrl(); ?>" class="nav-title"><?php $this->options->title(); ?></a>
			<span class="nav-content-item">
			<?php 
			if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<a href="{permalink}">{title}</a>');
            }
            else {
              echo Contents::paresNav($this->options->customNav,"top-nav");
			}?>
			</span>
		  </p>
		  <button class="nav-icon-button search-button" id="search-open-button"><i class="iconfont icon-chaxun"></i></button>
		  <button class="nav-icon-button login-button" id="login-open"><i class="iconfont icon-user"></i></button>
		  <button class="nav-icon-button setting-button" id="toggle-dark-button"><i class="iconfont icon-sun"></i></button>
		</div>
	  </nav>
	  <?php elseif($this->options->navStyle==1): ?>
	  <!-- 抽屉栏 -->
	  <nav class="drawer"><div class="drawer-relative">
	    <div class="drawer-main">
	      <button class="drawer-button" id="drawer-button"><i class="iconfont icon-list"></i></button>
          <div class="drawer-header">
	        <div class="drawer-avatar">
		      <?php if($this->options->avatar==''): echo $this->author->gravatar(500);
         	  else: ?><img src="<?php $this->options->avatar(); ?>"><?php endif; ?>
		    </div>
	      </div>
		  <div class="drawer-content">
		    <a href="<?php $this->options->SiteUrl(); ?>" onclick="toggleDrawer()">首页</a>
			<?php 
			if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<a href="{permalink}" onclick="toggleDrawer()">{title}</a>');
            }
            else {
              echo Contents::paresNav($this->options->customNav,"drawer");
			}?>
		  </div>
		</div>
		<div class="drawer-footer">
		  <button class="drawer-icon" id="search-open-button"><i class="iconfont icon-chaxun"></i></button>
		  <button class="drawer-icon" id="login-open"><i class="iconfont icon-user"></i></button>
          <button class="drawer-icon" id="toggle-dark-button"><i class="iconfont icon-sun"></i></button>
		</div>
	  </div></nav>
	  <?php endif;?>
	  <!-- /Nac Ends -->
	  
	  <!-- pjax-container Starts -->
	  <div id="pjax-container">
	  <header>
	    <!-- Banner -->
	    <?php if($this->is('post') || $this->is('page')): ?>
		<div class="index-banner" style="background-position:center;<?php if($this->fields->banner && $this->fields->banner=!''): ?>background:url('<?php $this->fields->banner(); ?>') no-repeat;<?php else: ?>background-color:#f1f1f1;<?php endif; ?>height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;">
        <?php elseif($this->is('archive')): ?>
		<div class="index-banner" style="height:<?php $this->options->bannerHeight(); ?>vh;background-position:center;<?php if($this->options->bannerUrl!=''): echo $this->options->bannerUrl(); endif; ?>">
		<?php else: ?>
	    <div class="index-banner" style="background-position:center;background:url('<?php $this->options->bannerUrl(); ?>') no-repeat;height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;">
		<?php endif; ?>
		  <!-- 遮罩 -->
		  <div class="banner-mask"<?php if($this->is('post') || $this->is('page')):?><?php if($this->fields->banner==''):?> style="background:rgba(0,0,0,0)!important"<?php endif;?><?php endif; ?><?php if($this->is('index')):?><?php if($this->options->bannerUrl && $this->options->bannerUrl=!''): ?><?php else:?> style="background:rgba(0,0,0,0)!important"<?php endif;?><?php endif;?>>
		    <div class="main-container container">
			  <div class="banner-content<?php if($this->is('index') && $this->options->bannerFont==1): ?> banner-font-black<?php endif; ?><?php if($this->is('page') || $this->is('post')): if($this->fields->banner==''): ?> banner-font-black<?php endif; endif; ?>" id="banner-content">
			    <?php if($this->is('index')): ?>
			    <h1><?php $this->options->bannerTitle(); ?></h1>
		        <p><?php $this->options->bannerIntro(); ?></p>
				<?php elseif($this->is('post') || $this->is('page')): ?>
				<h1><?php $this->title(); ?></h1>
		        <div class="header-meta">
				  <?php if($this->fields->meta==''): ?>
				  <div class="header-meta-line-one">
				    <?php if($this->is('post')): ?><i class="iconfont icon-block" title="文章分类"></i> <?php $this->category(','); ?>&emsp;<?php endif; ?>
				    <i class="iconfont icon-comments" title="共 <?php $this->commentsNum('0', '1', '%d'); ?> 条评论"></i> <?php $this->commentsNum('还没有评论', '仅一条评论', '%d'); ?>&emsp;
                  </div>
				  <div class="header-meta-line-two">
				    <i class="iconfont icon-clock" title="该文章发布于 <?php $this->date(); ?>"></i> <?php $this->date(); ?>&emsp;
				    <i class="icon-view iconfont" title="该文章被浏览 <?php get_post_view($this) ?> 次"></i> <?php get_post_view($this) ?>
                  </div>
				  <?php else: ?>
				    <?php $this->fields->meta(); ?><div style="display:none"><?php get_post_view($this) ?></div>
				  <?php endif; ?>
				</div>
				<?php elseif($this->is('archive')): ?>
				<h1><?php $this->archiveTitle(array(
                  'category'  =>  _t('分类 %s 下的文章'),
                  'search'    =>  _t('包含关键字 %s 的文章'),
                  'tag'       =>  _t('标签 %s 下的文章'),
                  'author'    =>  _t('%s 发布的文章')
                ), '', '');?></h1><?php else: endif; ?>
			  </div>
			</div>
		  </div>
		</div>
	  </header>