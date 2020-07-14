<?php 
/**
 * Comments.php
 * 评论处理
 * 
 * Author:  Eltrac(BigCoke233)
 * License: MIT
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class Comments
{
    /**
     * 评论反垃圾
     * from ohmyga233/castle-Typecho-Theme
     *
     * @access public
     */
    public static function AntiSpam($id, $value) {
        echo '<!--<nocompress>-->';
        echo '<script>(function(){var a=document.addEventListener?{add:"addEventListener",focus:"focus",load:"DOMContentLoaded"}:{add:"attachEvent",focus:"onfocus",load:"onload"};var c,d,e,f,b=document.getElementById("'.$id.'");null!=b&&(c=b.getElementsByTagName("form"),c.length>0&&(d=c[0],e=d.getElementsByTagName("textarea")[0],f=!1,null!=e&&"text"==e.name&&e[a.add](a.focus,function(){if(!f){var a=document.createElement("input");a.type="hidden",a.name="_",d.appendChild(a),f=!0,a.value='.$value.'}})))})();</script>';
        echo '<!--</nocompress>-->';
    }

    /**
     * 获取上级评论人
     */
    public static function getCommentHF($coid){
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('text','author','status')
                ->from('table.comments')
                ->where('coid = ?', $parent));
            $author = $arow['author'];
            $status = $arow['status'];
            if($author){
                if($status=='approved'){
                    $href   = '<a class="at" uid="'.$parent.'" href="#li-comment-'.$parent.'">@'.$author.'</a>';;
                }else if($status=='waiting'){
                    $href   = '<a>评论审核中···</a>';
                }
            }
            echo $href;
        } else {
            echo "";
        }
    }
}
