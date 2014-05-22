<?php
require_once(__ZEST_PATH."/models/dbZest.php");

class Core
{
	
	private $_pluginName = _PLUGIN_NAME;
	private $_shortName = _SHORT_NAME;
	
	public function __construct() 
	{	
		add_action('admin_menu', array(&$this, 'adminMenu'));
		add_action('admin_init', array($this, 'load_scripts'));
		add_action('init',  array($this, 'do_output_buffer'));
		
		$this->home = new Home();
		$this->campaign = new Campaign();
		$this->egroup = new Egroup();
		$this->email = new Email();
		$this->mailer = new ZestMail();
		
		
		add_action("template_include", array( &$this->email, 'preview_page'));
		add_action("template_include", array( &$this->email, 'landing_page'));
    }
    public function do_output_buffer() { ob_start(); }
	
	public function adminMenu()
	{
		if( function_exists('add_options_page') ) {
            $base = $this->_pluginName;
            $setup = $this->_pluginName.'-setup';
			
            #>Add Main Menu Page
            if ( function_exists('add_object_page') ) {
                    add_object_page($this->_shortName, $this->_shortName, 'manage_options', $base, array());
            } else {
                    add_menu_page($this->_shortName, $this->_shortName, 'manage_options', $base);
            }
		
			add_submenu_page($base, _MENU_DASHBOARD, _MENU_DASHBOARD_TITLE, 'manage_options', $base, array( $this->home, 'dashboard' ) );
			add_submenu_page($base, _MENU_CAMPAIGN, _MENU_CAMPAIGN_TITLE, 'manage_options', $base."-campaign", array( $this->campaign, 'campaign' ) );
			add_submenu_page($base, _MENU_EMAIL_GROUP, _MENU_EMAIL_GROUP_TITLE, 'manage_options', $base."-egroup", array( $this->egroup, 'group' ) );
			add_submenu_page($base, _MENU_EMAIL, _MENU_EMAIL_TITLE, 'manage_options', $base."-email", array( $this->email, 'email' ) );
			add_submenu_page($base, _MENU_ZESTMAIL, _MENU_ZESTMAIL_TITLE, 'manage_options', $base."-email-marketing", array( $this->mailer, 'email' ) );
			add_submenu_page($base, _MENU_LANDINGPAGE, _MENU_LANDINGPAGE, 'manage_options', "edit.php?post_type="._MENU_LANDINGPAGE_MENU );
			
			 register_post_type(_MENU_LANDINGPAGE_MENU, array(
				'public' => true,
				'label'  => _MENU_LANDINGPAGE ,
				'labels' =>  array('add_new_item' => "Add new "._MENU_LANDINGPAGE ),
				'supports' => array('title', 'editor')
				));
			
			if ( function_exists('add_object_page') ) {
				add_object_page($this->_shortName.' Setup', $this->_shortName.' Setup', 'manage_options', $setup, array());
            } else {
				add_menu_page($this->_shortName.' Setup', $this->_shortName.' Setup', 'manage_options', $setup);
            }
			
			add_submenu_page($setup, _MENU_DASHBOARD, _MENU_DASHBOARD_TITLE, 'manage_options', $setup, array( $this->home, 'dashboard' ) );
			add_submenu_page($setup, _MENU_SMTP, _MENU_SMTP_TITLE, 'manage_options', $base.'-smtp', array( $this->mailer, 'smtp' ) );
			
			
			add_action( 'add_meta_boxes', array($this->campaign, 'addMetaBox'));
			add_action('admin_init', array($this->campaign, 'saveCampaign'));
        }
	}
	
	public function load_scripts()
	{
		wp_enqueue_style('zest', zest_url().'assets/zest.css');
		wp_enqueue_script('zest', zest_url().'assets/zest.js');
	}
}