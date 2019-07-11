<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>

    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content">
		  <?php Contents::parseContent($this->content()); ?>
		  <br />
		  <div class="post-footer">
		    <p>
			  <span class="post-tags"><i class="iconfont icon-tags"></i> <?php $this->tags(' ', true, '这人还没有写标签哦~'); ?></span>
			</p>
		  </div>
		</div>
	  </div>
	  

	  <?php $this->need('includes/comments.php'); ?>

	</main>

<?php $this->need('includes/footer.php'); ?>