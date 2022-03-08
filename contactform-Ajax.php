// Contact Form Ajax Callback
	add_action('wp_ajax_nopriv_wp_contact_callback', 'wp_contact_callback');
	add_action( 'wp_ajax_wp_contact_callback', 'wp_contact_callback' );
	function wp_contact_callback() {
		global $wpdb;
		$fname  = $_POST['arg']['fname'];
		$fmail  = $_POST['arg']['fmail'];
		$fmess  = $_POST['arg']['fmess'];

		if( isset($fmail) ) {
			$admin      = 'rv@zsoftware.tech';
			$site_logo  = get_stylesheet_directory_uri() . '/images/logo.png';
            $headers    = "MIME-Version: 1.0" . "\r\n";
            $headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers   .= "From: $fname <$fmail>\r\nReply-To: $fmail\r\nReturn-Path: $fmail\r\n";
            $subject    = "Contact form submit query";
            $email_body = "<table style='max-width:600px;margin:0 auto;background:#f5f5f5;border:1px solid #ddd;'>
                <tr>
                    <td cellspacing='0' cellpadding='0' style='text-align:center;border-bottom:1px solid #dddddd;padding:20px 20px 0;background#fff'><img src='".$site_logo."' alt='Engineers Theme' style='width: 200px' /><br><br></td>
                </tr>
                <tr>
                    <td cellspacing='0' cellpadding='0' style='color:#696969;font-size:18px;padding:20px'>Welcome to Credo Solutions,<br></td>
                </tr>
                <tr>
                    <td cellspacing='0' cellpadding='0' style='color:#696969;font-size:16px;padding:20px 20px 0'>A request via contact form has been sent from a visitor. Below are the details of the visitor:<br><br><b>Name:</b> ".$fname."<br><b>Email:</b> ".$fmail."<br><b>Message:</b> ".$fmess."<br><br><br></td>
                </tr>
                <tr>
                    <td cellspacing='0' cellpadding='0' style='color:#696969; font-size:16px; padding:20px'>Thanks,<br>Team Credo Solutions.</td>
                </tr>
            </table>";

            // Sending Email if all values correct
            //if(wp_mail($admin, $subject, $email_body, $headers)) {
            	$return = json_encode(array(
                    'resp'    => 'success',
                    'message' => __('Request sent successfully!', 'pectherm')
                ));
                die($return);
            //}
        }
		die();
	}

    add_filter('admin_footer_text', 'rv_footer');
    function rv_footer() {
        echo 'Managed by <a href="http://zsoftware.tech" target="_blank">WordPress</a>';
    }

