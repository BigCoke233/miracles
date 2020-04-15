(function($){
	var api = "https://api.github.com/repos/BigCoke233/miracles/releases";
	$.ajax({
      url: api,
      type: "GET",
      dataType: "json",
      success:function(data){
		var latest = data[0]['tag_name'];
		var assets_url = data[0]['assets_url'];
		
		if(version==latest){
		    $("#miracles-update").html("，你已经是最新版了！");
		}
		else if(version<latest){
		    $("#miracles-update").html("，有可下载的新版本（"+latest+"）");
			$.ajax({
           	  url: assets_url,
              type: "GET",
              dataType: "json",
              success:function(assets_data){
			    var downlink = assets_data[0]['browser_download_url'];
				$("#miracles-update").append('，<a href="'+downlink+'" class="miracles-update-down">点击下载最新版</a>。');
		      }
		    });
		}
		else if(version>latest){
			$("#miracles-update").html("，看起来你是在使用开发版。");
		}
		else {
			$("#miracles-update").html("，哇哦，你个 BigHack，居然召唤了根本不可能的错误。");
		}
		console.log("Miracles 最新发行版："+latest);
		$("#miracles-update").removeClass("waiting");
	  },
	  error:function(){
		$("#miracles-update").html("最新版本获取失败，刷新试试？");
		$("#miracles-update").removeClass("waiting").css('color', 'red');
		
	  }
	});
})(jQuery);