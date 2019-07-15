//dark
function Dark() {
	$("body").toggleClass("body-dark");
}
//GoTop
function GoTop() {
	$('body,html').animate({scrollTop:0},500);
	document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
//LazyLoad
$(function() {
    $("img").lazyload({effect: "fadeIn"});
});