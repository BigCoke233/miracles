<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div><!-- 结束 pjax-container -->
	<!-- 页脚信息 -->
    <footer>
      <div class="footer-info footer-dark">
	    <p class="copyright">&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a>  All rights reserved.<br />
		Powered by <a href="http://typecho.org">Typecho</a> | Theme <a href="https://guhub.cn/p/miracles.html">Miracles</a> by <a href="https://guhub.cn">Eltrac</a></p>
	    <?php $this->options->footerEcho(); ?>
	  </div>
    </footer>
	<!-- 悬浮按钮 -->
	<div class="fixed-tools">
	  <button onclick="GoTop()" title="返回顶部" class="fixed-button gotop-button"  style="color:white;"><i class="iconfont icon-chevron-up"></i></button>
	</div>
	<!-- JavaScript -->
	<?php if($this->options->CDN && $this->options->CDN=1): ?>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/pjax.jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.fancybox.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.lazyload.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/nprogress.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/OwO.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/prism.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/pangu.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/l2dwidget.min.js"></script>
	<?php else: ?>
    <script src="<?php Utils::indexTheme('assets/js/jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/pjax.jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.fancybox.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.lazyload.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/nprogress.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/OwO.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/prism.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/pangu.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/l2dwidget.min.js'); ?>"></script>
	<?php endif; ?>
	<script>var siteurl = '<?php $this->options->SiteUrl() ;?>';
	var owoJson = '<?php Utils::indexTheme('assets/OwO.json'); ?>';
	var modelJson = '<?php if($this->options->cat && $this->options->cat==1){Utils::indexTheme('assets/model/hijiki/assets/hijiki.model.json');}elseif($this->options->cat && $this->options->cat==2){Utils::indexTheme('assets/model/tororo/assets/tororo.model.json');}?>';
	<?php if($this->options->pjax && $this->options->pjax!=0) :?>
	var loadPjax = true;
	beforePjax = function() {NProgress.start();}
	afterPjax = function() {<?php if($this->is('post') || $this->is('page')): ?>owoLoad();<?php endif; ?><?php $this->options->pjax_complete(); ?>}
	<?php endif; ?></script>
	<script src="<?php Utils::indexTheme('assets/js/miracles.min.js'); ?>"></script>
	<script><?php if($this->options->news==!''): ?>alertSend('公告：<?php echo $this->options->news(); ?>');<?php endif; ?>LazyLoad();PrismLoad();<?php if($this->is('post') || $this->is('page')): ?>owoLoad();<?php endif; ?>panguLoad();<?php $this->options->jsEcho(); ?></script>
	<?php $this->footer(); ?>
  </body>
</html>