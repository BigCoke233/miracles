<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 追番页面
 * 
 * @author Kengwang
 * @version 1.0.1alpha
 * @for BigCoke233/miracles
 * @description 目前暂时用了FormatList,这样效率可能较低,下个版本会修复
 *
 * @package custom
 */
$this->need('includes/head.php');
$this->need('includes/header.php');
$this->need('includes/bgmapi.php');
if ($this->fields->uid == !'' && $this->fields->sessdata == !'') {
    bilibili::setUserInfo($this->fields->uid, $this->fields->sessdata);
    if (empty($_GET['page']) || $_GET['page'] == 0) $page = 1; else $page = $_GET['page'];
    $bgmdataraw = bilibili::getFollowingListRaw($page);
    $bgmlist = bilibili::getFormatList($bgmdataraw['data']['list']);
} else {
    $bgmdataraw = array();
    $bgmlist = array();
}

//  Uncomment for debugging
/*
if ($_GET['dbg'] == 'fuck') {
    echo "<pre>";
    print_r($bgmlist);
    echo "</pre>";
}
if ($_GET['dbg'] == 'rawlist') {
    echo "<pre>";
    print_r($bgmdataraw);
    echo "</pre>";
}
*/
?>
    <main class="main-container container">
        <div class="post-body">
            <br><br><br>
            <div class="about">
                <div class="about-avatar">
                    <!-- 头像 -->
                    <?php if ($this->options->avatar == ''): echo $this->author->gravatar(500);
                    else : ?><img src="<?php $this->options->avatar(); ?>"
                                  alt="<?php echo $this->author(); ?>"><?php endif; ?>
                    <h2 class="about-name"><?php echo $this->author(); ?> の 追番</h2>
                </div>
                <div class="about-social">
                    <!-- bilibili按钮 -->
                    <?php if ($this->fields->uid == !''): ?>
                        <a href="https://space.bilibili.com/<?php echo $this->fields->uid(); ?>" target="_blank"
                           title="Bilibili"><i class="iconfont icon-bilibili-"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="post-content" id="post-content">
                <div id="readTip" hidden></div>
                <!-- 文章内容 -->
                <?php $this->content(); ?>
            </div>
            <div class="post-list" style="margin-top: 100px;">
                <!-- 番剧循环开始 -->
                <br>
                <?php
                if ($bgmdataraw['data']['total'] != 0): //没有东西
                    foreach ($bgmlist as $bgm) : ?>
                        <br>
                        <br>
                        <div class="post-item">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3 post-banner-box">
                                        <a href="<?php echo $bgm['link']; ?>" class="post-link">
                                            <div class="post-banner">
                                                <img alt="<?php echo $bgm['name']; ?>" src="<?php echo $bgm['img'] ?>"
                                                     data-original="<?php echo $bgm['img'] ?>" style="filter: none;">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-9 post-item-content">
                                        <a href="<?php echo $bgm['link']; ?>" class="post-link">
                                            <h1 class="post-title"><?php echo $bgm['name']; ?></h1>
                                        </a>
                                        <p class="post-excerpt">
                                            <?php echo $bgm['des']; ?>
                                        </p>
                                        <p class="post-meta">
                                            看到 <?php echo $bgm['watched'] . "/" . $bgm['all'] ?> 话
                                            <br>
                                            <i class="iconfont icon-block"></i>
                                            <?php
                                            // 暂时用bilibili你手动分的类来,具体可见include/bgmapi.php
                                            if ($bgm['basket'] == 0) echo '想看';
                                            if ($bgm['basket'] == 1) echo '在看';
                                            if ($bgm['basket'] == 2) echo '看完';
                                            ?>&emsp;<i class="iconfont icon-clock"></i> 更新至
                                            <?php echo $bgm['new']['title']; ?>
                                        </p>
                                        <p class="post-button-box large-screen">
                                            <a href="<?php echo $bgm['link']; ?>" class="button post-button">一起看~</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                else: ?>
                    <h1 class="about-name">啥也没有呐 !!!∑(ﾟДﾟノ)ノ</h1>
                <?php endif; ?>
                <div class="post-item">
                    <div class="post-pagenav">
                        <?php if ($page != 1): ?><a class="post-pagenav-left" href="?page=<?php echo $page - 1; ?>"><i
                                    class="iconfont icon-chevron-left"></i></a> <?php endif; ?>
                        <?php if ($bgmdataraw['data']['pn'] * $bgmdataraw['data']['ps'] < $bgmdataraw['data']['total']): ?>
                            <a class="post-pagenav-right" href="?page=<?php echo $page + 1; ?>"><i
                                        class="iconfont icon-chevron-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <?php $this->need('includes/comments.php');
        ?>
    </main>
<?php $this->need('includes/footer.php');
?>