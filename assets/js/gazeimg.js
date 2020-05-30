// ==================================================
// GazeImg v1.4.1
// 
// 采用 GPLv3 许可证供开源使用
// 或用于商业用途的 GazeImg 商业许可证
// 所有商业应用程序（包括您计划出售的网站，主题和应用程序）
// 都需要具有商业许可证。
//
// Licensed GPLv3 for open source use
// or GazeImg Commercial License for commercial use
//
// http://www.ganxiaozhe.com/p/gazeimg/
// Copyright 2020 Ganxiaozhe
//
// ==================================================
;(function($,window,document){
	'use strict';
	
	if(!$) {return '缺少JQuery！';}
	let g = {t:{}};
	g.colors = [
		"linear-gradient(to right, #C3E1CA, #E6E1BD)","linear-gradient(to right, #D4D3DD, #EFEFBB)",
		"linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%)","linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%)",
		"linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%)",
		"linear-gradient(to top, #c1dfc4 0%, #deecdd 100%)","linear-gradient(to top, #d5d4d0 0%, #d5d4d0 1%, #eeeeec 31%, #efeeec 75%, #e9e9e7 100%);"
	];

	function sizeHandle(opts){
		if(typeof opts!='object'){return false;}

		for (var val in opts){
			opts[val] = parseInt( String(opts[val]).replace(/px/,'') );
		}
		opts.w <= 0 || isNaN(opts.w) && (opts.w=128);
		opts.h <= 0 || isNaN(opts.h) && (opts.h=128);

		if( opts.w<opts.rw && opts.h<opts.rh ){return opts;}

		if(opts.w >= opts.rw && opts.w >= opts.h){
			opts.h = opts.rw / opts.w * opts.h;
			opts.w = opts.rw;
		}
		if(opts.h > opts.rh && opts.h > opts.w){
			opts.w = opts.rh / opts.h * opts.w;
			opts.h = opts.rh;
		}
		return opts;
	}

	$.fn.giLazy = function(data){
		let t = {};
		data || (data = {});
		data.colors || (data.colors=["#000"]);

		this.each(function(){
			let timg = {};
			timg.pw = $(this).parent().width();
			timg.ph = $(this).parent().height();

			t.gisize = 0;
			t.gsrc = $(this).attr('data-gisrc').split(' ');
			$(this).attr('data-gisrc',t.gsrc[0]);
			if(t.gsrc[1] && t.gsrc[1].indexOf('size') > -1){
				t.gisize = t.gsrc[1].replace(/size='(.*?)'/g,'$1').split(',');

				var ti_s = sizeHandle({
					w:t.gisize[0],h:t.gisize[1],
					rw:timg.pw,rh:timg.ph
				});
				$(this).width(ti_s.w).height(ti_s.h);
			}

			// 是否有src数据，若无则替换为div蒙版
			timg.src = $(this).attr('src') || false;
			if(!timg.src){
				// 获取图片具有的css信息即其父元素的长宽 来决定替代图片的遮罩层尺寸
				timg.disp = $(this).css("display");

				timg.msize = $(this).attr('gimask-size') || false;
				if(timg.msize){
					timg.msize = timg.msize.split(',');
				} else {timg.msize = [];}
				typeof timg.msize[0]=='undefined' && (timg.msize[0]=false);
				typeof timg.msize[1]=='undefined' && (timg.msize[1]=false);

				if(t.gisize!=0){
					timg.w = t.gisize[0];
					timg.h = t.gisize[1];
				}
				timg.w = timg.msize[0] || $(this).width();
				timg.h = timg.msize[1] || $(this).height();

				var ti_s = sizeHandle({
					w:timg.w,h:timg.h,
					rw:timg.pw,rh:timg.ph
				});
				timg.w = ti_s.w+'px';timg.h = ti_s.h+'px';

				// 若图片display被设置为了inline 则将遮罩层设为inline-flex 否则继承图片display
				timg.disp == "inline" ? timg.tdisp = "inline-flex" : timg.tdisp = timg.disp;
				timg.tdisp = timg.tdisp.replace(/block/,'flex');
				timg.css = "width:"+timg.w+";height:"+timg.h+";background:"+data.colors[Math.floor(Math.random()*data.colors.length)]+";";

				timg.css += "display:"+timg.tdisp;
				$(this).attr('data-disp',timg.disp).css({"display":"none"}).after('<div class="gi-darken" style="'+timg.css+'"><a href="//ganxiaozhe.com/p/gazeimg/" target="_blank"><div class="gilazy-loader gi-spin"></div></a></div>');
			} else {
				$(this).addClass('gi-darken');
			}

			if( $(this).attr('data-gazeimg')!=undefined ){$(this).giPrePop();}
		}).attr('data-gi-init','');

		setTimeout(()=>{$(window).scroll();},200);

		return this;
	};

	$.fn.giPrePop = function(){
		let t = {};
		this.on("click",function(){
			t.src = $(this).attr('src') || $(this).attr('data-gazeimg');
			if(!t.src){return;}

			t.stage = "<div class='gazeimg-container gi-fadeIn'><div class='gazeimg-bg'></div><div class='gazeimg-inner'><div class='gazeimg-nav'></div><div class='gazeimg-stage'><div class='gazeimg-content'><div class='loader gi-spin'></div></div></div></div><div class='gazeimg-thumbs'></div></div>";
			$('body').append(t.stage).addClass('gazeimg-nobar');

			g.t.gcc=0;
			$('.gazeimg-container').on({
				touchstart: function(e){
					g.t.gcc=1;
					let elem = e.originalEvent.target || e.target;
					if($(elem).is('.gazeimg-content') || $(elem).is('.gazeimg-content *')){
						return;
					}
					giStageClose();g.t.gcc=0;
				},
				mouseup: function(e){
					if(g.t.gcc==1){return;}
					let elem = e.target;
					if($(elem).is('.gazeimg-content') || $(elem).is('.gazeimg-content *')){
						return;
					}
					giStageClose();
				}
			});

			t.i = new Image();
			t.i.src = t.src;
			if(t.i.complete){giShow(t.i);} else {
				t.i.onload = function(){giShow(this);}
			}
		});
	};

	function giShow(img){
		g.itemp = {};
		g.itemp.rw = img.width;g.itemp.rh = img.height;
		giSizeInit(img);

		$('.gazeimg-content').html('<img src="'+img.src+'">');
		$('.gazeimg-content').on({
			mousedown: function(e){
				if(e.which == 3){return;}
				g.itemp.cd = true;g.itemp.clkt = 1;
				$('.gazeimg-content img').css("cursor","grabbing");

				g.t.dx = e.pageX,g.t.dy = e.pageY;
				g.t.tran = $('.gazeimg-content').css('transform').replace(/[^0-9\-,]/g,'').split(',');
				if(g.t.tran.length!=6) {g.t.tran = [0,0,0,0,0,0];}
			},
			mouseleave:function(){
				g.itemp.cd = false;
			},
			mousemove: function(e){
				if(!g.itemp.cd) {return;}
				g.itemp.cd = 'moving';e.preventDefault();

				g.t.x = parseInt(g.t.tran[4]) + e.pageX - g.t.dx;
				g.t.y = parseInt(g.t.tran[5]) + e.pageY - g.t.dy;

				$('.gazeimg-content').css({'transform':'translate('+g.t.x+'px,'+g.t.y+'px)'});
			},
			mouseup: function(e){
				if(e.which == 3 || g.itemp.clkt == 2){return;}
				if(g.itemp.cd!='moving'){giShowEnd();}

				g.itemp.cd = false;$('.gazeimg-content img').css("cursor","grab");
			},
			touchstart:function(e){
				g.itemp.cd = true;g.itemp.clkt++;

				g.t.dx = e.originalEvent.changedTouches[0].pageX;
				g.t.dy = e.originalEvent.changedTouches[0].pageY;
				g.t.tran = $('.gazeimg-content').css('transform').replace(/[^0-9\-,]/g,'').split(',');
				if(g.t.tran.length!=6) {g.t.tran = [0,0,0,0,0,0];}
			},
			touchmove:function(e) {
				if(!g.itemp.cd) {return;}
				g.itemp.cd = 'moving';e.preventDefault();

				g.t.x = parseInt(g.t.tran[4]) + e.originalEvent.changedTouches[0].pageX - g.t.dx;
				g.t.y = parseInt(g.t.tran[5]) + e.originalEvent.changedTouches[0].pageY - g.t.dy;

				$('.gazeimg-content').css({'transform':'translate('+g.t.x+'px,'+g.t.y+'px)'});
			},
			touchend:function(){
				if(g.itemp.cd!='moving' && g.itemp.clkt==1){giShowEnd();}
				g.itemp.cd = false;
			}
		});
		function giShowEnd(){
			let t = {tgt:0};
			t.gzoom = $('.gazeimg-content').attr('data-gzoom') || '';

			if(t.gzoom=='out') {
				$('.gazeimg-content').css({'transform':'translate('+g.itemp.left+'px,'+g.itemp.top+'px) scale(1,1)'});
				$('.gazeimg-content').height(g.itemp.h).width(g.itemp.w).attr({'data-rlong':'y','data-gzoom':'in'});
				t.tgt++;
			}
			if( (g.itemp.rw > g.ww || g.itemp.rh > g.wh) && t.gzoom!='out' ){
				$('.gazeimg-content').css({'transform':'translate('+0+'px,'+0+'px) scale(1,1)'});
				$('.gazeimg-content').height(g.itemp.rh).width(g.itemp.rw).attr({'data-rlong':'n','data-gzoom':'out'});
				t.tgt++;
			}
			if(t.tgt==0){giStageClose();}
		}
	}
	function giSizeInit(img){
		if(!g.itemp) {return false;}

		g.ww = window.innerWidth;g.wh = window.innerHeight;
		g.sw = $('.gazeimg-stage').width();g.sh = $('.gazeimg-stage').height();

		if(!img) {img = $('.gazeimg-content img')[0];}
		g.itemp = giSizeProcess(img);

		$('.gazeimg-content').height(g.itemp.h).width(g.itemp.w);

		$('.gazeimg-content').css({'transform':'translate('+g.itemp.left+'px,'+g.itemp.top+'px) scale(1,1)'});
	}
	function giStageClose(){
		$('.gazeimg-content').height(0).width(0);
		$('.gazeimg-container').fadeOut(500,function(){
			$(this).remove();
			$('body').removeClass('gazeimg-nobar');
		});
	}

	function giSizeProcess(img){
		let t = {};
		g.sw = $('.gazeimg-stage').width();g.sh = $('.gazeimg-stage').height();

		t = sizeHandle({
			w:g.itemp.rw,h:g.itemp.rh,
			rw:g.sw,rh:g.sh
		});
		t.rw = g.itemp.rw,t.rh = g.itemp.rh;

		if(t.w > g.sw) {
			t.w = g.sw;t.h = t.w / t.rw * t.rh;
		}
		if(t.h > g.sh) {
			t.h = g.sh;t.w = t.h / t.rh * t.rw;
		}

		// 获取图片相对于屏幕的各数据
		t.left = parseInt((g.ww - t.w) / 2);t.top = parseInt((g.wh - t.h) / 2);

		return t;
	}

	$(window).resize(function(){giSizeInit();});
	$('img[data-gisrc]:not([data-gi-init])').giLazy({'colors':g.colors});
})(jQuery,window,document);

$(window).scroll(function(){
	let t = {};
	t.deh = document.documentElement.clientHeight;
	$('img[data-gi-init]').each(function(){
		if( $(this).next(".gi-darken").length > 0 ){
			t.ietop = $(this).next(".gi-darken")[0].getBoundingClientRect().top;
		} else {
			t.ietop = $(this)[0].getBoundingClientRect().top;
		}

		if( t.ietop < t.deh ){
			let i = new Image();
			i.src = $(this).attr('data-gisrc');
			i.obj = $(this);

			if (i.complete) {icomplete(i.obj);return;};
			i.onerror = function(){
				if( i.obj.next(".gi-darken").length > 0 ){
					i.obj.next(".gi-darken").html('<a href="'+i.src+'" target="_blank">图片 '+i.src+' 加载失败；</a>').css({'background':'#000'});
				}
				i.obj.removeAttr('data-gisrc').removeAttr('data-gi-init');

				i = i.onload = i.onerror = null;
			};
			i.onload = function(){
				icomplete(i.obj);i = i.onload = i.onerror = null;
			};
		}
	});

	function icomplete(obj){
		obj.next(".gi-darken").remove();
		obj.attr({"src":obj.attr('data-gisrc')}).css({"display":obj.attr('data-disp')}).addClass('gi-fadeIn');
		obj.removeAttr('data-gisrc').removeAttr('data-gi-init');
		setTimeout(()=>{
			obj.css({filter:"brightness(1)"});
		},200);
	}
});
