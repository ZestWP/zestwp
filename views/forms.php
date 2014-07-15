<div class="wrap">
    <h2>
		<?php _e( _PLUGIN_NAME .' :: '._MENU_FORM_TITLE); ?> 
		<a href="admin.php?page=<?php _e(_PLUGIN_NAME);?>-form&id=0" class="zest-button"><?php _e('New '._MENU_FORM_TITLE);?></a>
	</h2>
	<?php printMsg($msg); errorMsg($error); ?>
	<br class="clear"/>
	<?php if (!empty($forms)): ?>
		<?php echo $pager->pageList($_GET['p'], $pages, $count); ?>
	<form action="admin.php?page=<?php _e($_GET['page']); ?>" method="post" class="bulkDelete">
	<p class="search-box">
	<label class="screen-reader-text" for="search-input">Search</label>
	<input type="search" id="search-input" name="s" value="">
	<input type="submit" name="" id="search-submit" class="button" value="Search"></p>
	
    <div class="alignleft actions bulkactions">
        <select>
            <option value="1">Bulk Delete</option>
        </select>
        <input name="multidelete" class="button-secondary action multidelete" value="Apply" type="submit">
	</div>
    <table class="wp-list-table widefat fixed lists" cellspacing="0" style="table-layout:fixed;">
    <thead>
        <tr>
			<th scope="col" class="width10"><input class="mSelect" type="checkbox" style="margin:0px"></th>
            <th scope="col" class="width50" style=""><?php _e('Form name');?></th>
            <th scope="col" class="width20" style=""><?php _e('Start Date');?></th>
            <th scope="col" class="width20" style=""><?php _e('End Date');?></th>
            <th scope="col" class="width20" style=""><?php _e('Created on');?></th>
        </tr>
    </thead>
    
    <tfoot>
        <tr>
            <th><input class="mSelect" type="checkbox" style="margin:0px"></th>
            <th><?php _e('Form name');?></th>
			<th><?php _e('Start Date');?></th>
			<th><?php _e('End Date');?></th>
            <th><?php _e('Created on');?></th>
        </tr>
    </tfoot>
    
    <tbody>
        <?php
		$i = 0;
		foreach ($forms as $item){ ?>
		<?php $getList = unserialize($item->properties);?>
        <tr>
			<td><input class="case" value="<?php echo $item->id; ?>" name="delete_list[]" type="checkbox"></td>
			<td><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;id=<?php echo $item->id; ?>"><?php echo $getList['name']; ?></a>
			<?php if($i==0) echo " ( Default )";?>
			
			<div class="row-actions">
				<span class="edit"><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;id=<?php echo $item->id; ?>">Edit <?php _e('Form');?></a> | </span>
				<span class="trash"><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $item->id; ?>" class="trash">Delete <?php _e('Form');?></a></span>
			</div>
		</td>
		<td>
			<?php if($getList['startDate'] != 0) echo date('d-m-Y', $getList['startDate']); ?>
		</td>
		<td>
			<?php if($getList['endDate'] != 0) echo date('d-m-Y', $getList['endDate']); ?>
		</td>
		<td>
			<?php echo date('d-m-Y', strtotime($item->created)); ?>
		</td>
        </tr>
    
        <?php $i++;
		} ?>
    </tbody>
    
    </table>
	
	 <div class="alignleft actions">
        <select>
            <option value="1">Bulk Delete</option>
        </select>
        <input name="multidelete"  class="button-secondary action multidelete" value="Apply" type="submit">
	</div>
    
	<?php echo $pager->pageList($_GET['p'], $pages, $count); ?>
    
	</form>
    <?php else: ?>
    <p>No Forms available.</p>
    <?php endif; ?>

</div>