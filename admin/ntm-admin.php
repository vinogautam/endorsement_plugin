<?php
class Endorsements_admin{
    
    function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_pages' ) );
    }


    function add_plugin_pages() {
        
        if(is_multisite() && is_super_admin() || current_user_can('manage_options')) {
             
            add_menu_page( 'Endorsements', 'Endorsements', 'manage_options', 'ntmEndorsements', array( $this, 'create_ntmadmin_page' ));
			add_submenu_page( 'ntmEndorsements', 'Endorsements', 'Email Template',  9, 'mail_template', array( &$this, 'mail_template'));
			add_submenu_page( 'ntmEndorsements', 'Endorsements', 'Settings',  9, 'settings', array( &$this, 'settingsPage'));		
        
        } else {
            
            //add_menu_page( 'Endorsements', 'Endorsements', 'editor', 'ntmEndorsements', array( $this, 'create_ntmadvisors_page' ));  
        
        }
   
    } //end ntme_admin_menu()
    
    //our admin tabs navigation
    public function adminTabs($tabs){
        
        if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'general';
        
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
    
        foreach( $tabs as $tab => $name ){
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=ntmEndorsements&tab=$tab'>$name</a>";
    
        }
        
        echo '</h2>';
    }
    
    //our AGENTS tabs navigation
    public function advisorTabs($current){
        
        if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'general';
        
         $tabs = array( 'general' => 'Gift Manager', 'endorsers' => 'Endorsers', 'conversions' => 'New Conversions' );
    
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
    
        foreach( $tabs as $tab => $name ){
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=ntmEndorsements&tab=$tab'>$name</a>";
    
        }
        
        echo '</h2>';
    }
    
    /**
     * admin page callback
     */
    public function create_ntmadmin_page()
    {   global $pagenow, $current_user, $ntm_mail;
		if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'endorsers';
		
		$tabs = array( 'endorsers' => 'Endorsers', 'add_endorsers' => 'Add New Endorsers');
		$current_page = $tabs[$current];
		$current_tab = $current.'_page';
		
		if(isset($_POST['submit']))
		{
			$user = $_POST['user'];
			$user['role'] = 'endorser';
			$user['user_login'] = strtolower($user['first_name'].'_'.$user['last_name']);
			
			$user_id = username_exists( $user['user_login'] );
			if ( !$user_id and email_exists($user['user_email']) == false ) {
				$user['user_pass'] = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$user_id = wp_insert_user( $user ) ;
				if (  is_wp_error( $user_id ) ) {
					$error = __('Something went wrong. Try Again!!!.');
				}
				else
				{
					$ntm_mail->send_welcome_mail($user['user_email'], $user_id, $user['user_login'].'#'.$user['user_pass']);
					$ntm_mail->send_notification_mail($user_id);
				}
			} else {
				$error = __('User already exists.  Password inherited.');
			}
		}
		elseif(isset($_GET['resend_welcome_email']))
		{
			$userpass = wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_info = get_userdata($_GET['resend_welcome_email']);
			$username = $user_info->user_login;
			wp_set_password( $userpass, $_GET['resend_welcome_email'] );
			$ntm_mail->send_welcome_mail($user_info->user_email, $_GET['resend_welcome_email'], $username.'#'.$userpass);
		}
		?>
        <div class="wrap">
            <h2><?php echo $current_page;?></h2>           
            <?php 
				if(isset($error)) echo $error;
				$this->adminTabs($tabs);
				$this->$current_tab();
			?>
        </div>
        <?php
        
    }
	
	public function endorsers_page()
    {
		$endosersTable = new EndoserTable();
		$endosersTable->prepare_items();
		$endosersTable->display();
		?>
		
		<?php
	}
    
    public function add_endorsers_page()
    {
		?>
		<form method="post" action="<?php admin_url( 'admin.php?page=ntmEndorsements' ); ?>">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="blogname">Firstname</label></th>
						<td><input type="text" class="regular-text" value="" id="blogname" name="user[first_name]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Lastname</label></th>
						<td><input type="text" class="regular-text" value="" id="blogname" name="user[last_name]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Email</label></th>
						<td><input type="text" class="regular-text" value="" id="blogname" name="user[user_email]"></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button();?>
		</form>
		<?php
	}
	
	public function mail_template()
	{
		global $ntm_mail;
	
	$templates = array (

			'welcome_mail' 		=>	 "New Endorser Welcome Email template",
			
			'notification_mail' 		=>	 "New Endorser Notification to Admin Email template",

			'invitation_mail'		=> 	 "Endorsement Invitation Email template"

		);
	
	$key = array_keys($templates);
	$value = array_values($templates);
	
	if(isset($_POST['update_mail_template']))
	{
		$ntm_mail->set_welcome_mail ($_POST['welcome_mail'],$_POST['welcome_mail_subject'],false);
		
		$ntm_mail->set_notification_mail ($_POST['notification_mail'],$_POST['notification_mail_subject'],false);
		
		$ntm_mail->set_invitation_mail ($_POST['invitation_mail'],$_POST['invitation_mail_subject'],false);
		
	}
	elseif(isset($_GET['reset']))
	{
		$ntm_mail->reset_mail_template ($_GET['reset']);
	}
	
		$get_mail = array();
		
		$get_mail[] 	 	= 	$ntm_mail->get_welcome_mail ();
		
		$get_mail[] 	 	= 	$ntm_mail->get_notification_mail ();
		
		$get_mail[] 	 	= 	$ntm_mail->get_invitation_mail ();
		
	?>
    <link rel="stylesheet" type="text/css" href="<?php _e(NTM_PLUGIN_URL);?>/assets/css/ckeditor.css" media="all" />
    <script type='text/javascript' src='<?php _e(NTM_PLUGIN_URL);?>/assets/js/ckeditor/ckeditor.js'></script>
    
    <div id="poststuff" class="wrap">
    <h2>Email template</h2>
    <?php if(isset($message)){?>
    <div id="message" class="updated"><p><?php echo $message;?></p></div>
    <?php }?>
		<div class="postbox">
            <div class="inside group">
            	<form name="myform" method="post" >
                <table id="country" class="form-table">
                    <?php for($i=0;$i<count($templates);$i++){?>
                    <tr>
                        <td colspan="2" style="border-top: 1px #ddd solid; background: #eee"><strong><?php _e($value[$i]);?></strong><small><a href="admin.php?page=mail_template&reset=<?php _e($key[$i]);?>">Reset</a></small></td>
                    </tr>
                    <tr>
                        <th><label>Subject</label></th>
                        <th><input size="60" name="<?php _e($key[$i]._subject);?>" value="<?php _e($get_mail[$i]['subject']);?>" type="text" /></th>
                    </tr>
                    <tr>
                        <th><label>Content</label></th>
                        <th><textarea cols="80" id="editor<?php _e($i);?>" name="<?php _e($key[$i]);?>" rows="10"><?php _e($get_mail[$i]['content']);?></textarea></th>
                    </tr>
                    <?php }?>
				</table>
                <script>
					<?php for($i=0;$i<count($templates);$i++){?>
					CKEDITOR.replace( 'editor<?php _e($i);?>' );
					<?php }?>
				</script>
                <p class="submit">
                	<input type="hidden" name="role" value="job-seeker">
                    <input name="update_mail_template" class="button-primary seeker_btn" value="<?php _e('Save Changes'); ?>" type="submit" />
                </p>
                </form>
            </div>
        </div>
    </div>    
		
<?php 
	}
        
} //end class endorsements
     
   
