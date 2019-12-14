<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body"><!-- 页面内容 -->
	    <div class="post-content page-content">
		  <?php $this->content(); ?>
		</div>
	  </div>
<?php $this->need('includes/comments.php'); ?>
	</main>
<?php $this->need('includes/footer.php'); ?>