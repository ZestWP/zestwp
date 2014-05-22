<?php

class Home
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	
	public function __construct() 
	{
    }
    
	public function dashboard()
	{
		require(__ZEST_PATH.'/views/dashboard.php');
	}

	public function online()
	{
		require(__ZEST_PATH.'/views/online.php');
	}
	
	public function allRecord(){
	
		require(__ZEST_PATH.'/views/leads.php');
	}
	
	public function zcontrols(){
	
		require(__ZEST_PATH.'/views/campaigns.php');
	}
	
	public function zwidgets(){
	
		require(__ZEST_PATH.'/views/widgets.php');
	}
	
	public function smtp()
	{
		require(__ZEST_PATH.'/views/dashboard.php');
	}

}