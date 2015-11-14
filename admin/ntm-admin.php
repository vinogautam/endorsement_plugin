<?php
class Endorsements_admin{
    
    function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_pages' ) );
    }


    function add_plugin_pages() {
        
        if(is_multisite() && is_super_admin() || current_user_can('manage_options')) {
             
            add_menu_page( 'Endorsements', 'Endorsements', 'manage_options', 'ntmEndorsements', array( $this, 'create_ntmadmin_page' ));
			add_submenu_page( 'ntmEndorsements', 'Endorsements', 'Add Endorser',  9, 'ntmEndorsements&tab=add_endorsers', array( &$this, 'mail_template'));
			add_submenu_page( 'ntmEndorsements', 'Endorsements', 'Email Template',  9, 'mail_template', array( &$this, 'mail_template'));
			add_submenu_page( 'ntmEndorsements', 'Endorsements', 'Settings',  9, 'ntmEndorsements_settings', array( &$this, 'settingsPage'));		
        
        } else {
            
            //add_menu_page( 'Endorsements', 'Endorsements', 'editor', 'ntmEndorsements', array( $this, 'create_ntmadvisors_page' ));  
        
        }
   
    } //end ntme_admin_menu()
    
    //our admin tabs navigation
    public function adminTabs($tabs, $default, $page){
        
        if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = $default;
        
        echo '<div id="icon-themes" class="icon32"><br></div>';
        echo '<h2 class="nav-tab-wrapper">';
    
        foreach( $tabs as $tab => $name ){
            $class = ( $tab == $current ) ? ' nav-tab-active' : '';
            echo "<a class='nav-tab$class' href='?page=$page&tab=$tab'>$name</a>";
    
        }
        
        echo '</h2>';
    }
	
       
    /**
     * admin page callback
     */
    public function create_ntmadmin_page()
    {   global $pagenow, $current_user, $ntm_mail;
		if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'endorsers';
		
		$tabs = array( 'endorsers' => 'Endorsers', 'add_endorsers' => 'Add New Endorsers', 'template_list' => 'Letter Template', 'add_template' => 'Add New Template');
		$current_page = $tabs[$current];
		$current_tab = $current.'_page';
		
		$error = $this->post_actions();
		
		?>
        <div class="wrap">
            <h2><?php echo $current_page;?></h2>           
            <?php 
				if(isset($error)) echo $error;
				$this->adminTabs($tabs, 'endorsers', 'ntmEndorsements');
				$this->$current_tab();
			?>
        </div>
        <?php
        
    }
	
	public function endorsers_page()
    {
		?>
		<form method="post">
		<?php
			$endosersTable = new EndoserTable();
			$endosersTable->prepare_items();
			$endosersTable->display();
		?>
		</form>
		<?php
	}
    
    public function add_endorsers_page()
    {
		global $wpdb;
		
		$endorser_template = $wpdb->get_results("select * from ".$wpdb->prefix . "mailtemplates where type='Endorser'");
		$endorsement_template = $wpdb->get_results("select * from ".$wpdb->prefix . "mailtemplates where type!='Endorser'");
		
		if(isset($_GET['edit']))
		{	
			$user = get_userdata($_GET['edit']);
			$usermeta = get_user_meta($_GET['edit']);
		}
		
		?>
		<form method="post" action="<?php admin_url( 'admin.php?page=ntmEndorsements' ); ?>">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="blogname">Firstname</label></th>
						<td><input type="text" class="regular-text" value="<?php echo isset($usermeta) ? $usermeta['first_name'][0]: '';?>" id="blogname" name="user[first_name]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Lastname</label></th>
						<td><input type="text" class="regular-text" value="<?php echo isset($usermeta) ? $usermeta['last_name'][0]: '';?>" id="blogname" name="user[last_name]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Email</label></th>
						<td><input type="text" class="regular-text" <?php echo isset($user) ? 'disabled' : '';?> value="<?php echo isset($user) ? $user->user_email: '';?>" id="blogname" name="user[user_email]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Endorser Letter</label></th>
						<td><select class="regular-text" name="endorser_letter">
								<?php foreach($endorser_template as $r){?>
								<option <?php echo isset($usermeta) && $usermeta['endorser_letter'][0] == $r->id ? 'selected' : '';?> value="<?php _e($r->id);?>"><?php _e($r->name);?></option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Endorsement Letter</label></th>
						<td><select class="regular-text" name="endorsement_letter">
								<?php foreach($endorsement_template as $r){?>
								<option <?php echo isset($usermeta) && $usermeta['endorsement_letter'][0] == $r->id ? 'selected' : '';?> value="<?php _e($r->id);?>"><?php _e($r->name);?></option>
								<?php }?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button();?>
		</form>
		<?php
	}
	
	public function template_list_page()
    {
		?>
		<form method="post">
		<?php
			$endosersTable = new LetterTable();
			$endosersTable->prepare_items();
			$endosersTable->display();
		?>
		</form>
		<?php
	}
    
    public function add_template_page()
    {
		global $wpdb;
		
		if(isset($_GET['edit']))
			$template = $wpdb->get_row("select * from ".$wpdb->prefix . "mailtemplates where id='".$_GET['edit']."'");
		?>
		<link rel="stylesheet" type="text/css" href="<?php _e(NTM_PLUGIN_URL);?>/assets/css/ckeditor.css" media="all" />
		<script type='text/javascript' src='<?php _e(NTM_PLUGIN_URL);?>/assets/js/ckeditor/ckeditor.js'></script>
		<form method="post" action="<?php admin_url( 'admin.php?page=ntmEndorsements' ); ?>">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="blogname">Type</label></th>
						<td><select class="regular-text" name="letter[type]">
								<option <?php echo isset($template) && $template->type == 'Endorser' ? 'selected' : '';?>>Endorser</option>
								<option <?php echo isset($template) && $template->type == 'Endorsement' ? 'selected' : '';?>>Endorsement</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Letter Name</label></th>
						<td><input type="text" class="regular-text" value="<?php echo isset($template) ? $template->name: '';?>" id="blogname" name="letter[name]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Subject</label></th>
						<td><input type="text" class="regular-text" value="<?php echo isset($template) ? $template->subject: '';?>" id="blogname" name="letter[subject]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Content</label></th>
						<td>
							<textarea cols="80" id="editor" rows="10" name="letter[content]"><?php echo isset($template) ? $template->content: '';?></textarea>
							<script>
								CKEDITOR.replace( 'editor' );
							</script>
						</td>
					</tr>
				</tbody>
			</table>
			<?php submit_button('Save Letter', 'primary', 'letter-save');?>
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
	
	function post_actions()
	{
		global $wpdb;
		
		if(isset($_POST['submit']) && isset($_GET['edit']))
		{
			update_user_meta($_GET['edit'], 'endorser_letter', $_POST['endorser_letter']);
			update_user_meta($_GET['edit'], 'endorsement_letter', $_POST['endorsement_letter']);
			update_user_meta($_GET['edit'], 'first_name', $_POST['user']['first_name']);
			update_user_meta($_GET['edit'], 'last_name', $_POST['user']['last_name']);
		}
		elseif(isset($_POST['submit']))
		{
			$user = $_POST['user'];
			$user['role'] = 'endorser';
			$user['user_login'] = strtolower($user['first_name'].'_'.$user['last_name']);
			
			$user_id = username_exists( $user['user_login'] );
			if ( !$user_id and email_exists($user['user_email']) == false ) {
				$user['user_pass'] = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$user_id = wp_insert_user( $user ) ;
				if (  is_wp_error( $user_id ) ) {
					return __('Something went wrong. Try Again!!!.');
				}
				else
				{
					update_user_meta($user_id, 'endorser_letter', $_POST['endorser_letter']);
					update_user_meta($user_id, 'endorsement_letter', $_POST['endorsement_letter']);
					$ntm_mail->send_welcome_mail($user['user_email'], $user_id, $user['user_login'].'#'.$user['user_pass']);
					$ntm_mail->send_notification_mail($user_id);
				}
			} else {
				return __('User already exists.  Password inherited.');
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
		elseif(isset($_POST['letter-save']))
		{
			if(isset($_GET['edit']))
			{
				$wpdb->update($wpdb->prefix . "mailtemplates", $_POST['letter'], array('id' => $_GET['edit']));
			}
			else
			{
				$_POST['letter']['created'] = date("Y-m-d H:i:s");
				$wpdb->insert($wpdb->prefix . "mailtemplates", $_POST['letter']);
			}
		}
		elseif(isset($_GET['tab']) && $_GET['tab'] == 'template_list' && isset($_GET['delete']))
			$wpdb->delete($wpdb->prefix . "mailtemplates", array( 'id' => $_GET['delete'] ) );
		elseif(isset($_GET['tab']) && $_GET['tab'] == 'endorsers' && isset($_GET['delete']))
			wp_delete_user($_GET['delete']);
	}
	
	public function settingsPage()
    {   global $pagenow, $current_user, $ntm_mail;
		if ( isset ( $_GET['tab'] ) ) $current = $_GET['tab']; else $current = 'cloudsponge';
		
		$tabs = array( 'cloudsponge' => 'Cloudsponge', 'giftbit' => 'Giftbit');
		$current_page = $tabs[$current];
		$current_tab = $current.'_settings';
		
		$error = $this->settings_actions();
		
		?>
        <div class="wrap">
            <h2><?php echo $current_page;?></h2>           
            <?php 
				if(isset($error)) echo $error;
				$this->adminTabs($tabs, 'cloudsponge', 'ntmEndorsements_settings');
				$this->$current_tab();
			?>
        </div>
        <?php
        
    }
	
	public function cloudsponge_settings()
	{
		$option = get_option('cloudsponge');
		?>
		<form method="post">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="blogname">Javscript Access key</label></th>
						<td><input type="text" class="regular-text" value="<?php echo $option;?>" id="blogname" name="cloudsponge"></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button('Save Letter', 'primary', 'cloudsponge-save');?>
		</form>
		<?php
	}
	
	public function giftbit_settings()
	{
		$option = get_option('giftbit');
		?>
		<form method="post">
			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="blogname">Api key</label></th>
						<td><input type="text" class="regular-text" value="<?php echo isset($option['api']) ? $option['api'] : '';?>" id="blogname" name="giftbit[api]"></td>
					</tr>
					<tr>
						<th scope="row"><label for="blogname">Sandbox</label></th>
						<td><input type="checkbox" class="regular-text" <?php echo isset($option['sandbox']) ? 'checked' : '';?> value="1" id="blogname" name="giftbit[sandbox]"></td>
					</tr>
				</tbody>
			</table>
			<?php submit_button('Save Letter', 'primary', 'giftbit-save');?>
		</form>
		<?php
	}
	
	public function settings_actions()
	{
		if(isset($_POST['cloudsponge-save']))
		{
			update_option('cloudsponge', $_POST['cloudsponge']);
		}
		elseif(isset($_POST['giftbit-save']))
		{
			update_option('giftbit', $_POST['giftbit']);
		}
	}
        
} //end class endorsements
     
   
