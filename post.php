<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body">
	    <!-- 文章内容 -->
	    <div class="post-content">
		  <?php $this->content(); ?>
		  <br />
		  <!-- 文章页脚 -->
		  <div class="post-footer">
		    <p class="post-content">
			  <span class="post-tags"><i class="iconfont icon-tags"></i> <?php $this->tags(' ', true, '这人还没有写标签哦~'); ?></span>
			</p>
		  </div>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>