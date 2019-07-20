<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content">
		  <h1 class="error-title">404</h1>
		  <p style="text-align:center">
		    <span>糟糕，我家猫咪走丢了！</span><br /><br />
		    <a href="<?php $this->options->SiteUrl(); ?>" class="button error-button no-line">返回首页</a>
		  </p>
		</div>
	  </div>
	</main>
<?php $this->need('includes/footer.php'); ?>