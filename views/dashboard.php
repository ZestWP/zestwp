<div class="wrap" id="dashboard">
  <div id="side-sortables" class="accordion-container rightPanel">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Visitors / Lead Trends'); ?></h3>
			<div class="inside">
				<div id="high-chart"></div>
			</div>
		</div>
	</div>
  
  
  <div id="side-sortables" class="accordion-container rightPanel">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Email Marketing analytics'); ?></h3>
			<div class="inside">
  <div class="progressWrapper">
    <div class="leftContainer">
      <div class="proWrapper">
        <div class="proLeft">Open Rate </div>
        <div class="proRight">
          <div class="ORateper"></div>
        </div>
        <div class="row">
          <div class="procontainer">
            <div class="progressbar"></div>
          </div>
        </div>
      </div>
      <div class="proWrapper">
        <div class="proLeft">Click Rate </div>
        <div class="proRight">
          <div class="cRateper"></div>
        </div>
        <div class="row">
          <div class="pro-crate-container">
            <div class="cprogressbar"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="rightContainer">
      <div class="box">
        <div>
          <canvas class="sents" width="90%" height="90%"/>
        </div>
        <div class="slogan">Sent</div>
      </div>
      <div class="box">
        <div>
          <canvas class="fails" id="lGreen" width="90%" height="90%"/>
        </div>
        <div class="slogan">Failed</div>
      </div>
      <div class="box">
        <div>
          <canvas class="opens" width="90%" height="90%"/>
        </div>
        <div class="slogan">Opened</div>
      </div>
      <div class="box">
        <div>
          <canvas class="clicks" width="90%" height="90%"/>
        </div>
        <div class="slogannew">Clicked</div>
      </div>
    </div>
  </div>
  </div>
		</div>
	</div>

	<?php if(sizeof($tasks)>0) { ?>
	<div id="side-sortables" class="accordion-container rightPanel">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Tasks'); ?></h3>
			<div class="inside">
			
	<div class="row calendar">
  <div id="task" class="demo1">
	<a title="" href="#" class="prev"></a><span class="Monthyear"></span><a title="" href="#" class="next"></a>
	<div class="slides">
	
		
		<?php 
		foreach($tasks as $k=>$task){
			$a =  array_chunk($task, 3);
			foreach($a as $t){
				$i = 0;
				echo '<div class="slideDiv"><div class="title">'.$k.'</div>';
				foreach($t as $v){
					if($i%3 == 0) $cl = " blue grey";
					if($i%3 == 1) $cl = " orange pyellow";
					if($i%3 == 2) $cl = " green lgreen";
					
					
						echo '<div class="calendar-entry'.$cl.'">
							<div class="calendar_left ">
								<div class="month">'.date('M d', $v['date']).'</div>
								<div class="event">'.$v['name'].'</div>
							</div>
							<div class="calendar_right ">'.$v['description'].'</div>
						 </div>';
					
					$i++;
				
				}
				echo '</div>';
				
			}
		}
		
		?>
			
		 
		
            
        </div>
  </div>
</div>
	
	</div>
	</div>
	</div>
	<?php } ?>
</div>
<script>
var xaxis = [];var yaxis = [];var yleads = [];var sents=0,fails=0,sentP=0,failP=0, browser=0,email=0, browserP=0, emailP=0;
</script>
<?php 
	echo '<script>';
	$x = array();
	if(sizeof($visitors)>0){
	foreach($visitors as $k=>$v){
		$x[$k] = $k;
		echo "xaxis.push('{$k}'.toString());";
		echo "yaxis.push({$v});";
		if(isset($leads[$k])) echo "yleads.push({$leads[$k]});";
		else echo "yleads.push(0);";
	
	}
	}
	if(sizeof($leads)>0){
	foreach($leads as $k=>$v){
		if($x[$k] == $k) continue;
		echo "xaxis.push('{$k}'.toString());";
		echo "yleads.push({$v});";
		if(isset($leads[$k])) echo "yaxis.push({$leads[$k]});";
		else echo "yaxis.push(0);";
	
	}
	}
	
	if(sizeof($mails)>0){
		$t =  $mails['total']+$mails['fail'];
		$sents = $mails['total'] / $t *100;
		$fails = $mails['fail'] / $t *100;
		echo "var sents = {$mails["total"]};";
		echo "var fails = {$mails["fail"]};";
		echo "var sentP = {$sents};";
		echo "var failP = {$fails};";
		
		if(sizeof($rate)>0){
			//$t =  $mails['browser']+$mails['email'];
			$sents = $rate['browser'] / $mails['total'] *100;
			$fails = $rate['email'] / $mails['total'] *100;
			echo "var browser = {$rate["browser"]};";
			echo "var email = {$rate["email"]};";
			echo "var browserP = {$sents};";
			echo "var emailP = {$fails};";
		}
	}
	
	
	
	echo '</script>';
?>

<script>
jQuery(document).ready( function($) {
	$('.wrap').delegate('.handlediv', 'click', function(){
		$(this).siblings('.inside').slideToggle();
		$(this).toggleClass('handleclose');
	});
	
	$("div#task").jContent({orientation: 'horizontal',
                                         easing: "easeOutCirc", 
                                         duration: 500});
});
</script>
