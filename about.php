<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 关于页面
 *
 * @package custom
 */
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container" role="main">
	  <div class="post-body">
	    <br><br><br>
	    <div class="about">
		  <div class="about-avatar"><!-- 头像 -->
		    <?php if($this->options->avatar==''): echo $this->author->gravatar(500);
         	  else: ?><img src="<?php $this->options->avatar(); ?>"><?php endif; ?>
			<?php if($this->fields->name==!''): ?>
			<h2 class="about-name"><?php echo $this->fields->name(); ?></h2>
			<?php endif; ?>
		  </div>
		  <div class="about-social"><!-- 社交按钮 -->
		    <?php if($this->fields->github==!''): ?>
			<a href="https://github.com/<?php echo $this->fields->github(); ?>" target="_blank" title="GayHub"><i class="iconfont icon-github"></i></a>
			<?php endif; ?>
			<?php if($this->fields->qq==!''): ?>
			<a href="tencent://Message/?Uin=<?php echo $this->fields->qq(); ?>&amp;websiteName=q-zone.qq.com&amp;Menu=yes" target="_blank" title="QQ"><i class="iconfont icon-qq1"></i></a>
			<?php endif; ?>
			<?php if($this->fields->bilibili==!''): ?>
			<a href="https://space.bilibili.com/<?php echo $this->fields->bilibili(); ?>" target="_blank" title="Bilibili"><i class="iconfont icon-bilibili-"></i></a>
			<?php endif; ?>
			<?php if($this->fields->email==!''): ?>
			<a href="mailto:<?php echo $this->fields->email(); ?>"><i class="iconfont icon-mail_fill" target="_blank" title="email"></i></a>
			<?php endif; ?>
		  </div>
		</div>
	    <div class="post-content page-content">
		  <?php $this->content(); ?>
	    </div>
	  </div>
      <?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>
