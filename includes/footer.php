<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div>
    <footer>
      <div class="footer-info footer-dark">
	    <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a>  All rights reserved.<br />
		Powered by <a href="http://typecho.org">Typecho</a> | Theme <a href="https://guhub.cn/p/miracles.html">Miracles</a> by <a href="https://guhub.cn">Eltrac</a></p>
	    <?php $this->options->footerEcho(); ?>
	  </div>
    </footer>
	
	<div class="fixed-tools">
	  <button onclick="GoTop()" title="返回顶部" class="gotop-button"  style="color:white;"><i class="iconfont icon-chevron-up"></i></button>
	  <button onclick="Dark()" title="护眼模式" class="dark-button"><i class="iconfont icon-envira"></i></button>
	</div>
	
    <script src="<?php Utils::indexTheme('assets/js/jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/pjax.jquery.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.fancybox.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/jquery.lazyload.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/nprogress.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/OwO.min.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/prism.js'); ?>"></script>
	<script src="<?php Utils::indexTheme('assets/js/main.js'); ?>"></script>
	
	<script>
	//pjax-loader
    var siteurl = '<?php $this->options->SiteUrl() ;?>';
    $(document).pjax('a[href^="'+siteurl+'"]:not(a[target="_blank"], a[no-pjax])', {
      container: '#pjax-container',
      fragment: '#pjax-container',
      timeout: 8000
    }).on('pjax:send', function () {
	  NProgress.start();
	  GoTop();
    }).on('pjax:complete', function () {
      NProgress.done();
	  if (typeof Prism !== 'undefined') {
      var pres = document.getElementsByTagName('pre');
      for (var i = 0; i < pres.length; i++){
      if (pres[i].getElementsByTagName('code').length > 0)
        pres[i].className  = 'line-numbers';}
      Prism.highlightAll(true,null);}
	  $('form#login-form').addClass('need-refresh');
	  var OwO_demo = new OwO({logo: 'OωO表情',container: document.getElementsByClassName('OwO')[0],target: document.getElementsByClassName('OwO-textarea')[0],api: '<?php Utils::indexTheme('assets/OwO.json'); ?>',position: 'down',width: '400px',maxHeight: '250px'});
	  jQuery(function() {jQuery("img").lazyload({threshold: 200,effect: "fadeIn"});});
    });
	//LazyLoad
	jQuery(function() {jQuery("img").lazyload({threshold: 200,effect: "fadeIn"});});
	//解决刷新后不显示行号的问题
    var pres = document.getElementsByTagName('pre');
    for (var i = 0; i < pres.length; i++){if (pres[i].getElementsByTagName('code').length > 0)pres[i].className  = 'line-numbers';}
	//Search
    function Search() {$(".search").toggleClass("ready");$(".search-close").toggleClass("ready");}
    //mobileMenu
	function toggleMobileMenu() {$(".mobile-menu").toggleClass("ready");$(".mobile-menu-close").toggleClass("ready");}
	//Login
    function Login() {$(".login").toggleClass("ready");$(".login-close").toggleClass("ready");}
	//OwO
	var OwO_demo = new OwO({logo: 'OωO表情',container: document.getElementsByClassName('OwO')[0],target: document.getElementsByClassName('OwO-textarea')[0],api: '<?php Utils::indexTheme('assets/OwO.json'); ?>',position: 'down',width: '400px',maxHeight: '250px'});
	</script>
    <?php $this->footer(); ?>
	
	<?php if($this->options->jsEcho && $this->options->jsEcho!=''): ?>
	<style>
	<?php $this->options->jsEcho(); ?>
	</style>
	<?php endif; ?>
  </body>
</html>
