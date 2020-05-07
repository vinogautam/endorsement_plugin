<?php 
class NTM_mail_template{
	
	function reset_mail_template ( $mail) {

		$new_value	=	'';

		switch ($mail) {

			case 'welcome_mail':

				return $this->set_welcome_mail ( $new_value,'', true );
				
			case 'notification_mail':

				return $this->set_notification_mail ( $new_value,'', true );

			case 'invitation_mail':

				return $this->set_invitation_mail( $new_value,'', true );
				
			case 'gift_mail':

				return $this->set_gift_mail ( $new_value,'', true );
				
			case 'regift_mail':

				return $this->set_regift_mail ( $new_value,'', true );
				
			case 'manualgift_mail':

				return $this->set_manualgift_mail ( $new_value,'', true );
			
			case 'endorser_invitation_mail':

				return $this->set_endorser_invitation_mail ( $new_value,'', true );
			
			default:

				return 1;

		}

	}

	public function get_endorser_invitation_mail ( ) {

		$default	=	__("<p>Hello [ENDORSER],</p><p> Invitation to join &nbsp;&nbsp;[SITE], cick auto link and join as endorser.<br> [AUTO_LOGIN_LINK]</p>
							<p>Thank you and welcome to [SITE].</p>
							<p>Referred Agent [AGENT]<p>
							<p>[AGENT_EMAIL]<p>", '');
		
		$content = get_option('endorser_invitation_mail');
		
		$subject = get_option('endorser_invitation_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'Welcome Email');
		
		return $return;
	}

	

	public function set_endorser_invitation_mail ( $new_value, $subject , $default ) {

		if($default) {

			$new_value	=	__("<p>Hello [ENDORSER],</p><p> Invitation to join &nbsp;&nbsp;[SITE], cick auto link and join as endorser.<br> [AUTO_LOGIN_LINK]</p>
							<p>Thank you and welcome to [SITE].</p>
							<p>Referred Agent [AGENT]<p>
							<p>[AGENT_EMAIL]<p>", '');
							
			$subject = 'Welcome Email';

		}

		update_option('endorser_invitation_mail', $new_value);
		
		update_option('endorser_invitation_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}

	public function get_welcome_mail ( ) {

		$default	=	__("<p>Hello [ENDORSER],</p><p>You have successfully joined with&nbsp;&nbsp;[SITE]. [AUTO_LOGIN_LINK]</p>
							<p>Thank you and welcome to [SITE].</p>
							<p>Referred Agent [AGENT]<p>
							<p>[AGENT_EMAIL]<p>", '');
		
		$content = get_option('welcome_mail');
		
		$subject = get_option('welcome_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'Welcome Email');
		
		return $return;
	}

	

	public function set_welcome_mail ( $new_value, $subject , $default ) {

		if($default) {

			$new_value	=	__("<p>Hello [ENDORSER],</p><p>You have successfully joined with&nbsp;&nbsp;[SITE]. [AUTO_LOGIN_LINK]</p>
							<p>Thank you and welcome to [SITE].</p>
							<p>Referred Agent [AGENT]<p>
							<p>[AGENT_EMAIL]<p>", '');
							
			$subject = 'Welcome Email';

		}

		update_option('welcome_mail', $new_value);
		
		update_option('welcome_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}

	public function get_notification_mail ( ) {

		$default	=	__("<p>Hello admin,</p><p>New endorser joined in our website.
		Referred Agent: [AGENT]<br>
		Referred Email: [AGENT_EMAIL]</p>
<p>Thank you and welcome to [blogname].</p>", '');
		
		$content = get_option('notification_mail');
		
		$subject = get_option('notification_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'New Endorser Joined');
		
		return $return;
	}

	

	public function set_notification_mail ( $new_value, $subject , $default ) {

		if($default) {

			$new_value	=	__("<p>Hello admin,</p><p>New endorser joined in our website.
		Referred Agent: [AGENT]<br>
		Referred Email: [AGENT_EMAIL]</p>
<p>Thank you and welcome to [blogname].</p>", '');
			
			$subject = 'New Endorser Joined';
		}

		update_option('notification_mail', $new_value);
		
		update_option('notification_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}

	public function get_invitation_mail ( ) {


		$default	=	__("Hi [ENDORSEMENT], I am [ENDORSER], I want to introduce you to Terry Thomas.
I started working with Terry because I was struggling with my financial plan for quite some time.
I’m happy I now have my financial plan in place.
I thought of you, because we had spoken briefly about the need for a financial plan, so I asked
Terry about meeting with you. Terry provides free online consultations if you’re interested. He
won’t pressure you, and the consultation is without obligation. Online means he doesn’t need to
come to your home and you don’t need to go to him.
Terry is an expert at helping people resolve their financial planning needs. He’s been studying
and mentoring people for 20+ years, but most of all Terry enjoys helping people meet their
financial planning needs. He is the real deal.
To learn more about Terry, or register for a free consultation, click here ___________ [TRACK_LINK]. His number is 604-288-1420. I recommend you register, or give him a call right away,
because his schedule fills up fast.
Let me know if you have any questions,", '');

		$content = get_option('invitation_mail');
		
		$subject = get_option('invitation_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'You are invited as Endorsement');
		
		return $return;

	}

	

	public function set_invitation_mail ( $new_value, $subject, $default ) {

		if($default) {

			$new_value	=	__("Hi [ENDORSEMENT], I am [ENDORSER], I want to introduce you to Terry Thomas.
I started working with Terry because I was struggling with my financial plan for quite some time.
I’m happy I now have my financial plan in place.
I thought of you, because we had spoken briefly about the need for a financial plan, so I asked
Terry about meeting with you. Terry provides free online consultations if you’re interested. He
won’t pressure you, and the consultation is without obligation. Online means he doesn’t need to
come to your home and you don’t need to go to him.
Terry is an expert at helping people resolve their financial planning needs. He’s been studying
and mentoring people for 20+ years, but most of all Terry enjoys helping people meet their
financial planning needs. He is the real deal.
To learn more about Terry, or register for a free consultation, click here ___________ [TRACK_LINK]. His number is 604-288-1420. I recommend you register, or give him a call right away,
because his schedule fills up fast.
Let me know if you have any questions,", '');
		
			$subject = 'You are invited as Endorsement';
		}

		update_option('invitation_mail', $new_value);
		
		update_option('invitation_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}
	
	public function get_gift_mail ( ) {


		$default	=	__("Hi [ENDORSER], Your covertion process is intiated. Please click below link and select your vendor. 
		Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');

		$content = get_option('gift_mail');
		
		$subject = get_option('gift_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'Gift coversion Initiated');
		
		return $return;

	}

	

	public function set_gift_mail ( $new_value, $subject, $default ) {

		if($default) {

			$new_value	=	__("Hi [ENDORSER], Your covertion process is intiated. Please click below link and select your vendor. 
			Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');
		
			$subject = 'Gift coversion Initiated';
		}

		update_option('gift_mail', $new_value);
		
		update_option('gift_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}
	
	public function get_regift_mail ( ) {


		$default	=	__("Hi [ENDORSER], Your agent resend gift for your converted endorsement. Please click below link and select your vendor. 
			Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');

		$content = get_option('regift_mail');
		
		$subject = get_option('regift_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'Get Bonus Gift');
		
		return $return;

	}

	

	public function set_regift_mail ( $new_value, $subject, $default ) {

		if($default) {

			$new_value	=	__("Hi [ENDORSER], Your agent resend gift for your converted endorsement. Please click below link and select your vendor. 
			Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');
		
			$subject = 'Get Bonus Gift';
		}

		update_option('regift_mail', $new_value);
		
		update_option('regift_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}
	
	public function get_manualgift_mail ( ) {


		$default	=	__("Hi [ENDORSER], Your agent resend gift for your converted endorsement. Please click below link and select your vendor. 
			Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');

		$content = get_option('manualgift_mail');
		
		$subject = get_option('manualgift_mail_subject');
		
		if($content)
		$return = array('content' => $content, 'subject' => $subject);
		else
		$return = array('content' => $default, 'subject' => 'Get Bonus Gift');
		
		return $return;

	}

	

	public function set_manualgift_mail ( $new_value, $subject, $default ) {

		if($default) {

			$new_value	=	__("Hi [ENDORSER], Your agent resend gift for your converted endorsement. Please click below link and select your vendor. 
			Then you will get your gift voucher. [SELECT_VENDOR_LINK].", '');
		
			$subject = 'Get Bonus Gift';
		}

		update_option('manualgift_mail', $new_value);
		
		update_option('manualgift_mail_subject', $subject);

		return array('content' => $new_value, 'subject' => $subject);

	}
	
	public function get_mail_template($content, $preheader_text=''){

		$value = "<!doctype html>
<html>
  <head>
    <meta name='viewport' content='width=device-width'>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Simple Transactional Email</title>
    <style>
    /* -------------------------------------
        INLINED WITH htmlemail.io/inline
    ------------------------------------- */
    /* -------------------------------------
        RESPONSIVE AND MOBILE FRIENDLY STYLES
    ------------------------------------- */
    @media only screen and (max-width: 620px) {
      table[class=body] h1 {
        font-size: 28px !important;
        margin-bottom: 10px !important;
      }
      table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
        font-size: 16px !important;
      }
      table[class=body] .wrapper,
            table[class=body] .article {
        padding: 10px !important;
      }
      table[class=body] .content {
        padding: 0 !important;
      }
      table[class=body] .container {
        padding: 0 !important;
        width: 100% !important;
      }
      table[class=body] .main {
        border-left-width: 0 !important;
        border-radius: 0 !important;
        border-right-width: 0 !important;
      }
      table[class=body] .btn table {
        width: 100% !important;
      }
      table[class=body] .btn a {
        width: 100% !important;
      }
      table[class=body] .img-responsive {
        height: auto !important;
        max-width: 100% !important;
        width: auto !important;
      }
    }

    /* -------------------------------------
        PRESERVE THESE STYLES IN THE HEAD
    ------------------------------------- */
    @media all {
      .ExternalClass {
        width: 100%;
      }
      .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
        line-height: 100%;
      }
      .apple-link a {
        color: inherit !important;
        font-family: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-decoration: none !important;
      }
      .btn-primary table td:hover {
        background-color: #34495e !important;
      }
      .btn-primary a:hover {
        background-color: #34495e !important;
        border-color: #34495e !important;
      }
    }
    </style>
  </head>
  <body class='' style='background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
    <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;'>
      <tr>
        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
        <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
          <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

            <!-- START CENTERED WHITE CONTAINER -->
            <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>".$preheader_text."</span>
            <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                    <tr>
                      <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>
                        
                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>
                          ".$content."
                        </p>
                        
                        <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer' style='clear: both; Margin-top: 10px; text-align: center; width: 100%;'>
              <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                <tr>
                  <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                    <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    <br> Don't like these emails? <a href='http://i.imgur.com/CScmqnj.gif' style='text-decoration: underline; color: #999999; font-size: 12px; text-align: center;'>Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;'>
                    Powered by <a href='http://htmlemail.io' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;'>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";

		return $value;
	}
	
	
	public function send_welcome_mail($email, $user_id, $autologin, $videoURL = false, $data = array()){
					
		global $wpdb;
		
		$user = count($_POST) ? $_POST : (array) json_decode(file_get_contents('php://input'));

		$user_info = get_userdata($user_id);
      	
		$username = $user_info->user_login;
		
		$data = count($data) ? $data : $this->get_welcome_mail();

		$blog_id = get_active_blog_for_user( $user_id )->blog_id;
		$agent_id = get_blog_option($blog_id, 'agent_id');
		$agent_info = get_userdata($agent_id);

		$botId = get_user_meta($user_id, 'campaign', true);

		$botInfo = get_post_meta($botId, 'emailInvite', true);
		$botInfo = $botInfo ? (array) $botInfo : array();
		$video = '';
		if($videoURL) {
			$video = $videoURL;	
		}

		$dt = array(
			'messagetxt' => $user['landingPageContent'],
			'videoURL' => $video,
			'endorser_id' => $user_id,
			'agent_id' => $agent_info->ID,
			'bot_id' => $botId,
			'autologin' => base64_encode(base64_encode($autologin))
		);
		$wpdb->insert("wp_short_link", 
			array(
				'link' => '',
		  		'params' => serialize($dt),
		  		'endorser_id' => $user_id,
				'agent_id' => $agent_info->ID
			)
		);

		$AUTO_LOGIN_LINK = site_url('introduction.php?id='.$wpdb->insert_id);

		$subject = stripslashes(stripslashes($botInfo['subject'])) ? stripslashes(stripslashes($botInfo['subject'])) : 'Welcome to financialinsiders';
		$preheader_text = stripslashes(stripslashes($botInfo['preheader']));
		$personalMsg = $user['landingPageContent'];
		$content = str_replace("<br />", "", stripslashes(stripslashes($botInfo['body'])));

		$content = "<h4>Hi [ENDORSER]</h4>".$content."<p style='font-family: sans-serif;background:#ccc; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>
                          ".$user['landingPageContent']."
                        </p>
                        <a href='[AUTO_LOGIN_LINK]'>Click here to autologin</a>";

		$content 	=	str_ireplace('[ENDORSER]', get_user_meta($user_id, 'first_name', true).' '.get_user_meta($user_id, 'last_name', true), $content);
		$content 	=	str_ireplace('[AUTO_LOGIN_LINK]', $AUTO_LOGIN_LINK, $content);
		$content 	=	str_ireplace('[AGENT]', $agent_info->user_login, $content);
		$content 	=	str_ireplace('[AGENT_EMAIL]', $agent_info->user_email, $content);				
		$content	= 	str_ireplace('[SITE]', get_option('blogname'), $content);
		
		
		$fromName = get_option('blogname');
		$fromEmail = get_option('admin_email');		
		$message	=	$this->get_mail_template($content, $preheader_text);
					
		if($this->send_mail($email, $subject , $message, $fromName, $fromEmail ))
		return true;
		else
		return false;
	}
	
	public function send_notification_mail($user_id){
					
		global $current_user;
		
		$user_info = get_userdata($user_id);

		$blog_id = get_active_blog_for_user( $user_id )->blog_id;
		$agent_id = get_blog_option($blog_id, 'agent_id');
		$agent_info = get_userdata($agent_id);
		
		$data = $this->get_notification_mail();
		
		$subject = $data['subject'];
		
		$content = $data['content'];
		
		$content 	=	str_ireplace('[ENDORSER]', get_user_meta($user_id, 'first_name', true).' '.get_user_meta($user_id, 'last_name', true), $content);
		$content 	=	str_ireplace('[ENDORSER_EMAIL]', $user_info->user_email, $content);
		$content 	=	str_ireplace('[AGENT]', $agent_info->user_login, $content);
		$content 	=	str_ireplace('[AGENT_EMAIL]', $agent_info->user_email, $content);				
		$content	= 	str_ireplace('[SITE]', get_option('blogname'), $content);
		$content	= 	str_ireplace('[blogname]', get_option('blogname'), $content);
		
		
		
		$fromName = get_option('blogname');
		$fromEmail = get_option('admin_email');

		$message	=	$this->get_mail_template($content);
					
		if($this->send_mail(get_option('admin_email'), $subject, $message, $fromName, $fromEmail))
		return true;
		else
		return false;
		
	}
	
	public function send_endorser_invitation_mail($mail){
					
		global $current_user, $wpdb;

		$_POST = (array) json_decode(file_get_contents('php://input'));

		$botInfo = get_post_meta($_POST['botId'], 'emailInvite', true);
		$botInfo = $botInfo ? (array) $botInfo : array();

		$pagelink = get_permalink($_POST['botId']);

		$subject = stripslashes(stripslashes($botInfo->subject)) ? stripslashes(stripslashes($botInfo->subject)) : 'Welcome to financialinsiders';
		$preheader_text = stripslashes(stripslashes($botInfo->preheader));
		$content = str_replace("<br />", "", stripslashes(stripslashes($botInfo->body)));
		
		$content 	=	str_ireplace('[INVITELINK]', $pagelink.'?ref='.base64_encode(base64_encode($mail)), $content);
		$content	= 	str_ireplace('[SITE]', get_option('blogname'), $content);

		$message	=	$this->get_mail_template($content, $preheader_text);
		
		if($this->send_mail($mail, $subject , $message, $fromName=Null, $fromEmail=Null))
		return true;
		else
		return false;
	}

	public function send_invitation_mail($info, $endorser, $id, $content=''){
					
		global $current_user, $wpdb;
		
		$data = $this->get_invitation_mail();

		$_POST = (array) json_decode(file_get_contents('php://input'));
		
		/*$endorser_letter = get_user_meta($endorser, 'endorsement_letter', true);
		if($endorser_letter)
		{
			$res = $wpdb->get_row("select * from ".$wpdb->prefix . "mailtemplates where id=".$endorser_letter);
			$subject = isset($res->subject) ? $res->subject : $data['subject'];
			//$content = isset($res->content) ? $res->content : $data['content'];
			$pagelink = isset($res->page) ? $res->page : get_option('ENDORSEMENT_FRONT_END');
		}
		else
		{
			$subject = $data['subject'];
			//$content = $data['content'];
			$pagelink = get_option('ENDORSEMENT_FRONT_END');
		}*/


		$botInfo = get_post_meta($_POST['botId'], 'emailInvite', true);
		$botInfo = $botInfo ? (array) $botInfo : array();
		$video = '';
		if($videoURL) {
			$video = $videoURL;	
		}

		$pagelink = get_permalink($_POST['botId']);

		$subject = stripslashes(stripslashes($botInfo->subject)) ? stripslashes(stripslashes($botInfo->subject)) : 'Welcome to financialinsiders';
		$preheader_text = stripslashes(stripslashes($botInfo->preheader));
		$content = str_replace("<br />", "", stripslashes(stripslashes($botInfo->body)));

		$video = $templates->media ? $templates->media : get_user_meta($endorser, 'video', true) ;
		
		$content 	=	str_ireplace('[ENDORSER]', get_user_meta($endorser, 'first_name', true).' '.get_user_meta($endorser, 'last_name', true), $content);
		$content 	=	str_ireplace('[ENDORSEMENT]', $info['name'], $content);
		$content 	=	str_ireplace('[STRATEGYLINK]', $pagelink.'?ref='.base64_encode(base64_encode($id.'#&$#'.$endorser.'#&$#'.$info['tracker_id'])).'&video='.$video, $content);
		$content	= 	str_ireplace('[SITE]', get_option('blogname'), $content);
		
		//$headers  = 'MIME-Version: 1.0' . "\r\n";
				
		//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				
		//$headers .= "From: ".get_option('blogname')." < ".get_option('admin_email')."> \r\n";
		//$fromName = get_option('blogname');
		//$fromEmail = get_option('admin_email');			
		$message	=	$this->get_mail_template($content, $preheader_text);
		
		$arr = array('name' => get_user_meta($endorser, 'first_name', true).' '.get_user_meta($endorser, 'last_name', true),
					'email' => get_userdata($endorser)->user_email);
		
		if($this->send_mail($info['email'], $subject , $message, $fromName=Null, $fromEmail=Null,  $arr))
		return true;
		else
		return false;
	}
	
	public function send_gift_mail($template, $user_id, $gift, $lead = 0){
					
		global $current_user, $wpdb;
		
		$user_info = get_userdata($user_id);
      	
		$username = $user_info->user_login;
		
		$data = $this->$template();
		
		$subject = $data['subject'];
		$content = $data['content'];
		
		if($lead)
		{
			$lead = $wpdb->get_row("select * from ".$wpdb->prefix . "leads where id =" . $user_id);
			$content 	=	str_ireplace('[ENDORSER]', $lead->first_name.' '.$lead->last_name, $content);
		}
		else
			$content 	=	str_ireplace('[ENDORSER]', get_user_meta($user_id, 'first_name', true).' '.get_user_meta($user_id, 'last_name', true), $content);
		
		$content 	=	str_ireplace('[SELECT_VENDOR_LINK]', get_permalink(get_option('ENDORSEMENT_FRONT_END')).'?gift='.base64_encode(base64_encode($gift)), $content);
		$content 	=	str_ireplace('[AGENT]', $current_user->user_login, $content);
		$content 	=	str_ireplace('[AGENT_EMAIL]', $current_user->user_email, $content);				
		$content	= 	str_ireplace('[SITE]', get_option('blogname'), $content);
		
		//$headers  = 'MIME-Version: 1.0' . "\r\n";
				
		//$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				
		//$headers .= "From: ".get_option('blogname')." < ".get_option('admin_email')."> \r\n";

		$fromName = get_option('blogname');
		$fromEmail = get_option('admin_email');

		$message	=	$this->get_mail_template($content);
					
		if($this->send_mail($user_info->user_email, $subject, $message, $fromName, $fromEmail))
		return true;
		else
		return false;
	}
	
	function send_mail($to, $subject , $message, $fromName='', $fromEmail='', $arr=array())
	{
		$option = get_option('sendgrid');
		
		$sendgrid = new SendGrid($option['api']);
		$email = new SendGrid\Email();


		if(count($arr))
		{
			$email->setFrom($arr['email']);
			$email->setFromName($arr['name']);
		}
		else
		{
			$email->setFrom('neil@financialinsiders.ca');
			$email->setFromName('FinancialInsiders.ca');
		}
		
		$email->addTo($to);
		$email->setHtml($message);

		                             

		$email->setSubject($subject);
		//$email->Body    = $message;

		try {
			$sendgrid->send($email);
		} catch(\SendGrid\Exception $e) {
			echo $e->getCode();
			foreach($e->getErrors() as $er) {
				echo $er;
			}
		}

		//if(!$mail->Send()) {
		   /* echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit; */
		  // return false;
		//}

		//echo 'Message has been sent';
		return true;
	}
	
}