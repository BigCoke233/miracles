<?php
/**
 * 归档页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/head.php');
$this->need('includes/header.php');
?>
    <main class="main-container container">
	  <div class="post-body">
	    <div class="post-content page-content">
          <h2>文章标签</h2>
		  <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); ?>
          <?php if($tags->have()): ?>
          <ul class="tags-list">
          <?php while ($tags->next()): ?>
            <li class="tags-item"><a href="<?php $tags->permalink(); ?>" rel="tag" class="no-line" title="有 <?php $tags->count(); ?> 篇文章在这个标签下"><?php $tags->name(); ?></a></li>
          <?php endwhile; ?>
          </ul>
		  <?php else: ?>
            <p><?php _e('看来这个博主没有写标签的习惯~'); ?></p>
          <?php endif; ?>
		  <br />
		  <h2>文章归档</h2>
		  <ul class="archives-list">
		    <?php
            $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;   
    $output = '<div id="archives">';   
    while($archives->next()):   
        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            $output .= '<h3 class="archives-year">'. $year .' 年</h3>'; //输出年份   
        }    
        $mon = $mon_tmp;    
        $output .= '<li><a href="'.$archives->permalink .'" class="no-line"><span class="archives-date">'. $mon .'-'.date('d ',$archives->created).'</span>&nbsp;&nbsp;'. $archives->title .'</a></li>'; //输出文章日期和标题   
    endwhile;   
    $output .= '</li></div>';
    echo $output;
           ?>
		  </ul>
		</div>
	  </div>
	</main>
<?php $this->need('includes/footer.php'); ?>