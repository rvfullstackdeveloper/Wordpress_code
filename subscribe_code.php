add_action('wp_ajax_nopriv_wp_contact_callback', 'wp_contact_callback');
add_action( 'wp_ajax_wp_contact_callback', 'wp_contact_callback' );	
function wp_contact_callback() {
	// die('here');
	global $wpdb;
	$fmail  = $_POST['arg']['mail'];
	if( isset($fmail) ) {

		$to      = 'rv@zsoftware.tech';
		// $site_logo  = get_stylesheet_directory_uri() . '/images/logo.png';
		$headers    = "MIME-Version: 1.0" . "\r\n";
		$headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers   .= "From: <$fmail>\r\nReply-To: $fmail\r\nReturn-Path: $fmail\r\n";
		$subject    = "Newsletter Form Email";
		$email_body = "<table style='max-width:600px;margin:0 auto;background:#f5f5f5;border:1px solid #ddd;'>
			<tr>
				<td cellspacing='0' cellpadding='0' style='text-align:center;border-bottom:1px solid #dddddd;padding:20px 20px 0;background#fff'>Better Nutrition<br><br></td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969;font-size:18px;padding:20px'>Welcome to Better Nutrition,<br></td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969;font-size:16px;padding:20px 20px 0'>A request via Newsletter form has been sent from a visitor. Below are the details of the visitor:<br><br><b>Email:</b> ".$fmail."</td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969; font-size:16px; padding:20px'>Thanks,<br>Team Better Nutrition.</td>
			</tr>
		</table>";
$headers2   = $headers . "From: <$to>\r\nReply-To: $to\r\nReturn-Path: $to\r\n";
		$email_body2 = "<table style='max-width:600px;margin:0 auto;background:#f5f5f5;border:1px solid #ddd;'>
			<tr>
				<td cellspacing='0' cellpadding='0' style='text-align:center;border-bottom:1px solid #dddddd;padding:20px 20px 0;background#fff'>Better Nutrition<br><br></td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969;font-size:18px;padding:20px'>Welcome to Better Nutrition,<br></td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969;font-size:16px;padding:20px 20px 0'>You have subscribed successfully!</td>
			</tr>
			<tr>
				<td cellspacing='0' cellpadding='0' style='color:#696969; font-size:16px; padding:20px'>Thanks,<br>Team Better Nutrition.</td>
			</tr>
		</table>";
		// Sending Email if all values correct
		// echo '<pre>'; 
		// print_r($headers);echo '</br>';
		// print_r($subject);echo '</br>';
		// print_r($email_body);echo '</br>'; die;
		if(wp_mail($to, $subject, $email_body, $headers))
		{
			if(wp_mail($fmail, $subject, $email_body2, $headers2)){
			
			$return = json_encode(array(
				'resp'    => 'success',
				'message' => __('Request sent successfully!', 'pectherm')
			));
			die($return);
		}
	}else{
		$return = json_encode(array(
				'resp'    => 'error',
				'message' => __('Something went wrong!', 'pectherm')
		));
		die($return);
	}
	}
}
?>