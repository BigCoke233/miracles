<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div><!-- 结束 pjax-container -->
	<!-- Footer Information -->
    <footer>
      <div class="footer-info footer-dark">
	    <p class="copyright">&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a>  All rights reserved.<br />
		Powered by <a href="http://typecho.org">Typecho</a> | Theme <a href="https://guhub.cn/p/miracles.html">Miracles</a> by <a href="https://guhub.cn">Eltrac</a></p>
	    <?php $this->options->footerEcho(); ?>
	  </div>
    </footer>
	<!-- Raised Buttons -->
	<div class="fixed-tools">
	  <button title="返回顶部" class="fixed-button gotop-button" id="gotop" style="color:white;"><i class="iconfont icon-chevron-up"></i></button>
	</div>
	<!-- JavaScript -->
	<?php if($this->options->CDN && $this->options->CDN=1): ?>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/pjax.jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.fancybox.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/jquery.lazyload.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/nprogress.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/OwO.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/highlight.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/highlight-line-number.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/pangu.js"></script>
	<?php if($this->options->cat!=0 || $this->options->customModel!=''): ?><script src="https://cdn.jsdelivr.net/gh/BigCoke233/miracles@<?php echo themeVersion(); ?>/assets/js/l2dwidget.min.js"></script><?php endif; ?>
	<?php else: ?>
    <script src="<?php Utils::indexTheme('assets/js/jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/pjax.jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.fancybox.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.lazyload.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/nprogress.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/OwO.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/highlight.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/highlight-line-number.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/pangu.js'); ?>"></script>
	<?php endif; ?>
	<!-- Varribles and Functions -->
	<script>var siteurl = '<?php $this->options->SiteUrl() ;?>';var owoJson = '<?php Utils::indexTheme('assets/OwO.json'); ?>';<?php if($this->options->customModel!=''): ?>var modelJson = "<?php echo $this->options->customModel(); ?>";<?php else: ?>var modelJson = '<?php if($this->options->cat && $this->options->cat==1){Utils::indexTheme('assets/model/hijiki/assets/hijiki.model.json');}elseif($this->options->cat && $this->options->cat==2){Utils::indexTheme('assets/model/tororo/assets/tororo.model.json');}?>';<?php endif;?><?php if($this->options->ModelHeight!=NULL): ?>var modelHeight = <?php echo $this->options->ModelHeight(); ?>;<?php endif; ?><?php if($this->options->ModelWidth!=NULL): ?>var modelWidth = <?php echo $this->options->ModelWidth(); ?>;<?php endif; ?>
	<?php if($this->options->pjax && $this->options->pjax!=0) :?>var loadPjax = true;
    beforePjax = function() {NProgress.start();}
	afterPjax = function() {owoLoad();<?php $this->options->pjax_complete(); ?>}<?php endif; ?></script>
	<!-- Script that must be after -->
    <?php if($this->options->cat!=0 || $this->options->customModel!=''): ?><script src="<?php Utils::indexTheme('assets/js/l2dwidget.min.js'); ?>"></script><?php endif; ?>
	<script src="<?php Utils::indexTheme('assets/js/miracles.min.js'); ?>"></script>
	<!-- Send News and Loaders -->
	<script><?php if($this->is('index')): ?><?php if($this->options->news==!''): ?>alertSend('公告：<?php echo $this->options->news(); ?>');<?php endif; ?><?php endif; ?><?php if($this->is('post') || $this->is('page')): ?>owoLoad();<?php endif; ?><?php $this->options->jsEcho(); ?></script>
    <!-- Others -->
	<?php $this->footer(); ?>
  </body>
</html>