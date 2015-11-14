<?php
/* Plugin Name: NTM Endorsements
 * Author: Vinodhagan Thangarajan
 * Author URI: http://ultimatedevelopments.com
 * Plugin URI: http://ultimatedevelopments.com
 * Description: Custom endorsements plugin for Neil Thomas
 * Version: 1.0
 */
 
 $dir = pathinfo(__FILE__);
 define('NTM_PLUGIN_URL', plugin_dir_url( __FILE__ ));
 define('NTM_PLUGIN_DIR',$dir['dirname']);
 
 include 'includes.php';
 
 global $endorsements, $ntmadmin, $ntm_mail;
 $endorsements = new Endorsements();
 $ntm_mail = new NTM_mail_template();
 
 Class Endorsements
 {
	function Endorsements()
	{
		register_activation_hook(__FILE__, array( &$this, 'Endorsement_install'));
		register_uninstall_hook(__FILE__, array( &$this, 'Endorsement_uninstall'));
		
		add_shortcode('ENDORSEMENT_FRONT_END', array( &$this, 'Endorsement_frontend'));
		add_action( 'admin_enqueue_scripts', array( &$this, 'Endorsement_load_js_and_css' ));
		
		add_role( 'endorser', 'Endorser');
		add_role( 'agents', 'Agents', array( 'read' => true, 'level_0' => true ) );
		
		$ntmadmin = new Endorsements_admin();
		
		//add_action( 'wp_footer', 'affiliate_script', 100 );
	}
	
	function affiliate_script() {
		
	}
	
	function Endorsement_install()
	{
		global $wpdb;
		
		if(get_option('ENDORSEMENT_FRONT_END'))
		{
			$cpage = array('post_title' => 'Endorsement', 'post_content' => '[ENDORSEMENT_FRONT_END]', 'post_type' => 'page', 'post_status' => 'publish');
			update_option('ENDORSEMENT_FRONT_END', wp_insert_post( $cpage));
		}
		
		$mailtemplates = $wpdb->prefix . "mailtemplates";
		
		if($wpdb->get_var('SHOW TABLES LIKE ' . $mailtemplates) != $mailtemplates){
			$sql_one = "CREATE TABLE " . $mailtemplates . "(
			  id int(11) NOT NULL AUTO_INCREMENT,
			   created datetime NOT NULL,
			   name tinytext NOT NULL,
			   subject tinytext NOT NULL,
			   content text NOT NULL,
			   type tinytext NOT NULL,
			  PRIMARY KEY  (id) ) ENGINE=InnoDB";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql_one);
		}
		
		$endorsements = $wpdb->prefix . "endorsements";
		
		if($wpdb->get_var('SHOW TABLES LIKE ' . $endorsements) != $endorsements){
			$sql_one = "CREATE TABLE " . $endorsements . "(
			  id int(11) NOT NULL AUTO_INCREMENT,
			   created datetime NOT NULL,
			   name tinytext NOT NULL,
			   email tinytext NOT NULL,
			   endorser_id int(11),
			   track_status int(11),
			   gift_status int(11),
			   post_data text NOT NULL,
			   tracker_id tinytext NOT NULL,
			   type tinytext NOT NULL,
			  PRIMARY KEY  (id) ) ENGINE=InnoDB";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql_one);
		}
	}
	
	function Endorsement_uninstall()
	{
		
	}
	
	function Endorsement_menu()
	{
		
	}
	
	function Endorsement_frontend()
	{
		$ntm_front_end = new NTM_Frontend();
		
		return $ntm_front_end->frontend();
	}
	
	function Endorsement_load_js_and_css()
	{
		
	}
	
 }