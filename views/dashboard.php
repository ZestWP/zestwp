
<div class="wrap">
    <div id="icon-zest" class="icon32"><br /></div>
    <h2><?php echo _PLUGIN_NAME; ?> Dashboard</h2>
    <br class="clear" />
    <div id="lead-dashboard" class="cf">
    	<div id="lead-stats" class="cf">
        	<div class="zest-stats">
            	<div class="zest-stats-column">
                	<span class="zest-visits"><?php echo (int)$stats->visitors_now; ?></span>
                    <span class="zest-stats-text">Total Visitors</span>
                </div>
                <div class="zest-stats-column">
                	<span class="zest-visits"><?php echo (int)$stats->leads_now; ?></span>
                    <span class="zest-stats-text">Leads</span>
                </div>
            </div>
            <div class="zest-stats zest-stats-center">
            	<div class="zest-stats-column">
                	<span class="zest-visits"><?php echo (int)$stats->visitors_today; ?></span>
                    <span class="zest-stats-text">Total Visitors</span>
                </div>
                <div class="zest-stats-column">
                	<span class="zest-visits"><?php echo (int)$stats->leads_today; ?></span>
                    <span class="zest-stats-text">Leads</span>
                </div>
            </div>
            <div class="zest-stats zest-stats-right">
            	<p><span>New Visits:</span> <?php echo (float)$stats->new_percent; ?>%</p>
                <p><span>Total Visits:</span> <?php echo (int)$stats->total_visits; ?></p>
                <p><span>Total Pages:</span> <?php echo (int)$stats->total_pages; ?></p>
                <p><span>Avg Pages/Visit</span> <?php echo ((int)$stats->total_visits > 0) ? round(($stats->total_pages / $stats->total_visits), 1): 0; ?></p>
            </div>
        </div>
        <div class="zest-columns-wrap cf">
        	<div class="zest-column">
            	<h3>Online Visitors</h3>
                <?php $i=0; if (!empty($stats->online_visitors)): ?>
                <ul>
                	<?php foreach ($stats->online_visitors as $visitor): ?>
					<?php
						$loc = split(', ',$visitor->location);
						if (isset($loc[1]) && (strtolower($visitor->country) != 'us' && strtolower($visitor->country) != 'ca')) $loc[1] = strtoupper($visitor->country);
						$visitor->location = implode(', ', $loc);
					?>
                  <?php
                  $name = '';
                  $name = trim($visitor->fName .' '.$visitor->lName);
                  if (empty($name)) $name = 'Visitor ' . $visitor->id;
                  ?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><a href="admin.php?page=zestconnect-allleads&action=views&uid=<?php echo $visitor->id; ?>"><span><?php echo $name; ?></span></a> <?php echo $visitor->company . (empty($visitor->location) ? '' : ' ('.$visitor->location.')'); ?>
					<?php 
					$orbits = $this->api->getAssignedOrbits($visitor->id, 1);
					if (!empty($orbits)): foreach ($orbits as $orbit):
					?>
					<span class="orbit-sprite orbit-sprite-<?php echo $orbit->orbit_color; ?> alignright" title="<?php echo $orbit->orbit_name; ?>"></span>
					<?php endforeach; endif; ?>
					</li>
                    <?php endforeach; ?>
                </ul>
                <p class="zest-right-text">
                	<a href="admin.php?page=zestconnect-onlineleads">See All</a>
                </p>
                <?php else: ?>
                <p>No online visitors at this time.</p>
                <?php endif; ?>
            </div>
            <div class="zest-column zest-column-right">
            	<h3>Online Leads</h3>
            	<?php $i=0;if (!empty($stats->online_leads)): ?>
                <ul>
                	<?php foreach ($stats->online_leads as $lead): ?>
					<?php
						$loc = split(', ',$lead->location);
						if (isset($loc[1]) && (strtolower($lead->country) != 'us' && strtolower($lead->country) != 'ca')) $loc[1] = strtoupper($lead->country);
						$lead->location = implode(', ', $loc);
					?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><a href="admin.php?page=zestconnect-allleads&action=views&uid=<?php echo $lead->id; ?>"><span><?php echo $lead->email; ?></span></a> <?php echo $lead->company . (empty($lead->location) ? '' : ' ('.$lead->location.')'); ?>
					<?php 
					$orbits = $this->api->getAssignedOrbits($lead->id, 1);
					if (!empty($orbits)): foreach ($orbits as $orbit):
					?>
					<span class="orbit-sprite orbit-sprite-<?php echo $orbit->orbit_color; ?> alignright" title="<?php echo $orbit->orbit_name; ?>"></span>
					<?php endforeach; endif; ?>
					</li>
                    <?php endforeach; ?>
                </ul>
                <p class="zest-right-text">
                	<a href="admin.php?page=zestconnect-allleads">See All</a>
                </p>
                <?php else: ?>
                <p>No online leads at this time.</p>
                <?php endif; ?>
            </div>
        </div>
        <br class="clear" />
        <div class="zest-columns-wrap cf">
        	<div class="zest-column">
            	<h3>Recent Visitors</h3>
                <?php $i=0; if (!empty($stats->recent_visitors)): ?>
                <ul>
                	<?php foreach ($stats->recent_visitors as $lead): ?>
					<?php
						$loc = split(', ',$lead->location);
						if (isset($loc[1]) && (strtolower($lead->country) != 'us' && strtolower($lead->country) != 'ca')) $loc[1] = strtoupper($lead->country);
						$lead->location = implode(', ', $loc);
					?>
                  <?php
                  $name = '';
                  $name = trim($lead->fName .' '.$lead->lName);
                  if (empty($name)) $name = 'Visitor ' . $lead->id;
                  ?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><a href="admin.php?page=zestconnect-allleads&action=views&uid=<?php echo $lead->id; ?>"><span><?php echo $name; ?></span></a> <?php echo $lead->company . (empty($lead->location) ? '' : ' ('.$lead->location.')'); ?>
					<?php 
					$orbits = $this->api->getAssignedOrbits($lead->id, 1);
					if (!empty($orbits)): foreach ($orbits as $orbit):
					?>
					<span class="orbit-sprite orbit-sprite-<?php echo $orbit->orbit_color; ?> alignright" title="<?php echo $orbit->orbit_name; ?>"></span>
					<?php endforeach; endif; ?>
					</li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No recent visitors at this time.</p>
                <?php endif; ?>
            </div>
            <div class="zest-column zest-column-right">
            	<h3>Recent Leads</h3>
                <?php $i=0; if (!empty($stats->recent_leads)): ?>
                <ul>
                	<?php foreach ($stats->recent_leads as $lead): ?>
					<?php
						$loc = split(', ',$lead->location);
						if (isset($loc[1]) && (strtolower($lead->country) != 'us' && strtolower($lead->country) != 'ca')) $loc[1] = strtoupper($lead->country);
						$lead->location = implode(', ', $loc);
					?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><a href="admin.php?page=zestconnect-allleads&action=views&uid=<?php echo $lead->id; ?>"><span><?php echo $lead->email; ?></span></a> <?php echo $lead->company . (empty($lead->location) ? '' : ' ('.$lead->location.')'); ?>
					<?php 
					$orbits = $this->api->getAssignedOrbits($lead->id, 1);
					if (!empty($orbits)): foreach ($orbits as $orbit):
					?>
					<span class="orbit-sprite orbit-sprite-<?php echo $orbit->orbit_color; ?> alignright" title="<?php echo $orbit->orbit_name; ?>"></span>
					<?php endforeach; endif; ?>
					</li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No recent leads at this time.</p>
                <?php endif; ?>
            </div>
        </div>
        <br class="clear" />
        <div class="zest-columns-wrap cf">
        	<div class="zest-column">
            	<h3>Most Popular Pages Today <span class="visits-text">visits</span></h3>
                <?php $i=0; if (!empty($stats->most_viewed)): ?>
                <ul>
                	<?php foreach ($stats->most_viewed as $visit): ?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><?php echo $visit->name; ?><span class="visits-text"><?php echo $visit->visits; ?></span></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No most visited pages at this time.</p>
                <?php endif; ?>
            </div>
            <div class="zest-column zest-column-right">
            	<h3>Most Popular Referral Sources Today <span class="visits-text">visits</span></h3>
                <?php $i=0; if (!empty($stats->referers_today)): ?>
                <ul>
                	<?php foreach ($stats->referers_today as $visit): ?>
                	<li<?php if (++$i%2): ?> class="alt"<?php endif; ?>><?php echo $visit->referer; ?><span class="visits-text"><?php echo $visit->visits; ?></span></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <p>No referers today.</p>
                <?php endif; ?>
            </div>
        </div>
        <br class="clear" />
    </div>
    
</div>