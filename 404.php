<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>

    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content">
		  <h1 class="404-title" style="text-align:center">是 404 的香气呢</h1>
		  <p style="text-align:center">
		    <span style="font-size:16px;">要不试试下面这个神奇的按钮吧<br />
			↓</span><br />
		    <a href="<?php $this->options->SiteUrl(); ?>" class="404-button">返回首页</a>
		  </p>
		</div>
	  </div>
	</main>



<?php $this->need('includes/footer.php'); ?>