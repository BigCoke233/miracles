<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Contents
{
    /**
     * 内容解析器入口
     * 传入的是经过 Markdown 解析后的文本
     */
    static public function parseContent($data, $widget, $last)
    {
		$db=Typecho_Db::get();
        $load_image = $db->fetchAll($db->select('value')->from('table.options')->where('name = %s', "theme:Miracles")->limit(1));
        $load_image = explode("\";",explode("\"",explode("\"loading_image\";",$load_image[0]["value"],2)[1],2)[1],2)[0];
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
			//ParseOther
			$text = Contents::parseEmo(Contents::parsePrism(Contents::parseImages(Contents::parseHeadings(Contents::parseTextColor(Contents::parseRuby(Contents::parseTip(Contents::parseLink($text))))))));
			//LazyLoad
	        $text = preg_replace('/<img (.*?)src(.*?)(\/)?>/','<img $1src="/usr/themes/Miracles/images/loading/'.$load_image.'.gif" data-original$2 />',$text);
        }
        return $text;
    }
	
	/**
	 *  解析 Prism
	 */
	static public function parsePrism($text){
		//未定义的代码语言视为 html
		$text = preg_replace('/<pre><code>/s','<pre><code class="language-html">',$text);
		return $text;
	}
	
	/**
	 *  解析图片
	 */
	static public function parseImages($text){
		//FancyBox
	    $text = preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/s','<center><a data-fancybox="gallery" href="${2}" class="gallery-link"><img${1}src="${2}"${3}></a></center>',$text); 
	    
		return $text;
    }
	
	/**
	 *  解析章节链接
	 */ 
	static public function parseHeadings($text){
		$reg='/\<h([2-3])(.*?)\>(.*?)\<\/h.*?\>/s';
        $text = preg_replace_callback($reg, array('Contents', 'parseHeaderCallback'), $text);
		
		return $text;
	}
	
	/**
	 *  解析 Text-Color
	 */
	static public function parseTextColor($text){
		$text = preg_replace('/\&\{(.*?)\|(.*?)\|(.*?)\}/s','<span style="color:${2};background:${3}">${1}</span>',$text);
		return $text;
	}
	
	/**
	 *  解析 Ruby
	 */
	static public function parseRuby($text){
		$reg = '/\{\{(.*?):(.*?)\}\}/s';
        $rp = '<ruby>${1}<rp>(</rp><rt>${2}</rt><rp>)</rp></ruby>';
        $text = preg_replace($reg,$rp,$text);
		
		return $text;
	}
	
	/**
	 *  解析 Tip
	 */
	static public function parseTip($text){
		//Tip without var
		$text = preg_replace('/\[tip\](.*?)\[\/tip\]/s','<div class="tip"><div class="container-fluid"><div class="row"><div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div><div class="col-11 tip-content">${1}</div></div></div></div>',$text);
		//Tip
		$text = preg_replace('/\[tip type="(.*?)"\](.*?)\[\/tip\]/s','<div class="tip ${1}"><div class="container-fluid"><div class="row"><div class="col-1 tip-icon"><i class="iconfont icon-info"></i></div><div class="col-11 tip-content">${2}</div></div></div></div>',$text);
        //Tip Group
		$text = preg_replace('/\[tip\-group\](.*?)\[\/tip\-group\]/s','<div class="tip-group">${1}</div>',$text);
		
		return $text;
	}
	
	/**
	 *  解析友链
	 */
	static public function parseLink($text){
		//解析友链盒子
	    $reg = '/\[links\](.*?)\[\/links\]/s';
        $rp = '<div class="links-box container-fluid"><div class="row">${1}</div></div>';
        $text = preg_replace($reg,$rp,$text);
        //解析友链项目
	    $reg = '/\[(.*?)\]\{(.*?)\}\((.*?)\)\+\((.*?)\)/s';
        $rp = '<div class="col-lg-2 col-6 col-md-3 links-container">
		    <a href="${2}" title="${4}" target="_blank" class="links-link">
			  <div class="links-item">
			    <div class="links-img" style="background:url(\'${3}\');width: 100%;padding-top: 100%;background-repeat: no-repeat;background-size: cover;"></div>
				<div class="links-title">
				  <h4>${1}</h4>
				</div>
		      </div>
			  </a>
			</div>';
        $text = preg_replace($reg,$rp,$text);
		
		return $text;
	}
	
	/**
	 *  解析 owo 表情
	 */
	static public function parseEmo($content) {
		$content = preg_replace_callback('/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血)\s*\)/is',
        array('Contents', 'parsePaopaoBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
        array('Contents', 'parseAruBiaoqingCallback'), $content);
        $content = preg_replace_callback('/\:\&\(\s*(.*?)\s*\)/is',
        array('Contents', 'parseTweBiaoqingCallback'), $content);

        return $content;
	}
	
	/**
     * 泡泡表情回调函数
     * 
     * @return string
     */
    private static function parsePaopaoBiaoqingCallback($match)
    {
        return '<img class="owo-img" src="/usr/themes/Miracles/images/biaoqing/paopao/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

    /**
     * 阿鲁表情回调函数
     * 
     * @return string
     */
    private static function parseAruBiaoqingCallback($match)
    {
        return '<img class="owo-img" src="/usr/themes/Miracles/images/biaoqing/aru/'. str_replace('%', '', urlencode($match[1])) . '_2x.png">';
    }

    /**
     * 推特表情回调函数
     * 
     * @return string
     */
    private static function parseTweBiaoqingCallback($match)
    {
        return '<img class="owo-img" src="/usr/themes/Miracles/images/biaoqing/twemoji/'. str_replace('%', '', $match[1]) . '.png">';
    }
	
	/**
	 * 解析自定义导航栏
	 */
	static public function paresNav($data) {
		$de_json = json_decode($data, true);
		$count_json = count($de_json);
        for ($i = 0; $i < $count_json; $i++) {
            $title = $de_json[$i]['title'];
            $link = $de_json[$i]['link'];
			//输出导航
			echo '<a href="'. $link .'">'. $title .'</a>';
        }
	}
	
	
	//从这里开始的代码来自 熊猫小A (https://imalan.cn)
	 
	/**
     * 为内容中的标题编号
     */
    static private $CurrentTocID = 0;
    static public function parseHeaderCallback($matchs)
    {
        // 增加单独标记，否则冲突
        $id = 'toc_'.(self::$CurrentTocID++);
        return '<h'.$matchs[1].$matchs[2].' id="'.$id.'">'.$matchs[3].'<a href="#'.$id.'" title="章节链接" class="post-toc-link no-line"><i class="iconfont icon-paragraph"></i></a></h'.$matchs[1].'>';
    }
	
	/**
     * 根据 id 返回对应的对象
     * 此方法在 Typecho 1.2 以上可以直接调用 Helper::widgetById();
     * 但是 1.1 版本尚有 bug，因此单独提出放在这里
     * 
     * @param string $table 表名, 支持 contents, comments, metas, users
     * @return Widget_Abstract
     */
    public static function widgetById($table, $pkId)
    {
        $table = ucfirst($table);
        if (!in_array($table, array('Contents', 'Comments', 'Metas', 'Users'))) {
            return NULL;
        }
        $keys = array(
            'Contents'  =>  'cid',
            'Comments'  =>  'coid',
            'Metas'     =>  'mid',
            'Users'     =>  'uid'
        );
        $className = "Widget_Abstract_{$table}";
        $key = $keys[$table];
        $db = Typecho_Db::get();
        $widget = new $className(Typecho_Request::getInstance(), Typecho_Widget_Helper_Empty::getInstance());
        
        $db->fetchRow(
            $widget->select()->where("{$key} = ?", $pkId)->limit(1),
                array($widget, 'push'));
        return $widget;
    }

    /**
     * 输出完备的标题
     */
    public static function title(Widget_Archive $archive)
    {
        $archive->archiveTitle(array(
            'category'  =>  '分类 %s 下的文章',
            'search'    =>  '包含关键字 %s 的文章',
            'tag'       =>  '标签 %s 下的文章',
            'author'    =>  '%s 发布的文章'
        ), '', ' - ');
        Helper::options()->title();
    }
}