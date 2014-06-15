<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_TASK_TITLE); ?><a href="<?php echo zest_url().'ajax/add-task.php';?>" rel="lightbox" setDimension="600X600" class="add-new-h2"><?php _e('New Task');?></a></h2>
	<table class="calendar" cellspacing="0" cellpadding="0">
	<thead><tr>
	<th><a href="admin.php?page=<?php _e(_PLUGIN_NAME);?>-tasks&m=<?php echo date('m', $prev_month);?>&y=<?php echo date('Y', $prev_month);?>">Prev</a></th>
	<th colspan="5"><?php echo date("M-Y"); ?></th>
	<th><a href="admin.php?page=<?php _e(_PLUGIN_NAME);?>-tasks&m=<?php echo date('m', $next_month);?>&y=<?php echo date('Y', $next_month);?>">Next</a></th>
	</tr></thead>
	<tbody>
		<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>
		<?php
			$link = 'admin.php?page='.(_PLUGIN_NAME).'-tasks&id=';
				for ( $day = 1; $day <= $daysinmonth; ++$day ) {
					if ( isset($newrow) && $newrow )
						$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
					$newrow = false;
					
					if($day <= 7 && $day <= $start_day && !$pad) {
						for($i = 0; $i< $start_day; $i++)
							$calendar_output .= '<td>&nbsp;</td>';
						$pad = true;
					}

					if ( $day == gmdate('j', current_time('timestamp')) && $m == gmdate('m', current_time('timestamp')) && $y == gmdate('Y', current_time('timestamp')) )
						$calendar_output .= '<td id="today" rel="'.$day.'-'.$m.'-'.$y.'" class="'.$day.'-'.$m.'-'.$y.'">';
					else
						$calendar_output .= '<td rel="'.$day.'-'.$m.'-'.$y.'" class="'.$day.'-'.$m.'-'.$y.'">';
						
					$calendar_output .= "<span class='days' >".$day.'</span>';
						
					$cur =  mktime(0, 0 , 0, $m, $day, $y);
					if(isset($tasks[$cur])){
						foreach($tasks[$cur] as $c){
							$calendar_output .= '<div class="tasks"><a class="c'.$c['id'].'" rel="lightbox" setDimension="600X600" href="'.zest_url().'ajax/add-task.php?id='.$c['id'].'">'.$c['name']."</a></div>";
						}
					}
					
					$calendar_output .= '</td>';

					if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $m, $day, $y))) )
						$newrow = true;
				}
				echo $calendar_output;
		
		
		
		?>
	</tbody>
	</table>
<div style="display:none;"><a id="create" rel="lightbox" setDimension="600X600">true</a></div>
</div>

<style>
.calendar{width:100%;}
.calendar td{border:1px solid #DDD;height:100px;vertical-align:top;}
#today{background-color:#E9E7BF;}
.calendar th{border:1px solid #DDD;width:14%;height:50px;}
.days{font-weight:bold;}
.tasks{padding-left:12px;width:90%;}
</style>
<script>
jQuery(document).ready( function($) {
	var h = "<?php echo zest_url().'ajax/add-task.php';?>";
	$('.calendar').delegate('td', 'dblclick', function(){
		$d = $(this).attr('rel');
		$('#create').attr('href', h+"?date="+$d);
		$('#create').click();
		
	});
});

</script>