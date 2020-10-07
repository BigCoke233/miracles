<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
      <?php if($this->options->navStyle==1): ?><div class="mask" id="full-mask"></div><?php endif; ?>
      <!-- 搜索 -->
      <div class="search ready">
	    <button class="search-close ready" id="search-close-button"><i class="iconfont icon-x"></i></button>
	    <form method="post" action="">
          <div class="search-form">
		    <input type="text" name="s" class="text" size="32" /> 
			<button type="submit" class="submit"><i class="iconfont" style="font-size:30px">&#xe600;</i></button>
		  </div>
        </form>
	  </div>
	  <!-- 登录面板 -->
	  <div class="login ready">
	    <button class="login-close ready" id="login-close"><i class="iconfont icon-x"></i></button>
		<?php if($this->user->hasLogin()): ?>
		<h1><?php gtecho('headerTexts','loginAlready'); ?></h1>
		<p class="large-screen" style="margin-top:0">&emsp;<?php gtaecho('headerTexts','loginAlreadyInfo',$this->user->screenName); ?></p>
		<p class="login-enter-admin"><a href="/admin" class="col-md-3"><?php gtecho('headerTexts','loginAdminEntrance');?></a></p>
		<?php else: ?>
	    <form action="<?php $this->options->loginAction(); ?>" id="login-form" method="post" name="login" role="form" class="login-form">
		  <h1><?php gtecho('headerTexts','loginTitle');?></h1>
          <input type="text" name="name" autocomplete="username" placeholder="<?php gtecho('headerTexts','loginUsername');?>" required />
          <input type="password" name="password" autocomplete="current-password" placeholder="<?php gtecho('headerTexts','loginPassword');?>" required />
          <input type="hidden" name="referer" value="<?php 
            if($this->is('index')) $this->options->siteUrl();
            else $this->permalink();
            ?>">
          <button class="btn btn-normal" type="submit"><?php gtecho('headerTexts','loginSubmit');?></button>                          
        </form>
		<?php endif; ?>
	  </div>
	  
	  <!-- Nav Starts -->
	  <?php if($this->options->navStyle==0): ?>
      <!-- 移动端导航面板 -->
	  <div class="mobile-menu ready">
	    <button class="mobile-menu-close ready" id="toggle-mobile-menu-close"><i class="iconfont icon-x"></i></button>
		<h2 class="mobile-menu-title"><?php gtecho('headerTexts','navTitle'); ?></h2>
		<div class="mobile-menu-pagelist" role="navigation"><div class="container-fluid"><div class="row">
		  <?php 
		  if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<div class="col-6"><a href="{permalink}">{title}</a></div>');
          }
          else {
			  echo Contents::parseNav($this->options->customNav, "mobile");
		  }?>
		</div></div></div>
		<div class="mobile-menu-footer">
		  <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a> | Theme <a href="https://github.com/BigCoke233/miracles">Miracles</a></p>
		</div>
	  </div>

	  <!-- -小屏幕导航 -->
	  <nav class="small-screen nav nav-mobile nav-fixed"<?php if($this->options->navStyle==1): ?> style="display:none!important"<?php endif; ?> id="navBarMobile">
        <div class="nav-mobile-content" role="navigation">
		  <a href="<?php $this->options->SiteUrl(); ?>" style="float:left"><i class="iconfont icon-xuanzhongshangcheng"></i></a>
		  <?php if(!$this->options->customNavIcon)://如果没有自定义图标 ?>
		  <a id="search-open-mobile" style="float:left"><i class="iconfont icon-chaxun"></i></a>
		  <a id="login-open-mobile" style="float:left"><i class="iconfont icon-user"></i></a>
		  <a id="toggle-dark-mobile" style="float:left"><i class="iconfont icon-sun"></i></a>
		  <?php else://如果有自定义图标
		  	echo Contents::parseNavIcon($this->options->customNavIcon, "mobile"); 
		  endif; ?> 
		  <a id="toggle-mobile-menu-button" style="float:right">MENU <i class="iconfont icon-list"></i></a>
		</div>
	  </nav>
	  <?php endif; ?>
	  
	  <!-- 导航 -->
	  <?php if($this->options->navStyle==0): ?>
	  <!-- -大屏幕导航 -->
      <nav class="large-screen nav nav-fixed" id="navBar">
	    <div class="container">
		  <p class="nav-content" role="navigation">
		    <a href="<?php $this->options->SiteUrl(); ?>" class="nav-title"><?php $this->options->title(); ?></a>
			<span class="nav-content-item">
			<?php 
			if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<a href="{permalink}">{title}</a>');
            }
            else {
              echo Contents::parseNav($this->options->customNav, "top-nav");
			}?>
			</span>
		  </p>
		  <?php if(!$this->options->customNavIcon)://如果没有自定义图标 ?>
		  <button class="nav-icon-button search-button" id="search-open-button"><i class="iconfont icon-chaxun"></i></button>
		  <button class="nav-icon-button login-button" id="login-open"><i class="iconfont icon-user"></i></button>
		  <button class="nav-icon-button setting-button" id="toggle-dark-button"><i class="iconfont icon-sun"></i></button>
		  <?php else://如果有自定义图标
		  	echo Contents::parseNavIcon($this->options->customNavIcon, "top-nav"); 
		  endif; ?> 
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
		    <a href="<?php $this->options->SiteUrl(); ?>" onclick="toggleDrawer()"><?php gtecho('headerTexts','drawerHome'); ?></a>
			<?php 
			if($this->options->customNav=='') {
			  $this->widget('Widget_Contents_Page_List')
              ->parse('<a href="{permalink}" onclick="toggleDrawer()">{title}</a>');
            }
            else {
              echo Contents::parseNav($this->options->customNav, "drawer");
			}?>
		  </div>
		</div>
		<div class="drawer-footer">
		  <?php if(!$this->options->customNavIcon)://如果没有自定义图标 ?>
		  <button class="drawer-icon" id="search-open-button"><i class="iconfont icon-chaxun"></i></button>
		  <button class="drawer-icon" id="login-open"><i class="iconfont icon-user"></i></button>
          <button class="drawer-icon" id="toggle-dark-button"><i class="iconfont icon-sun"></i></button>
		  <?php else://如果有自定义图标
		  	echo Contents::parseNavIcon($this->options->customNavIcon, "drawer"); 
		  endif; ?> 
		</div>
	  </div></nav>
	  <?php endif;?>
	  <!-- /Nac Ends -->
	  
	  <!-- pjax-container Starts -->
	  <div id="pjax-container">
	  <header>
	    <!-- Banner -->
	    <?php if($this->is('post') || $this->is('page')): ?>
		<div role="banner" class="index-banner" style="<?php if($this->fields->banner && $this->fields->banner=!''): ?>background:url('<?php $this->fields->banner(); ?>') no-repeat;<?php else: ?>background-color:#f1f1f1;<?php endif; ?>height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;background-position:center;">
        <?php elseif($this->is('archive')): ?>
		<div role="banner" class="index-banner" style="height:<?php $this->options->bannerHeight(); ?>vh;<?php if($this->options->bannerUrl!=''): echo $this->options->bannerUrl(); endif; ?>">
		<?php else: ?>
	    <div role="banner" class="index-banner" style="background:url('<?php $this->options->bannerUrl(); ?>') no-repeat;height:<?php $this->options->bannerHeight(); ?>vh;background-size:cover;background-position:center;">
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
				  <?php if($this->fields->meta==''): 
					if(!$_SESSION["isPageArchive"]){ ?>
				  	<div class="header-meta-line-one">
				    	<?php if($this->is('post')): ?><span class="hint--bottom" data-tooltip="<?php gtaecho('postTexts','sort_title',$this->category) ?>"><i class="iconfont">&#xe80e;</i> <?php $this->category(','); ?></span>&emsp;<?php endif; ?>
						<?php if($this->fields->commentShow=='0'):?><span class="hint--bottom" data-tooltip="<?php if($this->commentsNum=='0'): gtecho('commentListTexts', 'commentNumNone'); else:gtaecho('commentListTexts', 'commentNum', $this->commentsNum);endif; ?>"><i class="iconfont">&#xe65e;</i> <?php $this->commentsNum('0', '1', '%d'); ?></span>&emsp;<?php endif;?>
                  	</div>
				  	<div class="header-meta-line-two">
						<span class="hint--bottom" data-tooltip="<?php gtaecho('postTexts', 'post_time', date('Y-m-d',$this->created)); ?>"><i class="iconfont">&#xedb9;</i> <?php $this->date(); ?></span>&emsp;
						<span class="hint--bottom" data-tooltip="<?php gtaecho('postTexts', 'post_views', Contents::postViews($this)) ?>"><i class="iconfont">&#xe692;</i> <?php echo Contents::postViews($this) ?></span>
                  	</div>
					<?php }else{ ?>
					<div class="header-meta-line-one">
						<i class="iconfont">&#xedb9;</i> <?php gtaecho('archivePageTexts', 'archiveStart', Contents::getOldestPostDate());?>&emsp;
					</div>
					<div class="header-meta-line-two">
						<span class="hint--bottom" data-tooltip="<?php gtaecho('postTexts', 'post_views', Contents::postViews($this)) ?>"><i class="iconfont">&#xe692;</i> <?php echo Contents::postViews($this) ?></span>
					</div>
					<?php }
					else: ?>
				    <?php $this->fields->meta(); ?><div style="display:none"><?php Contents::postViews($this) ?></div>
				  <?php endif; 
				  $_SESSION["isPageArchive"]=false; //clear ?>
				</div>
				<?php elseif($this->is('archive')): ?>
				<h1><?php $this->archiveTitle($GLOBALS['archivesTitles'], '', '');?></h1><?php else: endif; ?>
			  </div>
			</div>
		  </div>
		</div>
	  </header>
