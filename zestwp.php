<?php
/* 
Plugin Name: ZestWP
Plugin URI: 
Description: ZestWP Lead Tracking wordpress plugin
Version: 0.1 
Author: Karthick Mani
Author URI: 
	
	package ZestWP

*/

define(_PLUGIN_NAME, "ZestWP");
define(_SHORT_NAME, "ZestWP");

define(__ZEST_ROOT, dirname(plugin_basename(__FILE__)));
define (__ZEST_PATH, dirname(__FILE__));
define (__ZEST_URL, plugins_url().'/'.__ZEST_ROOT.'/');

require_once("core/functions.php");
require_once("core/constants.php");
require_once("core/core.php");
require_once("core/Pager.class.php");

require_once("controllers/email.php");
require_once("controllers/egroup.php");
require_once("controllers/home.php");
require_once("controllers/campaign.php");
require_once("controllers/zestmail.php");


register_activation_hook(__FILE__, 'zest_install');
register_deactivation_hook(__FILE__, 'zest_install');

global $zest_db_version;
$zest_db_version = "1.0";

function zest_install(){
	global $wpdb;
	global $zest_db_version;
	$database = _DATABASE;
		$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}{$database}` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) NOT NULL,
		  `created` datetime NOT NULL,
		  `modified` datetime NOT NULL,
		  `properties` text NOT NULL,
		  PRIMARY KEY (`id`),
		  KEY `name` (`name`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	add_option("zest_db_version", $zest_db_version);
}

$orbtrDashboard = new Core();
?>
