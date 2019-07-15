<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
      <!-- 搜索 -->
      <div class="search ready">
	    <button class="search-close ready" onclick="Search()"><i class="iconfont icon-x"></i></button>
	    <form method="post" action="">
          <div class="search-form">
		    <input type="text" name="s" class="text" size="32" /> 
			<button type="submit" class="submit">搜索</button>
		  </div>
        </form>
	  </div>
	  <!-- 登录面板 -->
	  <div class="login ready">
	    <button class="login-close ready" onclick="Login()"><i class="iconfont icon-x"></i></button>
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
	    <button class="mobile-menu-close ready" onclick="toggleMobileMenu()"><i class="iconfont icon-x"></i></button>
		<h2 class="mobile-menu-title">页面导航</h2>
		<div class="mobile-menu-pagelist"><div class="container-fluid"><div class="row">
		  <?php $this->widget('Widget_Contents_Page_List')
          ->parse('<div class="col-6"><a href="{permalink}">{title}</a></div>'); ?>
		</div></div></div>
		<div class="mobile-menu-footer">
		  <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a> | Theme <a href="https://github.com/BigCoke233/miracles">Miracles</a></p>
		</div>
	  </div>
	  
	  <!-- 导航 -->
	  <!-- > 大屏幕导航 -->
      <nav class="large-screen nav<?php if($this->options->nav_position && $this->options->nav_position=1): ?> nav-fixed<?php endif; ?>">
	    <div class="container">
		  <p class="nav-content">
		    <a href="<?php $this->options->SiteUrl(); ?>" class="nav-title"><?php $this->options->title(); ?></a>
			<span class="nav-content-item">
			<?php $this->widget('Widget_Contents_Page_List')
            ->parse('<a href="{permalink}">{title}</a>'); ?>
			</span>
		  </p>
		  <button class="nav-icon-button search-button" onclick="Search()"><i class="iconfont icon-chaxun"></i></button>
		  <button class="nav-icon-button login-button" onclick="Login()"><i class="iconfont icon-user"></i></button>
		</div>
	  </nav>
	  <!--> 小屏幕导航 -->
	  <nav class="small-screen nav nav-mobile<?php if($this->options->nav_position && $this->options->nav_position=1): ?> nav-fixed<?php endif; ?>">
        <div class="nav-mobile-content">
		  <a href="<?php $this->options->SiteUrl(); ?>" style="float:left"><i class="iconfont icon-xuanzhongshangcheng"></i></a>
		  <a onclick="Search()" style="float:left"><i class="iconfont icon-chaxun"></i></a>
		  <a onclick="Login()" style="float:left"><i class="iconfont icon-user"></i></a>
		  <a onclick="toggleMobileMenu()" style="float:right">MENU <i class="iconfont icon-list"></i></a>
		</div>
	  </nav>
	  
	  <div id="pjax-container">
	  <header>
	    <?php if($this->is('post') || $this->is('page')): ?>
		<div class="index-banner" style="background:url('<?php if($this->fields->banner && $this->fields->banner=!''): ?><?php $this->fields->banner(); ?><?php else: ?><?php $this->options->bannerUrl(); ?><?php endif; ?>') no-repeat;height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;">
		<?php else: ?>
	    <div class="index-banner" style="background:url('<?php $this->options->bannerUrl(); ?>') no-repeat;height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;">
		<?php endif; ?>
		  <div class="dark-cover">
		    <div class="main-container container">
			  <div class="banner-content">
			    <?php if($this->is('index')): ?>
			    <h1><?php $this->options->bannerTitle(); ?></h1>
		        <p><?php $this->options->bannerIntro(); ?></p>
				<?php elseif($this->is('post') || $this->is('page')): ?>
				<h1><?php $this->title(); ?></h1>
		        <p class="header-meta"><?php if($this->is('post')): ?><i class="iconfont icon-block"></i> <?php $this->category(','); ?>&emsp;<?php endif; ?><i class="iconfont icon-comments"></i> <?php $this->commentsNum('None', 'Only 1', '%d'); ?>&emsp;<i class="iconfont icon-clock"></i> <?php $this->date(); ?></p>
				<?php else: ?>
				
				<?php endif; ?>
			  </div>
			</div>
		  </div>
		</div>
	  </header>
	  <br><br><br>
	  