<div class="topBandFiller">
	</div>
	<div class="topBand">
		<div class="visits">User Visits<br/><span class="f30"><?php echo (sizeof($visitors)>0) ? array_sum($visitors) : 0; ?></span></div>
		<div class="seperator"></div>
		<div class="leads">Leads<br/><span class="f30"><?php echo (sizeof($leads)>0) ? array_sum($leads) : 0; ?></span></div>
		<div class="seperator"></div>
		<div class="views">Views<br/><span class="f30"><?php echo (sizeof($rate)>0) ? array_sum($rate) : 0; ?></span></div>
		<div class="seperator"></div>
		<div class="mails">Email sent<br/><span class="f30"><?php echo ((int)$mails['total']); ?></span></div>
	
	</div>
	<div class="wrap" id="dashboard">

	

  <div id="side-sortables" class="accordion-container rightPanel">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Unique visitors / Lead Trends'); ?>
			<div id="chartTabs">
				<span id="year" class="tab">Year</span>
				<span id="month" class="tab active">Month</span>
				<span id="day" class="tab">Day</span>
				<span id="hourly" class="tab">Hourly</span>
			</div></h3>
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
	<?php //Form Analytics?>
	<div id="side-sortables" class="accordion-container rightPanel">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Form analytics'); ?></h3>
			<div class="inside">
			
				
				<div class="gridLeft formAnalytics">
				<div class="grid">
				<div class="tblrow tblheader">
					<div class="cola">Form Name</div>
					<div class="colb">Impressions</div>
					<div class="colc">Submissions</div>
					<div class="cold">Conversion&nbsp;%</div>
				</div>
				<?php if(sizeof($forms)>0){ 
					foreach($forms as $k=>$v){
				?>
				<div class="tblrow">
					<div class="cola"><?php echo $v['name']; ?></div>
					<div class="colb"><?php echo $v['count']; ?></div>
					<div class="colc"><?php echo $v['lead']; ?></div>
					<div class="cold"><?php echo number_format( (($v['count']-$v['lead'])/$v['count'])*100, 2); ?></div>
				</div>
				<?php 
				}
				} else echo '<div class="tblrow">No Forms created</div>'; ?>
			</div>
				
				</div>
				<div class="gridRight formAnalytics">
				<div class="grid">
				<div class="tblrow tblheader">
					<div class="cola">Name</div>
					<div class="colb">Visits</div>
					<div class="colc">Leads</div>
				</div>
				<?php if(sizeof($campaigns)>0){ 
					foreach($campaigns as $k=>$v){
				?>
				<div class="tblrow">
					<div class="cola"><?php echo $v['name']; ?></div>
					<div class="colb"><?php echo $v['count']; ?></div>
					<div class="colc"><?php echo ($v['lead']>$v['count']) ? $v['count'] : $v['lead']; ?></div>

				</div>
				<?php 
				}
				} else echo '<div class="tblrow">No Campaigns created</div>'; ?>
			
				</div>
				
			  </div>
		<br class="clear"/>
	</div>
	</div>
	</div>
	<?php //Form Analytics?>
	
	
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

var xMonth = [];var mVisitor = [];var mLead = [];var sents=0,fails=0,sentP=0,failP=0, browser=0,email=0, browserP=0, emailP=0;
var xDay = [];var dVisitor = [];var dLead = [];
var xYear = [];var yVisitor = [];var yLead = [];
var xHour = [];var hVisitor = [];var hLead = [];
var mIncVis = "", mIncLead = "",yIncVis = "", yIncLead = "";var hIncVis = "", hIncLead = "",  mIncVis = "", mIncLead = "", dIncVis = "", dIncLead = "";
</script>
<?php 	

	$hVisitors = $hLeads = $mVisitors = $mLeads = $dVisitors = $dLeads =	$yVisitors = $yLeads = array();
	if(sizeof($visitors)>0){
	foreach($visitors as $k=>$v){
		$h = date("H", $k);
		if($k >= strtotime('-1 day'))
			$hVisitors[$h] += $v;
		$m = date("M y", $k);
		if($k >= strtotime('-1 year'))
			$mVisitors[$m] += $v;
		$d = date("d M", $k);
		if($k >= strtotime('-1 month'))
			$dVisitors[$d] += $v;
		$d = date("Y", $k);
		if($k >= strtotime('-10 year'))
			$yVisitors[$d] += $v;
	}
	}
	if(sizeof($leads)>0){
	foreach($leads as $k=>$v){
		$h = date("H", $k);
		if($k >= strtotime('-1 day'))
			$hLeads[$h] += $v;
		$m = date("M y", $k);
		if($k >= strtotime('-1 year'))
			$mLeads[$m] += $v;
		$d = date("d M", $k);
		if($k >= strtotime('-1 month'))
			$dLeads[$d] += $v;
		$d = date("Y", $k);
		if($k >= strtotime('-10 year'))
			$yLeads[$d] += $v;
	}
	}



	echo '<script>';
	$x = array();
	if(sizeof($mVisitors)>0){
	foreach($mVisitors as $k=>$v){
		$x[$k] = $k;
		echo "xMonth.push('{$k}'.toString());";
		echo "mVisitor.push({$v});";
		if(isset($mLeads[$k])) echo "mLead.push({$mLeads[$k]});";
		else echo "mLead.push(0);";
	
	}
		$mVS = array_values(array_slice($mVisitors, -2, 2, true));
		if(sizeof($mVS) == 2) echo "mIncVis='".number_format((($mVS[1]-$mVS[0])/$mVS[0]) * 100, 2).  "% Increase in visitors';";
	}
	if(sizeof($mLeads)>0){
	foreach($mLeads as $k=>$v){
		if($x[$k] == $k) continue;
		echo "xMonth.push('{$k}'.toString());";
		echo "mLead.push({$v});";
		if(isset($mLeads[$k])) echo "mVisitor.push({$mLeads[$k]});";
		else echo "mVisitor.push(0);";
	
	}
		$mLS = array_values(array_slice($mLeads, -2, 2, true));
		if(sizeof($mLS) == 2) echo "mIncLead='".number_format((($mLS[1]-$mLS[0])/$mLS[0]) * 100, 2).  "% Increase in Leads';";
	}
	
	if(sizeof($dVisitors)>0){
	foreach($dVisitors as $k=>$v){
		$x[$k] = $k;
		echo "xDay.push('{$k}'.toString());";
		echo "dVisitor.push({$v});";
		if(isset($dLeads[$k])) echo "dLead.push({$dLeads[$k]});";
		else echo "dLead.push(0);";
	
	}	$mVS = array_values(array_slice($dVisitors, -2, 2, true));
		if(sizeof($mVS) == 2) echo "dIncVis='".number_format((($mVS[1]-$mVS[0])/$mVS[0]) * 100, 2).  "% Increase in visitors';";
	}
	if(sizeof($dLeads)>0){
	foreach($dLeads as $k=>$v){
		if($x[$k] == $k) continue;
		echo "xDay.push('{$k}'.toString());";
		echo "dLead.push({$v});";
		if(isset($dLeads[$k])) echo "dVisitor.push({$dLeads[$k]});";
		else echo "dVisitor.push(0);";
	
	}
		$mLS = array_values(array_slice($dLeads, -2, 2, true));
		if(sizeof($mLS) == 2) echo "dIncLead='".number_format((($mLS[1]-$mLS[0])/$mLS[0]) * 100, 2).  "% Increase in Leads';";
	}
	
	if(sizeof($yVisitors)>0){
	foreach($yVisitors as $k=>$v){
		$x[$k] = $k;
		echo "xYear.push('{$k}'.toString());";
		echo "yVisitor.push({$v});";
		if(isset($yLeads[$k])) echo "yLead.push({$yLeads[$k]});";
		else echo "yLead.push(0);";
	
	}$mVS = array_values(array_slice($yVisitors, -2, 2, true));
		if(sizeof($mVS) == 2) echo "yIncVis='".number_format((($mVS[1]-$mVS[0])/$mVS[0]) * 100, 2).  "% Increase in visitors';";
	}
	if(sizeof($yLeads)>0){
	foreach($yLeads as $k=>$v){
		if($x[$k] == $k) continue;
		echo "xYear.push('{$k}'.toString());";
		echo "yLead.push({$v});";
		if(isset($yLeads[$k])) echo "yVisitor.push({$yLeads[$k]});";
		else echo "yVisitor.push(0);";
	
	}
		$mLS = array_values(array_slice($yLeads, -2, 2, true));
		if(sizeof($mLS) == 2) echo "yIncLead='".number_format((($mLS[1]-$mLS[0])/$mLS[0]) * 100, 2).  "% Increase in Leads';";
	}
	
	if(sizeof($hVisitors)>0){
	foreach($hVisitors as $k=>$v){
		$x[$k] = $k;
		echo "xHour.push('{$k}'.toString());";
		echo "hVisitor.push({$v});";
		if(isset($hLeads[$k])) echo "hLead.push({$hLeads[$k]});";
		else echo "hLead.push(0);";
	
	}$mVS = array_values(array_slice($hVisitors, -2, 2, true));
		if(sizeof($mVS) == 2) echo "hIncVis='".number_format((($mVS[1]-$mVS[0])/$mVS[0]) * 100, 2).  "% Increase in visitors';";
	}
	if(sizeof($hLeads)>0){
	foreach($hLeads as $k=>$v){
		if($x[$k] == $k) continue;
		echo "xHour.push('{$k}'.toString());";
		echo "hLead.push({$v});";
		if(isset($hLeads[$k])) echo "hVisitor.push({$hLeads[$k]});";
		else echo "hVisitor.push(0);";
	
	}$mLS = array_values(array_slice($hLeads, -2, 2, true));
		if(sizeof($mLS) == 2) echo "hIncLead='".number_format((($mLS[1]-$mLS[0])/$mLS[0]) * 100, 2).  "% Increase in Leads';";
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
	
	$('.formAnalytics .tblrow:even').addClass('alternate');
	
	$("div#task").jContent({orientation: 'horizontal',
                                         easing: "easeOutCirc", 
                                         duration: 500});
});
</script>
