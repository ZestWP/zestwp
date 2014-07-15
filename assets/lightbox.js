jQuery(document).ready( function($) {
    $(".wrap").delegate("a[rel=lightbox]", 'click',function(){
        $href=$(this).attr('href');
        $rev=$(this).attr('setDimension');
        if(typeof($rev)!='undefined') {
            $dimension=$rev.split('X');
            $w=$dimension[0];
            $h=$dimension[1];
        }
        else {$w=500;$h=250;}
        $fade=$('<div></div>').addClass('fade').hide()
                .css({'opacity':'0.55', 'position':'fixed', 'z-index':9997, 'top':0, 'left':0, 'width':'100%', 'height':'100%', 'background-color':'#000000'});
        $posw=$(document).width();
        $posw=parseInt(($posw-(parseInt($w)+42))/2)+'px';
        $posh=$(window).height();
        $posh=parseInt(($posh-parseInt($h))/2)+'px';
        $cw=parseInt($w)+parseInt($posw)+30;
        $ch=parseInt($posh)-5;
        $box=$('<div></div>').addClass('box').hide()
                .css({'position':'fixed', 'z-index':9998, 'top':$posh, 'left':$posw, 'width':$w+'px', 'height':$h+'px', 'background-color':'#FFFFFF', 'border': '1px solid #333', 'padding':'20px 20px 0 20px', 'border-radius':'8px'});
		$close=$('<div></div>').addClass('close').addClass('zest-remove').hide()
                .css({'position':'fixed', 'z-index':9999, 'top':$ch, 'left':$cw, 'width':'20px', 'height':'20px'});
        $inner=$('<div></div>').css({'overflow':'auto', 'height':'99%'});
        $('body').append($fade).append($box).append($close);
        $box.append($inner);
        $box.fadeIn(600);$fade.fadeIn(400);$close.fadeIn(400);
        $inner.empty().html('<div id="spinnerdiv" style="display:block;margin-left:40%;"><img src="images/spinner.gif"> </div>');
        $.ajax({
            url: $href,
                success: function(data){
                    $inner.html(data);
                }
         });
		$close.click(function(){
			$('.box, .fade, .close').remove();
		});
		$("body").keyup(function(e){
             if (e.keyCode == 27) { $('.box, .fade, .close').remove();}   
        });
        $("body").delegate('.fade, .close','click',function(){
            $('.box, .fade, .close').remove();
        });
        return false;
    });
});