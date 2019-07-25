/**
 *  Ajax Comment
 *  半成品，还有报错，所以没有引用
 */
var replyTo = '';
var bindButton = function() {
    //绑定“评论回复”和“取消回复”的事件
    $(".comment-reply a").click(
        function () {
            replyTo = $(this).parent().parent().parent().parent().parent().parent().attr("id");
        }
    );
    $(".cancel-comment-reply a").click(function () { replyTo = ''; });
}
function commentCounts() {
    //显示在评论区的评论数加一
    var counts = parseInt($(".comment-title").text());
    $(".comment-title").html($(".comment-title").html().replace(/\d+/, counts + 1));
};
function beforeSendComment() {
    //发送前的一些处理
    $(".comment-submit button").text("提交中");
}
function afterSendComment(ok) {
    //发送后的处理
    //清空replyTo变量，以及结束过渡动画、重新绑定回复按钮等等
    //ok作为一个评论或失败的标志
 
    if (ok) {
        $(".comment-textarea").val('');
        replyTo = '';
    }
    bindButton();
}
//主体部分
beforeSendComment();
$("#comment-form").submit(function() {
    //监听评论表单submit事件
    var commentData = $(this).serializeArray(); //获取表单POST的数据
    beforeSendComment();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: commentData,
        error: function(e) {
            //失败的处理
            //这里比较随意，比如可以直接刷新页面
            console.log('Ajax Comment Error');
            window.location.realod();
        },
        success: function(data) {
          if (!$('.comments', data).length) {
            var msg = $('title').eq(0).text().trim().toLowerCase() === 'error' ? $('.container', data).eq(0).text() : '评论提交失败！';
            alertSend(msg);
            afterSendComment(false);
            return false;
          }
        }
    })
    return false;
});
var newComment;
/** 获取新评论的id */
newCommentId = $(".comment-list", data).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) { return a - b }).pop();
if(replyTo === '') {
        if(!$('.comment-list').length) {
            //检查是否已有评论
            newComment  = $("#li-comment-" + newCommentId, data);
            //没有的话需要先嵌入评论列表的结构
            //具体结构需要参照评论的模板而定，参照下图
            $('.comment-title').after('<div class="comment-container"><ol class="comment-list"></ol></div>');
            //插入评论
            $('.comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
        }
        else if($('.prev').length) {
            //这里是当前评论不在第一页的情况
            //所以这里可以进行比如跳转到第一页的操作，当然也可以进行别的操作
            $('.comment-pagenav ul li a').eq(1).click();
        }
        else {
            //当前页面直接在最前面插入评论
            newComment  = $("#li-comment-" + newCommentId, data);
            $('.comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
        }
        //页面滑动到评论列表头部
        $('html,body').animate({scrollTop:$('.comment-title').offset().top - 100},1000);
    }
else {
    //取数据
    newComment = $("#li-comment-" + newCommentId, data);
    //处理子级评论
    if ($('#' + replyTo).find('.comment-children').length) {
        //当前父评论已经有嵌套的结构
        //直接插入新的评论
        $('#' + replyTo + ' .comment-children .comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
        TypechoComment.cancelReply();
    }
    else {
        //当前父评论没有嵌套的结构
        //先构建嵌套的结构再进插入子评论
        //插入的结构视模板具体情况而定
        $('#' + replyTo).append('<div class="comment-children"><ol class="comment-list"></ol></div>');
        $('#' + replyTo + ' .comment-children .comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
        TypechoComment.cancelReply();
    }
}
commentCounts();
afterSendComment(true);
alertSend("评论提交成功！");