<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
      <div class="search ready">
	    <button class="search-close ready" onclick="Search()"><i class="iconfont icon-x"></i></button>
	    <form method="post" action="">
          <div class="search-form">
		    <input type="text" name="s" class="text" size="32" /> 
			<button type="submit" class="submit">搜索</button>
		  </div>
        </form>
	  </div>
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
      <nav class="nav<?php if($this->options->nav_position && $this->options->nav_position=1): ?> nav-fixed<?php endif; ?>">
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
	  