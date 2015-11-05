<?php
Class NTM_Frontend
{
	function frontend()
	{
		
		error_reporting(0);
		if(!$this->check_login())
		{
			echo "Invalid Autologin link!!!";
			return false;
		}
		
		global $ntm_mail, $current_user;
	
		$mailtemplate 	 	= 	$ntm_mail->get_invitation_mail ();
		
		//print_r($current_user);
	?>
    <link rel="stylesheet" type="text/css" href="<?php _e(NTM_PLUGIN_URL);?>/assets/css/ckeditor.css" media="all" />
    <script type='text/javascript' src='<?php _e(NTM_PLUGIN_URL);?>/assets/js/ckeditor/ckeditor.js'></script>
    
    <div id="poststuff" class="wrap">
    <h2>Email template</h2>
    <?php if(isset($message)){?>
    <div id="message" class="updated"><p><?php echo $message;?></p></div>
    <?php }?>
		<p>Welcome <?php echo $current_user->user_login;?></p>
		<div class="postbox">
            <div class="inside group">
            	<form name="myform" method="post" >
                <textarea cols="80" id="editor" name="" rows="10"><?php _e($mailtemplate['content']);?></textarea>
                <script>
					CKEDITOR.replace( 'editor' );
				</script>
                <p class="submit">
                	<input type="hidden" name="role" value="job-seeker">
                    <input name="update_mail_template" class="button-primary seeker_btn" value="<?php _e('Invite your friends'); ?>" type="submit" />
                </p>
                </form>
            </div>
        </div>
    </div>  
	<?php 
	}
	
	function check_login(){
		
		global $current_user;
		
		$autologin = explode("#", base64_decode(base64_decode($_GET['autologin'])));
		$creds = array();
		$creds['user_login'] = $autologin[0];
		$creds['user_password'] = $autologin[1];
		$creds['remember'] = true;
		$current_user = wp_signon( $creds, false );
		if ( is_wp_error($current_user) )
			return false;
		
		return true;
	}
}