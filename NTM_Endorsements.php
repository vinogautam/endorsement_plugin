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
	}
	
	function Endorsement_install()
	{
		global $wpdb;
		$cpage = array('post_title' => 'Endorsement', 'post_content' => '[ENDORSEMENT_FRONT_END]', 'post_type' => 'page', 'post_status' => 'publish');
		update_option('ENDORSEMENT_FRONT_END', wp_insert_post( $cpage));
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