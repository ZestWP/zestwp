<style type="text/css">label { font-weight: bold; } </style>
<div class="wrap">
    <div id="icon-orbtr" class="icon32"><br /></div>
    <h2><?php echo _PLUGIN_NAME .' :: '._MENU_WIDGET_TITLE; ?> <a href="admin.php?page=orbtrconnect-orbit-widget" class="button orbtr-button">New Widget</a></h2>
    <br class="clear" />
	<?php $orbtr_errors->printMessages(); ?>
	<?php if (!empty($widgets)): ?>
	<div class="tablenav">
    <?php echo $pager->pageList($_GET['p'], $pages, $count); ?>
    <br class="clear" />
    </div>
    <table class="orbtr-list-table post fixed" cellspacing="0" style="table-layout:fixed;">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-email" style="">Widget Name</th>
        </tr>
    </thead>
    
    <tfoot>
        <tr>
            <th scope="col" class="manage-column column-email" style="">Widget Name</th>
        </tr>
    </tfoot>
    
    <tbody>
        <?php $i=0; foreach ($widgets as $widget): $i++; ?>
        <tr<?php if ($i % 2): ?> class="alternate"<?php endif; ?>>
            <td class="post-title column-email">
                <a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=edit&amp;id=<?php echo $widget->id; ?>"><?php echo $widget->widget_name; ?></a>
                <div class="row-actions">
                	<span class="edit"><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=edit&amp;id=<?php echo $widget->id; ?>" title="Edit Orbit">Edit</a> | </span>
                	<span class="trash"><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $widget->id; ?>" class="trash delete submitdelete">Delete Widget</a></span>
                </div>
            </td>
        </tr>
    
        <?php endforeach; ?>
    </tbody>
    
    </table>
    <div class="tablenav">
    <?php echo $pager->pageList($_GET['p'], $pages, $count); ?>
    <br class="clear" />
    </div>
    </form>
    <?php else: ?>
    <p>No Widgets have been created.</p>
    <?php endif; ?>
    <script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			$('a.submitdelete').click(function() {
				return confirm('You are about to delete this Widget. Are you sure you wish to continue? This action cannot be undone.');
			});
		});
		//]]>
	</script>
</div>