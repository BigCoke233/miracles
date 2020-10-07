<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div><!-- 结束 pjax-container -->
	<!-- Footer Information -->
    <footer>
      <div class="footer-info footer-dark">
		<p id="custom-footer"><?php $this->options->footerEcho(); ?></p>
		<p class="copyright"><span id="copyright">Powered by <a href="http://typecho.org">Typecho</a> | Theme <a href="https://github.com/BigCoke233/miracles" id="copyright-name">Miracles</a> by <a href="https://guhub.cn" id="copyright-author">Eltrac</a></span><br>
		Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->SiteUrl(); ?>"><?php $this->options->title(); ?></a>, All rights reserved.<br>
        <?php 
		echo $this->options->build_time;
		gtecho('footerTexts','startTime'); 
		echo " <span id=\"build-time\"></span>";
		if($faces=$this->options->anime_face){
		  $faces = explode("&&",$faces);
		  $faces = "<span class=\"anime-face\">".$faces[mt_rand(0,count($faces)-1)]."</span>";
		}
		if($faces && $this->options->build_time) echo $faces;
		?></p>
	  </div>
    </footer>
	<!-- Raised Buttons -->
	<div class="fixed-tools">
	  <button class="fixed-button gotop-button hint--top" data-tooltip="<?php gtecho("otherTexts","goTop"); ?>" id="gotop"><i class="iconfont icon-chevron-up"></i></button>
	</div>
	<!-- JavaScript Require-->
	<?php
	$js_files=array("jquery","pjax.jquery","gazeimg","nprogress","OwO.min","highlight","highlight-line-number","pangu","qrcode.min","details-element-polyfill","alertify");
	if($this->options->customCDN): $custom=$this->options->customCDN; else: $custom=Helper::options()->themeUrl("","Miracles"); endif;
	Utils::addRequires($js_files,"js",$this->options->CDN,$custom);
	?>
	<!-- Options --><!--<nocompress>-->
	<script>var navSlide = <?php if($this->options->navSlide==1):?>false<?php else:?>true<?php endif;?>;
	var panguLoadAllow = <?php if($this->options->pangu==1):?>false<?php else:?>true<?php endif;?>;
	var allowNavAero = <?php if($this->options->navAero==1):?>false<?php else:?>true<?php endif;?>;
	var siteurl = '<?php $this->options->SiteUrl() ;?>';
	var owoJson = '<?php Utils::indexTheme('assets/OwO.json'); ?>';
	var faviconUrl = '<?php if($this->options->favicon):$this->options->favicon();else:echo Utils::indexTheme('favicon.ico');endif;	?>';
	var faviconDark = <?php $faviconDarkExist = file_exists('/faviconDark.ico');
	if($faviconDarkExist=true): echo 'true'; else: echo 'false'; endif; ?>;
	var commentSubmit = '<?php gtecho('commentFormTexts','submitLoading'); ?>';
	var commentSubmitLoading = '<?php gtecho('commentFormTexts','submit'); ?>';
	var footerTimeDay = '<?php gtecho('footerTexts','startTimeDay'); ?>';
	var footerTimeHour = '<?php gtecho('footerTexts','startTimeHour'); ?>';
	var footerTimeMin = '<?php gtecho('footerTexts','startTimeMin'); ?>';
	var footerTimeSec = '<?php gtecho('footerTexts','startTimeSec'); ?>';
	var footerTimeYear = '<?php gtecho('footerTexts','startTimeYear'); ?>';
	<?php if($this->options->pjax && $this->options->pjax!=0) :?>var loadPjax = true;
    beforePjax = function() {NProgress.start();};
	afterPjax = function() {owoLoad();<?php $this->options->pjax_complete(); ?>};<?php endif; ?></script><!--</nocompress>-->
	<!-- Script that must be after-->
	<?php
	$js_files=array("miracles.min","cmt.miracles");
	if($this->options->customCDN): $custom=$this->options->customCDN; else: $custom=Helper::options()->themeUrl("","Miracles"); endif;
	Utils::addRequires($js_files,"js",$this->options->CDN,$custom);
	?>
	<!-- JavaScript -->
	<!--<nocompress>--><script>
	<?php if($this->options->build_time)echo "startTime(\"".$this->options->build_time."\");" ?>
	</script><!--</nocompress>-->
	<!-- Send News and Loaders -->
	<script><?php if($this->is('post') || $this->is('page')): ?>owoLoad();<?php endif; ?><?php $this->options->jsEcho(); ?></script>
    <!-- Others -->
	<?php $this->footer(); ?>
  </body>
</html>
<?php if($GLOBALS['miraclesIfCompressHTML']=='on') {
	$html_source = ob_get_contents(); //获取 ob 截取内容
	ob_clean(); print Utils::compressHtml($html_source); ob_end_flush(); //完成截取、压缩 HTML
} ?>
<!--

Powered by Typecho,
Theme Miracles by
 _____ _ _                  
| ____| | |_ _ __ __ _  ___ 
|  _| | | __| '__/ _` |/ __|
| |___| | |_| | | (_| | (__ 
|_____|_|\__|_|  \__,_|\___|

Repo: https://github.com/BigCoke233/miracles

-->
