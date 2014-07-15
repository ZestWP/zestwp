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
		$this->form = new Form();
		$this->crm = new Crm();
		$this->task = new Task();
		
		
		add_action("template_redirect", array( &$this->email, 'preview_page'));
		add_action("template_redirect", array( &$this->email, 'landing_page'));
		add_action("template_redirect", array( &$this->email, 'logo'));
		add_action("template_redirect", array( &$this->email, 'track'));
		add_action("template_redirect", array( &$this->campaign, 'lead'));
    }
    public function do_output_buffer() { ob_start(); }
	
	public function adminMenu()
	{
		if( function_exists('add_options_page') ) {
            $base = $this->_pluginName;
            $setup = $this->_pluginName.'-setup';
			$bCampaign = $base."-campaign-dashboard";
			$bEmail = $base."-email-marketing";
			$bForm = $base."-forms";
			$bl = $base."lp";
			$bCrm = $base."-crm";
			$bSocial = $base."-social";
			$bSettings = $base."-settings";
			//1 Dashboard
            if ( function_exists('add_object_page') )
                add_object_page($this->_shortName, $this->_shortName, 'manage_options', $base, array());
            else
                add_menu_page($this->_shortName, $this->_shortName, 'manage_options', $base);
            
			add_submenu_page($base, _MENU_DASHBOARD, _MENU_DASHBOARD_TITLE, 'manage_options', $base, array( $this->home, 'dashboard' ) );
			//add_submenu_page($base, _MENU_ANALYTICS, _MENU_ANALYTICS, 'manage_options', $base."-analytics", array( $this->home, 'analytics' ) );
			
			//2 Tasks
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_CONTENT, _MENU_CONTENT, 'manage_options', $base.'-tasks', array());
            else
                add_menu_page(_MENU_CONTENT, _MENU_CONTENT, 'manage_options', $base.'-tasks');
            
			add_submenu_page($base.'-tasks', _MENU_TASK, _MENU_TASK, 'manage_options', $base.'-tasks', array( $this->task, 'tasks' ) );
			
			//3 Campaign
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_CAMPAIGN_BOARD, _MENU_CAMPAIGN_BOARD, 'manage_options', $bCampaign, array());
            else
                add_menu_page(_MENU_CAMPAIGN_BOARD, _MENU_CAMPAIGN_BOARD, 'manage_options', $bCampaign);
            
			add_submenu_page($bCampaign,_MENU_CAMPAIGN_DASHBOARD,_MENU_CAMPAIGN_DASHBOARD,'manage_options',$bCampaign, array( $this->campaign, 'dashboard' ));
			add_submenu_page($bCampaign, _MENU_CAMPAIGN, _MENU_CAMPAIGN, 'manage_options', $base."-campaign", array( $this->campaign, 'campaign' ) );
			
			//4 Email marketing
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_ZESTMAIL, _MENU_ZESTMAIL, 'manage_options', $bEmail, array());
            else
                add_menu_page(_MENU_ZESTMAIL, _MENU_ZESTMAIL, 'manage_options', $bEmail);
            
			add_submenu_page($bEmail, _MENU_EMAIL_OVERVIEW, _MENU_EMAIL_OVERVIEW, 'manage_options', $bEmail, array( $this->email, 'dashboard' ) );
			add_submenu_page($bEmail, _MENU_EMAIL, _MENU_EMAIL, 'manage_options', $base."-email", array( $this->email, 'email' ) );
			add_submenu_page($bEmail, _MENU_EMAIL_GROUP, _MENU_EMAIL_GROUP_TITLE, 'manage_options', $base."-egroup", array( $this->egroup, 'group' ) );
			add_submenu_page($bEmail, _MENU_ZESTMAIL, _MENU_ZESTMAIL_TITLE, 'manage_options', $base."-marketing", array( $this->mailer, 'email' ) );
			add_submenu_page($bEmail, _MENU_SMTP, _MENU_SMTP, 'manage_options', $setup, array( $this->mailer, 'smtp' ) );
			
			//5 Landing page
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_LANDINGPAGE, _MENU_LANDINGPAGE, 'manage_options', "edit.php?post_type="._MENU_LANDINGPAGE_MENU, array());
            else
                add_menu_page(_MENU_LANDINGPAGE, _MENU_LANDINGPAGE, 'manage_options', "edit.php?post_type="._MENU_LANDINGPAGE_MENU);
            
			register_post_type(_MENU_LANDINGPAGE_MENU, array(
				'public' => true,
				'label'  => _MENU_LANDINGPAGE ,
				'labels' =>  array('add_new_item' => "Add new "._MENU_LANDINGPAGE ),
				'supports' => array('title', 'editor')
				));
			
			//6 Forms
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_FORMS, _MENU_FORMS, 'manage_options', $bForm, array());
            else
                add_menu_page(_MENU_FORMS, _MENU_FORMS, 'manage_options', $bForm);
            
			add_submenu_page($bForm, _MENU_FORM_OVERVIEW, _MENU_FORM_OVERVIEW, 'manage_options', $bForm, array( $this->form, 'dashboard' ) );
			add_submenu_page($bForm, _MENU_FORM, _MENU_FORM, 'manage_options', $base."-form", array( $this->form, 'setup' ) );
		//	add_submenu_page($bForm, _MENU_EMAIL_GROUP, _MENU_EMAIL_GROUP_TITLE, 'manage_options', $base."-form-export", array( $this->form, 'export' ) );
			
			//7 CRM
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_CRM_HOME, _MENU_CRM_HOME, 'manage_options', $bCrm, array());
            else
                add_menu_page(_MENU_CRM_HOME, _MENU_CRM_HOME, 'manage_options', $bCrm);
            
			add_submenu_page($bCrm, _MENU_CRM_OVERVIEW, _MENU_CRM_OVERVIEW, 'manage_options', $bCrm, array( $this->crm, 'dashboard' ) );
			add_submenu_page($bCrm, _MENU_LEADS, _MENU_LEADS_TITLE, 'manage_options', $base.'-leads', array( $this->crm, 'leads' ) );
			add_submenu_page($bCrm, _MENU_USERS, _MENU_USERS_TITLE, 'manage_options', $base.'-users', array( $this->crm, 'users' ) );
			
			//8 Social Media
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_SOCIAL_MEDIA, _MENU_SOCIAL_MEDIA, 'manage_options', $bSocial, array());
            else
                add_menu_page(_MENU_SOCIAL_MEDIA, _MENU_SOCIAL_MEDIA, 'manage_options', $bSocial);
            
			add_submenu_page($bSocial, _MENU_SOCIAL_DASHBOARD, _MENU_SOCIAL_DASHBOARD, 'manage_options', $bSocial, array( $this->crm, 'social' ) );
			//add_submenu_page($bSocial, _MENU_SOCIAL_INTEGRATION, _MENU_SOCIAL_INTEGRATION, 'manage_options', $bSocial.'-integration', array( $this->crm, 'integration' ) );
			
			//9 Settings
			if ( function_exists('add_object_page') )
                add_object_page(_MENU_STATIC_SETTINGS, _MENU_STATIC_SETTINGS, 'manage_options', $bSettings, array());
            else
                add_menu_page(_MENU_STATIC_SETTINGS, _MENU_STATIC_SETTINGS, 'manage_options', $bSettings);
            
			add_submenu_page($bSettings, _MENU_SCRITPS, _MENU_SCRITPS, 'manage_options', $bSettings, array( $this->form, 'staticAdmin' ) );
			add_submenu_page($bSettings, _MENU_GOOGLE, _MENU_GOOGLE, 'manage_options', $bSettings.'-google', array( $this->form, 'google' ) );
			
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